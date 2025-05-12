<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChatMessage extends Model
{
  use HasFactory;

  protected $fillable = [
    'user_id',
    'chat_room_id',
    'message',
  ];

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }

  public function chatRoom(): BelongsTo
  {
    return $this->belongsTo(ChatRoom::class);
  }
}
