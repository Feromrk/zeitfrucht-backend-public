<?php

namespace App\Models;

/**
 * @OA\Schema(title="Room")
 */
class Room extends Model
{
    /**
     * @OA\Property(format="int64")
     * @var int
     */
    public $idroom;         //int not null

    /**
     * @OA\Property()
     * @var string
     */
    public $name;     //string

    /**
     * @OA\Property(format="int64")
     * @var int
     */
    public $admin_idadmin;

    public function __construct(array $data = null)
    {
        if(is_null($data)) {
            return;
        }

        if (isset($data['idroom'])) {
            $this->idroom = $data['iduser'];
        }

        if (isset($data['name'])) {
            $this->name = $data['name'];
        }

        if (isset($data['admin_idadmin'])) {
            $this->admin_idadmin = $data['admin_idadmin'];
        } else {
            throw new \OutOfBoundsException("admin_idadmin must not be null");
        }
    }

    public function getInsertVars()
    {
        return $this->getVars(['idroom']);
    }

    public function getPublicVars()
    {
        return $this->getVars(['idroom','admin_idadmin']);
    }
}
