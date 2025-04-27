<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChatMessage\StoreRequest;
use App\UseCases\ChatMessage\StoreAction;

class ChatMessageController extends Controller
{
    public function store(StoreRequest $request, StoreAction $action): void
    {
        $action($request->content);
    }
}
