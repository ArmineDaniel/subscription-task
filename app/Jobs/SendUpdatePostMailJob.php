<?php

namespace App\Jobs;

use App\Mail\PostUpdateEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendUpdatePostMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $details;
    public $emails;
    public $website;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details, $emails, $website)
    {
        $this->details = $details;
        $this->emails = $emails;
        $this->website = $website;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->emails as $email){
            Mail::to($email)->send(new PostUpdateEmail($this->details, $email, $this->website));
        }
    }
}
