<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('chat_room_user', function (Blueprint $table) {
      $table->id();
      $table->foreignId('user_id')->constrained()->cascadeOnDelete()->comment('ユーザーID');
      $table->foreignId('chat_room_id')->constrained()->cascadeOnDelete()->comment('チャットルームID');
      $table->softDeletesDatetime();
      $table->datetimes();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('chat_room_user');
  }
};
