<?php
namespace App\RestoreDB\ImportDB;

use App\Exceptions\ErrorHandlerMsg;

class ImportHandler{   
    /**
     * Handle import operation according to the type of file selected
     *
     * @param  mixed $name
     * @param  mixed $tableName
     * @param  mixed $id
     * @return string[]
     */
    public function handleImport($name,$tableName,$id){
        if ($name == "csv") {
            $query = fopen("../storage/app/file/".$tableName, "r");
            $sqlFiles = new ImportAsCSV();
            $sqlFiles->createTable($tableName,$query,$id);
            return ['success','Success file has been added'];
        }
         if ($name == "txt") {
            $query = fopen("../storage/app/file/".$tableName, "r");
            $sqlFiles = new ImportAsTXT();
            $sqlFiles->createTable($tableName,$query,$id);
            return ['success','Success file have been added'];
        }
        if ($name == "sql") {
            $query = file_get_contents("../storage/app/file/".$tableName);
            $sqlFiles = new ImportAsSQL();
            $sqlFiles->createTable($tableName,$query,$id);
            return ['success','Success file has been added'];
        }
        ErrorHandlerMsg::setLog('debug',"Error while handling import");
        return ['error','Oops. Something went wrong'];
    }


    
}



?>