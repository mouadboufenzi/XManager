<?php

use App\Http\Controllers\agent_commercialController;
use App\Http\Controllers\articleController;
use App\Http\Controllers\categorieController;
use App\Http\Controllers\fournisseurController;
use App\Http\Controllers\clientController;
use App\Http\Controllers\familleController;
use App\Http\Controllers\commandeController;
use App\Http\Controllers\DepotController;
use App\Http\Controllers\receptionController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\WelcomeController;
use App\Models\Depot;
use Illuminate\Support\Facades\Auth;
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
Route::get('/welcome', [WelcomeController::class, 'index'])->middleware('auth');
Route::get('/', function () { return view('auth.login'); });


Route::get('/articles/{id?}', [articleController::class, 'index'])->middleware('auth');
Route::get('/article-code/{id?}', [articleController::class, 'filtreCode']);
Route::get('/article-categorie/{id?}', [articleController::class, 'filtreCategorie']);
Route::get('/article-status/{id?}', [articleController::class, 'filtreStatus']);
Route::get('/article-designation/{id?}', [articleController::class, 'filtreDesignation']);

Route::get('/famille/{id?}', [familleController::class, 'index']);
Route::get('/agent/{id?}', [agent_commercialController::class, 'index']);
Route::get('/categorie/{id?}', [categorieController::class, 'index']);

Route::get('/fournisseurs/{id?}', [fournisseurController::class, 'index'])->middleware('auth');
Route::get('/fournisseur-code/{id?}', [fournisseurController::class, 'filtreCode']);
Route::get('/fournisseur-nom/{id?}', [fournisseurController::class, 'filtreNom']);
Route::get('/fournisseur-status/{id?}', [fournisseurController::class, 'filtreStatus']);

Route::get('/clients/{id?}', [clientController::class, 'index'])->middleware('auth');
Route::get('/client-code/{id?}', [clientController::class, 'filtreCode']);
Route::get('/client-status/{id?}', [clientController::class, 'filtreStatus']);
Route::get('/client-nom/{id?}', [clientController::class, 'filtreNom']);

Route::get('/commandes/{id?}', [commandeController::class, 'index'])->middleware('auth');
Route::get('/get-remise/{id?}', [commandeController::class, 'getRemise']);
Route::get('/up-quantite_reception/{id?}', [commandeController::class, 'updatePivot']);

Route::get('/receptions/{id?}', [receptionController::class, 'index'])->middleware('auth');
Route::get('/reception-commande/{id?}', [receptionController::class, 'receptionCommande']);

Route::post('/articles/{id?}', [articleController::class, 'store'])->name('article.store');
Route::post('/fournisseurs/{id?}', [fournisseurController::class, 'store'])->name('fournisseur.store');
Route::post('/clients/{id?}', [clientController::class, 'store'])->name('client.store');
Route::post('/famille/{id?}', [familleController::class, 'store'])->name('famille.store');
Route::post('/agent/{id?}', [agent_commercialController::class, 'store'])->name('agent.store');
Route::post('/categorie/{id?}', [categorieController::class, 'store'])->name('categorie.store');
Route::post('/commandes/{id?}', [commandeController::class, 'store'])->name('commande.store');
Route::post('/receptions/{id?}', [receptionController::class, 'store'])->name('reception.store');

Route::put('/articles/{id?}', [articleController::class, 'update'])->name('article.update');
Route::put('/fournisseurs/{id?}', [fournisseurController::class, 'update'])->name('fournisseur.update');
Route::put('/clients/{id?}', [clientController::class, 'update'])->name('client.update');
Route::put('/commandes/{id?}', [commandeController::class, 'update'])->name('commande.update');


Route::delete('/commandes/{id?}', [commandeController::class, 'destroy'])->name('commande.destroy');

Route::get('/facture/{id?}', [FactureController::class, 'index'])->middleware('auth');
Route::post('/facture/{id?}', [FactureController::class, 'store'])->name('facture.store');
Route::get('/facture-total/{id?}',[FactureController::class, 'factureTotal']);
Route::get('/create-facture/{id?}',[FactureController::class, 'factureCreate']);

Route::get('/depot/{id?}',[DepotController::class, 'index'])->middleware('auth');
Route::post('/depot/{id?}', [DepotController::class, 'store'])->name('depot.store');

Route::get('/stock/{id?}',[StockController::class, 'index']);
Route::post('/stock/{id?}',[StockController::class, 'store'])->name('stock.store');
Route::delete('/stock/{id?}',[StockController::class, 'destroy'])->name('stock.destroy');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
