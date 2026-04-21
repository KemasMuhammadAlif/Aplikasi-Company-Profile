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