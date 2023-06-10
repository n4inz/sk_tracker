<?php

namespace App\Jobs;

use App\Models\Notifiaction;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Spatie\Multitenancy\Jobs\NotTenantAware;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class Notification implements ShouldQueue ,NotTenantAware
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $user_id;
    protected $body;
    public function __construct($user,$body)
    {
        $this->user_id = $user;
        $this->body = $body;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Notifiaction::create([
            'user_id' => $this->user_id,
            'body' => $this->body,
        ]);
    }
}
