<?php
namespace App\Job;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class Alter implements Job{

    public function alter($query,$link){
        if(mysqli_query($link, $query)){
            return true;
        } 
        if(!mysqli_query($link, $query)){
          return false;
        }    
    }
    public function send($bool,$link) {
        if($bool == true){
            return ['success','Alter Created!'];
        } 
        if($bool == false){
          return ['error',mysqli_error($link)];
        }    
        //return redirect()->route('jobs.index',$connection->id)->with($message[0],$message[1]);

    }
}

?>