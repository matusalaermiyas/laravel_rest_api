<form method="POST" action="/">
    @csrf
    <select name="color" multiple>
        <option value="red">Red</option>
        <option value="Blue">Blue</option>
        <option value="Green">Green</option>
    </select>

    <button type="submit">Done</button>
</form>
