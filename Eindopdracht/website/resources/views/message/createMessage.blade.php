@if($channel != null and $channel->id != null)
    <form class="chatbox" action="/guild/{{$guild->id}}/{{ $channel->id }}" method="post">
        @csrf
        <input type="hidden" id="message_id" name="message_id" value="0">
        <textarea class="chatbox__input" type="text" name="content" id="content" placeholder="Message"></textarea>
        <button class="chatbox__send" type="submit">Send</button>
    </form>
@endif
