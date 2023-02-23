<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\UserController as AdminUser;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\HelloJobByController;
use App\Http\Controllers\getTableController;
use App\Http\Controllers\AddressController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use RealRashid\SweetAlert\Facades\Alert;
use App\Events\Message;
use App\Events\MessageSent;
use App\Http\Controllers\RedisController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {   
    // Storage::disk('local')->put('test.ext','Hi');
    return view('welcome');
    Alert::success('hi');
});

Auth::routes();

Route::prefix('user')->name('user.')->group(function(){
    Route::middleware(['guest:web', 'PreventBackHistory'])->group(function(){
        Route::view('/login','dashboard.user.login')->name('login');
        Route::view('/register','dashboard.user.register')->name('register');
        Route::post('/create',[UserController::class,'create'])->name('create');
        Route::post('/check', [UserController::class,'check'])->name('check');
    });
    Route::middleware(['auth:web','PreventBackHistory'])->group(function(){
        Route::view('/home', 'dashboard.user.dashboard')->name('home');
        Route::post('/logout', [UserController::class,'logout'])->name('logout');
    });
});

Route::prefix('admin')->name('admin.')->group(function(){
    Route::middleware(['guest:admin', 'PreventBackHistory'])->group(function(){
        Route::view('/login','dashboard.admin.login')->name('login');
        Route::post('/check', [AdminController::class,'check'])->name('check');

        Route::get('/forget-pass', [AdminController::class,'forgetPass'])->name('forgetPass');
        Route::post('/reset-pass', [AdminController::class,'postForgetPass'])->name('postForgetPass');
        Route::get('/get-pass/{admin}/{token}', [AdminController::class,'getPass'])->name('getPass');
        Route::post('/get-pass/{admin}/{token}', [AdminController::class,'postGetPass'])->name('postGetPass');   
    });
    Route::middleware(['auth:admin','PreventBackHistory'])->group(function(){
        Route::view('/home', 'dashboard.admin.dashboard')->name('home');
        Route::post('/logout', [AdminController::class,'logout'])->name('logout');
        Route::prefix('user')->name('user.')->group(function(){
            Route::get('/index', [AdminUser::class,'index'])->name('index');
            Route::get('/create', [AdminUser::class, 'create'])->name('create');
            Route::post('/store', [AdminUser::class, 'store'])->name('store');
            Route::delete('/destroy{id}', [AdminUser::class, 'destroy'])->name('destroy');
            Route::get('/edit{id}', [AdminUser::class, 'edit'])->name('edit');
            Route::put('/update{id}', [AdminUser::class, 'update'])->name('update');
            Route::get('/index', [AdminUser::class,'index'])->name('index');  
            Route::get('/get-district', [AddressController::class,'district'])->name('district'); 
            Route::get('/get-commune', [AddressController::class,'commune'])->name('commune');    
        });
        Route::prefix('test')->name('test.')->group(function(){
            Route::get('/testQueuee', [HelloJobByController::class,'helJob'])->name('helJob'); 
        });
        Route::prefix('category')->name('category.')->group(function(){
            Route::get('/index', [UserCategoryController::class,'index'])->name('index');
            Route::get('/create', [UserCategoryController::class,'create'])->name('create');
            Route::post('/store', [UserCategoryController::class,'store'])->name('store');
            Route::get('/edit{id}', [UserCategoryController::class,'edit'])->name('edit');
            Route::put('/update{id}', [UserCategoryController::class,'update'])->name('update');
            Route::delete('/destroy{id}', [UserCategoryController::class, 'destroy'])->name('destroy');
        });
        Route::prefix('product')->name('product.')->group(function(){
            Route::get('/index', [ProductController::class,'index'])->name('index');
            Route::get('/create', [ProductController::class,'create'])->name('create');
            Route::post('/store', [ProductController::class,'store'])->name('store');
            Route::get('/edit{id}', [ProductController::class,'edit'])->name('edit');
            Route::put('/update{id}', [ProductController::class,'update'])->name('update');
            Route::post('/delete{id}', [ProductController::class,'delete'])->name('delete');
            Route::get('/export', [ProductController::class,'exportCSV'])->name('export');
            Route::get('/exportPdf', [ProductController::class,'exportPdf'])->name('exportPdf');
        });
    });
});

Route::get('chat', [RedisController::class,'index']);

Route::get('/chat-mess', [RedisController::class,'postSendMessage'])->name('message');


require __DIR__.'/auth.php';

