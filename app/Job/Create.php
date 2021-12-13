<?php
namespace App\Job;

use App\Exceptions\ErrorHandlerMsg;
use Illuminate\Support\Facades\Log;


class Create implements JobInterface{


    public function create($query,$link){
        if(mysqli_query($link, $query)){

            return true;
        } 
        if(!mysqli_query($link, $query)){
          return false;
        }
    }

    public function send($bool,$link) {
        if($bool == true){
            ErrorHandlerMsg::setLog('info'," Table has been created ",null);
            return ['success','Table Created!'];
        } 
        if($bool == false){
          ErrorHandlerMsg::setLog('debug',"Error while performing (create table) query ",null);
          return ['error','Oops! Error performing query'];
        }    
    }
    
}



?>