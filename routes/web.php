<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Staff\StaffDashboardController;
use App\Http\Controllers\Staff\PatientController;
use App\Http\Controllers\Staff\EmergencyController;
use App\Http\Controllers\Staff\QueueController;
use App\Http\Controllers\Doctor\DoctorDashboardController;

Route::get('/', fn() => redirect()->route('login'));

require __DIR__.'/auth.php';


Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')->name('admin.')
    ->group(function () {
        Route::get('/dashboard',           [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::get('/patients',            [AdminDashboardController::class, 'patients'])->name('patients.index');
        Route::get('/patients/{patient}',  [AdminDashboardController::class, 'showPatient'])->name('patients.show');
        Route::get('/users',               [UserManagementController::class, 'index'])->name('users.index');
        Route::get('/users/create',        [UserManagementController::class, 'create'])->name('users.create');
        Route::post('/users',              [UserManagementController::class, 'store'])->name('users.store');
        Route::get('/users/{user}/edit',   [UserManagementController::class, 'edit'])->name('users.edit');
        Route::patch('/users/{user}',      [UserManagementController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}',     [UserManagementController::class, 'destroy'])->name('users.destroy');
        Route::get('/reports',             [ReportController::class, 'index'])->name('reports.index');
        Route::get('/reports/export',      [ReportController::class, 'export'])->name('reports.export');
        Route::get('/reports/user-stats', [ReportController::class, 'userStats'])->name('reports.user-stats');
    });


Route::middleware(['auth', 'role:nurse,receptionist'])
    ->prefix('staff')->name('staff.')
    ->group(function () {
        Route::get('/dashboard',               [StaffDashboardController::class, 'index'])->name('dashboard');
        Route::get('/patients/create',         [PatientController::class, 'create'])->name('patients.create');
        Route::post('/patients',               [PatientController::class, 'store'])->name('patients.store');
        Route::get('/emergency/create',        [EmergencyController::class, 'create'])->name('emergency.create');
        Route::post('/emergency',              [EmergencyController::class, 'store'])->name('emergency.store');
        Route::get('/queue/emergency',         [QueueController::class, 'emergency'])->name('queue.emergency');
        Route::get('/queue/priority',          [QueueController::class, 'priority'])->name('queue.priority');
        Route::get('/queue/regular',           [QueueController::class, 'regular'])->name('queue.regular');
        Route::get('/queue/manage',            [QueueController::class, 'manage'])->name('queue.manage');
        Route::patch('/queue/{queue}/call',    [QueueController::class, 'call'])->name('queue.call');
        Route::patch('/queue/{queue}/serve',   [QueueController::class, 'serve'])->name('queue.serve');
        Route::patch('/queue/{queue}/done',    [QueueController::class, 'done'])->name('queue.done');
        Route::patch('/queue/{queue}/assign',  [QueueController::class, 'assign'])->name('queue.assign');
        Route::patch('/queue/{queue}/priority',[QueueController::class, 'updatePriority'])->name('queue.priority.update');
    });


Route::middleware(['auth', 'role:doctor'])
    ->prefix('doctor')->name('doctor.')
    ->group(function () {
        Route::get('/dashboard',              [DoctorDashboardController::class, 'index'])->name('dashboard');
        Route::get('/patient/{queue}',        [DoctorDashboardController::class, 'patient'])->name('patient');
        Route::patch('/queue/{queue}/done',   [DoctorDashboardController::class, 'done'])->name('done');
        Route::patch('/queue/{queue}/notes',  [DoctorDashboardController::class, 'notes'])->name('notes');
    });


Route::get('/dashboard', function () {
    return match(auth()->user()->role ?? 'admin') {
        'admin'        => redirect()->route('admin.dashboard'),
        'nurse'        => redirect()->route('staff.dashboard'),
        'receptionist' => redirect()->route('staff.dashboard'),
        'doctor'       => redirect()->route('doctor.dashboard'),
        default        => redirect()->route('admin.dashboard'),
    };
})->middleware('auth')->name('dashboard');