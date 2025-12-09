<?php

use App\Http\Controllers\Api\FeedbackApiController;
use Illuminate\Support\Facades\Route;

Route::get('/feedbacks', [FeedbackApiController::class, 'index']);
Route::post('/feedbacks', [FeedbackApiController::class, 'store']);
