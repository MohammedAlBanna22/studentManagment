<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\HourSlot;

class HourSlotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         HourSlot::insert([
        // Period A → 08:00 to 12:00
        ['label' => '08:00 – 09:00', 'from_time' => '08:00', 'to_time' => '09:00', 'period' => 'A', 'sort' => 1],
        ['label' => '09:00 – 10:00', 'from_time' => '09:00', 'to_time' => '10:00', 'period' => 'A', 'sort' => 2],
        ['label' => '10:00 – 11:00', 'from_time' => '10:00', 'to_time' => '11:00', 'period' => 'A', 'sort' => 3],
        ['label' => '11:00 – 12:00', 'from_time' => '11:00', 'to_time' => '12:00', 'period' => 'A', 'sort' => 4],

        // Period B → 12:00 to 16:00
        ['label' => '12:00 – 13:00', 'from_time' => '12:00', 'to_time' => '13:00', 'period' => 'B', 'sort' => 5],
        ['label' => '13:00 – 14:00', 'from_time' => '13:00', 'to_time' => '14:00', 'period' => 'B', 'sort' => 6],
        ['label' => '14:00 – 15:00', 'from_time' => '14:00', 'to_time' => '15:00', 'period' => 'B', 'sort' => 7],
        ['label' => '15:00 – 16:00', 'from_time' => '15:00', 'to_time' => '16:00', 'period' => 'B', 'sort' => 8],
    ]);
    }
}
