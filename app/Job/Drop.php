<?php
namespace App\Job;

use Illuminate\Support\Facades\Auth;
use App\Exceptions\ErrorHandlerMsg;
use Illuminate\Support\Facades\Log;


class Drop implements JobInterface{

    public function drop($query,$mysqlConnection){

        $cant = array('super-db.connection.delete','super-db.jobs.delete-table','super-db.jobs.delete-column' );
        $roles_permissions = Auth::user()->role->permissions()->pluck('code')->toArray();
        if(!array_intersect( $cant,$roles_permissions)){
            abort(404);
        }
        if(mysqli_query($mysqlConnection, $query)){
            return true;
        } 
        if(!mysqli_query($mysqlConnection, $query)){
          return false;
        }
    }
    public function send($isSucceeded,$mysqlConnection) {
        if($isSucceeded == true){
            ErrorHandlerMsg::setLog('info'," Table Dropped",null);
            return ['success','Table Droped!'];
        } 
        if($isSucceeded == false){
          ErrorHandlerMsg::setLog('debug'," Error while performing drop query",null);
          return ['error',mysqli_error($mysqlConnection)];
        }   
    }
}



?>