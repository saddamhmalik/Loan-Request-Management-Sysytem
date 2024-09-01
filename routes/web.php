<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminLoanRequestController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/loan-request', [HomeController::class, 'loanRequest'])->name('request');
Route::post('/loan-request', [HomeController::class, 'processLoanRequest'])->name('submit-form');
Route::get('/application_status',[HomeController::class, 'applicationStatus'])->name('application_status');
Route::post('/know_application_status',[HomeController::class, 'knowApplicationStatus'])->name('your_application_status');

Route::get('/admin/', [AdminController::class, 'loginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');

Route::middleware(['auth:admin'])->prefix('/admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('loan_request', AdminLoanRequestController::class)->only([
        'index', 'show', 'update', 'destroy'
    ])->name('index','admin.loan_requests');
//    Route::get('/loan_request', [AdminLoanRequestController::class, 'getLoanRequests'])->name('admin.loan_requests');
//    Route::get('/loan_request/{id}', [AdminLoanRequestController::class, 'getLoanRequest'])->name('admin.loan_request');
//    Route::put('/loan_request_update/{id}', [AdminLoanRequestController::class, 'updateLoanRequest'])->name('admin.update_loan_request');
});
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

