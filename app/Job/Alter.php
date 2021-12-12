<?php
namespace App\Job;



class Alter implements JobInterface{

    public function alter($query,$mysqlConnection){
        if(mysqli_query($mysqlConnection, $query)){


            return true;
        } 
        if(!mysqli_query($mysqlConnection, $query)){
          return false;
        }    
    }
    public function send($isSucceeded,$mysqlConnection) {
        if($isSucceeded == true){
            return ['success','Alter Created!'];
        } 
        if($isSucceeded == false){
          return ['error','Oops, Error performing query'];
        }    

    }
}

?>