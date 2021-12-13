<?php
namespace App\RestoreDB\ImportDB;
use Illuminate\Support\Facades\DB;
use PDO;
use Illuminate\Support\Facades\Log;
use App\Exceptions\ErrorHandlerMsg;
use Exception;
use PhpParser\Node\Stmt\TryCatch;

class ImportAsSQL implements ImportInterface {
 
     /**
     *Create table
     *Insert data in table using SQL query
     *Store data in database
      *
      * @param  mixed $tableName
      * @param  mixed $query
      * @param  mixed $id
      * @return void
      */
     function createTable($tableName,$query,$id){

        try {
            $connectionName = DB::table('connection')->where('id','=',$id)->first(['name']);
            $mysqlConnection = new PDO("mysql:host=localhost;dbname=$connectionName->name", "root", "");
            $prepareQuery = $mysqlConnection->prepare($query);
            
            ErrorHandlerMsg::setLog('info',"preparing sql query to be inserted");
            $prepareQuery->execute();
        } catch (Exception $th) {
             ErrorHandlerMsg::setLog('error',"There is a syntax error in the query");
        }
    }
}
?>