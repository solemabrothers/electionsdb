<?php

use App\Http\Controllers\DataVisualization;
use App\Http\Controllers\ElectionsController;
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

//Route::get('/', function () {
//    return view('home');
//});

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/filterdata', [App\Http\Controllers\ElectionsController::class, 'index'])->name('home');
Route::get('/visualisation', [App\Http\Controllers\DataVisualization::class, 'RegionalPerformance']);
Route::get('/regionvoterturnout', [App\Http\Controllers\DataVisualization::class, 'RegionalVoterTunOut']);
Route::get('/filterdata','FilterElections@index');

Route::get('/categoriesByAgegroup','AgeGroupAchievement@numbersByAgeGroup');


Auth::routes();
