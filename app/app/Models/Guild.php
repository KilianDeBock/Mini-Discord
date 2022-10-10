<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guild extends Model
{
    public $fillable = [
        'name',
        'description',
        'owner_id',
        'created_at',
        'updated_at',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'user_guild', 'guild_id', 'user_id');
    }

    public function channels()
    {
        return $this->hasMany(Channel::class, 'guild_id', 'id');
    }
}
