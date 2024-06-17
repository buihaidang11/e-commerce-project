<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', [HomeController::class, 'home']);


Route::get('/product_details/{id}', [HomeController::class, 'product_details']);
Route::get('/product_details/{id}', [HomeController::class, 'product_details']);

Route::controller(HomeController::class)->group(function () {
    Route::get('stripe/{value}', 'stripe');
    Route::post('stripe/{value}', 'stripePost')->name('stripe.post');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'login_home'])->name('dashboard');
    Route::get('add_cart/{id}', [HomeController::class, 'add_cart'])->name('add_cart');
    Route::get('mycart', [HomeController::class, 'mycart'])->name('mycart');
    Route::get('myorders', [HomeController::class, 'myorders'])->name('myorders');
    Route::get('delete_cart/{id}', [HomeController::class, 'delete_cart'])->name('delete_cart');
    Route::post('confirm_order', [HomeController::class, 'confirm_order'])->name('confirm_order');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::middleware(['admin'])->group(function () {
    Route::get('admin/dashboard', [HomeController::class, 'index']);
    Route::get('view_category', [AdminController::class, 'view_category']);
    Route::post('add_category', [AdminController::class, 'add_category']);
    Route::get('delete_category/{id}', [AdminController::class, 'delete_category']);
    Route::get('edit_category/{id}', [AdminController::class, 'edit_category']);
    Route::post('edit_category/{id}', [AdminController::class, 'update_category']);
    Route::get('add_product', [AdminController::class, 'add_product']);
    Route::post('add_product', [AdminController::class, 'store_product']);
    Route::get('view_product', [AdminController::class, 'view_product']);
    Route::get('delete_product/{id}', [AdminController::class, 'delete_product']);
    Route::get('edit_product/{id}', [AdminController::class, 'edit_product']);
    Route::post('edit_product/{id}', [AdminController::class, 'update_product']);
    Route::get('product_search', [AdminController::class, 'product_search']);
    Route::get('view_orders', [AdminController::class, 'view_orders']);
    Route::get('ontheway/{id}', [AdminController::class, 'ontheway']);
    Route::get('delivered/{id}', [AdminController::class, 'delivered']);
    Route::get('print_pdf/{id}', [AdminController::class, 'print_pdf']);
});
