<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\LocalGuideController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TransportController;
use App\Http\Controllers\TravelPackageController;
use App\Http\Controllers\TripController;
use Illuminate\Support\Facades\Route;

// Public routes (koi bhi access kar sakta hai)
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

Route::get('/destinations', [DestinationController::class, 'index'])->name('destinations.index');
Route::get('/destinations/{destination}', [DestinationController::class, 'show'])->name('destinations.show');

Route::get('/hotels', [HotelController::class, 'index'])->name('hotels.index');
Route::get('/hotels/{hotel}', [HotelController::class, 'show'])->name('hotels.show');

Route::get('/packages', [TravelPackageController::class, 'index'])->name('packages.index');
Route::get('/packages/{package}', [TravelPackageController::class, 'show'])->name('packages.show');

Route::get('/guides', [LocalGuideController::class, 'index'])->name('guides.index');
Route::get('/transports', [TransportController::class, 'index'])->name('transports.index');


// Logged-in users ke liye (Authentication required)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Booking & History
    Route::post('/hotels/{hotel}/book', [HotelController::class, 'book'])->name('hotels.book');
    Route::post('/packages/{package}/book', [TravelPackageController::class, 'book'])->name('packages.book');
    Route::get('/booking-history', [HotelController::class, 'history'])->name('bookings.history');

    // Reviews
    Route::post('/destinations/{destination}/reviews', [ReviewController::class, 'storeDestination'])->name('destinations.reviews.store');
    Route::post('/hotels/{hotel}/reviews', [ReviewController::class, 'storeHotel'])->name('hotels.reviews.store');

    // Smart Trip Planner (Innovation feature)
    Route::get('/plan-trip', [TripController::class, 'create'])->name('trips.create');
    Route::post('/plan-trip', [TripController::class, 'store'])->name('trips.store');
    Route::get('/my-trips', [TripController::class, 'index'])->name('trips.index');
    Route::delete('/trips/{trip}', [TripController::class, 'destroy'])->name('trips.destroy');
});


// Sirf Admins ke liye
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::delete('/admin/users/{user}', [AdminController::class, 'deleteUser'])->name('admin.users.destroy');
    Route::patch('/admin/hotel-bookings/{booking}/cancel', [AdminController::class, 'cancelHotelBooking'])->name('admin.hotel-bookings.cancel');
    Route::patch('/admin/package-bookings/{booking}/cancel', [AdminController::class, 'cancelPackageBooking'])->name('admin.package-bookings.cancel');

    // CRUD Management
    Route::resource('destinations', DestinationController::class)->except(['index', 'show']);
    Route::resource('hotels', HotelController::class)->except(['index', 'show']);
    Route::resource('packages', TravelPackageController::class)->parameters(['packages' => 'package'])->except(['index', 'show']);
    Route::resource('guides', LocalGuideController::class)->except(['index', 'show']);
    Route::resource('transports', TransportController::class)->except(['index', 'show']);
});
