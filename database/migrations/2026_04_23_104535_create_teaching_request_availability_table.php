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
        Schema::create('teaching_request_availability', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teaching_request_id')->constrained()->cascadeOnDelete();
            $table->enum('day', ['sun','mon','tue','wed','thu','fri']);
            $table->enum('period', ['A', 'B', 'both']);  // A=08–12, B=12–16, both=all day
            $table->unique(['teaching_request_id', 'day']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teaching_request_availability');
    }
};