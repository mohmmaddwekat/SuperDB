<?php
namespace App\RestoreDB\ExportDB;


class MangeDataBase {

    public function storeSCV($numColumns,$rows,$handle){

        while($row = $rows->fetch_row()) { 
            $data= array();
            for($j=0; $j < $numColumns; $j++) { 
                $row[$j] = addslashes($row[$j]);
                $row[$j] = $row[$j];
                array_push($data, $row[$j]);
            }
            fputcsv($handle, $data);
        }
    }
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

    /**
    * 
    * set name of columns in sql file
    */
    public function storeNameOfColumns($nameColunms,$return){

        
        foreach ($nameColunms as $key => $colunm){
            if($key == (count($nameColunms)-1)){
                $return .="`$colunm`";
                break;
            }
            $return .="`$colunm`".', ';
            
        }
        return $return;
        
    }
    
    /**
    * 
    *store data to sql file 
    * 
    */ 
    public function storeDataOfSQl($rows,$return){
        foreach ($rows as $key => $row){
            $return .='(';
            foreach ($row as $index => $value){
                if($index == (count($row)-1)){
                    $return .="'$value'";
                    break;
                }
                $return .="'$value'".', ';
            }
            
            if($key == (count($rows)-1)){
                $return .=");\n";
                break;
            }
            $return .="),\n";
        }
        return $return;
    }
}
