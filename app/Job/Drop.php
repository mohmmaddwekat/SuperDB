<?php
namespace App\Job;

use Illuminate\Support\Facades\Auth;


class Drop implements JobInterface{


        /*
    *If query is equal to (drop), drop data in database 
    */
    public function drop($query,$mysqlConnection){

        $cant = array('super-db.connection.delete','super-db.jobs.delete-table','super-db.jobs.delete-column' );
        $roles_permissions = Auth::user()->role->permissions()->pluck('code')->toArray();
        if(!array_intersect( $cant,$roles_permissions)){
            abort(403);
        }
        if(mysqli_query($mysqlConnection, $query)){
            return true;
        } 
        if(!mysqli_query($mysqlConnection, $query)){
          return false;
        }
    }
    /*
    *if the process of (drop) succeded, return success. If not, return and error 
    */
    public function send($isSucceeded,$mysqlConnection) {
        if($isSucceeded == true){
            return ['success','Table Droped!'];
        } 
        if($isSucceeded == false){
          return ['error','Oops, Error performing query'];
        }   
    }
}
