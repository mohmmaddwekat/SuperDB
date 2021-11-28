<?php
namespace App\Job;

use Illuminate\Support\Facades\Schema;

class Drop implements Job{

    public function drop($query,$link){
        if(mysqli_query($link, $query)){
            return true;
        } 
        if(!mysqli_query($link, $query)){
          return false;
        }
    }
    public function send($bool,$link) {
        if($bool == true){
            return ['success','Table Droped!'];
        } 
        if($bool == false){
          return ['error',mysqli_error($link)];
        }   
    }
}



?>