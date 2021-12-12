<?php
namespace App\Job;

use App\Connection\ErrorHandlerMsg;


class Alter implements Job{

    public function alter($query,$link){
        if(mysqli_query($link, $query)){
            ErrorHandlerMsg::setLog('debug','Alter Created! ::'.$query);
            ErrorHandlerMsg::setLog('info','Alter Created!');

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
          ErrorHandlerMsg::setLog('error',mysqli_error($link));
          return ['error','Oops, Error performing query'];
        }    

    }
}

?>