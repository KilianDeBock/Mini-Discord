<form action="/guild/{{$guild->id}}/edit" method="post" class="popup edit-guild" enctype="multipart/form-data">
    @csrf
    <h2>Edit Server</h2>
    <label>
        Displayname:
        <input type="text" name="displayname" id="displayname" value="{{$guild->displayname}}"
               placeholder="Display Name">
    </label>
    <label>
        Avatar:
        <input type="file" name="avatar" id="avatar">
    </label>
    <label>
        Banner:
        <input type="file" name="banner" id="banner">
    </label>
    <button type="submit">Edit</button>
</form>
