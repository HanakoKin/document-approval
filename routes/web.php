<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DocumentApprovalController;
use App\Http\Middleware\AdminMiddleware;

Route::redirect('/', '/login');

Route::get('/login', [AuthController::class, 'index'])->name('login');
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
    Route::get('/dashboard', function () {
        return view('pages.dashboard', ['title' => 'Dashboard']);
    });
    Route::get('/document/add', [DocumentController::class, 'create'])->name('createDocument');
    Route::get('/documents/{category}', [DocumentController::class, 'index'])->name('documents');
    Route::post('/document/add', [DocumentController::class, 'store'])->name('addDocument');
    Route::get('/document/edit/{id}', [DocumentController::class, 'edit'])->name('editDocument');
    Route::post('/document/edit/{id}', [DocumentController::class, 'update'])->name('updateDocument');
    Route::get('/document/delete/{id}', [DocumentController::class, 'destroy'])->name('deleteDocument');

    Route::get('/document/{type}/{id}', [DocumentApprovalController::class, 'showDocument'])->name('showDocument');
    Route::get('/list-approval', [DocumentApprovalController::class, 'index'])->name('list-approval');
    Route::post('/approve-document/{document}', [DocumentApprovalController::class, 'approve'])->name('approve.document');
});
