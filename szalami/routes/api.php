<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;



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

Route::post("/register", [AuthController::class, "register"]);
Route::post("/login", [AuthController::class, "login"]);
Route::get("/index", [ProductController::class, "index"]);
Route::get("/index/{id}", [ProductController::class, "show"]);
Route::get("/index/search/{name}", [ProductController::class, "search"]);
Route::get("/index/filter/{raw_material}", [ProductController::class, "filter"]);



Route::group(["middleware" => ["auth:sanctum"]], function(){
    Route::post("/new", [ProductController::class, "store"]);
    Route::post("/logout", [AuthController::class, "logout"]);
    Route::put("/index/{product}", [ProductController::class, "update"]);
    Route::delete("/index/{id}", [ProductController::class, "destroy"]);
    
});
