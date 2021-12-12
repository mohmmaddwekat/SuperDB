<?php
namespace App\RestoreDB\ImportDB;
 
interface SystemFile {
 public function create($tablename,$file,$id);   
}
?>
