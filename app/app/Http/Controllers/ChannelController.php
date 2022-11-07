<?php

namespace App\Http\Controllers;


use App\Models\Channel;
use App\Models\Guild;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
                'channelId' => $channelId,
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
            $lastMessage = Message::where('id', '<=', $lastMessageId)->where('channel_id', $channelId)->orderBy('id', 'desc')->first();
            $lastUserId = $lastMessage->user_id ?? 0;
            $lastCreatedAt = $lastMessage->created_at ?? 0;
            foreach ($channel->messages()->where("id", ">", $lastMessageId)->get() as $message) {

                $isSameUser = $lastUserId == $message->user_id;
                $isNoReply = $message->message_id == 0;
                $noMoreThan10MinutesPassed = (strtotime($message->created_at) - strtotime($lastCreatedAt) < 600);

                if ($isSameUser && $isNoReply and $noMoreThan10MinutesPassed) {
                    $newMessage = view('message.moreMessage', ['message' => $message, 'guild' => $guild])->render();
                } else {
                    $newMessage = view('message.message', ['message' => $message, 'guild' => $guild])->render();
                }
                $messages .= $newMessage;
                $lastUserId = $message->user_id;
                $lastCreatedAt = $message->created_at;
            }
            return $messages;
        }
    }

    public function createMessage(Request $request, $guildId, $channelId)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required|max:2000',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $newMessage = new Message();
        $newMessage->content = request('content');
        $newMessage->channel_id = $channelId;
        $newMessage->message_id = request('message_id') ?? 0;
        $newMessage->user_id = Auth::user()->id;
        $newMessage->save();

        return redirect("guild/{$guildId}/{$channelId}");
    }

    public function deleteMessage($guildId, $messageId)
    {
//        dd($guildId, $messageId);
        [$guilds, $user] = Guild::getGuilds();
        $guild = Guild::find($guildId);
        $message = Message::find($messageId);
        $isOwner = $guild->user_id == $user->id;
        $isFromGuild = $message->channel->guild->id == $guildId;
        $channelId = $message->channel->id;

        if ($isOwner and $isFromGuild) {
            $message->delete();
        }

        return redirect("guild/{$guildId}/{$channelId}");
    }

    public function deleteChannel($guildId, $channelId)
    {
//        dd($guildId, $messageId);
        [$guilds, $user] = Guild::getGuilds();
        $guild = Guild::find($guildId);
        $channel = Channel::find($channelId);
        $isOwner = $guild->user_id == $user->id;
        $isFromGuild = $channel->guild->id == $guildId;
        $channelId = $channel->id;

        if ($isOwner and $isFromGuild) {
            Message::where('channel_id', $channelId)->delete();
            $channel->delete();
        }

        return redirect("guild/{$guildId}/{$channelId}");
    }

    public function create(Request $request, $guildId)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:300',
            'description' => 'required|max:200',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $newChannel = new Channel();

        $newChannel->name = request('name');
        $newChannel->description = request('description');
        $newChannel->guild_id = $guildId;
        $newChannel->save();


        return redirect("guild/{$guildId}/$newChannel->id");
    }
}
