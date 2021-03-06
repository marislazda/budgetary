<?php

use App\Http\Controllers\PurchasesController;
use App\Http\Controllers\StatsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PurchasesController::class, 'form'])->name('form.get');
Route::post('/', [PurchasesController::class, 'formSubmit'])->name('form.submit');
Route::get('import', [PurchasesController::class, 'importForm'])->name('importForm');
Route::post('import', [PurchasesController::class, 'importFormSubmit'])->name('importForm.submit');
Route::get('import-from-file', [PurchasesController::class, 'importFromFile']);
Route::get('stats', [StatsController::class, 'index'])->name('stats');
