<?php

use App\Unit;
use Illuminate\Database\Seeder;

class UnitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $units = [
            ['id' => 54, 'name' => 'MNCTV'],
            ['id' => 55, 'name' => 'RCTI'],
            ['id' => 56, 'name' => 'GTV'],
            ['id' => 57, 'name' => 'MNC PLAY'],
            ['id' => 58, 'name' => 'MNC NOW'],
            ['id' => 59, 'name' => 'MNC BANK'],
            ['id' => 60, 'name' => 'The F Thing'],
            ['id' => 61, 'name' => 'MNC GROUP'],
            ['id' => 62, 'name' => 'INEWS'],
            ['id' => 63, 'name' => 'Star Media'],
        ];

        foreach ($units as $unit) {
            Unit::create($unit);
        }
    }
}
