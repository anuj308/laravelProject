<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $fillable = [
        'destination_id',
        'name',
        'location',
        'image',
        'description',
        'price_per_night',
        'available_rooms',
        'rating',
    ];

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    public function bookings()
    {
        return $this->hasMany(HotelBooking::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
