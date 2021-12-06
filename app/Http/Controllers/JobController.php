<?php

namespace App\Http\Controllers;

use App\Job\Factory;
use App\Models\Job;
use App\Rules\CheckNotConnectRole;
use App\widgets\viewColumn;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use mysqli;
use PDO;

class JobController extends Controller
{

    public function index($id)
    {
        $roles_Abilitiles = Auth::user()->role->abilities()->pluck('code')->toArray();
        if(!in_array('super-db.jobs.index',$roles_Abilitiles)){
            abort(403);
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
    }

    public function viewColumn($table, $connection_id)
    {

        $roles_Abilitiles = Auth::user()->role->abilities()->pluck('code')->toArray();
        if(!in_array('super-db.jobs.view-column',$roles_Abilitiles)){
            abort(403);
        }
        $viewcolumn = new viewColumn;
        $dataviewcolumn = $viewcolumn->viewColumn($connection_id, $table);

        return view('super-db.jobs.viewcolumn', [
            'connection' => $dataviewcolumn["connection"],
            'colunms' => $dataviewcolumn["colunms"],
            'rows' => $dataviewcolumn["rows"],
            'table' => $dataviewcolumn["table"]
        ]);
    }



    public function deletTable($connection_id, $name)
    {
        $roles_Abilitiles = Auth::user()->role->abilities()->pluck('code')->toArray();
        if(!in_array('super-db.jobs.delete-table',$roles_Abilitiles)){
            abort(403);
        }

        $DBconnection = DB::table('connection')->where('id', '=', $connection_id)->first(['name', 'id']);
        $link = mysqli_connect("localhost", "root", "", $DBconnection->name);
        $query = "DROP TABLE $name;";
        $factory = new Factory;
        $message = $factory->factory($query, $link);
        mysqli_close($link);
        return redirect()->route('super-db.jobs.index', $DBconnection->id)->with($message[0], $message[1]);
    }


    public function deletColumn($connection_id, $table, $column)
    {
        $roles_Abilitiles = Auth::user()->role->abilities()->pluck('code')->toArray();
        if(!in_array('super-db.jobs.delete-column',$roles_Abilitiles)){
            abort(403);
        }
        $DBconnection = DB::table('connection')->where('id', '=', $connection_id)->first(['name', 'id']);
        $link = mysqli_connect("localhost", "root", "", $DBconnection->name);
        $query = "ALTER TABLE $table DROP COLUMN $column;";
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
    }
    // public function deletRow($connection_id, $table, $column)
    // {
    //     // $roles_Abilitiles = Auth::user()->role->abilities()->pluck('code')->toArray();
    //     // if(!in_array('super-db.jobs.',$roles_Abilitiles)){
    //     //     abort(403);
    //     // }
    //     $DBconnection = DB::table('connection')->where('id', '=', $connection_id)->first(['name', 'id']);
    //     $link = mysqli_connect("localhost", "root", "", $DBconnection->name);
    //     $query = "ALTER TABLE $table DROP COLUMN $column;";
    //     $factory = new Factory;
    //     $message = $factory->factory($query, $link);
    //     mysqli_close($link);

    //     $viewcolumn = new viewColumn;
    //     $dataviewcolumn = $viewcolumn->viewColumn($connection_id, $table);
    //     return view('super-db.jobs.viewcolumn', [
    //         'connection' => $dataviewcolumn["connection"],
    //         'colunms' => $dataviewcolumn["colunms"],
    //         'rows' => $dataviewcolumn["rows"],
    //         'table' => $dataviewcolumn["table"]
    //     ]);
    // }
}
