<?php

namespace App\Usecases\Restaurant;

use App\Models\RestaurantInformation;


class RegisterPost
{
  public function __invoke($datas)
  {
    $admin_user = $datas->user();
    $restaurant = RestaurantInformation::create([
      'admin_user_id' => $admin_user['id'],
      'restaurant_name' => $datas['restaurantName'],
      'restaurant_email' => $datas['restaurantEmail'],
      'post_number' => $datas['restaurantPostNumber'],
      'address' => $datas['address'],
      'address_after' => $datas['addressAfter'],
      'is_reserve' => false,
      'is_display' => false,
      'representative_tel' => $datas['restaurantTel'],
      'feature' => $datas['feature'],
      'lunch_budget_id' => $datas['lunchBudget'],
      'dinner_budget_id' => $datas['dinnerBudget'],
      'main_category_id' => $datas['mainCategoryId'],
      'sub_category_id' => $datas['subCategoryId'],
    ]);
    return $restaurant;
  }
}
