<?php
namespace App\RestoreDB\ExportDB;

use App\Exceptions\ErrorHandlerMsg;
use App\RestoreDB\ExportDB\ExportInterface;

class ExportAsCSV implements ExportInterface{
        
    /**
     * export database in file csv
     *
     * @param  mixed $tables
     * @param  mixed $db
     * @param  mixed $file
     * @return void
     */
    public function export($tables, $db, $file){

        
        foreach($tables as $table){

            $createQuery = new MangeDataBase;
            /**
            * get all columns in table
            * then save columns in csv file , each column in new column in csv
            */
            $columnsNames = $createQuery->getAllColumns($db, $table);
            fputcsv($file, $columnsNames);
            ErrorHandlerMsg::setLog('debug',$columnsNames[0]."are stored in csv");

            /**
            * get rows then save them in csv
            */
            list($numColumns,$rows)= $createQuery->getAllTables($db, $table);
            
            $createQuery->storeCSV($numColumns,$rows,$file);
            ErrorHandlerMsg::setLog('debug',"Rows are stored in csv");

        }
    }



}
