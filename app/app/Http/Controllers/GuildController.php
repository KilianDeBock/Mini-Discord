<?php

namespace App\Http\Controllers;


use App\Models\Guild;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GuildController extends Controller
{

    public function get($id)
    {
        [$guilds, $user] = Guild::getGuilds();
        // Test active state

        $guild = Guild::find($id);
        if ($guild->members->contains($user) or $guild->user_id == $user->id) {
            $isOwner = $guild->user_id == $user->id;
            $guilds->find($id)->active = true;
            return view('guild.guild', [
                'guild_id' => $id,
                'guild' => $guild,
                'guilds' => $guilds,
                'isOwner' => $isOwner,
            ]);
        }

        return view('home.home', [
            'guilds' => $guilds,
        ]);
    }

    public function createPage()
    {
        [$guilds, $user] = Guild::getGuilds();
        if ($guilds == null) {
            return view('home.home');
        }
        return view('guild.create', [
            'guilds' => $guilds,
        ]);
    }

    public function create()
    {
        $authUser = Auth::user();
        $user = User::findOrFail($authUser->id);

        $guild = new Guild();
        $guild->displayname = request('displayname');
        $guild->avatar_url = request('avatar_url');
        $guild->banner_url = request('banner_url');
        $guild->user_id = $user->id;
        $guild->save();

        return redirect('guild/create');
    }

    public function editPage($id)
    {
        [$guilds, $user] = Guild::getGuilds();
        $guild = Guild::findOrFail($id);
        if ($guilds == null or $guild == null) {
            return view('home.home');
        }
        return view('guild.edit', [
            'guilds' => $guilds,
            'guild' => $guild,
        ]);
    }

    public function edit($id)
    {
        $authUser = Auth::user();
        $user = User::findOrFail($authUser->id);

        $guild = Guild::find($id);

        if ($guild->user_id == $user->id) {
            $guild->displayname = request('displayname');
            $guild->avatar_url = request('avatar_url');
            $guild->banner_url = request('banner_url');
            $guild->user_id = $user->id;
            $guild->save();
        }

        return redirect("guild/{$id}");
    }
}
