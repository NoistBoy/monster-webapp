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
Route::get('/category-products/{category}/{subcategory}/{categoryid}', [HomeController::class, 'getEachCategoryProducts']);
Route::get('/get-single-product-details', [HomeController::class, 'getSingleProductDetai']);
Route::get('/product-details/{product}', [HomeController::class, 'SingleProductDetails']);
Route::get('/get-related-products', [HomeController::class, 'getRelatedProducts']);
Route::get('/isUserLogin', [HomeController::class, 'isUserLogin']);
Route::get('/get-customer-details', [HomeController::class, 'getCustomerDetail']);
Route::get('/get-payment-methods', [HomeController::class, 'getPaymentMethods']);
Route::get('/get-shiping-details', [HomeController::class, 'getShipingDetails']);
Route::get('/search-product', [HomeController::class, 'searchProduct']);
Route::post('/updateUserSession', [HomeController::class, 'updateUserSession']);
Route::get('/return-policy', [HomeController::class, 'returnPolicy']);
Route::get('/contact-us', [HomeController::class, 'contactUs']);
Route::get('/about-us', [HomeController::class, 'aboutUs']);
Route::get('/faqs', [HomeController::class, 'faqs']);
Route::get('/forgot-password', [HomeController::class, 'forgotPassword']);

// dashboard
Route::group(['middleware' => ['authCheck']], function () {
    Route::get('/user-dashboard', [HomeController::class, 'userDashBoard']);
    Route::get('/user-dashboard-details', [HomeController::class, 'userDashBoardDetails']);
    Route::get('/user-profile', [HomeController::class, 'userProfile']);
    Route::get('/user-addressList', [HomeController::class, 'userAddressList']);
    Route::get('/user-changePassword', [HomeController::class, 'userChangePassword']);
    Route::get('/get-orders', [HomeController::class, 'getOrders']);
    Route::get('/customer-Order-details', [HomeController::class, 'customerOrderDetails']);
    Route::post('/add-customerAddress', [HomeController::class, 'addCustomerAddress']);
    Route::get('/user-statement', [HomeController::class, 'userStatement']);
});



// Auth Routes
Route::group(['middleware' => ['notAuth']], function () {
    Route::get('/sign-up', [HomeController::class, 'singUp']);
    Route::post('/post-sing-up', [HomeController::class, 'singUpCustomer']);
    Route::get('/sign-in', [HomeController::class, 'signIn']);
    Route::post('/post-sing-in', [HomeController::class, 'singInCustomer']);
});
Route::get('/log-out', [HomeController::class, 'LogOut'])->middleware('authCheck');


// Cart Routes
Route::get('/add-to-cart', [HomeController::class, 'addToCart']);
Route::post('/post-multiple-cart-item', [HomeController::class, 'postMultiCartItem']);
Route::post('/post-cart', [HomeController::class, 'postCart']);
Route::get('/get-cart-item', [HomeController::class, 'getCartItem']);
Route::post('/update-cart-item', [HomeController::class, 'updateCart']);
Route::post('/delete-cart-item', [HomeController::class, 'deleteCartItem']);

//place order
Route::post('/place-order', [HomeController::class, 'placeCustomerOrder'])->middleware('authCheck');
Route::get('/check-out', [HomeController::class, 'checkOut'])->middleware('authCheck');

Route::get('/placeOrder-with-createdCard', [HomeController::class, 'placeOrderWithCreatedCard']);
