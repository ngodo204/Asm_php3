<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\StatisticsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClothesController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\DB;
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

// Trang ADMIN

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard')->middleware('admin', 'auth');
    Route::post('/toggle-activation/{id}', [AdminController::class, 'toggleActivation'])->name('admin.toggleActivation');
    Route::get('admin/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('admin/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('admin/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('admin/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    //clothes
    Route::get('clothe/list', [ClothesController::class, 'index'])->name('clothe.index');
    Route::get('clothe/create', [ClothesController::class, 'create'])->name('clothe.create');
    Route::post('clothe/create', [ClothesController::class, 'store'])->name('clothe.store');
    Route::get('clothe/edit/{clothe}', [ClothesController::class, 'edit'])->name('clothe.edit');
    Route::put('clothe/edit/{clothe}', [ClothesController::class, 'update'])->name('clothe.update');
    Route::get('clothe/detail/{clothe}', [ClothesController::class, 'detail'])->name('clothe.detail');
    Route::delete('clothe/delete/{clothe}', [ClothesController::class, 'destroy'])->name('clothe.destroy');
    Route::get('/clothes/search', [ClothesController::class, 'search'])->name('clothe.search');
    Route::get('admin/trangchu', [StatisticsController::class, 'trangchu'])->name('statistics.trangchu');
});

// Route::get('/welcome', [UserController::class, 'index'])->name('welcome')->middleware('auth');
// Route::post('/welcome', [UserController::class, 'update'])->middleware('auth');
// Route::get('/welcome/change-password', [UserController::class, 'changePasswordForm'])->middleware('auth')->name('changePassword');
// Route::post('/welcome/change-password', [UserController::class, 'changePassword'])->middleware('auth')->name('changePassword');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');


Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login'])->middleware('pre_login');
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);

//Trang người dùng

Route::get('/index', function () {
    $highestPricedClothes = DB::table('clothes')->orderBy('price', 'desc')->take(8)->get();
    $categories = DB::table('categories')->get();
    return view('index', compact('highestPricedClothes', 'categories'));
})->name('clothes.index');
Route::get('/category/{id}', function ($id) {
    $clothes = DB::table('clothes')->where('category_id', $id)->get();
    
    return view('category', compact('clothes'));
});
Route::get('/categories/{category_id}', function ($category_id) {
    $clothes = DB::table('clothes')->where('category_id', $category_id)->get();
    return view('category_clothes', ['clothes' => $clothes]);
})->name('category.clothes');

Route::get('/detail/{id}', function ($id) {
    $clothing = DB::table('clothes')->find($id);
    $categories = DB::table('categories')->get();
    return view('detail', compact('clothing', 'categories'));
})->name('clothing.show');
