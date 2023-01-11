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
        //検索
        $restaurants = RestaurantInformation::where('main_category_id', $search_modules['MC'])->where('prefecture_id', $search_modules['PF'])
            ->where('lunch_budget_id', $search_modules['PR'])
            ->orWhere('dinner_budget_id', $search_modules['PR'])
            ->with('lunch')
            ->with('dinner')
            ->get();
        //検索結果件数
        $search_number = RestaurantInformation::where('main_category_id', $search_modules['MC'])->where('prefecture_id', $search_modules['PF'])
            ->where('lunch_budget_id', $search_modules['PR'])
            ->orWhere('dinner_budget_id', $search_modules['PR'])
            ->with('lunch')
            ->with('dinner')
            ->count();

        $contents = ['restaurants' => $restaurants, 'search_number' => $search_number, 'search_modules' => $search_modules];
        return response()->json($contents);
    }
}
