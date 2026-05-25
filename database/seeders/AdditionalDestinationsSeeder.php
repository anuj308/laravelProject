<?php

namespace Database\Seeders;

use App\Models\Destination;
use App\Models\Hotel;
use App\Models\LocalGuide;
use App\Models\Transport;
use App\Models\TravelPackage;
use App\Models\Restaurant;
use App\Models\Attraction;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AdditionalDestinationsSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Destination::query()->delete();
        Restaurant::query()->delete();
        Attraction::query()->delete();
        Transport::query()->delete();
        Hotel::query()->delete();
        TravelPackage::query()->delete();
        LocalGuide::query()->delete();
        Schema::enableForeignKeyConstraints();

        $user = User::where('role', 'user')->first();

        $destData = [
            [
                'name' => 'Madurai Heritage',
                'location' => 'Tamil Nadu, India',
                'image' => 'https://images.unsplash.com/photo-1544085311-11a028465b03?auto=format&fit=crop&w=1200&q=80',
                'description' => 'The Athens of the East, centered around the magnificent Meenakshi Temple.',
                'rating' => 4.8,
                'attractions' => [
                    ['name' => 'Meenakshi Temple', 'image' => 'https://images.unsplash.com/photo-1544085311-11a028465b03?auto=format&fit=crop&w=800&q=80'],
                    ['name' => 'Nayakkar Mahal', 'image' => 'https://images.unsplash.com/photo-1610123598195-eea6b6be4c08?auto=format&fit=crop&w=800&q=80']
                ],
                'hotels' => [
                    ['name' => 'Heritage Madurai', 'image' => 'https://images.unsplash.com/photo-1542314831-c53cd6b42479?auto=format&fit=crop&w=800&q=80', 'price' => 14000],
                    ['name' => 'Taj Gateway', 'image' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=800&q=80', 'price' => 8500]
                ]
            ],
            [
                'name' => 'Manali Adventure',
                'location' => 'Himachal Pradesh, India',
                'image' => 'https://images.unsplash.com/photo-1626621341517-bbf3d9990a23?auto=format&fit=crop&w=1200&q=80',
                'description' => 'A gateway for skiing in the Solang Valley and trekking in Beas River valley.',
                'rating' => 4.9,
                'attractions' => [
                    ['name' => 'Rohtang Pass', 'image' => 'https://images.unsplash.com/photo-1596484552834-6a58f850e0a1?auto=format&fit=crop&w=800&q=80'],
                    ['name' => 'Solang Valley', 'image' => 'https://images.unsplash.com/photo-1626621341517-bbf3d9990a23?auto=format&fit=crop&w=800&q=80']
                ],
                'hotels' => [
                    ['name' => 'Span Resort & Spa', 'image' => 'https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?auto=format&fit=crop&w=800&q=80', 'price' => 18000],
                    ['name' => 'Manu Allaya', 'image' => 'https://images.unsplash.com/photo-1584132967334-10e028bd69f7?auto=format&fit=crop&w=800&q=80', 'price' => 12000]
                ]
            ],
            [
                'name' => 'Mussoorie Queen',
                'location' => 'Uttarakhand, India',
                'image' => 'https://images.unsplash.com/photo-1617191519105-d07b98b10de6?auto=format&fit=crop&w=1200&q=80',
                'description' => 'A colonial-era hill station with stunning views of the Shivalik range.',
                'rating' => 4.7,
                'attractions' => [
                    ['name' => 'Kempty Falls', 'image' => 'https://images.unsplash.com/photo-1590716209211-ea74d5f63573?auto=format&fit=crop&w=800&q=80'],
                    ['name' => 'Lal Tibba', 'image' => 'https://images.unsplash.com/photo-1622643048696-893e1597170e?auto=format&fit=crop&w=800&q=80']
                ],
                'hotels' => [
                    ['name' => 'JW Marriott Walnut Grove', 'image' => 'https://images.unsplash.com/photo-1542314831-c53cd6b42479?auto=format&fit=crop&w=800&q=80', 'price' => 25000],
                    ['name' => 'The Savoy', 'image' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=800&q=80', 'price' => 15000]
                ]
            ],
            [
                'name' => 'Shillong Clouds',
                'location' => 'Meghalaya, India',
                'image' => 'https://images.unsplash.com/photo-1629813355030-cf2f4b5030e4?auto=format&fit=crop&w=1200&q=80',
                'description' => 'Known as the Scotland of the East for its rolling hills and waterfalls.',
                'rating' => 4.8,
                'attractions' => [
                    ['name' => 'Living Root Bridge', 'image' => 'https://images.unsplash.com/photo-1555543015-88849b29dbf7?auto=format&fit=crop&w=800&q=80'],
                    ['name' => 'Elephant Falls', 'image' => 'https://images.unsplash.com/photo-1610660600373-de3f1395c907?auto=format&fit=crop&w=800&q=80']
                ],
                'hotels' => [
                    ['name' => 'Ri Kynjai Resort', 'image' => 'https://images.unsplash.com/photo-1582719478250-c29acc992f13?auto=format&fit=crop&w=800&q=80', 'price' => 22000],
                    ['name' => 'The Heritage Club', 'image' => 'https://images.unsplash.com/photo-1445019980597-93fa8acb246c?auto=format&fit=crop&w=800&q=80', 'price' => 9000]
                ]
            ],
            [
                'name' => 'Agra Heritage',
                'location' => 'Uttar Pradesh, India',
                'image' => 'https://images.unsplash.com/photo-1564507592333-c60657ece523?auto=format&fit=crop&w=1200&q=80',
                'description' => 'City of the Taj Mahal, showcasing the pinnacle of Mughal architecture.',
                'rating' => 4.9,
                'attractions' => [
                    ['name' => 'Taj Mahal', 'image' => 'https://images.unsplash.com/photo-1564507592333-c60657ece523?auto=format&fit=crop&w=800&q=80'],
                    ['name' => 'Agra Fort', 'image' => 'https://images.unsplash.com/photo-1622325172288-724e5be49102?auto=format&fit=crop&w=800&q=80']
                ],
                'hotels' => [
                    ['name' => 'The Oberoi Amarvilas', 'image' => 'https://images.unsplash.com/photo-1542314831-c53cd6b42479?auto=format&fit=crop&w=800&q=80', 'price' => 45000],
                    ['name' => 'ITC Mughal', 'image' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=800&q=80', 'price' => 12000]
                ]
            ],
            [
                'name' => 'Alleppey Backwaters',
                'location' => 'Kerala, India',
                'image' => 'https://images.unsplash.com/photo-1593693397690-362cb9666fc2?auto=format&fit=crop&w=1200&q=80',
                'description' => 'A serene world of houseboats and backwater canals.',
                'rating' => 4.9,
                'attractions' => [
                    ['name' => 'Houseboat Canal', 'image' => 'https://images.unsplash.com/photo-1593693397690-362cb9666fc2?auto=format&fit=crop&w=800&q=80'],
                    ['name' => 'Marari Beach', 'image' => 'https://images.unsplash.com/photo-1602216056096-3b40cc0c9944?auto=format&fit=crop&w=800&q=80']
                ],
                'hotels' => [
                    ['name' => 'Kumarakom Lake Resort', 'image' => 'https://images.unsplash.com/photo-1582719478250-c29acc992f13?auto=format&fit=crop&w=800&q=80', 'price' => 32000],
                    ['name' => 'Lemon Tree Vembanad', 'image' => 'https://images.unsplash.com/photo-1445019980597-93fa8acb246c?auto=format&fit=crop&w=800&q=80', 'price' => 9500]
                ]
            ],
            [
                'name' => 'Jaipur Pink City',
                'location' => 'Rajasthan, India',
                'image' => 'https://images.unsplash.com/photo-1524230507669-5ff9da391b10?auto=format&fit=crop&w=1200&q=80',
                'description' => 'The capital of Rajasthan, famous for its historic pink-colored buildings.',
                'rating' => 4.8,
                'attractions' => [
                    ['name' => 'Hawa Mahal', 'image' => 'https://images.unsplash.com/photo-1599661046289-e31897846e41?auto=format&fit=crop&w=800&q=80'],
                    ['name' => 'Amer Fort', 'image' => 'https://images.unsplash.com/photo-1524230507669-5ff9da391b10?auto=format&fit=crop&w=800&q=80']
                ],
                'hotels' => [
                    ['name' => 'Rambagh Palace', 'image' => 'https://images.unsplash.com/photo-1542314831-c53cd6b42479?auto=format&fit=crop&w=800&q=80', 'price' => 55000],
                    ['name' => 'The Raj Palace', 'image' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=800&q=80', 'price' => 28000]
                ]
            ],
            [
                'name' => 'Goa Beaches',
                'location' => 'Goa, India',
                'image' => 'https://images.unsplash.com/photo-1512343879784-a960bf40e7f2?auto=format&fit=crop&w=1200&q=80',
                'description' => 'Sun, sand, and surf across the best beaches of India.',
                'rating' => 4.7,
                'attractions' => [
                    ['name' => 'Palolem Beach', 'image' => 'https://images.unsplash.com/photo-1512343879784-a960bf40e7f2?auto=format&fit=crop&w=800&q=80'],
                    ['name' => 'Baga Beach', 'image' => 'https://images.unsplash.com/photo-1624328328400-3482701ded47?auto=format&fit=crop&w=800&q=80']
                ],
                'hotels' => [
                    ['name' => 'W Goa', 'image' => 'https://images.unsplash.com/photo-1582719478250-c29acc992f13?auto=format&fit=crop&w=800&q=80', 'price' => 25000],
                    ['name' => 'Taj Exotica', 'image' => 'https://images.unsplash.com/photo-1445019980597-93fa8acb246c?auto=format&fit=crop&w=800&q=80', 'price' => 30000]
                ]
            ],
            [
                'name' => 'Leh Ladakh',
                'location' => 'Ladakh, India',
                'image' => 'https://images.unsplash.com/photo-1581793746473-042c443f443a?auto=format&fit=crop&w=1200&q=80',
                'description' => 'Remote mountain ranges and crystalline desert lakes.',
                'rating' => 5.0,
                'attractions' => [
                    ['name' => 'Pangong Lake', 'image' => 'https://images.unsplash.com/photo-1581793746473-042c443f443a?auto=format&fit=crop&w=800&q=80'],
                    ['name' => 'Nubra Valley', 'image' => 'https://images.unsplash.com/photo-1596484552834-6a58f850e0a1?auto=format&fit=crop&w=800&q=80']
                ],
                'hotels' => [
                    ['name' => 'The Grand Dragon', 'image' => 'https://images.unsplash.com/photo-1445019980597-93fa8acb246c?auto=format&fit=crop&w=800&q=80', 'price' => 15000],
                    ['name' => 'Ladakh Sarai', 'image' => 'https://images.unsplash.com/photo-1582719478250-c29acc992f13?auto=format&fit=crop&w=800&q=80', 'price' => 12000]
                ]
            ],
            [
                'name' => 'Hampi Ruins',
                'location' => 'Karnataka, India',
                'image' => 'https://images.unsplash.com/photo-1600100397561-4336c6460fae?auto=format&fit=crop&w=1200&q=80',
                'description' => 'Ancient ruins of the Vijayanagara Empire amidst giant boulders.',
                'rating' => 4.9,
                'attractions' => [
                    ['name' => 'Stone Chariot', 'image' => 'https://images.unsplash.com/photo-1626082927389-6cd097cdc6ec?auto=format&fit=crop&w=800&q=80'],
                    ['name' => 'Virupaksha Temple', 'image' => 'https://images.unsplash.com/photo-1600100397561-4336c6460fae?auto=format&fit=crop&w=800&q=80']
                ],
                'hotels' => [
                    ['name' => 'Evolve Back Kamalapura', 'image' => 'https://images.unsplash.com/photo-1542314831-c53cd6b42479?auto=format&fit=crop&w=800&q=80', 'price' => 38000],
                    ['name' => 'Heritage Resort', 'image' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=800&q=80', 'price' => 9500]
                ]
            ],
            [
                'name' => 'Darjeeling Tea',
                'location' => 'West Bengal, India',
                'image' => 'https://images.unsplash.com/photo-1523315623030-cf8d6bc7ecbd?auto=format&fit=crop&w=1200&q=80',
                'description' => 'Mist-covered tea gardens and a view of the towering Kanchenjunga.',
                'rating' => 4.7,
                'attractions' => [
                    ['name' => 'Tiger Hill', 'image' => 'https://images.unsplash.com/photo-1523315623030-cf8d6bc7ecbd?auto=format&fit=crop&w=800&q=80'],
                    ['name' => 'Tea Museum', 'image' => 'https://images.unsplash.com/photo-1414235077428-338989a2e8c0?auto=format&fit=crop&w=800&q=80']
                ],
                'hotels' => [
                    ['name' => 'Windamere Hotel', 'image' => 'https://images.unsplash.com/photo-1445019980597-93fa8acb246c?auto=format&fit=crop&w=800&q=80', 'price' => 16000],
                    ['name' => 'The Elgin', 'image' => 'https://images.unsplash.com/photo-1582719478250-c29acc992f13?auto=format&fit=crop&w=800&q=80', 'price' => 11000]
                ]
            ],
            [
                'name' => 'Lonavala Hills',
                'location' => 'Maharashtra, India',
                'image' => 'https://images.unsplash.com/photo-1574482620811-1aa166d182e0?auto=format&fit=crop&w=1200&q=80',
                'description' => 'A lush getaway near Mumbai, perfect for monsoon treks.',
                'rating' => 4.5,
                'attractions' => [
                    ['name' => 'Tiger\'s Leap', 'image' => 'https://images.unsplash.com/photo-1574482620811-1aa166d182e0?auto=format&fit=crop&w=800&q=80'],
                    ['name' => 'Bhushi Dam', 'image' => 'https://images.unsplash.com/photo-1510629954389-c1e0da47d414?auto=format&fit=crop&w=800&q=80']
                ],
                'hotels' => [
                    ['name' => 'Fariyas Resort', 'image' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=800&q=80', 'price' => 12000],
                    ['name' => 'Della Resorts', 'image' => 'https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?auto=format&fit=crop&w=800&q=80', 'price' => 22000]
                ]
            ],
            [
                'name' => 'Havelock Island',
                'location' => 'Andaman, India',
                'image' => 'https://images.unsplash.com/photo-1536697246787-1f7ad502ba92?auto=format&fit=crop&w=1200&q=80',
                'description' => 'Pristine white sand beaches and incredible coral reef diving.',
                'rating' => 5.0,
                'attractions' => [
                    ['name' => 'Radhanagar Beach', 'image' => 'https://images.unsplash.com/photo-1536697246787-1f7ad502ba92?auto=format&fit=crop&w=800&q=80'],
                    ['name' => 'Kala Pathar Beach', 'image' => 'https://images.unsplash.com/photo-1550439062-609e1530227c?auto=format&fit=crop&w=800&q=80']
                ],
                'hotels' => [
                    ['name' => 'Taj Exotica Resort', 'image' => 'https://images.unsplash.com/photo-1582719478250-c29acc992f13?auto=format&fit=crop&w=800&q=80', 'price' => 40000],
                    ['name' => 'Barefoot at Havelock', 'image' => 'https://images.unsplash.com/photo-1445019980597-93fa8acb246c?auto=format&fit=crop&w=800&q=80', 'price' => 18000]
                ]
            ],
            [
                'name' => 'Rann of Kutch',
                'location' => 'Gujarat, India',
                'image' => 'https://images.unsplash.com/photo-1610123598195-eea6b6be4c08?auto=format&fit=crop&w=1200&q=80',
                'description' => 'The stunning white salt desert of western India.',
                'rating' => 4.8,
                'attractions' => [
                    ['name' => 'White Desert', 'image' => 'https://images.unsplash.com/photo-1610123598195-eea6b6be4c08?auto=format&fit=crop&w=800&q=80'],
                    ['name' => 'Kala Dungar', 'image' => 'https://images.unsplash.com/photo-1564507592333-c60657ece523?auto=format&fit=crop&w=800&q=80']
                ],
                'hotels' => [
                    ['name' => 'Rann Utsav Tent City', 'image' => 'https://images.unsplash.com/photo-1542314831-c53cd6b42479?auto=format&fit=crop&w=800&q=80', 'price' => 15000],
                    ['name' => 'Gateway to Rann', 'image' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=800&q=80', 'price' => 8500]
                ]
            ],
            [
                'name' => 'Pondicherry French',
                'location' => 'Tamil Nadu, India',
                'image' => 'https://images.unsplash.com/photo-1587474260584-136574528ed5?auto=format&fit=crop&w=1200&q=80',
                'description' => 'French colonial charm meets coastal Indian beauty.',
                'rating' => 4.7,
                'attractions' => [
                    ['name' => 'Rock Beach', 'image' => 'https://images.unsplash.com/photo-1587474260584-136574528ed5?auto=format&fit=crop&w=800&q=80'],
                    ['name' => 'Auroville', 'image' => 'https://images.unsplash.com/photo-1574482620811-1aa166d182e0?auto=format&fit=crop&w=800&q=80']
                ],
                'hotels' => [
                    ['name' => 'Palais de Mahe', 'image' => 'https://images.unsplash.com/photo-1582719478250-c29acc992f13?auto=format&fit=crop&w=800&q=80', 'price' => 18000],
                    ['name' => 'The Promenade', 'image' => 'https://images.unsplash.com/photo-1445019980597-93fa8acb246c?auto=format&fit=crop&w=800&q=80', 'price' => 9500]
                ]
            ]
        ];

        foreach ($destData as $data) {
            $dest = Destination::create([
                'name' => $data['name'],
                'location' => $data['location'],
                'image' => $data['image'],
                'description' => $data['description'],
                'rating' => $data['rating'],
            ]);

            foreach ($data['attractions'] as $attr) {
                Attraction::create([
                    'destination_id' => $dest->id,
                    'name' => $attr['name'],
                    'image' => $attr['image'],
                    'description' => 'A top-rated spot to experience the magic of ' . $dest->name
                ]);
            }

            foreach ($data['hotels'] as $h) {
                Hotel::create([
                    'destination_id' => $dest->id,
                    'name' => $h['name'],
                    'location' => $dest->location,
                    'image' => $h['image'],
                    'description' => 'Luxury stay in the heart of ' . $dest->name,
                    'price_per_night' => $h['price'],
                    'available_rooms' => 15,
                    'rating' => 4.8
                ]);
            }

            // Restore the restaurant from previous seeder logic
            $restName = $data['name'] . ' Special';
            $restaurant = Restaurant::create([
                'destination_id' => $dest->id,
                'name' => $restName,
                'image' => 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?auto=format&fit=crop&w=800&q=80',
                'description' => 'A local favorite known for its authentic taste.',
                'rating' => 4.7
            ]);

            Review::create([
                'user_id' => $user->id,
                'restaurant_id' => $restaurant->id,
                'rating' => 5,
                'comment' => 'Perfect! Everything about this place is 5-star.'
            ]);

            Transport::create([
                'destination_id' => $dest->id,
                'type' => 'Cab',
                'route' => 'Full Day Sightseeing',
                'provider' => 'OmniTrek Premium Cabs',
                'departure_time' => 'Flexible',
                'available_seats' => 4,
                'price' => rand(1500, 3500)
            ]);
        }
    }
}
