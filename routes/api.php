<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\InvoiceController as Invoice;
use App\Http\Controllers\EndingController as Ending;
use App\Http\Controllers\ApController as Ap;
use App\Http\Controllers\LastController as Last;

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

Route::POST('/ending', [Ending::class, 'mail']);
Route::POST('/last', [Last::class, 'mail']);

