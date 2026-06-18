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
    Schema::create('coaches', function (Blueprint $table) {
        $table->id();
        $table->string('nombre', 100);
        $table->string('apellido', 100);
        $table->string('identificacion', 20)->unique();
        $table->string('telefono', 20)->nullable();
        $table->string('especialidad', 100);
        $table->string('certificacion')->nullable(); // Requerimiento explícito del documento
        $table->enum('estado', ['Activo', 'Inactivo'])->default('Activo');
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coaches');
    }
};
