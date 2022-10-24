@if($channel != null and $channel->messages != null)
    <ul class="messages" id="messages">
        @foreach($channel->messages as $message)
            @include('message.message')
        @endforeach
    </ul>
@endif
