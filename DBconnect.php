<?php
require_once('config.php');

class DBconnect{
    public static function getInstance()
    {
        try{
            $pdo = new PDO("mysql:host=". DB_HOST .";dbname=". DB_NAME, DB_USER, DB_PASSWORD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }catch(Throwable $e){
            die("Error: Could not connect".$e->getMessage());
        }

        return $pdo;
    }
}