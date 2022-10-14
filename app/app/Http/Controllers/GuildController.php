<?php

namespace App\Http\Controllers;


use App\Models\Guild;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GuildController extends Controller
{
    public function index()
    {
        $authUser = Auth::user();
        $user = User::find($authUser->id);
        $guilds = $user->guilds;
        // Test active state
        $guilds[0]->active = true;
        if ($guilds == null) {
            return view('home.home');
        }
        return view('home.home', [
            'guilds' => $guilds,
        ]);
    }

    public function get($id)
    {
        $authUser = Auth::user();
        $user = User::find($authUser->id);
        $guilds = $user->guilds;
        // Test active state

        $guild = Guild::find($id);
        if ($guild->members->contains($user)) {
            $guilds->find($id)->active = true;
            return view('guild.guild', [
                'guild_id' => $id,
                'guild' => $guild,
                'guilds' => $guilds,
            ]);
        }

        return view('home.home', [
            'guilds' => $guilds,
        ]);
    }
}
