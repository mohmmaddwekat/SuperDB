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
    
    
}
