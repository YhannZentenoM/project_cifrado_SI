<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/diagnosis', [App\Http\Controllers\DiagnosisController::class, 'index'])->name('diagnosis.index');
Route::get('/home', [App\Http\Controllers\DiagnosisController::class, 'home'])->name('diagnosis.home');
Route::post('/diagnosis', [App\Http\Controllers\DiagnosisController::class, 'store'])->name('diagnosis.store');
Route::get('/diagnosis/{item}', [App\Http\Controllers\DiagnosisController::class, 'show'])->name('diagnosis.show');
