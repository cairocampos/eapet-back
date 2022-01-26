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
    CustomerPetController,
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

    Route::prefix('customers/{customer}')->group(function () {

        Route::prefix('addresses')->group(function() {
            Route::get('/', [CustomerAddressController::class, 'index']);
            Route::post('/', [CustomerAddressController::class, 'store']);
            Route::get('{id}', [CustomerAddressController::class, 'show']);
            Route::delete('{id}', [CustomerAddressController::class, 'destroy']);
        });

        Route::prefix('contacts')->group(function() {
            Route::get('/', [CustomerContactController::class, 'index']);
            Route::post('/', [CustomerContactController::class, 'store']);
            Route::get('{id}', [CustomerContactController::class, 'show']);
            Route::delete('{id}', [CustomerContactController::class, 'destroy']);
        });

        Route::prefix('pets')->group(function() {
            Route::get('/', [CustomerPetController::class, 'index']);
            Route::post('/', [CustomerPetController::class, 'store']);
            Route::get('{id}', [CustomerPetController::class, 'show']);
            Route::delete('{id}', [CustomerPetController::class, 'destroy']);
            Route::put('{id}', [CustomerPetController::class, 'update']);
        });
    });

    Route::apiResource('pelages', PelageController::class);
    Route::apiResource('species', SpecieController::class)->parameters(['species' => 'specie']);
    Route::apiResource('breeds', BreedController::class);
});
