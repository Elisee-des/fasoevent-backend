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
            $table->uuid('id')->primary(); // ID sous forme d’UUID
            $table->string('title'); // Titre de l’événement
            $table->text('description'); // Description de l’événement
            $table->dateTime('start_date'); // Date de début
            $table->dateTime('end_date'); // Date de fin
            $table->uuid('city_id'); // Clé étrangère vers la ville
            $table->decimal('price', 8, 2); // Prix d’entrée
            $table->string('image'); // Chemin de l’image
            $table->boolean('is_active')->default(true); // Statut actif/inactif
            $table->timestamps(); // Champs created_at et updated_at
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade'); // Contrainte de clé étrangère
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
