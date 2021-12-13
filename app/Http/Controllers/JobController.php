<?php

namespace App\Http\Controllers;

use App\Job\QueryHandler;
use App\widgets\viewColumn;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PDO;
use App\Exceptions\ErrorHandlerMsg;

class JobController extends Controller
{

    public function index($id)
    {
        try {
            ErrorHandlerMsg::setLog('debug',"Job controller entered");

            $roles_permissions = Auth::user()->role->permissions()->pluck('code')->toArray();
            if (!in_array('super-db.jobs.index', $roles_permissions)) {
                abort(404);
            }
            $DBconnection = DB::table('connection')->where('id', '=', $id)->first(['name', 'id']);
            $link = mysqli_connect("localhost", "root", "", $DBconnection->name);
            $result = mysqli_query($link, "show tables");
            $tables = array();
            while ($table = mysqli_fetch_array($result)) {
                array_push($tables, $table[0]);
            }

            mysqli_close($link);
            return view('super-db.jobs.index', [
                'connection' => $DBconnection,
                'tables' => $tables
            ]);
        } catch (Exception $e) {
            abort(404);
        }
    }

    public function viewColumn($table, $connection_id)
    {
        try {
            $roles_permissions = Auth::user()->role->permissions()->pluck('code')->toArray();
            if (!in_array('super-db.jobs.view-column', $roles_permissions)) {
                abort(404);
            }
            $viewcolumn = new viewColumn;
            $dataviewcolumn = $viewcolumn->viewColumn($connection_id, $table);

            return view('super-db.jobs.viewcolumn', [
                'connection' => $dataviewcolumn["connection"],
                'colunms' => $dataviewcolumn["colunms"],
                'rows' => $dataviewcolumn["rows"],
                'table' => $dataviewcolumn["table"]
            ]);
        } catch (Exception $e) {
            abort(404);
        }
    }


    public function versionControl($table, $id)
    {

        try {
            $DBconnection = DB::table('connection')->where('id', '=', $id)->first(['name', 'id']);
            $files = Storage::files($DBconnection->name . "/" . $table . "/");
            foreach ($files as $path) {
                $file[] = str_replace($DBconnection->name . "/" . $table . "/", "", "$path");
            }
            return view('super-db.versionControl.update', ['files' => $file, 'table' => $table, 'id' => $id]);
        } catch (Exception $e) {
              abort(404);
        }
    }


    public function deletTable($connection_id, $name)
    {
        try {
            $roles_permissions = Auth::user()->role->permissions()->pluck('code')->toArray();
            if (!in_array('super-db.jobs.delete-table', $roles_permissions)) {
                abort(404);
            }

            $DBconnection = DB::table('connection')->where('id', '=', $connection_id)->first(['name', 'id']);
            $link = mysqli_connect("localhost", "root", "", $DBconnection->name);
            $query = "DROP TABLE $name;";
            $factory = new QueryHandler;
            $message = $factory->handleQueries($query, $link);
            mysqli_close($link);
            return redirect()->route('super-db.jobs.index', $DBconnection->id)->with($message[0], $message[1]);
        } catch (Exception $e) {
             abort(404);
        }
    }


    public function deletColumn($connection_id, $table, $column)
    {
        try {
            $roles_permissions = Auth::user()->role->permissions()->pluck('code')->toArray();
            if (!in_array('super-db.jobs.delete-column', $roles_permissions)) {
                abort(404);
            }
            $DBconnection = DB::table('connection')->where('id', '=', $connection_id)->first(['name', 'id']);
            $link = mysqli_connect("localhost", "root", "", $DBconnection->name);
            $query = "ALTER TABLE $table DROP COLUMN $column;";
            $factory = new QueryHandler;
            $message = $factory->handleQueries($query, $link);
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
            abort(404);
        }
    }
}
