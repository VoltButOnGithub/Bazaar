<?php

namespace App\Http\Controllers;

use App\Enum\UserTypesEnum;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

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
            if ($request->enum('type', UserTypesEnum::class) == UserTypesEnum::BUSINESS) {
                $url = $request->url;
            }

            $profilePicture = '';
            if ($request->hasFile('profilePicture')) {
                $profilePicture = $request->file('profilePicture')->storeAs('profile-pictures', $request->username.'.'.$request->file('profilePicture')->extension());
            }

            $user = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'image' => $profilePicture,
                'type' => $request->enum('type', UserTypesEnum::class),
                'url' => $url,
            ]);

            Auth::login($user);
        });

        return redirect()->route('home');
    }
}
