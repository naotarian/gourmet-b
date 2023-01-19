<?php

namespace App\Http\Controllers\Api\Portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Area;
use App\Models\Prefecture;
use App\Models\MainCategory;
use App\Models\Budget;
use App\Models\RestaurantInformation;
use App\Http\Controllers\Api\CommonController;


class PortalTopController extends Controller
{
    public function top()
    {
        //各種マスタ取得
        $areas = Area::all();
        $prefectures = Prefecture::all();
        $main_categories = MainCategory::all();
        $budgets = Budget::all();
        $contents = ['areas' => $areas, 'prefectures' => $prefectures, 'main_categories' => $main_categories, 'budgets' => $budgets];
        return response()->json($contents);
    }
    public function list(Request $request)
    {
        $datas = $request['datas'];
        //各パラメータをIDに変換
        $common = new CommonController;
        $search_modules = $common->changeAlias($datas);
        $query = $search_modules[1];
        $search_modules = $search_modules[0];
        //検索
        $restaurant_query = RestaurantInformation::query();
        //料金指定有
        if (array_key_exists('PR', $search_modules)) {
            if ($search_modules['PR'] !== 9) $restaurant_query->where('lunch_budget_id', $search_modules['PR'])->orWhere('dinner_budget_id', $search_modules['PR']);
        }
        //メインカテゴリー指定有
        if (array_key_exists('MC', $search_modules)) $restaurant_query->where('main_category_id', $search_modules['MC']);
        //サブカテゴリー指定有
        if (array_key_exists('SC', $search_modules)) $restaurant_query->where('sub_category_id', $search_modules['SC']);
        //都道府県指定有
        if (array_key_exists('PF', $search_modules)) $restaurant_query->where('prefecture_id', $search_modules['PF']);
        $restaurants = $restaurant_query->with('lunch')->with('dinner')->get();
        //検索結果件数
        $search_number = $restaurant_query->count();

        $contents = ['restaurants' => $restaurants, 'search_number' => $search_number, 'search_modules' => $search_modules, 'query' => $query];
        return response()->json($contents);
    }

    public function store_detail(Request $request)
    {
        $store = RestaurantInformation::where('unique_code', $request['datas']['code'])
            ->with('sales_information')
            ->with('lunch')
            ->with('dinner')
            ->with('main_category')
            ->with('sub_category')
            ->with('slide')
            ->first();
        $images = array();
        if ($store['slide']) {
            foreach ($store['slide']['image_path'] as $key => $slide) {
                if (!empty($slide) && file_get_contents($slide)) {
                    switch (true) {
                        case preg_match('/(\.jpg)$|(\.jpeg)$|(\.JPEG)$|(\.JPG)$/', $slide):
                            $image_type = "image/jpeg";
                            break;
                        case preg_match('/(\.png)$|(\.PNG)$/', $slide):
                            $image_type = "image/png";
                            break;
                        case preg_match('/(\.gif)$|(\.GIF)$/', $slide):
                            $image_type = "image/gif";
                            break;
                        case preg_match('/(\.bmp)$|(\.BMP)$/', $slide):
                            $image_type = "image/bmp";
                            break;
                        default:
                            $image_type = "";
                            break;
                    }
                    if ($image_type != "") {
                        $img_base64 = base64_encode(file_get_contents($slide));
                        $entry_image = "data:" . $image_type . ";base64," . $img_base64;
                        $images[$key]['original'] = $entry_image;
                        $images[$key]['thumbnail'] = $entry_image;
                    }
                }
            }
        }
        $contents = ['store' => $store, 'images' => $images, 'test' => 'aaa'];
        return response()->json($contents);
    }
}
