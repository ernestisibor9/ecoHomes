<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FacilitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $facilities = [
            ['name' => 'Wi-Fi'],
            ['name' => 'Swimming Pool'],
            ['name' => 'Parking'],
            ['name' => 'Gym'],
            ['name' => 'Spa'],
            ['name' => 'Restaurant'],
            ['name' => '24/7 Room Service'],
            ['name' => 'Laundry Service'],
        ];
        DB::table('facilities')->insert($facilities);
    }
}
