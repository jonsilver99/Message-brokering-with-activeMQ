<?php
class DBHandler extends StaticClass
{
    public static function insert_to_db($objectProps, $tableName)
    {
        // validate and sanitize

        foreach ($objectProps as $key => $value) {
            if ($key != 'Id') {
                $objectKeys[] = $key;
                $objectValues[] = "'" . $value . "'";
            }
        }

        $fieldNames = implode(", ", $objectKeys);
        $fieldValues = implode(", ", $objectValues);
        $query = "INSERT INTO $tableName ($fieldNames) VALUES ($fieldValues)";

        return (Database::exec_query($query));
    }

    public static function last_database_error()
    {
        return Database::$error_msg;
    }

    public static function last_database_error_code()
    {
        return Database::$error_code;
    }

}
