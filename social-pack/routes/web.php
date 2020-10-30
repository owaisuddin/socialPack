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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => ['auth']], function () {
    Route::get('get_page', [App\Http\Controllers\PageController::class, 'addPage'])->name('get_page');
    Route::post('page_save', [App\Http\Controllers\PageController::class, 'savePage'])->name('page_save');
    Route::get('page_list', [App\Http\Controllers\PageController::class, 'pageList'])->name('page_list');
    Route::get('page_post/{id}', [App\Http\Controllers\PageController::class, 'pagePost'])->name('page_post');
    Route::post('store_post', [App\Http\Controllers\PageController::class, 'storePost'])->name('store_post');


});
