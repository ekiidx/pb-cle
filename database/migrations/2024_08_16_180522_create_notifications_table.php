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
        Schema::create('notifications', function (Blueprint $table) {
            // $table->uuid('id')->primary();
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->integer('receiver_id');
            $table->string('type');
            // $table->morphs('notifiable');
            $table->text('message');
            $table->string('community_slug')->nullable();
            $table->string('post_slug')->nullable();
            $table->string('post_title')->nullable();
            $table->string('event_slug')->nullable();
            $table->string('event_name')->nullable();
            // $table->timestamp('read_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
