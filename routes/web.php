<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return view('testing');
});

Auth::routes();

/*-------Consumer authentication------ */
//Facebook login
Route::get('/consumer/login',[App\Http\Controllers\Consumer\ConsumerLoginController::class, 'login'])->name('consumer-login');
Route::get('/consumer/login/facebook/redirect',[App\Http\Controllers\Consumer\ConsumerLoginController::class, 'facebookRedirect'])->name('facebook-redirect');
Route::get('/consumer/login/facebook/callback',[App\Http\Controllers\Consumer\ConsumerLoginController::class, 'facebookCallback'])->name('facebook-callback');

/*------After Consumer Successfull login------*/
Route::group(['middleware' => 'auth:consumer'], function () {

    Route::get('/consumer/index', [App\Http\Controllers\Consumer\ConsumerController::class, 'index'])->name('consumer-index'); 

});

/*------Admin authentication------*/
Route::get('/admin/login',[App\Http\Controllers\Admin\AdminLoginController::class,'admin_login']);
Route::get('/admin/register',[App\Http\Controllers\Admin\AdminRegisterController::class,'admin_register']);
Route::post('/admin/register-admin',[App\Http\Controllers\Admin\AdminRegisterController::class,'admin_register_success'])->name('register-admin');
Route::post('/admin/login-admin',[App\Http\Controllers\Admin\AdminLoginController::class,'admin_login_success'])->name('login-admin');

/*------After Admin Successfull login------*/
Route::group(['middleware' => 'auth:admin'], function () {
    
    /*-----Admin Account -----------------*/
    Route::get('/admin/account', function () {
        return view('admin.admin_account');
    });

    /*------Logout-------*/
    Route::get('/admin/logout', [App\Http\Controllers\Admin\AdminLoginController::class, 'logout']);

    /*------Dashboard------*/
    Route::get('/admin/dashboard',[App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin-dashboard');

    /*------Product------*/
    Route::get('/admin/product', [App\Http\Controllers\Admin\ProductController::class, 'product_list']);
    Route::get('/admin/product/add', [App\Http\Controllers\Admin\ProductController::class, 'product_add']);
    Route::post('/admin/product/add/store', [App\Http\Controllers\Admin\ProductController::class, 'product_store']);
    Route::get('/admin/product/edit/{id}', [App\Http\Controllers\Admin\ProductController::class, 'product_edit']);
    Route::post('/admin/product/update/status/{id}', [App\Http\Controllers\Admin\ProductController::class, 'product_update_status']);
    Route::post('/admin/product/update/{id}', [App\Http\Controllers\Admin\ProductController::class, 'product_update'])->name('product_update');
    Route::get('/admin/product/search', [App\Http\Controllers\Admin\ProductController::class, 'product_search']);

    /*------Order------*/
    Route::get('/admin/order/list', function () {
        return view('admin.sales_order.order_list');
    });
    Route::get('/admin/sales/list', function () {
        return view('admin.sales_order.sales_list');
    });
    Route::get('/admin/order/shipping', function () {
        return view('admin.sales_order.order_shipping_list');
    });

    /*------Live Session------*/
    Route::get('/admin/live/setup', function () {
        return view('admin.live.live_setup');
    });
    Route::get('/admin/live', function () {
        return view('admin.live.live_list');
    });
    Route::get('/admin/live/list_bid', function () {
        return view('admin.live.live_list_bid');
    });

    /*---------Consumer List----------*/
    Route::get('/admin/consumer_list', [App\Http\Controllers\Consumer\ConsumerController::class, 'consumer_list']);
    Route::get('/admin/consumer/search', [App\Http\Controllers\Consumer\ConsumerController::class, 'consumer_search']);

});

