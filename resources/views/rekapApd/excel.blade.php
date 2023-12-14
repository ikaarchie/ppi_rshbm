<table class="table">
    <tr>
        <th colspan="12">Data Rekap Cuci Tangan</th>
    </tr>
    <tr>
        <td colspan="12">{{ $tanggal }}</td>
    </tr>
</table>

<table class="table">
    <thead>
        <tr>
            <th></th>
            <th>Sebelum kontak pasien</th>
            <th>Sebelum tindakan aseptik</th>
            <th>Setelah kontak cairan tubuh pasien</th>
            <th>Setelah kontak pasien</th>
            <th>Setelah kontak lingkungan pasien</th>
            <th>HR</th>
            <th>HW</th>
            <th>Gagal</th>
            <th>ST</th>
            <th>Jumlah</th>
            <th>Persentase</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th>CSSU</th>
            <td>{{ $cssu_sbl_kon_psn }}</td>
            <td>{{ $cssu_sbl_tin_aseptik }}</td>
            <td>{{ $cssu_stl_kon_cairan }}</td>
            <td>{{ $cssu_stl_kon_psn }}</td>
            <td>{{ $cssu_stl_kon_ling_psn }}</td>
            <td>{{ $cssu_hr }}</td>
            <td>{{ $cssu_hw }}</td>
            <td>{{ $cssu_gagal }}</td>
            <td>{{ $cssu_st }}</td>
            <td>{{ $cssu_jumlah }}</td>
            <td>{{ ($cssu_jumlah != 0 && $denominator_cssu != 0) ? number_format(($cssu_jumlah / $denominator_cssu) *
                100,
                2) : 0 }} %</td>
        </tr>
        <tr>
            <th>Dapur</th>
            <td>{{ $dapur_sbl_kon_psn }}</td>
            <td>{{ $dapur_sbl_tin_aseptik }}</td>
            <td>{{ $dapur_stl_kon_cairan }}</td>
            <td>{{ $dapur_stl_kon_psn }}</td>
            <td>{{ $dapur_stl_kon_ling_psn }}</td>
            <td>{{ $dapur_hr }}</td>
            <td>{{ $dapur_hw }}</td>
            <td>{{ $dapur_gagal }}</td>
            <td>{{ $dapur_st }}</td>
            <td>{{ $dapur_jumlah }}</td>
            <td>{{ ($dapur_jumlah != 0 && $denominator_dapur != 0) ? number_format(($dapur_jumlah / $denominator_dapur)
                *
                100, 2) : 0 }} %</td>
        </tr>
        <tr>
            <th>DPJP</th>
            <td>{{ $dpjp_sbl_kon_psn }}</td>
            <td>{{ $dpjp_sbl_tin_aseptik }}</td>
            <td>{{ $dpjp_stl_kon_cairan }}</td>
            <td>{{ $dpjp_stl_kon_psn }}</td>
            <td>{{ $dpjp_stl_kon_ling_psn }}</td>
            <td>{{ $dpjp_hr }}</td>
            <td>{{ $dpjp_hw }}</td>
            <td>{{ $dpjp_gagal }}</td>
            <td>{{ $dpjp_st }}</td>
            <td>{{ $dpjp_jumlah }}</td>
            <td>{{ ($dpjp_jumlah != 0 && $denominator_dpjp != 0) ? number_format(($dpjp_jumlah / $denominator_dpjp) *
                100,
                2) : 0 }} %</td>
        </tr>
        <tr>
            <th>Farmasi</th>
            <td>{{ $farmasi_sbl_kon_psn }}</td>
            <td>{{ $farmasi_sbl_tin_aseptik }}</td>
            <td>{{ $farmasi_stl_kon_cairan }}</td>
            <td>{{ $farmasi_stl_kon_psn }}</td>
            <td>{{ $farmasi_stl_kon_ling_psn }}</td>
            <td>{{ $farmasi_hr }}</td>
            <td>{{ $farmasi_hw }}</td>
            <td>{{ $farmasi_gagal }}</td>
            <td>{{ $farmasi_st }}</td>
            <td>{{ $farmasi_jumlah }}</td>
            <td>{{ ($farmasi_jumlah != 0 && $denominator_farmasi != 0) ? number_format(($farmasi_jumlah /
                $denominator_farmasi) * 100, 2) : 0 }} %</td>
        </tr>
        <tr>
            <th>IGD</th>
            <td>{{ $igd_sbl_kon_psn }}</td>
            <td>{{ $igd_sbl_tin_aseptik }}</td>
            <td>{{ $igd_stl_kon_cairan }}</td>
            <td>{{ $igd_stl_kon_psn }}</td>
            <td>{{ $igd_stl_kon_ling_psn }}</td>
            <td>{{ $igd_hr }}</td>
            <td>{{ $igd_hw }}</td>
            <td>{{ $igd_gagal }}</td>
            <td>{{ $igd_st }}</td>
            <td>{{ $igd_jumlah }}</td>
            <td>{{ ($igd_jumlah != 0 && $denominator_igd != 0) ? number_format(($igd_jumlah / $denominator_igd) * 100,
                2)
                : 0 }} %</td>
        </tr>
        <tr>
            <th>Intensif</th>
            <td>{{ $int_sbl_kon_psn }}</td>
            <td>{{ $int_sbl_tin_aseptik }}</td>
            <td>{{ $int_stl_kon_cairan }}</td>
            <td>{{ $int_stl_kon_psn }}</td>
            <td>{{ $int_stl_kon_ling_psn }}</td>
            <td>{{ $int_hr }}</td>
            <td>{{ $int_hw }}</td>
            <td>{{ $int_gagal }}</td>
            <td>{{ $int_st }}</td>
            <td>{{ $int_jumlah }}</td>
            <td>{{ ($int_jumlah != 0 && $denominator_int != 0) ? number_format(($int_jumlah / $denominator_int) * 100,
                2)
                : 0 }} %</td>
        </tr>
        <tr>
            <th>KBBL</th>
            <td>{{ $kbbl_sbl_kon_psn }}</td>
            <td>{{ $kbbl_sbl_tin_aseptik }}</td>
            <td>{{ $kbbl_stl_kon_cairan }}</td>
            <td>{{ $kbbl_stl_kon_psn }}</td>
            <td>{{ $kbbl_stl_kon_ling_psn }}</td>
            <td>{{ $kbbl_hr }}</td>
            <td>{{ $kbbl_hw }}</td>
            <td>{{ $kbbl_gagal }}</td>
            <td>{{ $kbbl_st }}</td>
            <td>{{ $kbbl_jumlah }}</td>
            <td>{{ ($kbbl_jumlah != 0 && $denominator_kbbl != 0) ? number_format(($kbbl_jumlah / $denominator_kbbl) *
                100,
                2) : 0 }} %</td>
        </tr>
        <tr>
            <th>Laboratorium</th>
            <td>{{ $lab_sbl_kon_psn }}</td>
            <td>{{ $lab_sbl_tin_aseptik }}</td>
            <td>{{ $lab_stl_kon_cairan }}</td>
            <td>{{ $lab_stl_kon_psn }}</td>
            <td>{{ $lab_stl_kon_ling_psn }}</td>
            <td>{{ $lab_hr }}</td>
            <td>{{ $lab_hw }}</td>
            <td>{{ $lab_gagal }}</td>
            <td>{{ $lab_st }}</td>
            <td>{{ $lab_jumlah }}</td>
            <td>{{ ($lab_jumlah != 0 && $denominator_lab != 0) ? number_format(($lab_jumlah / $denominator_lab) * 100,
                2)
                : 0 }} %</td>
        </tr>
        <tr>
            <th>Laundry</th>
            <td>{{ $laundry_sbl_kon_psn }}</td>
            <td>{{ $laundry_sbl_tin_aseptik }}</td>
            <td>{{ $laundry_stl_kon_cairan }}</td>
            <td>{{ $laundry_stl_kon_psn }}</td>
            <td>{{ $laundry_stl_kon_ling_psn }}</td>
            <td>{{ $laundry_hr }}</td>
            <td>{{ $laundry_hw }}</td>
            <td>{{ $laundry_gagal }}</td>
            <td>{{ $laundry_st }}</td>
            <td>{{ $laundry_jumlah }}</td>
            <td>{{ ($laundry_jumlah != 0 && $denominator_laundry != 0) ? number_format(($laundry_jumlah /
                $denominator_laundry) * 100, 2) : 0 }} %</td>
        </tr>
        <tr>
            <th>OK</th>
            <td>{{ $ok_sbl_kon_psn }}</td>
            <td>{{ $ok_sbl_tin_aseptik }}</td>
            <td>{{ $ok_stl_kon_cairan }}</td>
            <td>{{ $ok_stl_kon_psn }}</td>
            <td>{{ $ok_stl_kon_ling_psn }}</td>
            <td>{{ $ok_hr }}</td>
            <td>{{ $ok_hw }}</td>
            <td>{{ $ok_gagal }}</td>
            <td>{{ $ok_st }}</td>
            <td>{{ $ok_jumlah }}</td>
            <td>{{ ($ok_jumlah != 0 && $denominator_ok != 0) ? number_format(($ok_jumlah / $denominator_ok) * 100, 2) :
                0
                }} %</td>
        </tr>
        <tr>
            <th>Perawatan Eksekutif lt.2</th>
            <td>{{ $lt2_sbl_kon_psn }}</td>
            <td>{{ $lt2_sbl_tin_aseptik }}</td>
            <td>{{ $lt2_stl_kon_cairan }}</td>
            <td>{{ $lt2_stl_kon_psn }}</td>
            <td>{{ $lt2_stl_kon_ling_psn }}</td>
            <td>{{ $lt2_hr }}</td>
            <td>{{ $lt2_hw }}</td>
            <td>{{ $lt2_gagal }}</td>
            <td>{{ $lt2_st }}</td>
            <td>{{ $lt2_jumlah }}</td>
            <td>{{ ($lt2_jumlah != 0 && $denominator_lt2 != 0) ? number_format(($lt2_jumlah / $denominator_lt2) * 100,
                2)
                : 0 }} %</td>
        </tr>
        <tr>
            <th>Perawatan Reguler lt.4</th>
            <td>{{ $lt4_sbl_kon_psn }}</td>
            <td>{{ $lt4_sbl_tin_aseptik }}</td>
            <td>{{ $lt4_stl_kon_cairan }}</td>
            <td>{{ $lt4_stl_kon_psn }}</td>
            <td>{{ $lt4_stl_kon_ling_psn }}</td>
            <td>{{ $lt4_hr }}</td>
            <td>{{ $lt4_hw }}</td>
            <td>{{ $lt4_gagal }}</td>
            <td>{{ $lt4_st }}</td>
            <td>{{ $lt4_jumlah }}</td>
            <td>{{ ($lt4_jumlah != 0 && $denominator_lt4 != 0) ? number_format(($lt4_jumlah / $denominator_lt4) * 100,
                2)
                : 0 }} %</td>
        </tr>
        <tr>
            <th>Perawatan Reguler lt.5</th>
            <td>{{ $lt5_sbl_kon_psn }}</td>
            <td>{{ $lt5_sbl_tin_aseptik }}</td>
            <td>{{ $lt5_stl_kon_cairan }}</td>
            <td>{{ $lt5_stl_kon_psn }}</td>
            <td>{{ $lt5_stl_kon_ling_psn }}</td>
            <td>{{ $lt5_hr }}</td>
            <td>{{ $lt5_hw }}</td>
            <td>{{ $lt5_gagal }}</td>
            <td>{{ $lt5_st }}</td>
            <td>{{ $lt5_jumlah }}</td>
            <td>{{ ($lt5_jumlah != 0 && $denominator_lt5 != 0) ? number_format(($lt5_jumlah / $denominator_lt5) * 100,
                2)
                : 0 }} %</td>
        </tr>
        <tr>
            <th>Poliklinik</th>
            <td>{{ $poli_sbl_kon_psn }}</td>
            <td>{{ $poli_sbl_tin_aseptik }}</td>
            <td>{{ $poli_stl_kon_cairan }}</td>
            <td>{{ $poli_stl_kon_psn }}</td>
            <td>{{ $poli_stl_kon_ling_psn }}</td>
            <td>{{ $poli_hr }}</td>
            <td>{{ $poli_hw }}</td>
            <td>{{ $poli_gagal }}</td>
            <td>{{ $poli_st }}</td>
            <td>{{ $poli_jumlah }}</td>
            <td>{{ ($poli_jumlah != 0 && $denominator_poli != 0) ? number_format(($poli_jumlah / $denominator_poli) *
                100,
                2) : 0 }} %</td>
        </tr>
        <tr>
            <th>Radiologi</th>
            <td>{{ $rad_sbl_kon_psn }}</td>
            <td>{{ $rad_sbl_tin_aseptik }}</td>
            <td>{{ $rad_stl_kon_cairan }}</td>
            <td>{{ $rad_stl_kon_psn }}</td>
            <td>{{ $rad_stl_kon_ling_psn }}</td>
            <td>{{ $rad_hr }}</td>
            <td>{{ $rad_hw }}</td>
            <td>{{ $rad_gagal }}</td>
            <td>{{ $rad_st }}</td>
            <td>{{ $rad_jumlah }}</td>
            <td>{{ ($rad_jumlah != 0 && $denominator_rad != 0) ? number_format(($rad_jumlah / $denominator_rad) * 100,
                2)
                : 0 }} %</td>
        </tr>
        <tr>
            <th>VK</th>
            <td>{{ $vk_sbl_kon_psn }}</td>
            <td>{{ $vk_sbl_tin_aseptik }}</td>
            <td>{{ $vk_stl_kon_cairan }}</td>
            <td>{{ $vk_stl_kon_psn }}</td>
            <td>{{ $vk_stl_kon_ling_psn }}</td>
            <td>{{ $vk_hr }}</td>
            <td>{{ $vk_hw }}</td>
            <td>{{ $vk_gagal }}</td>
            <td>{{ $vk_st }}</td>
            <td>{{ $vk_jumlah }}</td>
            <td>{{ ($vk_jumlah != 0 && $denominator_vk != 0) ? number_format(($vk_jumlah / $denominator_vk) * 100, 2) :
                0
                }} %</td>
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
            <th colspan="2">Tindak Lanjut</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            @foreach($rekap as $rekaps)
            <td colspan="2">{{ $rekaps->analisa }}</td>
            <td colspan="2">{{ $rekaps->tindak_lanjut }}</td>
            @endforeach
        </tr>
    </tbody>
