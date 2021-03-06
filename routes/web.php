<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\Articles\ArticleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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
Route::get('logout', function () {
    return view('welcome');
});
Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::resource('user',UserController::class)->middleware('admin');
Route::resource('article', ArticleController::class)->except(['show', 'edit', 'update']);
Route::get('home', [HomeController::class,'index']);