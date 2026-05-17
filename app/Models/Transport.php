<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transport extends Model
{
    protected $fillable = ['type', 'route', 'provider', 'departure_time', 'available_seats', 'price'];
}
