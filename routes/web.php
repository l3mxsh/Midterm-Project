<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Dashboard\UsersController;
use App\Http\Controllers\Dashboard\StudentsController;
use App\Http\Controllers\Dashboard\ProfileController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Guest only routes (redirect to dashboard if already logged in)
Route::middleware('guest')->group(function () {
    Route::get('/', fn() => view('Auth/login'))->name('login');
    Route::post('/login', LoginController::class)->name('login.post');
    Route::get('/register', fn() => view('Auth/register'))->name('register');
    Route::post('/register', RegisterController::class)->name('register.post');
});

// Authenticated only routes
Route::middleware('auth')->group(function () {

    Route::get('/dashboard/student', StudentsController::class)->name('dashboard.student');
    Route::get('/dashboard/settings',  ProfileController::class)->name('dashboard.settings');
    Route::get('/dashboard/users', UsersController::class)->name('dashboard.users');
    Route::get('/dashboard', [\App\Http\Controllers\Dashboard\DashboardController::class, '__invoke'])->name('dashboard');


    Route::put('/dashboard/settings/{user}', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/dashboard/users/{user}', [UsersController::class, 'update'])->name('users.update');
    Route::put('/dashboard/student/{student}', [StudentsController::class, 'update'])->name('student.update');
    Route::post('/dashboard/settings/profile/{user}', [ProfileController::class, 'updateImg'])->name('profile.updateImg');


    Route::delete('/dashboard/users/{user}', [UsersController::class, 'delete'])->name('users.delete');
    Route::delete('/dashboard/student/{student}', [StudentsController::class, 'delete'])->name('student.delete');

    Route::post('/student/register', [StudentsController::class, 'create'])->name('student.create');
    Route::post('/dashboard/users', [UsersController::class, 'store'])->name('users.store');
    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    })->name('logout');
});
