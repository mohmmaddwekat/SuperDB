<?php
namespace App\RestoreDB\ExportDB;

use App\RestoreDB\ExportDB\ExportInterface;

class ExportAsCSV implements ExportInterface{

    public function export($tables, $db, $file){

        
        foreach($tables as $table){

            $createQuery = new MangeDataBase;
            /**
            * get all columns in table
            * then save columns in csv file , each column in new column in csv
            */
            $columnsNames = $createQuery->getAllColumns($db, $table);
            fputcsv($file, $columnsNames);

            /**
            * get rows then save them in csv
            */
            list($numColumns,$rows)= $createQuery->getAllTables($db, $table);
            
            
            $createQuery->storeCSV($numColumns,$rows,$file);
        }
    }



}
