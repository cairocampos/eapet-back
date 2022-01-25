<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    CategoriaController,
    CepController,
    ClienteController,
    CorController,
    FornecedorController,
    PerfilController,
    ProdutoController,
    SubcategoriaController,
    UnidadeController,
    UserController
};

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user;
});

// Route::get('/cep', [CepController::class, 'index']);

Route::group(['prefix' => 'auth', 'name' => 'auth.'], function () {
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    // Route::apiResource('usuarios', UserController::class);
});
