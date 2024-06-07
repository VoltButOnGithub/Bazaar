<?php

namespace App\Http\Controllers;

use App\Enum\UserTypesEnum;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\RegisterRequest;
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

        return view('account.register');
    }

    public function store(RegisterRequest $request): RedirectResponse
    {
        $request->validated();

        DB::transaction(function () use ($request) {
            $url = $request->username;
            if ($request->enum('type', UserTypesEnum::class) == UserTypesEnum::BUSINESS) {
                $url = $request->url;
            }

            $profilePictureUrl = 'public/no_pfp.png';
            if ($request->hasFile('profilePicture')) {
                $profilePictureUrl = $request->file('profilePicture')->storeAs('public/profile-pictures', $request->username . '.' . $request->file('profilePicture')->extension());
            }

            $user = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'image' => $profilePictureUrl,
                'type' => $request->enum('type', UserTypesEnum::class),
                'url' => $url,
            ]);

            Auth::login($user);
        });

        return redirect()->back();
    }
}
