<?php

namespace App\Http\Controllers;

use App\db\ComparisonOperators;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use mysqli;

class DbController extends Controller
{
    public function export($connection_id,$tables='*')
    {

        $DBconnection = DB::table('connection')->where('id','=',$connection_id)->first(['name','id']);

        $db = new mysqli('localhost', 'root', '', $DBconnection->name); 

        $comparisonoperators =new ComparisonOperators;
        list($NameDB, $tables) = $comparisonoperators->ComparisonOperators($tables,$DBconnection,$db);

        $return = '';
    
        foreach($tables as $table){

            $result = $db->query("SELECT * FROM $table");
            $numColumns = $result->field_count;
    
            $result2 = $db->query("SHOW CREATE TABLE $table");
            $row2 = $result2->fetch_row();
    
            $return .= "\n\n".$row2[1].";\n\n";
    
            for($i = 0; $i < $numColumns; $i++) { 
                while($row = $result->fetch_row()) { 
                    $return .= "INSERT INTO $table VALUES(";
                    for($j=0; $j < $numColumns; $j++) { 
                        $row[$j] = addslashes($row[$j]);
                        $row[$j] = $row[$j];
                        if (isset($row[$j]) || !isset($row[$j])) { 
                            $return .= '"'.$row[$j].'"' ;
                        }
                        if ($j < ($numColumns-1)) {
                            $return.= ',';
                        }
                    }
                    $return .= ");\n";
                }
            }
    
            $return .= "\n\n\n";
        }
    
        $handle = fopen('db/'.$NameDB.'_'.time().'.sql','w+');
        fwrite($handle,$return);
        fclose($handle);

        return redirect()->route('jobs.index',$DBconnection->id)->with("success","Database Export Successfully!");
        
    }
}
