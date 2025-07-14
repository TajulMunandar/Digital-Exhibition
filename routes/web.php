<?php

use App\Http\Controllers\AkunMenteeController;
use App\Http\Controllers\AkunMentorController;
use App\Http\Controllers\ArsipProyekController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardMenteController;
use App\Http\Controllers\DashboardMentorController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\MemberMasterController;
use App\Http\Controllers\MentorProjectController;
use App\Http\Controllers\PesanMasukController;
use App\Http\Controllers\ProyekMenteeController;
use App\Http\Controllers\StatusProyekController;
use App\Http\Controllers\TampilanProyekController;
use App\Http\Controllers\TechController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', [MainController::class, 'index']);
Route::get('/showcase/{id}', [MainController::class, 'show'])->name('project.show');
Route::get('/showcase', [MainController::class, 'showcase']);
Route::post('/pesan', [MainController::class, 'store'])->name('pesan.store');
Route::get('/tentang', [MainController::class, 'tentang']);

Route::prefix('dashboard')->group(function () {
    // Halaman utama dashboard
    Route::get('/index', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/index-mente', [DashboardMenteController::class, 'index'])->name('dashboard.mente');
    Route::get('/approvement/{projectId}', [DashboardMentorController::class, 'show'])->name('detail-project');
    Route::post('/project/{project}/setujui', [DashboardMentorController::class, 'setujui'])->name('project.status.setujui');
    Route::post('/project/{project}/revisi', [DashboardMentorController::class, 'revisi'])->name('project.status.revisi');
    Route::post('/project/{project}/best', [DashboardMentorController::class, 'best'])->name('project.status.best');

    Route::get('/index-mentor', [DashboardMentorController::class, 'index'])->name('dashboard.mentor');
    Route::post('/index-mente', [DashboardMenteController::class, 'store'])->name('projects.store');
    Route::get('/get-mentors/{kategoriId}', [DashboardMenteController::class, 'getMentorsByKategori']);
    // Proyek Mentee
    Route::resource('proyek-mentee', ProyekMenteeController::class);

    // Pesan Masuk
    Route::resource('pesan-masuk', PesanMasukController::class);

    // Akun Mentor
    Route::resource('mentor/asesment', MentorProjectController::class);
    Route::resource('mentor', AkunMentorController::class);
    Route::put('mentor/{id}/reset-password', [MentorProjectController::class, 'resetPassword'])->name('mentor.resetPassword');

    // Akun Mentee
    Route::resource('mentee', AkunMenteeController::class);
    Route::put('mentee/{id}/reset-password', [AkunMenteeController::class, 'resetPassword'])->name('mentee.resetPassword');


    Route::resource('member-master', MemberMasterController::class);

    // Status Proyek
    Route::resource('status-proyek', StatusProyekController::class);

    // Arsip Proyek
    Route::resource('arsip-proyek', ArsipProyekController::class);

    // Tampilan Proyek
    Route::resource('tampilan-proyek', TampilanProyekController::class);

    // Tech
    Route::resource('tech', TechController::class);

    // Kategori
    Route::resource('kategori', KategoriController::class);
});
