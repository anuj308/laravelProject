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
            'name'     => 'OmniTrek Admin',
            'email'    => 'admin@omnitrek.test',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);

        User::create([
            'name' => 'Demo Tourist',
            'email' => 'user@omnitrek.test',
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
            'image' => 'https://images.unsplash.com/photo-1542224566-6e85f2e6772f?auto=format&fit=crop&w=900&q=80',
            'description' => 'The Scotland of the East. Famous for its living root bridges, crystal clear rivers, and the highest rainfall in the world.',
            'rating' => 4.7,
        ]);

        // 4. West: Udaipur
        $udaipur = Destination::create([
            'name' => 'Udaipur Royal Heritage',
            'location' => 'Rajasthan, India',
            'image' => 'https://images.unsplash.com/photo-1524492412937-b28074d5871c?auto=format&fit=crop&w=900&q=80',
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

        // 6. Spiritual: Bodh Gaya
        $gaya = Destination::create([
            'name' => 'Bodh Gaya Spiritual Journey',
            'location' => 'Gaya, Bihar',
            'image' => 'https://images.unsplash.com/photo-1544256666-880949d21af8?auto=format&fit=crop&w=900&q=80',
            'description' => 'Experience profound peace at the Mahabodhi Temple and walk the sacred path where Buddha attained enlightenment.',
            'rating' => 4.8,
        ]);

        // 7. Mountains: Shimla
        $shimla = Destination::create([
            'name' => 'Shimla Winter Wonderland',
            'location' => 'Himachal Pradesh, India',
            'image' => 'https://images.unsplash.com/photo-1518002171953-a080ee817e1f?auto=format&fit=crop&w=900&q=80',
            'description' => 'The Queen of Hills. Enjoy the colonial architecture, the bustling Mall Road, and stunning snow-covered Himalayan peaks.',
            'rating' => 4.7,
        ]);

        // Authentic Hotels
        Hotel::create(['destination_id' => $kashmir->id, 'name' => 'The Lalit Grand Palace', 'location' => 'Gupkar Road, Srinagar', 'image' => 'https://images.unsplash.com/photo-1571896349842-33c89424de2d?auto=format&fit=crop&w=900&q=80', 'description' => 'A heritage property offering panoramic views of Dal Lake and Zabarwan mountain range. Formerly the palace of the Maharajas.', 'price_per_night' => 18500, 'available_rooms' => 12, 'rating' => 4.8]);
        
        Hotel::create(['destination_id' => $kerala->id, 'name' => 'Kumarakom Lake Resort', 'location' => 'Vembanad Lake, Kerala', 'image' => 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?auto=format&fit=crop&w=900&q=80', 'description' => 'A luxury heritage resort offering traditional Kerala-style villas, infinity pools, and Ayurvedic spa treatments on the backwaters.', 'price_per_night' => 22000, 'available_rooms' => 8, 'rating' => 4.9]);
        
        Hotel::create(['destination_id' => $meghalaya->id, 'name' => 'Polo Orchid Resort', 'location' => 'Cherrapunjee', 'image' => 'https://images.unsplash.com/photo-1551882547-ff40c66fe566?auto=format&fit=crop&w=900&q=80', 'description' => 'Situated on a cliff edge overlooking the Nohsngithiang Falls, offering mist-covered valley views and rustic luxury log cabins.', 'price_per_night' => 12500, 'available_rooms' => 15, 'rating' => 4.6]);
        
        Hotel::create(['destination_id' => $udaipur->id, 'name' => 'Taj Lake Palace', 'location' => 'Lake Pichola, Udaipur', 'image' => 'https://images.unsplash.com/photo-1582719508461-905c673771fd?auto=format&fit=crop&w=900&q=80', 'description' => 'A breathtaking white marble palace floating in the middle of Lake Pichola. Iconic, historic, and undeniably romantic.', 'price_per_night' => 45000, 'available_rooms' => 4, 'rating' => 5.0]);
        
        Hotel::create(['destination_id' => $goa->id, 'name' => 'Taj Exotica Resort & Spa', 'location' => 'Benaulim, South Goa', 'image' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=900&q=80', 'description' => 'A Mediterranean-style luxury resort spread across 56 acres of lush gardens along a private pristine beach.', 'price_per_night' => 24000, 'available_rooms' => 10, 'rating' => 4.8]);
        
        Hotel::create(['destination_id' => $gaya->id, 'name' => 'Royal Residency Bodhgaya', 'location' => 'Bodh Gaya', 'image' => 'https://images.unsplash.com/photo-1542314831-c53cd6b42479?auto=format&fit=crop&w=900&q=80', 'description' => 'A serene and elegant hotel blending modern amenities with traditional Buddhist architectural influences, near the Mahabodhi Temple.', 'price_per_night' => 8500, 'available_rooms' => 20, 'rating' => 4.5]);
        
        Hotel::create(['destination_id' => $shimla->id, 'name' => 'The Oberoi Cecil', 'location' => 'Chaura Maidan, Shimla', 'image' => 'https://images.unsplash.com/photo-1512918728675-ed5a9ec8fa62?auto=format&fit=crop&w=900&q=80', 'description' => 'A historic grand heritage hotel from the British era featuring rich woodwork, classic fireplaces, and valley views.', 'price_per_night' => 28000, 'available_rooms' => 6, 'rating' => 4.9]);

        // Packages
        TravelPackage::create(['destination_id' => $kashmir->id, 'title' => 'Gulmarg Ski & Stay', 'description' => 'Includes ski passes, local transit, and houseboat stay.', 'price' => 12000, 'duration_days' => 4, 'image' => $kashmir->image]);
        TravelPackage::create(['destination_id' => $kerala->id, 'title' => 'Spice Plantation Tour', 'description' => 'Includes houseboat cruise, spice tour, and traditional meals.', 'price' => 9500, 'duration_days' => 3, 'image' => $kerala->image]);
        TravelPackage::create(['destination_id' => $meghalaya->id, 'title' => 'Root Bridge Trekking', 'description' => 'Guided trek to double-decker living root bridges with camping.', 'price' => 7000, 'duration_days' => 3, 'image' => $meghalaya->image]);
        TravelPackage::create(['destination_id' => $udaipur->id, 'title' => 'Royal Rajasthan Tour', 'description' => 'City palace tour, boat ride on Pichola, and dinner at a fort.', 'price' => 11000, 'duration_days' => 2, 'image' => $udaipur->image]);
        TravelPackage::create(['destination_id' => $goa->id, 'title' => '3 Day Goa Fun Package', 'description' => 'Includes beach visits, water sports assistance, and sightseeing.', 'price' => 8500, 'duration_days' => 3, 'image' => $goa->image]);
        TravelPackage::create(['destination_id' => $gaya->id, 'title' => 'Buddhism Circuit Tour', 'description' => 'Guided tour of the Mahabodhi Temple complex and ancient monasteries.', 'price' => 4500, 'duration_days' => 2, 'image' => $gaya->image]);
        TravelPackage::create(['destination_id' => $shimla->id, 'title' => 'Shimla Snow Escape', 'description' => 'Includes a ride on the Toy Train, Mall Road walk, and Kufri snow play.', 'price' => 7800, 'duration_days' => 3, 'image' => $shimla->image]);

        // Guides
        LocalGuide::create(['destination_id' => $kashmir->id, 'name' => 'Tariq Ahmed', 'phone' => '9876500001', 'email' => 'tariq@omnitrek.test', 'languages' => 'English, Hindi, Kashmiri', 'fee_per_day' => 2000, 'rating' => 4.9]);
        LocalGuide::create(['destination_id' => $kerala->id, 'name' => 'Lakshmi Nair', 'phone' => '9876500002', 'email' => 'lakshmi@omnitrek.test', 'languages' => 'English, Malayalam', 'fee_per_day' => 1800, 'rating' => 4.8]);
        LocalGuide::create(['destination_id' => $meghalaya->id, 'name' => 'John Khasi', 'phone' => '9876500003', 'email' => 'john@omnitrek.test', 'languages' => 'English, Khasi', 'fee_per_day' => 1500, 'rating' => 4.7]);
        LocalGuide::create(['destination_id' => $udaipur->id, 'name' => 'Vikram Singh', 'phone' => '9876500004', 'email' => 'vikram@omnitrek.test', 'languages' => 'English, Hindi, Rajasthani', 'fee_per_day' => 2200, 'rating' => 4.9]);
        LocalGuide::create(['destination_id' => $goa->id, 'name' => 'Aarav Naik', 'phone' => '9876500005', 'email' => 'aarav@omnitrek.test', 'languages' => 'English, Hindi, Konkani', 'fee_per_day' => 1800, 'rating' => 4.6]);
        LocalGuide::create(['destination_id' => $gaya->id, 'name' => 'Rahul Verma', 'phone' => '9876500006', 'email' => 'rahul@omnitrek.test', 'languages' => 'English, Hindi, Magahi', 'fee_per_day' => 1200, 'rating' => 4.8]);
        LocalGuide::create(['destination_id' => $shimla->id, 'name' => 'Priya Thakur', 'phone' => '9876500007', 'email' => 'priya@omnitrek.test', 'languages' => 'English, Hindi, Pahari', 'fee_per_day' => 1500, 'rating' => 4.7]);

        Transport::insert([
            ['type' => 'Flight', 'route' => 'New Delhi (DEL) to Srinagar (SXR)', 'provider' => 'IndiGo', 'departure_time' => '06:30 AM', 'available_seats' => 45, 'price' => 5200, 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'Flight', 'route' => 'Mumbai (BOM) to Goa (GOI)', 'provider' => 'Air India', 'departure_time' => '11:15 AM', 'available_seats' => 28, 'price' => 3800, 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'Flight', 'route' => 'Kolkata (CCU) to Shillong (SHL)', 'provider' => 'SpiceJet', 'departure_time' => '09:00 AM', 'available_seats' => 12, 'price' => 4500, 'created_at' => now(), 'updated_at' => now()],
            
            ['type' => 'Train', 'route' => 'New Delhi to Gaya (Mahabodhi Exp)', 'provider' => 'Indian Railways', 'departure_time' => '02:10 PM', 'available_seats' => 120, 'price' => 1850, 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'Train', 'route' => 'Mumbai to Goa (Tejas Express)', 'provider' => 'Indian Railways', 'departure_time' => '05:50 AM', 'available_seats' => 65, 'price' => 2450, 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'Train', 'route' => 'Kalka to Shimla (Toy Train)', 'provider' => 'Himalayan Queen', 'departure_time' => '12:10 PM', 'available_seats' => 30, 'price' => 800, 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'Train', 'route' => 'Delhi to Udaipur (Mewar Exp)', 'provider' => 'Indian Railways', 'departure_time' => '07:00 PM', 'available_seats' => 85, 'price' => 1650, 'created_at' => now(), 'updated_at' => now()],

            ['type' => 'Bus', 'route' => 'Delhi to Shimla (Volvo A/C Sleeper)', 'provider' => 'Zingbus', 'departure_time' => '10:30 PM', 'available_seats' => 22, 'price' => 1100, 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'Bus', 'route' => 'Ahmedabad to Udaipur', 'provider' => 'IntrCity SmartBus', 'departure_time' => '11:00 PM', 'available_seats' => 18, 'price' => 850, 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'Bus', 'route' => 'Bangalore to Kochi (Alleppey)', 'provider' => 'Kallada Travels', 'departure_time' => '09:45 PM', 'available_seats' => 15, 'price' => 1400, 'created_at' => now(), 'updated_at' => now()],

            ['type' => 'Cab', 'route' => 'Guwahati Airport to Shillong', 'provider' => 'Savaari Car Rentals', 'departure_time' => 'Flexible', 'available_seats' => 4, 'price' => 2800, 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'Cab', 'route' => 'Srinagar Airport to Dal Lake', 'provider' => 'MakeMyTrip Cabs', 'departure_time' => 'Flexible', 'available_seats' => 4, 'price' => 850, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
