<table class="table">
    <tr>
        <th colspan="14">Data Rekap Surveilans</th>
    </tr>
    <tr>
        <td colspan="14">{{ $tanggal }}</td>
    </tr>
</table>

<table class="table">
    <thead>
        <tr>
            <th rowspan="2"></th>
            <th colspan="4">Pemasangan Alat</th>
            <th rowspan="2">Pasien<br />Tirah Baring</th>
            <th colspan="7">HAIs</th>
            <th rowspan="2">Terpajan</th>
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
        <tr>
            <th>Intensif</th>
            <td>{{ $int_pa_ivl }}</td>
            <td>{{ $int_pa_dc }}</td>
            <td>{{ $int_pa_vent }}</td>
            <td>{{ $int_pa_iad }}</td>
            <td>{{ $int_tirah_baring }}</td>
            <td>{{ $int_hais_plebitis }}</td>
            <td>{{ $int_hais_isk }}</td>
            <td>{{ $int_hais_vap }}</td>
            <td>{{ $int_hais_iad }}</td>
            <td>{{ $int_hais_deku }}</td>
            <td>{{ $int_hais_hap }}</td>
            <td>{{ $int_hais_ido }}</td>
            <td>{{ $int_terpajan }}</td>
        </tr>
        <tr>
            <th>Perawatan Eksekutif lt.2</th>
            <td>{{ $lt2_pa_ivl }}</td>
            <td>{{ $lt2_pa_dc }}</td>
            <td>{{ $lt2_pa_vent }}</td>
            <td>{{ $lt2_pa_iad }}</td>
            <td>{{ $lt2_tirah_baring }}</td>
            <td>{{ $lt2_hais_plebitis }}</td>
            <td>{{ $lt2_hais_isk }}</td>
            <td>{{ $lt2_hais_vap }}</td>
            <td>{{ $lt2_hais_iad }}</td>
            <td>{{ $lt2_hais_deku }}</td>
            <td>{{ $lt2_hais_hap }}</td>
            <td>{{ $lt2_hais_ido }}</td>
            <td>{{ $lt2_terpajan }}</td>
        </tr>
        <tr>
            <th>Perawatan Reguler lt.4</th>
            <td>{{ $lt4_pa_ivl }}</td>
            <td>{{ $lt4_pa_dc }}</td>
            <td>{{ $lt4_pa_vent }}</td>
            <td>{{ $lt4_pa_iad }}</td>
            <td>{{ $lt4_tirah_baring }}</td>
            <td>{{ $lt4_hais_plebitis }}</td>
            <td>{{ $lt4_hais_isk }}</td>
            <td>{{ $lt4_hais_vap }}</td>
            <td>{{ $lt4_hais_iad }}</td>
            <td>{{ $lt4_hais_deku }}</td>
            <td>{{ $lt4_hais_hap }}</td>
            <td>{{ $lt4_hais_ido }}</td>
            <td>{{ $lt4_terpajan }}</td>
        </tr>
        <tr>
            <th>Perawatan Reguler lt.5</th>
            <td>{{ $lt5_pa_ivl }}</td>
            <td>{{ $lt5_pa_dc }}</td>
            <td>{{ $lt5_pa_vent }}</td>
            <td>{{ $lt5_pa_iad }}</td>
            <td>{{ $lt5_tirah_baring }}</td>
            <td>{{ $lt5_hais_plebitis }}</td>
            <td>{{ $lt5_hais_isk }}</td>
            <td>{{ $lt5_hais_vap }}</td>
            <td>{{ $lt5_hais_iad }}</td>
            <td>{{ $lt5_hais_deku }}</td>
            <td>{{ $lt5_hais_hap }}</td>
            <td>{{ $lt5_hais_ido }}</td>
            <td>{{ $lt5_terpajan }}</td>
        </tr>
        <tr>
            <th>VK</th>
            <td>{{ $vk_pa_ivl }}</td>
            <td>{{ $vk_pa_dc }}</td>
            <td>{{ $vk_pa_vent }}</td>
            <td>{{ $vk_pa_iad }}</td>
            <td>{{ $vk_tirah_baring }}</td>
            <td>{{ $vk_hais_plebitis }}</td>
            <td>{{ $vk_hais_isk }}</td>
            <td>{{ $vk_hais_vap }}</td>
            <td>{{ $vk_hais_iad }}</td>
            <td>{{ $vk_hais_deku }}</td>
            <td>{{ $vk_hais_hap }}</td>
            <td>{{ $vk_hais_ido }}</td>
            <td>{{ $vk_terpajan }}</td>
        </tr>
    </tbody>
</table>

{{-- <table class="table">
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
</table> --}}

<table class="table">
    <thead>
        <tr>
            <th colspan="2">Analisa</th>
            <th colspan="4">Tindak Lanjut</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            @foreach($rekap as $rekaps)
            <td colspan="2">{{ $rekaps->analisa }}</td>
            <td colspan="4">{{ $rekaps->tindak_lanjut }}</td>
            @endforeach
        </tr>
    </tbody>
</table>

<table class="table">
    <tr>
        <td colspan="10"></td>
        <td colspan="4">Mengetahui,</td>
    </tr>
    <tr>
        <td>IPCN</td>
        <td colspan="9"></td>
        <td colspan="4">Ketua Tim PPI</td>
    </tr>
    <tr>
        <td colspan="14"></td>
    </tr>
    <tr>
        <td colspan="14"></td>
    </tr>
    <tr>
        <td colspan="14"></td>
    </tr>
    <tr>
        <td colspan="14"></td>
    </tr>
    <tr>
        <td colspan="14"></td>
    </tr>
    <tr>
        <td>Susilowati</td>
        <td colspan="9"></td>
        <td colspan="4">dr. Yovita Amalia Wijaya</td>
    </tr>
    <tr>
        <td colspan="14"></td>
    </tr>
    <tr>
        <td colspan="14"></td>
    </tr>
    <tr>
        <td colspan="14">Menyetujui,</td>
    </tr>
    <tr>
        <td colspan="14">Direktur</td>
    </tr>
    <tr>
        <td colspan="14"></td>
    </tr>
    <tr>
        <td colspan="14"></td>
    </tr>
    <tr>
        <td colspan="14"></td>
    </tr>
    <tr>
        <td colspan="14"></td>
    </tr>
    <tr>
        <td colspan="14"></td>
    </tr>
    <tr>
        <td colspan="14">dr. Ong Felin Sinaga, M.K.M.</td>
    </tr>
</table>