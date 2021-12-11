<?php
namespace App\Connection;

use Illuminate\Support\Facades\Log;
use Exception;

     /*const LogLevels =[
    'emergency',
    'critical',
    'alert',
    'error',
    'warning',
    'notice',
    'debug',
    'info'
   ]; */ 
   
class ErrorHandlerMsg{
    
    public static function setLog($Level , $msg){
        switch ($Level) {
            case 'emergency':
                Log::emergency($msg);
                break;
            case 'critical':
                Log::critical($msg);
            break;
            case 'alert':
                Log::alert($msg);
            break;
            case 'error':
                Log::error($msg);
            break;
            case 'warning':
                Log::warning($msg);
            break;
            case 'notice':
                Log::notice($msg);
            break;
            case 'debug':
                Log::debug($msg);
            break;
            case 'info':
                Log::info($msg);
            break;
            default:
            Log::info($msg);
            break;
        }
      
    }
    public static function getErrorMsgWithLog($msg, $LogLevel="error", $title="Error"){
      
       
        ErrorHandlerMsg::setLog($LogLevel, $msg);
      if(\Request::ajax()){
        return response()->json([$title  => $msg], 400);
        }else{
        return \Redirect::back()->withErrors([$title => $msg]);
        }
    }
    public static function getErrorMsg($msg, $title="Error"){
      
      if(\Request::ajax()){
        return response()->json([$title  => $msg], 400);
        }else{
        return \Redirect::back()->withErrors([$title => $msg]);
        }
    }
    
    

}

?>