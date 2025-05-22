<?php

use App\Http\Controllers\Dashboard;
use App\Http\Controllers\Rates;
use App\Http\Controllers\Schedules;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommunicationLogController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerIssueController;
use App\Http\Controllers\CustomerNoteController;
use App\Http\Controllers\CrmDashboardController;
use App\Http\Controllers\UserController;

Route::get('/', [Dashboard::class, 'index'])->name('dashboard');

Route::prefix('/sr')->group(function (){
    Route::prefix('/rates')->group(function(){
        Route::get('/index', [Rates::class, 'index'])->name("rates.index");
        Route::post('/store', [Rates::class, 'store'])->name("rates.store");
        Route::put('/{id}', [Rates::class, 'update'])->name('rates.update');
        Route::delete('/{id}', [Rates::class, 'destroy'])->name('rates.destroy');
    });
    
    Route::prefix('/schedule')->group(function(){
        Route::get('/index', [Schedules::class, 'index'])->name("schedules.index");
        Route::post('/store', [Schedules::class, 'store'])->name("schedules.store");
        Route::put('/{id}', [Schedules::class, 'update'])->name('schedules.update');
        Route::delete('/{id}', [Schedules::class, 'destroy'])->name('schedules.destroy');
    });
});


//Get Named Route
Route::prefix('/crm')->group(function (){
    Route::get('/', [CrmDashboardController::class, 'index'])->name('crm.dashboard');
    // Customers
    Route::get('/customers', [CustomerController::class, 'index'])->name('crm.customers.index');
    Route::get('/customers/create', [CustomerController::class, 'create'])->name('crm.customers.create');
    Route::post('/customers', [CustomerController::class, 'store'])->name('crm.customers.store');
    Route::get('/customers/{id}/edit', [CustomerController::class, 'edit'])->name('crm.customers.edit');
    Route::put('/customers/{id}', [CustomerController::class, 'update'])->name('crm.customers.update');
    Route::delete('/customers/{id}', [CustomerController::class, 'destroy'])->name('crm.customers.destroy');
    
    // Customer Notes
    Route::get('/notes', [CustomerNoteController::class, 'index'])->name('crm.notes.index');
    Route::post('/notes', [CustomerNoteController::class, 'store'])->name('crm.notes.store');
    Route::delete('/notes/{id}', [CustomerNoteController::class, 'destroy'])->name('crm.notes.destroy');
    
    // Communication
    Route::get('/logs', [CommunicationLogController::class, 'index'])->name('crm.logs.index');
    Route::post('/logs', [CommunicationLogController::class, 'store'])->name('crm.logs.store');
    Route::delete('/logs/{id}', [CommunicationLogController::class, 'destroy'])->name('crm.logs.destroy');
    
    // Issues / Complaints
    Route::get('/issues', [CustomerIssueController::class, 'index'])->name('crm.issues.index');
    Route::get('/issues/create', [CustomerIssueController::class, 'create'])->name('crm.issues.create');
    Route::post('/issues', [CustomerIssueController::class, 'store'])->name('crm.issues.store');
    Route::get('/issues/{id}/edit', [CustomerIssueController::class, 'edit'])->name('crm.issues.edit');
    Route::put('/issues/{id}', [CustomerIssueController::class, 'update'])->name('crm.issues.update');
    Route::delete('/issues/{id}', [CustomerIssueController::class, 'destroy'])->name('crm.issues.destroy');

    
});

Route::prefix('u/')->group(function(){
    //user
    session('userid', 1);
    Route::get('/home', [UserController::class, 'home'])->name('user.home');

    Route::get('/schedule', [UserController::class, 'schedule'])->name('user.schedule.index');
    Route::post('/schedule/cancel/{id}', [UserController::class, 'schedule_destroy'])->name('user.schedule.index');

    Route::get('/application', [UserController::class, 'application'])->name('user.application.index');
    Route::post('/application/store', [UserController::class, 'application_store'])->name('user.application.store');
    Route::post('/application/{id}', [UserController::class, 'application_destroy'])->name('user.application.delete');
});
