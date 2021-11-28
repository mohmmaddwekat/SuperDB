<?php

namespace App\Http\Controllers;

use App\Job\Factory;
use App\widgets\viewColumn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InsertController extends Controller
{
    public function index($id)
    {
        $connection = DB::table('connection')->where('id','=',$id)->first(['name','id']);
        return view('inserts.index',[
            'connection'=> $connection
        ]);
    }

    public function store(Request $request,$connection_id)
    {
        $DBconnection = DB::table('connection')->where('id','=',$connection_id)->first(['name','id']);

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
        $nametable = $request->post('nametable');
        $colunms = $request->post('colunm');
        $types = $request->post('type');
        $lengths = $request->post('length');
        $arrquery = array();
        $numItems = count($colunms);
        $i = 1;
        foreach( $colunms as $key => $colunm){
            array_push($arrquery,$colunm);
            if($i != $numItems){
                array_push($arrquery,$types[$key],"(".$lengths[$key]."),");
            }
            if($i == $numItems){
                array_push($arrquery,$types[$key],"(".$lengths[$key].")");
            }
            ++$i;
        }
        $query = implode(" ",$arrquery);
        $link = mysqli_connect("localhost", "root", "", $DBconnection->name);
        $query = "CREATE TABLE $nametable($query);";
        $factory = new Factory;
        $message = $factory->factory($query,$link);
        mysqli_close($link);
        return redirect()->route('inserts.index',$DBconnection->id)->with($message[0],$message[1]);

    }


    public function renameTable($connection_id, $name)
    {
        $DBconnection = DB::table('connection')->where('id','=',$connection_id)->first(['name','id']);
        return view('inserts.renameTable',[
            'connection'=> $DBconnection,
            'table' => $name
        ]);

    }
    
    public function updateTable(Request $request,$connection_id, $oldname)
    {
        $request->validate([
            'nametable' => [
                'required', 'string', 'max:255',
            ],
        ]);
        $DBconnection = DB::table('connection')->where('id','=',$connection_id)->first(['name','id']);
        $link = mysqli_connect("localhost", "root", "", $DBconnection->name);
        $newname = $request->post('nametable');
        $query = "ALTER TABLE $oldname RENAME TO $newname;";
        $factory = new Factory;
        $message = $factory->factory($query,$link);
        mysqli_close($link);
        
        if($message[0]=="error"){
            $table =$oldname;
            return redirect()->route('inserts.rename-table',[$DBconnection->id,$table ])->with($message[0],$message[1]);
        }
        return redirect()->route('jobs.index',$DBconnection->id)->with($message[0],$message[1]);
    }


    public function renameColumn($connection_id,$table, $namecolumn)
    {
        $DBconnection = DB::table('connection')->where('id','=',$connection_id)->first(['name','id']);
        return view('inserts.renameColumn',[
            'connection'=> $DBconnection,
            'namecolumn' => $namecolumn,
            'table' =>$table
        ]);
    }
    
    public function updateColumn(Request $request,$connection_id,$table, $oldnamecolumn)
    {
        $request->validate([
            'namecolumn' => [
                'required', 'string', 'max:255',
            ],
        ]);
        
        $DBconnection = DB::table('connection')->where('id','=',$connection_id)->first(['name','id']);
        $link = mysqli_connect("localhost", "root", "", $DBconnection->name);
        $newname = $request->post('namecolumn');
        $query = "ALTER TABLE $table RENAME COLUMN $oldnamecolumn TO $newname;";
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
