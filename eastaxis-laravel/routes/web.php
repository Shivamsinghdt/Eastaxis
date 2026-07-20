<?php

use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\ExpertController as AdminExpertController;
use App\Http\Controllers\Admin\ProgramController as AdminProgramController;
use App\Http\Controllers\Admin\SubscriberController as AdminSubscriberController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsletterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public site
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/research', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/research/{article}', [ArticleController::class, 'show'])->name('articles.show');
Route::post('/newsletter', [NewsletterController::class, 'store'])->name('newsletter.store');

/*
|--------------------------------------------------------------------------
| Admin authentication
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('login', [AuthController::class, 'showLogin'])->name('login');
        Route::post('login', [AuthController::class, 'login'])->name('login.attempt');
    });

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');

        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('articles', AdminArticleController::class)->except('show');
        Route::resource('events', AdminEventController::class)->except('show');
        Route::resource('programs', AdminProgramController::class)->except('show');
        Route::resource('experts', AdminExpertController::class)->except('show');

        Route::get('subscribers', [AdminSubscriberController::class, 'index'])->name('subscribers.index');
        Route::get('subscribers/export', [AdminSubscriberController::class, 'export'])->name('subscribers.export');
        Route::delete('subscribers/{subscriber}', [AdminSubscriberController::class, 'destroy'])->name('subscribers.destroy');
    });
});
