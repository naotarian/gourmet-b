<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', config('app.frontend_url'))->name('top');
Route::redirect('/login', config('app.frontend_url') . '/login')->name('login');
Route::redirect('/adminLogin', config('app.frontend_url') . '/admin/login')->name('adminLogin');
require __DIR__ . '/auth.php';
Route::prefix('admin')->name('admin.')->group(function () {
  require __DIR__ . '/admin.php';
});
