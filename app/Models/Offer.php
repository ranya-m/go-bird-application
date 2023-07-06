<?php

namespace App\Models;
use App\Models\Host;
use App\Models\User;
use App\Models\Review;

use App\Models\Reservation;
use App\Casts\Json;



use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'type',
        'category',
        'city',
        'country',
        'region',
        'address',
        'description',
        'price',
        'approved',
        'published',
        'available',
        'host_id',
    ];

    protected $casts = [
        'photos' => Json::class,
        'videos' => Json::class,
    ];
    

        public function host()
    {
        return $this->belongsTo(Host::class);
    }

    public function approvedReviews()
    {
        return $this->reviews()->where('approved', true)->get();
    }
    public function approvedReviewCount()
    {
        return $this->reviews()->where('approved', true)->count();
    }

    public function reservations()
{
    return $this->hasMany(Reservation::class);
}




}
