<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('chat_rooms', function (Blueprint $table) {
      $table->id();
      $table->string('name')->nullable()->comment('チャットルーム名');
      $table->datetimes();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('chat_rooms');
  }
};
