<?php
namespace App\RestoreDB\ImportDB;
use Illuminate\Support\Facades\DB;
use PDO;
use Illuminate\Support\Facades\Log;
use App\Exceptions\ErrorHandlerMsg;

class ImportAsSQL implements ImportInterface {
    /*
    *Create table
    *Insert data in table using SQL query
    *Store data in database
    */
     function createTable($tableName,$query,$id){
        $connectionName = DB::table('connection')->where('id','=',$id)->first(['name']);
        $mysqlConnection = new PDO("mysql:host=localhost;dbname=$connectionName->name", "root", "");
        $prepareQuery = $mysqlConnection->prepare($query);
        
        ErrorHandlerMsg::setLog('info',"preparing sql query to be inserted");
        if ($prepareQuery->execute()){
            echo true;
        }else{ 
            echo false;
        }
    }
}
?>