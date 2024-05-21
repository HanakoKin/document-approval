<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DocumentApprovalController;
use App\Http\Controllers\MemoController;
use App\Http\Middleware\AdminMiddleware;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::redirect('/', '/login');

Route::get('/test', function() {
    return view('test.index');
});

Route::get('/received', function() {
    return view('pages.documents.received');
});

Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['admin'])->group(function () {
    Route::get('/user', [UserController::class, 'index'])->name('users');
    Route::get('/user/add', [UserController::class, 'create'])->name('createUser');
    Route::post('/user/add', [UserController::class, 'store'])->name('addUser');
    Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('editUser');
    Route::post('/user/edit/{id}', [UserController::class, 'update'])->name('updateUser');
    Route::get('/user/delete/{id}', [UserController::class, 'destroy'])->name('deleteUser');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/document/add', [DocumentController::class, 'create'])->name('createDocument');
    Route::get('/documents/{category}', [DocumentController::class, 'index'])->name('documents');
    Route::post('/document/add', [DocumentController::class, 'store'])->name('addDocument');
    Route::get('/document/edit/{id}', [DocumentController::class, 'edit'])->name('editDocument');
    Route::post('/document/edit/{id}', [DocumentController::class, 'update'])->name('updateDocument');
    Route::get('/document/delete/{id}', [DocumentController::class, 'destroy'])->name('deleteDocument');

    Route::get('/document/{type}/{id}', [DocumentApprovalController::class, 'showDocument'])->name('showDocument');
    Route::get('/list-approval', [DocumentApprovalController::class, 'index'])->name('list-approval');
    Route::post('/approve-document/{document}', [DocumentApprovalController::class, 'approve'])->name('approve.document');

    Route::get('/memo/add', [MemoController::class, 'create'])->name('createMemo');
    Route::get('/memos/{category}', [MemoController::class, 'index'])->name('memos');
    Route::post('/memo/add', [MemoController::class, 'store'])->name('addMemo');
    Route::get('/memo/{type}/{id}', [MemoController::class, 'show'])->name('showMemo');

    Route::get('/inbox/{category}', [DashboardController::class, 'show'])->name('show');
    Route::get('/data/{type}/{category}', [DashboardController::class, 'each'])->name('each');
    Route::get('/getPreviewData/{dataType}/{dataId}', [DataController::class, 'previewData']);
    Route::get('/filterData/{category}/{dataType}', [DataController::class, 'filterData']);

    Route::get('/chart-data/{year}', [DataController::class, 'chartData']);

});
