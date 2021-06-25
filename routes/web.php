<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Login;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Welcome;
use App\Http\Livewire\Toko;
use App\Http\Livewire\SingleProduct;
use App\Http\Livewire\Checkout;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/toko", Toko::class)->name("toko");

Route::get('/', Welcome::class)->name('home');

Route::get('login', Login::class)->name('login');

Route::group(['prefix' => 'user', 'middleware' => 'auth'], function() {
    Route::get('home', Dashboard::class)->name('user.home');
    Route::get('checkout', Checkout::class)->name('user.checkout');
});

Route::get('product/{slug}', SingleProduct::class)->name('product.single');

//Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//    return view('dashboard');
//})->name('dashboard');
