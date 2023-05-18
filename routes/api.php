<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\API\MovieController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\ImageController;
use App\Http\Controllers\API\UserController;
// {{ controllerImportPlaceholder }}

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:sanctum')->group( function () { });
Route::group(['middleware' => 'cors'], function () {
    Route::controller(AuthController::class)->group(function(){    
        Route::post('register', 'register');
        Route::post('login', 'login');    
    });
});



Route::group(['middleware' => 'cors'], function () { 
Route::post('logout', [AuthController::class, 'logout']);

Route::controller(ImageController::class)->group(function () {
    Route::prefix('/images')->group(function () {
        Route::get('/index', 'index')->name('get-images');
        Route::get('/show/{image:id}', 'show')->name('get-image');
        Route::post('/create', 'create')->name('create-image');
        Route::put('/update/{id}', 'update')->name('update-image');
        Route::delete('/delete/{id}', 'delete')->name('delete-image');
        Route::post('/filter', 'filter')->name('filter-images');
    });
});


Route::controller(MovieController::class)->group(function () {
    Route::prefix('/movies')->group(function () {
        Route::get('/index', 'index')->name('get-movies');
        Route::get('/show/{movie:id}', 'show')->name('get-movie');
        Route::post('/create', 'create')->name('create-movie');
        Route::put('/update/{id}', 'update')->name('update-movie');
        Route::delete('/delete/{id}', 'delete')->name('delete-movie');
        Route::post('/favorite', 'favorite')->name('add-favorite-movie');
        Route::post('/filter', 'filter')->name('filter-movies');        
    });
});


Route::controller(PostController::class)->group(function () {
    Route::prefix('/posts')->group(function () {
        Route::get('/index', 'index')->name('get-posts');
        Route::get('/show/{post:slug}', 'show')->name('get-post');
        Route::post('/create', 'create')->name('create-post');
        Route::put('/update/{post:slug}', 'update')->name('update-post');
        Route::delete('/delete/{post:slug}', 'delete')->name('delete-post');
        Route::post('/filter', 'filter')->name('filter-posts');
    });
});


Route::controller(RoleController::class)->group(function () {
    Route::prefix('/roles')->group(function () {
        Route::get('/index', 'index')->name('get-roles');
        Route::get('/show/{role:id}', 'show')->name('get-role');
        Route::post('/create', 'create')->name('create-role');
        Route::put('/update/{id}', 'update')->name('update-role');
        Route::delete('/delete/{id}', 'delete')->name('delete-role');
        Route::post('/filter', 'filter')->name('filter-roles');
    });
});


Route::controller(UserController::class)->group(function () {
    Route::prefix('/users')->group(function () {
        Route::get('/index', 'index')->name('get-users');
        Route::get('/show/{user:id}', 'show')->name('get-user');
        Route::post('/create', 'create')->name('create-users');
        Route::put('/update/{id}', 'update')->name('update-users');
        Route::delete('/delete/{id}', 'delete')->name('delete-users');
        Route::post('/favorite', 'favorite')->name('get-favorite-movies');
        Route::post('/filter', 'filter')->name('filter-users');
    });
});


// {{ routesPlaceholder }}


});