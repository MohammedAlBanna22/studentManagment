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
        Schema::table('teacher', function (Blueprint $table) {
            //
                        // Check if user_id column doesn't exist before adding
        if (!Schema::hasColumn('teachers', 'user_id')) {
            Schema::table('teachers', function (Blueprint $table) {
                // Add user_id column after id
                $table->unsignedBigInteger('user_id')->after('id');

                // Add foreign key constraint
                $table->foreign('user_id')
                      ->references('id')
                      ->on('users')
                      ->onDelete('cascade');

                // Make it unique (one-to-one relationship)
                $table->unique('user_id');
            });
        }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teacher', function (Blueprint $table) {
            //
             $table->unsignedBigInteger('user_id')->nullable(false)->change();
        $table->foreign('user_id')
              ->references('id')
              ->on('users')
              ->onDelete('cascade');
        $table->unique('user_id');
        });
    }
};