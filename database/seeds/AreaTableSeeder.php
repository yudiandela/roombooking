<?php

use App\Area;
use Illuminate\Database\Seeder;

class AreaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $areas = [
            [
                'unit_id' => 62,
                'name' => 'Area Lantai 2',
                'description' => 'Area Perunggu'
            ],[
                'unit_id' => 62,
                'name' => 'Area Lantai 6',
                'description' => 'Area Perak'
            ],[
                'unit_id' => 62,
                'name' => 'Area Lantai 10',
                'description' => 'Area Emas'
            ],[
                'unit_id' => 62,
                'name' => 'Area Lantai 14',
                'description' => 'Area Palladium'
            ],[
                'unit_id' => 62,
                'name' => 'Area Lantai 16',
                'description' => 'Area Platinum'
            ],
        ];

        foreach ($areas as $area) {
            Area::create($area);
        }

    }
}
