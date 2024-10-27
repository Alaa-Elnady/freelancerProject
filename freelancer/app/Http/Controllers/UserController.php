<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //Show Register/create from
    public function create() {
        return view('users.register');
    }

    // Create new user
    public function store(Request $request) {
        $formFields = $request->validate([
            'name' => ['required' , 'min:3'],
            'email' => ['required' , 'email' , Rule::unique('users' , 'email')],
            'password' => 'required|confirmed|min:6',
        ]);

        // Hashing the password
        $formFields['password'] = bcrypt($formFields['password']);

        //Create user
        $user = User::create($formFields);

        //Login
        auth()->login($user);

        return redirect('/')->with('message' , 'User created and logged in');
    }

    // User logout
    public function logout(Request $request) {
        auth()->logout();

        // Session Invalidate
        $request->session()->invalidate();
        // Change the token of the previous session token
        $request->session()->regenerateToken();

        return redirect('/')->with('message' , 'You have been logged out!');
    }

    // Show Login form
    public function login() {
        return view('users.login');
    }

    // Login(Authenticate) User
    public function authenticate(Request $request) {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if(auth()->attempt($formFields)) {
            $request->session()->regenerate();
            return redirect('/')->with('message' , 'You are now logged In!');
        } else {
            return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
        }
    }

    // What is Authentication --> regstiration/login 
    // What is Authorization --> Permissions    صلاحيات
}
