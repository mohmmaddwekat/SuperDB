<?php

namespace App\Http\Controllers;

use App\Exceptions\ErrorHandlerMsg;
use App\RestoreDB\ExportDB\ExportHandler;
use Illuminate\Support\Facades\Auth;

class ExportController extends Controller
{    
    /**
     * Export database to sql file
     *
     * @param  mixed $connection_id
     * @param  mixed $export
     * @param  mixed $tables
     * @return void
     */
    public function export($connection_id, $export, $tables = '*')
    {
       
            $roles_permissions = Auth::user()->role->permissions()->pluck('code')->toArray();
            if (!in_array('super-db.jobs.index', $roles_permissions)) {
                abort(404);
            }
            
            $exportHandler  =new ExportHandler ;
            $connectionName = $exportHandler->handleExport($export, $connection_id,$tables );
            ErrorHandlerMsg::setLog('info',"connection exported");
            return redirect()->route('super-db.jobs.index', $connectionName->id)->with("success", "Database Export Successfully!");
       
    }
}
