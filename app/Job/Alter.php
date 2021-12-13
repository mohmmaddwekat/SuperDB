<?php
namespace App\Job;



class Alter implements Job{

    public function alter($query,$link){
        if(mysqli_query($link, $query)){


            return true;
        } 
        if(!mysqli_query($link, $query)){
          return false;
        }    
    }
    public function send($bool,$link) {
        if($bool == true){
            return ['success','Alter Created!'];
        } 
        if($bool == false){
          return ['error','Oops, Error performing query'];
        }    

    }
}

?>