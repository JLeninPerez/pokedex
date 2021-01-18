<?php

use App\Http\Controllers\PokedexController;
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

Route::group(['prefix' => 'pokedex'], function () {
    Route::get('/', [PokedexController::class, 'index']);
    Route::get('/id/{pokemonId}', [PokedexController::class, 'getInfoById']);
    Route::get('/name', [PokedexController::class, 'getInfoByName']);
});

Route::fallback(function () {
    return view('not_found')->with(['message' => 'page']);
});
