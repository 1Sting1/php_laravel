<?php

use App\Http\Controllers\FeedbackController;

Route::get('/', [FeedbackController::class, 'create'])->name('form.show');
Route::post('/store', [FeedbackController::class, 'store'])->name('feedback.store');

Route::get('/data', [FeedbackController::class, 'index'])->name('feedback.index');

Route::get('/feedback/{id}', [FeedbackController::class, 'show'])->name('feedback.show');
Route::get('/feedback/{id}/edit', [FeedbackController::class, 'edit'])->name('feedback.edit');
Route::put('/feedback/{id}', [FeedbackController::class, 'update'])->name('feedback.update');
Route::delete('/feedback/{id}', [FeedbackController::class, 'destroy'])->name('feedback.destroy');

Route::post('/feedback/{id}/comment', [FeedbackController::class, 'addComment'])->name('feedback.comment');
