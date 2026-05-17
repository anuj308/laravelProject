<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Create all main TourEase tables.
     */
    public function up(): void
    {
        Schema::create('destinations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('location');
            $table->string('image')->nullable();
            $table->text('description');
            $table->decimal('rating', 2, 1)->default(0);
            $table->timestamps();
        });

        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('destination_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name');
            $table->string('location');
            $table->string('image')->nullable();
            $table->text('description');
            $table->decimal('price_per_night', 10, 2);
            $table->integer('available_rooms')->default(0);
            $table->decimal('rating', 2, 1)->default(0);
            $table->timestamps();
        });

        Schema::create('hotel_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('hotel_id')->constrained()->cascadeOnDelete();
            $table->date('check_in');
            $table->date('check_out');
            $table->integer('rooms')->default(1);
            $table->decimal('total_price', 10, 2);
            $table->string('status')->default('confirmed');
            $table->timestamps();
        });

        Schema::create('travel_packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('destination_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title');
            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->integer('duration_days');
            $table->string('image')->nullable();
            $table->timestamps();
        });

        Schema::create('package_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('travel_package_id')->constrained()->cascadeOnDelete();
            $table->date('travel_date');
            $table->integer('people')->default(1);
            $table->decimal('total_price', 10, 2);
            $table->string('status')->default('confirmed');
            $table->timestamps();
        });

        Schema::create('local_guides', function (Blueprint $table) {
            $table->id();
            $table->foreignId('destination_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->string('languages');
            $table->decimal('fee_per_day', 10, 2);
            $table->decimal('rating', 2, 1)->default(0);
            $table->timestamps();
        });

        Schema::create('transports', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('route');
            $table->string('provider');
            $table->time('departure_time');
            $table->integer('available_seats');
            $table->decimal('price', 10, 2);
            $table->timestamps();
        });

        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('destination_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('hotel_id')->nullable()->constrained()->cascadeOnDelete();
            $table->integer('rating');
            $table->text('comment');
            $table->timestamps();
        });
    }

    /**
     * Drop TourEase tables in reverse order because of foreign keys.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
        Schema::dropIfExists('transports');
        Schema::dropIfExists('local_guides');
        Schema::dropIfExists('package_bookings');
        Schema::dropIfExists('travel_packages');
        Schema::dropIfExists('hotel_bookings');
        Schema::dropIfExists('hotels');
        Schema::dropIfExists('destinations');
    }
};
