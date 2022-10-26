<?php

namespace App\Console\Commands;

use App\Services\SubscriptionService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

class Subscribe extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:subscription {--email=} {--website_id=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Subscribe to website';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $email = $this->option('email');
        $websiteId = $this->option('website_id');
        $validator = Validator::make([
            'website_id' => $websiteId,
            'email' => $email,
        ],
            [
                'website_id' => 'required|numeric',
                'email' => 'required|email',
            ]);
        if ($validator->fails()) {
            $this->info($validator->errors());
        } else {
            $subscribe = new SubscriptionService();
            $this->info($subscribe->subscribe($email, $websiteId));
        }

        return Command::SUCCESS;
    }
}
