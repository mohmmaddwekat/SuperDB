<?php
namespace App\Connection;
use App\Connection\SingletonDB;
use PDO;
use PhpParser\Node\Expr\Cast\Double;

 class CreateDB{
    // private string $DBName;
    // private int $DBId;
     static $listDB= array();
    public function create($DBName)
    {
        
        // Check connection    
        $conn = SingletonDB::getInstance();
        if($conn->create($DBName)){
            // set the PDO error mode to exception    
            $sql = "CREATE DATABASE $DBName";
            $conn->getConn()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->getConn()->exec($sql);
            $DBId = rand(1, 1000000);
            // shuffle($id);
            $DB = [
                $DBId,
                $DBName,
            ];
            array_push(static::$listDB,$DB);
            print_r(static::$listDB);
            return true;
        } else {
            return false;
        }
}

    // public function release($DBName)
    // {
    //      if (!is_null(static::$instance)) { 
    //         static::$instance = null;        
    //         try {
    //             $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //             $sql = "DROP DATABASE $DBName";
    //             $this->conn->exec($sql);
    //             echo "Database deleted successfully";
    //         } catch(PDOException $e) {
    //             echo "<br>" . $e->getMessage();
    //         }
    //         $this->conn = null; 
    //     }
    // }

       
    
}
?>