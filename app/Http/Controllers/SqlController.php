<?php

namespace App\Http\Controllers;

use App\Job\QueryHandler;
use App\Rules\CheckNotConnectRole;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Exceptions\ErrorHandlerMsg;

class SqlController extends Controller
{
    /*
    *Redirect the user to database details page 
    */
    public function index($id)
    {

        ErrorHandlerMsg::setLog('debug',"SQL controller entered");
        try {
            $roles_permissions = Auth::user()->role->permissions()->pluck('code')->toArray();
            if (!in_array('super-db.sqls.index', $roles_permissions)) {
                ErrorHandlerMsg::setLog('error',"ٌUnauthorized operation in SQL controller");
                abort(404);
            }
            $DBconnection = DB::table('connection')->where('id', '=', $id)->first(['name', 'id']);
            return view('super-db.sqls.index', [
                'connection' => $DBconnection,
            ]);
        } catch (Exception $e) {
            ErrorHandlerMsg::setLog('error',"ٌUnauthorized operation in SQL controller");
            abort(404);
        }
    }

/*
*Insert data to the database 
*Validate inserted data 
*Validate query
*/
    public function store(Request $request, $id)
    {
        $DBconnection = DB::table('connection')->where('id', '=', $id)->first(['name', 'id']);
        $request->validate([
            'query' => [
                'required', 'string', 'max:255',
                new CheckNotConnectRole($DBconnection->name),
            ],
        ]);
        try {
            $roles_permissions = Auth::user()->role->permissions()->pluck('code')->toArray();
            if (!in_array('super-db.sqls.store', $roles_permissions)) {
                abort(404);
            }

            $mysqlConnection = mysqli_connect("localhost", "root", "", $DBconnection->name);
            $query = $request->post('query');
            $queryHandler = new QueryHandler;
            $message = $queryHandler->handleQueries($query, $mysqlConnection);

            mysqli_close($mysqlConnection);

            return redirect()->route('super-db.sqls.index', $DBconnection->id)->with($message[0], $message[1]);
        } catch (Exception $e) {
            ErrorHandlerMsg::setLog('error',"incorrect query :: ".$query);
            return ErrorHandlerMsg::getErrorMsgWithLog("The query is not incorrect !! check your query :) !"); 
        }
    }
}
