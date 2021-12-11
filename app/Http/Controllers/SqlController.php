<?php

namespace App\Http\Controllers;

use App\Job\Factory;
use App\Rules\CheckNotConnectRole;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class SqlController extends Controller
{
    public function index($id)
    {
        try {
            $roles_Abilitiles = Auth::user()->role->abilities()->pluck('code')->toArray();
            if (!in_array('super-db.sqls.index', $roles_Abilitiles)) {
                abort(403);
            }
            $DBconnection = DB::table('connection')->where('id', '=', $id)->first(['name', 'id']);
            return view('super-db.sqls.index', [
                'connection' => $DBconnection,
            ]);
        } catch (Exception $e) {
            return \App\Connection\ErrorHandlerMsg::getErrorMsgWithLog($e->getMessage());
            //abort(404);
        }
    }


    public function store(Request $request, $id)
    {
        try {
            $roles_Abilitiles = Auth::user()->role->abilities()->pluck('code')->toArray();
            if (!in_array('super-db.sqls.store', $roles_Abilitiles)) {
                abort(403);
            }
            $DBconnection = DB::table('connection')->where('id', '=', $id)->first(['name', 'id']);
            $request->validate([
                'query' => [
                    'required', 'string', 'max:255',
                    new CheckNotConnectRole($DBconnection->name),
                ],
            ]);
            $link = mysqli_connect("localhost", "root", "", $DBconnection->name);
            $query = $request->post('query');
            $factory = new Factory;
            $message = $factory->factory($query, $link);
            mysqli_close($link);

            return redirect()->route('super-db.sqls.index', $DBconnection->id)->with($message[0], $message[1]);
        } catch (Exception $e) {
            return \App\Connection\ErrorHandlerMsg::getErrorMsgWithLog($e->getMessage());
            // abort(404);
        }
    }
}
