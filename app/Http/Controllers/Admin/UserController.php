<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

use App\Exports\UsersExport;
use App\Models\UserJawaban;
use Maatwebsite\Excel\Facades\Excel;

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

    public function detail(Request $request ,$id)
    {
       
        $user = $request->user();

        $data = User::where('id', $id)->with('user_jawaban')->first();

        
        return Inertia::render('Admin/DetailUser',[
            'data' => $data,
            'jawaban' => json_decode(@$data->user_jawaban->jawaban),
        ]);
    }

    public function export()
    {
        
         $datas = UserJawaban::query()->where('status', UserJawaban::NEW)->get();
         return Excel::download(new UsersExport($datas), 'users.xlsx');
    }
}
