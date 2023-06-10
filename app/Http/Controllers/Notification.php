<?php

namespace App\Http\Controllers;

use App\Models\Notifiaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class Notification extends Controller
{
    
    public function index(Request $request)
    {
        $user = $request->user();
        if($user->hasRole('admin')){
            $notif = Notifiaction::where('user_id',null)->orderBy('id','desc')->get();
        }else{
            $notif = Notifiaction::where('user_id',$user->id)->orderBy('id','desc')->get();
        }
       

        
        return Inertia::render('Notification',[
            'notif' => $notif
        ]);
    }

    public function detail(Request $request ,$id)
    {
       
        $user = $request->user();
        $query = Notifiaction::query();
        if($user->hasRole('admin')){
            $notif = $query->where('id',$id)->first();
            $query->where('id',$id)->where('user_id',null)->update([
                'read_at_at' => Carbon::parse(now())
            ]);
        }else{
           $notif =  $query->where([
                'id' => $id,
                'user_id' => $user->id
            ])->first();

            $query->where('id',$id)->where('user_id',$user->id)->update([
                'read_at_at' => Carbon::parse(now())
            ]);
        }
        return Inertia::render('NotificationDetail',[
            'notif' => $notif
        ]);
    }
}
