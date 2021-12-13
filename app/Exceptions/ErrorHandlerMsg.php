<?php
namespace App\Exceptions;

use Illuminate\Support\Facades\Log;
   
class ErrorHandlerMsg{

    public static  function customeExceptionMsg($classOfException , $defaultMsg){
        $msg = $defaultMsg;
        switch ($classOfException) {
            case 'PDOException':
               $msg = "Error while creating connection!";
                break;
            case 'FileException':
                $msg = "Error whileimporting the file";

          
            default:
           
            break;
           
        }
        return $msg;
    }


    public static function setLog($Level , $msg, $classOfException = null){
        if ($classOfException != null){
            $msg =  ErrorHandlerMsg::customeExceptionMsg($classOfException, $msg);
           }
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
    public static function getErrorMsgWithLog($msg,$classOfException = null, $LogLevel="error", $title="Error"){
      
       if ($classOfException != null){
        $msg =  ErrorHandlerMsg::customeExceptionMsg($classOfException, $msg);
       }
        ErrorHandlerMsg::setLog($LogLevel, $msg,$classOfException);
      if(\Request::ajax()){
        return response()->json([$title  => $msg], 400);
        }else{
        return \Redirect::back()->withErrors([$title => $msg]);
        }
    }

    public static function getErrorMsg($msg,$classOfException=null, $title="Error"){
        if ($classOfException != null){
            $msg =  ErrorHandlerMsg::customeExceptionMsg($classOfException, $msg);
           }      
      if(\Request::ajax()){
        return response()->json([$title  => $msg], 400);
        }else{
        return \Redirect::back()->withErrors([$title => $msg]);
        }
    }
    
   
    }


?>