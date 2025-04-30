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
use App\Http\Controllers\CashbookController as Cashbook;
use App\Http\Controllers\PaymentController as Payment;
use App\Http\Controllers\AdvanceController as Advance;
use App\Http\Controllers\ProcurementController as Procurement;
use App\Http\Controllers\PoController as Po;
use App\Http\Controllers\FtpCheckController;
use App\Http\Controllers\ReconController as Recon;

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

Route::POST('/invoice', [Ap::class, 'mail']);
Route::GET('/invoice/{entity_cd}/{project_no}/{trx_type}/{doc_no}/{user_id}/{level_no}/{status}/{profile}/{flag}/{entity_name}/{logo}/{module}', [Ap::class, 'changestatus']);
Route::POST('/invoice/update', [Ap::class, 'update']);

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

Route::POST('/cashbook', [cashbook::class, 'mail']);
Route::GET('/cashbook/{entity_cd}/{project_no}/{trx_type}/{doc_no}/{user_id}/{level_no}/{status}/{profile}/{flag}/{entity_name}/{logo}/{module}', [cashbook::class, 'changestatus']);
Route::POST('/cashbook/update', [cashbook::class, 'update']);

Route::POST('/payment', [payment::class, 'mail']);
Route::GET('/payment/{entity_cd}/{project_no}/{trx_type}/{doc_no}/{user_id}/{level_no}/{status}/{profile}/{flag}/{entity_name}/{logo}/{module}', [payment::class, 'changestatus']);
Route::POST('/payment/update', [payment::class, 'update']);

Route::POST('/advance', [advance::class, 'mail']);
Route::GET('/advance/{entity_cd}/{project_no}/{trx_type}/{doc_no}/{user_id}/{level_no}/{status}/{profile}/{flag}/{entity_name}/{logo}/{module}', [advance::class, 'changestatus']);
Route::POST('/advance/update', [advance::class, 'update']);

Route::POST('/po', [po::class, 'mail']);
Route::GET('/po/{entity_cd}/{project_no}/{trx_type}/{doc_no}/{user_id}/{level_no}/{status}/{profile}/{flag}/{entity_name}/{logo}/{module}', [po::class, 'changestatus']);
Route::POST('/po/update', [po::class, 'update']);

Route::POST('/recon', [recon::class, 'mail']);
Route::GET('/recon/{entity_cd}/{project_no}/{trx_type}/{doc_no}/{user_id}/{level_no}/{status}/{profile}/{flag}/{entity_name}/{logo}/{module}', [recon::class, 'changestatus']);
Route::POST('/recon/update', [recon::class, 'update']);

Route::POST('/ending', [Ending::class, 'mail']);
Route::POST('/last', [Last::class, 'mail']);
Route::POST('/procurement', [Procurement::class, 'mail']);

Route::post('/ftp/check-file', [FtpCheckController::class, 'checkFile']);
