<?php


define("host", "localhost");
define("databaseName", "freshmarket");
define("connectionString", "mysql:host=" . host . ";dbname=" . databaseName . "");
define("username", "root");
define("password", "");

class DatabaseHelper
{
    public static $connection = null;

    public static function createConnection()
    {

        // If null, initialize a new connection
        if (self::$connection == null) {

            self::$connection = new PDO(connectionString, username, password);

            self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            return self::$connection;

        } 
        // If a connection is established, return it
        elseif (self::$connection !== null) {
            return self::$connection;
        }

    }
}

?>