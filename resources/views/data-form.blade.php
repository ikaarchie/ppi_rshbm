<h2>Data untuk: {{ $pengguna->name }}</h2>

<form action="{{ route('data.store', $pengguna->id) }}" method="POST">
    @csrf
    <div>
        <label for="data1">Data1:</label>
        <input type="text" name="data1" id="data1" required>
    </div>
    <div>
        <label for="data2">Data2:</label>
        <input type="text" name="data2" id="data2" required>
    </div>
    <div>
        <label for="data3">Data3:</label>
        <input type="text" name="data3" id="data3" required>
    </div>
    <button type="submit">Submit</button>
</form>

<ul>
    @foreach($pengguna->dataDetails as $detail)
    <li>Data1: {{ $detail->data1 }}, Data2: {{ $detail->data2 }}, Data3: {{ $detail->data3 }}</li>
    @endforeach
</ul>