<?php
namespace App\exportfile;

use App\exportfile\interfaceExport;

class Exportcsv implements interfaceExport{

    public function export($tables, $db, $handle){

        foreach($tables as $table){

            /**
            * get query for create table 
            * then save query in csv file
            */
            $resultqueryCreate = new Fun;
            $queryCreate = $resultqueryCreate->queryCreatetable($db, $table);
            fputcsv($handle,array($queryCreate[1]));

            /**
            * get all columns in table
            * then save columns in csv file , each column in new column in csv
            */
            $resultgetallcolumns = new Fun;
            $colunms = $resultgetallcolumns->getallcolumns($db, $table);
            fputcsv($handle, $colunms);

            /**
            * get rows then save him in csv
            */
            $resultalltable = new Fun;
            list($numColumns,$result)= $resultalltable->getalltable($db, $table);
 
            
            for($i = 0; $i < $numColumns; $i++) { 
                
                while($row = $result->fetch_row()) { 
                    $return= array();
                    for($j=0; $j < $numColumns; $j++) { 
                        $row[$j] = addslashes($row[$j]);
                        $row[$j] = $row[$j];
                        array_push($return, $row[$j]);

                    }
                    fputcsv($handle, $return);
                }
            }



        }
        
    }

}
