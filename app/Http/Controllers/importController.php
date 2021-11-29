<?php

namespace App\Http\Controllers;

use App\Job\Factory;
use App\SystemFile\CSVFiles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class importController extends Controller
{
    function index($id){
        return view('jobs.import',['id'=>$id]);
    }

    function add(Request $request,$id){
        if(Storage::exists('file/'.$_FILES['formFile']['name'])){
             return  redirect()->route('import.index',$id)->with('error','file is exists');
        }else{  
            $file = $request->file('formFile')->storeAs('file',($_FILES['formFile']['name']));
            $data = Storage::readStream($file);
            $count =0;
            while (($row[] = fgetcsv($data, 1000, ",")) !== FALSE) 
            {
            } 
            $csvFiles = new CSVFiles();
            $csvFiles->create($_FILES['formFile']['name'],$row[0],$id);
            $csvFiles->insart($_FILES['formFile']['name'],$row,$id);
            return  redirect()->route('import.index',$id)->with('success','Success file have been added');
        }       

    }
    
    /**
     * create
     *
     * @param  string $tablename
     * @param  array $columns
     * @param  int $id
     * @return void
     */
    private function create($tablename,$columns,$id){
        $name = str_replace(".csv","", $tablename);
        $factory = new Factory;
        $query = 'CREATE TABLE '.$name.' ( ';
        foreach($columns as $key=>$column){
            if ($key == count($columns)-1) {
                 $query .= $column.' VARCHAR(255) not null';
                 break;
            }
            $query .= $column.' VARCHAR(255) not null,';
           
        }
        $query .=')';
        $DBconnection = DB::connection('conn')->table('connection')->where('id','=',$id)->first(['name','id']);
        $link = mysqli_connect("localhost", "root", "", $DBconnection->name);
        $message = $factory->factory($query,$link);
         mysqli_close($link);
    }
    /**
     * create
     *
     * @param  string $tablename
     * @param  array $columns
     * @param  int $id
     * @return void
     */
    private function insart($tablename,$columns,$id){
        $name = str_replace(".csv","", $tablename);
        $factory = new Factory;
        $query = 'INSERT INTO '.$name.' ( ';
        foreach($columns[0] as $key=>$column){
            if ($key == count($columns[0])-1){
                $query .= $column;
                break;
            }
            $query .= $column.',';
        }
        $query .=')';
        $sql = $query;
        foreach ($columns as $key => $column){
            if($key  <= count($columns)-2 and $key > 0){
            $query .='VALUES (';
            foreach ($column as  $keys=>$row) { 
                if ($keys == count($column)-1) {
                    $query  .= "'$row'";
                    break;
                }
                $query  .= "'$row',";
                 
            }
            $query .=')';
            echo $query;
            $DBconnection = DB::connection('conn')->table('connection')->where('id','=',$id)->first(['name','id']);
            $link = mysqli_connect("localhost", "root", "", $DBconnection->name);
            $message = $factory->factory($query,$link);
            mysqli_close($link);
            $query = $sql;
            } 
        }
    }

}
