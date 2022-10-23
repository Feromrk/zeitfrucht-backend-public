<?php

namespace App\Controllers;

use PDO;
use Respect\Validation\Validator as v;

use App\Models\User;
use App\Models\Room;
use App\Models\RoomHasUser;
use App\Enums\UserTypeEnum;

class UserController extends Controller
{
    /**
     * @OA\Get(
     * path="/api/users",
     * @OA\Response(response="200", description="All users")
     * )
     */

    //only admin allowed
    public function get_returnAllUsers($request, $response)
    {
        $jwt = $request->getAttribute('token');

        if ($jwt['type'] !== UserTypeEnum::ADMIN()->getValue()) {
            return $response->withStatus(401);
        }

        $sql = 'SELECT user.iduser,user.first_name,user.last_name,user.nickname,user.email,user.pw,user.telnr,user.superuser
        FROM room 
        JOIN room_has_user ON room.idroom=room_has_user.room_idroom 
        JOIN user ON room_has_user.user_iduser=user.iduser 
        WHERE room.admin_idadmin=:idadmin';

        $vars = [
            ':idadmin' => $jwt['id'],
        ];

        $users = $this->Database->querySelect($sql, $vars, true, \PDO::FETCH_CLASS, User::class);

        $publicUsers = [];
        foreach ($users as $user) {
            array_push($publicUsers, $user->getPublicVars());
        }
        return $response->withJson($publicUsers, 200);
    }


    public function get_returnSingleUser($request, $response, $args)
    {
        if ($this->Validator->validateArray($args, [
            'id' => v::intVal()->length(1, $this->settings['validation']['idLength']),
        ])->failed()) {
            return $response;
        }

        $jwt = $request->getAttribute('token');

        if ($jwt['type'] === UserTypeEnum::USER()->getValue()) {
            if ($jwt['id'] === $args['id']) {
                $sql = 'SELECT * from user WHERE iduser=:iduser';
                $vars = [
                ':iduser' => $jwt['id'],
                ];

                $user = $this->Database->querySelect($sql, $vars, false, \PDO::FETCH_CLASS, User::class);

                if ($user) {
                    return $response->withJson($user->getPublicVars(), 200);
                } else {
                    return $response->withStatus(400);
                }
            } else {
                return $response->withStatus(401);
            }
        } elseif ($jwt['type'] === UserTypeEnum::ADMIN()->getValue()) {
            $sql = 'SELECT user.iduser,user.first_name,user.last_name,user.nickname,user.email,user.pw,user.telnr,user.superuser
                    FROM room 
                    JOIN room_has_user ON room.idroom=room_has_user.room_idroom 
                    JOIN user ON room_has_user.user_iduser=user.iduser 
                    WHERE room.admin_idadmin=:idadmin AND user.iduser=:iduser';
                    
            $vars = [
                ':idadmin' => $jwt['id'],
                ':iduser' => $args['id'],
            ];

            $user = $this->Database->querySelect($sql, $vars, false, \PDO::FETCH_CLASS, User::class);

            if ($user) {
                return $response->withJson($user->getPublicVars(), 200);
            } else {
                return $response->withStatus(401);
            }
        } else {
            return $response->withStatus(500);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/users",
     *     summary="Add a new user",
     *     @OA\Response(
     *         response=201,
     *         description="OK"
     *     ),
     *      @OA\Response(
     *         response=400,
     *         description="Database error"
     *     ),
     *      @OA\RequestBody(
     *       required=true,
     *       @OA\MediaType(
     *           mediaType="application/json",
     *           @OA\Schema(ref="#/components/schemas/User")
     *       )
     *   ),
     * )
     */
    public function post_createSingleUser($request, $response)
    {
        if ($this->Validator->validate($request, [
            'CONTENT_TYPE' => v::json(),
            'first_name' => v::germanAlpha()->length(1, $this->settings['validation']['firstNameLength']),
            'last_name' => v::germanAlpha()->length(1, $this->settings['validation']['lastNameLength']),
            'nickname' => v::germanAlpha()->length(0, $this->settings['validation']['nicknameLength']),
            'email' => v::email()->length(1, $this->settings['validation']['emailLength'])->uniqueEmail(),
            'pw' => v::length(1, $this->settings['validation']['passwordLength']),
            'telnr' => v::germanPhone()->length(0, $this->settings['validation']['telephoneNumberLength']),
            'superuser' => v::boolVal(),
        ])->failed()) {
            return $response;
        }

        $jwt = $request->getAttribute('token');

        if ($jwt['type'] !== UserTypeEnum::ADMIN()->getValue()) {
            return $response->withStatus(401);
        }

        $reqBody = $request->getParsedBody();

        //begin sql transaction
        $this->Database->getConnection()->beginTransaction();

        //create User and insert into db
        $user = new User([
            'first_name' => $reqBody['first_name'],
            'last_name' => $reqBody['last_name'],
            'nickname' => $reqBody['nickname'],
            'email' => $reqBody['email'],
            'pw' => password_hash($reqBody['pw'], PASSWORD_DEFAULT),
            'telnr' => $reqBody['telnr'],
            'superuser' => $reqBody['superuser'],
        ]);

        $sql = 'INSERT INTO 
                    user (first_name,last_name,nickname,email,pw,telnr,superuser) 
                VALUES
                    (:first_name,:last_name,:nickname,:email,:pw,:telnr,:superuser)';

        $lastInsertId = $this->Database->queryInsert($sql, $user->getInsertVars());
        assert(v::intVal()->validate($lastInsertId));

        $user->iduser = $lastInsertId;

        //get room from db according to authenticated admin
        $sql = 'SELECT * 
                FROM room 
                WHERE admin_idadmin=:admin_idadmin';

        $vars = [
            ':admin_idadmin' => $jwt['id'],
        ];

        $room = $this->Database->querySelect($sql, $vars, false, \PDO::FETCH_CLASS, Room::class);

        //if there is no room for idadmin, the db is corrupt
        assert($room);

        //create RoomHasUser and insert into db
        $roomHasUser = new RoomHasUser([
            'user_iduser' => $user->iduser,
            'room_idroom' => $room->idroom
        ]);

        $sql = 'INSERT INTO
                    room_has_user (user_iduser, room_idroom)
                VALUES
                    (:user_iduser, :room_idroom)';
        
        $lastInsertId = $this->Database->queryInsert($sql, $roomHasUser->getInsertVars());
        assert(v::intVal()->validate($lastInsertId));

        //commit sql transaction
        $this->Database->getConnection()->commit();

        return $response->withJson(
            array_merge($user->getPublicVars(), ['room' => $room->getPublicVars()['name']]),
            201
        );
    }
}
