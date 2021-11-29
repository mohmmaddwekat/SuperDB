<?php
namespace App\exportfile;

interface interfacefun{
    public function queryCreatetable($db, $table);
    public function getalltable($db, $table);
    public function getallcolumns($db, $table);
    public  function ComparisonOperators($tables,$DBconnection,$db);
}

?>