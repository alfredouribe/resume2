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
    return view('index');
});

Auth::routes();

Route::get('/index', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/commands', [App\Http\Controllers\CommandController::class, 'index'])->name('commands');

//apis
Route::get('get_resources',['App\Http\Controllers\ApiController', 'get_resources'])->name('get_resources');
Route::post('add_command',['App\Http\Controllers\ApiController', 'add_command'])->name('add_command');
