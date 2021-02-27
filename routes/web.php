<?php

use Illuminate\Support\Facades\Route;

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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

Route::group(['namespace'=>'Auth'], function (){
    Route::get('dang-ky',[App\Http\Controllers\Auth\RegisterController::class,'getRegister'])->name('get.register');
    Route::post('dang-ky',[App\Http\Controllers\Auth\RegisterController::class,'postRegister'])->name('post.register');

    Route::get('dang-nhap',[App\Http\Controllers\Auth\LoginController::class,'getLogin'])->name('get.login');
    Route::post('dang-nhap',[App\Http\Controllers\Auth\LoginController::class,'postLogin'])->name('post.login');

    Route::get('dang-xuat',[App\Http\Controllers\Auth\LoginController::class,'getLogout'])->name('get.logout.user');

});

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('danh-muc/{slug}-{id}',[App\Http\Controllers\CategoryController::class, 'getListProduct'])->name('get.list.product');
Route::get('san-pham/{slug}-{id}',[App\Http\Controllers\ProductDetailController::class, 'productDetail'])->name('get.detail.product');
///////////
Route::post('san-pham/{slug}-{id}',[App\Http\Controllers\ProductDetailController::class, 'addToCart']);
////////////////
Route::get('san-pham',[App\Http\Controllers\CategoryController::class, 'getListProduct'])->name('get.search.list.product');
Route::get('san-pham/view/{id}',[App\Http\Controllers\ProductDetailController::class, 'productContent'])->name('get.detail.content.product');

Route::get('bai-viet',[App\Http\Controllers\ArticleController::class, 'getListArticle'])->name('get.list.article');
Route::get('bai-viet/{slug}-{id}',[App\Http\Controllers\ArticleController::class, 'getDetailArticle'])->name('get.detail.article');


Route::prefix('shopping')->group(function (){
    Route::get('/add/{id}',[App\Http\Controllers\ShoppingCartController::class, 'addProduct'])->name('add.shopping.cart');
    Route::get('/delete/{id}',[App\Http\Controllers\ShoppingCartController::class, 'delProduct'])->name('del.shopping.cart.item');
    Route::get('/delete/',[App\Http\Controllers\ShoppingCartController::class, 'delCart'])->name('del.shopping.cart');
    Route::get('gio-hang',[App\Http\Controllers\ShoppingCartController::class, 'getListShoppingCart'])->name('get.list.cart');
    Route::get('/{change}/{id}',[App\Http\Controllers\ShoppingCartController::class, 'changeQty'])->name('change.qty.shopping.cart');
});

Route::group(['middleware' => ['CheckLoginUser']], function () {
    Route::get('/thanh-toan',[App\Http\Controllers\ShoppingCartController::class, 'getFormPay'])->name('get.form.pay');
    Route::post('/thanh-toan',[App\Http\Controllers\ShoppingCartController::class, 'saveInfoCart']);
});

//Route::group(['middleware' => ['CheckAdminLogin']], function () {
//    Route::get('/admin',[App\Http\Controllers\Auth\LoginController::class, 'loginAdmin'])->name('admi');
//});

Route::get('lien-he',[App\Http\Controllers\ContactController::class, 'getContact'])->name('get.contact');
Route::post('lien-he',[App\Http\Controllers\ContactController::class, 'saveContact']);

