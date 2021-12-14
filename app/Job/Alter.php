<?php
namespace App\Job;
use App\Exceptions\ErrorHandlerMsg;
use Illuminate\Support\Facades\Log;



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
            ErrorHandlerMsg::setLog('info'," Table renamed ",null);
            return ['success','Alter Created!'];
        } 
        if($isSucceeded == false){
          ErrorHandlerMsg::setLog('info'," Error while performing (alter table) query ",null);
          return ['error',mysqli_error($mysqlConnection)];
        }    

    }
}

?>