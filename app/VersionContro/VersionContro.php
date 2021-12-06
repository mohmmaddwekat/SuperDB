<?php
namespace App\VersionContro;

use App\exportfile\Exportsql;
use App\exportfile\Fun;
use App\SystemFile\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use mysqli;
use PDO;

class VersionContro {
    private $DBconnection;
    private $conn;
    function __construct($id)
    {
        $this->DBconnection = DB::table('connection')->where('id','=',$id)->first(['name','id']);
        $this->conn = new mysqli('localhost', 'root', '', $this->DBconnection->name);
    }
    function show(){
        $tables = null;
        if ($this->conn->connect_error) {
            die("Connection with the database failed: </br>" . $this->conn->connect_error);
        }
        if($result = $this->conn->query('SHOW TABLES')){
        while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
            $tables[] = $row[0];
        }
        }
        return $tables;
    }
    function store($tables){
        $comparisonoperators =new Fun;
        list($NameDB, $tables) = $comparisonoperators->ComparisonOperators($tables,$this->DBconnection,$this->conn);
        $handle = Storage::makeDirectory($this->DBconnection->name."/".$tables[0]."/");
        $handle = fopen("../storage/app/".$this->DBconnection->name."/".$tables[0]."/".$NameDB."_".time().'.sql','w+');
        $sql = new Exportsql;
        $sql->export($tables, $this->conn, $handle);
        fclose($handle);        
    }
    function update($file,$table){
        $version = new Factory();
        $file = file_get_contents("../storage/app/".$this->DBconnection->name."/".$table."/".$file);
        $version->build('sql',$table,$this->DBconnection->id,$file);
    }

}
?>