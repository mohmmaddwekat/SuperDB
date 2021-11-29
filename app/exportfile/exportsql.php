<?php
namespace App\exportfile;

use App\exportfile\interfaceExport;

class Exportsql implements interfaceExport{

    public function export($tables, $db, $handle){

        $return = '';
        foreach($tables as $table){

            $roww = new Fun;
            list($numColumns, $result) = $roww->getalltable($db, $table);
    
            $row22 = new Fun;
            $row2 = $row22->queryCreatetable($db, $table);
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
    
        fwrite($handle,$return);
    }

}

?>