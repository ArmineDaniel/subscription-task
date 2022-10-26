<?php

namespace App\Console\Commands;

use App\Services\WebsiteService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

class CreateWebsite extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:website {--name=} {--email=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new website';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->option('name');
        $email = $this->option('email');
        $validator = Validator::make([
            'name' => $name,
            'email' => $email,
        ],
            [
                'name' => 'required|string|unique:websites|max:255',
                'email' => 'required|email|unique:websites,email',
            ]);
        if ($validator->fails()) {
            $this->info($validator->errors());
        }
        else{
            $website = new WebsiteService();
            $this->info($website->create($name, $email));
        }
        return Command::SUCCESS;
    }
}
