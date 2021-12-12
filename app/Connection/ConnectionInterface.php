<?php
namespace App\Connection;

interface  ConnectionInterface {
        
      /**
      * Create connection.
      *
      * @param  string $DBName
      * @return bool
      */
     public function createDatabase($DBName);

     
     /**
      * function to remove connection according to the object call the function
      *
      * @param  string $DBName
      * @param  int $id
      * @return void
      */
     public function releaseDatabase($DBName,$id);
}

?>
