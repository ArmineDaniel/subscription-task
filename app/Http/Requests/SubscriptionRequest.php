<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubscriptionRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'website_id' => [
                'required',
                'numeric',
            ],
            'email' => [
                'required',
                'email',
            ],
        ];
    }
}
