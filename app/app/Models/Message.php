<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public $fillable = [
        'content',
        'channel_id',
        'message_id',
        'user_id',
        'created_at',
    ];

    public function channel()
    {
        return $this->belongsTo(Channel::class, 'channel_id', 'id');
    }

    public function replies()
    {
        return $this->hasMany(Message::class, 'message_id', 'id');
    }

    public function reactions()
    {
        return $this->hasMany(Reaction::class, 'message_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
