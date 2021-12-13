<?php

namespace App\Http\Controllers;
use App\Exceptions\ErrorHandlerMsg;
use App\Connection\MysqlDB;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ConnectionController extends Controller
{

  public function  index()
  {
    try {
      $roles_Abilitiles = Auth::user()->role->abilities()->pluck('code')->toArray();
      if (!in_array('super-db.connection.index', $roles_Abilitiles)) {
        abort(403);
      }
      $connections = DB::table('connection')->get(['name', 'id']);
      return view('super-db.connections.index', ['connections' => $connections]);
    } catch (Exception $e) {
      ErrorHandlerMsg::setLog('erorr',$e->getMessage());
      return ErrorHandlerMsg::getErrorMsgWithLog("You must be logged in");
    }
  }
  public function add($name)
  {
      try {
      $roles_Abilitiles = Auth::user()->role->abilities()->pluck('code')->toArray();
      if (!in_array('super-db.connection.add', $roles_Abilitiles)) {
        abort(403);
      }
      $MysqlDB = MysqlDB::getInstance();
      if($MysqlDB->create($name)){
        return DB::table('connection')->where('name', '=', $name)->get(['name', 'id'])->toArray();
      }
      return [];
    } catch (Exception $e) {
    ErrorHandlerMsg::setLog('erorr',$e->getMessage());
    return [];
  }
}
  public function delete($id)
  {
    try {
      $roles_Abilitiles = Auth::user()->role->abilities()->pluck('code')->toArray();
      if (!in_array('super-db.connection.delete', $roles_Abilitiles)) {
        abort(403);
      }
      $MysqlDB = MysqlDB::getInstance();
      $connection = DB::table('connection')->where('id', '=', $id)->first(['name', 'id']);
      $MysqlDB->release($connection->name, $connection->id);
      return redirect()->route('super-db.connection.index');
    } catch (Exception $e) {
      ErrorHandlerMsg::setLog('erorr',$e->getMessage());
       abort(404);
    }
  }
}
