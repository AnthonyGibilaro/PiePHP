<?php

namespace Core;
use PDO;

class Database {
    private static $pdo;

    public static function connect_to_db() {
        if (self::$pdo === NULL){
            self::$pdo = new PDO("mysql:host=localhost;dbname=cinema", "root", "");
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$pdo;
    }
}
