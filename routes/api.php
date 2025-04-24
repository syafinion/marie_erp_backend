<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\StockController;
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

// Sample route for user authentication
Route::post('/login', [AuthController::class, 'login']);

Route::post('/common', [CommonController::class, 'commonDataGet']);
// Route to get categories and their ingredients
Route::get('/categories', [CommonController::class, 'getCategories']);
// Route to update an ingredient
Route::put('/ingredient/{id}', [CommonController::class, 'updateIngredient']);
// api.php
Route::post('update-ingredient-barcode', [IngredientController::class, 'updateIngredientBarcode']);
Route::get('/storage-locations', [IngredientController::class, 'listLocations']);
Route::post('/storage-locations', [ IngredientController::class, 'addLocation' ]);

Route::post('ingredientsList', [IngredientController::class, 'listIngredients']);
Route::post('createIngredient', [IngredientController::class, 'createIngredient']);
Route::post('editIngredient', [IngredientController::class, 'editIngredient']);
Route::post('storeIngredients', [IngredientController::class, 'saveIngredients']);
Route::post('delete-by-barcode', [IngredientController::class,'deleteByBarcode']);
Route::post('stocks/list', [StockController::class, 'listStocks']);
Route::post('stocks/create', [StockController::class, 'createStock']);
Route::post('stocks/edit', [StockController::class, 'editStock']);
Route::post('stocks/delete', [StockController::class, 'deleteStock']);
Route::post('stocks/selectingStock', [StockController::class, 'selectStock']);
Route::post('stocks/downloadApp', [StockController::class, 'downloadStockCard']);
Route::post('stocks/manage', [StockController::class, 'manageStock']);

Route::post('/ingredient/find-by-barcode', [IngredientController::class, 'findIngredientByBarcode']);


// Example of an authenticated route using Sanctum (optional, if using Sanctum for user authentication)
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
