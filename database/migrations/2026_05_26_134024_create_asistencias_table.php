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
    Schema::create('asistencias', function (Blueprint $table) {
        $table->id();
        $table->foreignId('alumno_id')->constrained('alumnos')->onDelete('cascade');
        $table->foreignId('grupo_id')->constrained('grupos')->onDelete('cascade');
        $table->date('fecha_sesion');
        $table->enum('asistencia', ['Asistió', 'Faltó', 'Excusa'])->default('Asistió');
        $table->text('observaciones_progreso')->nullable(); // Para cumplir con el "progreso por sesión" del doc
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asistencias');
    }
};
