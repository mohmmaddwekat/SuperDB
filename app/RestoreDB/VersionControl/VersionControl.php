<?php
namespace App\RestoreDB\snapshotControl;

use App\RestoreDB\ExportDB\ExportAsSQL;
use App\RestoreDB\ExportDB\MangeDataBase;
use App\RestoreDB\ImportDB\ImportHandler;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use mysqli;


class VersionControl {
    private $connectionName;
    private $mysqlConnection;
 
    /*
    *Constructor to create database connection using connection details (port, connection name)
    */
    function __construct($id)
    {
        $this->connectionName = DB::table('connection')->where('id','=',$id)->first(['name']);
        $this->mysqlConnection = new mysqli('localhost', 'root', '', $this->connectionName->name);
    }

    /*
        *Show connection if created successfully
        */
    function show(){
        $tables = null;
        if ($this->mysqlConnection->connect_error) {
            die("Connection with the database failed: </br>" . $this->mysqlConnection->connect_error);
        }
        if($query = $this->mysqlConnection->query('SHOW TABLES')){
        while($row = mysqli_fetch_array($query, MYSQLI_NUM)){
            $tables[] = $row[0];
        }
        }
        return $tables;
    }
    /*
    *Take snapshot by storing the database in a SQL file
    */
    function store($tables){
        $comparisonOperators =new MangeDataBase;
        list($NameDB, $tables) = $comparisonOperators->comparisonOperators($tables,$this->connectionName,$this->mysqlConnection);
        $file = Storage::makeDirectory($this->connectionName->name."/".$tables[0]."/");
        $file = fopen("../storage/app/".$this->connectionName->name."/".$tables[0]."/".$NameDB."_".time().'.sql','w+');
        $sql = new ExportAsSQL;
        $sql->export($tables, $this->mysqlConnection, $file);
        fclose($file);        
    }

    /*
    *Update the newly snapshot taken
    */
    function update($file,$table){
        $snapshot = new ImportHandler();
        $file = file_get_contents("../storage/app/".$this->connectionName->name."/".$table."/".$file);
        $snapshot->handleImport('sql',$table,$this->connectionName->id,$file);
    }

}
?>
