<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\SpecialtyController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ProfileController;
use App\Models\Specialty;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $specialties = Specialty::limit(8)->get();
    return view('welcome', compact('specialties'));
});

// Public routes
Route::get('/doctors', [DoctorController::class, 'index'])->name('doctors.index');
Route::get('/doctors/{id}', [DoctorController::class, 'show'])->name('doctors.show');
Route::get('/specialties', [SpecialtyController::class, 'index'])->name('specialties.index');
Route::get('/specialties/{slug}', [SpecialtyController::class, 'show'])->name('specialties.show');
Route::get('/contact', function () {
    return view('contact');
})->name('contact');
Route::post('/contact', [App\Http\Controllers\ContactController::class, 'send'])->name('contact.send');

// Authentication routes
Route::get('/login', [AuthController::class, 'showLoginChoice'])->name('login');
Route::get('/login-patient', [AuthController::class, 'showPatientLogin'])->name('login.patient');
Route::post('/login-patient', [AuthController::class, 'loginPatient'])->name('login.patient');
Route::get('/login-doctor', [AuthController::class, 'showDoctorLogin'])->name('login.doctor');
Route::post('/login-doctor', [AuthController::class, 'loginDoctor'])->name('login.doctor');
Route::get('/register', [AuthController::class, 'showRegisterChoice'])->name('register');
Route::get('/register-patient', [AuthController::class, 'showPatientRegister'])->name('register.patient');
Route::post('/register-patient', [AuthController::class, 'registerPatient'])->name('register.patient');
Route::get('/register-doctor', [AuthController::class, 'showDoctorRegister'])->name('register.doctor');
Route::post('/register-doctor', [AuthController::class, 'registerDoctor'])->name('register.doctor');

// Password Reset Routes
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.store');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/logout', function() {
    return redirect('/');
});

// Protected routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');
    
    // Profile management
    Route::get('/profile/patient', [ProfileController::class, 'showPatientProfile'])->name('profile.patient');
    Route::put('/profile/patient', [ProfileController::class, 'updatePatientProfile'])->name('profile.patient.update');
    Route::get('/profile/doctor', [ProfileController::class, 'showDoctorProfile'])->name('profile.doctor');
    Route::put('/profile/doctor', [ProfileController::class, 'updatedoctorProfile'])->name('profile.doctor.update');
    Route::match(['put', 'patch'], '/profile/doctor', [ProfileController::class, 'updateDoctorProfile'])->name('profile.doctor.update');
    Route::get('/profile/password', [ProfileController::class, 'showPasswordChange'])->name('profile.password');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    Route::get('/profile/delete', [ProfileController::class, 'showDeleteConfirm'])->name('profile.delete.confirm');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.delete');
    
    // Appointments
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::get('/appointments/create/{doctorId}', [AppointmentController::class, 'create'])->name('appointments.create');
    Route::post('/appointments/{doctorId}', [AppointmentController::class, 'store'])->name('appointments.store');
    Route::get('/appointments/{appointment}', [AppointmentController::class, 'show'])->name('appointments.show');
    Route::get('/appointments/{appointment}/edit', [AppointmentController::class, 'edit'])->name('appointments.edit');
    Route::put('/appointments/{appointment}', [AppointmentController::class, 'update'])->name('appointments.update');
    Route::delete('/appointments/{appointment}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');
    Route::delete('/appointments/{appointment}/force', [AppointmentController::class, 'forceDelete'])->name('appointments.force-delete');
    Route::post('/appointments/{appointment}/confirm', [App\Http\Controllers\AppointmentController::class, 'confirm'])->name('appointments.confirm');
    
    // Nouvelles routes pour la gestion des créneaux
    Route::get('/appointments/cleanup', [AppointmentController::class, 'cleanupExpiredSlots'])->name('appointments.cleanup');
    Route::get('/doctors/{doctorId}/available-slots', [AppointmentController::class, 'getAvailableSlots'])->name('appointments.available-slots');

    Route::get('/profile/availability', [ProfileController::class, 'showDoctorAvailability'])->name('profile.availability');
    Route::post('/profile/availability', [ProfileController::class, 'updateDoctorAvailability'])->name('profile.availability.update');

    // Historique patient
    Route::get('/profile/history', [ProfileController::class, 'showPatientHistory'])->name('profile.history');
});

// Auth routes removed - using custom pages

Route::get('/profile/edit', function () {
    return redirect()->route('profile');
})->name('profile.edit');

Route::post('/notifications/{id}/read', function($id, Request $request) {
    $notification = $request->user()->notifications()->findOrFail($id);
    $notification->markAsRead();
    return back();
})->middleware('auth')->name('notifications.read');

Route::get('/autocomplete/doctors', [\App\Http\Controllers\DoctorController::class, 'autocomplete'])->name('doctors.autocomplete');
