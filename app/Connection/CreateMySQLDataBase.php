<?php
namespace App\Connection;

use App\Exceptions\ErrorHandlerMsg;
use PDO;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use PDOException;

class CreateMySQLDataBase implements ConnectionInterface
{    
    private static $instances = [];
    public static function getInstance(): CreateMySQLDataBase
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }
        return self::$instances[$cls];
    }    
    /**
     * create Mysql Database 
     *
     * @param  string $DBName Connection name
     * @return bool
     */
    public function createDatabase($DBName){        
            try {
                $mysqlConnection = new PDO("mysql:host=localhost", env('DB_USERNAME'));
                $mysqlConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sqlQuery = "CREATE DATABASE $DBName";
                $mysqlConnection->exec($sqlQuery);
                $name = [
                    'name'=> $DBName
                ];
                ErrorHandlerMsg::setLog('info',"The connection has been successfully established");
                $database = DB::table('connection')->insert($name);
                ErrorHandlerMsg::setLog('info',"A connection of name $DBName has been added to the database");
                return $database;
            } catch(PDOException $e) {
                ErrorHandlerMsg::setLog('debug',"PDO Exception happened here!!");
                ErrorHandlerMsg::setLog('error',$e->getMessage());
                return false;
            }
        }
     
     /**
      * release Mysql DataBase 
      *
      * @param  string $DBName Connection name
      * @param  int $id Connection id
      * @return void
      */
     public function releaseDatabase($DBName,$id)
    {
         if (!is_null(static::$instances)) { 
            static::$instances = null;        
            try {
                $mysqlConnection = new PDO("mysql:host=localhost", env('DB_USERNAME'));
                $mysqlConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sqlQuery = "DROP DATABASE $DBName";
                $mysqlConnection->exec($sqlQuery); //execute query
                $mysqlConnection = null;
                ErrorHandlerMsg::setLog('info',"The connection has been successfully deleted");

                $database = DB::table('connection')->delete($id);
                ErrorHandlerMsg::setLog('info',"$DBName connection has been deleted from the database");
            } catch(PDOException $e) {
                ErrorHandlerMsg::setLog('error',$e->getMessage());
                return ErrorHandlerMsg::getErrorMsgWithLog("An error occurred! The connection was not deleted");
            }
        }
    }
}
?>