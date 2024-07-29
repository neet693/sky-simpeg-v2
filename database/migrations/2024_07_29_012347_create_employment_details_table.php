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
        Schema::create('employment_details', function (Blueprint $table) {
            $table->id();
            $table->string('employee_number');
            $table->date('tahun_masuk')->nullable();
            $table->foreignId('unit_id')->constrained('units')->nullable()->onDelete('cascade');
            $table->date('tahun_sertifikasi')->nullable();
            $table->string('status_kepegawaian')->default('tidak_tetap')->nullable();
            $table->timestamps();

            $table->foreign('employee_number')->references('employee_number')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employment_details');
    }
};
