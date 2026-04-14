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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('student_number')->unique()->nullable();
            $table->string('fname');
            $table->string('mname')->nullable();
            $table->string('lname');
            $table->integer('age');
            $table->enum('gender', ['Male', 'Female']);
            $table->string('address');
            $table->enum('program', [
                'BSIT',
                'BSCS',
                'BSBA',
                'BSA',
                'BSN',
                'BS Pharmacy',
                'BA Comm',
                'BA Psych',
                'BSCE',
                'BS Arch'
            ]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
