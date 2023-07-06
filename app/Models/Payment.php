<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'reservation_id',
        'customer_name',
        'card_number',
        'amount',
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}

