<?php
namespace App\Job;

use App\Exceptions\ErrorHandlerMsg;
use Illuminate\Support\Facades\Log;


class Create implements JobInterface{


    public function create($query,$mysqlConnection){
        if(mysqli_query($mysqlConnection, $query)){

            return true;
        } 
        if(!mysqli_query($mysqlConnection, $query)){
          return false;
        }
    }

    public function send($isSucceeded,$mysqlConnection) {
        if($isSucceeded == true){
            ErrorHandlerMsg::setLog('info'," Table has been created ",null);
            return ['success','Table Created!'];
        } 
        if($isSucceeded == false){
          ErrorHandlerMsg::setLog('debug',"Error while performing (create table) query ",null);
          return ['error',mysqli_error($mysqlConnection)];

        }    
    }
    
}



?>