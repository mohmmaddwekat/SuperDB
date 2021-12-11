<?php
namespace App\Job;

use App\Connection\ErrorHandlerMsg;
use Illuminate\Support\Facades\Auth;


class Drop implements Job{

    public function drop($query,$link){

        $cant = array('super-db.connection.delete','super-db.jobs.delete-table','super-db.jobs.delete-column' );
        $roles_Abilitiles = Auth::user()->role->abilities()->pluck('code')->toArray();
        if(!array_intersect( $cant,$roles_Abilitiles)){
            abort(403);
        }
        if(mysqli_query($link, $query)){
            ErrorHandlerMsg::setLog('debug','Table Droped! ::'.$query);
            ErrorHandlerMsg::setLog('info','Table Droped!');
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
            ErrorHandlerMsg::setLog('error',mysqli_error($link));
          return ['error','Oops, Error performing query'];
        }   
    }
}



?>