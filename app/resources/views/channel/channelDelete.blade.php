<form class="channel__delete" method="post">
    @csrf
    <button data-id="{{$channel->id}}" data-guild_id="{{$guild->id}}">Delete Channel</button>
</form>
