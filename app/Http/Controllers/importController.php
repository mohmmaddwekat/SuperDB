<?php

namespace App\Http\Controllers;

use App\Exceptions\ErrorHandlerMsg;
use App\SystemFile\Factory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class importController extends Controller
{
    function index($id){
        try{
        $roles_Abilitiles = Auth::user()->role->abilities()->pluck('code')->toArray();
        if(!in_array('super-db.import.index',$roles_Abilitiles)){
            abort(403);
        }
        
        return view('super-db.jobs.import',['id'=>$id]);
    }catch (Exception $e){
        return ErrorHandlerMsg::getErrorMsgWithLog($e->getMessage());
        //abort(404);
    }
    }

    function add(Request $request,$id){
        $request->validate([
            'formFile'=>['required','mimes:txt,csv,sql','file'],
            'type'    =>['required','in:csv,txt,sql'],
        ]);
        try{
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
                $file = fopen("../storage/app/file/".$_FILES['formFile']['name'], "r");
                $massege = $csvFiles->build($request->type,$_FILES['formFile']['name'],$id,$file);
            } else if($request->type =="text") {
                $TextFiles = new Factory();
                $file = fopen("../storage/app/file/".$_FILES['formFile']['name'], "r");
                $massege = $TextFiles->build($request->type,$_FILES['formFile']['name'],$id,$file);
            } else if($request->type =="sql"){                
                $SqlFiles = new Factory();
                $file = file_get_contents("../storage/app/file/".$_FILES['formFile']['name']);
                $massege = $SqlFiles->build($request->type,$_FILES['formFile']['name'],$id,$file);
            }
            return  redirect()->route('super-db.import.index',$id)->with($massege[0],$massege[1]);
        }       
        }catch (Exception $e){
            return ErrorHandlerMsg::getErrorMsgWithLog($e->getMessage());
            //abort(404);
        }
    }
    
    
}
