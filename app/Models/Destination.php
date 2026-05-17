<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    protected $fillable = ['name', 'location', 'image', 'description', 'rating'];

    public function hotels()
    {
        return $this->hasMany(Hotel::class);
    }

    public function packages()
    {
        return $this->hasMany(TravelPackage::class);
    }

    public function guides()
    {
        return $this->hasMany(LocalGuide::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
