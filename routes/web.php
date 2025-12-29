<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\{TicketController,DashboardController};
use App\Http\Controllers\Admin\{CommentController,CategoryController};
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\TicketController as AdminTicketController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Agent\DashboardController as AgentDashboardController;
use App\Http\Controllers\Agent\TicketController as AgentTicketController;
use Illuminate\Support\Facades\Route;


// Root URL: redirect to login if not authenticated, dashboard if authenticated
Route::get('/', function () {
    return auth()->check() ? redirect()->route('dashboard') : redirect()->route('login');
})->name('home');

// Guest-only routes (login, register, password reset, etc.)
// These are already included by Breeze in auth.php, but we protect them with 'guest'
Route::middleware('guest')->group(function () {
    // No need to redefine login/register here – Breeze handles them in auth.php
    // But you can override if needed
});
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('/tickets', [AdminTicketController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/{ticket}', [AdminTicketController::class, 'show'])->name('tickets.show');
    // User Management
    Route::resource('users', AdminUserController::class);
    Route::post('/tickets/{ticket}/assign', [AdminTicketController::class, 'assign'])
         ->name('tickets.assign');

    
     Route::delete('/tickets/{ticket}/comments/{comment}', [AdminTicketController::class, 'deleteComment'])
         ->name('tickets.delete-comment');
});
// Agent Routes
Route::middleware(['auth', 'agent'])->prefix('agent')->name('agent.')->group(function () {
    Route::get('/dashboard', [AgentDashboardController::class, 'index'])->name('dashboard');
    Route::get('/tickets', [AgentTicketController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/{ticket}', [AgentTicketController::class, 'show'])->name('tickets.show');
    
});

// Authenticated routes (only for logged-in users)
Route::middleware('auth', 'lock')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Tickets management
    Route::resource('tickets', TicketController::class);
    Route::post('/tickets/{ticket}/reopen', [TicketController::class, 'reopen'])
     ->name('tickets.reopen');
    Route::post('/tickets/{ticket}/feedback', [TicketController::class, 'feedback'])
     ->name('tickets.feedback');
    // Comments management
    Route::post('tickets/{ticket}/comments', [CommentController::class, 'store'])
     ->name('comments.store');

    // Categories management (you can restrict to admin later if needed)
    Route::resource('categories', CategoryController::class);
    Route::post('categories/{category}/toggle-active', [CategoryController::class, 'toggleActive'])
     ->name('categories.toggle-active');
    //  update ticket status and priority (for admin and agents)
     Route::patch('/tickets/{ticket}/status', [AdminTicketController::class, 'updateStatus'])
         ->name('tickets.update-status');

    // Profile routes (from Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Lock Screen

});
// Lock screen routes (should NOT be protected by 'lock' middleware)
Route::middleware('auth')->group(function () {
    Route::get('/lock', [ProfileController::class, 'show'])->name('lock');
    Route::post('/lock/unlock', [ProfileController::class, 'unlock'])->name('lock.unlock');
});
Route::view('/privacy-policy', 'pages.privacy')->name('privacy');
Route::view('/terms-of-service', 'pages.terms')->name('terms');
// Include Breeze's authentication routes (login, register, forgot password, etc.)
require __DIR__.'/auth.php';