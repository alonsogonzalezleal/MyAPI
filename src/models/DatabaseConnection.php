<?php

class DatabaseConnection {

    private static $mysqli;

    private function __construct(){

        $url = $_SERVER['HTTP_HOST'];

        if (strpos($url, 'local') !== false) {
            $this->mysqli = new mysqli('localhost', 'root', 'root', 'RoadAlert');
        } else {
            $this->mysqli = new mysqli('mysql', 'user', 'password', 'database_name');
        }
    }

    private static function connect(){
        $db = new DatabaseConnection();
        return $db->mysqli;
    }

    public static function getConnectedInstance(){

        if (self::$mysqli == null){
            return self::connect();
        }

        if (self::$mysqli->connect_errno){
            return self::connect();
        }

        return self::$mysqli;
    }

}