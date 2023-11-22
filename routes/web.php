<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;

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
    Route::get('/booking/jadwal', [BookingController::class, 'showJadwal'])->name('booking.jadwal');

    Route::middleware(['checkRole:admin'])->group(function () {
        Route::get('/admin/index', [AdminController::class, 'index'])->name('admin.index');
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


Route::get('/admin', function () {
    return view('viewadmin.index');
});

Route::get('/storage', function () {
    return view('viewadmin.storage');
});

Route::get('/category', function () {
    return view('viewadmin.category');
});

Route::get('/suplier', function () {
    return view('viewadmin.suplier');
});

Route::get('/price', function () {
    return view('viewadmin.price');
});

Route::get('/editqueue', function () {
    return view('viewadmin.EditIndex');
});

Route::get('/additem', function () {
    return view('viewadmin.addstorage');
});

Route::get('/addcategory', function () {
    return view('viewadmin.addcategory');
});

Route::get('/addprice', function () {
    return view('viewadmin.addprice');
});

Route::get('/addsuplier', function () {
    return view('viewadmin.addsuplier');
});

Route::get('/editcategory', function () {
    return view('viewadmin.editcategory');
});

Route::get('/editprice', function () {
    return view('viewadmin.editprice');
});

Route::get('/editsuplier', function () {
    return view('viewadmin.editsuplier');
});