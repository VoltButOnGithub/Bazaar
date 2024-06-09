<?php

namespace App\Http\Controllers;

use App\Enum\UserTypesEnum;
use App\Http\Requests\RegisterRequest;
use App\Models\Business;
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

        return view('account.register');
    }

    public function show(Request $request, int $id): View|RedirectResponse
    {
        $user = User::find($id);
        if (! $user) {
            abort(404, __('global.user_not_found'));
        }
        if ($user->type->isBusiness()) {
            return redirect($user->business->url);
        }
        $reviews = $user->reviews()->orderBy('updated_at', 'desc')->simplePaginate(3, ['*'], 'reviewPage');
        $query = $user->ads();
        $request->flash();

        if (! is_null($request->input('search'))) {
            $query->where('name', 'like', '%'.$request->input('search', '').'%');
        }

        if (! is_null($request->input('sort_by'))) {
            switch ($request->input('sort_by', 'newest')) {
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'oldest':
                    $query->orderBy('created_at', 'asc');
                    break;
                case 'cheapest':
                    $query->orderBy('price', 'asc');
                    break;
                case 'most_expensive':
                    $query->orderBy('price', 'desc');
                    break;
                default:
                    $query->orderBy('created_at', 'desc');
                    break;
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $ad_type = $request->input('ad_type', 'all');
        if ($ad_type != 'all') {
            $query->where('type', $ad_type);
        }

        return view('user.details', ['user' => $user, 'ad_type' => $ad_type, 'reviews' => $reviews, 'ads' => $query->paginate(8)]);
    }

    public function store(RegisterRequest $request): RedirectResponse
    {
        $request->validated();
        DB::transaction(function () use ($request) {
            $profilePictureUrl = '';
            if ($request->hasFile('profilePicture')) {
                $profilePictureUrl = $request->file('profilePicture')->storeAs('public/profile-pictures', $request->username.'.'.$request->file('profilePicture')->extension());
            }

            $user = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'image' => $profilePictureUrl,
                'type' => $request->enum('type', UserTypesEnum::class),
            ]);
            if ($user->type->isBusiness()) {
                $business = Business::create([
                    'user_id' => $user->id,
                    'url' => $request->url,
                    'layout' => [
                        '1' => [
                            ['0' => 'ads', 'text' => null],
                            ['0' => 'nothing', 'text' => null],
                            ['0' => 'nothing', 'text' => null],
                        ],
                        '2' => [
                            ['0' => 'reviews', 'text' => null],
                            ['0' => 'nothing', 'text' => null],
                            ['0' => 'nothing', 'text' => null],
                        ],
                    ],
                    'primary_color' => '#ffffff',
                    'secondary_color' => '#f6f6f6',
                ]);
            }
            Auth::login($user);
        });

        return redirect()->intended('/')->with('success', __('global.registered'));
    }
}
