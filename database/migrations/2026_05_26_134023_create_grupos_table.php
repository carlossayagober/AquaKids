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
    Schema::create('grupos', function (Blueprint $table) {
        $table->id();
        $table->string('nombre_grupo', 100);
        $table->foreignId('coach_id')->constrained('coaches')->onDelete('cascade');
        $table->foreignId('nivel_id')->constrained('niveles')->onDelete('cascade'); // El grupo pertenece a un nivel específico
        $table->string('horario', 50);
        $table->integer('cupo_maximo')->default(15);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grupos');
    }
};
