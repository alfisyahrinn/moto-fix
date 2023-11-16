<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

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
Route::get('/booking', function () {
    return view('user.pages.booking');
});
Route::get('/booking/jadwal', function () {
    return view('user.pages.jadwal');
});


Auth::routes(['verify' => true]);



Route::middleware(['auth', 'verified', 'checkRole:admin'])->group(function () {
    Route::get('/admin/index', [AdminController::class, 'index'])->name('admin.index');
});

Route::middleware(['auth', 'verified', 'checkRole:user'])->group(function () {
    Route::get('/user/index', [UserController::class, 'index'])->name('user.index');
});