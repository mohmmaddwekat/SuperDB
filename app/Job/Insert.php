<?php

namespace App\Job;

use App\Connection\ErrorHandlerMsg;


class Insert implements JobInterface
{

        /*
        *If query is equal to (insert), insert data in database 
        */
        public function insert($query,$mysqlConnection)
        {
                if (mysqli_query($mysqlConnection, $query)) {
                        return true;
                }
                if (!mysqli_query($mysqlConnection, $query)) {
                        return false;
                }
        }
        /*
        *if the process of (insert) succeded, return success. If not, return and error 
        */
        public function send($isSucceeded,$mysqlConnection)
        {
                if($isSucceeded == true){
                        return ['success','Data inserted!'];
                } 
                if($isSucceeded == false){
                      return ['error','Oops, Error performing query'];
                }              
        }
}
