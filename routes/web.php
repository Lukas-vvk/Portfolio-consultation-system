<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminConsultationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Middleware\RoleMiddleware;

Route::get('/', function () {
    return view('index');
})->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/account', [App\Http\Controllers\AccountController::class, 'edit'])->name('account.edit');
    Route::post('/account', [App\Http\Controllers\AccountController::class, 'update'])->name('account.update');
});

Route::prefix('student')->middleware(['auth', 'can:access-student'])->group(function () {
    Route::get('/consultation', [StudentController::class, 'index'])->name('student.index');
    Route::get('/consultations/{id}', [StudentController::class, 'show'])->name('student.show');
    Route::post('/consultations/{id}/register', [StudentController::class, 'register'])->name('student.register');
});

Route::prefix('teacher')->middleware(['auth', 'can:access-teacher'])->group(function () {
    Route::get('/consultations', [TeacherController::class, 'index'])->name('teacher.index');
    Route::get('/consultations/{id}', [TeacherController::class, 'show'])->name('teacher.show');
    Route::post('/consultations/{consultation}/approve/{student}', [TeacherController::class, 'approveStudent'])->name('teacher.consultations.approve');
    //Route::get('/consultations/create', [TeacherController::class, 'create'])->name('teacher.create');
    Route::post('/consultations', [TeacherController::class, 'store'])->name('teacher.store');
});
Route::get('/consultations/create', [TeacherController::class, 'create'])->name('teacher.create');

Route::prefix('admin')->middleware(['auth', RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/users', [AdminController::class, 'usersIndex'])->name('admin.users.index');
    Route::get('/users/{id}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/users/{id}/edit', [AdminController::class, 'updateUser']);

    Route::get('/consultations', [AdminConsultationController::class, 'index'])->name('admin.consultations.index');
    Route::get('/consultations/create', [AdminConsultationController::class, 'create'])->name('admin.consultations.create');
    Route::post('/consultations', [AdminConsultationController::class, 'store'])->name('admin.consultations.store');
    Route::get('/consultations/{id}/edit', [AdminConsultationController::class, 'edit'])->name('admin.consultations.edit');
    Route::put('/consultations/{id}', [AdminConsultationController::class, 'update'])->name('admin.consultations.update');
    Route::delete('/consultations/{id}', [AdminConsultationController::class, 'destroy'])->name('admin.consultations.destroy');
});

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

