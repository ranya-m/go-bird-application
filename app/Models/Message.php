<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Message extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'sender_id', 'receiver_id'];

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

}
