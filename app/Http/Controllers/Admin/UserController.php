<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
class UserController extends Controller
{
    public function index()
    {
        $user = User::query()->orderBy('id','desc')->get();
       
        return Inertia::render('Admin/User',[
            'users' => $user
        ]);
    }

    public function verifyUser(User $id)
    {
       
        $id->update([
            'status' => User::STATUSACTIVE,
        ]);

        return Redirect::route('admin.userAll')->with('success', 'Data berhasil disimpan!');
    }
}
