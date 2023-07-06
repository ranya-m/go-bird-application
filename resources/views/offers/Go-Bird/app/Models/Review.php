<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment',
        'overall_rating',
        'cleanliness_rating',
        'accuracy_rating',
        'communication_rating',
        'check_in_rating',
        'location_rating',  
    ];

    public function offer()
{
    return $this->belongsTo(Offer::class);
}

}
