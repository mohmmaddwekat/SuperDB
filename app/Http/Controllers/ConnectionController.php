<?php

namespace App\Http\Controllers;

use App\Connection\ChangeDB;
use App\Connection\SingletonDB;
use Illuminate\Support\Facades\DB;

class ConnectionController extends Controller
{
  
    public function  index(){

      $singletonDB =  SingletonDB::getInstance();

      $connections = DB::table('connection')->get(['name','id']);
      return view('super-db.connections.index',['connections'=>$connections]);
    }    
    public function add($name){
      $singletonDB = SingletonDB::getInstance();
      
      $singletonDB->create($name);
      return DB::table('connection')->where('name','=',$name)->get(['name','id'])->toArray();
    }
    public function delete($id){
      $singletonDB = SingletonDB::getInstance();
      $connection = DB::table('connection')->where('id','=',$id)->first(['name','id']);
      $singletonDB->release($connection->name,$connection->id);
      return redirect()->route('super-db.connection.index');
    }
}
