<?php

use App\Http\Controllers\Api\ClientsController;
use App\Http\Controllers\Api\ExpenseController;
use App\Http\Controllers\Api\JournalController;
use App\Http\Controllers\Api\ModeleController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\SalesController;
use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\DeliveryOnSaleController;
use App\Http\Controllers\Api\ReglementController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\TestController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CollectorController;
use App\Http\Controllers\Api\BoutiqueController;
use App\Http\Controllers\Api\VersementController;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\DevisController;

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
Route::post('/login/collector', [ApiAuthController::class, 'login_collector']);
Route::post('/register/collector', [ApiAuthController::class, 'register_collector']);
Route::post('/logout', [ApiAuthController::class, 'logout']);
Route::post('/change-password', [ApiAuthController::class, 'changePassword']);
Route::get('/solde', [CollectorController::class,'solde']);
// Test request
Route::get('/test', [TestController::class, 'index']);

// Get list of users
Route::get('/users', [UserController::class, 'index']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::get('/users/{id}', [UserController::class, 'show']);

// Get list of clients
Route::get('/clients', [ClientsController::class, 'index']);
Route::post('/clients', [ClientsController::class, 'store']);
Route::get('/clients/{id}', [ClientsController::class, 'show']);


Route::get('/sales', [SalesController::class, 'index']);
Route::post('/sales/simple', [SalesController::class, 'store_vente_simple']);
Route::post('/sales/credit', [SalesController::class, 'store_vente_credit']);
Route::post('/sales/nonlivre', [SalesController::class, 'store_vente_nonlivre']);
Route::post('/sales/gros', [SalesController::class, 'store_vente_gros']);

// Return the list of all product with their models.
Route::get('/products', [ProductController::class, 'index']);

// Return a list of product categories
Route::get('/categories', [CategoryController::class, 'index']);
// Return a list of product models
Route::get('/models', [ModeleController::class, 'index']);

Route::get('/expenses', [ExpenseController::class, 'index']);
Route::post('/expenses', [ExpenseController::class, 'store']);
Route::post('/expenses/journal/available', [ExpenseController::class, 'available_depense']);

Route::get('/delivery', [DeliveryOnSaleController::class, 'index']);
Route::get('/delivery/ventes', [DeliveryOnSaleController::class, 'ventes_non_livrees']);
Route::post('/delivery', [DeliveryOnSaleController::class, 'store']);

Route::post('/open-journal', [JournalController::class, 'openJournal']);
Route::post('/close-journal', [JournalController::class, 'closeJournal']);
Route::get('/verify-journal', [JournalController::class, 'verifyJournal']);

Route::get('/devis', [DevisController::class, 'index']);
Route::post('/devis/store', [DevisController::class, 'storeDevis']);

Route::get('/reglements', [ReglementController::class, 'index']);
Route::get('/debitors', [ReglementController::class, 'debiteurs']);
Route::post('/reglements', [ReglementController::class, 'store']);

Route::post('/login/collector', [CollectorController::class, 'login']);
Route::post('/register/collector', [CollectorController::class, 'register']);
Route::get('/collectors', [CollectorController::class, 'get_list_collectors']);

Route::get('/boutiques', [BoutiqueController::class, 'index']);

Route::get('/shops/collectors', [BoutiqueController::class, 'get_shops']);
Route::get('/transactions', [BoutiqueController::class, 'list_transaction']);
Route::get('/transactions/manager', [BoutiqueController::class, 'list_transaction_manager']);
Route::post('/transaction/make', [BoutiqueController::class, 'make_transaction']);
Route::post('/shop/assign', [BoutiqueController::class, 'assign_collector_shop']);
Route::get('/transactions/manager/lastTen', [BoutiqueController::class, 'lastTen']);
Route::post('/transactions/manager/filter', [BoutiqueController::class, 'dataWithFilter']);

Route::get('/versements/lastTen', [VersementController::class, 'lastTen']);
Route::post('/versements/filter', [VersementController::class, 'dataWithFilter']);
Route::post('/versements', [VersementController::class, 'store']);

