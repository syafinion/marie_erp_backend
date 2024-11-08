<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommonController;

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

// Route to get categories and their ingredients
Route::get('/categories', [CommonController::class, 'getCategories']);

// Route to update an ingredient
Route::put('/ingredient/{id}', [CommonController::class, 'updateIngredient']);

// Example of an authenticated route using Sanctum (optional, if using Sanctum for user authentication)
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
