<?php

namespace Database\Seeders;

use App\Models\Destination;
use App\Models\Hotel;
use App\Models\LocalGuide;
use App\Models\Transport;
use App\Models\TravelPackage;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database with simple demo data.
     */
    public function run(): void
    {
        // Admin user create karo — email se login hoga
        User::create([
            'name'     => 'TourEase Admin',
            'email'    => 'admin@tourease.test',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);

        User::create([
            'name' => 'Demo Tourist',
            'email' => 'user@tourease.test',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        // 1. North: Kashmir
        $kashmir = Destination::create([
            'name' => 'Kashmir Valley',
            'location' => 'Jammu & Kashmir, India',
            'image' => 'https://images.unsplash.com/photo-1595815771614-ade9d652a65d?auto=format&fit=crop&w=900&q=80',
            'description' => 'Known as Paradise on Earth. Experience the serene Dal Lake, snow-capped peaks of Gulmarg, and lush green valleys.',
            'rating' => 4.9,
        ]);

        // 2. South: Kerala
        $kerala = Destination::create([
            'name' => 'Kerala Backwaters',
            'location' => 'Alleppey, Kerala',
            'image' => 'https://images.unsplash.com/photo-1602216056096-3b40cc0c9944?auto=format&fit=crop&w=900&q=80',
            'description' => 'God\'s Own Country. Cruise through tranquil backwaters in traditional houseboats surrounded by lush palm trees and spice plantations.',
            'rating' => 4.8,
        ]);

        // 3. East: Meghalaya
        $meghalaya = Destination::create([
            'name' => 'Meghalaya Living Bridges',
            'location' => 'Shillong, Meghalaya',
            'image' => 'https://images.unsplash.com/photo-1629215099394-82a9dbb2c914?auto=format&fit=crop&w=900&q=80',
            'description' => 'The Scotland of the East. Famous for its living root bridges, crystal clear rivers, and the highest rainfall in the world.',
            'rating' => 4.7,
        ]);

        // 4. West: Udaipur
        $udaipur = Destination::create([
            'name' => 'Udaipur Royal Heritage',
            'location' => 'Rajasthan, India',
            'image' => 'https://images.unsplash.com/photo-1615836245337-f839d72422eb?auto=format&fit=crop&w=900&q=80',
            'description' => 'The City of Lakes. A majestic experience of Rajputana palaces, tranquil lakes, and vibrant local markets.',
            'rating' => 4.8,
        ]);

        // 5. Central/Coast: Goa
        $goa = Destination::create([
            'name' => 'Goa Beach Escape',
            'location' => 'Goa, India',
            'image' => 'https://images.unsplash.com/photo-1512343879784-a960bf40e7f2?auto=format&fit=crop&w=900&q=80',
            'description' => 'A relaxing beach destination with thrilling water sports, ancient churches, historic forts, and vibrant night markets.',
            'rating' => 4.6,
        ]);

        // Hotels
        Hotel::create(['destination_id' => $kashmir->id, 'name' => 'Dal View Houseboat', 'location' => 'Srinagar', 'image' => 'https://images.unsplash.com/photo-1595815771614-ade9d652a65d?auto=format&fit=crop&w=900&q=80', 'description' => 'A luxury floating stay on Dal Lake with warm hospitality and Kashmiri cuisine.', 'price_per_night' => 5500, 'available_rooms' => 5, 'rating' => 4.8]);
        Hotel::create(['destination_id' => $kerala->id, 'name' => 'Backwater Retreat', 'location' => 'Alleppey', 'image' => 'https://images.unsplash.com/photo-1602216056096-3b40cc0c9944?auto=format&fit=crop&w=900&q=80', 'description' => 'A serene eco-resort right on the backwaters offering Ayurvedic spas.', 'price_per_night' => 6200, 'available_rooms' => 10, 'rating' => 4.9]);
        Hotel::create(['destination_id' => $meghalaya->id, 'name' => 'Cloud Nine Resort', 'location' => 'Cherrapunji', 'image' => 'https://images.unsplash.com/photo-1629215099394-82a9dbb2c914?auto=format&fit=crop&w=900&q=80', 'description' => 'Stay among the clouds with breathtaking views of the plunging waterfalls.', 'price_per_night' => 4000, 'available_rooms' => 8, 'rating' => 4.5]);
        Hotel::create(['destination_id' => $udaipur->id, 'name' => 'Lake Palace Heritage', 'location' => 'Lake Pichola', 'image' => 'https://images.unsplash.com/photo-1615836245337-f839d72422eb?auto=format&fit=crop&w=900&q=80', 'description' => 'Experience royalty in this beautifully restored heritage haveli.', 'price_per_night' => 8500, 'available_rooms' => 15, 'rating' => 4.9]);
        Hotel::create(['destination_id' => $goa->id, 'name' => 'Sea Breeze Resort', 'location' => 'Baga Beach', 'image' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=900&q=80', 'description' => 'A beach-side hotel with clean rooms, pool, and quick access to the beach.', 'price_per_night' => 4200, 'available_rooms' => 12, 'rating' => 4.5]);

        // Packages
        TravelPackage::create(['destination_id' => $kashmir->id, 'title' => 'Gulmarg Ski & Stay', 'description' => 'Includes ski passes, local transit, and houseboat stay.', 'price' => 12000, 'duration_days' => 4, 'image' => $kashmir->image]);
        TravelPackage::create(['destination_id' => $kerala->id, 'title' => 'Spice Plantation Tour', 'description' => 'Includes houseboat cruise, spice tour, and traditional meals.', 'price' => 9500, 'duration_days' => 3, 'image' => $kerala->image]);
        TravelPackage::create(['destination_id' => $meghalaya->id, 'title' => 'Root Bridge Trekking', 'description' => 'Guided trek to double-decker living root bridges with camping.', 'price' => 7000, 'duration_days' => 3, 'image' => $meghalaya->image]);
        TravelPackage::create(['destination_id' => $udaipur->id, 'title' => 'Royal Rajasthan Tour', 'description' => 'City palace tour, boat ride on Pichola, and dinner at a fort.', 'price' => 11000, 'duration_days' => 2, 'image' => $udaipur->image]);
        TravelPackage::create(['destination_id' => $goa->id, 'title' => '3 Day Goa Fun Package', 'description' => 'Includes beach visits, water sports assistance, and sightseeing.', 'price' => 8500, 'duration_days' => 3, 'image' => $goa->image]);

        // Guides
        LocalGuide::create(['destination_id' => $kashmir->id, 'name' => 'Tariq Ahmed', 'phone' => '9876500001', 'email' => 'tariq@tourease.test', 'languages' => 'English, Hindi, Kashmiri', 'fee_per_day' => 2000, 'rating' => 4.9]);
        LocalGuide::create(['destination_id' => $kerala->id, 'name' => 'Lakshmi Nair', 'phone' => '9876500002', 'email' => 'lakshmi@tourease.test', 'languages' => 'English, Malayalam', 'fee_per_day' => 1800, 'rating' => 4.8]);
        LocalGuide::create(['destination_id' => $meghalaya->id, 'name' => 'John Khasi', 'phone' => '9876500003', 'email' => 'john@tourease.test', 'languages' => 'English, Khasi', 'fee_per_day' => 1500, 'rating' => 4.7]);
        LocalGuide::create(['destination_id' => $udaipur->id, 'name' => 'Vikram Singh', 'phone' => '9876500004', 'email' => 'vikram@tourease.test', 'languages' => 'English, Hindi, Rajasthani', 'fee_per_day' => 2200, 'rating' => 4.9]);
        LocalGuide::create(['destination_id' => $goa->id, 'name' => 'Aarav Naik', 'phone' => '9876500005', 'email' => 'aarav@tourease.test', 'languages' => 'English, Hindi, Konkani', 'fee_per_day' => 1800, 'rating' => 4.6]);

        Transport::insert([
            ['type' => 'Flight', 'route' => 'Delhi to Srinagar', 'provider' => 'SkyGo', 'departure_time' => '07:30', 'available_seats' => 45, 'price' => 4500, 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'Train', 'route' => 'Mumbai to Kerala', 'provider' => 'Indian Railways', 'departure_time' => '18:00', 'available_seats' => 120, 'price' => 2200, 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'Cab', 'route' => 'Guwahati to Shillong', 'provider' => 'Hill Cab Service', 'departure_time' => '09:00', 'available_seats' => 4, 'price' => 3000, 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'Bus', 'route' => 'Delhi to Udaipur', 'provider' => 'Rajasthan Travels', 'departure_time' => '20:30', 'available_seats' => 22, 'price' => 1200, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
