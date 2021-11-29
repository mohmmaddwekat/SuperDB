<?php

namespace App\Http\Controllers;

use App\db\ComparisonOperators;
use App\exportfile\Exportcsv;
use App\exportfile\Exportsql;
use App\exportfile\Fun;
use Illuminate\Support\Facades\DB;
use mysqli;

class DbController extends Controller
{
    public function export($connection_id,$export,$tables='*')
    {

        $DBconnection = DB::table('connection')->where('id','=',$connection_id)->first(['name','id']);
        $db = new mysqli('localhost', 'root', '', $DBconnection->name); 

        $comparisonoperators =new Fun;
        list($NameDB, $tables) = $comparisonoperators->ComparisonOperators($tables,$DBconnection,$db);

        if($export == "csv"){
            $handle = fopen('db/'.$NameDB.'_'.time().'.csv','w+');
            $csv = new Exportcsv;
            $csv->export($tables, $db, $handle);
        }
        if($export == "sql"){
            $handle = fopen('db/'.$NameDB.'_'.time().'.sql','w+');
            $sql = new Exportsql;
            $sql->export($tables, $db, $handle);
        }
        fclose($handle);

        return redirect()->route('jobs.index',$DBconnection->id)->with("success","Database Export Successfully!");
        
    }

}
