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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->string('flyer_front_upload')->nullable();
            $table->string('flyer_back_upload')->nullable();
            $table->string('link_event')->nullable();
            $table->string('link_tickets')->nullable();
            $table->date('event_date')->nullable();
            $table->integer('time_start_hours')->nullable();
            $table->integer('time_start_minutes')->nullable();
            $table->text('content')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
