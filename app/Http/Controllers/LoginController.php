<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function showLoginForm(): View|RedirectResponse
    {
        if (auth()->check()) {
            return redirect('/');
        }
        session(['url.intended' => url()->previous()]);

        return view('account.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('username', 'password'), $request->filled('remember'))) {
            return redirect()->intended('/')->with('success', __('global.logged_in'));
        }

        return back()->withErrors([
            'login' => __('auth.failed'),
        ])->withInput($request->only('username'));
    }

    public function logout(): RedirectResponse
    {
        if (! auth()->check()) {
            return redirect('/');
        }
        Auth::logout();

        return redirect('/')->with('success', __('global.logged_out'));
    }
}
