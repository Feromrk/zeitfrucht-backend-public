<?php

namespace App\Authentication;

use \Firebase\JWT\JWT;

use App\Enums\UserTypeEnum;
use App\Models\User;
use App\Models\Admin;

class Auth
{
    protected $container;
    private $privateKey;
    private $publicKey;
    private $privateKeyFile = __DIR__.'/private.key';
    private $publicKeyFile = __DIR__.'/public.key';
    private $generateKeypairFile = __DIR__.'/generateKeypair.sh';

    public function __construct($container)
    {
        $this->container = $container;
        $this->loadKeys();
    }

    //attempt to authenticate and return jwt upon success
    public function attempt($email, $pw)
    {
        assert(isset($this->container->settings['jwt']['algorithm']));
        assert(isset($this->container->settings['jwt']['lifetime']));

        $user_sql = 'SELECT * FROM user WHERE email = :email';
        $admin_sql = 'SELECT * FROM admin WHERE email = :email';
        $vars = [
            ':email' => $email,
        ];
        $user = $this->container->Database->querySelect($user_sql, $vars, false, \PDO::FETCH_CLASS, User::class);
        $admin = $this->container->Database->querySelect($admin_sql, $vars, false, \PDO::FETCH_CLASS, Admin::class );

        if ($user && \password_verify($pw, $user->pw)) {
            $payload = [
                'id' => $user->iduser,
                'type' => UserTypeEnum::USER()->getValue(),
            ];
            $person = $user;
            $personType = UserTypeEnum::USER()->getValue();
        } elseif ($admin && \password_verify($pw, $admin->pw)) {
            $payload = [
                'id' => $admin->idadmin,
                'type' => UserTypeEnum::ADMIN()->getValue(),
            ];
            $person = $admin;
            $personType = UserTypeEnum::ADMIN()->getValue();
        }

        if(isset($payload['id']) && isset($payload['type'])) {

            //append expiration date
            $payload = array_merge(
                $payload, 
                ['exp' => time() + $this->container->settings['jwt']['lifetime']]
            );

            $jwt = JWT::encode(
                $payload, 
                $this->privateKey(),
                $this->container->settings['jwt']['algorithm']
            );

            return [
                'jwt' => $jwt,
                'person' => $person,
                'type' => $personType
            ];
        }

        return false;
    }

    public function publicKey() {
        return $this->publicKey;
    }

    public function privateKey() {
        return $this->privateKey;
    }

    private function loadKeys() {

        if(file_exists($this->privateKeyFile) === FALSE || file_exists($this->publicKeyFile) === FALSE) {
            exec('bash '.$this->generateKeypairFile.' 2&>1', $output, $exitCode);

            if($exitCode !== 0) {
                throw UnexpectedValueException('errors while generating RSA keypair');
            }
        }

        $this->privateKey = file_get_contents($this->privateKeyFile);
        $this->publicKey = file_get_contents($this->publicKeyFile);


        if($this->privateKey === FALSE || $this->publicKey === FALSE) {
            throw UnexpectedValueException('unable to load RSA keypair');
        }
    }

}
