<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SessionController;
use App\Models\Product;
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

// Product API'S
Route::get("products", [ProductController::class, "show"]);
Route::get("products/search", [ProductController::class, "search"]);
Route::get("products/{keyword?}/search", [ProductController::class, "search"]);

// Category API'S
Route::get("categories", [CategoryController::class, "categories"]);
Route::get("categories/search", [CategoryController::class, "search"]);
Route::get("categories/{keyword?}/search", [CategoryController::class, "search"]);

// To Authenticate the incoming user

// Route::post("/login", [SessionController::class, "authenticate"])
//     ->name("authenticate");

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
