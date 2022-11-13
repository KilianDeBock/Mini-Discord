<form action="/guild/{{ $guild_id }}/create" method="post" class="popup create-channel">
    @csrf
    <h2>Create Channel</h2>
    <label>
        Channel name:
        <input type="text" name="name" id="name" placeholder="General">
    </label>
    <label>
        Description:
        <input type="text" name="description" id="description" placeholder="All about {{$guild->displayname}}.">
    </label>
    <input type="hidden" name="guild_id" id="guild_id" value="{{ $guild_id }}">
    <button type="submit">Create</button>
</form>
