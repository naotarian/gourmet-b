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
        if (array_key_exists('MC', $search_modules)) {
            $restaurant_query->where('main_category_id', $search_modules['MC']);
        }
        if (array_key_exists('PF', $search_modules)) {
            $restaurant_query->where('prefecture_id', $search_modules['PF']);
        }
        if (array_key_exists('PR', $search_modules)) {
            $restaurant_query->where('lunch_budget_id', $search_modules['PR'])->orWhere('dinner_budget_id', $search_modules['PR'])->with('lunch')->with('dinner');
        }
        $restaurants = $restaurant_query->get();
        //検索結果件数
        $search_number = $restaurant_query->count();

        $contents = ['restaurants' => $restaurants, 'search_number' => $search_number, 'search_modules' => $search_modules, 'query' => $query];
        return response()->json($contents);
    }
}