</table>

<table class="table">
    <tr>
        <td colspan="6"><br></td>
        <td colspan="4">Mengetahui,</td>
    </tr>
    <tr>
        <td>IPCN</td>
        <td colspan="5"><br></td>
        <td colspan="4">Ketua Tim PPI</td>
    </tr>
    <tr>
        <td colspan="10"><br></td>
    </tr>
    <tr>
        <td colspan="10"><br></td>
    </tr>
    <tr>
        <td colspan="10"><br></td>
    </tr>
    <tr>
        <td colspan="10"><br></td>
    </tr>
    <tr>
        <td colspan="10"><br></td>
    </tr>
    <tr>
        <td>Susilowati</td>
        <td colspan="5"><br></td>
        <td colspan="4">dr. Yovita Amalia Wijaya</td>
    </tr>
    <tr>
        <td colspan="10"><br></td>
    </tr>
    <tr>
        <td colspan="10"><br></td>
    </tr>
    <tr>
        <td colspan="10">Menyetujui,</td>
    </tr>
    <tr>
        <td colspan="10">Direktur</td>
    </tr>
    <tr>
        <td colspan="10"><br></td>
    </tr>
    <tr>
        <td colspan="10"><br></td>
    </tr>
    <tr>
        <td colspan="10"><br></td>
    </tr>
    <tr>
        <td colspan="10"><br></td>
    </tr>
    <tr>
        <td colspan="10"><br></td>
    </tr>
    <tr>
        <td colspan="10">dr. Ong Felin Sinaga, M.K.M.</td>
    </tr>
</table>