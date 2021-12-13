<?php

namespace App\Http\Controllers;

use App\RestoreDB\SnapshotControl\VersionControl;
use Exception;
use Illuminate\Http\Request;

class VersionControlController extends Controller
{
    function index($id)
    {
        try {
            $version = new VersionControl($id);
            $tables = $version->show($id);
            return view('super-db.versionControl.index', ['id' => $id, 'tables' => $tables]);
        } catch (Exception $e) {
            abort(404);
        }
    }
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
