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

    public function detail(Request $request ,$id)
    {
       
        $user = $request->user();

        $data = User::where('id', $id)->with('user_jawaban')->first();

        // $data = json_decode($data->user_jawaban->jawaban, true);

        // // Mengakses kunci dan nilai
        // foreach ($data as $key => $value) {
        //     echo "Key: $key<br>";
        //     echo "Value: $value<br>";
        //     echo "<br>";
        // }

        // return false;
        return Inertia::render('Admin/DetailUser',[
            'data' => $data,
            'jawaban' => json_decode(@$data->user_jawaban->jawaban),
        ]);
    }
}
