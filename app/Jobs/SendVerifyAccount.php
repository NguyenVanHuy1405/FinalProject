<?php

namespace App\Jobs;

use App\Mail\VerifyAccount;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendVerifyAccount implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $new_user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($new_user)
    {
        
        $this->new_user = $new_user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $new_user = $this->new_user;
        Mail::to($new_user->email)->send(new VerifyAccount($new_user));
    }
}
