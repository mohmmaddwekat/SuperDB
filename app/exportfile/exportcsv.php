<?php
namespace App\exportfile;

use App\exportfile\interfaceExport;

class Exportcsv implements interfaceExport{

    public function export($tables, $db, $handle){

        foreach($tables as $table){

            $Createquery = new Fun;
            /**
            * get query for create table 
            * then save query in csv file
            */
            $queryCreate = $Createquery->queryCreatetable($db, $table);
            fputcsv($handle,array($queryCreate[1]));

            /**
            * get all columns in table
            * then save columns in csv file , each column in new column in csv
            */
            $colunms = $Createquery->getallcolumns($db, $table);
            fputcsv($handle, $colunms);

            /**
            * get rows then save him in csv
            */
            list($numColumns,$result)= $Createquery->getalltable($db, $table);
            
            $Createquery->storeSCV($numColumns,$result,$handle);

        }
        
    }

}
