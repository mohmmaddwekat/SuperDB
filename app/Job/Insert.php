<?php

namespace App\Job;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

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
                        return ['success','INSERTed data!'];
                } 
                if($bool == false){
                      return ['error',mysqli_error($link)];
                }              
        }
}
