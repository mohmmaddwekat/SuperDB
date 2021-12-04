<?php

namespace App\Http\Controllers;

use App\Models\Connectoin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){

        $number_database = DB::table('connection')->count();
        $record= DB::table('connection')->select(DB::raw("COUNT(*) as count"), DB::raw("DATE(created_at) as date_name"), DB::raw("date(created_at) as date"))
        ->where('created_at', '>', Carbon::today()->subDay(10))
        ->groupBy('date_name','date')
        ->orderBy('date')
        ->get();
  
        $data = [];
 
        foreach($record as $row) {
           $data['label'][] = $row->date_name;
           $data['data'][] = (int) $row->count;
         }
    
       $data['chart_data'] = json_encode($data);
        return view('super-db.dashboard',[
            'number_database' => $number_database,
            'chart_data'=>$data['chart_data']
        ]);
    }
}
