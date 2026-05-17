<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TravelPackage extends Model
{
    protected $fillable = ['destination_id', 'title', 'description', 'price', 'duration_days', 'image'];

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    public function bookings()
    {
        return $this->hasMany(PackageBooking::class);
    }
}
