<?php
namespace App\exportfile;

use App\exportfile\interfaceExport;
use App\widgets\viewColumn;

class Exportsql implements interfaceExport{

    public function export($tables, $db, $handle){

        $return = '';
        foreach($tables as $table){

            $roww = new Fun;
            list($numColumns, $result) = $roww->getalltable($db, $table);
    
            $row22 = new Fun;
            $row2 = $row22->queryCreatetable($db, $table);
            
            $return .= "DROP TABLE IF EXISTS $table;\n";
            $return .= $row2[1].";\n\n";

            $sqlcolunms = mysqli_query($db,"SHOW COLUMNS FROM ".$table);
            $colunms = array();
            while($row = mysqli_fetch_array($sqlcolunms)){
              array_push($colunms,$row);
            }
            
            $return .= "INSERT INTO $table (";

            
            foreach ($colunms as $key => $colunm){
                if($key == (count($colunms)-1)){
                    $return .="$colunm[0]";
                    break;
                }
                $return .="$colunm[0]".', ';
            }
            $return .= ") VALUES\n";


            $rows = Array();
            while ($row = $result->fetch_row()) {
                $rows[] =  $row;  
            }

            foreach ($rows as $key => $row){
                $return .='(';
                foreach ($row as $index => $value){
                    if($index == (count($row)-1)){
                        $return .="'$value'";
                        break;
                    }
                    $return .="'$value'".', ';
                }
                
                if($key == (count($rows)-1)){
                    $return .=");\n";
                    break;
                }
                $return .="),\n";
            } 

            $return .= "COMMIT;";
        }

        fwrite($handle,$return);
    }

}

?>