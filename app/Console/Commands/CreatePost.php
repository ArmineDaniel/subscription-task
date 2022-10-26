<?php

namespace App\Console\Commands;

use App\Services\PostService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

class CreatePost extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:post {--title=} {--description=} {--website_id=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new post';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $title = $this->option('title');
        $description = $this->option('description');
        $websiteId= $this->option('website_id');
        $validator = Validator::make([
            'website_id' => $websiteId,
            'title' => $title,
            'description' => $description,
        ],
            [
                'website_id' => 'required|numeric',
                'title' => 'required|string|max:255',
                'description' => 'required|string',
            ]);
        if ($validator->fails()) {
          $this->info($validator->errors());
        }
        else{
            $post = new PostService();
            $this->info($post->create($title, $description, $websiteId));
        }
        return Command::SUCCESS;
    }
}
