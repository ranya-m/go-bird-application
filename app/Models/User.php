<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Reservation;



class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'identity_number',
        'identity_document',
        'phone_verified',
        'identity_verified',
        'verification_code',
        'about_me',
        'profile_pic',
        'is_admin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'identity_number' => 'hashed',
        'identity_document' => 'string', 
        'identity_verified' => 'boolean', 
        'phone_verified' => 'boolean',   
        'is_admin' => 'boolean',
    ];

    

        // User can have one host account 
        public function host()
        {
            return $this->hasOne(Host::class);
        }
    
        // Check if the user already has a host account
        public function isHost()
        {
            return $this->host !== null;
        }

        //  Admin flag : user is an admin
        public function isAdmin()
        {
            return $this->is_admin === true;
        }

        public function reservations()
        {
            return $this->hasMany(Reservation::class);
        }



    // Phone Verification
    public function markPhoneAsVerified()
    {
        $this->phone_verified === true;
        $this->save();
    }

    public function hasVerifiedPhone()
    {
        return $this->phone_verified === true;
    }

    public function hasPhone()
    {
        return !is_null($this->phone);
    }


    // Identity Verification
    public function hasVerifiedIdentity()
    {
        return $this->identity_verified === true;
    }

    public function hasUploadedIdentityDocument()
    {
        return !is_null($this->identity_document);
    }

    public function setUploadedIdentityDocument($value)
{
    $this->identity_document = $value;
}

public function setVerifiedIdentity($value)
{
    $this->identity_verified = $value;
}

        public function getIdentityNumberAttribute($value)
    {
        return $value; 
    }

    public function getIdentityDocumentAttribute($value)
    {
        return $value; 
    }

    // Mutator methods of identity infos
        public function setIdentityNumberAttribute($value)
    {
        $this->attributes['identity_number'] = $value;
    }

    public function setIdentityDocumentAttribute($value)
    {
        $this->attributes['identity_document'] = $value; 
    }




}