<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Trips table — yeh TourEase ka main innovation hai.
     * Ek trip mein hotel + package + guide sab bundle hota hai.
     */
    public function up(): void
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->id();

            // Kon sa user ne trip plan ki
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // Destination toh mandatory hai — bina destination ke trip kya
            $table->foreignId('destination_id')->constrained()->cascadeOnDelete();

            // Yeh sab optional hain — user chaahe toh ek ya sab le sakta hai
            $table->foreignId('hotel_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('travel_package_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('local_guide_id')->nullable()->constrained()->nullOnDelete();

            // Trip ki basic details
            $table->date('travel_date');
            $table->integer('people')->default(1);
            $table->integer('nights')->default(1); // Hotel ke liye kitni raatein
            $table->decimal('total_price', 10, 2)->default(0);
            $table->string('status')->default('planned'); // planned / cancelled
            $table->text('notes')->nullable(); // User koi special note likh sakta hai

            $table->timestamps();
        });
    }

    /**
     * Trips table hatao agar rollback karna ho.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
