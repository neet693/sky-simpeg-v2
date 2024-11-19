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
        Schema::create('employee_childrens', function (Blueprint $table) {
            $table->id();
            $table->string('employee_number')->nullable();
            $table->string('name')->nullable();
            $table->string('birth_place')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('gender')->nullable();
            $table->string('education')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('allowance_status')->nullable();
            $table->text('notes')->nullable();
            $table->foreign('employee_number')->references('employee_number')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_childrens');
    }
};
