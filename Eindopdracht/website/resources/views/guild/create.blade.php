<div class="create-guild popup popup__double">
    <form action="/guild/create" method="post" class="popup__item" enctype="multipart/form-data">
        @csrf
        <h2>Create Server</h2>
        <label>
            Display name:
            <input type="text" name="displayname" id="displayname" placeholder="{{$user->username}}'s server">
        </label>
        <label>
            Avatar:
            <input type="file" name="avatar" id="avatar">
        </label>
        <label>
            Banner:
            <input type="file" name="banner" id="banner">
        </label>
        <button type="submit">Create</button>
    </form>
    <form action="/guild/join" method="post" class="popup__item">
        @csrf
        <h2>Join Server</h2>
        <label>
            Server ID:
            <input type="number" name="guild_id" id="guild_id">
        </label>
        <button type="submit">Join</button>
    </form>
</div>
