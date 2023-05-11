<?php

use App\Http\Controllers\Api\ClientsController;
use App\Http\Controllers\Api\ExpenseController;
use App\Http\Controllers\Api\JournalController;
use App\Http\Controllers\Api\ModeleController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\SalesController;
use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\DeliveryOnSaleController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\TestController;
use Illuminate\Http\Request;

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

// Login Request
Route::post('/login', [ApiAuthController::class, 'login']);
Route::post('/logout', [ApiAuthController::class, 'logout']);
Route::post('/change-password', [ApiAuthController::class, 'changePassword']);

// Test request
Route::get('/test', [TestController::class, 'index']);

// Get list of users
Route::get('/users', [UserController::class, 'index']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::get('/users/{id}', [UserController::class, 'show']);

// Get list of clients
Route::get('/clients', [ClientsController::class, 'index']);
Route::get('/clients/{id}', [ClientsController::class, 'show']);


Route::get('/sales', [SalesController::class, 'index']);
Route::post('/sales', [SalesController::class, 'create']);

// Return the list of all product with their models.
Route::get('/products', [ProductController::class, 'index']);

// Return a list of product categories
Route::get('/categories', [CategoryController::class, 'list_products_category']);

// Return a list of product models
Route::get('/models', [ModeleController::class, 'index']);

Route::get('/expenses', [ExpenseController::class, 'index']);
Route::post('/expenses', [ExpenseController::class, 'store']);

Route::get('/delivery', [DeliveryOnSaleController::class, 'index']);
Route::post('/delivery', [DeliveryOnSaleController::class, 'create']);

Route::post('/open-journal', [JournalController::class, 'openJournal']);
Route::post('/close-journal', [JournalController::class, 'closeJournal']);
Route::get('/verify-journal', [JournalController::class, 'verifyJournal']);



