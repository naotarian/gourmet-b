<?php

namespace App\Http\Controllers\Api\Portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Area;
use App\Models\Prefecture;
use App\Models\MainCategory;
use App\Models\Seat;
use App\Models\Budget;
use App\Models\RestaurantInformation;
use App\Http\Controllers\Api\CommonController;
use Carbon\Carbon;


class PortalTopController extends Controller
{
    public function __constract()
    {
    }
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
        //予約カレンダー表示作成
        $today = Carbon::today();
        $start = Carbon::today()->startOfWeek()->subDay(1);
        //今月末
        $end_of_month = Carbon::now()->endOfMonth()->toDateString();
        //今月初
        $start_of_month = Carbon::now()->startOfMonth();
        $reserve_calendar = array_chunk($this->reserve_arrow($start, $start->diffInDays($end_of_month)), 7);
        $reserve_calendar_next = $this->reserve_arrow($end_of_month, 30 - $start->diffInDays($end_of_month));
        //翌月用カレンダーが月曜始まりではない場合、空配列を挿入
        $dow = [
            '月' => 0,
            '火' => 1,
            '水' => 2,
            '木' => 3,
            '金' => 4,
            '土' => 5,
            '日' => 6,
        ];
        $addDay = $dow[$reserve_calendar_next[0]['dow']];
        if ($dow[$reserve_calendar_next[0]['dow']] !== 0) {
            for ($i = 0; $i < $addDay; $i++) {
                array_unshift($reserve_calendar_next, [
                    'date' => '',
                    'seats' => [],
                    'dow' => '',
                    'status' => '',
                ]);
            }
        }
        $reserve_calendar_next = array_chunk($reserve_calendar_next, 7);
        $current_month = Carbon::today()->format('Y年m月');
        $next_month = Carbon::now()->endOfMonth()->addDay(1)->format('Y年m月');
        //予約カレンダーに表示する時間の作成
        $now = Carbon::now();
        //何分区切りにするか
        $separator_time = 15;
        $reserve_time_list = [];
        $reserve_push_time = $now->copy()->addMinute(($separator_time * ($i + 1)) - $now->minute % $separator_time)->format('H:i');
        $num = 0;
        while ($reserve_push_time <= $store['sales_information']['late_reserve']) {
            $num++;
            array_push($reserve_time_list, $now->copy()->addMinute(($separator_time * ($num)) - $now->minute % $separator_time)->format('H:i'));
            $reserve_push_time = $now->copy()->addMinute(($separator_time * ($num)) - $now->minute % $separator_time)->format('H:i');
        }
        //最後の要素削除
        array_pop($reserve_time_list);
        $store['reserve_time_list'] = $reserve_time_list;
        $contents = [
            'store' => $store,
            'images' => $images,
            'reserve_calendar' => $reserve_calendar,
            'reserve_calendar_next' => $reserve_calendar_next,
            'current_month' => $current_month,
            'next_month' => $next_month,
        ];
        return response()->json($contents);
    }
    /**
     * Undocumented function
     *
     * @param [date] $start
     * @param [integer] $range
     * @return void
     */
    public function reserve_arrow($start, $range)
    {
        $dow = [
            '日',
            '月',
            '火',
            '水',
            '木',
            '金',
            '土',
        ];
        $reserve_calendar = [];
        $today = Carbon::today()->format('Y/m/d');
        for ($i = 1; $i <= $range; $i++) {
            $start_date = new Carbon($start);
            $date = $start_date->addDay($i)->format('Y/m/d');
            $reserve_calendar[$i - 1]['disabled'] = $date < $today ? true : false;
            $reserve_calendar[$i - 1]['date'] = $date;
            $reserve_calendar[$i - 1]['seats'] = Seat::all()->toArray();
            $reserve_calendar[$i - 1]['dow'] = $dow[$start_date->dayOfWeek];
            if (count($reserve_calendar[$i - 1]['seats']) >= 3) {
                $reserve_calendar[$i - 1]['status'] = '◎';
            } elseif (count($reserve_calendar[$i - 1]['seats']) >= 2) {
                $reserve_calendar[$i - 1]['status'] = '〇';
            } elseif (count($reserve_calendar[$i - 1]['seats']) >= 1) {
                $reserve_calendar[$i - 1]['status'] = '△';
            } else {
                $reserve_calendar[$i - 1]['status'] = '×';
            }
        }
        return $reserve_calendar;
    }
}
