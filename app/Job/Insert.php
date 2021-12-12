<?php

namespace App\Job;

use App\Connection\ErrorHandlerMsg;


class Insert implements Job
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
                        return ['success','Data inserted!'];
                } 
                if($bool == false){
                      return ['error','Oops, Error performing query'];
                }              
        }
}
