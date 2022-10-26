<?php

namespace App\Services;

use App\Events\NewSubscription;
use App\Models\Subscriber;
use App\Models\Website;

class SubscriptionService
{
    public function subscribe($email, $websiteId)
    {
        if (Website::find($websiteId)) {
            $subscriber = Subscriber::where([
                'email' => $email,
                'website_id' => $websiteId
            ])->first();
            $websiteEmail = Website::find($websiteId)->email;
            if ($subscriber) {
                return response()->json([
                    "message" => "You already subscribed!"
                ], 201);
            }
            else {
                $subscriber = new Subscriber();
                $subscriber->email = $email;
                $subscriber->website_id = $websiteId;
                $subscriber->save();

                    NewSubscription::dispatch($websiteEmail, $email);
                    return response()->json([
                        "message" => "You subscribed successfully!"
                    ], 201);
            }
        }
        else{
            return response()->json([
                "message" => "There isn't website with this id!"
            ], 404);
        }
}
}
