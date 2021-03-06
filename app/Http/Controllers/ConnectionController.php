<?php

namespace App\Http\Controllers;

use App\Connection\CreateMySQLDataBase;
use App\Exceptions\ErrorHandlerMsg;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ConnectionController extends Controller
{
  
  /**
   * Show all created databases
   * Only the user who has the permissions can do this
   *
   * @return mixed
   */
  public function  index()
  {
    try {
      ErrorHandlerMsg::setLog('info'," Connection controller entered");
      $roles_permissions = Auth::user()->role->permissions()->pluck('code')->toArray();
      if (!in_array('super-db.connection.index', $roles_permissions)) {
        abort(404);
      }
      $databases = DB::table('connection')->get(['name', 'id']);
      return view('super-db.connections.index', ['connections' => $databases]);
    } catch (Exception $e) {
      ErrorHandlerMsg::setLog('erorr',$e->getMessage());
      return ErrorHandlerMsg::getErrorMsgWithLog("You must be logged in");
    }
  }  


  /**
   * Create a new database
   * Only the user who has the permissions can do this
   *
   * @param  mixed $name
   * @return array
   */
  public function add($name)
  {
      try {
      $roles_permissions = Auth::user()->role->permissions()->pluck('code')->toArray();
      if (!in_array('super-db.connection.add', $roles_permissions)) {
        abort(404);
      }
      $MysqlDB = CreateMySQLDataBase::getInstance();
      if($MysqlDB->createDatabase($name)){
        return DB::table('connection')->where('name', '=', $name)->get(['name', 'id'])->toArray();
      }
      return [];
    } catch (Exception $e) {
    ErrorHandlerMsg::setLog('erorr',$e->getMessage());
    return [];
  }
}  
  /**
   * Delete an existing database 
   * Only the user who has the permissions can do this
   *
   * @param  mixed $id
   * @return mixed
   */
  public function deleteDBConnection($id)
  {
    try {
      $roles_permissions = Auth::user()->role->permissions()->pluck('code')->toArray();
      if (!in_array('super-db.connection.delete', $roles_permissions)) {
        abort(404);
      }
      $MysqlDB = CreateMySQLDataBase::getInstance();
      $connection = DB::table('connection')->where('id', '=', $id)->first(['name', 'id']);
      $MysqlDB->releaseDatabase($connection->name, $connection->id);
      ErrorHandlerMsg::setLog('info'," Database of name $connection->name has been deleted");
      return redirect()->route('super-db.connection.index');
    } catch (Exception $e) {
      ErrorHandlerMsg::setLog('debug'," Failed to delete the dataase of name $connection->name");
      ErrorHandlerMsg::setLog('erorr',$e->getMessage());
       abort(404);
    }
  }
}
