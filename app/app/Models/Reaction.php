<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    public $fillable = [
        'reaction',
        'message_id',
        'user_id',
        'guild_id',
        'created_at',
    ];

    public function message()
    {
        return $this->belongsTo(Message::class, 'message_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
