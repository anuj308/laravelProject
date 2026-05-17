<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocalGuide extends Model
{
    protected $fillable = ['destination_id', 'name', 'phone', 'email', 'languages', 'fee_per_day', 'rating'];

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
}
