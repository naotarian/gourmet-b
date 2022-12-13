<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $aes_key = config('app.aes_key');
        $aes_type = config('app.aes_type');
        Admin::create([
            'name' => openssl_encrypt('admin01', $aes_type, $aes_key),
            'email' => openssl_encrypt('admin01@test.com', $aes_type, $aes_key),
            'email_verified_at' => '2022-12-12 22:13:28',
            'password' => Hash::make('aaaaaaaa'),
            'created_at' => '2022-12-12 22:12:59',
        ]);
        User::create([
            'name' => openssl_encrypt('test01', $aes_type, $aes_key),
            'email' => openssl_encrypt('test01@test.com', $aes_type, $aes_key),
            'email_verified_at' => '2022-12-12 22:13:28',
            'password' => Hash::make('aaaaaaaa'),
            'created_at' => '2022-12-12 22:12:59',
        ]);
    }
}
