<?php

use App\Http\Controllers\agent_commercialController;
use App\Http\Controllers\articleController;
use App\Http\Controllers\categorieController;
use App\Http\Controllers\fournisseurController;
use App\Http\Controllers\clientController;
use App\Http\Controllers\familleController;
use App\Http\Controllers\commandeController;
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
Route::get('/famille/{id?}', [familleController::class, 'index']);
Route::get('/agent/{id?}', [agent_commercialController::class, 'index']);
Route::get('/categorie/{id?}', [categorieController::class, 'index']);
Route::get('/fournisseurs/{id?}', [fournisseurController::class, 'index']);
Route::get('/clients/{id?}', [clientController::class, 'index']);
Route::get('/commandes/{id?}', [commandeController::class, 'index']);

Route::post('/articles/{id?}', [articleController::class, 'store'])->name('article.store');
Route::post('/fournisseurs/{id?}', [fournisseurController::class, 'store'])->name('fournisseur.store');
Route::post('/clients/{id?}', [clientController::class, 'store'])->name('client.store');
Route::post('/famille/{id?}', [familleController::class, 'store'])->name('famille.store');
Route::post('/agent/{id?}', [agent_commercialController::class, 'store'])->name('agent.store');
Route::post('/categorie/{id?}', [categorieController::class, 'store'])->name('categorie.store');

Route::put('/articles/{id?}', [articleController::class, 'update'])->name('article.update');
Route::put('/fournisseurs/{id?}', [fournisseurController::class, 'update'])->name('fournisseur.update');
Route::put('/clients/{id?}', [clientController::class, 'update'])->name('client.update');
