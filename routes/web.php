<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminQueueController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProductController;
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

Route::middleware(['auth', 'verified'])->group(function () {
    // Common routes for both admin and user
    Route::get('/booking', [BookingController::class, 'index'])->name('booking.index');
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
    // Route::resource('/booking', BookingController::class);
    Route::get('/booking/jadwal', [BookingController::class, 'showJadwal'])->name('booking.jadwal');
    Route::get('/booking/jadwal/{queue}', [BookingController::class, 'show'])->name('booking.show');

    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::get('/product/detail/{id}', [ProductController::class, 'show'])->name('product.detail');
    Route::get('/product/{category}', [ProductController::class, 'filterCategory'])->name('product.category');
    // Route::get('/product/supplier/{supplier}', [ProductController::class, 'filterSupplier'])->name('product.supplier');

    Route::middleware(['checkRole:admin'])->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin');
        Route::resource('admin/queue', AdminQueueController::class);
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


// Route::get('/queue', function () {
//     return view('admin.pages.queue');
// });

Route::get('/storage', function () {
    return view('admin.pages.storage');
});

// Route::get('/category', function () {
//     return view('admin.pages.category');
// });

// Route::get('/suplier', function () {
//     return view('admin.pages.suplier');
// });

// Route::get('/price', function () {
//     return view('admin.pages.price');
// });

// Route::get('/editqueue', function () {
//     return view('admin.pages.EditIndex');
// });

// Route::get('/additem', function () {
//     return view('admin.pages.add.addstorage');
// });

// Route::get('/addcategory', function () {
//     return view('admin.pages.add.addcategory');
// });

// Route::get('/addprice', function () {
//     return view('admin.pages.add.addprice');
// });

// Route::get('/addsuplier', function () {
//     return view('admin.pages.add.addsuplier');
// });

// Route::get('/editcategory', function () {
//     return view('admin.pages.editcategory');
// });

// Route::get('/editprice', function () {
//     return view('admin.pages.editprice');
// });

// Route::get('/editsuplier', function () {
//     return view('admin.pages.editsuplier');
// });

// Route::get('/admin', function () {
//     return view('admin.pages.index');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
