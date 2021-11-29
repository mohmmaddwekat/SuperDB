<?php
namespace App\SystemFile;
 
interface SystemFile {
 public function create($tablename,$columns,$id);   
 public function insart($tablename,$columns,$id);   
}
?>
