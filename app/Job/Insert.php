<?php

namespace App\Job;
use App\Exceptions\ErrorHandlerMsg;
use Illuminate\Support\Facades\Log;



class Insert implements JobInterface
{

        public function insert($query, $mysqlConnection)
        {
                if (mysqli_query($mysqlConnection, $query)) {
                        return true;
                }
                if (!mysqli_query($mysqlConnection, $query)) {
                        return false;
                }
        }
        public function send($isSucceeded,$mysqlConnection)
        {
                if($isSucceeded == true){
                        ErrorHandlerMsg::setLog('info'," Data has been inserted to the table",null);
                        return ['success','Data inserted!'];
                } 
                if($isSucceeded == false){
                      ErrorHandlerMsg::setLog('info',"Error while performing insert query ",null);
                      return ['error',mysqli_error($mysqlConnection)];
                }              
        }
}
