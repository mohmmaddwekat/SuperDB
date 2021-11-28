<?php
namespace App\Job;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class Alter implements Job{

    public function alter($query,$link){
        if(mysqli_query($link, $query)){
            return ['success','Alter Created!'];
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