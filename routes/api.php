<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;

Route::middleware(['auth.micro'])->group(function () {
    Route::apiResource('posts', PostController::class);
});
