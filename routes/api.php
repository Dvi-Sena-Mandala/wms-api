<?php

use App\Http\Controllers\CheckInController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post("/users", [UserController::class, "register"]);
Route::post("/users/login", [UserController::class, "login"]);
Route::post("/checkin", [CheckInController::class, 'create']);
