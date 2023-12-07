<?php

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\MasterServicePrice;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminQueueController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminSupplierController;
use App\Http\Controllers\AdminTransactionController;
use App\Http\Controllers\MidtransCallbackController;
use App\Http\Middleware\PaymentStatusMiddleware;

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
Route::get('/user/payment/finish', [PaymentController::class, 'finishPayment'])->name('user.payment.finish');
Route::get('/user/payment/unfinish', [PaymentController::class, 'unfinishPayment'])->name('user.payment.unfinish');
Route::get('/user/payment/error', [PaymentController::class, 'errorPayment'])->name('user.payment.error');
Route::post('/midtrans/callback', [BookingController::class, 'callback']);


Route::get('/', function () {
    $products = Product::latest()
        ->limit(4)
        ->get();
    return view('user.pages.home', compact('products'));
});

Auth::routes(['verify' => true]);



Route::middleware(['auth', 'verified', 'checkRole:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.pages.dashboard');
    // Add other routes for AdminController as needed
});
Route::middleware(['auth', 'verified'])->group(function () {
    // Common routes for both admin and user
    Route::get('/booking', [BookingController::class, 'index'])->name('booking.index');
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/booking/jadwal', [BookingController::class, 'showJadwal'])->name('booking.jadwal');
    Route::get('/booking/show/{transaction}', [BookingController::class, 'show'])
        ->middleware('checkPaymentStatus')
        ->name('booking.show');
    Route::get('/booking/show/{transaction}', [BookingController::class, 'show'])
        ->middleware(['checkPaymentStatus', 'checkTransactionConditions'])
        ->name('booking.show');

    Route::get('/user/payment/error', [PaymentController::class, 'errorPayment'])->name('user.payment.error');
    Route::get('/user/payment/failed', [PaymentController::class, 'failedPayment'])->name('user.payment.failed');

    Route::get('/product', [ProductController::class, 'index'])->name('product.display');
    Route::get('/product/detail/{id}', [ProductController::class, 'show'])->name('product.detail');
    Route::get('/product/{category}', [ProductController::class, 'filterCategory'])->name('product.category');
    Route::get('/product/supplier/{supplier}', [ProductController::class, 'filterSupplier'])->name('product.supplier');

    Route::middleware(['checkRole:admin'])->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin');

        // Resource routes for AdminQueueController
        Route::resource('admin/queue', AdminQueueController::class);

        // Custom route for deleting a queue item
        Route::get('/admin/queue/{id}/delete', [AdminQueueController::class, 'delete'])->name('admin.queue.delete');

        // Resource routes for AdminTransactionController
        Route::resource('/admin/transaction', AdminTransactionController::class);

        // Custom route for adding to cart in AdminTransactionController
        Route::post('/admin/transaction/add-to-cart/{id}', [AdminTransactionController::class, 'addToCard'])->name('admin.transaction.addToCard');

        // Resource route for Master Price Service
        Route::resource('/admin/price', MasterServicePrice::class);

        // Route for deleting a detail
        Route::delete('/details/{id}/delete', [AdminTransactionController::class, 'deleteDetail'])->name('details.delete');
        // Custom route for adding a service in AdminTransactionController
        Route::post('/admin/transaction/add-service/{id}', [AdminTransactionController::class, 'addServiceToCart'])->name('admin.transaction.addService');

        Route::put('transactions/update_quantity/{id}', [AdminTransactionController::class, 'updateQuantity'])->name('admin.transactions.update_quantity');

        Route::delete('transaction/{id}/destroy', [AdminTransactionController::class, 'destroy'])
    ->name('transaction.destroy');

        // Resource routes for AdminCategoryController
        Route::resource('/admin/category', AdminCategoryController::class);

        // Resource routes for AdminSupplierController
        Route::resource('/admin/supplier', AdminSupplierController::class);

        // Resource routes for AdminSupplierController
        Route::resource('/admin/product', AdminProductController::class);
    });

    Route::middleware(['checkRole:user'])->group(function () {
        Route::get('/user/index', [UserController::class, 'index'])->name('user.index');
        Route::get('/user/profile', [UserController::class, 'showProfile'])->name('user.profile');
    });

    Route::middleware(['auth', 'verified', 'checkRole:user'])->group(function () {
        Route::get('/user/profile', [UserController::class, 'showProfile'])->name('user.profile');
        Route::get('/user/profile/edit', [UserController::class, 'editProfile'])->name('user.profile.edit');
        Route::put('/user/profile/update', [UserController::class, 'updateProfile'])->name('user.profile.update');

        Route::get('/booking/checkout/{transaction}', [BookingController::class, 'checkout'])->name('booking.checkout');

        Route::get('/failed', [BookingController::class, 'failed'])->name('failed');
    });
});


Route::get('/tes', function () {
    $produts = Product::all();
    return view('tes', [
        'products' => $produts,
    ]);
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');