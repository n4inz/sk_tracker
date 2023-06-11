<?php

namespace App\Http\Controllers;

use App\Jobs\Notification;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
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

        $aktif = User::select('id')->where([
            'email' => $request->email,
            'status' => 0
        ])->first();
        
        if(!$aktif){
            return redirect()->back()->withErrors(['email' => 'Akun anda belum aktif. Mohon tunggu 1-3 hari kerja']);
        }
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            
            
            return Inertia::location('/pertanyaan');

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
        $color = [
            'bg-yellow-300',
            'bg-red-500',
            'bg-orange-500',
            'bg-emerald-500',
            'bg-rose-600',
            'bg-green-500',
        ];

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'color' => $color[array_rand($color)],
            'status' => User::STATUSNOTACTIVE,
            'password' => Hash::make($request->password),
        ]);


        Notification::dispatch(null,'User name '.$user->username. ' success register, Verifikasi sekarang !!!');
        Notification::dispatch($user->id,'Halo '.$user->name. ', Terimah kasih telah mendaftar di aplikasi tracker study. Mohon tunggu 1-3 hari untuk aktfasi akun. Terimah kasih ');
        return Redirect::route('login')->with('success', 'Data berhasil disimpan!');
        
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
