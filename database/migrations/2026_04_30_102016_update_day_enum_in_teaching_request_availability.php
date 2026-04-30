<?php

use App\Models\TeachingRequestAvailability;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */


    public function up(): void
    {
        Schema::table('teaching_request_availability', function (Blueprint $table) {
            //

            // Step 1: Delete 'fri' rows inside schema
            DB::table('teaching_request_availability')
                ->where('day', 'fri')
                ->delete();

            $table->enum('day', ['sun', 'mon', 'tue', 'wed', 'thu', 'sat'])->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teaching_request_availability', function (Blueprint $table) {
            //
            $table->enum('day', ['sun', 'mon', 'tue', 'wed', 'thu', 'fri'])->change();
        });
    }
};