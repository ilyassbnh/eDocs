<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\PermissionController;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('documents', DocumentController::class);
    Route::apiResource('categories', CategorieController::class);
    Route::apiResource('permissions', PermissionController::class);
});






// Route::middleware(['auth:sanctum'])->group(function () {
//     Route::get('/users', [UserController::class, 'index']);
//     Route::post('/users', [UserController::class, 'store']);
//     Route::get('/users/{user}', [UserController::class, 'show']);
//     Route::put('/users/{user}', [UserController::class, 'update']);
//     Route::delete('/users/{user}', [UserController::class, 'destroy']);
// });

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
