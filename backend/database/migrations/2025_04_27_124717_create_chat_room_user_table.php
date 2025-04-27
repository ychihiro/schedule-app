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
      $table->unsignedBigInteger('user_id')->comment('ユーザーID');
      $table->unsignedBigInteger('chat_room_id')->comment('チャットルームID');
      $table->datetimes();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('chat_room_user');
  }
};
