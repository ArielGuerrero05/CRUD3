<?php

use App\Http\Controllers\ArticuloController;
use App\Http\Middleware\BloquearRutaArticulos;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(BloquearRutaArticulos::class)->group(function () {
    Route::resource('articulos', ArticuloController::class);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
