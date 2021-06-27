<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

use App\Http\Livewire\Login;
use App\Http\Livewire\Register;
use App\Http\Livewire\Forgot;
use App\Http\Livewire\ResetPassword;
use App\Http\Livewire\Verif\Notice as VerificationNotice;

use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Welcome;
use App\Http\Livewire\Toko;
use App\Http\Livewire\SingleProduct;
use App\Http\Livewire\Checkout;

// Auth
use App\Http\Livewire\Auth\EditPass as ChangePassword;


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

Route::group(['middleware' => 'guest'], function () {
    Route::get('login', Login::class)->name('login');
    Route::get('register', Register::class)->name('register');
    Route::get('/forgot-password', Forgot::class)->name('password.request');
    Route::get('/reset-password/{token}', ResetPassword::class)->name('password.reset');
});

Route::group(['prefix' => 'user', 'middleware' => ['auth', 'verified']], function() {
    Route::get('home', Dashboard::class)->name('user.home');
    Route::get('checkout', Checkout::class)->name('user.checkout');
    Route::get('{id}/edit/password', ChangePassword::class)->name('user.changepass');
});

Route::group(['prefix' => 'email', 'middleware' => 'auth'], function() {
    Route::get('verify', VerificationNotice::class)->name('verification.notice');

    Route::get('verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect()->route('user.home');
    })->name('verification.verify')->middleware('signed');

    Route::post('verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('success', 'Link Verifikasi Email berhasil terkirim!');
    })->middleware('throttle:6,1')->name('verification.send');
});

Route::get('product/{slug}', SingleProduct::class)->name('product.single');

//Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//    return view('dashboard');
//})->name('dashboard');
