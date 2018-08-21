<?php

/**
 * Created by PhpStorm.
 * User: Charles
 * Date: 07/10/2017
 * Time: 22:45
 */

namespace Sumauma\ORM;

use Slim\PDO\Database;


class ConnectionManager
{

    protected static $pdo = null;

    public static function getConnection($name)
    {
        if(is_null(static::$pdo))
        {
            $config = Config::$$name;
            $dsn = "mysql:host={$config['host']};dbname={$config['dbname']}";
            $dsn .= (!empty($config['charset'])) ? ";{$config['charset']}" : "";
            $pdo = new Database($dsn,$config['user'],$config['password']);
            static::$pdo = $pdo;
            return $pdo;
        }

        return static::$pdo;

    }

}