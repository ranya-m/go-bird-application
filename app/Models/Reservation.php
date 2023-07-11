<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Offer;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'offer_id',
        'user_id',
        'status',
        'confirmed',
        'start_date',
        'end_date',
    ];
    
    
    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isCanceledByUser()
    {
        return $this->status === 'canceled';
    }



    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function numberOfNights($offerId)
    {
        $startDate = Carbon::parse($this->start_date);
        $endDate = Carbon::parse($this->end_date);
    
        return $startDate->diffInDays($endDate);    
    }

    public function getTotalPrice($offerId)
{
    $pricePerNight = $this->offer->price;
    $numberOfNights = $this->numberOfNights($offerId);

    return $pricePerNight * $numberOfNights;
}


    public static function getUnavailableDates($offerId)
    {
        $reservations = self::where('offer_id', $offerId)
        ->where('status', 'confirmed')
        ->get();
        $unavailableDates = [];
    
        foreach ($reservations as $reservation) {
            $startDate = Carbon::parse($reservation->start_date);
            $endDate = Carbon::parse($reservation->end_date);
            $dates = $startDate->range($endDate)->toArray();
            $unavailableDates = array_merge($unavailableDates, $dates);
        }
    
        // Remove duplicates from the array
        $unavailableDates = array_unique($unavailableDates);
    
        return $unavailableDates;
    }


    

    public static function getAllUnavailableDates($offers)
{
    $offers = self::all();
    $unavailableDates = [];

    foreach ($offers as $offer) {
        $unavailableDates[$offer->id] = Reservation::getUnavailableDates($offer->id);
    }

    return $unavailableDates;
}

}

