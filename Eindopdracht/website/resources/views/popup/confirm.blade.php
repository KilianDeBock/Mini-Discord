<form method="post" id="confirm" data-name="confirm" class="popup confirm" enctype="multipart/form-data">
    @csrf
    <h2>Are you sure about that?</h2>
    <button type="submit" id="no">No!</button>
    <button type="submit" id="yes">Yes delete it.</button>
</form>
