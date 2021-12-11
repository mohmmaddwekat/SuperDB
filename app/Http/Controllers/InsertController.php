<?php

namespace App\Http\Controllers;

use App\Connection\ErrorHandlerMsg;
use App\Job\Factory;
use App\widgets\viewColumn;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class InsertController extends Controller
{
    public function index($id)
    {
        try {
            $roles_Abilitiles = Auth::user()->role->abilities()->pluck('code')->toArray();
            if (!in_array('super-db.inserts.index', $roles_Abilitiles)) {
                abort(403);
            }
            $connection = DB::table('connection')->where('id', '=', $id)->first(['name', 'id']);
            return view('super-db.inserts.index', [
                'connection' => $connection
            ]);
        } catch (Exception $e) {
            return \App\Connection\ErrorHandlerMsg::getErrorMsgWithLog($e->getMessage());
            //abort(404);
        }
    }

    public function store(Request $request, $connection_id)
    {
        $request->validate([
            'nametable' => [
                'required', 'string', 'max:255',

            ],
            'colunm' => [
                'required', 'max:255',
            ],
            'type' => [
                'required'
            ],
            'length' => [
                'required'
            ],
        ]);
        try {
            $roles_Abilitiles = Auth::user()->role->abilities()->pluck('code')->toArray();
            if (!in_array('super-db.inserts.store', $roles_Abilitiles)) {
                abort(403);
            }
            $DBconnection = DB::table('connection')->where('id', '=', $connection_id)->first(['name', 'id']);


            $nametable = $request->post('nametable');
            $colunms = $request->post('colunm');
            $types = $request->post('type');
            $lengths = $request->post('length');
            $arrquery = array();
            $numItems = count($colunms);
            $i = 1;
            foreach ($colunms as $key => $colunm) {
                array_push($arrquery, $colunm);
                if ($i != $numItems) {
                    array_push($arrquery, $types[$key], "(" . $lengths[$key] . "),");
                }
                if ($i == $numItems) {
                    array_push($arrquery, $types[$key], "(" . $lengths[$key] . ")");
                }
                ++$i;
            }
            $query = implode(" ", $arrquery);
            $link = mysqli_connect("localhost", "root", "", $DBconnection->name);
            $query = "CREATE TABLE $nametable($query);";
            $factory = new Factory;
            $message = $factory->factory($query, $link);
            mysqli_close($link);
            return redirect()->route('super-db.inserts.index', $DBconnection->id)->with($message[0], $message[1]);
        } catch (Exception $e) {
            return ErrorHandlerMsg::getErrorMsgWithLog($e->getMessage());
        }
    }


    public function renameTable($connection_id, $name)
    {
        try {
            $roles_Abilitiles = Auth::user()->role->abilities()->pluck('code')->toArray();
            if (!in_array('super-db.inserts.rename-table', $roles_Abilitiles)) {
                abort(403);
            }
            $DBconnection = DB::table('connection')->where('id', '=', $connection_id)->first(['name', 'id']);
            return view('super-db.inserts.renameTable', [
                'connection' => $DBconnection,
                'table' => $name
            ]);
        } catch (Exception $e) {
            return \App\Connection\ErrorHandlerMsg::getErrorMsgWithLog($e->getMessage());
            // abort(404);
        }
    }

    public function updateTable(Request $request, $connection_id, $oldname)
    {
        $request->validate([
            'nametable' => [
                'required', 'string', 'max:255',
            ],
        ]);
        try {
            $roles_Abilitiles = Auth::user()->role->abilities()->pluck('code')->toArray();
            if (!in_array('super-db.inserts.updateTable', $roles_Abilitiles)) {
                abort(403);
            }


            $DBconnection = DB::table('connection')->where('id', '=', $connection_id)->first(['name', 'id']);
            $link = mysqli_connect("localhost", "root", "", $DBconnection->name);
            $newname = $request->post('nametable');
            $query = "ALTER TABLE $oldname RENAME TO $newname;";
            $factory = new Factory;
            $message = $factory->factory($query, $link);
            mysqli_close($link);

            if ($message[0] == "error") {
                $table = $oldname;
                return redirect()->route('super-db.inserts.rename-table', [$DBconnection->id, $table])->with($message[0], $message[1]);
            }
            return redirect()->route('super-db.jobs.index', $DBconnection->id)->with($message[0], $message[1]);
        } catch (Exception $e) {
            return \App\Connection\ErrorHandlerMsg::getErrorMsgWithLog($e->getMessage());
            //abort(404);
        }
    }


    public function renameColumn($connection_id, $table, $namecolumn)
    {
        try {
            $roles_Abilitiles = Auth::user()->role->abilities()->pluck('code')->toArray();
            if (!in_array('super-db.inserts.rename-column', $roles_Abilitiles)) {
                abort(403);
            }

            $DBconnection = DB::table('connection')->where('id', '=', $connection_id)->first(['name', 'id']);
            return view('super-db.inserts.renameColumn', [
                'connection' => $DBconnection,
                'namecolumn' => $namecolumn,
                'table' => $table
            ]);
        } catch (Exception $e) {
            return \App\Connection\ErrorHandlerMsg::getErrorMsgWithLog($e->getMessage());
            // abort(404);
        }
    }

    public function updateColumn(Request $request, $connection_id, $table, $oldnamecolumn)
    {
        $request->validate([
            'namecolumn' => [
                'required', 'string', 'max:255',
            ],
        ]);
        try {
            $roles_Abilitiles = Auth::user()->role->abilities()->pluck('code')->toArray();
            if (!in_array('super-db.inserts.update-column', $roles_Abilitiles)) {
                abort(403);
            }


            $DBconnection = DB::table('connection')->where('id', '=', $connection_id)->first(['name', 'id']);
            $link = mysqli_connect("localhost", "root", "", $DBconnection->name);
            $newname = $request->post('namecolumn');
            $query = "ALTER TABLE $table RENAME COLUMN $oldnamecolumn TO $newname;";
            $factory = new Factory;
            $message = $factory->factory($query, $link);
            mysqli_close($link);

            $viewcolumn = new viewColumn;
            $dataviewcolumn = $viewcolumn->viewColumn($connection_id, $table);
            return view('super-db.jobs.viewcolumn', [
                'connection' => $dataviewcolumn["connection"],
                'colunms' => $dataviewcolumn["colunms"],
                'rows' => $dataviewcolumn["rows"],
                'table' => $dataviewcolumn["table"]
            ]);
        } catch (Exception $e) {
            return \App\Connection\ErrorHandlerMsg::getErrorMsgWithLog($e->getMessage());
            // abort(404);
        }
    }
}
