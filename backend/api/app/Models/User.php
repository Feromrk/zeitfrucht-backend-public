<?php

namespace App\Models;

/**
 * @OA\Schema(title="User")
 */
class User extends Model
{
    /**
     * @OA\Property(format="int64")
     * @var int
     */
    public $iduser;         //int not null

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

    /**
     * @OA\Property()
     * @var bool
     */
    public $superuser;      //bool

    public function __construct($data = null)
    {
        if (is_array($data)) {
            if (isset($data['iduser'])) {
                $this->iduser = $data['iduser'];
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
            $this->superuser = filter_var($data['superuser'], FILTER_VALIDATE_BOOLEAN);
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
        $vars = $this->getVars(['iduser']);

        //superuser has to be an int for sql
        $vars['superuser'] = (int)$vars['superuser'];

        return $vars;
    }

    public function getPublicVars()
    {
        $vars = $this->getVars(['pw']);
        $vars['superuser'] = ($vars['superuser']) ? 'true' : 'false';
        $vars['iduser'] = (string)$vars['iduser'];
        return $vars;
    }
}
