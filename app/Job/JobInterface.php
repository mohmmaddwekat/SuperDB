<?php
namespace App\Job;

interface JobInterface{
    public function send($isSucceeded,$mysqlConnection);
}

?>