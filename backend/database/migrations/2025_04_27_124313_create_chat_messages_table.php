<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('chat_messages', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('user_id')->comment('ユーザーID');
      $table->unsignedBigInteger('chat_room_id')->comment('チャットルームID');
      $table->text('message')->comment('メッセージ');
      $table->datetimes();

      $table->foreign('user_id')->references('id')->on('users');
      $table->foreign('chat_room_id')->references('id')->on('chat_rooms');
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('chat_messages');
  }
};
