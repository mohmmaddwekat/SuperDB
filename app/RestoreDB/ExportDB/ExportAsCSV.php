<?php
namespace App\RestoreDB\ExportDB;

use App\RestoreDB\ExportDB\ExportInterface;

class ExportAsCSV implements ExportInterface{

    public function export($tables, $db, $handle){

        
        foreach($tables as $table){

            $Createquery = new MangeDataBase;
            /**
            * get all columns in table
            * then save columns in csv file , each column in new column in csv
            */
            $nameColunms = $Createquery->getallcolumns($db, $table);
            fputcsv($handle, $nameColunms);

            /**
            * get rows then save him in csv
            */
            list($numColumns,$rows)= $Createquery->getalltable($db, $table);
            
            
            $Createquery->storeSCV($numColumns,$rows,$handle);
        }
    }



}
