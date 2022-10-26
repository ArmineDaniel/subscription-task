<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscriptionRequest;
use App\Services\SubscriptionService;

class SubscriberController extends Controller
{
    public function subscribe(SubscriptionRequest $request, SubscriptionService $service)
    {
        return $service->subscribe($request->email, $request->website_id);
    }
}

