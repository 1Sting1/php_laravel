<?php

use App\Http\Controllers\FormController;

Route::get('/', [FormController::class, 'showForm'])->name('form.show');

Route::post('/submit', [FormController::class, 'submitForm'])->name('form.submit');

Route::get('/data', [FormController::class, 'showData'])->name('data.show');
