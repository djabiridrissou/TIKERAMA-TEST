<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\VendeurDashboardController;
use App\Http\Controllers\ClientDashboardController;
use App\Http\Controllers\UserInscriptionController;
use App\Http\Controllers\EmailTestController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketTypeController;
use App\Http\Controllers\OrderIntentController;
use App\Http\Controllers\TicketController;

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
Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('connexion');
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
Route::middleware(['auth'])->group(function () {
    // Dashboard Admin
    Route::get('/admin/dashboard', [UserInscriptionController::class, 'index'])->name('admin.dashboard')->middleware('role:admin');
    Route::get('/admin/dashboard/approve/{id}', [UserInscriptionController::class, 'approve'])->name('admin.dashboard.approve')->middleware('role:admin');
    // events
    Route::get('/events', [EventController::class, 'index'])->name('events.index');
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create')->middleware('role:admin');
    Route::post('/events', [EventController::class, 'store'])->name('events.add')->middleware('role:admin');
    Route::get('/events/edit/{event_id}', [EventController::class, 'edit'])->name('events.edit')->middleware('role:admin');
    Route::put('/events/{event}', [EventController::class, 'update'])->name('events.update')->middleware('role:admin');
    // tickets_type
    Route::get('/tickets_types/{event_id}', [TicketTypeController::class, 'index'])->name('tickets_type.index');
    Route::get('/tickets-type/create/{event_id}', [TicketTypeController::class, 'create'])->name('tickets_type.create')->middleware('role:admin');
    Route::post('/tickets-type', [TicketTypeController::class, 'store'])->name('tickets_type.add')->middleware('role:admin');
    Route::get('/tickets-type/edit/{ticket_type_id}', [TicketTypeController::class, 'edit'])->name('tickets_type.edit')->middleware('role:admin');
    Route::put('/tickets_type/{ticket_type_id}', [TicketTypeController::class, 'update'])->name('tickets_type.update')->middleware('role:admin');
    // order_intent
    Route::get('/order_intent/create/{ticket_type_id}', [OrderIntentController::class, 'create'])->name('order_intent.create')->middleware('role:vendeur');
    Route::get('/order_intent/index', [OrderIntentController::class, 'index'])->name('order_intent.index');
    Route::post('/order_intent', [OrderIntentController::class, 'store'])->name('order_intent.add')->middleware('role:vendeur');
    Route::get('/order_intent/accept/{order_intent_id}', [OrderIntentController::class, 'accept'])->name('accept')->middleware('role:admin');
    Route::get('/order_intent/reject/{order_intent_id}', [OrderIntentController::class, 'reject'])->name('reject')->middleware('role:admin');
    // tickets
    Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index')->middleware('role:vendeur');
});
Route::post('/inscription', [UserInscriptionController::class, 'store'])->name('inscription.store');
Route::get('/inscription', function () {
    return view('auth.inscription');
})->name('inscription');
Route::get('/test-email', [EmailTestController::class, 'sendTestEmail']);
/* 
require __DIR__.'/auth.php'; */
