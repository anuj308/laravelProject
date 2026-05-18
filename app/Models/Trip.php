<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $fillable = [
        'user_id',
        'destination_id',
        'hotel_id',
        'travel_package_id',
        'local_guide_id',
        'travel_date',
        'people',
        'nights',
        'total_price',
        'status',
        'notes',
    ];

    // Yeh trip kis user ki hai
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Kahan jaana hai
    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    // Kahan rukna hai (optional)
    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    // Kaunsa package liya hai (optional)
    public function travelPackage()
    {
        return $this->belongsTo(TravelPackage::class);
    }

    // Kaunsa guide rakha hai (optional)
    public function localGuide()
    {
        return $this->belongsTo(LocalGuide::class);
    }
}
