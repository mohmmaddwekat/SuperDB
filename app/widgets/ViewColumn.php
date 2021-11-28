<?php


namespace App\widgets;

use Illuminate\Support\Facades\DB;

class viewColumn{
    public function viewColumn($connection_id,$table){
        $DBconnection = DB::table('connection')->where('id','=',$connection_id)->first(['name','id']);
        $link = mysqli_connect("localhost", "root", "", $DBconnection->name);

        
        $sqlrow = mysqli_query($link,"SELECT * FROM ".$table);
        $rows = array();
        while ($row = mysqli_fetch_assoc($sqlrow)) {
            array_push($rows,$row);
        }
        $sqlcolunms = mysqli_query($link,"SHOW COLUMNS FROM ".$table);
        $colunms = array();
        while($row = mysqli_fetch_array($sqlcolunms)){
          array_push($colunms,$row);
        }
        mysqli_close($link);
        return view('jobs.viewcolumn',[
        'connection'=> $DBconnection,
        'colunms' => $colunms,
        'rows' => $rows,
        'table' =>$table
        ]);
    }
}

?>