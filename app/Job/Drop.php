<?php
namespace App\Job;

use Illuminate\Support\Facades\Auth;


class Drop implements Job{

    public function drop($query,$link){

        $cant = array('super-db.connection.delete','super-db.jobs.delete-table','super-db.jobs.delete-column' );
        $roles_permissions = Auth::user()->role->permissions()->pluck('code')->toArray();
        if(!array_intersect( $cant,$roles_permissions)){
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
          return ['error','Oops, Error performing query'];
        }   
    }
}



?>