<?php
use App\Exceptions\ErrorHandlerMsg;

class FileException extends Exception{
    function getError(){
        ErrorHandlerMsg::getErrorMsgWithLog($msg, null, "error", "Error");

    }
}




?>