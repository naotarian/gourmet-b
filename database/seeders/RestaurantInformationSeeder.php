<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RestaurantInformation;

class RestaurantInformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            [
                'admin_user_id' => 1,
                'restaurant_name' => 'テスト店舗横浜店',
                'restaurant_email' => 'tenpo01@test.com',
                'restaurant_tel' => '09000000000',
                'notification_email' => NULL,
                'post_number' => '2310000',
                'address' => '神奈川県横浜市中区',
                'address_after' => 'テスト01ビル',
                'display_order' => 1,
                'is_reserve' => 0,
                'is_display' => 0,
                'is_take_out' => 1,
                'representative_name' => NULL,
                'representative_tel' => '09000000000',
                'feature' => 'テスト01です。',
                'lunch_budget_id' => 1,
                'dinner_budget_id' => 3,
                'main_category_id' => 1,
                'sub_category_id' => 1,
                'area_id' => 2,
                'prefecture_id' => 14,
            ],
            [
                'admin_user_id' => 1,
                'restaurant_name' => 'テスト店舗川崎店',
                'restaurant_email' => 'tenpo02@test.com',
                'restaurant_tel' => '09000000000',
                'notification_email' => NULL,
                'post_number' => '2100847',
                'address' => '神奈川県川崎市川崎区',
                'address_after' => 'テスト02ビル',
                'display_order' => 1,
                'is_reserve' => 0,
                'is_display' => 0,
                'is_take_out' => 1,
                'representative_name' => NULL,
                'representative_tel' => '09000000000',
                'feature' => 'テスト02です。',
                'lunch_budget_id' => 1,
                'dinner_budget_id' => 3,
                'main_category_id' => 1,
                'sub_category_id' => 2,
                'area_id' => 2,
                'prefecture_id' => 14,
            ],
        ];
        foreach($datas as $data) {
            RestaurantInformation::create($data);
        }
    }
}
