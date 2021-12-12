<?php
namespace App\RestoreDB\ImportDB;
 
interface ImportInterface {
 public function createTable($tablename,$file,$id);   
}
?>
