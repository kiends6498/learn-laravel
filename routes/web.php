<?php

use App\Http\Controllers\PasswordResetController;

use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/forgot-password', [PasswordResetController::class, 'sendOTPForm'])->name('sendOTPForm');
Route::post('/forgot-password', [PasswordResetController::class, 'sendOtpViaEmail'])->name('sendOtpViaEmail');

Route::get('/verify-otp', [PasswordResetController::class, 'verifyOTPForm'])->name('verifyOTPForm');
Route::post('/verify-otp', [PasswordResetController::class, 'verifyOTP'])->name('verifyOTP');

Route::get('/resend-otp', [PasswordResetController::class, 'resendOtp'])->name('resend-otp');

Route::get('/reset-password', [PasswordResetController::class, 'resetPasswordForm'])->name('resetPasswordForm');
Route::post('/reset-password', [PasswordResetController::class, 'resetPassword'])->name('resetPassword');

Route::get('/password-reset-success', [PasswordResetController::class, 'showResetSuccess'])->name('showResetSuccess');


Route::get('/login', [PasswordResetController::class, 'loginForm'])->name('loginForm')->middleware('guest');
Route::post('/login', [PasswordResetController::class, 'login'])->name('login');

Route::get('/', [PasswordResetController::class, 'homenonlogin'])->name('homenonlogin')->middleware('guest');
Route::get('/home', [PasswordResetController::class, 'homelogin'])->name('homelogin')->middleware('auth');

Route::get('/logout', [PasswordResetController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'registerForm'])->name('registerForm');
Route::post('/register', [RegisterController::class, 'register'])->name('register');

