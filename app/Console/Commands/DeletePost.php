<?php

namespace App\Console\Commands;

use App\Services\PostService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

class DeletePost extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:post {--post_id=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete post';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $postId = $this->option('post_id');
        $validator = Validator::make([
            'post_id' => $postId,
        ],
            [
                'post_id' => 'required|numeric',
            ]);
        if ($validator->fails()) {
            $this->info($validator->errors());
        }
        else{
            $post = new PostService();
            $this->info($post->delete($postId));
        }
        return Command::SUCCESS;
    }
}
