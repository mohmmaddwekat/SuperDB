<?php

namespace App\Http\Controllers;

use App\SystemFile\Factory;
use App\VersionContro\VersionContro;
use Exception;
use Illuminate\Http\Request;

class VersionControlController extends Controller
{
    function index($id)
    {
        try {
            $version = new VersionContro($id);
            $tables = $version->show($id);
            return view('super-db.versionControl.index', ['id' => $id, 'tables' => $tables]);
        } catch (Exception $e) {
            return \App\Connection\ErrorHandlerMsg::getErrorMsgWithLog($e->getMessage());
            //abort(404);
        }
    }
    function store(Request $request, $id)
    {
        try {
            $input = $request->all();
            $input['tables'] = $request->input('tables');
            $version = new VersionContro($id);
            foreach ($input['tables'] as $table) {
                $version->store($table);
            }
            return redirect()->route('super-db.jobs.index', $id);
        } catch (Exception $e) {
            return \App\Connection\ErrorHandlerMsg::getErrorMsgWithLog($e->getMessage());
            //abort(404);
        }
    }
    function update($file, $table, $id)
    {
        try {
            $version = new VersionContro($id);
            $version->update($file, $table);
            return redirect()->route('super-db.jobs.view-column', [$table, $id]);
        } catch (Exception $e) {
            return \App\Connection\ErrorHandlerMsg::getErrorMsgWithLog($e->getMessage());
            //abort(404);
        }
    }
}
