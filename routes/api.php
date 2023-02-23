<?php

use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CustomerController;
use Illuminate\Support\Facades\Auth;

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


Route::post('auth/register',[AuthController::class, 'register']);
Route::post('auth/login',[AuthController::class, 'login']);
Route::get('product',[ProductController::class, 'getProduct']);
Route::get('productSingle',[ProductController::class, 'getSingleProduct']);



Route::middleware(['auth:api'])->group(function(){
    Route::post('customer', [CustomerController::class, 'getCustomer']);
    Route::put('customer/update', [CustomerController::class, 'update']);
    Route::post('customer/logout', [CustomerController::class, 'logout']); 
});