<table class="table">
    <thead>
        <tr>
            <th rowspan="2">No</th>
            <th rowspan="2">MRN</th>
            <th rowspan="2">Nama Pasien</th>
            <th rowspan="2">Usia</th>
            <th rowspan="2">Jenis Kelamin</th>
            <th rowspan="2">Unit</th>
            <th colspan="4">Pemasangan Alat</th>
            <th rowspan="2">Pasien<br />Tirah<br />Baring</th>
            <th colspan="7">HAIs</th>
            <th rowspan="2">Karyawan Tertusuk Jarum</th>
            <th rowspan="2">Tanggal</th>
        </tr>
        <tr>
            <th>IVL</th>
            <th>DC</th>
            <th>Vent</th>
            <th>IAD</th>
            <th>Plebitis</th>
            <th>ISK</th>
            <th>VAP</th>
            <th>IAD</th>
            <th>DEKU</th>
            <th>HAP</th>
            <th>IDO</th>
        </tr>
    </thead>
    <tbody>
        @php $no = 1; @endphp
        @foreach($tabel as $key => $isi)
        <tr>
            <td>{{ $tabel->firstItem() + $key }}</td>
            <td>{{ $isi->mrn }}</td>
            <td>{{ $isi->nama_pasien }}</td>
            <td>{{ $isi->usia }}</td>
            <td>{{ $isi->jenis_kelamin }}</td>
            <td>{{ $isi->unit }}</td>
            <td>{{ $isi->pa_ivl }}</td>
            <td>{{ $isi->pa_dc }}</td>
            <td>{{ $isi->pa_vent }}</td>
            <td>{{ $isi->pa_iad }}</td>
            <td>{{ $isi->tirah_baring }}</td>
            <td>{{ $isi->hais_plebitis }}</td>
            <td>{{ $isi->hais_isk }}</td>
            <td>{{ $isi->hais_vap }}</td>
            <td>{{ $isi->hais_iad }}</td>
            <td>{{ $isi->hais_deku }}</td>
            <td>{{ $isi->hais_hap }}</td>
            <td>{{ $isi->hais_ido }}</td>
            <td>{{ $isi->terpajan }}</td>
            <td>{{ date("d/m/Y", strtotime($isi->tgl_input)) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>