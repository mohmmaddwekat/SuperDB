<?php
namespace App\db;

class ComparisonOperators{
    public  function ComparisonOperators($tables,$DBconnection,$db)
    {
        if($tables != '*') { 
            $NameDB = $tables.'_table';
            $tables = is_array($tables)?$tables:explode(',',$tables);
        }
        if($tables == '*') { 
            $tables = array();
            $result = $db->query("SHOW TABLES");
            while($row = $result->fetch_row()) { 
                $tables[] = $row[0];
            }
            $NameDB =$DBconnection->name.'_db';
        } 
        return [$NameDB, $tables];
    }
}


?>