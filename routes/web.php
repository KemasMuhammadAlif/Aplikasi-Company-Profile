<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\SertifikatController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\FaqvisitController;
use App\Http\Controllers\ReviewvisitController;
use App\Http\Controllers\UlasanController;
use Illuminate\Support\Facades\Route;


// ── Publik ────────────────────────────────────────────────────────────────────
Route::get('/', [HomepageController::class, 'index'])->name('homepage');
Route::get('/pengunjung/home', [HomepageController::class, 'index'])->name('pengunjung.home');
Route::get('/pengunjung/faqvisit', [FaqvisitController::class, 'index'])->name('pengunjung.faqvisit');
Route::get('/pengunjung/proyekvisit', [HomepageController::class, 'proyekvisit'])->name('pengunjung.proyekvisit');
Route::get('/proyek/{id}', [HomepageController::class, 'proyekDetail'])->name('pengunjung.proyekdetail');

// Review
Route::get('/pengunjung/review', [ReviewvisitController::class, 'index'])->name('pengunjung.reviewvisit');
Route::post('/pengunjung/review', [ReviewvisitController::class, 'store'])->name('pengunjung.review.store');

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

        // Project (modal)
        Route::get('/project', [ProjectController::class, 'index'])->name('project');
        Route::post('/project', [ProjectController::class, 'store'])->name('project.store');
        Route::put('/project/{id}', [ProjectController::class, 'update'])->name('project.update');
        Route::delete('/project/{id}', [ProjectController::class, 'destroy'])->name('project.destroy');

        // Profil
        Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
        Route::post('/profil', [ProfilController::class, 'store'])->name('profil.store');
        Route::put('/profil', [ProfilController::class, 'update'])->name('profil.update');
        Route::delete('/profil', [ProfilController::class, 'destroy'])->name('profil.destroy');
        Route::post('/profil/history', [ProfilController::class, 'saveHistory'])->name('profil.history');
        Route::post('/profil/logo', [ProfilController::class, 'saveLogo'])->name('profil.logo');

        // Layanan (modal)
        Route::get('/layanan', [LayananController::class, 'index'])->name('layanan');
        Route::post('/layanan', [LayananController::class, 'store'])->name('layanan.store');
        Route::put('/layanan/{id}', [LayananController::class, 'update'])->name('layanan.update');
        Route::delete('/layanan/{id}', [LayananController::class, 'destroy'])->name('layanan.destroy');

        // Sertifikat
        Route::get('/sertifikat', [SertifikatController::class, 'index'])->name('sertifikat');
        Route::post('/sertifikat', [SertifikatController::class, 'store'])->name('sertifikat.store');
        Route::put('/sertifikat/{id}', [SertifikatController::class, 'update'])->name('sertifikat.update');
        Route::delete('/sertifikat/{id}', [SertifikatController::class, 'destroy'])->name('sertifikat.destroy');

        // FAQ
        Route::get('/faq', [FaqController::class, 'index'])->name('faq');
        Route::post('/faq', [FaqController::class, 'store'])->name('faq.store');
        Route::put('/faq/{id}', [FaqController::class, 'update'])->name('faq.update');
        Route::delete('/faq/{id}', [FaqController::class, 'destroy'])->name('faq.destroy');

        Route::get('/ulasan', [UlasanController::class, 'index'])->name('ulasan');
        Route::post('/ulasan/{id}/balas', [UlasanController::class, 'balas'])->name('ulasan.balas');
        Route::delete('/ulasan/{id}', [UlasanController::class, 'destroy'])->name('ulasan.destroy');
    });
