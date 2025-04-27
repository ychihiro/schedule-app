<?php

namespace App\UseCases\ChatMessage;

use App\Events\CreateChatMessageEvent;

class StoreAction
{
    public function __invoke(string $content): void
    {
        // TODO: メッセージを保存する

        // TODO: Observer パターンで実装する
        event(new CreateChatMessageEvent([
            'id' => 1,
            'content' => $content,
            'created_at' => now(),
            'user_id' => 1,
            'user_name' => 'test',
        ]));
    }
}
