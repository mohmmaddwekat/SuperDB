<?php

namespace App\Http\Controllers;

use App\SystemFile\Factory;
use App\VersionContro\VersionContro;
use Illuminate\Http\Request;

class VersionControlController extends Controller
{
    function index($id){
        $version = new VersionContro($id);
        $tables = $version->show($id);
         return view('super-db.versionControl.index',['id'=>$id,'tables'=>$tables]);

    }
    function store(Request $request,$id){
        $input = $request->all();
        $input['tables'] = $request->input('tables');
        $version = new VersionContro($id);
        foreach ($input['tables'] as $table) {
            $version->store($table);
        }
        return redirect()->route('super-db.jobs.index', $id);
    }
    function update($file,$table,$id){
        $version = new VersionContro($id);
        $version->update($file,$table);
        return redirect()->route('super-db.jobs.view-column', [$table, $id]);
    }
}
