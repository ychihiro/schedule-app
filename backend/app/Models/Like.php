<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Like extends Model
{
  use HasFactory;

  protected $fillable = [
    'sender_id',
    'receiver_id',
  ];

  public function sendUsers(): HasMany
  {
    return $this->hasMany(User::class, 'sender_id');
  }

  public function receiverUsers(): HasMany
  {
    return $this->hasMany(User::class, 'receiver_id');
  }
}
