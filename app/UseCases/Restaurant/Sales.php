<?php

namespace App\Usecases\Restaurant;

use Illuminate\Support\Facades\Auth;
use App\Models\BusinessInformation;
use App\Models\RestaurantInformation;

class Sales
{
  public function __invoke($req)
  {
    $business_information = RestaurantInformation::where('id', $req->session()->get('active_restaurant_id'))->with('sales_information')->first();

    // $admin_user_id = Auth::id();
    // $active_restaurant_id = $req->session()->get('active_restaurant_id');
    // $restaurant = RestaurantInformation::where('admin_user_id', $admin_user_id)->where('id', $active_restaurant_id)->first();
    // $response = ['restaurant' => $restaurant, 'active_restaurant_id' => $active_restaurant_id];
    return $business_information;
  }
}
