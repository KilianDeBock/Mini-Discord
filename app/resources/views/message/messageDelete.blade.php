<form class="message__delete" method="post">
    @csrf
    <button data-id="{{$message->id}}" data-guild_id="{{$guild->id}}">Delete Message</button>
</form>
