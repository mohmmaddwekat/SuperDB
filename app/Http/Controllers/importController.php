<?php

namespace App\Http\Controllers;

use App\SystemFile\CSVFiles;
use App\SystemFile\Factory;
use App\SystemFile\SqlFiles;
use App\SystemFile\TextFiles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class importController extends Controller
{
    function index($id){
        $roles_Abilitiles = Auth::user()->role->abilities()->pluck('code')->toArray();
        if(!in_array('super-db.import.index',$roles_Abilitiles)){
            abort(403);
        }
        return view('super-db.jobs.import',['id'=>$id]);
    }

    function add(Request $request,$id){
        $roles_Abilitiles = Auth::user()->role->abilities()->pluck('code')->toArray();
        if(!in_array('super-db.import.add',$roles_Abilitiles)){
            abort(403);
        }
        if(Storage::exists('file/'.$_FILES['formFile']['name'])){
             return  redirect()->route('super-db.import.index',$id)->with('error','file is exists');
        }else{ 
            $request->file('formFile')->storeAs('file',($_FILES['formFile']['name']));
            // $data = Storage::readStream($file);
            if ($request->type == "csv") {            
                $csvFiles = new Factory();
                $massege = $csvFiles->build($request->type,$_FILES['formFile']['name'],$id);
            } else if($request->type =="text") {
                $TextFiles = new Factory();
                $massege = $TextFiles->build($request->type,$_FILES['formFile']['name'],$id);
            } else if($request->type =="sql"){                
                $SqlFiles = new Factory();
                $massege = $SqlFiles->build($request->type,$_FILES['formFile']['name'],$id);
            }
            return  redirect()->route('super-db.import.index',$id)->with($massege[0],$massege[1]);
        }       

    }
    
    
}
