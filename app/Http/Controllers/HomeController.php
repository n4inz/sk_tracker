<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserJawaban;
use Carbon\Carbon;
use Inertia\Inertia;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // return $request->user()->hasRole('admin');
       

        $daysOfWeek = [Carbon::MONDAY, Carbon::TUESDAY, Carbon::WEDNESDAY, Carbon::THURSDAY, Carbon::FRIDAY, Carbon::SATURDAY, Carbon::SUNDAY]; // Hari-hari yang ingin Anda ambil (Senin hingga Minggu dalam contoh ini)
        $userCounts = [];
        
        foreach ($daysOfWeek as $day) {
            $count = User::whereRaw('DAYOFWEEK(created_at) = ?', [$day])->count();
            $userCounts[] = $count;
        }

        $userJawab = [];
        
        
        foreach ($daysOfWeek as $day) {
            $count = UserJawaban::whereRaw('DAYOFWEEK(created_at) = ?', [$day])->count();
            $userJawab[] = $count;
        }
        
        return Inertia::render('Home',[
            'userRegister' => $userCounts,
            'userJawab' => $userJawab
        ]);
    }
}
