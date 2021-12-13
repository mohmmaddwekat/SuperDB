<?php
namespace App\RestoreDB\ExportDB;

interface ExportInterface{
    public function export($tables, $db, $handle);
}


?>