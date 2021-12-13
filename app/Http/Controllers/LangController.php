<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use App\Exceptions\ErrorHandlerMsg;

class LangController extends Controller
{
    public function locale($lang){
        session()->put('locale', $lang);
        App::setLocale($lang);
        ErrorHandlerMsg::setLog('info'," Language Controller entered",null);
        ErrorHandlerMsg::setLog('info'," Language switched ",null);
        return redirect()->back();
    }
}
