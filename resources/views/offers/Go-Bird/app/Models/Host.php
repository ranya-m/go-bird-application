<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Host extends Model
{
    use HasFactory;

    protected $fillable = [
        'agree_to_host_terms',
        'account_approved'
    ];

    // A host account belongs to one user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //  Host can own one to many offers
    public function ownedOffer()
    {
        return $this->hasMany(offer::class);
    }
}
