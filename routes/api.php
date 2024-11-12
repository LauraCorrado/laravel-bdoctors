<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\DoctorController as DoctorController;
use App\Http\Controllers\Api\FieldController as FieldController;
use App\Http\Controllers\Api\MessageController as MessageController;
use App\Http\Controllers\Api\ReviewController as ReviewController;
use App\Http\Controllers\Api\RatingController as RatingController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Rotta per ottenere tutti i dottori

Route::get('/doctors', [DoctorController::class, 'index'])->name('doctors.index');
Route::get('/fields', [FieldController::class, 'index']);
Route::get('/doctors/{slug}', [DoctorController::class, 'details'])->name('details');
Route::post('/messages', [MessageController::class, 'store']);
Route::post('/reviews', [ReviewController::class, 'store']);
Route::post('/ratings', [RatingController::class, 'store']);