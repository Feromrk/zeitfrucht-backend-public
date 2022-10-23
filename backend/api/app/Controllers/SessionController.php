<?php

namespace App\Controllers;

use App\Models\Room;
use App\Enums\UserTypeEnum;
use Respect\Validation\Validator as v;

class SessionController extends Controller
{
    //returns array with current auth status
    // private function authStatus()
    // {
    //     $auth = $this->auth->check();

    //     $res = [
    //         'authenticated' => $auth
    //     ];

    //     if ($auth) {
    //         $res = array_merge($res, $this->auth->user());
    //     }
        
    //     return $res;
    // }

    // public function getSendCsrf($request, $response)
    // {
    //     $nameKey = $this->csrf->getTokenNameKey();
    //     $valueKey = $this->csrf->getTokenValueKey();

    //     return $response->withJson([
    //         'nameKey' => $nameKey,
    //         'name' => $request->getAttribute($nameKey),
    //         'valueKey' => $valueKey,
    //         'value' => $request->getAttribute($valueKey),
    //     ]);
    // }

    // public function deleteDoLogout($request, $response)
    // {
    //     $this->auth->logout();
    //     return $response->withJson($this->authStatus());
    // }

    public function post_createToken($request, $response)
    {
        $this->AssertHelper->assertSettings([
            'jwt' => 'pubkeyname',
            'jwt' => 'header',
            'validation' => 'emailLength',
            'validation' => 'passwordLength',
        ], __METHOD__, __LINE__);

        //validate
        if ($this->Validator->validate($request, [
            'email' => v::email()->length(1, $this->settings['validation']['emailLength']),
            'pw' => v::length(1, $this->settings['validation']['passwordLength']),
        ])->failed()) {
            return $response;
        }

        $reqBody = $request->getParsedBody();

        $sessionInfo = $this->auth->attempt($reqBody['email'], $reqBody['pw']);

        if (!$sessionInfo) {
            return $response->withJson([
                'errors' => [
                    'credentials' => 'Invalid credentials provided',
                ],
            ], 422);
        }

        if($sessionInfo['type'] === UserTypeEnum::USER()->getValue()) {

            $sql = 'SELECT room.idroom, room.name
            FROM room 
            JOIN room_has_user ON room.idroom=room_has_user.room_idroom 
            JOIN user ON room_has_user.user_iduser=user.iduser 
            WHERE user.iduser=:iduser';

            $vars = [
                ':iduser' => $sessionInfo['person']->iduser,
            ];

            $room = $this->Database->querySelect($sql, $vars, false, \PDO::FETCH_CLASS, Room::class);

            assert($room, 'user has no room');
        } else if($sessionInfo['type'] === UserTypeEnum::ADMIN()->getValue()) {
            $sql = 'SELECT room.idroom, room.name
                    FROM room 
                    WHERE room.admin_idadmin=:idadmin';

            $vars = [
                ':idadmin' => $sessionInfo['person']->idadmin,
            ];

            $room = $this->Database->querySelect($sql, $vars, false, \PDO::FETCH_CLASS, Room::class);

            assert($room, 'admin has no room');
        } else {
            throw \OutOfBoundsException('type of person is not a valid type');
        }

        $personInfo = \array_merge(
            $sessionInfo['person']->getPublicVars(),
            ['room' => $room->getPublicVars()['name']]
        );

        return $response->withJson([
                $this->settings['jwt']['header'] => $sessionInfo['jwt'],
                $this->settings['jwt']['pubkeyname'] => \base64_encode($this->auth->publicKey()),
                $sessionInfo['type'] => $personInfo
            ]
        );
    }


}
