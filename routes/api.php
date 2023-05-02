<?php

use App\Http\Controllers\Api\ClientsController;
use App\Http\Controllers\Api\ExpenseController;
use App\Http\Controllers\Api\JournalController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\SalesController;
use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\DeliveryOnSaleController;
use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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


/*Route::get('/test/', function (Request $request) {
    $users = User::all();

    foreach ($users as $user) {
        $user->update(['password' => Hash::make('123456')]);
        $user->save();
    }

    return $users;
});*/

Route::get('/test1/', function (Request $request) {
    return UserResource::collection(User::all());
});

Route::get('/sales/verify-journal', [JournalController::class, 'verify']);

Route::get('/users/', [UserController::class, 'index']);
Route::post('/users/validate/', [ApiAuthController::class, 'get_user']);
Route::get('/users/roles/', [ApiAuthController::class, 'get_role_list']);
// Return the list of sales.
Route::get('/sales/', [SalesController::class, 'index']);
// Return the sale state and the list of products in the sales.
Route::get('/sales/list/', [SalesController::class, 'list_sales_with_products']);
//Create sale
Route::post('/sales/', [SalesController::class, 'create']);
// Return the list of all clients
Route::get('/clients/', [ClientsController::class, 'list']);
// Return the list of all product with their models.
Route::get('/products/', [SalesController::class, 'list_products']);
// Return a list of product categories
Route::get('/categories/', [SalesController::class, 'list_products_category']);
// Return a list of product models
Route::get('/models/', [SalesController::class, 'list_products_models']);

// Return the list of expenses.
Route::get('/expenses/', [ExpenseController::class, 'index']);
// Create expenses.
Route::post('/expenses/', [ExpenseController::class, 'store']);
// Return all the livraison sur vente .
Route::get('/delivery/', [DeliveryOnSaleController::class, 'index']);

// Change the value of an already delivered products.
Route::post('/delivery/', [DeliveryOnSaleController::class, 'create']);

// TODO: CRUD devis

// TODO : CRUD statistiques.
