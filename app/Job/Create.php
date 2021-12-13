<?php
namespace App\Job;

use App\Connection\ErrorHandlerMsg;


class Create implements JobInterface{

    /*
    *If query is equal to (create), create data in database 
    */
    public function create($query,$mysqlConnection){
        if(mysqli_query($mysqlConnection, $query)){

            return true;
        } 
        if(!mysqli_query($mysqlConnection, $query)){
          return false;
        }
    }
      /*
    *if the process of (create) succeded, return success. If not, return and error 
    */
    public function send($isSucceeded,$mysqlConnection){
        if($isSucceeded == true){
            return ['success','Table Created!'];
        } 
        if($isSucceeded == false){
          return ['error','Oops, Error performing query'];
        }    
    }
    
}



?>