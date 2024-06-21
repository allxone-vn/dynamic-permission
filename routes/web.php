<?php

use App\Http\Controllers\clogin;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RegisterController;

// Route::get('/', function () {
//     return view('login');
// });

Route::get('/', [LoginController::class, 'index']);
Route::get('/login', [LoginController::class, 'index']);

// Route::group(['middleware' => ['auth', 'checkPermissions:full_name,read']], function () {
//     Route::get('/home', [HomeController::class, 'index']);
// });


Route::post('/login', [LoginController::class, 'postLogin'])->name('login');

Route::get('/register', [RegisterController::class, 'index'])->name('register_form');

Route::post('/register', [RegisterController::class, 'register'])->name('register');

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');

Route::get('/admin/employee-list', [AdminController::class, 'employeeList'])->name('admin.employeeList');

Route::get('/employee-list', [HomeController::class, 'employeeList'])->name('employee.list');

Route::get('/admin/add-employee', [AdminController::class, 'showAddEmployeeForm'])->name('admin.addEmployeeForm');

Route::post('/admin/add-employee', [AdminController::class, 'storeEmployee'])->name('admin.storeEmployee');


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
