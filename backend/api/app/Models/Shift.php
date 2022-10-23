<?php

namespace App\Models;

/**
 * @OA\Schema(title="Shift")
 */
class Shift extends Model
{
    /**
     * @OA\Property()
     * @var string
     */
    public $date;     //string not null

    /**
     * @OA\Property()
     * @var string
     */
    public $start;      //string not null

    /**
     * @OA\Property()
     * @var string
     */
    public $end;       //string

    /**
     * @OA\Property()
     * @var string
     */
    public $admin_idadmin;    //string 

    /**
     * @OA\Property()
     * @var string
     */
    public $room_idroom;     //string not null


    # shift insert date strin in format 'YYYY-MM-DD'
    # time 'hh:mm'
    public function __construct(array $data = null)
    {
        if(is_null($data)) {
            return;
        }

        $this->setVars($data, [
            'date' => 'notnull',
            'start' => 'notnull',
            'end' => '',
            'admin_idadmin' => '',
            'room_idroom' => 'notnull'
        ]);

    }

    public function getInsertVars()
    {
        $vars = $this->getVars();

        //TODO
        //convert date, start usw to sql needed types
        # shift insert date strin in format 'YYYY-MM-DD'
        # time 'hh:mm'

        return $vars;
    }

    public function getPublicVars()
    {
        $vars = $this->getVars();

        return $vars;
    }
}
