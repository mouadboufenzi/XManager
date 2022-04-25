<?php

use App\Http\Controllers\articleController;
use App\Http\Controllers\fournisseurController;
use App\Http\Controllers\clientController;
use Illuminate\Support\Facades\Route;

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
Route::get('/', function (){ return view('welcome'); });
Route::get('/articles/{id?}', [articleController::class, 'index']);
Route::get('/fournisseurs/{id?}', [fournisseurController::class, 'index']);
Route::post('/articles/{id?}', [articleController::class, 'store'])->name('article.store');
Route::post('/fournisseurs/{id?}', [fournisseurController::class, 'store'])->name('fournisseur.store');
Route::put('/articles/{id?}', [articleController::class, 'update'])->name('article.update');
Route::put('/fournisseurs/{id?}', [fournisseurController::class, 'update'])->name('fournisseur.update');
Route::get('/clients/{id?}', [clientController::class, 'index']);
Route::post('/clients/{id?}', [clientController::class, 'store'])->name('client.store');
Route::put('/clients/{id?}', [clientController::class, 'update'])->name('client.update');
