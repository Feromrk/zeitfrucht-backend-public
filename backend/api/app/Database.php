<?php

namespace App;

use PDO;

//Singleton class
final class Database
{
    private static $instance = null;
    private static $connection = null;
    private static $debug = true;
    private static $appSettings = null;

    private static $currentConfig = 'docker';
    private static $configs = [
        'docker' => [
            'dbhost' => 'mysql',
            'dbuser' => 'root',
            'dbpass' => '@zeitfruchtig@',
            'dbname' => 'DB3701281',
        ],
        'lab' => [
            'dbhost' => 'localhost',
            'dbuser' => 'zeitfrucht',
            'dbpass' => 'zeitfruchtig',
            'dbname' => 'DB3701281',
        ],
    ];

    /**
     * gets the instance via lazy initialization (created on first usage)
     */
    public static function Instance()
    {
        if (null === static::$instance) {
            static::$instance = new self();
            self::connect();
        }

        return static::$instance;
    }

    public static function getConnection()
    {
        if (self::$connection !== null) {
            return self::$connection;
        } else {
            throw new UnexpectedValueException('Database is not connected');
        }
    }

    public static function handleErrors($query, \Exception $e, $data ,bool $throw)
    {
        if (self::$debug) {
            pr('Type: '.get_class($e));
            pr('Error: '.$e->getMessage());
            pr('Query: '.$query);
            echo('Data: ');
            pr($data);
            $debug = debug_backtrace();
            echo 'Found in ' . $debug[0]['file'] . ' on line ' . $debug[0]['line'];
        }

        if ($throw) {
            throw new \PDOException(__METHOD__.' called');
        }
    }

    public static function setAppSettings($settings)
    {
        self::$appSettings = $settings;
        self::$debug = self::$appSettings['displayErrorDetails'];
    }

    public static function querySelect(string $sql, array $vars = null, bool $fetchAll = false, $fetchStyle = \PDO::FETCH_ASSOC, $fetchArgument = null)
    {

        //$sql must be a select statement
        //if insert found
        if (strpos(strtolower($sql), 'insert') !== false) {
            self::handleErrors($sql, new \PDOException(__METHOD__.' called with INSERT statement'), true);
        }
        //if select not found
        if (strpos(strtolower($sql), 'select') === false) {
            self::handleErrors($sql, new \PDOException(__METHOD__.' called without SELECT statement'), true);
        }

        try {
            $db =self::getConnection();

            $stmt = $db->prepare($sql);

            if (is_null($vars)) {
                //foreach ($vars as $placeHolder => &$value) {
                //    $stmt->bindParam($placeHolder, $value);
                //}
                $stmt->execute();
            } else {
                $stmt->execute($vars);
            }

            if (is_null($fetchArgument)) {
                $stmt->setFetchMode($fetchStyle);
            } else {
                $stmt->setFetchMode($fetchStyle, $fetchArgument);
            }
            
            //returns false if nothing to return
            if ($fetchAll) {
                return $rows = $stmt->fetchAll();
            } else {
                return $row = $stmt->fetch();
            }
        } catch (\PDOException $e) {
            self::handleErrors($sql, $e, $vars, true);
            return null;
        }
    }

    public static function queryInsert(string $sql, array $vars, bool $extendedReturn=false, bool $multi = false)
    {
        //$sql must be an insert statement
        //if insert not found
        if (strpos(strtolower($sql), 'insert') === false) {
            self::handleErrors($sql, new \PDOException(__METHOD__.' called without INSERT statement'), true);
        }
        //if select found
        if (strpos(strtolower($sql), 'select') !== false) {
            self::handleErrors($sql, new \PDOException(__METHOD__.' called with SELECT statement'), true);
        }
        //vars have to passed for an insert statement
        if (\is_null($vars)) {
            self::handleErrors($sql, new \PDOException(__METHOD__.' called without vars'), true);
        }

        try {
            $db =self::getConnection();
            $stmt = $db->prepare($sql);

            //foreach ($vars as $placeHolder => &$value) {
            //    $stmt->bindParam($placeHolder, $value);
            //}
            if($multi) {
            //$var is actually a group of vars
                foreach ($vars as $var) {
                    $stmt->execute($var);
                }
            } else {
                $stmt->execute($vars);
            }

            if($extendedReturn) {
                return [
                    'rowCount' => $stmt->rowCount(),
                    'lastInsertId' => $db->lastInsertId()
                ];
            } else {
                return $db->lastInsertId();
            }
        } catch (\PDOException $e) {
            self::handleErrors($sql, $e, $vars, true);
            return null;
        }
    }

    public static function queryDelete(string $sql, array $vars, bool $multi = false)
    {
        //$sql must be an insert statement
        //if insert not found
        if (strpos(strtolower($sql), 'delete') === false) {
            self::handleErrors($sql, new \PDOException(__METHOD__.' called without DELETE statement'), true);
        }
        //if select found
        if (strpos(strtolower($sql), 'select') !== false) {
            self::handleErrors($sql, new \PDOException(__METHOD__.' called with SELECT statement'), true);
        }
        if (strpos(strtolower($sql), 'insert') !== false) {
            self::handleErrors($sql, new \PDOException(__METHOD__.' called with INSERT statement'), true);
        }
        //vars have to passed for an insert statement
        if (\is_null($vars)) {
            self::handleErrors($sql, new \PDOException(__METHOD__.' called without vars'), true);
        }

        try {
            $db =self::getConnection();
            $stmt = $db->prepare($sql);

            //foreach ($vars as $placeHolder => &$value) {
            //    $stmt->bindParam($placeHolder, $value);
            //}
            if($multi) {
            //$var is actually a group of vars
                foreach ($vars as $var) {
                    $stmt->execute($var);
                }
            } else {
                $stmt->execute($vars);
            }

            if($returnAll) {
                return [
                    'rowCount' => $stmt->rowCount(),
                    'lastInsertId' => $db->lastInsertId()
                ];
            } else {
                return $db->lastInsertId();
            }
        } catch (\PDOException $e) {
            self::handleErrors($sql, $e, $vars, true);
            return null;
        }
    }

    private static function connect()
    {

        $config = self::$configs[self::$currentConfig];
        assert($config);

        $dsn = "mysql:host=".$config['dbhost'].";dbname=".$config['dbname'].";charset=utf8";
        self::$connection = new PDO($dsn, $config['dbuser'], $config['dbpass'], [
            PDO::ATTR_TIMEOUT => 5,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => true,
        ]);
    }

    /**
     * is not allowed to call from outside to prevent from creating multiple instances,
     * to use the singleton, you have to obtain the instance from Singleton::getInstance() instead
     */
    private function __construct()
    {
    }

    /**
     * prevent the instance from being cloned (which would create a second instance of it)
     */
    private function __clone()
    {
    }

    /**
     * prevent from being unserialized (which would create a second instance of it)
     */
    private function __wakeup()
    {
    }
}
