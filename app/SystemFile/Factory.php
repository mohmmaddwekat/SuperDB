<?php
namespace App\SystemFile;
class Factory{
    public function build($name,$tablename,$id){
        if ($name == "csv") {
            $file = fopen("../storage/app/file/".$tablename, "r");
            $sqlFiles = new CSVFiles();
            $sqlFiles->create($tablename,$file,$id);
            return ['success','Success file have been added'];
        }
         if ($name == "text") {
            $file = fopen("../storage/app/file/".$tablename, "r");
            $sqlFiles = new TextFiles();
            $sqlFiles->create($tablename,$file,$id);
            return ['success','Success file have been added'];
        }
        if ($name == "sql") {
            $sqlFiles = new SqlFiles();
            $file = file_get_contents("../storage/app/file/".$tablename);
            $sqlFiles->create($tablename,$file,$id);
            return ['success','Success file have been added'];
        }
        return ['error','Oops. Something went wrong'];
    }


    
}



?>