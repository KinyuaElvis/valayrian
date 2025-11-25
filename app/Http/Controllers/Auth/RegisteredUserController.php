<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    //Display the registration form
    public function create(): View
    {
        return view('auth.register');
    }
    //Handle an incoming registration request
    public function store(Request $request): RedirectResponse
    {
$request->validate([
    'fullname' => 'required|string|max:255',
    'username' => 'required|string|max:255|unique:users',
    'email' => 'required|string|email|max:255|unique:users',
    'password' => [
        'required',
        'string',
        'min:8',
        'confirmed',
        Rules\Password::defaults(),
    ],
]);
        $user = User::create([
            'fullname' => $request->fullname,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        event(new Registered($user));
        Auth::login($user);
        return redirect(route('dashboard', absolute: false));
    }
}