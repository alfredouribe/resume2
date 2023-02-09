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
// header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
// header("Access-Control-Allow-Headers: *");

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('get_resources',['App\Http\Controllers\API\ApiController', 'get_resources'])->name('get_resources');
Route::post('add_command',['App\Http\Controllers\API\ApiController', 'add_command'])->name('add_command');
Route::get('get_commands',['App\Http\Controllers\API\ApiController', 'get_commands'])->name('get_commands');
Route::post('delete_command',['App\Http\Controllers\API\ApiController', 'delete_command'])->name('delete_command');
Route::post('edit_command',['App\Http\Controllers\API\ApiController', 'edit_command'])->name('edit_command');
Route::post('process_command',['App\Http\Controllers\API\ApiController', 'process_command'])->name('process_command');
Route::post('authenticate',['App\Http\Controllers\API\ApiController', 'authenticate'])->name('authenticate');

Route::post('add_intent',['App\Http\Controllers\API\ApiController', 'add_intent'])->name('add_intent');
Route::get('get_intents',['App\Http\Controllers\API\ApiController', 'get_intents'])->name('get_intents');
Route::post('edit_intent',['App\Http\Controllers\API\ApiController', 'edit_intent'])->name('edit_intent');
Route::post('delete_intent',['App\Http\Controllers\API\ApiController', 'delete_intent'])->name('delete_intent');

Route::post('add_answer',['App\Http\Controllers\API\ApiController', 'add_answer'])->name('add_answer');
Route::get('get_answers',['App\Http\Controllers\API\ApiController', 'get_answers'])->name('get_answers');
Route::post('edit_answer',['App\Http\Controllers\API\ApiController', 'edit_answer'])->name('edit_answer');
Route::post('delete_answer',['App\Http\Controllers\API\ApiController', 'delete_answer'])->name('delete_answer');


Route::get('get_answers_front',['App\Http\Controllers\API\ApiController', 'get_answers_front'])->name('get_answers_front');
//Route::post('process_command_mobile',['App\Http\Controllers\APIApiController', 'process_command'])->name('process_command');
