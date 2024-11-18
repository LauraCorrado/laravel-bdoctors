<?php

use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\SponsorController;
use App\Http\Controllers\Admin\BraintreeController;
use App\Http\Controllers\Admin\StatController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // Verifica se l'utente è autenticato
    if (Auth::check()) {
        return redirect()->route('admin.dashboard');
    }
    
    // Se l'utente non è loggato, vai alla pagina welcome
    return view('welcome');
})->name('welcome');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('doctors', DoctorController::class);
    Route::resource('messages', MessageController::class);
    Route::resource('reviews', ReviewController::class);
    Route::resource('sponsors', SponsorController::class);
    Route::resource('stats', StatController::class);
    // Braintree payment route
    Route::any('/doctors/braintree/{sponsorId}', [BraintreeController::class, 'token'])->name('doctors.braintree'); //mostra form pagamento
    // Route::any('/payment', [BraintreeController::class, 'token'])->name('doctors.braintree')->middleware('auth');
    // Route::get('/token', [BraintreeController::class, 'token'])->name('token');
});


require __DIR__.'/auth.php';
