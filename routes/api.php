<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\InvoiceController as Invoice;
use App\Http\Controllers\EndingController as Ending;
use App\Http\Controllers\ApController as Ap;
use App\Http\Controllers\LastController as Last;
use App\Http\Controllers\ContractController as Contract;
use App\Http\Controllers\ClaimController as Claim;
use App\Http\Controllers\VoController as Vo;
use App\Http\Controllers\ProgressController as Progress;
use App\Http\Controllers\BudgetController as Budget;
use App\Http\Controllers\ReviseBudgetController as ReviseBudget;
use App\Http\Controllers\SupplierController as Supplier;

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
    return $request->user();
});

Route::POST('/porequest', [Invoice::class, 'mail']);
Route::GET('/porequest/{entity_cd}/{trx_type}/{doc_no}/{user_id}/{level_no}/{status}/{profile}/{entity_name}/{logo}/{module}', [Invoice::class, 'changestatus']);
Route::POST('/porequest/update', [Invoice::class, 'update']);

Route::POST('/ap', [Ap::class, 'mail']);
Route::GET('/ap/{entity_cd}/{trx_type}/{doc_no}/{user_id}/{level_no}/{status}/{profile}/{flag}/{entity_name}/{logo}/{module}', [Ap::class, 'changestatus']);
Route::POST('/ap/update', [Ap::class, 'update']);

Route::POST('/contract', [contract::class, 'mail']);
Route::GET('/contract/{entity_cd}/{project_no}/{trx_type}/{doc_no}/{user_id}/{level_no}/{status}/{profile}/{flag}/{entity_name}/{logo}/{module}', [contract::class, 'changestatus']);
Route::POST('/contract/update', [contract::class, 'update']);

Route::POST('/claim', [claim::class, 'mail']);
Route::GET('/claim/{entity_cd}/{project_no}/{trx_type}/{doc_no}/{user_id}/{level_no}/{status}/{profile}/{flag}/{entity_name}/{logo}/{module}', [claim::class, 'changestatus']);
Route::POST('/claim/update', [claim::class, 'update']);

Route::POST('/vo', [vo::class, 'mail']);
Route::GET('/vo/{entity_cd}/{project_no}/{trx_type}/{doc_no}/{user_id}/{level_no}/{status}/{profile}/{flag}/{entity_name}/{logo}/{module}', [vo::class, 'changestatus']);
Route::POST('/vo/update', [vo::class, 'update']);

Route::POST('/progress', [progress::class, 'mail']);
Route::GET('/progress/{entity_cd}/{project_no}/{trx_type}/{doc_no}/{user_id}/{level_no}/{status}/{profile}/{flag}/{entity_name}/{logo}/{module}', [progress::class, 'changestatus']);
Route::POST('/progress/update', [progress::class, 'update']);

Route::POST('/budget', [budget::class, 'mail']);
Route::GET('/budget/{entity_cd}/{project_no}/{trx_type}/{doc_no}/{user_id}/{level_no}/{status}/{profile}/{flag}/{entity_name}/{logo}/{module}', [budget::class, 'changestatus']);
Route::POST('/budget/update', [budget::class, 'update']);

Route::POST('/revisebudget', [revisebudget::class, 'mail']);
Route::GET('/revisebudget/{entity_cd}/{project_no}/{trx_type}/{doc_no}/{user_id}/{level_no}/{status}/{profile}/{flag}/{entity_name}/{logo}/{module}', [revisebudget::class, 'changestatus']);
Route::POST('/revisebudget/update', [revisebudget::class, 'update']);

Route::POST('/supplier', [supplier::class, 'mail']);
Route::GET('/supplier/{entity_cd}/{project_no}/{trx_type}/{doc_no}/{user_id}/{level_no}/{status}/{profile}/{flag}/{entity_name}/{logo}/{module}', [supplier::class, 'changestatus']);
Route::POST('/supplier/update', [supplier::class, 'update']);


Route::POST('/ending', [Ending::class, 'mail']);
Route::POST('/last', [Last::class, 'mail']);

