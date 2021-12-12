<?php
namespace App\RestoreDB\ExportDB;
use App\RestoreDB\ExportDB\ExportAsCSV;
use App\RestoreDB\ExportDB\ExportAsSQL;
use App\RestoreDB\ExportDB\MangeDataBase;

use Illuminate\Support\Facades\DB;
use mysqli;

class ExportHandler{
      /*
        * Handle export operation according to the type of file sele
        */
    public function handleExport($export, $connection_id,$tables ){
            $connectionName = DB::table('connection')->where('id', '=', $connection_id)->first(['name', 'id']);
            $db = new mysqli('localhost', 'root', '', $connectionName->name);
            $comparisonoperators = new MangeDataBase;
            list($NameDB, $tables) = $comparisonoperators->ComparisonOperators($tables, $connectionName, $db);
            if ($export == "csv") {
               
                $file = fopen('../storage/app/db/' . $NameDB . '_' . time() . '.csv', 'w+');
                $csv = new ExportAsCSV;
                $csv->export($tables, $db, $file);
            }
            if ($export == "sql") {
                $file = fopen('../storage/app/db/' . $NameDB . '_' . time() . '.sql', 'w+');
                $sql = new ExportAsSQL;
                $sql->export($tables, $db, $file);
            }
            fclose($file);
        return $connectionName;
    }


    
}



?>