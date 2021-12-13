<?php

namespace App\Http\Controllers;


use App\RestoreDB\ExportDB\ExportHandler;
use Illuminate\Support\Facades\Auth;

class ExportController extends Controller
{

    /*
    *Export database to sql file 
    */
    public function export($connection_id, $export, $tables = '*')
    {
       
            $roles_permissions = Auth::user()->role->permissions()->pluck('code')->toArray();
            if (!in_array('super-db.jobs.index', $roles_permissions)) {
                abort(403);
            }
            
            $exportHandler  =new ExportHandler ;
            $connectionName = $exportHandler->handleExport($export, $connection_id,$tables );
            return redirect()->route('super-db.jobs.index', $connectionName->id)->with("success", "Database Export Successfully!");
       
    }
}
