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

  public function users(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }

  public function chat_rooms(): BelongsTo
  {
    return $this->belongsTo(ChatRoom::class);
  }
}
