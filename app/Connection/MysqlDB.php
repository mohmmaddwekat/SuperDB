<?php
namespace App\Connection;

use App\Exceptions\ErrorHandlerMsg;
use PDO;
use Illuminate\Support\Facades\DB;
use PDOException;

class MysqlDB implements Connection
{    
    private static $instances = [];
    public static function getInstance(): MysqlDB
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
    public function create($DBName){        
            try {
                $conn = new PDO("mysql:host=localhost", env('DB_USERNAME'));
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "CREATE DATABASE $DBName";
                $conn->exec($sql);
                $name = [
                    'name'=> $DBName
                ];
                ErrorHandlerMsg::setLog('debug',"The connection has been successfully established");
                $database = DB::table('connection')->insert($name);
                ErrorHandlerMsg::setLog('info',"$DBName connection has been added to the database");
                return $database;
            } catch(PDOException $e) {
                ErrorHandlerMsg::setLog('erorr',$e->getMessage());
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
     public function release($DBName,$id)
    {
         if (!is_null(static::$instances)) { 
            static::$instances = null;        
            try {
                $conn = new PDO("mysql:host=localhost", env('DB_USERNAME'));
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "DROP DATABASE $DBName";
                $conn->exec($sql);
                $conn = null;
                ErrorHandlerMsg::setLog('debug',"The connection has been successfully deleted");
                $database = DB::table('connection')->delete($id);
                ErrorHandlerMsg::setLog('info',"$DBName connection has been deleted from the database");
            } catch(PDOException $e) {
                ErrorHandlerMsg::setLog('erorr',$e->getMessage());
                return ErrorHandlerMsg::getErrorMsgWithLog("An error occurred The connection was not deleted");
            }
        }
    }
}
?>