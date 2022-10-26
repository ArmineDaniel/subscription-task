<?php

namespace App\Services;

use App\Models\Website;

class WebsiteService
{
    public function create($name, $email)
    {
        $website = new Website();
        $website->name = $name;
        $website->email = $email;

        $website->save();
            return response()->json([
                "message" => "New website created!"
            ], 201);
    }
}
