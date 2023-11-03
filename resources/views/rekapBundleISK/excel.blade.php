<table class="table">
    <tr>
        <th colspan="8">Data Rekap Bundle ISK</th>
    </tr>
    <tr>
        <td colspan="8">{{ $tanggal }}</td>
    </tr>
</table>

<table class="table">
    <thead>
        <tr>
            <th></th>
            <th>IGD</th>
            <th>Intensif</th>
            <th>OK</th>
            <th>Perawatan Eksekutif lt.2</th>
            <th>Perawatan Reguler lt.4</th>
            <th>Perawatan Reguler lt.5</th>
            <th>VK</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th class="text-center h4">Bundle Pemasangan</th>
            <th colspan="7"></th>
        </tr>
        <tr>
            <th>Kaji kebutuhan / ada indikasi</th>
            <td>{{ $igd_ISK0101 }}</td>
            <td>{{ $int_ISK0101 }}</td>
            <td>{{ $ok_ISK0101 }}</td>
            <td>{{ $lt2_ISK0101 }}</td>
            <td>{{ $lt4_ISK0101 }}</td>
            <td>{{ $lt5_ISK0101 }}</td>
            <td>{{ $vk_ISK0101 }}</td>
        </tr>
        <tr>
            <th>Pemasangan oleh petugas yang terlatih</th>
            <td>{{ $igd_ISK0102 }}</td>
            <td>{{ $int_ISK0102 }}</td>
            <td>{{ $ok_ISK0102 }}</td>
            <td>{{ $lt2_ISK0102 }}</td>
            <td>{{ $lt4_ISK0102 }}</td>
            <td>{{ $lt5_ISK0102 }}</td>
            <td>{{ $vk_ISK0102 }}</td>
        </tr>
        <tr>
            <th>Kebersihan tangan</th>
            <td>{{ $igd_ISK0103 }}</td>
            <td>{{ $int_ISK0103 }}</td>
            <td>{{ $ok_ISK0103 }}</td>
            <td>{{ $lt2_ISK0103 }}</td>
            <td>{{ $lt4_ISK0103 }}</td>
            <td>{{ $lt5_ISK0103 }}</td>
            <td>{{ $vk_ISK0103 }}</td>
        </tr>
        <tr>
            <th>Tehnik steril</th>
            <td>{{ $igd_ISK0104 }}</td>
            <td>{{ $int_ISK0104 }}</td>
            <td>{{ $ok_ISK0104 }}</td>
            <td>{{ $lt2_ISK0104 }}</td>
            <td>{{ $lt4_ISK0104 }}</td>
            <td>{{ $lt5_ISK0104 }}</td>
            <td>{{ $vk_ISK0104 }}</td>
        </tr>
        <tr>
            <th class="text-center h4">Bundle Maintenance</th>
            <th colspan="7"></th>
        </tr>
        <tr>
            <th>Hand hygiene</th>
            <td>{{ $igd_ISK0201 }}</td>
            <td>{{ $int_ISK0201 }}</td>
            <td>{{ $ok_ISK0201 }}</td>
            <td>{{ $lt2_ISK0201 }}</td>
            <td>{{ $lt4_ISK0201 }}</td>
            <td>{{ $lt5_ISK0201 }}</td>
            <td>{{ $vk_ISK0201 }}</td>
        </tr>
        <tr>
            <th>Perawatan cateter perineal setiap hari sesudah BAB</th>
            <td>{{ $igd_ISK0202 }}</td>
            <td>{{ $int_ISK0202 }}</td>
            <td>{{ $ok_ISK0202 }}</td>
            <td>{{ $lt2_ISK0202 }}</td>
            <td>{{ $lt4_ISK0202 }}</td>
            <td>{{ $lt5_ISK0202 }}</td>
            <td>{{ $vk_ISK0202 }}</td>
        </tr>
        <tr>
            <th>Urine bag tidak dilantai</th>
            <td>{{ $igd_ISK0203 }}</td>
            <td>{{ $int_ISK0203 }}</td>
            <td>{{ $ok_ISK0203 }}</td>
            <td>{{ $lt2_ISK0203 }}</td>
            <td>{{ $lt4_ISK0203 }}</td>
            <td>{{ $lt5_ISK0203 }}</td>
            <td>{{ $vk_ISK0203 }}</td>
        </tr>
        <tr>
            <th>Urine bag lebih rendah dari kandung kemih</th>
            <td>{{ $igd_ISK0204 }}</td>
            <td>{{ $int_ISK0204 }}</td>
            <td>{{ $ok_ISK0204 }}</td>
            <td>{{ $lt2_ISK0204 }}</td>
            <td>{{ $lt4_ISK0204 }}</td>
            <td>{{ $lt5_ISK0204 }}</td>
            <td>{{ $vk_ISK0204 }}</td>
        </tr>
        <tr>
            <td colspan="8"></td>
        </tr>
        <tr>
            <th>Jumlah</th>
            <td>{{ $igd_jumlah }}</td>
            <td>{{ $int_jumlah }}</td>
            <td>{{ $ok_jumlah }}</td>
            <td>{{ $lt2_jumlah }}</td>
            <td>{{ $lt4_jumlah }}</td>
            <td>{{ $lt5_jumlah }}</td>
            <td>{{ $vk_jumlah }}</td>
        </tr>
        <tr>
            <th>Persentase</th>
            <td>{{ ($igd_jumlah != 0 && $denominator_igd != 0) ? number_format(($igd_jumlah / $denominator_igd)
                *
                100, 2) : 0 }} %</td>
            <td>{{ ($int_jumlah != 0 && $denominator_int != 0) ? number_format(($int_jumlah / $denominator_int)
                *
                100, 2) : 0 }} %</td>
            <td>{{ ($ok_jumlah != 0 && $denominator_ok != 0) ? number_format(($ok_jumlah / $denominator_ok) *
                100, 2) : 0 }} %</td>
            <td>{{ ($lt2_jumlah != 0 && $denominator_lt2 != 0) ? number_format(($lt2_jumlah / $denominator_lt2)
                *
                100, 2) : 0 }} %</td>
            <td>{{ ($lt4_jumlah != 0 && $denominator_lt4 != 0) ? number_format(($lt4_jumlah / $denominator_lt4)
                *
                100, 2) : 0 }} %</td>
            <td>{{ ($lt5_jumlah != 0 && $denominator_lt5 != 0) ? number_format(($lt5_jumlah / $denominator_lt5)
                *
                100, 2) : 0 }} %</td>
            <td>{{ ($vk_jumlah != 0 && $denominator_vk != 0) ? number_format(($vk_jumlah / $denominator_vk) *
                100, 2) : 0 }} %</td>
        </tr>
    </tbody>
