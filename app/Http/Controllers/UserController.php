<?php

namespace App\Http\Controllers;

use App\Enum\UserTypesEnum;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create(): View|RedirectResponse
    {
        if (auth()->check()) {
            return redirect('/');
        }

        return view('register');
    }

    public function store(Request $request): RedirectResponse
    {
        DB::transaction(function () use ($request) {
            $url = $request->username;
            if($request->enum('type', UserTypesEnum::class) == UserTypesEnum::BUSINESS) {
                $url = $request->url;
            }
            $user = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'type' => $request->enum('type', UserTypesEnum::class),
                'url' => $url,
            ]);

            Auth::login($user);
        });

        return redirect()->route('home');
    }
}
