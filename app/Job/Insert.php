<?php

namespace App\Job;

use App\Connection\ErrorHandlerMsg;


class Insert implements Job
{

        public function insert($query, $link)
        {
                if (mysqli_query($link, $query)) {
                        ErrorHandlerMsg::setLog('debug','Data inserted! ::'.$query);
                        ErrorHandlerMsg::setLog('info','Data inserted!');
                        return true;
                }
                if (!mysqli_query($link, $query)) {
                        return false;
                }
        }
        public function send($bool,$link)
        {
                if($bool == true){
                        return ['success','Data inserted!'];
                } 
                if($bool == false){
                       ErrorHandlerMsg::setLog('error',mysqli_error($link));
                      return ['error','Oops, Error performing query'];
                }              
        }
}
