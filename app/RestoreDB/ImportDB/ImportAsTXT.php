<?php
namespace App\RestoreDB\ImportDB;
use App\Job\QueryHandler;
use Illuminate\Support\Facades\DB;
use mysqli;

class ImportAsTXT implements ImportInterface {
   /*
   *Import database from text file
   *Insert data to database
   */
    function createTable($tableName,$file,$id){
        $name = str_replace(".txt","", $tableName);
        $queryHandler = new QueryHandler;
        $updateTable =new ImportAsCSV;
        $count = 0;
        while (( $data[] =fgetcsv($file)) !== false) {
                print_r($data[$count]);
                echo "<br><br>";
            if ($count == 0) {
                $updateTable->buildTableBySQLQuery($name,$queryHandler,$data[0],$id);
            }
            if ($count>0) {
                $updateTable->insertRowsBySQLQuery($name,$queryHandler,$data[0],$data[$count],$id);
            }
            $count++;
        }
        fclose($file);
    }

}
?>