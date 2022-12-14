<?php

namespace App\Usecases\Restaurant;
use Illuminate\Support\Facades\Auth;
use App\Models\RestaurantInformation;

class InitializeFetch
{
  public function __invoke($req)
  {
    $admin_user_id = Auth::id();
    $restaurants = RestaurantInformation::where('admin_user_id', $admin_user_id)->select(['id', 'restaurant_name'])->orderBy('display_order', 'asc')->get()->toArray();
    if(!$restaurants) $active_restaurant_id = $req->session()->has('active_restaurant_id') ? $req->session()->has('active_restaurant_id') : null;
    if($restaurants) $active_restaurant_id = $req->session()->has('active_restaurant_id') ? $req->session()->has('active_restaurant_id') : $restaurants[0]['id'];
    $response = ['restaurants' => $restaurants, 'active_restaurant_id' => $active_restaurant_id];
    return $response;
  }
}
