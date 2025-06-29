<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\LandingPublicController::class, 'index'])->name('landing');
Route::view('/syarat-dan-ketentuan', 'mou-submission.snk')->name('snk');
Route::get('/submission', [\App\Http\Controllers\MouSubmissionController::class, 'create'])->name('mou-submission');
Route::post('/submission', [\App\Http\Controllers\MouSubmissionController::class, 'store'])->name('mou-submission-store');
Route::get('/submitted-success', [\App\Http\Controllers\MouSubmissionController::class, 'success'])->name('mou-submission.submitted');
Route::get('/status', [\App\Http\Controllers\MouSubmissionController::class, 'status'])->name('mou-submission.status');

Route::get('/gallery', [\App\Http\Controllers\MouGalleriesController::class, 'index'])->name('mou-galleries.index');
Route::get('/gallery/{MouSubmission}', [\App\Http\Controllers\MouGalleriesController::class, 'show'])->name('mou-galleries.show');


Route::middleware(['guest', 'no-cache', 'security-header'])->group(function () {    
    Route::get('/login', [\App\Http\Controllers\LoginController::class, 'index'])->name('login');
    Route::post('/login', [\App\Http\Controllers\LoginController::class, 'authenticate']);
});

Route::middleware(['auth', 'security-header'])->group(function () {
    Route::get('/logout', [\App\Http\Controllers\LoginController::class, 'deauthenticate']);
    Route::get('/dashboard', [\App\Http\Controllers\LandingController::class, 'index'])->name('dashboard')->middleware('no-cache');
    Route::get('/daftar-dokumen', [\App\Http\Controllers\DokumenController::class, 'getDokumen']);
    Route::get('/dokumen/{dokumen}', [\App\Http\Controllers\DokumenController::class, 'show'])->name('dokumen.show');
    // Route::get('/dokumen/{dokumen}/download', [DokumenController::class, 'download']);
});

Route::prefix('admin')->middleware(['auth', 'is-admin', 'security-header'])->group(function () {
    Route::view('/', 'admin.index');
    Route::resource('/dokumen', \App\Http\Controllers\admin\DokumenController::class)->parameters(['dokumen' => 'dokumen'])->names('admin.dokumen');
    Route::resource('/kategori', \App\Http\Controllers\admin\KategoriController::class)->parameters(['kategori' => 'kategori'])->names('admin.kategori');
    Route::resource('/user', \App\Http\Controllers\admin\UserController::class)->only(['edit', 'update', 'show']);
});

Route::prefix('superadmin')->middleware(['auth', 'is-superadmin', 'security-header'])->group(function () {
    Route::view('/', 'superadmin.index',['title' => 'Super Admin']);
    Route::get('/statistik', [\App\Http\Controllers\superadmin\StatistikController::class, 'index'])->name('superadmin.statistik');
    Route::resource('/dokumen', \App\Http\Controllers\superadmin\DokumenController::class)->parameters(['dokumen' => 'dokumen'])->names('superadmin.dokumen');
    Route::resource('/department', \App\Http\Controllers\superadmin\DepartmentController::class)->parameters(['department' => 'department'])->except(['show'])->names('superadmin.department');
    Route::resource('/kategori', \App\Http\Controllers\superadmin\KategoriController::class)->parameters(['kategori' => 'kategori'])->names('superadmin.kategori');
    Route::resource('/user', \App\Http\Controllers\superadmin\UserController::class)->parameters(['user' => 'user'])->except(['show'])->names('superadmin.user');
    Route::resource('/mou', \App\Http\Controllers\superadmin\MouController::class)->parameters(['mou' => 'mou'])->names('superadmin.mou');
    Route::patch('/mou/{mou}/judge', [\App\Http\Controllers\superadmin\MouController::class, 'judge'])->name('superadmin.mou.judge');

    Route::get('/mou-gallery/{mouSubmissionId}', [\App\Http\Controllers\superadmin\MouGalleryController::class, 'show'])->name('superadmin.mou.gallery.show');
    Route::get('/mou-gallery/create/{mouSubmissionId}', [\App\Http\Controllers\superadmin\MouGalleryController::class, 'create'])->name('superadmin.mou.gallery.create');
    Route::post('/mou-gallery/store/{mouSubmissionId}', [\App\Http\Controllers\superadmin\MouGalleryController::class, 'store'])->name('superadmin.mou.gallery.store');
    Route::get('/mou-gallery/{mouGalleries}/edit', [\App\Http\Controllers\superadmin\MouGalleryController::class, 'edit'])->name('superadmin.mou.gallery.edit');
    Route::patch('/mou-gallery/{mouGalleries}', [\App\Http\Controllers\superadmin\MouGalleryController::class, 'update'])->name('superadmin.mou.gallery.update');
    Route::delete('/mou-gallery/{mouGalleries}', [\App\Http\Controllers\superadmin\MouGalleryController::class, 'destroy'])->name('superadmin.mou.gallery.destroy');

    Route::get('/setting', [\App\Http\Controllers\superadmin\SettingController::class, 'index'])->name('superadmin.setting.index');
    Route::put('/setting', [\App\Http\Controllers\superadmin\SettingController::class, 'update'])->name('superadmin.setting.update');
});