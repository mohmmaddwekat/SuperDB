<?php
namespace App\RestoreDB\ImportDB;
class ImportHandler{
      /*
        * Handle import operation according to the type of file selected 
        */
    public function handleImport($name,$tableName,$id,$query){
        if ($name == "csv") {
            $sqlFiles = new ImportAsCSV();
            $sqlFiles->createTable($tableName,$query,$id);
            return ['success','Success file have been added'];
        }
         if ($name == "text") {
            $sqlFiles = new ImportAsTXT();
            $sqlFiles->createTable($tableName,$query,$id);
            return ['success','Success file have been added'];
        }
        if ($name == "sql") {
            $sqlFiles = new ImportAsSQL();
            $sqlFiles->createTable($tableName,$query,$id);
            return ['success','Success file have been added'];
        }
        return ['error','Oops. Something went wrong'];
    }


    
}



?>