<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BackController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ImgController;

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

/* Route::get('/', function () {
    return view('welcome');
}); */

Auth::routes();
Route::get('/test', function () {
    return view('example');
})->name('test');

Route::resource('projects',ProjectController::class)->middleware('auth');
Route::resource('imgs',ImgController::class)->middleware('auth');






Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware('public.access')->group(function () {
    // 這裡是不需要登入的路由
    Route::get('/', function () {
        return view('front.index');
    });
});
