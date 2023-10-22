<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\AuthController;
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
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
	Route::get('/user', function (Request $request) {
		return $request->user();
	});
	Route::get('/produtos', [ProdutoController::class, 'show_all']);
	Route::get('/produto/{id}', [ProdutoController::class, 'show']);
	Route::put('/produto/{id}', [ProdutoController::class, 'update']);
	Route::delete('/produto/{id}', [ProdutoController::class, 'destroy']);
	Route::post('/produto/create', [ProdutoController::class, 'create']);
});
