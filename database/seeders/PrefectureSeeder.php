<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Prefecture;

class PrefectureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $prefectures = ["北海道","青森県","岩手県","宮城県","秋田県","山形県","福島県",
        "茨城県","栃木県","群馬県","埼玉県","千葉県","東京都","神奈川県",
        "新潟県","富山県","石川県","福井県","山梨県","長野県","岐阜県",
        "静岡県","愛知県","三重県","滋賀県","京都府","大阪府","兵庫県",
        "奈良県","和歌山県","鳥取県","島根県","岡山県","広島県","山口県",
        "徳島県","香川県","愛媛県","高知県","福岡県","佐賀県","長崎県",
        "熊本県","大分県","宮崎県","鹿児島県","沖縄県"];

        foreach ($prefectures as $key => $prefecture) {
            if($key <= 6) {
                Prefecture::create([
                    'name' => $prefecture,
                    'prefecture_number' => $key + 1,
                    'area_id' => 1,
                    'alias' => 'PF' . ($key + 1),
                ]);
            } elseif($key <= 13) {
                Prefecture::create([
                    'name' => $prefecture,
                    'prefecture_number' => $key + 1,
                    'area_id' => 2,
                    'alias' => 'PF' . ($key + 1),
                ]);
            } elseif($key <= 19){
                Prefecture::create([
                    'name' => $prefecture,
                    'prefecture_number' => $key + 1,
                    'area_id' => 3,
                    'alias' => 'PF' . ($key + 1),
                ]);
            } elseif($key <= 23){
                Prefecture::create([
                    'name' => $prefecture,
                    'prefecture_number' => $key + 1,
                    'area_id' => 4,
                    'alias' => 'PF' . ($key + 1),
                ]);
            } elseif($key <= 29){
                Prefecture::create([
                    'name' => $prefecture,
                    'prefecture_number' => $key + 1,
                    'area_id' => 5,
                    'alias' => 'PF' . ($key + 1),
                ]);
            } elseif($key <= 34){
                Prefecture::create([
                    'name' => $prefecture,
                    'prefecture_number' => $key + 1,
                    'area_id' => 6,
                    'alias' => 'PF' . ($key + 1),
                ]);
            } elseif($key <= 38){
                Prefecture::create([
                    'name' => $prefecture,
                    'prefecture_number' => $key + 1,
                    'area_id' => 7,
                    'alias' => 'PF' . ($key + 1),
                ]);
            } else {
                Prefecture::create([
                    'name' => $prefecture,
                    'prefecture_number' => $key + 1,
                    'area_id' => 8,
                    'alias' => 'PF' . ($key + 1),
                ]);
            }
        }
    }
}
