<?php

use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\AuthController;
use App\Models\Api\Post;
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

Route::apiResource('posts', PostController::class)->middleware('auth:sanctum');

Route::get('post/mine', function (Request $request) {
    $userId = $request->user()->id;

    return Post::where('user_id', $userId)->get();
})->middleware('auth:sanctum');


Route::prefix('auth')->controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('logout', 'logout')->middleware('auth:sanctum');
    Route::post('register', 'register');
});
