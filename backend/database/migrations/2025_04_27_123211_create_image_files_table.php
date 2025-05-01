<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('image_files', function (Blueprint $table) {
      $table->id();
      $table->foreignId('user_id')->constrained()->cascadeOnDelete()->comment('ユーザーID');
      $table->string('file_name')->comment('画像ファイル名');
      $table->string('storage_key')->comment('画像ファイルパス');
      $table->softDeletesDatetime();
      $table->datetimes();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('image_files');
  }
};
