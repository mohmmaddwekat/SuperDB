<?php
namespace App\Job;

use Illuminate\Support\Facades\Auth;
use App\Exceptions\ErrorHandlerMsg;
use Illuminate\Support\Facades\Log;


class Drop implements JobInterface{

    public function drop($query,$link){

        $cant = array('super-db.connection.delete','super-db.jobs.delete-table','super-db.jobs.delete-column' );
        $roles_permissions = Auth::user()->role->permissions()->pluck('code')->toArray();
        if(!array_intersect( $cant,$roles_permissions)){
            abort(404);
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
            ErrorHandlerMsg::setLog('info'," Table Dropped",null);
            return ['success','Table Droped!'];
        } 
        if($bool == false){
          ErrorHandlerMsg::setLog('debug'," Error while performing drop query",null);
          return ['error','Oops! Error performing query'];
        }   
    }
}



?>