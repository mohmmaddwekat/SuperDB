<?php
namespace App\RestoreDB\ImportDB;
use Illuminate\Support\Facades\DB;
use PDO;

class SqlFiles implements SystemFile {
     function create($tablename,$file,$id){
        $DBconnection = DB::table('connection')->where('id','=',$id)->first(['name','id']);
        $db = new PDO("mysql:host=localhost;dbname=$DBconnection->name", "root", "");
        $stmt = $db->prepare($file);
        if ($stmt->execute()){
            echo true;
        }else{ 
            echo false;
        }
    }
}
?>