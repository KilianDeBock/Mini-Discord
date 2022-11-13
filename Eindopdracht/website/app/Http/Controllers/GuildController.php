<?php

namespace App\Http\Controllers;


use App\Models\Channel;
use App\Models\Guild;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GuildController extends Controller
{

    public function get($id)
    {
        [$guilds, $user] = Guild::getGuilds();
        // Test active state

        $guild = Guild::find($id);
        if ($guild->members->contains($user) or $guild->user_id == $user->id) {
            $guilds->find($id)->active = true;
            $isOwner = $guild->user_id == $user->id;
            $channels = $guild->channels;
            $channel = null;
            if ($channels !== null && $channels->count() > 0) {
                $channel = Channel::find($channels->first()->id) ?? null;
            }
            if ($channel !== null) {
                return redirect("/guild/{$id}/{$channel->id}");
            }
            return view('guild.guild', [
                'user' => $user,
                'guild_id' => $id,
                'guild' => $guild,
                'guilds' => $guilds,
                'isOwner' => $isOwner,
                'channel' => null,
            ]);
        }

        return view('home.home', [
            'guilds' => $guilds,
        ]);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'displayname' => 'required|max:30',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $authUser = Auth::user();
        $user = User::findOrFail($authUser->id);

        $guild = new Guild();
        $guild->displayname = request('displayname');
        $guild->avatar_url = '0.png';
        $guild->banner_url = '0.png';
        $guild->user_id = $user->id;
        $guild->save();

        $avatar_file = $request->file('avatar');
        if ($avatar_file) {
            $extension = $avatar_file->getClientOriginalExtension();
            $uploaded_path = $request->file('avatar')->storeAs('public/guilds/avatars', $guild->id . '.' . $extension);
            //haal enkel de filename op van het pad
            $filename = basename($uploaded_path);
            $guild->avatar_url = $filename;
        }

        $banner_file = $request->file('banner');
        if ($banner_file) {
            $extension = $banner_file->getClientOriginalExtension();
            $uploaded_path = $request->file('banner')->storeAs('public/guilds/banners', $guild->id . '.' . $extension);
            //haal enkel de filename op van het pad
            $filename = basename($uploaded_path);
            $guild->banner_url = $filename;
        }

        $guild->save();

        $channel = new Channel();
        $channel->name = 'general';
        $channel->description = 'All about general stuff';
        $channel->guild_id = $guild->id;
        $channel->save();

        return redirect("/guild/{$guild->id}");
    }

    public function edit(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'displayname' => 'required|max:30',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $authUser = Auth::user();
        $user = User::findOrFail($authUser->id);

        $guild = Guild::find($id);

        if ($guild->user_id == $user->id) {
            $guild->displayname = request('displayname');

            $avatar_file = $request->file('avatar');
            if ($avatar_file) {
                $extension = $avatar_file->getClientOriginalExtension();
                $uploaded_path = $request->file('avatar')->storeAs('public/guilds/avatars', $guild->id . '.' . $extension);
                //haal enkel de filename op van het pad
                $filename = basename($uploaded_path);
                $guild->avatar_url = $filename;
            }

            $banner_file = $request->file('banner');
            if ($banner_file) {
                $extension = $banner_file->getClientOriginalExtension();
                $uploaded_path = $request->file('banner')->storeAs('public/guilds/banners', $guild->id . '.' . $extension);
                //haal enkel de filename op van het pad
                $filename = basename($uploaded_path);
                $guild->banner_url = $filename;
            }

            $guild->user_id = $user->id;
            $guild->save();
        }

        return redirect("/guild/{$id}");
    }

    public function join(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'guild_id' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $authUser = Auth::user();
        $user = User::findOrFail($authUser->id);
        $guild = Guild::find($request->guild_id);

        if (!$guild->members->contains($user)) {
            $guild->members()->attach($user);
        }

        return redirect("/guild/{$request->guild_id}");
    }

    public function deleteGuild($guildId)
    {
        [$guilds, $user] = Guild::getGuilds();
        $guild = Guild::find($guildId);
        $isOwner = $guild->user_id == $user->id;
        $channelId = $guild->id;

        if ($isOwner) {
            Message::where('channel_id', $channelId)->delete();
            Channel::where('guild_id', $guildId)->delete();
            $guild->delete();
        }

        return redirect("/");
    }
}
