<form action="/guild/create" method="post" class="popup create-guild">
    @csrf
    <h2>Create Server</h2>
    <label>
        Display name:
        <input type="text" name="displayname" id="displayname" placeholder="{{$user->username}}'s server">
    </label>
    <label>
        Avatar URL:
        <input type="text" name="avatar_url" id="avatar_url" placeholder="avatar_url"
               value="https://lyttle.it/favicon.ico">
    </label>
    <label>
        Banner URL:
        <input type="text" name="banner_url" id="banner_url" placeholder="banner_url"
               value="https://lyttle.it/favicon.ico">
    </label>
    <button type="submit">Create</button>
</form>
