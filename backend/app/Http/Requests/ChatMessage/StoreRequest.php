<?php

namespace App\Http\Requests\ChatMessage;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'content' => 'required|string|max:255',
        ];
    }
}
