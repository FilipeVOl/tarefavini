<?php

use App\Http\Controllers\{
    AuthController,
    FlavorController,
    UserController
};
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/cadastrar', [UserController::class, 'store']);

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::prefix('/user')->group(function () {
        Route::get('/', [UserController::class, 'me']);
        Route::get('/listar', [UserController::class, 'index']);
        Route::put('/atualizar/{id}', [UserController::class, 'update']);
        Route::delete('/deletar/{id}', [UserController::class, 'destroy']);
        Route::get('/visualizar/{id}', [UserController::class, 'show']);
    });

    Route::prefix('/sabor')->group(function () {
        Route::post('/', [FlavorController::class, 'store']);
        Route::get('/', [FlavorController::class, 'index']);
        Route::put('/atualizar/{id}', [FlavorController::class, 'update']);
        Route::delete('/deletar/{id}', [FlavorController::class, 'destroy']);
        Route::get('/visualizar/{id}', [FlavorController::class, 'show']);
    });

    Route::put('/auth/atualizar/{id}', [AuthController::class, 'update']);
});