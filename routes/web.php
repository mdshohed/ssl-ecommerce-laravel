<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\TokenAuthenticate;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/brandList', [BrandController::class, 'BrandList']);
Route::get('/CategoryList', [CategoryController::class, 'CategoryList']);
Route::get('/ListProduct', [ProductController::class, 'ListProduct']);
Route::get('/ListProductByCategory/{id}', [ProductController::class, 'ListProductByCategory']);
Route::get('/ListProductByBrand/{id}', [ProductController::class, 'ListProductByBrand']);
Route::get('/ListProductByRemark/{remark}', [ProductController::class, 'ListProductByRemark']);
Route::get('/ListProductSlider', [ProductController::class, 'ListProductSlider']);
Route::get('/ProductDetailsById/{id}', [ProductController::class, 'ProductDetailsById']);
Route::get('/ListReviewByProduct/{product_id}', [ProductController::class, 'ListReviewByProduct']);
Route::get('/PolicyByType/{type}', [PolicyController::class, 'PolicyByType']);

// user auth
Route::get('/userLogin/{userEmail}', [UserController::class, 'UserLogin']);
Route::get('/VerifyLogin/{userEmail}/{OTP}' ,[UserController::class, 'VerifyLogin']);
Route::get('/logout', [UserController::class, 'UserLogout']);

// User Profile
Route::post('/CreateProfile', [ProfileController::class, 'CreateProfile'])->middleware([TokenAuthenticate::class]);
Route::get('/ReadProfile', [ProfileController::class, 'ReadProfile'])->middleware([TokenAuthenticate::class]);

// Product Review
Route::post('/CreateProductReview', [ProductController::class, 'CreateProductReview'])->middleware([TokenAuthenticate::class]);

// Product Wish
Route::get('/ProductWishList', [ProductController::class, 'ProductWishList'])->middleware([TokenAuthenticate::class]);
Route::get('/CreateWishList/{product_id}', [ProductController::class, 'CreateWishList'])->middleware([TokenAuthenticate::class]);
Route::get('/RemoveWishList/{product_id}', [ProductController::class, 'RemoveWishList'])->middleware([TokenAuthenticate::class]);

// Product Cart
Route::post('/CreateCardList', [ProductController::class, 'CreateCardList'])->middleware([TokenAuthenticate::class]);
Route::get('/CartList', [ProductController::class, 'CartList'])->middleware([TokenAuthenticate::class]);
Route::get('/DeleteCartList/{product_id}', [ProductController::class, 'DeleteCartList'])->middleware([TokenAuthenticate::class]);

// Invoice and Payment
Route::post('/InvoiceCreate', [InvoiceController::class, 'InvoiceCreate'])->middleware([TokenAuthenticate::class]);
Route::get('/InvoiceList', [InvoiceController::class, 'InvoiceList'])->middleware([TokenAuthenticate::class]);
Route::get('/InvoiceProductList/{invoice_id}', [InvoiceController::class, 'InvoiceProductList'])->middleware([TokenAuthenticate::class]);


// Payment
Route::post('/PaymentSuccess', [InvoiceController::class, 'PaymentSuccess']);
Route::get('/PaymentCancel', [InvoiceController::class, 'PaymentCancel']);
Route::get('/PaymentFail', [InvoiceController::class, 'PaymentFail']);


