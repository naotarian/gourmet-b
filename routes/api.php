<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Api\Admin\RestaurantController as AdminRestaurant;
use App\Http\Controllers\Api\Portal\PortalTopController as PortalTop;
use App\Http\Controllers\Api\Admin\SeatController as AdminSeat;
use App\Http\Controllers\Api\Portal\ReserveController as PortalReserve;
use App\Http\Controllers\Api\Admin\ReserveController as AdminReserve;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware(['auth:sanctum', 'verified'])->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware(['auth:sanctum', 'verified'])->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware(['auth:admin', 'verified'])->get('/admin/user', function (Request $request) {
    return $request->user();
});
Route::controller(UserController::class)->group(function () {
    Route::post('/user_info', 'user_info');
    Route::get('/my_page', 'my_page');
});

Route::middleware(['auth:admin'])->prefix('admin')->group(function () {
    Route::prefix('restaurant')->group(function () {
        Route::controller(AdminRestaurant::class)->group(function () {
            Route::get('/register', 'registerFetch');
            Route::get('/initialize', 'initializeFetch');
            Route::post('/register', 'register');
            Route::get('/list', 'list');
            Route::get('/information', 'information');
            Route::post('/display_change', 'display_change');
            Route::get('/sales_fetch', 'sales_fetch');
            Route::post('/update_sales', 'update_sales');
        });
    });
    Route::prefix('seats')->group(function () {
        Route::controller(AdminSeat::class)->group(function () {
            Route::get('/seats_fetch', 'seats_fetch');
            Route::post('/seats_register', 'seats_register');
            Route::post('/seats_update', 'seats_update');
        });
    });
    Route::prefix('reserve')->group(function () {
        Route::controller(AdminReserve::class)->group(function () {
            Route::get('/list', 'list');
            Route::post('/detail', 'detail');
        });
    });
    Route::controller(AdminRestaurant::class)->group(function () {
        Route::post('/imageUpload', 'imageUpload');
    });
});
Route::controller(PortalTop::class)->group(function () {
    Route::prefix('portal')->group(function () {
        Route::get('/top', 'top');
        Route::post('/list', 'list');
        Route::post('/store/detail', 'store_detail');
    });
});
Route::controller(PortalReserve::class)->group(function () {
    Route::prefix('reserve')->group(function () {
        Route::post('/reserve_session_save', 'reserve_session_save');
        Route::get('/reserve_session_fetch', 'reserve_session_fetch');
        Route::post('/confirm', 'confirm');
        Route::get('/confirm_session_fetch', 'confirm_session_fetch');
        Route::post('/execution', 'execution');
    });
});
