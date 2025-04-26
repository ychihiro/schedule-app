<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reserves', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->date('start_date');
            $table->string('guest_name');
            $table->string('guest_email');
            $table->unsignedInteger('status_id');
            $table->unsignedInteger('person_count');
            $table->string('golf_course_name');
            $table->string('golf_course_image_url1');
            $table->string('golf_course_image_url2');
            $table->string('golf_course_image_url3');
            $table->string('golf_course_image_url4');
            $table->string('golf_course_image_url5');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reserves');
    }
};
