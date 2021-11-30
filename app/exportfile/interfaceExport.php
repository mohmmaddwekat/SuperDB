<?php
namespace App\exportfile;

interface interfaceExport{
    public function export($tables, $db, $handle);
}


?>