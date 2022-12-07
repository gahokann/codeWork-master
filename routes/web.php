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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::name('profile.')->prefix('profile')->group(function(){
    // ! View
    Route::get('user/{id}', [App\Http\Controllers\ProfileController::class, 'index'])->name("user");
    Route::get('settings/{id}', [App\Http\Controllers\ProfileController::class, 'settingsView'])->name("settings")->middleware('auth');
    Route::get('myRecipe/{id}', [App\Http\Controllers\ProfileController::class, 'myRecipeView'])->name("myRecipe")->middleware('auth');
    Route::get('createRecipe/{id}', [App\Http\Controllers\ProfileController::class, 'createRecipe'])->name("createRecipe")->middleware('auth');
    // ! ===================

    // ! Function

    Route::get('home', [App\Http\Controllers\ProfileController::class, 'redirect'])->name("home");
    Route::post('createRecipe', [App\Http\Controllers\ProfileController::class, 'store'])->name("store");
    Route::patch('update', [App\Http\Controllers\ProfileController::class, 'update'])->name("update")->middleware('auth');
    Route::get('tags', [App\Http\Controllers\ProfileController::class, 'tags'])->name("tags")->middleware('auth');
    Route::post('settings/{id}/addImage', [App\Http\Controllers\ProfileController::class, 'addImage'])->name("addImage")->middleware('auth');

    // ! ===================
});

Route::name('catalog.')->prefix('catalog')->group(function(){
    Route::get('show', [App\Http\Controllers\CatalogController::class, 'showCatalog'])->name("show");
    Route::get('show/recipe/{id}', [App\Http\Controllers\CatalogController::class, 'showRecipe'])->name("recipe");
    Route::get('show/tags/{tag}', [App\Http\Controllers\CatalogController::class, 'showTag'])->name("showTag");
    Route::get('show/category/{id}', [App\Http\Controllers\CatalogController::class, 'showCategory'])->name("showCategory");
    Route::get('show/search', [App\Http\Controllers\CatalogController::class, 'search'])->name("search");
    Route::get('show/author/{id}', [App\Http\Controllers\CatalogController::class, 'showAuthor'])->name("showAuthor");

    // ! Function

    Route::post('comment/create/{id}', [App\Http\Controllers\CatalogController::class, 'createComment'])->name("createComment");
    Route::post('comment/evaluation/{id}', [App\Http\Controllers\CatalogController::class, 'evaluationRecipe'])->name("evaluationRecipe");
});

Route::name('admin.')->prefix('admin')->group(function(){
    Route::get('show/{id}', [App\Http\Controllers\AdminController::class, 'show'])->name("index")->middleware('admin');
    Route::get('users/{id}', [App\Http\Controllers\AdminController::class, 'users'])->name("users")->middleware('admin');
    Route::get('recipes/{id}', [App\Http\Controllers\AdminController::class, 'recipes'])->name("recipes")->middleware('admin');
    Route::get('tags/{id}', [App\Http\Controllers\AdminController::class, 'tags'])->name("tags")->middleware('admin');
    Route::get('category/{id}', [App\Http\Controllers\AdminController::class, 'category'])->name("category")->middleware('admin');
    Route::get('category/create/{id}', [App\Http\Controllers\AdminController::class, 'categoryCreate'])->name("categoryCreate")->middleware('admin');
    Route::get('recipes/{id}/change', [App\Http\Controllers\AdminController::class, 'changeRecipe'])->name("changeRecipe")->middleware('admin');

    Route::get('users/{id}/search', [App\Http\Controllers\AdminController::class, 'searchUser'])->name("searchUser")->middleware('admin');
    Route::get('recipe/{id}/search', [App\Http\Controllers\AdminController::class, 'searchRecipe'])->name("searchRecipe")->middleware('admin');
    Route::get('tags/{id}/search', [App\Http\Controllers\AdminController::class, 'searchTags'])->name("searchTags")->middleware('admin');
    Route::get('category/{id}/search', [App\Http\Controllers\AdminController::class, 'searchCategory'])->name("searchCategory")->middleware('admin');


    // ! Function

    Route::post('category/store/{id}', [App\Http\Controllers\AdminController::class, 'categoryStore'])->name("categoryStore")->middleware('admin');
    Route::get('user/{id}/destroy', [App\Http\Controllers\AdminController::class, 'destroy'])->name("destroy")->middleware('admin');
    Route::get('comment/{id}/destroyComment', [App\Http\Controllers\AdminController::class, 'destroyComment'])->name("destroyComment")->middleware('admin');
    Route::post('user/{id}/addrole', [App\Http\Controllers\AdminController::class, 'addRole'])->name("addRoles")->middleware('admin');
    Route::patch('recipes/{id}/update', [App\Http\Controllers\AdminController::class, 'update'])->name("update")->middleware('admin');
});



// Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');

Route::get('/logout', function () {
    Session::flush();
    Auth::logout();
    return redirect('/');
})->middleware('auth');


