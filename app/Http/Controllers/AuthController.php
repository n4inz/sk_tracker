<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return Inertia::render('Auth/login');
    }

    public function loginStore(Request $request)
    {
        
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
           
            return Inertia::location('/dashboard');

        }
        
        return redirect()->back()->withErrors(['email' => 'Email atau password salah']);
    }

    public function register(Request $request)
    {
        return Inertia::render('Auth/register');   
    }

    public function registerStore(Request $request)
    {
        // sleep(3);
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:3',
        ]);


        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        
        return Inertia::render('Auth/login');   
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        // Redirect to the desired page after logout
        return redirect('/');
    }
}
