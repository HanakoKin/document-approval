<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\DisposisiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DocumentApprovalController;
use App\Http\Controllers\MemoController;
use App\Http\Controllers\ShortcutController;

Route::redirect('/', '/login');

// Route::get('/test', function() {
//     return view('test.index');
// });

// Route::get('/received', function() {
//     return view('pages.documents.received');
// });

Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['admin'])->group(function () {
    Route::resource('users', UserController::class)->except('show');
    Route::post('/document/disposition/{document}', [DisposisiController::class, 'disposition'])->name('disposition');
    Route::post('/document/publish/{document}', [DisposisiController::class, 'publish'])->name('publish');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::get('/data/{type}/{category}/{year}', ShortcutController::class)->name('shortcut');

    Route::get('/list-data/{category}', [DataController::class, 'listData'])->name('list-data');
    Route::get('/getPreviewData/{dataType}/{dataId}', [DataController::class, 'previewData']);
    Route::get('/filterData/{category}/{dataType}', [DataController::class, 'filterData']);
    Route::get('/chart-data/{year}', [DataController::class, 'chartData']);
    Route::get('/shortcut-data/{year}', [DataController::class, 'shortcutData']);

    Route::get('/memo/add', [MemoController::class, 'create'])->name('memo.create');
    Route::post('/memo/add', [MemoController::class, 'store'])->name('memo.store');
    Route::get('/memo/{type}/{id}', [MemoController::class, 'show'])->name('memo.show');

    Route::get('/document/edit/{id}', [DocumentController::class, 'edit'])->name('document.edit');
    Route::get('/document/{type}/{id}', [DocumentController::class, 'show'])->name('document.show');
    Route::get('/document/add', [DocumentController::class, 'create'])->name('document.create');
    Route::post('/document/add', [DocumentController::class, 'store'])->name('document.store');

    Route::post('/approve/{document}', DocumentApprovalController::class)->name('approve');
    Route::post('/document/response/{document}', [DisposisiController::class, 'response'])->name('response');

});
