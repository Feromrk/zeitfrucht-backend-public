<?php

namespace App\Models;

/**
 * @OA\Schema(title="Room")
 */
class RoomHasUser extends Model
{
    /**
     * @OA\Property(format="int64")
     * @var int
     */
    public $user_iduser;         //int not null

    /**
     * @OA\Property(format="int64")
     * @var int
     */
    public $room_idroom; //int not null

    public function __construct(array $data = null)
    {
        if(is_null($data)) {
            return;
        }

        if (isset($data['user_iduser'])) {
            $this->user_iduser = $data['user_iduser'];
        } else {
            throw new \OutOfBoundsException("user_iduser must not be null");
        }

        if (isset($data['room_idroom'])) {
            $this->room_idroom = $data['room_idroom'];
        } else {
            throw new \OutOfBoundsException("room_idroom must not be null");
        }

    }

    public function getInsertVars()
    {
        return $this->getVars();
    }

    public function getPublicVars()
    {
        return $this->getVars(['user_iduser','room_idroom']);
    }
}
