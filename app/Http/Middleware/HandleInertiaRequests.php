<?php

namespace App\Http\Middleware;

use App\Models\Notifiaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
        
      
        if(Auth::check()){
            $user = $request->user();
            if($user->hasRole('admin')){
                $total = Notifiaction::where('user_id',null)->where('read_at_at' ,null)->count();
            }else{
                $total = Notifiaction::where('user_id',$user->id)->where('read_at_at' ,null)->count();
            }
            return array_merge(parent::share($request), [
                'auth' => [
                    'username' => @$user->username,
                    'id' => @$user->id,
                    'name' => @$user->name,
                    'email' => @$user->email,
                    'admin' => @$user->hasRole('admin') ?? 0 ,
                    'totalNotif' => $total,
                ]
            ]);

        }else{
            return array_merge(parent::share($request), [
                'auth' => [
                    
                ]
            ]);
        }
    }
}
