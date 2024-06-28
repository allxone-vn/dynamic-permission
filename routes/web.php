<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PermissionController;

// Route::get('/', function () {
//     return view('login');
// });

Route::get('/', [LoginController::class, 'index']);
Route::get('/login', [LoginController::class, 'index']);
Route::get('/admin/change-password', [UserController::class, 'index'])->name('changePassword_form');
Route::get('/change-password', [UserController::class, 'changePassForm'])->name('changePassword_form_emp');

Route::post('/change-password', [UserController::class, 'changePassword'])->name('change.password');

Route::post('/login', [LoginController::class, 'postLogin'])->name('login');

Route::get('/register', [RegisterController::class, 'index'])->name('register_form');

Route::post('/register', [RegisterController::class, 'register'])->name('register');

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

//admin
Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admin.profile');

Route::get('/admin/employee-list', [AdminController::class, 'employeeList'])->name('admin.employeeList');

Route::get('/employee-list', [HomeController::class, 'employeeList'])->name('employee.list');

Route::get('/admin/add-employee', [AdminController::class, 'showAddEmployeeForm'])->name('admin.addEmployeeForm');

Route::post('/admin/add-employee', [AdminController::class, 'storeEmployee'])->name('admin.storeEmployee');

Route::get('/admin/delete/{id}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');

Route::put('/profile/update/{id}', [ProfileController::class, 'update'])->name('profile.update');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::get('auth/facebook', [SocialAuthController::class, 'redirectToFacebook'])->name('auth.facebook');

Route::get('auth/facebook/callback', [SocialAuthController::class, 'handleFacebookCallback']);

Route::post('/account/disconnect', [UserController::class, 'disconnectFacebook'])->name('facebook.disconnect');
Route::get('/account', [UserController::class, 'showAccount'])->name('show.account');



Route::get('auth/google', [SocialAuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [SocialAuthController::class, 'handleGoogleCallback']);


Route::get('forgot-password', [ResetPasswordController::class, 'index'])->name('forgot');
Route::post('password/email', [ResetPasswordController::class, 'sendMail'])->name('password.email');

Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
Route::post('/permissions', [PermissionController::class, 'update'])->name('permissions.update');

Route::get('admin/employee/{id}/edit', [AdminController::class, 'editEmployee'])->name('admin.editEmployee');
Route::put('admin/employee/{id}', [AdminController::class, 'updateEmployee'])->name('admin.updateEmployee');
