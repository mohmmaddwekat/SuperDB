<?php
namespace App\RestoreDB\ImportDB;

use App\Exceptions\ErrorHandlerMsg;
use App\Job\QueryHandler;
use Exception;
use Illuminate\Support\Facades\DB;

class ImportAsCSV implements ImportInterface {
    /*
    *Create table by executing SQL query
    */
    function buildTableBySQLQuery($tablename,$queryHandler,$values,$id){
        try{
            $connectionName = DB::table('connection')->where('id','=',$id)->first(['name']);
            $mysqlConnection = mysqli_connect("localhost", "root", "", $connectionName->name);
                $query = 'CREATE TABLE '.$tablename.' ( ';
                foreach($values as $key=>$value){
                    if ($key == count($values)-1) {
                        $query .= $value.' VARCHAR(255) not null';
                        break;
                    }
                    $query .= $value.' VARCHAR(255) not null,';
                }
                $query .=')';
                $queryHandler->handleQueries($query,$mysqlConnection);
                ErrorHandlerMsg::setLog('info',"The table has been successfully established");            
        }catch(FileException $e){
            ErrorHandlerMsg::setLog('error',$e->getMessage());
        }finally{
            mysqli_close($mysqlConnection);
        }

    }     

      /*
   *Import database from csv file
   */
    function createTable($tablename,$file,$id){
        try{
        $name = str_replace(".csv","", $tablename);
        $queryHandler = new QueryHandler;
        $count = 0;

        while (($data[] = fgetcsv($file)) !== false) {
            if ($count == 0) {
                $this->buildTableBySQLQuery($name,$queryHandler,$data[0],$id);
            }
            if ($count>0) {
                $this->insertRowsBySQLQuery($name,$queryHandler,$data[0],$data[$count],$id);
            }
            $count++;
        }
    }catch(FileException $e){
        ErrorHandlerMsg::setLog('error',$e->getMessage());
        ErrorHandlerMsg::setLog('debug',"Error while importing file.");
        throw new FileExcpetion($msg,$query,$mysqlConnection);

    }finally{
        fclose($file);
    }

 }
/*
*Insert data to database by executing SQL query
*/
     function insertRowsBySQLQuery($tablename,$queryHandler,$colName,$values,$id){
         try{
            $query = 'INSERT INTO '.$tablename.' ( ';
            foreach($colName as $key=>$column){
                if ($key == count($colName)-1){
                    $query .= $column;
                    break;
                }
                $query .= $column.',';
            }
            $query .=')VALUES (';
            foreach ($values as $key=>$value){
                if ($key == count($values)-1) {
                    $query  .= "'$value'";
                    break;
                }
                $query  .= "'$value',";   
            }
            $query .=')';
            $connectionName = DB::table('connection')->where('id','=',$id)->first(['name']);
            $mysqlConnection = mysqli_connect("localhost", "root", "", $connectionName->name);
            $queryHandler->handleQueries($query,$mysqlConnection);

            ErrorHandlerMsg::setLog('info',"$mysqlConnection has been created",null);
         }catch(Exception $e){
             ErrorHandlerMsg::setLog('error',$e->getMessage());
             ErrorHandlerMsg::setLog('info',"Error creating $mysqlConnection connection",null);
         }finally{
             mysqli_close($mysqlConnection);
         }
        
        
    }
}
?>