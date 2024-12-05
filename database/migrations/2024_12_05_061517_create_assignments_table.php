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
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->string('assigner_employee_number')->nullable();
            $table->string('assignee_employee_number')->nullable();
            $table->foreignId('unit_id')->constrained('units')->nullable()->onDelete('cascade');
            $table->date('assignment_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('progress')->default('Pending');
            $table->text('kendala')->nullable();
            $table->foreign('assigner_employee_number')->references('employee_number')->on('employment_details')->onDelete('cascade');
            $table->foreign('assignee_employee_number')->references('employee_number')->on('employment_details')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignments');
    }
};
