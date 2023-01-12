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
        $city = [
            '横浜',
            '川崎',
            '横須賀',
            '鎌倉',
            '逗子',
            '三浦',
            '葉山',
            '相模原',
            '厚木',
            '大和',
            '海老名',
            '座間',
            '綾瀬',
            '愛川',
            '平塚',
            '藤沢',
            '茅ヶ崎',
            '秦野',
            '伊勢原',
            '小田原',
        ];
        $datas = [
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
        ];
        foreach ($city as $key => $c) {
            $datas['restaurant_name'] = 'テスト店舗' . $c . '店';
            $datas['restaurant_email'] = 'tenpo' . sprintf('%02d', $key) . '@test.com';
            $datas['feature'] = 'テスト' . sprintf('%02d', $key) . 'です。';
            $datas['address_after'] = 'テスト' . sprintf('%02d', $key) . 'ビル';
            RestaurantInformation::create($datas);
        }
        // foreach ($datas as $data) {
        //     RestaurantInformation::create($data);
        // }
    }
}
