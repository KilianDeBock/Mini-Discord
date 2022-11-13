<li class="message message__again" data-id="{{$message->id}}">
    <span class="message__date message__date--again">{{ $message->created_at->format('H:i:s') }}</span>
    <p class="message__content">
        @include('message.messageContent')
    </p>
    @if($guild->user_id == Auth::user()->id)
        @include('message.messageDelete')
    @endif
</li>
