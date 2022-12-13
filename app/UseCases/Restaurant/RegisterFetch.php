<?php

namespace App\Usecases\Restaurant;

use App\Models\MainCategory;
use App\Models\SubCategory;
use App\Models\Budget;

class RegisterFetch
{
  public function __invoke()
  {
    $main_categories = MainCategory::all()->toArray();
    $sub_categories = SubCategory::all()->toArray();
    $budgets = Budget::all()->toArray();
    $response = [
      'main_categories' => $main_categories,
      'sub_categories' => $sub_categories,
      'budgets' => $budgets
    ];
    return $response;
  }
}
