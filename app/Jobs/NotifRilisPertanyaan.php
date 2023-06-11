<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Notifiaction;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Spatie\Multitenancy\Jobs\NotTenantAware;
class NotifRilisPertanyaan implements ShouldQueue ,NotTenantAware
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        User::where('status',0)->get()->map(function($user){
            Notifiaction::create([
                'user_id' => $user->id,
                'body' => 'Halo '.$user->name. ', Admin telah merirlis pertanyaan baru, Jawab sekarang !!!',
            ]);
            // Notification::dispatch($user->id,'Halo '.$user->name. ', Admin telah merirlis pertanyaan baru, Jawab sekarang !!!');
        });
    }
}
