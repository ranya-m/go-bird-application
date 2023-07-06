<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Host;
use App\Models\Review;


class Offer extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'type',
        'category',
        'photo',
        'video',
        'address',
        'country',
        'region',
        'city',
        'price',
        'approved',
        'published',
        'available',
    ];

    protected $casts = [
        'photos' => 'array',
        'videos' => 'array',
    ];


    public function hostOwner()
    {
        return $this->belongsTo(Host::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

}

