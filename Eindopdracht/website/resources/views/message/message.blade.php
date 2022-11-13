<li class="message" data-id="{{$message->id}}">
    @if($message->message_id != 0)
        @php($replyMessage = $message->getMessage($message->message_id))
        @if ($replyMessage)
            <section class="message__reply">
                <img class="message__reply__avatar"
                     src="{{ asset("storage/users/avatars/{$replyMessage->user->avatar_url}") }}" alt="Avatar">
                <span class="message__reply__username">{{ $replyMessage->user->username }}</span>
                <span class="message__reply__content">{{ $replyMessage->content }}</span>
            </section>
        @else
            <section class="message__reply">
                <img class="message__reply__avatar"
                     src="{{ asset("storage/users/avatars/0.png") }}" alt="Avatar">
                <span class="message__reply__username">Unkown</span>
                <span class="message__reply__content">Message has been deleted</span>
            </section>
        @endif
    @endif
    <section class="message__info">
        <img class="message__avatar" src="{{ asset("storage/users/avatars/{$message->user->avatar_url}") }}"
             alt="Avatar">
        <span class="message__username">{{ $message->user->username }}</span>
        <span class="message__date">{{ $message->formated_date }}</span>
    </section>
    <p class="message__content">
        @include('message.messageContent')
    </p>
    @if($guild->user_id == Auth::user()->id)
        @include('message.messageDelete')
    @endif
</li>
