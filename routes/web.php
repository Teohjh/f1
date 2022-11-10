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

Route::get('/error', function () {
    return view('error');
})->name('error');

Auth::routes();

/*-------Consumer authentication------ */
/*Facebook login
Route::get('/consumer/login',[App\Http\Controllers\Consumer\ConsumerLoginController::class, 'login'])->name('consumer-login');
Route::get('/consumer/login/facebook/redirect',[App\Http\Controllers\Consumer\ConsumerLoginController::class, 'facebookRedirect'])->name('facebook-redirect');
Route::get('/consumer/login/facebook/callback',[App\Http\Controllers\Consumer\ConsumerLoginController::class, 'facebookCallback'])->name('facebook-callback');
*/

Route::get('/consumer/login',[App\Http\Controllers\Consumer\ConsumerLoginController::class, 'login'])->name('consumer-login');
Route::post('/consumer/login-consumer',[App\Http\Controllers\Consumer\ConsumerLoginController::class,'consumer_login_success'])->name('login-success-consumer');


/*------After Consumer Successfull login------*/
Route::group(['middleware' => 'auth:consumer'], function () {

    Route::get('/consumer/index', [App\Http\Controllers\Consumer\ConsumerController::class, 'index'])->name('consumer-index'); 
    Route::get('/consumer/order_history', [App\Http\Controllers\Consumer\ConsumerController::class, 'order_history']); 

    /*------Consumer Logout-------*/
    Route::post('/consumer/logout', [App\Http\Controllers\Admin\ConsumerLoginController::class, 'consumer_logout'])->name('consumer_logout');

});

/*------Admin authentication------*/
Route::get('/admin/login',[App\Http\Controllers\Admin\AdminLoginController::class,'admin_login']);
Route::get('/admin/register',[App\Http\Controllers\Admin\AdminRegisterController::class,'admin_register']);
Route::post('/admin/register-admin',[App\Http\Controllers\Admin\AdminRegisterController::class,'admin_register_success'])->name('register-admin');
Route::post('/admin/login-admin',[App\Http\Controllers\Admin\AdminLoginController::class,'admin_login_success'])->name('login-admin');

