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


Route::get('/index', [App\Http\Controllers\IndexController::class, 'index'])->name('index');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/commands', [App\Http\Controllers\CommandController::class, 'index'])->name('commands');
Route::get('/chat-config', [App\Http\Controllers\ChatController::class, 'index'])->name('chat-config');
Route::get('/answer', [App\Http\Controllers\AnswerController::class, 'index'])->name('answer');

Route::get('/email', [App\Http\Controllers\MailerController::class, 'email'])->name('email');
Route::post("send-email", [App\Http\Controllers\MailerController::class, "composeEmail"])->name("send-email");

Route::get('/chat', [App\Http\Controllers\HomeController::class, 'chat'])->name('chat')->withoutMiddleware(['auth']);