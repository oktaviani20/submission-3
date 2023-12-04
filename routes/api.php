<?php

use App\Http\Controllers\Users\UserController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'=>'user'], function () {
    Route::get('get-data', [UserController::class, 'getDataUser']);
    Route::post('create-data', [UserController::class, 'createDataUser']);
    Route::put('update-data', [UserController::class, 'updateDataUser']);
    Route::delete('delete-data', [UserController::class, 'deletetDataUser']);
});

Route::group(['prefix' => 'buku'], function () {
    Route::get('get-buku',  [BukuController::class, 'getDataBuku']);
    Route::post('create-buku', [BukuController::class, 'createDataBuku']);
    Route::put('update-buku', [BukuController::class, 'updateDataBuku']);
    Route::delete('delete-buku', [BukuController::class, 'deleteDataBuku']);
});
