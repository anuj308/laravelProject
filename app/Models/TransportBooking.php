<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransportBooking extends Model
{
    protected $fillable = ['user_id', 'transport_id', 'travel_date', 'people', 'total_price', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transport()
    {
        return $this->belongsTo(Transport::class);
    }
}
