<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::namespace('\App\Http\Controllers\User')->middleware(['auth', 'verified'])->group(function () {
     Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
     Route::resource('betting','BettingController')->names('betting');
});

require __DIR__.'/auth.php';

Route::get('/', '\App\Http\Controllers\Admin\HomeController@index')->name('dashboard');
Route::get('/game_status_update', '\App\Http\Controllers\Admin\CronController@game_status_update')->name('game_status_update');
Route::get('page/{slug}', '\App\Http\Controllers\User\HomeController@page')->name('page');
Route::get('blog/{slug}', '\App\Http\Controllers\User\HomeController@blog')->name('blog');
Route::get('slug/{slug}', '\App\Http\Controllers\User\HomeController@slug')->name('slug');
Route::get('/scrape', '\App\Http\Controllers\Admin\ScraperController@third_party_result_update');
// user
Route::namespace('\App\Http\Controllers\User')->prefix('user')->name('user.')->group(function(){ 
    Route::middleware('user')->group(function(){
          Route::get('game/{id}', 'HomeController@game')->name('game');
          Route::get('history', 'HomeController@history')->name('history');
          Route::get('wallet', 'HomeController@wallet')->name('wallet');
          Route::get('payment', 'HomeController@payment')->name('payment');
          Route::get('withdraw', 'HomeController@withdraw')->name('withdraw');
          Route::get('refer-earn', 'HomeController@refer_earn')->name('refer_earn');
          Route::post('game_store', 'BettingController@store')->name('store');
          Route::post('payment_method_store', 'PaymentMethodController@pay_meth_store')->name('pay_meth_store');
    });
});

// admin
Route::namespace('\App\Http\Controllers\Admin')->prefix('admin')->name('admin.')->group(function(){   
    Route::namespace('Auth')->middleware('guest:admin')->group(function(){
        Route::get('login', 'AuthenticatedSessionController@create')->name('login');
        Route::post('login', 'AuthenticatedSessionController@store')->name('adminlogin');
    });
    Route::middleware('admin')->group(function(){
          Route::get('dashboard', 'HomeController@dashboard')->name('dashboard');
          Route::resource('result','ResultsController')->names('result');
          Route::resource('admin','AdminController')->names('admin');
          Route::resource('wallet','WalletController')->names('wallet');
          Route::resource('rate','RateController')->names('rate');
          Route::resource('blog','BlogController')->names('blog');
          Route::resource('users','UserController')->names('users');
          Route::post('/get-random-username', 'UserController@getRandomUsername')->name('getRandomUsername');
          Route::resource('payment_request','PaymentRequest')->names('payment_request');
    });



    Route::post('logout', 'Auth\AuthenticatedSessionController@destroy')->name('logout');
});