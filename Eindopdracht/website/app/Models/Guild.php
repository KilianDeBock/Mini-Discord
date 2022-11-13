<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Guild extends Model
{
    public $fillable = [
        'name',
        'description',
        'owner_id',
        'created_at',
        'updated_at',
    ];

    public static function getGuilds()
    {
        $authUser = Auth::user();
        $user = User::findOrFail($authUser->id);
        $ownedGuilds = Guild::all()->where('user_id', $user->id);
        $memberGuilds = $user->guilds;
        $guilds = $ownedGuilds->merge($memberGuilds);
        return [$guilds, $user];
    }

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
