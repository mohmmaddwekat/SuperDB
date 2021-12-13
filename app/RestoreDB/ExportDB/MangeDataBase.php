<?php
namespace App\RestoreDB\ExportDB;

use Illuminate\Support\Facades\DB;

class MangeDataBase {
 /*
 *fetch all rows 
 *store them in csv
 */
    public function storeCSV($numColumns,$rows,$file){

        while($row = $rows->fetch_row()) { 
            $data= array();
            for($j=0; $j < $numColumns; $j++) { 
                $row[$j] = addslashes($row[$j]);
                $row[$j] = $row[$j];
                array_push($data, $row[$j]);
            }
            fputcsv($file, $data);
        }
    }
    /**
    * get query for create table 
    */
    public function createTableBySQLQuery($db, $table){
        $query = $db->query("SHOW CREATE TABLE $table");
        $queryCreate = $query->fetch_row();
        return $queryCreate;
    }

    /**
    * get rows then save them in csv
    */
    public function getAllTables($db, $table){
        $query = $db->query("SELECT * FROM $table");
        $numColumns = $query->field_count;
        return [$numColumns, $query ];
    }


    /**
    * get all columns in table
    */
    public function getAllColumns($db, $table){
        $sql_columns = $db->query("SHOW COLUMNS FROM ".$table);
        $columns = array();
        while($row = mysqli_fetch_array($sql_columns)){
          array_push($columns,$row[0]);
        }
        return $columns;
    }

    /*
    *explode table/all tables 
    *rename file according to tables selected 
    */
    public  function comparisonOperators($tables,$connectionName,$db)
    {
        if($tables != '*') { 
            $NameDB = $tables.'_table';
            $tables = is_array($tables)?$tables:explode(',',$tables);
        }
        if($tables == '*') { 
            $tables = array();
            $query = $db->query("SHOW TABLES");
            while($row = $query->fetch_row()) { 
                $tables[] = $row[0];
            }
            $NameDB =$connectionName->name.'_db';
        } 
        
         return [$NameDB, $tables];
    }

    /**
    * 
    * set name of columns in sql file
    */
    public function storeNameOfColumns($namecolumns,$query){

        
        foreach ($namecolumns as $key => $column){
            if($key == (count($namecolumns)-1)){
                $query .="`$column`";
                break;
            }
            $query .="`$column`".', ';
            
        }
        return $query;
        
    }
    
    /**
    * 
    *store data to sql file 
    * 
    */ 
    public function storeDataOfSQl($rows,$query){
        foreach ($rows as $key => $row){
            $query .='(';
            foreach ($row as $index => $value){
                if($index == (count($row)-1)){
                    $query .="'$value'";
                    break;
                }
                $query .="'$value'".', ';
            }
            
            if($key == (count($rows)-1)){
                $query .=");\n";
                break;
            }
            $query .="),\n";
        }
        return $query;
    }

    /*
    *Show (display) all columns , rows, and connection details in a specific table 
    */
    public function showDatabaseDetails($connection_id,$table){
        $connectionDetails = DB::table('connection')->where('id','=',$connection_id)->first(['name','id']);
        $mysqlConnection = mysqli_connect("localhost", "root", "", $connectionDetails->name); 
        $sqlrow = mysqli_query($mysqlConnection,"SELECT * FROM ".$table);
        $rows = array();
        while ($row = mysqli_fetch_assoc($sqlrow)) {
            array_push($rows,$row);
        }

        $sqlColumns = mysqli_query($mysqlConnection,"SHOW COLUMNS FROM ".$table);
        $colunms = array();
        while($row = mysqli_fetch_array($sqlColumns)){
          array_push($colunms,$row);
        }
        mysqli_close($mysqlConnection);
        return [
        'connection'=> $connectionDetails,
        'colunms' => $colunms,
        'rows' => $rows,
        'table' =>$table
        ];
    }
}
