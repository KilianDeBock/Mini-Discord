@if($guild->channels != null)
    <ul class="channels">
        <li>
            <h3 class="channels__title">Channels</h3>
        </li>
        @foreach($guild->channels as $channel)
            <li class="channels__channel{{$channel->id == $channelId ? " active" : ""}}">
                <a href="/guild/{{ $guild_id }}/{{ $channel->id }}">{{ $channel->name }}</a>

                @if($guild->user_id == Auth::user()->id)
                    @include('channel.channelDelete')
                @endif
            </li>
        @endforeach
        @if ($isOwner)
            <li class="channels__channel channel__create">
                <button class="popup-button" data-name="create-channel">Add Channel</button>
            </li>
        @endif
    </ul>
@endif
