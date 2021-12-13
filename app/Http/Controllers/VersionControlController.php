<?php

namespace App\Http\Controllers;

use App\RestoreDB\SnapshotControl\VersionControl;
use Exception;
use Illuminate\Http\Request;
use App\Exceptions\ErrorHandlerMsg;
use Illuminate\Support\Facades\Log;



class VersionControlController extends Controller
{    
    /**
     * Redirect the user to version control page
     *
     * @param  mixed $id
     * @return void
     */
    function index($id)
    {
        ErrorHandlerMsg::setLog('info'," Version Control controller entered ",null);
        try {
            $version = new VersionControl($id);
            $tables = $version->show($id);
            return view('super-db.versionControl.index', ['id' => $id, 'tables' => $tables]);
        } catch (Exception $e) {
            abort(404);
        }
    }    
    /**
     * Take snapshot by storing the database in a SQL file
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    function store(Request $request, $id)
    {
        try {
            $input = $request->all();
            $input['tables'] = $request->input('tables');
            $version = new VersionControl($id);
            foreach ($input['tables'] as $table) {
                $version->store($table);
            }
            return redirect()->route('super-db.jobs.index', $id);
        } catch (Exception $e) {
            abort(404);
        }
    }    
    /**
     * Update the newly snapshot taken
     *
     * @param  mixed $file
     * @param  mixed $table
     * @param  mixed $id
     * @return void
     */
    function update($file, $table, $id)
    {
        // try {
            $version = new VersionControl($id);
            $version->update($file, $table,$id);
            return redirect()->route('super-db.jobs.view-column', [$table, $id]);
        // } catch (Exception $e) {
        //     // abort(404);
        // }
    }
}
