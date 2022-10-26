<?php

namespace App\Jobs;

use App\Notifications\SendEmailNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $details;
    public $website;
    public $emails;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details, $website, $emails)
    {
        $this->details = $details;
        $this->website = $website;
        $this->emails = $emails;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->emails as $email) {
            Notification::route('mail', $email)->notify(new SendEmailNotification($this->details['title'], $this->details['message']));
        }
    }
}
