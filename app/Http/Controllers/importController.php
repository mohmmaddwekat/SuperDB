<?php

namespace App\Http\Controllers;

use App\Exceptions\ErrorHandlerMsg;
use App\RestoreDB\ImportDB\ImportHandler;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ImportController extends Controller
{    
    /**
     * Redirect the user to the import page
     *
     * @param  mixed $id
     * @return void
     */
    function index($id){
        try{
        $roles_permissions = Auth::user()->role->permissions()->pluck('code')->toArray();
        if(!in_array('super-db.import.index',$roles_permissions)){
            abort(404);
        }
        
        return view('super-db.jobs.import',['id'=>$id]);
    }catch (Exception $e){
        return ErrorHandlerMsg::getErrorMsgWithLog($e->getMessage());
        //abort(404);
    }
    }
    
    /**
     * Import file (sql/csv/sql) from filesystem
     * Parse it to SQL file 
     * Store it in the database
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    function add(Request $request,$id){
        $request->validate([
            'formFile'=>['required','mimes:txt,csv,sql','file'],
            'type'    =>['required','in:csv,txt,sql'],
        ]);
        try{
        $roles_permissions = Auth::user()->role->permissions()->pluck('code')->toArray();
        if(!in_array('super-db.import.add',$roles_permissions)){
            abort(404);
        }
        if(Storage::exists('file/'.$_FILES['formFile']['name'])){
            ErrorHandlerMsg::setLog('debug',"Error while importing a file, trying to import an existing file");
             return  redirect()->route('super-db.import.index',$id)->with('error','File exists');
        }
        $request->file('formFile')->storeAs('file',($_FILES['formFile']['name']));
            $handle = new ImportHandler();
            $massege = $handle->handleImport($request->type,$_FILES['formFile']['name'],$id);
            ErrorHandlerMsg::setLog('info',"File impoerted");
        return  redirect()->route('super-db.import.index',$id)->with($massege[0],$massege[1]);      
        }catch (Exception $e){
            return ErrorHandlerMsg::getErrorMsgWithLog($e->getMessage());
            ErrorHandlerMsg::setLog('debug',"Error while importing a file");
        }
    }
    
    
}
