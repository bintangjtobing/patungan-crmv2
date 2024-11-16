<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RekeningController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\KredentialCustomerController;
use App\Http\Controllers\MultiStepController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SupplierController;


Route::get('/', function () {
    return view('fe.register');
});

// Routes for login and logout
Route::middleware(['guest'])->group(function () {
    // Route for showing the login form
    Route::get('/admin/login', function() {
        return view('dashboard.login.login');
    })->name('login.form');

    // Route for handling login submission
    Route::post('/admin/login', [LoginController::class, 'login'])->name('login');
});

// Logout route available to authenticated users
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Protected routes that require login
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard');

    Route::resource('rekenings', RekeningController::class);
    Route::resource('users', UserController::class);
    Route::resource('transactions', TransactionController::class);

    // Route for listing pending transactions
    Route::get('/payments', [TransactionController::class, 'listPending'])->name('transactions.pending');

    // Route for marking a transaction as paid
    Route::patch('/transactions/{transaction}/mark-paid', [TransactionController::class, 'markAsPaid'])->name('transactions.markPaid');

    Route::resource('products', ProductController::class);
    Route::resource('kredential_customers', KredentialCustomerController::class);

    Route::get('kredential_customers/user/{userId}/products', [KredentialCustomerController::class, 'getProductsForUser']);

    // Multi-step form routes
    Route::get('/multi-step-form', [MultiStepController::class, 'showForm'])->name('showMultiStepForm');
    Route::post('/multi-step-form', [MultiStepController::class, 'submitForm'])->name('submitMultiStepForm');

    Route::resource('suppliers', SupplierController::class);

});
