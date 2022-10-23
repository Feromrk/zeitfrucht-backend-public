<?php

namespace App\Controllers;

use Respect\Validation\Validator as v;
use App\Models\Shift;
use App\Models\User;
use App\Models\Room;
use App\Enums\UserTypeEnum;
use App\Helper\Common as helper;

class ShiftController extends Controller
{

    //nur admin/superuser schickt datum, beginn, optional ende, 
    //und alle user in dieser schicht, optional sich selber auch
    public function post_createSingleShift($request, $response) {
        

        ##############################################################################################
        ## check if provided token is admin or superuser
        
        $jwt = $request->getAttribute('token');
        if ($jwt['type'] === UserTypeEnum::ADMIN()->getValue()) {

            //roomid aus adminid
            $sql = 'SELECT * 
            FROM room 
            WHERE admin_idadmin=:idadmin';

            $vars = [
                ':idadmin' => $jwt['id'],
            ];

            $room = $this->Database->querySelect($sql, $vars, false, \PDO::FETCH_CLASS, Room::class);
            assert(is_object($room));

            $idroom = $room->idroom;
            assert($idroom, "admin hat keinen raum");

        } else if ($jwt['type'] === UserTypeEnum::USER()->getValue()) {            
            $sql = 'SELECT user.superuser,room_has_user.room_idroom
                    FROM user 
                    JOIN room_has_user
                    ON user.iduser=room_has_user.user_iduser
                    WHERE user.iduser=:iduser';

            $vars = [
                ':iduser' => $jwt['id'],
            ];

            $userinfo = $this->Database->querySelect($sql, $vars, false);

            if(!$userinfo['superuser']) {
                return $response->withStatus(401);
            }

            $idroom = $userinfo['room_idroom'];

            assert($idroom, "user hat keinen raum");
        } else {
            return $response->withStatus(400);
        }

        ##############################################################################################
        if ($this->Validator->validate($request, [
            'CONTENT_TYPE' => v::json(),
            'date' => v::date('Y-m-d'), // '2017-12-31'
            'start' => v::time('H:i'), // 16:06 stunden und minuten with leading zeros
            'end' => v::optional(v::time('H:i')),
            'user_ids' => v::allOf(
                            v::arrayType(),
                            v::each(v::optional(v::intVal())->notEmpty())->setName("int"),
                            v::arrayUniqueValues()
                          ),
            'admin_id' => v::optional(v::intVal()),
        ])->failed()) {
            return $response;
        }

        $params = helper::removeEmptyStringsRecursively($request->getParsedBody());

        //TODO: move this to validator
        ##############################################################################################
        ## check if provided user_ids are actually in the room
        
        $sql = 'SELECT user_iduser
                FROM room_has_user
                WHERE room_idroom=:room_idroom';

        $vars = [
            ":room_idroom" => $idroom,
        ];

        $usersInRoom = $this->Database->querySelect($sql, $vars, true);
        assert(is_array($usersInRoom));

        //extract only user_ids
        $tmp = [];
        foreach ($usersInRoom as $row) {
            \array_push($tmp, $row['user_iduser']);
        }
        $usersInRoom = $tmp;

        $wrongIds = \array_diff($params['user_ids'], $usersInRoom);
        if ($wrongIds) {
            $this->Validator->setErrorsForSingleField(['user_ids' => \implode(', ',array_values($wrongIds))." are invalid"]);
            return $response;
        }       
        ##############################################################################################

        //TODO: move this to validator
        ##############################################################################################
        ## check if provided admin_id is actually in the room
        if($params['admin_id']) {
            $sql = 'SELECT admin_idadmin
            FROM room
            WHERE idroom=:idroom';

            $vars = [
                ":idroom" => $idroom,
            ];

            $row = $this->Database->querySelect($sql, $vars, false);
            assert(is_array($row));

            if($params['admin_id'] != $row['admin_idadmin']) {
                $this->Validator->setErrorsForSingleField(['admin_id' => $params['admin_id']." is invalid, should be ".$row['admin_idadmin']]);
                return $response;
            }
        }

        ##############################################################################################

        $sql = 'INSERT INTO 
                shift(date,start,end,admin_idadmin,room_idroom) 
                VALUES(:date,:start,:end,:admin_idadmin,:room_idroom)
                ON DUPLICATE KEY UPDATE end=:end, admin_idadmin=:admin_idadmin;';

        //TODO: format von date und start für sql statement validieren
        $vars = [
            ':date' => $params['date'],
            ':start' => $params['start'],
            ':end' => $params['end'],
            ':admin_idadmin' => $params['admin_id'],
            ':room_idroom' => $idroom
        ];

        $this->Database->queryInsert($sql, $vars, true);
        //rowcount = 0 keine aenderung
        //rowcount = 1 insert durchgefuert
        //rowcount = 2 update durchgefuehrt

        //alle user aus der schift ermitteln
        $sql = 'SELECT user_iduser
                FROM shift_has_user
                WHERE shift_date=:shift_date AND shift_start=:shift_start AND shift_room_idroom=:shift_room_idroom';

        $vars = [
            ':shift_date' => $params['date'],
            ':shift_start' => $params['start'],
            ':shift_room_idroom' => $idroom,
        ];

        $usersInShift = $this->Database->querySelect($sql, $vars, true);

        //extract only userids
        $tmp = [];
        foreach ($usersInShift as $value) {
           $tmp = \array_merge($tmp, [$value['user_iduser']]);
        }
        $usersInShift = $tmp;

        //calculate users that needs to be removed or added
        $intersect = \array_intersect($params['user_ids'], $usersInShift);
        $toBeRemoved = \array_merge(\array_diff($intersect, $usersInShift),\array_diff($usersInShift, $intersect));
        $toBeAdded = \array_merge(\array_diff($intersect, $params['user_ids']), \array_diff($params['user_ids'], $intersect));

        #pr($toBeAdded);
        #pr($toBeRemoved);

        if($toBeAdded) {
            //insert needed users
            $sql = 'INSERT INTO 
                shift_has_user (shift_date,shift_start,shift_room_idroom,user_iduser)
                    VALUES (:shift_date,:shift_start,:shift_room_idroom,:user_iduser)';

            $vars = [];
            foreach ($toBeAdded as $iduser) {
                \array_push($vars, [
                    ':shift_date' => $params['date'],
                    ':shift_start' => $params['start'],
                    ':shift_room_idroom' => $idroom,
                    ':user_iduser' => $iduser,
                ]);
            }

            $this->Database->queryInsert($sql, $vars, false, true);
        }

        if($toBeRemoved) {
            //remove unneeded users
            $sql = 'DELETE FROM
                    shift_has_user
                    WHERE user_iduser=:iduser';

            $vars = [];
            foreach ($toBeRemoved as $iduser) {
                \array_push($vars, [
                    ':iduser' => $iduser,
                ]);
            };

            $this->Database->queryDelete($sql, $vars, true);
        }


        ##############################################################################################
        ## query db for result and return it

        $sql = 'SELECT S.date,DATE_FORMAT(S.start, "%H:%i") as start,SHU.user_iduser,S.admin_idadmin,DATE_FORMAT(S.end, "%H:%i") as end
                FROM shift as S
                JOIN shift_has_user as SHU
                ON S.date=SHU.shift_date AND S.start=SHU.shift_start AND S.room_idroom=SHU.shift_room_idroom
                WHERE S.date=:date AND S.start=:start AND S.room_idroom=:room_idroom';

        $vars = [
            ':date' => $params['date'],
            ':start' => $params['start'],
            ':room_idroom' => $idroom,
        ];

        $resultUsersInShift = $this->Database->querySelect($sql, $vars, true);
        assert(\is_array($resultUsersInShift));

        $result = [
            'user_ids' => [],
            'start' => $params['start'],
            'end' => $params['end'],
            'date' => $params['date'],
            'admin_idadmin' => $params['admin_idadmin']
        ];

        //pr($resultUsersInShift);die;

        //build array of different start times with users
        foreach ($resultUsersInShift as $row) {
            if(!isset($result['start'])) {
                $result['start'] = $row['start'];
            }

            if(!isset($result['end'])) {
                $result['end'] = $row['end'];
            }

            if(!isset($result['date'])) {
                $result['date'] = $row['date'];
            }

            if(!isset($result['admin_id'])) {
                $result['admin_id'] = $row['admin_idadmin'];
            }

            \array_push($result['user_ids'], $row['user_iduser']);
        }

        return $response->withJson($result);

        ##############################################################################################
    }

