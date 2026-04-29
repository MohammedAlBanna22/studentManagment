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
        Schema::create('teaching_requests', function (Blueprint $table) {
            $table->id();
             $table->foreignId('teacher_id')->constrained('teachers')->cascadeOnDelete();
             $table->enum('status', ['pending', 'approved', 'declined'])->default('pending');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teaching_requests');
    }
};