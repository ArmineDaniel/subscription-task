<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateWebsiteRequest;
use App\Services\WebsiteService;

class WebsiteController extends Controller
{
    public function create(CreateWebsiteRequest $request, WebsiteService $service){
        return $service->create($request->name, $request->email);
    }
}
