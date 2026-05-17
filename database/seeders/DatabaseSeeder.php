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
        User::create([
            'name' => 'TourEase Admin',
            'email' => 'admin@tourease.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Demo Tourist',
            'email' => 'user@tourease.test',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        $goa = Destination::create([
            'name' => 'Goa Beach Escape',
            'location' => 'Goa, India',
            'image' => 'https://images.unsplash.com/photo-1512343879784-a960bf40e7f2?auto=format&fit=crop&w=900&q=80',
            'description' => 'A relaxing beach destination with water sports, seafood, churches, forts, and night markets.',
            'rating' => 4.7,
        ]);

        $jaipur = Destination::create([
            'name' => 'Jaipur Heritage Tour',
            'location' => 'Rajasthan, India',
            'image' => 'https://images.unsplash.com/photo-1477587458883-47145ed94245?auto=format&fit=crop&w=900&q=80',
            'description' => 'A royal city experience with forts, palaces, traditional food, shopping streets, and cultural events.',
            'rating' => 4.6,
        ]);

        $manali = Destination::create([
            'name' => 'Manali Mountain Holiday',
            'location' => 'Himachal Pradesh, India',
            'image' => 'https://images.unsplash.com/photo-1626621341517-bbf3d9990a23?auto=format&fit=crop&w=900&q=80',
            'description' => 'A scenic hill destination for snow views, adventure activities, cafes, temples, and peaceful stays.',
            'rating' => 4.8,
        ]);

        Hotel::create(['destination_id' => $goa->id, 'name' => 'Sea Breeze Resort', 'location' => 'Baga, Goa', 'image' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=900&q=80', 'description' => 'A beach-side hotel with clean rooms, pool, restaurant, and quick access to Baga beach.', 'price_per_night' => 4200, 'available_rooms' => 12, 'rating' => 4.5]);
        Hotel::create(['destination_id' => $jaipur->id, 'name' => 'Pink City Heritage Inn', 'location' => 'Jaipur, Rajasthan', 'image' => 'https://images.unsplash.com/photo-1582719508461-905c673771fd?auto=format&fit=crop&w=900&q=80', 'description' => 'A comfortable heritage-style hotel near major tourist attractions and local markets.', 'price_per_night' => 3500, 'available_rooms' => 8, 'rating' => 4.3]);
        Hotel::create(['destination_id' => $manali->id, 'name' => 'Snow Peak Stay', 'location' => 'Manali, Himachal Pradesh', 'image' => 'https://images.unsplash.com/photo-1571896349842-33c89424de2d?auto=format&fit=crop&w=900&q=80', 'description' => 'A mountain-view stay with warm rooms, local food, and travel desk support for sightseeing.', 'price_per_night' => 2800, 'available_rooms' => 10, 'rating' => 4.4]);

        TravelPackage::create(['destination_id' => $goa->id, 'title' => '3 Day Goa Fun Package', 'description' => 'Includes beach visits, hotel stay support, water sports assistance, and local sightseeing.', 'price' => 8500, 'duration_days' => 3, 'image' => $goa->image]);
        TravelPackage::create(['destination_id' => $jaipur->id, 'title' => 'Jaipur Culture Package', 'description' => 'Includes fort visits, city palace tour, local guide support, shopping time, and food walk.', 'price' => 7200, 'duration_days' => 2, 'image' => $jaipur->image]);
        TravelPackage::create(['destination_id' => $manali->id, 'title' => 'Manali Adventure Package', 'description' => 'Includes Solang Valley visit, snow activity help, local transfers, and sightseeing plan.', 'price' => 9500, 'duration_days' => 4, 'image' => $manali->image]);

        LocalGuide::create(['destination_id' => $goa->id, 'name' => 'Aarav Naik', 'phone' => '9876543210', 'email' => 'aarav.guide@tourease.test', 'languages' => 'English, Hindi, Konkani', 'fee_per_day' => 1800, 'rating' => 4.6]);
        LocalGuide::create(['destination_id' => $jaipur->id, 'name' => 'Meera Sharma', 'phone' => '9876501234', 'email' => 'meera.guide@tourease.test', 'languages' => 'English, Hindi, Rajasthani', 'fee_per_day' => 1600, 'rating' => 4.8]);
        LocalGuide::create(['destination_id' => $manali->id, 'name' => 'Karan Thakur', 'phone' => '9876512345', 'email' => 'karan.guide@tourease.test', 'languages' => 'English, Hindi', 'fee_per_day' => 1500, 'rating' => 4.5]);

        Transport::insert([
            ['type' => 'Bus', 'route' => 'Delhi to Jaipur', 'provider' => 'Rajasthan Travels', 'departure_time' => '08:30', 'available_seats' => 22, 'price' => 650, 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'Flight', 'route' => 'Mumbai to Goa', 'provider' => 'SkyGo', 'departure_time' => '10:15', 'available_seats' => 45, 'price' => 3200, 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'Cab', 'route' => 'Chandigarh to Manali', 'provider' => 'Hill Cab Service', 'departure_time' => '06:00', 'available_seats' => 4, 'price' => 5500, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
