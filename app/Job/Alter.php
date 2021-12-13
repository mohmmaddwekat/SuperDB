<?php
namespace App\Job;



class Alter implements JobInterface{

    /*
    *If query is equal to (alter), update data in database 
    */

    public function alter($query,$mysqlConnection){
        if(mysqli_query($mysqlConnection, $query)){


            return true;
        } 
        if(!mysqli_query($mysqlConnection, $query)){
          return false;
        }    
    }

      /*
    *if the process of (alter) succeded, return success. If not, return and error 
    */
    public function send($isSucceeded,$mysqlConnection) {
        if($isSucceeded == true){
            return ['success','Alter Created!'];
        } 
        if($isSucceeded == false){
          return ['error','Oops, Error performing query'];
        }    

    }
}
