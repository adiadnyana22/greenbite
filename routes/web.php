<?php

use App\Http\Controllers\AdditionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\NewsController;
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

Route::get('/', [AdditionController::class, 'home'])->name('home');
Route::get('/api/home', [AdditionController::class, 'foodHomeAPI'])->name('foodHomeAPI');

Route::get('/food', [FoodController::class, 'foodList'])->name('foodList');
Route::get('/api/food', [FoodController::class, 'foodMapAPI'])->name('foodMapAPI');
Route::get('/food/{food}', [FoodController::class, 'foodDetail'])->name('foodDetail');
Route::post('/food/{food}', [FoodController::class, 'foodDetailMtd'])->name('foodDetailMtd');

Route::get('/news', [NewsController::class, 'newsList'])->name('newsList');
Route::get('/news/{news}', [NewsController::class, 'newsDetail'])->name('newsDetail');
Route::get('/news/{news}/content', [NewsController::class, 'newsDetailContent'])->name('newsDetailContent');

Route::get('/mitra', [AuthController::class, 'registerMitraPage'])->name('registerMitra');
Route::post('/mitra', [AuthController::class, 'registerMitraMtd'])->name('registerMitraMtd');

// For Cron Job
Route::get('/mail/notification', [AdditionController::class, 'sendNotificationJob'])->name('sendNotificationJob');

Route::middleware(['non.auth'])->group(function() {
    Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
    Route::post('/login', [AuthController::class, 'loginMtd'])->name('loginMtd');
    Route::get('/register', [AuthController::class, 'registerUserPage'])->name('registerUser');
    Route::post('/register', [AuthController::class, 'registerUserMtd'])->name('registerUserMtd');
});

