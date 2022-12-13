<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MainCategory;
use App\Models\SubCategory;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['居酒屋', '和食', '洋食', '中華', 'アジア料理', 'カレー', '焼肉', '鍋', 'その他'];
        foreach ($categories as $key => $category) {
            MainCategory::create([
                'name' => $category,
                'display_order' => $key + 1,
            ]);
        }
        $categories1 = ['居酒屋', 'ワインバー', 'ダイニングバー', '立ち飲みバー'];
        $categories2 = ['寿司', '日本料理', 'すき焼き・しゃぶしゃぶ', 'うなぎ・あなご', '焼き鳥・串焼き', 'お好み焼き・もんじゃ焼き', '和食（その他）'];
        $categories3 = ['ハンバーグ・ステーキ', '鉄板焼き', 'ピザ・パスタ', 'ハンバーガー', 'オムライス・ハヤシライス', 'フレンチ', 'イタリアン'];
        $categories4 = ['中華料理', '餃子・肉まん', '中華麺'];
        $categories5 = ['韓国料理', '東南アジア料理', '中南米料理', 'アフリカ料理'];
        $categories6 = ['カレーライス', 'インドカレー', 'タイカレー', 'スープカレー'];
        $categories7 = ['焼肉・ホルモン', 'ジンギスカン'];
        $categories8 = ['もつ鍋', '水炊き鍋', '韓国鍋', 'ちゃんこ鍋', 'その他の鍋料理'];
        $categories9 = ['定食', '弁当'];
        foreach ($categories1 as $key => $category) {
            SubCategory::create([
                'name' => $category,
                'display_order' => $key + 1,
                'main_category_id' => 1,
            ]);
        }
        foreach ($categories2 as $key => $category) {
            SubCategory::create([
                'name' => $category,
                'display_order' => $key + 1,
                'main_category_id' => 2,
            ]);
        }
        foreach ($categories3 as $key => $category) {
            SubCategory::create([
                'name' => $category,
                'display_order' => $key + 1,
                'main_category_id' => 3,
            ]);
        }
        foreach ($categories4 as $key => $category) {
            SubCategory::create([
                'name' => $category,
                'display_order' => $key + 1,
                'main_category_id' => 4,
            ]);
        }
        foreach ($categories5 as $key => $category) {
            SubCategory::create([
                'name' => $category,
                'display_order' => $key + 1,
                'main_category_id' => 5,
            ]);
        }
        foreach ($categories6 as $key => $category) {
            SubCategory::create([
                'name' => $category,
                'display_order' => $key + 1,
                'main_category_id' => 6,
            ]);
        }
        foreach ($categories7 as $key => $category) {
            SubCategory::create([
                'name' => $category,
                'display_order' => $key + 1,
                'main_category_id' => 7,
            ]);
        }
        foreach ($categories8 as $key => $category) {
            SubCategory::create([
                'name' => $category,
                'display_order' => $key + 1,
                'main_category_id' => 8,
            ]);
        }
        foreach ($categories9 as $key => $category) {
            SubCategory::create([
                'name' => $category,
                'display_order' => $key + 1,
                'main_category_id' => 9,
            ]);
        }
    }
}
