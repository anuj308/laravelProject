<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attraction extends Model
{
    protected $fillable = ['destination_id', 'name', 'image', 'description'];

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
}
