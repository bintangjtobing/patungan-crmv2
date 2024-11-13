<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RekeningController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\KredentialCustomerController;
use App\Http\Controllers\MultiStepController;

Route::get('/', function () {
    return view('fe.register');
});
Route::get('/dashboard', function () {
    return view(view: 'dashboard.index');
});

Route::resource('rekenings', RekeningController::class);
Route::resource('users', controller: UserController::class);
Route::resource('transactions', TransactionController::class);
// Route for listing pending transactions
Route::get('/payments', [TransactionController::class, 'listPending'])->name('transactions.pending');

// Route for marking a transaction as paid
Route::patch('/transactions/{transaction}/mark-paid', [TransactionController::class, 'markAsPaid'])->name('transactions.markPaid');
Route::resource('products', ProductController::class);
Route::resource('kredential_customers', KredentialCustomerController::class);
Route::get('kredential_customers/user/{userId}/products', [KredentialCustomerController::class, 'getProductsForUser']);

// In your routes/web.php
Route::get('/multi-step-form', [MultiStepController::class, 'showForm'])->name('showMultiStepForm');
Route::post('/multi-step-form', [MultiStepController::class, 'submitForm'])->name('submitMultiStepForm');