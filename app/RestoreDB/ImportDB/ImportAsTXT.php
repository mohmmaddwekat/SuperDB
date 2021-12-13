<?php
namespace App\RestoreDB\ImportDB;

use App\Exceptions\ErrorHandlerMsg;
use App\Job\QueryHandler;
use Exception;

class ImportAsTXT implements ImportInterface {
  
    /**
     * Import database from text file
     * Insert data to database
     *
     * @param  mixed $tableName
     * @param  mixed $file
     * @param  mixed $id
     * @return void
     */
    function createTable($tableName,$file,$id){
        try{
        $name = str_replace(".txt","", $tableName);
        $queryHandler = new QueryHandler;
        $updateTable =new ImportAsCSV;
        $count = 0;
        while (( $data[] =fgetcsv($file)) !== false) {
            if ($count == 0) {
                $updateTable->buildTableBySQLQuery($name,$queryHandler,$data[0],$id);
            }
            if ($count>0) {
                $updateTable->insertRowsBySQLQuery($name,$queryHandler,$data[0],$data[$count],$id);
            }
            $count++;
        }
    }catch(Exception $e){
        ErrorHandlerMsg::setLog('error',$e->getMessage());
        ErrorHandlerMsg::setLog('debug',"Error while importing file.");

    }finally{
        fclose($file);
    }
    }

}
?>