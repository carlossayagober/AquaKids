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
    Schema::create('alumnos', function (Blueprint $table) {
        $table->id();
        $table->string('nombre', 100);
        $table->string('apellido', 100);
        $table->string('identificacion', 20)->unique()->nullable();
        $table->integer('edad'); // Requerimiento explícito
        $table->date('fecha_nacimiento');
        $table->text('observaciones_medicas')->nullable(); // Requerimiento explícito
        $table->string('acudiente_nombre', 150)->nullable();
        $table->string('acudiente_telefono', 20)->nullable();
        $table->foreignId('nivel_actual_id')->nullable()->constrained('niveles')->onDelete('set null'); // Conecta con niveles
        $table->enum('estado', ['Activo', 'Inactivo'])->default('Activo');
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumnos');
    }
};
