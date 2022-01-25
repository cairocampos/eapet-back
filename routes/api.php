<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    BreedController,
    CategoriaController,
    CepController,
    ClienteController,
    CorController,
    CustomerAddressController,
    CustomerContactController,
    CustomerController,
    FornecedorController,
    PelageController,
    PerfilController,
    ProdutoController,
    SpecieController,
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
    Route::apiResource('users', UserController::class);
    Route::apiResource('customers', CustomerController::class);

    Route::prefix('customers')->group(function () {
        Route::get('{customer}/addresses', [CustomerAddressController::class, 'index']);
        Route::get('{customer}/addresses/{id}', [CustomerAddressController::class, 'show']);
        Route::delete('{customer}/addresses/{id}', [CustomerAddressController::class, 'destroy']);
        Route::post('{customer}/addresses', [CustomerAddressController::class, 'store']);

        Route::get('{customer}/contacts', [CustomerContactController::class, 'index']);
        Route::get('{customer}/contacts/{id}', [CustomerContactController::class, 'show']);
        Route::delete('{customer}/contacts/{id}', [CustomerContactController::class, 'destroy']);
        Route::post('{customer}/contacts', [CustomerContactController::class, 'store']);
    });

    Route::apiResource('pelages', PelageController::class);
    Route::apiResource('species', SpecieController::class)->parameters(['species' => 'specie']);
    Route::apiResource('breeds', BreedController::class);
});
