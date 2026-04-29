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
        Schema::table('hour_slots', function (Blueprint $table) {
            //
            $table->string('label');               // "08:00 – 09:00"
            $table->time('from_time');             // 08:00
            $table->time('to_time');               // 09:00
            $table->enum('period', ['A', 'B']);    // A = morning, B = afternoon
            $table->unsignedTinyInteger('sort');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hour_slots', function (Blueprint $table) {
            //

            $table->dropColumn([
            'label',
            'from_time',
            'to_time',
            'period',
            'sort',
            ]);

        });
    }
};