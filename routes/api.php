<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\InvoiceController as Invoice;
use App\Http\Controllers\EndingController as Ending;

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

Route::POST('/ending', [Ending::class, 'mail']);

