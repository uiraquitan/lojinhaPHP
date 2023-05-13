<?php

namespace App\Core;

use PDO;
use PDOException;

class DataBase
{

    private const OPTIONS = [
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
        \PDO::ATTR_CASE => \PDO::CASE_NATURAL
    ];

    private static $connect;

    public static function getInstance(): PDO
    {
        if (self::$connect == null) {
            try {
                self::$connect = new PDO("mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";", DB_USER, DB_PASS, self::OPTIONS);
            } catch (\PDOException $e) {
                echo "Erro ao conectar". $e->getMessage();
            }
        }
        return self::$connect;
    }

    final private function __construct()
    {
    }
}
