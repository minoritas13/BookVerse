<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoansController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
@@ -13,6 +17,16 @@
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/book/filter',[BookController::class,'index'])->name('books.index');

Route::middleware(['auth', 'role:admin'])->group(function () {
    //admin dashboard
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    //admin books
    Route::get('/admin/books', [AdminController::class,'books'])->name('admin.books');
    Route::get('/admin/book/create',[BookController::class,'create'])->name('admin.book.create');
    Route::post('/admin/book/store',[BookController::class,'store'])->name('admin.book.store');
    Route::get('/admin/book/{id}/edit', [BookController::class, 'edit'])->name('admin.book.edit');
    Route::put('/admin/book/{id}', [BookController::class, 'update'])->name('admin.book.update');
    Route::delete('/admin/book/{id}', [BookController::class, 'destroy'])->name('admin.book.destroy');

    //admin loan
    Route::get('/loans', [AdminController::class, 'index'])->name('admin.loans');
    Route::put('/loans/{id}/status', [LoansController::class, 'updateStatus'])->name('admin.loans.updateStatus');

    //admin user
    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    //user dashboard
    Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.dashboard');

    //books route
    Route::get('/user/books', [UserController::class, 'index'])->name('user.books');
    Route::get('/user/books/{id}', [BookController::class, 'show'])->name('user.books.show');

    //loan route
    Route::post('/loans', [LoansController::class, 'store'])->name('loans.store');
});
