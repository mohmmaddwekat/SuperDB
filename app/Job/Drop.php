<?php
namespace App\Job;

use Illuminate\Support\Facades\Schema;

class Drop implements Job{

    public function drop($query,$link){
        if(mysqli_query($link, $query)){
            return ['success','Table Droped!'];
        } 
        if(!mysqli_query($link, $query)){
          return ['error',mysqli_error($link)];
        }
    }
    public function send($message,$connection) {
        return redirect()->route('jobs.index',$connection->id)->with($message[0],$message[1]);
    }
}



?>