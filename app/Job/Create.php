<?php
namespace App\Job;

use App\Rules\CheckNotConnectRole;
use Exception;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create implements Job{


    public function create($query,$link){
        

        if(mysqli_query($link, $query)){
            return ['success','Table Created!'];
        } 
        if(!mysqli_query($link, $query)){
          return ['error',mysqli_error($link)];
        }
    }

    public function send($message) {
        return redirect()->route('jobs.index')->with($message[0],$message[1]);
    }
    
}



?>