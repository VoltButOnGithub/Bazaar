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

        return view('account.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('username', 'password'), $request->filled('remember'))) {
            return redirect()->intended('/');
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

        return redirect('/');
    }
}
