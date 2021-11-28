<?php

namespace App\Http\Controllers;

use App\Job\Factory;
use App\Models\Job;
use App\Rules\CheckNotConnectRole;
use App\widgets\viewColumn;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use mysqli;
use PDO;

class JobController extends Controller
{


    public function index($id)
    {
        $DBconnection = DB::table('connection')->where('id','=',$id)->first(['name','id']);
        $link = mysqli_connect("localhost", "root", "", $DBconnection->name);
        $result = mysqli_query($link ,"show tables");
        $tables = array();
        while($table = mysqli_fetch_array($result)) {
            array_push($tables,$table[0]);
        }
        mysqli_close($link);
        return view('jobs.index',[
        'connection'=> $DBconnection,
        'tables' => $tables
        ]);
    }

    public function viewColumn($table,$connection_id)
    {
        
        $viewcolumn = new viewColumn;
        $dataviewcolumn = $viewcolumn->viewColumn($connection_id,$table);
        return view('jobs.viewcolumn',[
        'connection'=> $dataviewcolumn["connection"],
        'colunms' => $dataviewcolumn["colunms"],
        'rows' => $dataviewcolumn["rows"],
        'table' =>$dataviewcolumn["table"]
        ]);
    }
     

    
    public function deletTable($connection_id,$name)
    {
        $DBconnection = DB::table('connection')->where('id','=',$connection_id)->first(['name','id']);
        $link = mysqli_connect("localhost", "root", "", $DBconnection->name);
        $query = "DROP TABLE $name;";
        $factory = new Factory;
        $message = $factory->factory($query,$link);
        mysqli_close($link);
        return redirect()->route('jobs.index',$DBconnection->id)->with($message[0],$message[1]);

    }


    public function deletColumn($connection_id,$table,$column)
    {
        $DBconnection = DB::table('connection')->where('id','=',$connection_id)->first(['name','id']);
        $link = mysqli_connect("localhost", "root", "", $DBconnection->name);
        $query = "ALTER TABLE $table DROP COLUMN $column;";
        $factory = new Factory;
        $message = $factory->factory($query,$link);
        mysqli_close($link);

        $viewcolumn = new viewColumn;
        $dataviewcolumn = $viewcolumn->viewColumn($connection_id,$table);
        return view('jobs.viewcolumn',[
        'connection'=> $dataviewcolumn["connection"],
        'colunms' => $dataviewcolumn["colunms"],
        'rows' => $dataviewcolumn["rows"],
        'table' =>$dataviewcolumn["table"]
        ]);
    }
    public function deletRow($connection_id,$table,$column)
    {
        $DBconnection = DB::table('connection')->where('id','=',$connection_id)->first(['name','id']);
        $link = mysqli_connect("localhost", "root", "", $DBconnection->name);
        $query = "ALTER TABLE $table DROP COLUMN $column;";
        $factory = new Factory;
        $message = $factory->factory($query,$link);
        mysqli_close($link);

        $viewcolumn = new viewColumn;
        $dataviewcolumn = $viewcolumn->viewColumn($connection_id,$table);
        return view('jobs.viewcolumn',[
        'connection'=> $dataviewcolumn["connection"],
        'colunms' => $dataviewcolumn["colunms"],
        'rows' => $dataviewcolumn["rows"],
        'table' =>$dataviewcolumn["table"]
        ]);
    }
    
  
    

    
}