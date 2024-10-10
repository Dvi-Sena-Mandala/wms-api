<?php

use App\Http\Controllers\CheckInController;
use App\Http\Controllers\CheckOutController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post("/users", [UserController::class, "register"]);
Route::post("/users/login", [UserController::class, "login"]);

Route::middleware('auth:sanctum')->group(function () {
    Route::post("/checkin", [CheckInController::class, 'create']);
    Route::get("/checkin", [CheckInController::class, 'search']);
    Route::delete("/checkin/{id}", [CheckInController::class, 'delete'])->where('id', '[0-9]+');
    Route::put("/checkin/{id}", [CheckInController::class, 'update'])->where('id', '[0-9]+');
    Route::post("/checkin/{id}", [CheckInController::class, 'update'])->where('id', '[0-9]+');
    Route::get("/checkin/{id}", [CheckInController::class, 'get'])->where('id', '[0-9]+');
    Route::get("/checkin/list", [CheckInController::class, 'list']);

    Route::post('/checkout', [CheckOutController::class, 'create']);
    Route::get('/checkout/list', [CheckOutController::class, 'list']);
    Route::get("/checkout/{id}", [CheckOutController::class, 'get'])->where('id', '[0-9]+');
    Route::put("/checkout/{id}", [CheckOutController::class, 'update'])->where('id', '[0-9]+');
    Route::delete("/checkout/{id}", [CheckOutController::class, 'delete'])->where('id', '[0-9]+');
});
