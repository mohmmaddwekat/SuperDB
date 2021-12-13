<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;

class LangController extends Controller
{
    public function locale($lang){
        session()->put('locale', $lang);
        App::setLocale($lang);
        return redirect()->back();
    }
}
