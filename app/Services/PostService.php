<?php

namespace App\Services;

use App\Jobs\SendMailJob;
use App\Jobs\SendUpdatePostMailJob;
use App\Models\Post;
use App\Models\Subscriber;
use App\Models\Website;


class PostService
{
    public function create($title, $description, $websiteId){
        $website = Website::find($websiteId);
        $post = Post::where([
            'title' => $title,
            'website_id' => $websiteId
        ])->first();
        if($website) {
            if($post) {
                return response()->json([
                    "message" => "This website already have post with this title!"
                ], 404);
            }
            else {
                $post = new Post();
                $post->website_id = $websiteId;
                $post->title = $title;
                $post->description = $description;
                $post->save();

                $subscriberEmails = Subscriber::where('website_id', $websiteId)
                    ->get()
                    ->pluck('email')
                    ->toArray();
                $website = Website::find($websiteId);
                $details = [];
                $details['title'] = $title;
                $details['message'] = $description;
                SendMailJob::dispatch($details, $website->name, $subscriberEmails);

                return response()->json([
                    "message" => "New post created!"
                ], 201);
            }
            }
        else{
            return response()->json([
                "message" => "There isn't website with this id!"
            ], 404);
        }
    }

    public function update($title, $description, $postId)
    {
        $post = Post::find($postId);
        $website = Website::find($post->website_id);
        $subscriberEmails = Subscriber::where('website_id', $post->website_id)
            ->get()
            ->pluck('email')
            ->toArray();
        if($post){
            $details = [];
            $details['title'] = $post->title;
            $details['message'] = $post->description;
            $post->title = $title;
            $post->description = $description;
            $post->save();
            $details['new_title'] = $title;
            $details['new_message'] = $description;

            SendUpdatePostMailJob::dispatch($details, $subscriberEmails, $website->name);
            return response()->json([
                "message" => "Post updated!"
            ], 201);
        }
        else{
            return response()->json([
                "message" => "There isn't post with this id!"
            ], 404);
        }
    }

    public function delete($postId)
    {
        $post = Post::find($postId);
        if($post){
            $post->delete();

            return response()->json([
                "message" => "Post deleted!"
            ], 201);
        }
        else{
            return response()->json([
                "message" => "There isn't post with this id!"
            ], 404);
        }
    }
}
