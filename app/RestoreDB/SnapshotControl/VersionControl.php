<?php
namespace App\RestoreDB\SnapshotControl;

use App\RestoreDB\ExportDB\ExportAsSQL;
use App\RestoreDB\ExportDB\MangeDataBase;
use App\RestoreDB\ImportDB\ImportAsSQL;
use App\RestoreDB\ImportDB\ImportHandler;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use mysqli;


class VersionControl {
    private $DBconnection;
    private $mysqlConnection;
 
    /*
    *Constructor to create database connection using connection details (port, connection name)
    */
    function __construct($id)
    {
        $this->DBconnection = DB::table('connection')->where('id','=',$id)->first(['name','id']);
        $this->mysqlConnection = new mysqli('localhost', 'root', '', $this->DBconnection->name);
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
        list($NameDB, $tables) = $comparisonOperators->comparisonOperators($tables,$this->DBconnection,$this->mysqlConnection);
        $file = Storage::makeDirectory($this->DBconnection->name."/".$tables[0]."/");
        $file = fopen("../storage/app/".$this->DBconnection->name."/".$tables[0]."/".$NameDB."_".time().'.sql','w+');
        $sql = new ExportAsSQL;
        $sql->export($tables, $this->mysqlConnection, $file);
        fclose($file);        
    }

    /*
    *Update the newly snapshot taken
    */
    function update($file,$table,$id){
        $snapshot = new ImportAsSQL();
        $query = file_get_contents("../storage/app/".$this->DBconnection->name."/".$table."/".$file);
        $snapshot->createTable($table,$query,$id);
    }
}
?>
