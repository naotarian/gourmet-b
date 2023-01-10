<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Area;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $areas = ['北海道・東北', '関東', '北陸・甲信越', '中部', '関西', '中国', '四国', '九州・沖縄'];
        foreach ($areas as $key => $area) {
            Area::create([
                'name' => $area,
                'area_number' => $key + 1,
                'alias' => 'AR' . ($key + 1),
            ]);
        }
    }
}
