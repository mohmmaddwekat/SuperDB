<?php
namespace App\SystemFile;
use App\Job\Factory;
use Illuminate\Support\Facades\DB;

class CSVFiles {
     function create($tablename,$columns,$id){
        $name = str_replace(".csv","", $tablename);
        $factory = new Factory;
        $query = 'CREATE TABLE '.$name.' ( ';
        foreach($columns as $key=>$column){
            if ($key == count($columns)-1) {
                 $query .= $column.' VARCHAR(255) not null';
                 break;
            }
            $query .= $column.' VARCHAR(255) not null,';
           
        }
        $query .=')';
        $DBconnection = DB::connection('conn')->table('connection')->where('id','=',$id)->first(['name','id']);
        $link = mysqli_connect("localhost", "root", "", $DBconnection->name);
        $message = $factory->factory($query,$link);
         mysqli_close($link);
    }

     function insart($tablename,$columns,$id){
        $name = str_replace(".csv","", $tablename);
        $factory = new Factory;
        $query = 'INSERT INTO '.$name.' ( ';
        foreach($columns[0] as $key=>$column){
            if ($key == count($columns[0])-1){
                $query .= $column;
                break;
            }
            $query .= $column.',';
        }
        $query .=')';
        $sql = $query;
        foreach ($columns as $key => $column){
            if($key  <= count($columns)-2 and $key > 0){
            $query .='VALUES (';
            foreach ($column as  $keys=>$row) { 
                if ($keys == count($column)-1) {
                    $query  .= "'$row'";
                    break;
                }
                $query  .= "'$row',";
                 
            }
            $query .=')';
            $DBconnection = DB::connection('conn')->table('connection')->where('id','=',$id)->first(['name','id']);
            $link = mysqli_connect("localhost", "root", "", $DBconnection->name);
            $message = $factory->factory($query,$link);
            mysqli_close($link);
            $query = $sql;
            }
        }

    }
}
?>