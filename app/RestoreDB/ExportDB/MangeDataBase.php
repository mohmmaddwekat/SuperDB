<?php
namespace App\RestoreDB\ExportDB;

use App\Exceptions\ErrorHandlerMsg;
use Illuminate\Support\Facades\DB;

class MangeDataBase {
   
    /**
     *fetch all rows store them in csv
     *
     * @param  mixed $numColumns
     * @param  mixed $rows
     * @param  mixed $file
     * @return void
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
     *
     * @param  mixed $db
     * @param  mixed $table
     * @return void
     */
    public function createTableBySQLQuery($db, $table){
        $query = $db->query("SHOW CREATE TABLE $table");
        $queryCreate = $query->fetch_row();
        return $queryCreate;
    }
  
    /**
     * get rows then save them in csv
     *
     * @param  mixed $db
     * @param  mixed $table
     * @return void
     */
    public function getAllTables($db, $table){
        $query = $db->query("SELECT * FROM $table");
        $numColumns = $query->field_count;
        return [$numColumns, $query ];
        ErrorHandlerMsg::setLog('debug',"$query rows are stored in csv");

    }

  
    /**
     * get all columns in table
     *
     * @param  mixed $db
     * @param  mixed $table
     * @return array
     */
    public function getAllColumns($db, $table){
        $sql_columns = $db->query("SHOW COLUMNS FROM ".$table);
        $columns = array();
        while($row = mysqli_fetch_array($sql_columns)){
          array_push($columns,$row[0]);
        }
        return $columns;
        ErrorHandlerMsg::setLog('debug',"Got all columns in the table");

    }

   
    /**
     * explode table/all tables 
     * rename file according to tables selected 
     *
     * @param  mixed $tables
     * @param  mixed $connectionName
     * @param  mixed $db
     * @return array
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
     * set name of columns in sql file
     *
     * @param  mixed $namecolumns
     * @param  mixed $query
     * @return string
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
        ErrorHandlerMsg::setLog('debug',"$query columns are set in SQL file");
        
    }
     
    /**
     * store data to sql file 
     *
     * @param  mixed $rows
     * @param  mixed $query
     * @return string
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
        ErrorHandlerMsg::setLog('debug',"$query is stored in SQL file");

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
