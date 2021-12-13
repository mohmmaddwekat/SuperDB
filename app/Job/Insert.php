<?php

namespace App\Job;



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
                        return ['success','Data inserted!'];
                } 
                if($bool == false){
                      return ['error','Oops, Error performing query'];
                }              
        }
}
