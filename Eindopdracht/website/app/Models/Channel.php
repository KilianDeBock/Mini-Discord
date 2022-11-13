<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    public $fillable = [
        'name',
        'description',
        'guild_id',
        'created_at',
    ];

    public function guild()
    {
        return $this->belongsTo(Guild::class, 'guild_id', 'id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'channel_id', 'id');
    }
}
