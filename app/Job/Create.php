<?php
namespace App\Job;

use App\Rules\CheckNotConnectRole;
use Exception;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create implements Job{


    public function create($query,$link){
        if(mysqli_query($link, $query)){
            return true;
        } 
        if(!mysqli_query($link, $query)){
          return false;
        }
    }

    public function send($bool,$link) {
        if($bool == true){
            return ['success','Table Created!'];
        } 
        if($bool == false){
          return ['error',mysqli_error($link)];
        }    
    }
    
}



?>