<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class Localization
{
    public function handle(Request $request, Closure $next): Response|RedirectResponse
    {
        if (Session::has('locale')) {
            App::setlocale(Session::get('locale'));
        }

        return $next($request);
    }
}
