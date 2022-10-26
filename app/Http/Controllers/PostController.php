<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\DeletePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Services\PostService;

class PostController extends Controller
{
    public function create(CreatePostRequest $request, PostService $service)
    {
        return $service->create($request->title, $request->description, $request->website_id);
    }

    public function update(UpdatePostRequest $request, PostService $service)
    {
        return $service->update($request->title, $request->description, $request->post_id);
    }

    public function delete(DeletePostRequest $request, PostService $service)
    {
        return $service->delete($request->post_id);
    }
}
