<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('get_resources',['App\Http\Controllers\ApiController', 'get_resources'])->name('get_resources');
Route::post('add_command',['App\Http\Controllers\ApiController', 'add_command'])->name('add_command');
Route::get('get_commands',['App\Http\Controllers\ApiController', 'get_commands'])->name('get_commands');
Route::post('delete_command',['App\Http\Controllers\ApiController', 'delete_command'])->name('delete_command');
Route::post('edit_command',['App\Http\Controllers\ApiController', 'edit_command'])->name('edit_command');
Route::post('process_command',['App\Http\Controllers\ApiController', 'process_command'])->name('process_command');
Route::post('authenticate',['App\Http\Controllers\ApiController', 'authenticate'])->name('authenticate');
