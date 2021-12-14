<?php
namespace App\RestoreDB\ExportDB;

use App\RestoreDB\ExportDB\ExportInterface;

class ExportAsSQL implements ExportInterface{
    
    /**
     * export database in file sql
     *
     * @param  mixed $tables
     * @param  mixed $db
     * @param  mixed $file
     * @return void
     */
    public function export($tables, $db, $file){

        $queries = '';
        foreach($tables as $table){

            $mangeDB = new MangeDataBase;
            list($numColumns, $data) = $mangeDB->getAllTables($db, $table);
    
            /**
            *
            * store text DROP TABLE
            */
            $queries .= "DROP TABLE IF EXISTS `$table`;\n";

            /**
            * get query for create table 
            */
            $createTableBySQl = $mangeDB->createTableBySQLQuery($db, $table);
            $queries .= $createTableBySQl[1].";\n\n";

           /**
            * get all columns in table
            * then save columns in csv file , each column in new column in csv
            */
            $nameColunms = $mangeDB->getallcolumns($db, $table);
            
            $queries .= "INSERT INTO `$table` (";

            /**
            * 
            * set name of columns in sql file
            */
            $queries = $mangeDB->storeNameOfColumns($nameColunms,$queries);

            $queries .= ") VALUES\n";

            /**
            * 
            * fetch all sql rows to array
            * values of rows (data)
            */  
            $rows = Array();          
            while ($row = $data->fetch_row()) {
                $rows[] =  $row;  
            }
           
            /**
            * 
            *store data to sql file 
            * 
            */ 
            $queries = $mangeDB->storeDataOfSQl($rows,$queries);

            $queries .= "COMMIT;";
        }
        fwrite($file,$queries);
    }

}

?>