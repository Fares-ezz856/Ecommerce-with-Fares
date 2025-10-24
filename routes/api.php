<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\XrayController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::prefix('fares')->group(function(){
// Route::get('/',function(){
//     return 1;
// });
// Route::get('/getallproducts',[ProductController::class,'index']);


Route::post('/analyze-xray', [XrayController::class, 'analyzeXray']);
Route::get('/download-xray-pdf', [XrayController::class, 'downloadLatestResultPdf']);


