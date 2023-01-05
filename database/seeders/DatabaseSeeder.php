<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('main_categories')->truncate();
        DB::table('sub_categories')->truncate();
        DB::table('budgets')->truncate();
        DB::table('users')->truncate();
        DB::table('admins')->truncate();
        DB::table('staff_colors')->truncate();
        DB::table('areas')->truncate();
        DB::table('prefectures')->truncate();
        $this->call([
            CategorySeeder::class,
            BudgetSeeder::class,
            UserSeeder::class,
            StaffColorSeeder::class,
            AreaSeeder::class,
            PrefectureSeeder::class
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
