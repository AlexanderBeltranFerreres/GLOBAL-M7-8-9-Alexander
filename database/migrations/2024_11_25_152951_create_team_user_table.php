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
        Schema::create('team_user', function (Blueprint $table) {
            $table->id();
            // Definir les relacions amb les taules 'teams' i 'users' mitjançant les claus foranes
            $table->foreignId('team_id')->constrained()->onDelete('cascade'); // Relació amb la taula 'teams'
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relació amb la taula 'users'
            $table->string('role')->nullable(); // Permet afegir un rol opcional per a l'usuari dins de l'equip
            $table->timestamps();

            // Unicitat de la combinació 'team_id' i 'user_id' per evitar duplicats
            $table->unique(['team_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Eliminar la taula 'team_user' en cas que es reverteixi la migració
        Schema::dropIfExists('team_user');
    }
};
