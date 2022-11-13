@if($channel != null and $channel->messages != null)
    <ul class="messages" id="messages">
        @php($lastUserId = 0)
        @php($lastCreatedAt = 0)
        @foreach($channel->messages as $message)
            @php($isSameUser = $lastUserId == $message->user_id)
            @php($isNoReply = $message->message_id == 0)
            @php($noMoreThan10MinutesPassed = (strtotime($message->created_at) - strtotime($lastCreatedAt) < 600))
            @if ($isSameUser && $isNoReply && $noMoreThan10MinutesPassed)
                @include('message.moreMessage')
            @else
                @include('message.message')
            @endif
            @php($lastUserId = $message->user_id)
            @php($lastCreatedAt = $message->created_at)
        @endforeach
    </ul>
@endif
