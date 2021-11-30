<?php
namespace App\Connection;
use PDO;
use Illuminate\Support\Facades\DB;
use PDOException;

class SingletonDB implements Connection
{    
    

    /**
     * The Singleton's instance is stored in a static field. This field is an
     * array, because we'll allow our Singleton to have subclasses. Each item in
     * this array will be an instance of a specific Singleton's subclass. You'll
     * see how this works in a moment.
     */
    private static $instances = [];

    /**
     * The Singleton's constructor should always be private to prevent direct
     * construction calls with the `new` operator.
     */
    protected function __construct() { }




    public static function getInstance(): SingletonDB
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }
        return self::$instances[$cls];
    }

 
   public function create($DBName){        
        try {
            $conn = new PDO("mysql:host=localhost", env('DB_USERNAME'));
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "CREATE DATABASE $DBName";
            // use exec() because no results are returned
            $conn->exec($sql);
                        $names = [
                'name'=> $DBName
            ];
            $conn = DB::table('connection')->insert($names);
        } catch(PDOException $e) {
            echo false;
        }
    }

     public function release($DBName,$id)
    {
         if (!is_null(static::$instances)) { 
            static::$instances = null;        
            try {
                $conn = new PDO("mysql:host=localhost", env('DB_USERNAME'));
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "DROP DATABASE $DBName";
                $conn->exec($sql);
            } catch(PDOException $e) {
                echo false;
            }
            $conn = DB::table('connection')->delete($id);
            $conn = null; 
        }
    // }
}
}
?>