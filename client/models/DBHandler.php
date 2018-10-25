<?php
class DBHandler extends StaticClass
{    
    
    //Generic Queries
    static function get_results_fromTable($tableName)
    {
        $query = "SELECT * FROM $tableName";
        return (Database::exec_query($query));
    }
}
?>