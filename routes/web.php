<?php

use App\Models\Product;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminQueueController;
use App\Http\Controllers\AdminTransactionController;

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

Route::get('/', function () {
    return view('user.pages.home');
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
    Route::get('/booking/jadwal/{transaction}', [BookingController::class, 'show'])->name('booking.show');

    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
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

        // Custom route for deleting an item in AdminTransactionController
        Route::delete('/delete-item/{detailId}', [AdminTransactionController::class, 'deleteItem'])->name('admin.transaction.deleteItem');

        // Custom route for adding a service in AdminTransactionController
        Route::post('/admin/transaction/add-service/{id}', [AdminTransactionController::class, 'addServiceToCart'])->name('admin.transaction.addService');
    });

    Route::middleware(['checkRole:user'])->group(function () {
        Route::get('/user/index', [UserController::class, 'index'])->name('user.index');
        Route::get('/user/profile', [UserController::class, 'showProfile'])->name('user.profile');
    });
    Route::middleware(['auth', 'verified', 'checkRole:user'])->group(function () {
        Route::get('/user/profile', [UserController::class, 'showProfile'])->name('user.profile');
        Route::get('/user/profile/edit', [UserController::class, 'editProfile'])->name('user.profile.edit');
        Route::put('/user/profile/update', [UserController::class, 'updateProfile'])->name('user.profile.update');
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