<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jobs\ChangePertanyaan;
use App\Models\Pertanyaan;
use App\Models\PertanyaanJawaban;
use App\Models\UserJawaban;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class PertanyaanController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $cek = false;
        if(!$user->hasRole('admin')){
            $uJawaban = UserJawaban::select('id')
            ->where('user_id',$user->id)
            ->where('status',UserJawaban::NEW)->first();
            if($uJawaban){
                $cek = true;
            }
        }
       
        $data = Pertanyaan::query()->with('jawaban')->get();
        
        return Inertia::render('Admin/Pertanyaan',[
            'loadPertanyaan' => $data,
            'cekPertanyaan' => $cek
        ]);
    }

    public function tambahPertanyaan()
    {
        return Inertia::render('Admin/BuatPertanyaan');
    }
    

    public function storePertanyaan(Request $request)
    {
       
       $request->validate([
            'valuePertanyaan' => 'required',
            'titlePertanyaan' => 'required',
        ]);

        $id = Pertanyaan::create([
            'name' => $request->titlePertanyaan,
            'name_text' => ucfirst($request->titlePertanyaan),
            'type' => $request->valuePertanyaan,
        ]);

        if($request->valuePertanyaan !== 'text'){
            foreach($request->jawaban as $key => $value){
                PertanyaanJawaban::create([
                    'pertanyaans_id' => $id->id,
                    'jawaban' => $request->jawaban[$key]
                ]);
            }

        }
        ChangePertanyaan::dispatch();

        return Redirect::route('admin.pertanyaan')->with('success', 'Data berhasil disimpan!');


        return Inertia::location(url()->previous());
    
    }

    public function submitPertanyaan(Request $request)
    {
        // Log::info(json_encode($request->data));
        // return $request->data;
        $user = $request->user();

        UserJawaban::updateOrCreate([
            'user_id' => $user->id,
        ],[
           'user_id' => $user->id,
           'jawaban' => json_encode($request->data), 
        ]);
        if($user->hasRole('admin')){
            return Redirect::route('admin.pertanyaan')->with('success', 'Data berhasil disimpan!');

        }else{
            return Redirect::route('admin.detail',['id' => $user->id])->with('success', 'Data berhasil disimpan!');

        }
    }

    public function deletePertanyaan(Request $request){
        $id = $request->id;
        PertanyaanJawaban::where('pertanyaans_id',$id)->delete();
        Pertanyaan::where('id',$id)->delete();
        return Redirect::route('admin.pertanyaan')->with('success', 'Data berhasil disimpan!');
    }
}
