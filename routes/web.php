<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\LocalGuideController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TravelPackageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::resource('destinations', DestinationController::class);
Route::resource('hotels', HotelController::class);
Route::resource('packages', TravelPackageController::class)->parameters(['packages' => 'package']);

Route::get('/guides', [LocalGuideController::class, 'index'])->name('guides.index');
Route::post('/hotels/{hotel}/book', [HotelController::class, 'book'])->name('hotels.book');
Route::get('/booking-history', [HotelController::class, 'history'])->name('bookings.history');
Route::post('/packages/{package}/book', [TravelPackageController::class, 'book'])->name('packages.book');
Route::post('/destinations/{destination}/reviews', [ReviewController::class, 'storeDestination'])->name('destinations.reviews.store');
Route::post('/hotels/{hotel}/reviews', [ReviewController::class, 'storeHotel'])->name('hotels.reviews.store');

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::delete('/admin/users/{user}', [AdminController::class, 'deleteUser'])->name('admin.users.destroy');
Route::patch('/admin/hotel-bookings/{booking}/cancel', [AdminController::class, 'cancelHotelBooking'])->name('admin.hotel-bookings.cancel');
Route::patch('/admin/package-bookings/{booking}/cancel', [AdminController::class, 'cancelPackageBooking'])->name('admin.package-bookings.cancel');
