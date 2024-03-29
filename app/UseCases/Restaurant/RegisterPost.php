<?php

namespace App\Usecases\Restaurant;

use App\Models\RestaurantInformation;


class RegisterPost
{
  public function __invoke($datas)
  {
    $admin_user = $datas->user();
    $count = RestaurantInformation::where('admin_user_id', $admin_user['id'])->count();
    $restaurant = RestaurantInformation::create([
      'admin_user_id' => $admin_user['id'],
      'restaurant_name' => $datas['restaurantName'],
      'restaurant_email' => $datas['restaurantEmail'],
      'post_number' => $datas['restaurantPostNumber'],
      'address' => $datas['address'],
      'address_after' => $datas['addressAfter'],
      'is_reserve' => false,
      'is_display' => false,
      'display_order' => $count + 1,
      'restaurant_tel' => $datas['restaurantTel'],
      'feature' => $datas['feature'],
      'lunch_budget_id' => $datas['lunchBudget'],
      'dinner_budget_id' => $datas['dinnerBudget'],
      'main_category_id' => $datas['mainCategoryId'],
      'sub_category_id' => $datas['subCategoryId'],
      'representative_tel' => $datas['representativeTel'],
      'is_take_out' => $datas['takeOut'],
    ]);
    $restaurant['unique_code'] = hash('crc32', $restaurant['id']);
    $restaurant->save();
    return $restaurant;
  }
}
