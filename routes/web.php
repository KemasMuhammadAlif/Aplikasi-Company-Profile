<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\SertifikatController;
use App\Http\Controllers\FaqController;
use Illuminate\Support\Facades\Route;

// ── Root ──────────────────────────────────────────────────────────────────────
Route::get('/', fn() => redirect()->route('admin.project'));

// ── Auth (guest only) ─────────────────────────────────────────────────────────
Route::middleware('guest:admin')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

// ── Admin (auth required) ─────────────────────────────────────────────────────
Route::middleware('auth:admin')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Logout
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        // Project
        Route::get('/project', [ProjectController::class, 'index'])->name('project');
        Route::get('/project/create', [ProjectController::class, 'create'])->name('project.create');
        Route::post('/project', [ProjectController::class, 'store'])->name('project.store');
        Route::delete('/project/{id}', [ProjectController::class, 'destroy'])->name('project.destroy');

        // Layanan
        Route::get('/layanan', [LayananController::class, 'index'])->name('layanan');
        Route::get('/layanan/create', [LayananController::class, 'create'])->name('layanan.create');
        Route::post('/layanan', [LayananController::class, 'store'])->name('layanan.store');
        Route::get('/layanan/{id}/edit', [LayananController::class, 'edit'])->name('layanan.edit');
        Route::put('/layanan/{id}', [LayananController::class, 'update'])->name('layanan.update');
        Route::delete('/layanan/{id}', [LayananController::class, 'destroy'])->name('layanan.destroy');

        // Sertifikat
        Route::get('/sertifikat', [SertifikatController::class, 'index'])->name('sertifikat');
        Route::get('/sertifikat/create', [SertifikatController::class, 'create'])->name('sertifikat.create');
        Route::post('/sertifikat', [SertifikatController::class, 'store'])->name('sertifikat.store');
        Route::get('/sertifikat/{id}/edit', [SertifikatController::class, 'edit'])->name('sertifikat.edit');
        Route::put('/sertifikat/{id}', [SertifikatController::class, 'update'])->name('sertifikat.update');
        Route::delete('/sertifikat/{id}', [SertifikatController::class, 'destroy'])->name('sertifikat.destroy');

        // FAQ
        Route::get('/faq', [FaqController::class, 'index'])->name('faq');
        Route::get('/faq/create', [FaqController::class, 'create'])->name('faq.create');
        Route::post('/faq', [FaqController::class, 'store'])->name('faq.store');
        Route::get('/faq/{id}/edit', [FaqController::class, 'edit'])->name('faq.edit');
        Route::put('/faq/{id}', [FaqController::class, 'update'])->name('faq.update');
        Route::delete('/faq/{id}', [FaqController::class, 'destroy'])->name('faq.destroy');
    });