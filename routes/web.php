<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index']);

Route::get('/auth-user', [HomeController::class, 'authenticateUser']);
Route::get('/get-categories', [HomeController::class, 'getCategories']);
Route::get('/get-states', [HomeController::class, 'getStates']);
Route::get('/get-all-brands', [HomeController::class, 'getallbrands']);
Route::get('/get-featured-products-tag', [HomeController::class, 'getFeaturedProductsTags']);
Route::get('/get-featured-products-by-each-tag', [HomeController::class, 'getFeaturedProductsByEachTag']);
Route::get('/get-products', [HomeController::class, 'getProducts']);
Route::get('/each-category-products/{category}/{subcategory}/{categoryid}', [HomeController::class, 'getEachCategoryProducts']);
Route::get('/get-single-product-details', [HomeController::class, 'getSingleProductDetai']);
Route::get('/product-details', [HomeController::class, 'SingleProductDetails']);


// Auth Routes
Route::get('/sign-up', [HomeController::class, 'singUp']);
Route::post('/post-sing-up', [HomeController::class, 'singUpCustomer']);
Route::get('/sign-in', [HomeController::class, 'singIn']);
Route::post('/post-sing-in', [HomeController::class, 'singInCustomer']);
Route::get('/log-out', [HomeController::class, 'LogOut']);


// Cart Routes
Route::get('/add-to-cart', [HomeController::class, 'addToCart']);
Route::post('/post-cart', [HomeController::class, 'postCart']);
