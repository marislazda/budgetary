<?php

use App\Http\Controllers\PurchasesController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PurchasesController::class, 'form'])->name('form.get');
Route::post('/', [PurchasesController::class, 'formSubmit'])->name('form.submit');
Route::get('import', [PurchasesController::class, 'importForm'])->name('importForm');
Route::post('import', [PurchasesController::class, 'importFormSubmit'])->name('importForm.submit');
Route::get('stats', [PurchasesController::class, 'stats'])->name('stats');