</table>

<table class="table">
    <thead>
        <tr>
            <th colspan="2">Analisa</th>
            <th colspan="3">Tindak Lanjut</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            @foreach($rekap as $rekaps)
            <td colspan="2">{{ $rekaps->analisa }}</td>
            <td colspan="3">{{ $rekaps->tindak_lanjut }}</td>
            @endforeach
        </tr>
    </tbody>
</table>

<table class="table">
    <tr>
        <td colspan="1"></td>
        <td colspan="5"></td>
        <td colspan="2">Mengetahui,</td>
    </tr>
    <tr>
        <td>IPCN</td>
        <td colspan="5"><br></td>
        <td colspan="2">Ketua Tim PPI</td>
    </tr>
    <tr>
        <td colspan="8"> </td>
    </tr>
    <tr>
        <td colspan="8"> </td>
    </tr>
    <tr>
        <td colspan="8"> </td>
    </tr>
    <tr>
        <td colspan="8"> </td>
    </tr>
    <tr>
        <td colspan="8"> </td>
    </tr>
    <tr>
        <td>Susilowati</td>
        <td colspan="5"><br></td>
        <td colspan="2">dr. Yovita Amalia Wijaya</td>
    </tr>
    <tr>
        <td colspan="8"> </td>
    </tr>
    <tr>
        <td colspan="8"> </td>
    </tr>
    <tr>
        <td colspan="8">Menyetujui,</td>
    </tr>
    <tr>
        <td colspan="8">Direktur</td>
    </tr>
    <tr>
        <td colspan="8"> </td>
    </tr>
    <tr>
        <td colspan="8"> </td>
    </tr>
    <tr>
        <td colspan="8"> </td>
    </tr>
    <tr>
        <td colspan="8"> </td>
    </tr>
    <tr>
        <td colspan="8"> </td>
    </tr>
    <tr>
        <td colspan="8">dr. Ong Felin Sinaga, M.K.M.</td>
    </tr>
</table>