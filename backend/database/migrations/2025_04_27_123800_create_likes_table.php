<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('likes', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('sender_id')->comment('いいねしたユーザー');
      $table->unsignedBigInteger('receiver_id')->comment('いいねされたユーザー');
      $table->datetimes();

      $table->foreign('sender_id')->references('id')->on('users');
      $table->foreign('receiver_id')->references('id')->on('users');
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('likes');
  }
};
