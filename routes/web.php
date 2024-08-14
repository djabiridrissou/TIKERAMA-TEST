<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\VendeurDashboardController;
use App\Http\Controllers\ClientDashboardController;
use App\Http\Controllers\UserInscriptionController;
use App\Http\Controllers\EmailTestController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});



//auth
Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('login');
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
Route::middleware(['auth'])->group(function () {
    // Dashboard Admin
    Route::get('/admin/dashboard', [UserInscriptionController::class, 'index'])->name('admin.dashboard')->middleware('role:admin');
    Route::get('/admin/dashboard/approve/{id}', [UserInscriptionController::class, 'approve'])->name('admin.dashboard.approve')->middleware('role:admin');
    // Dashboard Vendeur
    Route::get('/vendeur/dashboard', [VendeurDashboardController::class, 'index'])->name('vendeur.dashboard')->middleware('role:vendeur');
    // Dashboard Client
    Route::get('/client/dashboard', [ClientDashboardController::class, 'index'])->name('client.dashboard');
});
Route::post('/inscription', [UserInscriptionController::class, 'store'])->name('inscription.store');

Route::get('/inscription', function () {
    return view('auth.inscription');
})->name('inscription');
Route::get('/test-email', [EmailTestController::class, 'sendTestEmail']);
/* 
require __DIR__.'/auth.php'; */
