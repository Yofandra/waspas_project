<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\DecisionMatrixController;
use App\Http\Controllers\NormalisasiController;
use App\Http\Controllers\ResultController;
use App\Models\Alternatif;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('master');
});

Route::resource('/data-kriteria', KriteriaController::class);
Route::resource('/data-alternatif', AlternatifController::class);
Route::resource('/decision-matrix', DecisionMatrixController::class);
Route::get('/normalisasi', [NormalisasiController::class, 'index'])->name('normalisasi.index');
Route::get('/score', [ResultController::class, 'index'])->name('score.index');
