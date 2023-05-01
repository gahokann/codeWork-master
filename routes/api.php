<?php

use App\Http\Controllers\API\RegisterController;
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

Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login']);
Route::post('createRecipe', [App\Http\Controllers\Api\ProfileController::class, 'store'])->name("store");
Route::get('catalog/show', [App\Http\Controllers\Api\CatalogController::class, 'showCatalog'])->name("showCatalog");
Route::get('show/recipe/{id}', [App\Http\Controllers\Api\CatalogController::class, 'showRecipe'])->name("recipe");
Route::put('recipes/{id}/update', [App\Http\Controllers\Api\AdminController::class, 'update'])->name("update");
Route::get('user/{id}/destroy', [App\Http\Controllers\Api\AdminController::class, 'destroy'])->name("destroy");
