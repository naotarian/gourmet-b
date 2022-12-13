<?php

namespace App\Usecases\Restaurant;

use App\Models\MainCategory;
use App\Models\SubCategory;

class RegisterFetch
{
  public function __invoke()
  {
    $main_categories = MainCategory::all()->toArray();
    $sub_categories = SubCategory::all()->toArray();
    $response = [
      'main_categories' => $main_categories,
      'sub_categories' => $sub_categories
    ];
    \Log::info($response);
    return $response;
  }
}
