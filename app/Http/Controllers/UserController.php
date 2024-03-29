<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\User;


class UserController extends Controller
{
    // show Register/create Form
    public function create()
    {
        return view('users.register');
    }

    // Store user into db
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required| confirmed| min:6',
        ]);

        $formFields['password'] = bcrypt($formFields['password']);

        $user = User::create($formFields);

        // login
        auth()->login($user);
        return redirect('/')->with('message', 'User created and logged in!');
    }

    // logout user
    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been logout!');
    }

    //show login form
    public function login()
    {
        return view('users.login');
    }

    // authenticate
    public function authenticate(Request $request)
    {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required| min:6',
        ]);

        if (auth()->attempt($formFields)) {
            $request->session()->regenerate();
            return redirect('/')->with('message', 'You are now logged in!');
        }

        return back()->withErrors(['email' => 'Invalue Credentials']);
    }
}
