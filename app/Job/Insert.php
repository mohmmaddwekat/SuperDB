<?php

namespace App\Job;
use App\Exceptions\ErrorHandlerMsg;
use Illuminate\Support\Facades\Log;



class Insert implements JobInterface
{

        public function insert($query, $link)
        {
                if (mysqli_query($link, $query)) {
                        return true;
                }
                if (!mysqli_query($link, $query)) {
                        return false;
                }
        }
        public function send($bool,$link)
        {
                if($bool == true){
                        ErrorHandlerMsg::setLog('info'," Data has been inserted to the table",null);
                        return ['success','Data inserted!'];
                } 
                if($bool == false){
                      ErrorHandlerMsg::setLog('info',"Error while performing insert query ",null);
                      return ['error','Oops! Error performing query'];
                }              
        }
}
