<?php

namespace App\Exceptions;

use Illuminate\Support\Facades\Log;
use Exception;
use App\Exceptions\ErrorHandlerMsg;

class FileException extends Exception{
    function getErrorDetails(){
  ErrorHandlerMsg::getErrorMsgWithLog($msg, FileException, "error","Error");
}
}
?>