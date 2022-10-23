<?php

namespace App\Models;

/**
 * @OA\Schema(title="Admin")
 */
class Admin extends Model
{
    /**
     * @OA\Property(format="int64")
     * @var int
     */
    public $idadmin;         //int not null

    /**
     * @OA\Property()
     * @var string
     */
    public $first_name;     //string

    /**
     * @OA\Property()
     * @var string
     */
    public $last_name;      //string

    /**
     * @OA\Property()
     * @var string
     */
    public $nickname;       //string

    /**
     * @OA\Property()
     * @var string
     */
    public $email;          //string not null

    /**
     * @OA\Property()
     * @var string
     */
    public $pw;             //string

    /**
     * @OA\Property()
     * @var string
     */
    public $telnr;          //string

    public function __construct($data = null)
    {
        if (is_array($data)) {
            if (isset($data['idadmin'])) {
                $this->idadmin = $data['idadmin'];
            }

            if (isset($data['email'])) {
                $this->email = $data['email'];
            } else {
                throw new \OutOfBoundsException("email must not be null");
            }

            $this->first_name = $data['first_name'];
            $this->last_name = $data['last_name'];
            $this->nickname = $data['nickname'];
            $this->pw = $data['pw'];
            if (!$data['telnr']) {
                $data['telnr'] = '';
            }
            $this->telnr = $data['telnr'];
        } else {
            if ($data !== null) {
                throw new \InvalidArgumentException("Argument must be an array");
            }
        }
    }
    
    public function getFullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getInsertVars()
    {
        return $this->getVars(['idadmin']);
    }

    public function getPublicVars()
    {
        $vars = $this->getVars(['pw']);
        $vars['idadmin'] = (string)$vars['idadmin'];
        return $vars;
    }
}
