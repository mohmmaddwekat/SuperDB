<?php
namespace App\RestoreDB\ImportDB;

use App\Exceptions\ErrorHandlerMsg;
use App\Job\Factory;
use Exception;
use Illuminate\Support\Facades\DB;

class CSVFiles implements SystemFile {
    function buildTableQuery($tablename,$factory,$values,$id){
        try{
            $DBconnection = DB::table('connection')->where('id','=',$id)->first(['name','id']);
            $mysqli = mysqli_connect("localhost", "root", "", $DBconnection->name);
            // if ($mysqli->query("SHOW TABLES LIKE'".$tablename."'")) {        
                $query = 'CREATE TABLE '.$tablename.' ( ';
                foreach($values as $key=>$value){
                    if ($key == count($values)-1) {
                        $query .= $value.' VARCHAR(255) not null';
                        break;
                    }
                    $query .= $value.' VARCHAR(255) not null,';
                }
                $query .=')';
                $factory->factory($query,$mysqli);
                ErrorHandlerMsg::setLog('debug',"The table has been successfully established");
            // }
            
        }catch(Exception $e){
            ErrorHandlerMsg::setLog('erorr',$e->getMessage());
        }finally{
            mysqli_close($mysqli);
        }

    }     
    function create($tablename,$file,$id){
        $name = str_replace(".csv","", $tablename);
        $factory = new Factory;
        $count = 0;

        while (($data[] = fgetcsv($file)) !== false) {
            if ($count == 0) {
                $this->buildTableQuery($name,$factory,$data[0],$id);
            }
            if ($count>0) {
                $this->insartTableQuery($name,$factory,$data[0],$data[$count],$id);
            }
            $count++;
        }
        fclose($file);
    }

     function insartTableQuery($tablename,$factory,$colName,$values,$id){
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
            $DBconnection = DB::table('connection')->where('id','=',$id)->first(['name','id']);
            $mysqli = mysqli_connect("localhost", "root", "", $DBconnection->name);
            $factory->factory($query,$mysqli);
         }catch(Exception $e){

         }finally{
             mysqli_close($mysqli);
         }
        
        
    }
}
?>