Route::middleware(['auth'])->group(function() {
    Route::get('/logout', [AuthController::class, 'logoutMtd'])->name('logout');

    Route::get('/profile', [AdditionController::class, 'profile'])->name('profile');
    Route::put('/profile', [AdditionController::class, 'profileMtd'])->name('profileMtd');
    
    Route::middleware(['auth.customer'])->group(function() {
        Route::get('/voucher', [AdditionController::class, 'voucher'])->name('voucher');
        Route::get('/wishlist', [AdditionController::class, 'wishlist'])->name('wishlist');
        Route::get('/wishlist/{food}', [FoodController::class, 'wishlistToggle'])->name('wishlistToggle');
        Route::get('/order', [AdditionController::class, 'history'])->name('history');
        Route::post('/api/notification', [AdditionController::class, 'notificationToggleAPI'])->name('notificationToggleAPI');
    
        Route::get('/checkout', [CheckoutController::class, 'checkoutPage'])->name('checkoutPage');
        Route::post('/checkout', [CheckoutController::class, 'checkoutMtd'])->name('checkoutMtd');
        Route::get('/payment', [CheckoutController::class, 'paymentPage'])->name('paymentPage');
        Route::post('/api/transaction', [CheckoutController::class, 'transactionStatusAPI'])->name('transactionStatusAPI');
        Route::get('/success', [CheckoutController::class, 'successPage'])->name('success');
        Route::get('/fail', [CheckoutController::class, 'failPage'])->name('fail');
    
        Route::get('/review/{order}', [FoodController::class, 'foodReviewPage'])->name('review');
        Route::post('/review', [FoodController::class, 'foodReviewMtd'])->name('reviewMtd');
    });

    Route::middleware(['auth.admin.mitra'])->group(function() {
        Route::get('/admin/dashboard', [\App\Http\Controllers\AdminDashboardController::class, 'dashboardPage'])->name('adminDashboard');
    });

    Route::middleware(['auth.admin'])->group(function() {
        Route::get('/admin/voucher', [\App\Http\Controllers\AdminContentController::class, 'voucherListPage'])->name('adminVoucher');
        Route::get('/admin/voucher/add', [\App\Http\Controllers\AdminContentController::class, 'voucherAddPage'])->name('adminVoucherAdd');
        Route::post('/admin/voucher/add', [\App\Http\Controllers\AdminContentController::class, 'voucherAddMethod'])->name('adminVoucherAddMethod');
        Route::get('/admin/voucher/edit/{voucher}', [\App\Http\Controllers\AdminContentController::class, 'voucherEditPage'])->name('adminVoucherEdit');
        Route::put('/admin/voucher/edit/{voucher}', [\App\Http\Controllers\AdminContentController::class, 'voucherEditMethod'])->name('adminVoucherEditMethod');
        Route::delete('/admin/voucher/delete/{voucher}', [\App\Http\Controllers\AdminContentController::class, 'voucherDeleteMethod'])->name('adminVoucherDeleteMethod');
    
        Route::get('/admin/news', [\App\Http\Controllers\AdminContentController::class, 'newsListPage'])->name('adminNews');
        Route::get('/admin/news/detail/{news}', [\App\Http\Controllers\AdminContentController::class, 'newsDetailPage'])->name('adminNewsDetail');
        Route::get('/admin/news/add', [\App\Http\Controllers\AdminContentController::class, 'newsAddPage'])->name('adminNewsAdd');
        Route::post('/admin/news/add', [\App\Http\Controllers\AdminContentController::class, 'newsAddMethod'])->name('adminNewsAddMethod');
        Route::get('/admin/news/edit/{news}', [\App\Http\Controllers\AdminContentController::class, 'newsEditPage'])->name('adminNewsEdit');
        Route::put('/admin/news/edit/{news}', [\App\Http\Controllers\AdminContentController::class, 'newsEditMethod'])->name('adminNewsEditMethod');
        Route::delete('/admin/news/delete/{news}', [\App\Http\Controllers\AdminContentController::class, 'newsDeleteMethod'])->name('adminNewsDeleteMethod');
    
        Route::get('/admin/mitra', [\App\Http\Controllers\AdminMitraController::class, 'mitraListPage'])->name('adminMitra');
        Route::get('/admin/mitra/detail/{mitra}', [\App\Http\Controllers\AdminMitraController::class, 'mitraDetailPage'])->name('adminMitraDetail');
        Route::post('/admin/mitra/verif/{mitra}', [\App\Http\Controllers\AdminMitraController::class, 'mitraVerif'])->name('adminMitraVerif');    
    });

    Route::middleware(['auth.mitra'])->group(function() {
        Route::get('/admin/food', [\App\Http\Controllers\AdminFoodController::class, 'foodListPage'])->name('adminFood');
        Route::get('/admin/food/detail/{food}', [\App\Http\Controllers\AdminFoodController::class, 'foodDetailPage'])->name('adminFoodDetail');
        Route::get('/admin/food/add', [\App\Http\Controllers\AdminFoodController::class, 'foodAddPage'])->name('adminFoodAdd');
        Route::post('/admin/food/add', [\App\Http\Controllers\AdminFoodController::class, 'foodAddMethod'])->name('adminFoodAddMethod');
        Route::get('/admin/food/edit/{food}', [\App\Http\Controllers\AdminFoodController::class, 'foodEditPage'])->name('adminFoodEdit');
        Route::put('/admin/food/edit/{food}', [\App\Http\Controllers\AdminFoodController::class, 'foodEditMethod'])->name('adminFoodEditMethod');
        Route::delete('/admin/food/delete/{food}', [\App\Http\Controllers\AdminFoodController::class, 'foodDeleteMethod'])->name('adminFoodDeleteMethod');
    
        Route::get('/admin/order', [\App\Http\Controllers\AdminOrderController::class, 'orderListPage'])->name('adminOrder');
        Route::get('/admin/order/detail/{order}', [\App\Http\Controllers\AdminOrderController::class, 'orderDetailPage'])->name('adminOrderDetail');
        Route::post('/admin/order/verif/{order}', [\App\Http\Controllers\AdminOrderController::class, 'orderConfirm'])->name('adminOrderConfirm');
    
        Route::get('/admin/qr', [\App\Http\Controllers\AdminOrderController::class, 'qrPage'])->name('adminQr');
        Route::post('/api/admin/qr', [\App\Http\Controllers\AdminOrderController::class, 'qrScanAPI'])->name('qrScanAPI');
    });
});
