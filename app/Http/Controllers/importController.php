<?php

namespace App\Http\Controllers;

use App\Exceptions\ErrorHandlerMsg;
use App\RestoreDB\ImportDB\Factory;
use App\RestoreDB\ImportDB\ImportHandler;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ImportController extends Controller
{
    /*
    *Redirect the user to the import page
    */
    function index($id){
        try{
        $roles_permissions = Auth::user()->role->permissions()->pluck('code')->toArray();
        if(!in_array('super-db.import.index',$roles_permissions)){
            abort(403);
        }
        
        return view('super-db.jobs.import',['id'=>$id]);
    }catch (Exception $e){
        return ErrorHandlerMsg::getErrorMsgWithLog($e->getMessage());
        //abort(404);
    }
    }
    /*
    *Import file (sql/csv/sql) from filesystem
    *Parse it to SQL file 
    *Store it in the database 
    */
    function add(Request $request,$id){
        $request->validate([
            'formFile'=>['required','mimes:txt,csv,sql','file'],
            'type'    =>['required','in:csv,txt,sql'],
        ]);
        try{

        $roles_permissions = Auth::user()->role->permissions()->pluck('code')->toArray();
        if(!in_array('super-db.import.add',$roles_permissions)){
            abort(403);
        }

        if(Storage::exists('file/'.$_FILES['formFile']['name'])){
             return  redirect()->route('super-db.import.index',$id)->with('error','file is exists');
        }else{ 
            $request->file('formFile')->storeAs('file',($_FILES['formFile']['name']));
            // $data = Storage::readStream($file);
            if ($request->type == "csv") {
                $csvFiles = new ImportHandler();
                $file = fopen("../storage/app/file/".$_FILES['formFile']['name'], "r");
                $massege = $csvFiles->handleImport($request->type,$_FILES['formFile']['name'],$id,$file);
            } if($request->type =="text") {
                $TextFiles = new ImportHandler();
                $file = fopen("../storage/app/file/".$_FILES['formFile']['name'], "r");
                $massege = $TextFiles->handleImport($request->type,$_FILES['formFile']['name'],$id,$file);
            } if($request->type =="sql"){                
                $SqlFiles = new ImportHandler();
                $file = file_get_contents("../storage/app/file/".$_FILES['formFile']['name']);
                $massege = $SqlFiles->handleImport($request->type,$_FILES['formFile']['name'],$id,$file);
            }
            return  redirect()->route('super-db.import.index',$id)->with($massege[0],$massege[1]);

        }       
        }catch (Exception $e){
            return ErrorHandlerMsg::getErrorMsgWithLog($e->getMessage());
            //abort(404);
        }
    }
    
    
}
