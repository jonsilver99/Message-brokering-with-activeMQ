<?php
class Database extends StaticClass
{
    const Host = DB_HOST;
    const Username = DB_USER;
    const Password = DB_PASS;
    const DB_name = "notes_board";

    private static $Connection;
    public static $connection_status;
    public static $error_msg;
    public static $error_code;

    public static function connect()
    {
        if (!self::$Connection) {
            self::$Connection = new mysqli(self::Host, self::Username, self::Password, self::DB_name);            
            if (self::$Connection->connect_error) {
                throw new Exception("Database connection error: $Connection->connect_error");
            } else self::$connection_status = "Mysql connected"; 
        }
    }

    /*query execution*/
    public static function exec_query($query)
    {
        if ($queryResponse = self::$Connection->query($query)) {
            return $queryResponse;
        } else {
            self::$error_msg = mysqli_error(Database::$Connection);
            self::$error_code = mysqli_errno(Database::$Connection);
            return false;
        }
    }

    public static function last_inserted_id()
    {
        return self::$Connection->insert_id;
    }
}