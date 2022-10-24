<form action="/guild/{{$guild->id}}/edit" method="post" class="popup edit-guild">
    @csrf
    <h2>Edit Server</h2>
    <label>
        Displayname:
        <input type="text" name="displayname" id="displayname" value="{{$guild->displayname}}"
               placeholder="Display Name">
    </label>
    <label>
        Avatar URL:
        <input type="text" name="avatar_url" id="avatar_url" value="{{$guild->avatar_url}}" placeholder="avatar_url">
    </label>
    <label>
        Banner URL:
        <input type="text" name="banner_url" id="banner_url" value="{{$guild->banner_url}}" placeholder="banner_url">
    </label>
    <button type="submit">Create</button>
</form>
