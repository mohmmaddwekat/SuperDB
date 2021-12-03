<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){

        $number_database = DB::table('connection')->count();
        
        return view('super-db.dashboard',[
            'number_database' => $number_database
        ]);
    }
}
