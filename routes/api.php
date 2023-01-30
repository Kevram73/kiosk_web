<?php

use App\Http\Controllers\Api\ClientsController;
use App\Http\Controllers\Api\ExpenseController;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\SalesController;

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


/**
 *
 * // Return a user details given username and pasword.
*Route::middleware('auth:api')->get('/token/', function (Request $request) {
 *   $test = "hello world";
  *  return $test;
*});
 */

// TODO : Return user token given username and password
//Return  Return list of all user with their status of a boutique
// NOTE: Route::get('/users/', [UserController::class, 'index']);
Route::get('/users/', [UserController::class, 'index']);
// Return the list of sales.
Route::get('/sales/',[SalesController::class,'index']) ;
// Return the sale state and the list of products in the sales.
Route::get('/sales/list/',[SalesController::class,'list_sales_with_products']) ;
//Create sale
Route::post('/sales/',[SalesController::class,'create']) ;
// Return the list of all clients
Route::get('/clients/',[ClientsController::class,'list']);
// Return the list of all product with their models.
Route::get('/products/',[SalesController::class,'list_products']);
// Return a list of product categories
Route::get('/categories/',[SalesController::class,'list_products_category']) ;
// Return a list of product models
Route::get('/models/',[SalesController::class,'list_products_models']) ;
// Return the list of expenses.
Route::get('/expenses/',[ExpenseController::class,'index']) ;
// Create expenses.
Route::post('/expenses/',[ExpenseController::class,'store']) ;

// TODO : CRUD sales.
// TODO: CRUD devis

// TODO : CRUD statistiques.
