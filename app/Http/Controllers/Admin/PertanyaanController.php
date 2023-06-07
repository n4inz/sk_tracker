<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pertanyaan;
use App\Models\PertanyaanJawaban;
use Illuminate\Support\Facades\Redirect;

class PertanyaanController extends Controller
{
    public function index()
    {
        $data = Pertanyaan::query()->with('jawaban')->get();
        
        return Inertia::render('Admin/Pertanyaan',[
            'loadPertanyaan' => $data
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

        return Redirect::route('admin.pertanyaan')->with('success', 'Data berhasil disimpan!');


        return Inertia::location(url()->previous());
    
    }

    public function submitPertanyaan(Request $request)
    {
        return $request;
    }
}
