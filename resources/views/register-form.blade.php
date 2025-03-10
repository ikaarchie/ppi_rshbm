<form action="{{ route('register.store') }}" method="POST">
    @csrf
    <div>
        <label for="nomor_induk">Nomor Induk:</label>
        <input type="text" name="nomor_induk" id="nomor_induk" required>
    </div>
    <div>
        <label for="name">Nama:</label>
        <input type="text" name="name" id="name" required>
    </div>
    <button type="submit">Submit</button>
</form>