<?php
namespace App\exportfile;


class Fun implements interfacefun{

    /**
    * get query for create table 
    */
    public function queryCreatetable($db, $table){
        $sqli_query = $db->query("SHOW CREATE TABLE $table");
        $queryCreate = $sqli_query->fetch_row();
        return $queryCreate;
    }

    /**
    * get rows then save him in csv
    */
    public function getalltable($db, $table){
        $result = $db->query("SELECT * FROM $table");
        $numColumns = $result->field_count;
        return [$numColumns, $result ];
    }


    /**
    * get all columns in table
    */
    public function getallcolumns($db, $table){
        $sql_colunms = $db->query("SHOW COLUMNS FROM ".$table);
        $colunms = array();
        while($row = mysqli_fetch_array($sql_colunms)){
          array_push($colunms,$row[0]);
        }
        return $colunms;
    }

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
