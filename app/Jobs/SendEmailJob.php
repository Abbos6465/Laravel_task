<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Mail\ApplicationCreated;
use App\Models\Application;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Application $application;

    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    public function handle(): void
    {
        
        $manager = User::first();

        Mail::to($manager)->send(new ApplicationCreated($this->application));   
    }
}
