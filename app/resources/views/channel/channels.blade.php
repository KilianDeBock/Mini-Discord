@if($guild->channels != null)
    <ul class="channels">
        @foreach($guild->channels as $channel)
            <li class="channels__channel">
                <a href="/guild/{{ $guild_id }}/{{ $channel->id }}">{{ $channel->name }}</a>
            </li>
        @endforeach
    </ul>
@endif
