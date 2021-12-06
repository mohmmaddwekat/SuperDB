<?php
namespace App\Job;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class Drop implements Job{

    public function drop($query,$link){

        $cant = array('super-db.connection.delete','super-db.jobs.delete-table','super-db.jobs.delete-column' );
        $roles_Abilitiles = Auth::user()->role->abilities()->pluck('code')->toArray();
        if(!array_intersect( $cant,$roles_Abilitiles)){
            abort(403);
        }
        if(mysqli_query($link, $query)){
            return true;
        } 
        if(!mysqli_query($link, $query)){
          return false;
        }
    }
    public function send($bool,$link) {
        if($bool == true){
            return ['success','Table Droped!'];
        } 
        if($bool == false){
          return ['error',mysqli_error($link)];
        }   
    }
}



?>