@if($channel != null and $channel->messages != null)
    <ul class="messages" id="messages">
        @php($lastUserId = 0)
        @foreach($channel->messages as $message)
            @if ($lastUserId == $message->user_id && $message->message_id == 0)
                @include('message.moreMessage')
            @else
                @include('message.message')
            @endif
            @php($lastUserId = $message->user_id)
        @endforeach
    </ul>
@endif
