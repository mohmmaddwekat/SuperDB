<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Exceptions\ErrorHandlerMsg;

class DashboardController extends Controller
{

    
    public function index(){

        try{
           
            ErrorHandlerMsg::setLog('debug',"Dashboard controller entered by authorized user");
            $roles_permissions = Auth::user()->role->permissions()->pluck('code')->toArray();
            if(!in_array('super-db.dashboard',$roles_permissions)){
                abort(403);
            }
    
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
    
    
            Log::channel('custom')->info("hello from logs");
    
            return view ('dashboard', $data);
        }catch (Exception $e){
            abort(404);
        }
    }
}
