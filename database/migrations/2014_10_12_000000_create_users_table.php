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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->string('slug')->unique();
            $table->integer('plur_points')->default(0);
            $table->string('link_one')->nullable();
            $table->string('link_two')->nullable();
            $table->string('link_three')->nullable();
            $table->string('link_four')->nullable();
            $table->string('link_five')->nullable();
            $table->string('link_six')->nullable();
            $table->string('link_seven')->nullable();
            $table->string('link_eight')->nullable();
            $table->string('link_nine')->nullable();
            $table->string('link_ten')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
