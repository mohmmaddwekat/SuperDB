<?php
namespace App\Connection;

interface  Connection {
        
      /**
      * Create connection.
      *
      * @param  string $DBName
      * @return bool
      */
     public function create($DBName);

     
     /**
      * function to remove connection according to the object call the function
      *
      * @param  string $DBName
      * @param  int $id
      * @return void
      */
     public function release($DBName,$id);
}

?>
