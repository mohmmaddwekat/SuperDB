<?php
namespace App\Job;

use App\Connection\ErrorHandlerMsg;


class Create implements Job{


    public function create($query,$link){
        if(mysqli_query($link, $query)){
            ErrorHandlerMsg::setLog('debug','Table Created! ::'.$query);
            ErrorHandlerMsg::setLog('info','Table Created!');

            return true;
        } 
        if(!mysqli_query($link, $query)){
          return false;
        }
    }

    public function send($bool,$link) {
        if($bool == true){
            return ['success','Table Created!'];
        } 
        if($bool == false){
        ErrorHandlerMsg::setLog('error',mysqli_error($link));
          return ['error','Oops, Error performing query'];
        }    
    }
    
}



?>