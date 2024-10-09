<?php

use App\Http\Controllers\CheckInController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\ApiAuthMiddleware;
use Illuminate\Support\Facades\Route;

Route::post("/users", [UserController::class, "register"]);
Route::post("/users/login", [UserController::class, "login"]);

Route::middleware('auth:sanctum')->group(function () {
    Route::post("/checkin", [CheckInController::class, 'create']);
    Route::get("/checkin", [CheckInController::class, 'findByNoDocument']);
    Route::get("/checkin/list", [CheckInController::class, 'list']);
    Route::get("/checkin/{id}", [CheckInController::class, 'get'])->where('id', '[0-9]+');
});
