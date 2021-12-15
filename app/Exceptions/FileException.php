<?php
use App\Exceptions\ErrorHandlerMsg;

class FileException extends Exception{
    function getError(){
        ErrorHandlerMsg::getErrorMsgWithLog("File exception", null, "error", "Error");

    }
}




?>
