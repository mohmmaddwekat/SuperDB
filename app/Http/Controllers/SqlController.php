<?php

namespace App\Http\Controllers;

use App\Job\Factory;
use App\Rules\CheckNotConnectRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SqlController extends Controller
{
    public function index($id)
    {
        $DBconnection = DB::table('connection')->where('id','=',$id)->first(['name','id']);
        return view('super-db.sqls.index',[
        'connection'=> $DBconnection,
        ]);
    }


    public function store(Request $request,$id)
    {
        $DBconnection = DB::table('connection')->where('id','=',$id)->first(['name','id']);
        $request->validate([
            'query' => [
                'required', 'string', 'max:255',
                new CheckNotConnectRole($DBconnection->name),
            ],
        ]);
        $link = mysqli_connect("localhost", "root", "", $DBconnection->name);
        $query = $request->post('query');
        $factory = new Factory;
        $message = $factory->factory($query,$link);
        mysqli_close($link);

        return redirect()->route('super-db.sqls.index',$DBconnection->id)->with($message[0],$message[1]);
    }


}
