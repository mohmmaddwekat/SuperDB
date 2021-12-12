<?php
namespace App\RestoreDB\ImportDB;
use Illuminate\Support\Facades\DB;
use PDO;

class ImportAsSQL implements ImportInterface {
    /*
    *Create table
    *Insert data in tablusing SQL query
    *Storedata in database
    */
     function createTable($tableName,$query,$id){
        $connectionName = DB::table('connection')->where('id','=',$id)->first(['name']);
        $mysqlConnection = new PDO("mysql:host=localhost;dbname=$connectionName->name", "root", "");
        $prepareQuery = $mysqlConnection->prepare($query);
        
        if ($prepareQuery->execute()){
            echo true;
        }else{ 
            echo false;
        }
    }
}
?>