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
        Schema::create('traning_courses_enrolments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('studentID')->references('id')->on('students')->onUpdate('cascade');
            $table->foreignId('traning_courses_id')->references('id')->on('traning_courses')->onUpdate('cascade');
            $table->date('enrolments_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('traning_courses_enrolments');
    }
};
