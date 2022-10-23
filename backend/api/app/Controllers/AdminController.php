<?php

namespace App\Controllers;

use App\Models\Admin;
use App\Models\Room;
use Respect\Validation\Validator as v;

class AdminController extends Controller
{

    /**
     * @OA\Get(
     * path="/api/admins",
     * @OA\Response(response="200", description="All admins")
     * )
     */
    // public function getSendAll($request, $response)
    // {
    //     $rows = $this->Database->querySelect('SELECT * FROM admin', null, true);

    //     if ($rows) {
    //         return $response->withJson($rows, 200);
    //     } else {
    //         return $response->withJson(500);
    //     }
    // }

    /**
     * @OA\Post(
     *     path="/api/admins",
     *     summary="Add a new admin",
     *     @OA\Response(
     *         response=201,
     *         description="OK"
     *     ),
     *      @OA\Response(
     *         response=422,
     *         description="UNPROCESSABLE ENTRY"
     *     ),
     *      @OA\RequestBody(
     *       required=true,
     *       @OA\MediaType(
     *           mediaType="application/json",
     *           @OA\Schema(ref="#/components/schemas/Admin")
     *       )
     *   ),
     * )
     */
    public function post_createSingleAdmin($request, $response)
    {
        if ($this->Validator->validate($request, [
            'CONTENT_TYPE' => v::json(),
            'first_name' => v::germanAlpha()->length(1, $this->settings['validation']['firstNameLength']),
            'last_name' => v::germanAlpha()->length(1, $this->settings['validation']['lastNameLength']),
            'nickname' => v::germanAlpha()->length(0, $this->settings['validation']['nicknameLength']),
            'email' => v::email()->length(1, $this->settings['validation']['emailLength'])->uniqueEmail(),
            'pw' => v::length(1, $this->settings['validation']['passwordLength']),
            'telnr' => v::germanPhone()->length(0, $this->settings['validation']['telephoneNumberLength']),
            'room' => v::optional(v::stringType()->length(null, $this->settings['validation']['roomLength']))->notEmpty(),
        ])->failed()) {
            return $response;
        }

        $reqBody = $request->getParsedBody();

        //create admin
        $admin = new Admin([
            'first_name' => $reqBody['first_name'],
            'last_name' => $reqBody['last_name'],
            'nickname' => $reqBody['nickname'],
            'email' => $reqBody['email'],
            'pw' => password_hash($reqBody['pw'], PASSWORD_DEFAULT),
            'telnr' => $reqBody['telnr'],
        ]);

        $sql = 'INSERT INTO 
                    admin (first_name,last_name,nickname,email,pw,telnr) 
                VALUES
                    (:first_name,:last_name,:nickname,:email,:pw,:telnr)';

        //begin sql transaction
        $this->Database->getConnection()->beginTransaction();

        //execute insert
        $admin->idadmin = $this->Database->queryInsert($sql, $admin->getInsertVars());

        //create room
        $room = new Room([
            'name' => $reqBody['room'],
            'admin_idadmin' => $admin->idadmin,
        ]);

        $sql = 'INSERT INTO 
                    room (name,admin_idadmin) 
                VALUES
                    (:name,:admin_idadmin)';

        //execute insert
        $room->idroom = $this->Database->queryInsert($sql, $room->getInsertVars());

        if ($admin && $room) {
            //commit sql
            $this->Database->getConnection()->commit();

            return $response->withJson(
                array_merge($admin->getPublicVars(), [ 'room' => $room->getPublicVars()['name']]),
                201
            );
        }

        //rollback in error case
        $this->Database->getConnection()->rollback();
        return $response->withStatus(400);
    }
}
