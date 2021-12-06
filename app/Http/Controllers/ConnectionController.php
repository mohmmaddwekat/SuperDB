<?php

namespace App\Http\Controllers;

use App\Connection\ChangeDB;
use App\Connection\SingletonDB;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class ConnectionController extends Controller
{

  public function  index()
  {
    try {
      $roles_Abilitiles = Auth::user()->role->abilities()->pluck('code')->toArray();
      if (!in_array('super-db.connection.index', $roles_Abilitiles)) {
        abort(403);
      }
      $singletonDB =  SingletonDB::getInstance();

      $connections = DB::table('connection')->get(['name', 'id']);
      return view('super-db.connections.index', ['connections' => $connections]);
    } catch (Exception $e) {
      abort(404);
    }
  }
  public function add($name)
  {
    try {
      $roles_Abilitiles = Auth::user()->role->abilities()->pluck('code')->toArray();
      if (!in_array('super-db.connection.add', $roles_Abilitiles)) {
        abort(403);
      }
      $singletonDB = SingletonDB::getInstance();

      $singletonDB->create($name);
      return DB::table('connection')->where('name', '=', $name)->get(['name', 'id'])->toArray();
    } catch (Exception $e) {
      abort(404);
    }
  }
  public function delete($id)
  {
    try {
      $roles_Abilitiles = Auth::user()->role->abilities()->pluck('code')->toArray();
      if (!in_array('super-db.connection.delete', $roles_Abilitiles)) {
        abort(403);
      }
      $singletonDB = SingletonDB::getInstance();
      $connection = DB::table('connection')->where('id', '=', $id)->first(['name', 'id']);
      $singletonDB->release($connection->name, $connection->id);
      return redirect()->route('super-db.connection.index');
    } catch (Exception $e) {
      abort(404);
    }
  }
}
