<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ImageFile extends Model
{
  use HasFactory;

  protected $fillable = [
    'user_id',
    'file_name',
    'storage_key',
  ];

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }
}
