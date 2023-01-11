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
    public function top() {
        $areas = Area::all();
        $prefectures = Prefecture::all();
        $main_categories = MainCategory::all();
        $budgets = Budget::all();
        $contents = ['areas' => $areas, 'prefectures' => $prefectures, 'main_categories' => $main_categories, 'budgets' => $budgets];
        return response()->json($contents);
    }
    public function list(Request $request) {
        $datas = $request['datas'];
        $common = new CommonController;
        $search_modules = $common->changeAlias($datas);
        $restaurants = RestaurantInformation::where('main_category_id', $search_modules['MC'])->where('prefecture_id', $search_modules['PF'])
        ->where('lunch_budget_id', $search_modules['PR'])
        ->orWhere('dinner_budget_id', $search_modules['PR'])
        ->get();
        return response()->json($restaurants);
    }
}