/*------After Admin Successfull login------*/
Route::group(['middleware' => 'auth:admin'], function () {
    
    /*-----Admin Account -----------------*/
    Route::get('/admin/account',[App\Http\Controllers\Admin\AdminController::class, 'admin_account']);
    Route::post('/admin/account/edit',[App\Http\Controllers\Admin\AdminController::class, 'admin_account_edit']);
    Route::get('/facebook',  [App\Http\Controllers\Admin\AdminController::class, 'redirectToFacebookProvider'])->name('facebook');
    Route::get('/facebook/callback', [App\Http\Controllers\Admin\AdminController::class, 'handleProviderFacebookCallback']);
    Route::get('/facebook_page_id', [App\Http\Controllers\Admin\FacebookController::class, 'getPage'])->name('facebook_page_id');
    Route::get('/facebook/get_page_access_token', [App\Http\Controllers\Admin\FacebookController::class, 'getPageAccessToken'])->name('facebook_page_access_token');

    /*------Logout-------*/
    Route::post('/admin/logout', [App\Http\Controllers\Admin\AdminLoginController::class, 'logout'])->name('admin-logout');

    /*------Dashboard------*/
    Route::get('/admin/dashboard',[App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin-dashboard');

    /*------Product------*/
    Route::get('/admin/product', [App\Http\Controllers\Admin\ProductController::class, 'product_list'])->name('product_list');
    Route::get('/admin/product/add', [App\Http\Controllers\Admin\ProductController::class, 'product_add']);
    Route::post('/admin/product/add/store', [App\Http\Controllers\Admin\ProductController::class, 'product_store']);
    Route::get('/admin/product/edit/{id}', [App\Http\Controllers\Admin\ProductController::class, 'product_edit']);
    Route::post('/admin/product/hide/{id}', [App\Http\Controllers\Admin\ProductController::class, 'product_update_status_hide']);
    Route::post('/admin/product/shown/{id}', [App\Http\Controllers\Admin\ProductController::class, 'product_update_status_shown']);
    Route::post('/admin/product/edit/update', [App\Http\Controllers\Admin\ProductController::class, 'product_update'])->name('product_update');
    Route::get('/admin/product/search', [App\Http\Controllers\Admin\ProductController::class, 'product_search']);

    /*------Order------*/
    Route::get('/admin/sales/list', [App\Http\Controllers\Admin\SalesOrderController::class, 'sales_order_list']);
    Route::get('/admin/order/list',[App\Http\Controllers\Admin\OrderController::class, 'order_list']);
    Route::get('/admin/order/shipping',[App\Http\Controllers\Admin\OrderController::class, 'shipping_list']);

    /*---------Admin assist consumer to checkout ------------*/
    Route::post('/admin/sales/turn_order', [App\Http\Controllers\Admin\OrderController::class, 'turn_order'])->name('turn_order');
    Route::get('/admin/sales/checkout/{order_id}', [App\Http\Controllers\Admin\OrderController::class, 'order_checkout']);
    Route::post('/admin/sales/checkout/save/', [App\Http\Controllers\Admin\OrderController::class, 'save_checkout'])->name('save_checkout');
    

    /*------Live Session------*/
    Route::get('/admin/live/setup',[App\Http\Controllers\Admin\LiveController::class, 'live_setup'])->name('live_setup');
    Route::get('/admin/get_live',[App\Http\Controllers\Admin\FacebookController::class, 'getLiveNow'])->name('get_live_stream');
    Route::post('/admin/live/setup/successful',[App\Http\Controllers\Admin\LiveController::class, 'save_live']);
    Route::post('/admin/live/add_bid_product',[App\Http\Controllers\Admin\LiveController::class, 'save_bid_product'])->name('save_bid_product');
    Route::get('/admin/live/now/{live_stream_id}',[App\Http\Controllers\Admin\LiveController::class, 'ongoing_live'])->name('ongoing_live');
    Route::get('/admin/live/get_comment/{live_stream_id}',[App\Http\Controllers\Admin\FacebookController::class, 'getComment'])->name('getComment');
    Route::get('/admin/live/end_live/{live_stream_id}',[App\Http\Controllers\Admin\FacebookController::class, 'getEndLive'])->name('getEndLive');
    Route::get('/admin/live',[App\Http\Controllers\Admin\LiveController::class, 'live_list']);
    Route::get('/admin/live/get_product',[App\Http\Controllers\Admin\LiveController::class, 'get_product'])->name('get_product');

    /*--------Facebook Live Stream Comment List-------*/
    Route::get('/admin/live/comment/list', [App\Http\Controllers\Admin\FacebookController::class, 'comment_list'])->name('comment_list');
    /*--------Facebook Live Stream Bid Product List-----------*/
    Route::get('/admin/bid_product/list', [App\Http\Controllers\Admin\LiveController::class, 'bid_product_list'])->name('bid_product_list');
    /*--------Facebook Live Stream Start Bid Product------------*/
    Route::post('/admin/live/start_bid/{bid_id}', [App\Http\Controllers\Admin\FacebookController::class, 'start_bid']);
    /*--------Facebook Live Stream End Bid Product------------*/
    Route::post('/admin/live/end_bid/{bid_id}', [App\Http\Controllers\Admin\FacebookController::class, 'end_bid']);
    /*--------Facebook Live Stream Delete Bid Product------------*/
    Route::get('/admin/live/delete_bid/{bid_id}', [App\Http\Controllers\Admin\FacebookController::class, 'delete_bid_product']);

    /*--------Facebook Post---------*/
    Route::resource('post', 'PostController');
    Route::get('/admin/facebook/post', [App\Http\Controllers\Admin\PostController::class, 'post_list'])->name('facebook-post');
    Route::post('/admin/facebook/post/getall', [App\Http\Controllers\Admin\PostController::class, 'getall'])->name('getall');
    Route::post('/admin/facebook/post/getmodal', [App\Http\Controllers\Admin\PostController::class, 'getmodal'])->name('getmodal');
    Route::post('/admin/facebook/post/getmodal/store', [App\Http\Controllers\Admin\PostController::class, 'store'])->name('post.store');
    Route::get('/admin/facebook/post/getmodal/edit/{id}', [App\Http\Controllers\Admin\PostController::class, 'edit_post'])->name('post.edit');
    Route::post('/admin/facebook/post/getmodal/update/{id}', [App\Http\Controllers\Admin\PostController::class, 'update_post'])->name('post.update');
    Route::get('/admin/facebook/get_post', [App\Http\Controllers\Admin\FacebookController::class, 'getPostPage'])->name('getPostPage');

    Route::post('/admin/facebook/post/page', [App\Http\Controllers\Admin\GraphController::class, 'publishToPage'])->name('page');
   // Route::get('/facebook',  [App\Http\Controllers\Admin\FacebookController::class, 'redirectToProvider'])->name('facebook');
    //Route::get('/facebook/callback', [App\Http\Controllers\Admin\FacebookController::class, 'handleProviderCallback']);

    /*---------Consumer List----------*/
    Route::get('/admin/consumer_list', [App\Http\Controllers\Consumer\ConsumerController::class, 'consumer_list']);
    Route::get('/admin/consumer/search', [App\Http\Controllers\Consumer\ConsumerController::class, 'consumer_search']);


});


