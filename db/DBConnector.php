<?php

class DBConnector
{
    // create only one instance for the project
    private static $db;

    public static function getInstance()
    {

        if (self::$db == null) {

            $info = array(
                "db_host" => "localhost",
                "db_port" => "3306",
                "db_user" => "root",
                "db_pass" => "",
                "db_name" => "sales",);

            try {
                self::$db = new PDO("mysql:host=" . $info['db_host'] . ';port=' . $info['db_port'] . ';dbname=' . $info['db_name'], $info['db_user'], $info['db_pass']);
                self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            } catch (PDOException $exception) {

                echo $exception->getMessage();
            }

        }

        return self::$db;
    }

}