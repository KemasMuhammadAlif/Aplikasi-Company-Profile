<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\SertifikatController;
use App\Http\Controllers\FaqController;
use Illuminate\Support\Facades\Route;

// ── Root ─────────────────────────────────────────────────────────────────────
Route::get('/', fn() => redirect()->route('admin.project'));

// ── Auth ─────────────────────────────────────────────────────────────────────
Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// ── Admin ─────────────────────────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/project', [ProjectController::class, 'index'])->name('project');
    Route::get('/layanan',  [LayananController::class, 'index'])->name('layanan');
     Route::get('/sertifikat', [SertifikatController::class, 'index'])->name('sertifikat');
    Route::get('/faq',        [FaqController::class, 'index'])->name('faq');
    // Route::get('/settings',   [SettingsController::class, 'index'])->name('settings');
});

// Project
Route::middleware('auth:admin')->prefix('admin')->group(function () {
    Route::get('/project', [ProjectController::class, 'index'])->name('admin.project');
    Route::get('/project/create', [ProjectController::class, 'create'])->name('admin.project.create');
    Route::post('/project', [ProjectController::class, 'store'])->name('admin.project.store');
    Route::delete('/project/{id}', [ProjectController::class, 'destroy'])->name('admin.project.destroy');
});

// Layanan
Route::middleware('auth:admin')->prefix('admin')->group(function () {
    Route::get('/layanan', [LayananController::class, 'index'])->name('admin.layanan');
    Route::get('/layanan/create', [LayananController::class, 'create'])->name('admin.layanan.create');
    Route::post('/layanan', [LayananController::class, 'store'])->name('admin.layanan.store');
    Route::get('/layanan/{id}/edit', [LayananController::class, 'edit'])->name('admin.layanan.edit');
    Route::put('/layanan/{id}', [LayananController::class, 'update'])->name('admin.layanan.update');
    Route::delete('/layanan/{id}', [LayananController::class, 'destroy'])->name('admin.layanan.destroy');
});

// Sertifikat
Route::middleware('auth:admin')->prefix('admin')->group(function () {
    Route::get('/sertifikat', [SertifikatController::class, 'index'])->name('admin.sertifikat');
    Route::get('/sertifikat/create', [SertifikatController::class, 'create'])->name('admin.sertifikat.create');
    Route::post('/sertifikat', [SertifikatController::class, 'store'])->name('admin.sertifikat.store');
    Route::get('/sertifikat/{id}/edit', [SertifikatController::class, 'edit'])->name('admin.sertifikat.edit');
    Route::put('/sertifikat/{id}', [SertifikatController::class, 'update'])->name('admin.sertifikat.update');
    Route::delete('/sertifikat/{id}', [SertifikatController::class, 'destroy'])->name('admin.sertifikat.destroy');
});

// FAQ
Route::middleware('auth:admin')->prefix('admin')->group(function () {
    Route::get('/faq', [FaqController::class, 'index'])->name('admin.faq');
    Route::get('/faq/create', [FaqController::class, 'create'])->name('admin.faq.create');
    Route::post('/faq', [FaqController::class, 'store'])->name('admin.faq.store');
    Route::get('/faq/{id}/edit', [FaqController::class, 'edit'])->name('admin.faq.edit');
    Route::put('/faq/{id}', [FaqController::class, 'update'])->name('admin.faq.update');
    Route::delete('/faq/{id}', [FaqController::class, 'destroy'])->name('admin.faq.destroy');
});
