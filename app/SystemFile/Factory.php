<?php
namespace App\SystemFile;
class Factory{
    public function build($name,$tablename,$id,$file){
        if ($name == "csv") {
            $sqlFiles = new CSVFiles();
            $sqlFiles->create($tablename,$file,$id);
            return ['success','Success file have been added'];
        }
         if ($name == "text") {
            $sqlFiles = new TextFiles();
            $sqlFiles->create($tablename,$file,$id);
            return ['success','Success file have been added'];
        }
        if ($name == "sql") {
            $sqlFiles = new SqlFiles();
            $sqlFiles->create($tablename,$file,$id);
            return ['success','Success file have been added'];
        }
        return ['error','Oops. Something went wrong'];
    }


    
}



?>