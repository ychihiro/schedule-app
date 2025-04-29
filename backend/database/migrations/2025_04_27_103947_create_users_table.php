<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('users', function (Blueprint $table) {
      $table->id();
      $table->string('first_name')->comment('名');
      $table->string('last_name')->comment('姓');
      $table->string('email')->unique()->comment('メールアドレス');
      $table->dateTime('email_verified_at')->nullable();
      $table->string('phone_number')->comment('電話番号');
      $table->string('password')->comment('パスワード');
      $table->string('nickname')->comment('ニックネーム');
      $table->integer('age')->comment('年齢');
      $table->tinyInteger('gender')->comment('性別 0:男性 1:女性 2:その他');
      $table->date('birthday')->comment('生年月日');
      $table->integer('prefecture_id')->comment('都道府県');
      $table->text('introduction')->comment('自己紹介文');
      $table->rememberToken();
      $table->softDeletesDatetime();
      $table->datetimes();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('users');
  }
};
