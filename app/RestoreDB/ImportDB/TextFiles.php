<?php
namespace App\RestoreDB\ImportDB;
use App\Job\Factory;
use Illuminate\Support\Facades\DB;
use mysqli;

class TextFiles implements SystemFile {
    
    function createTableQuery($tablename,$factory,$values,$id){
        $DBconnection = DB::table('connection')->where('id','=',$id)->first(['name','id']);
        $mysqli = mysqli_connect("localhost", "root", "", $DBconnection->name);
        if ($mysqli->query("SHOW TABLES LIKE'".$tablename."'")) {        
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
        }
         mysqli_close($mysqli);
    }     
    function create($tablename,$file,$id){


        $name = str_replace(".txt","", $tablename);
        $factory = new Factory;
        $count = 0;
        while (( $data[] =fgetcsv($file)) !== false) {
                print_r($data[$count]);
                echo "<br><br>";
            if ($count == 0) {
                $this->createTableQuery($name,$factory,$data[0],$id);
            }
            if ($count>0) {
                $this->insartTableQuery($name,$factory,$data[0],$data[$count],$id);
            }
            $count++;
        }
        fclose($file);
    }

     function insartTableQuery($tablename,$factory,$colName,$values,$id){
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
        mysqli_close($mysqli);
    }
}
?>