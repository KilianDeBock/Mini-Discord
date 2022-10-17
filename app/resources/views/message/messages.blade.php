@if($channel != null and $channel->messages != null)
    @php($messages = $channel->messages->reverse())
    <ul class="messages">
        @foreach($messages as $message)
            <li class="message">
                <span class="message__info">
                    <img class="message__avatar" src="{{ $message->user->avatar_url }}" alt="Avatar">
                    <span class="message__username">{{ $message->user->username }}</span>
                    <span class="message__date">{{ $message->created_at }}</span>
                </span>
                <p class="message__content">{{ $message->content }}</p>
            </li>
        @endforeach
    </ul>
@endif
