<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Budget;

class BudgetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $budgets = [
            '~1000円',
            '1000円~2000円',
            '2000円~3000円',
            '3000円~4000円',
            '4000円~5000円',
            '5000円~6000円',
            '~10000円',
            '10000円~',
            '設定無し'
          ];
          foreach ($budgets as $key => $budget) {
            Budget::create([
                'price' => $budget,
            ]);
        }
    }
}
