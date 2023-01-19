<?php

namespace App\Usecases\Restaurant;

use Illuminate\Support\Facades\Auth;
use App\Models\SalesInformation;
use App\Models\RestaurantInformation;

class SalesUpdate
{
  public function __invoke($req)
  {
    $sales_information = SalesInformation::where('store_id', $req->session()->get('active_restaurant_id'))->first();
    $sales_information['start_business'] = $req['startOfBusiness'];
    $sales_information['end_business'] = $req['endOfBusiness'];
    $sales_information['regular_holiday'] = $req['regularHoliday'];
    $sales_information['late_reserve'] = $req['reserveLate'];
    $sales_information['time_remarks'] = $req['timeRemarks'];
    $sales_information['regular_holiday_remarks'] = $req['regularHolidayRemarks'];
    if (!$sales_information->isDirty()) {
      $res = ['msg' => '変更がありません。'];
      return $res;
    }
    $sales_information->save();
    $res = ['msg' => '営業情報を更新しました。'];
    return $res;

    // \Log::info($sales_information);

    // $admin_user_id = Auth::id();
    // $active_restaurant_id = $req->session()->get('active_restaurant_id');
    // $restaurant = RestaurantInformation::where('admin_user_id', $admin_user_id)->where('id', $active_restaurant_id)->first();
    // $response = ['restaurant' => $restaurant, 'active_restaurant_id' => $active_restaurant_id];
    // return $business_information;
  }
}
