<?php

use Illuminate\Support\Facades\Route;

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

//  HomeController and home-dislay are now irrelivant bc of livewire
//Route::get('/', [\App\Http\Controllers\HomeController::class, 'home'])->name('home');
//

Route::get('/', [\App\Http\Livewire\ShowAds::class, 'render'])->name('home');
Route::get('/iplookup', [\App\Http\Controllers\IpLookupController::class, 'ipLookup'])->name('ipLookup');
Route::post('/iplookup', [\App\Http\Controllers\IpLookupController::class, 'ipLookupProcess'])->name('ipLookupProcess');
Route::get('/useragent', [\App\Http\Controllers\UserAgentController::class, 'useragent'])->name('useragent');

Route::middleware('guest')->group(function () {
    Route::get('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
    Route::post('/login', [\App\Http\Controllers\AuthController::class, 'loginProcess'])->name('loginProcess');
    Route::get('/auth/callback', [\App\Http\Controllers\OauthController::class, 'oauthCallback'])->name('oauthCallback');
    Route::get('/auth/oauth', [\App\Http\Controllers\OauthController::class, 'oauth'])->name('oauth');
    Route::get('/auth/callback_reddit', [\App\Http\Controllers\OauthRedditController::class, 'oauthRedditCallback'])->name('oauthRedditCallback');
    Route::get('/auth/oauth_reddit', [\App\Http\Controllers\OauthRedditController::class, 'oauthReddit'])->name('oauthReddit');
});

Route::middleware('auth')->group(function () {
    Route::get('/edit', [\App\Http\Controllers\AdController::class, 'create'])->name('create_a_new_ad');
    Route::post('/edit', [\App\Http\Controllers\AdController::class, 'createSave'])->name('create_a_new_ad_save');

    Route::get('/edit/{id}', [\App\Http\Controllers\AdController::class, 'update'])->name('update_an_ad');
    Route::post('/edit/{id}', [\App\Http\Controllers\AdController::class, 'updateSave'])->name('update_an_ad_save');

    Route::get('/delete/{id}', [\App\Http\Controllers\AdController::class, 'delete'])->name('delete');

    Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

    Route::get('/profile/{user_id}', [\App\Http\Controllers\ProfileController::class, 'showProfile'])->name('showProfile');
});

Route::get('/{id}', [\App\Http\Controllers\AdController::class, 'show'])->name('show_an_ad_by_id');
