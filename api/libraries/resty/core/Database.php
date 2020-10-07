<?php
    class Database{
        // private static $host = 'api.backlog-site.com';
        // private static $database_name = 'app-log-database';
        // private static $username = 'root';
        // private static $password = '';
        protected static $connection;

        public static function getConnection(){
            if(is_null(self::$connection)){
                self::$connection = null;
                try {
                    // self::$connection = new PDO('mysql:host='.self::$host.';dbname='.self::$database_name, self::$username, self::$password);
                    self::$connection = new PDO('mysql:host='.Envy::get("DATABASE_HOST").';dbname='.Envy::get("DATABASE_NAME"), Envy::get("DATABASE_USER"), Envy::get("DATABASE_PASSWORD"));
                    self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                } catch (PDOException $exception) {
                    echo $exception->getMessage();
                }
            }
            return self::$connection;
        }
        public static function destroyConnection(){
            if(!is_null(self::$connection)){
                self::$connection = null;
            }
        }
    }
?>