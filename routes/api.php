<?php

use App\Http\Controllers\KaryawansController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/karyawans', KaryawansController::class);
Route::get('/karyawan/count', [KaryawansController::class, 'count']);
