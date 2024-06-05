<?php

namespace App\Http\Controllers;

use App\Enum\AdTypesEnum;
use App\Models\Ad;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AdController extends Controller
{
    public function create(): View|RedirectResponse
    {
        if (! auth()->check()) {
            return redirect('login');
        }

        return view('create_ad');
    }

    public function store(Request $request): RedirectResponse
    {
        DB::transaction(function () use ($request) {
            Ad::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'type' => $request->enum('type', AdTypesEnum::class),
            ]);

        });

        return redirect()->route('home');
    }

    public function show(int $id)
    {
        return response()->json([Ad::find($id)]);
    }
}
