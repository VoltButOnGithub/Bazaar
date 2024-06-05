<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class LangController extends Controller
{
    public function changeLang(Request $request): RedirectResponse 
    {
        App::setLocale($request->lang);
        session()->put('locale', $request->lang);
    
        return redirect()->back();
    }
}
