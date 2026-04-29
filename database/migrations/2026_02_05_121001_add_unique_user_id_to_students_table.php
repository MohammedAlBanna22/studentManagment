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
        Schema::table('students', function (Blueprint $table) {
            //
             // Make sure user_id exists first
        if (!Schema::hasColumn('students', 'user_id')) {
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        }

        // Add unique constraint for one-to-one
        $table->unique('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            //
            $table->dropUnique(['user_id']);
        });
    }
};