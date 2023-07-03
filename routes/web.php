<?php

use App\Example;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SessionController;
use App\Http\Middleware\isAdmin;
use App\Http\Middleware\isEditor;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Foundation\Bootstrap\HandleExceptions;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ImageController;

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

// Admin  Routes

Route::prefix("/admin")->middleware(["auth", "isAdmin"])->group(function() {

    
    // Product Routes
    Route::get("/products/", [ProductController::class, "index"])->name("product.index")->middleware("auth");
    Route::post("/products/{product:slug}/updateStatus", [ProductController::class, "status"]);
    Route::get("/products/create", [ProductController::class, "create"])->middleware("isEditor");
    Route::post("/products/create", [ProductController::class, "store"])
        ->name("product.create");
    Route::delete("/product/{product:slug}/delete", [ProductController::class, "delete"]);
    Route::get("/product/{product:slug}/edit", [ProductController::class, "edit"]);
    Route::put("/product/{product:slug}/update", [ProductController::class, "update"])
        ->name("product.update");
    Route::get("/product/{slug}/imageUpload", [ImageController::class, "index"]);
    Route::post("/product/{id}/imageUpload", [ImageController::class, "create"]);

    Route::post("/image/delete", [ImageController::class, "delete"]);

    // Category Routes

    Route::get("/categories", [CategoryController::class, "index"])
        ->name("categories.index");

    Route::get("/category/create", [CategoryController::class, "create"])
        ->name("category.create");
    Route::get("/category/{category:slug}/edit", [CategoryController::class, "update"])
        ->name("category.update");
    Route::post("/category/store", [CategoryController::class, "store"])
        ->name("categories.store");
    Route::post("/category/{category:slug}/update", [CategoryController::class, "edit"])
        ->name("category.edit");
    Route::delete("/category/{category:slug}/delete", [CategoryController::class, "delete"]);

    Route::put("/category/{category:slug}/updateStatus", [CategoryController::class, "changeStatus"]);

    // Authentication Routes
    Route::withoutMiddleware(["auth", isAdmin::class])->group(function() {
        Route::get("login", [SessionController::class, "login"])->name("login")->middleware("guest");
        Route::post("login", [SessionController::class, "authenticate"])->name("authenticate")->middleware("guest");
        Route::post("logout", [SessionController::class, "destroy"])->name("logout");
        Route::get("/forget-password", [SessionController::class, "reset_password_view"])
            ->name("password.change")->middleware("guest");
    
        Route::post("/forget-password", [SessionController::class, "sendLink"])
        ->middleware("guest")->name("sendLink");
    
        Route::get("/reset-password/{token}", function(string $token) {
            return view("authentication.changePassword", ["token" => $token]);
        })->middleware("guest")->name("password.reset");
    
        Route::post("reset-password", [SessionController::class, "updateCredentials"])
            ->name("updateCredentials");
    });


    // Order Routes 

    Route::get("orders", [OrderController::class, "index"]);
    Route::put("/order/{order:order_number}/changeStatus", [OrderController::class, "changeStatus"]);
    Route::get("/order/{order:order_number}", [OrderController::class, "view"]);

    // User Routes

    Route::get('users', [UserController::class, "index"]);
    Route::post("users/{user:id}", [UserController::class, "changeRole"]);

    // Profile Routes
    Route::get("profile", [ProfileController::class, "index"]);
    Route::put("profile/changePassword", [ProfileController::class, "changePassword"]);
    Route::post("profile/changeDetails", [ProfileController::class, "changeDetails"]);
    
    Route::get('/', [AdminController::class, "index"])->middleware("auth")->name("adminHome");

    
});



// Learning Logs 

Route::get("/log", function(Log $log) {
    $handleException = new HandleExceptions();
    // $handleException->handleDeprecationError("message", storage_path("logs/custom.log"), 2);
    $user = User::findOrFail("2");
    Log::alert(sprintf("User: "), [ $user ]);

    // Runtime logging

    // Log::build([
    //     'driver' => 'single',
    //     'path' => storage_path("logs/custom.log"),
    //     'level' => 'debug'
    // ])->info("Runtime Loggin");

});

