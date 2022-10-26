<?php

namespace App\Console\Commands;

use App\Services\PostService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

class UpdatePost extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:post {--title=} {--description=} {--post_id=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update post';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $title = $this->option('title');
        $description = $this->option('description');
        $postId = $this->option('post_id');
        $validator = Validator::make([
            'post_id' => $postId,
            'title' => $title,
            'description' => $description,
        ],
            [
                'post_id' => 'required|numeric',
                'title' => 'required|string|max:255',
                'description' => 'required|string',
            ]);
        if ($validator->fails()) {
            $this->info($validator->errors());
        }
        else{
            $post = new PostService();
            $this->info($post->update($title, $description, $postId));
        }
        return Command::SUCCESS;
    }
}
