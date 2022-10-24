<?php

namespace App\Http\Controllers;


use App\Models\Channel;
use App\Models\Guild;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class ChannelController extends Controller
{
    public function get($guildId, $channelId)
    {
        [$guilds, $user] = Guild::getGuilds();
        // Test active state

        $guild = Guild::find($guildId);
        if ($guild->members->contains($user) or $guild->user_id == $user->id) {
            $isOwner = $guild->user_id == $user->id;
            $guilds->find($guildId)->active = true;
            $channel = Channel::find($channelId);
            return view('guild.guild', [
                'user' => $user,
                'guild_id' => $guildId,
                'guild' => $guild,
                'guilds' => $guilds,
                'isOwner' => $isOwner,
                'channel' => $channel,
            ]);
        }

        return view('home.home', [
            'guild' => $guilds,
        ]);
    }

    public function getMessages($guildId, $channelId, $lastMessageId)
    {
        [$guilds, $user] = Guild::getGuilds();
        // Test active state

        $guild = Guild::find($guildId);
        if ($guild->members->contains($user) or $guild->user_id == $user->id) {
            $guilds->find($guildId)->active = true;
            $channel = Channel::find($channelId);
            $messages = "";
            foreach ($channel->messages()->where("id", ">", $lastMessageId)->get() as $message) {
                $messages .= view('message.message', ['message' => $message])->render();
            }
            return $messages;
        }
    }

    public function createMessage($guildId, $channelId)
    {
        $newMessage = new Message();
        $newMessage->content = request('content');
        $newMessage->channel_id = $channelId;
        $newMessage->message_id = request('message_id') ?? 0;
        $newMessage->user_id = Auth::user()->id;
        $newMessage->save();

        return redirect("guild/{$guildId}/{$channelId}");
    }

    public function createPage($guildId)
    {
        [$guilds, $user] = Guild::getGuilds();
        if ($guilds == null) {
            return view('home.home');
        }
        return view('channel.create', [
            'user' => $user,
            'guild_id' => $guildId,
            'guilds' => $guilds,
        ]);
    }

    public function create($guildId)
    {
        $newChannel = new Channel();

        $newChannel->name = request('name');
        $newChannel->description = request('description');
        $newChannel->guild_id = $guildId;
        $newChannel->save();


        return redirect("guild/{$guildId}/$newChannel->id");
    }
}
