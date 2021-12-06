<?php

namespace App\Http\Controllers;

use App\Connection\ChangeDB;
use App\Connection\SingletonDB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class ConnectionController extends Controller
{
  
    public function  index(){

      $roles_Abilitiles = Auth::user()->role->abilities()->pluck('code')->toArray();
      if(!in_array('super-db.connection.index',$roles_Abilitiles)){
          abort(403);
      }
      $singletonDB =  SingletonDB::getInstance();

      $connections = DB::table('connection')->get(['name','id']);
      return view('super-db.connections.index',['connections'=>$connections]);
    }    
    public function add($name){
      $roles_Abilitiles = Auth::user()->role->abilities()->pluck('code')->toArray();
      if(!in_array('super-db.connection.add',$roles_Abilitiles)){
          abort(403);
      }
      $singletonDB = SingletonDB::getInstance();
      
      $singletonDB->create($name);
      return DB::table('connection')->where('name','=',$name)->get(['name','id'])->toArray();
    }
    public function delete($id){
      $roles_Abilitiles = Auth::user()->role->abilities()->pluck('code')->toArray();
      if(!in_array('super-db.connection.delete',$roles_Abilitiles)){
          abort(403);
      }
      $singletonDB = SingletonDB::getInstance();
      $connection = DB::table('connection')->where('id','=',$id)->first(['name','id']);
      $singletonDB->release($connection->name,$connection->id);
      return redirect()->route('super-db.connection.index');
    }
}

