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
        Schema::create('event_user', function (Blueprint $table) {
            $table->uuid('user_id'); // Clé étrangère vers users
            $table->uuid('event_id'); // Clé étrangère vers events
            $table->timestamps(); // Champs created_at et updated_at
            $table->primary(['user_id', 'event_id']); // Clé primaire composite
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Contrainte user
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade'); // Contrainte event
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_user');
    }
};