    public function get_returnAllShifts($request, $response) {

        if ($this->Validator->validate($request, [
            'date' => v::date('Y-m-d'), // '2017-12-31'
        ], false)->failed()) {
            return $response;
        }

        $jwt = $request->getAttribute('token');

        if ($jwt['type'] === UserTypeEnum::ADMIN()->getValue()) {

            //roomid aus adminid
            $sql = 'SELECT * 
            FROM room 
            WHERE admin_idadmin=:idadmin';

            $vars = [
                ':idadmin' => $jwt['id'],
            ];

            $room = $this->Database->querySelect($sql, $vars, false, \PDO::FETCH_CLASS, Room::class);
            assert(is_object($room));

            $idroom = $room->idroom;
            assert($idroom);

        } else {
            
            $sql = 'SELECT room_idroom
                    FROM room_has_user
                    WHERE user_iduser=:iduser';

            $vars = [
                ':iduser' => $jwt['id'],
            ];

            $room = $this->Database->querySelect($sql, $vars, false);
            assert(is_array($room));

            $idroom = $room['room_idroom'];
            assert($idroom);
        }

        $params = $request->getParams();
        
        $sql = 'SELECT S.date,DATE_FORMAT(S.start, "%H:%i") as start,SHU.user_iduser,S.admin_idadmin
                FROM shift as S
                JOIN shift_has_user as SHU
                ON S.date=SHU.shift_date AND S.start=SHU.shift_start AND S.room_idroom=SHU.shift_room_idroom
                WHERE S.date=:date AND S.room_idroom=:room_idroom';

        $vars = [
            ':date' => $params['date'],
            ':room_idroom' => $idroom,
        ];


        $usersInShifts = $this->Database->querySelect($sql, $vars, true);
        assert(is_array($usersInShifts));

        $shifts = [];

        //build array of different start times with users
        foreach ($usersInShifts as $row) {
            if(!isset($shifts[$row['start']])) {
                $shifts[$row['start']] = ['user_ids' => []];
            }

            \array_push($shifts[$row['start']]['user_ids'], $row['user_iduser']);


            if(!is_null(($row['admin_idadmin'])) && !isset($shifts[$row['start']]['admin_id'])) {
                $shifts[$row['start']]['admin_id'] = $row['admin_idadmin'];
            } 
        }

        return $response->withJson([$params['date'] => $shifts]);
    }

}