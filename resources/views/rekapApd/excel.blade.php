<table class="table">
    <tr>
        <th colspan="12">Data Rekap APD</th>
    </tr>
    <tr>
        <td colspan="12">{{ $tanggal }}</td>
    </tr>
</table>

<table class="table">
    <thead>
        <tr>
            <th></th>
            <th>Penutup kepala</th>
            <th>Masker</th>
            <th>Kacamata google / faceshield</th>
            <th>Apron</th>
            <th>Sarung tangan</th>
            <th>Sandal / sepatu boot</th>
            <th>Segera melepas APD selesai melakukan</th>
            <th>Tidak menggantung masker di leher</th>
            <th>Tidak menggunakan sarung tangan sambil menulis / menyentuh lingkungan yang
                tidak direkomendasikan</th>
            <th>Jumlah</th>
            <th>Persentase</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th>CSSU</th>
            <td>{{ $cssu_pntp_kpl }}</td>
            <td>{{ $cssu_masker }}</td>
            <td>{{ $cssu_pntp_wjh }}</td>
            <td>{{ $cssu_apron }}</td>
            <td>{{ $cssu_srg_tgn }}</td>
            <td>{{ $cssu_alas_kaki }}</td>
            <td>{{ $cssu_lps_apd }}</td>
            <td>{{ $cssu_tdk_gtg_masker }}</td>
            <td>{{ $cssu_tdk_guna_srg_tgn }}</td>
            <td>{{ $cssu_jumlah }}</td>
            <td>{{ ($cssu_jumlah != 0 && $denominator_cssu != 0) ? number_format(($cssu_jumlah / $denominator_cssu) *
                100,
                2) : 0 }} %</td>
        </tr>
        <tr>
            <th>Dapur</th>
            <td>{{ $dapur_pntp_kpl }}</td>
            <td>{{ $dapur_masker }}</td>
            <td>{{ $dapur_pntp_wjh }}</td>
            <td>{{ $dapur_apron }}</td>
            <td>{{ $dapur_srg_tgn }}</td>
            <td>{{ $dapur_alas_kaki }}</td>
            <td>{{ $dapur_lps_apd }}</td>
            <td>{{ $dapur_tdk_gtg_masker }}</td>
            <td>{{ $dapur_tdk_guna_srg_tgn }}</td>
            <td>{{ $dapur_jumlah }}</td>
            <td>{{ ($dapur_jumlah != 0 && $denominator_dapur != 0) ? number_format(($dapur_jumlah / $denominator_dapur)
                *
                100, 2) : 0 }} %</td>
        </tr>
        <tr>
            <th>DPJP</th>
            <td>{{ $dpjp_pntp_kpl }}</td>
            <td>{{ $dpjp_masker }}</td>
            <td>{{ $dpjp_pntp_wjh }}</td>
            <td>{{ $dpjp_apron }}</td>
            <td>{{ $dpjp_srg_tgn }}</td>
            <td>{{ $dpjp_alas_kaki }}</td>
            <td>{{ $dpjp_lps_apd }}</td>
            <td>{{ $dpjp_tdk_gtg_masker }}</td>
            <td>{{ $dpjp_tdk_guna_srg_tgn }}</td>
            <td>{{ $dpjp_jumlah }}</td>
            <td>{{ ($dpjp_jumlah != 0 && $denominator_dpjp != 0) ? number_format(($dpjp_jumlah / $denominator_dpjp) *
                100,
                2) : 0 }} %</td>
        </tr>
        <tr>
            <th>Farmasi</th>
            <td>{{ $farmasi_pntp_kpl }}</td>
            <td>{{ $farmasi_masker }}</td>
            <td>{{ $farmasi_pntp_wjh }}</td>
            <td>{{ $farmasi_apron }}</td>
            <td>{{ $farmasi_srg_tgn }}</td>
            <td>{{ $farmasi_alas_kaki }}</td>
            <td>{{ $farmasi_lps_apd }}</td>
            <td>{{ $farmasi_tdk_gtg_masker }}</td>
            <td>{{ $farmasi_tdk_guna_srg_tgn }}</td>
            <td>{{ $farmasi_jumlah }}</td>
            <td>{{ ($farmasi_jumlah != 0 && $denominator_farmasi != 0) ? number_format(($farmasi_jumlah /
                $denominator_farmasi) * 100, 2) : 0 }} %</td>
        </tr>
        <tr>
            <th>IGD</th>
            <td>{{ $igd_pntp_kpl }}</td>
            <td>{{ $igd_masker }}</td>
            <td>{{ $igd_pntp_wjh }}</td>
            <td>{{ $igd_apron }}</td>
            <td>{{ $igd_srg_tgn }}</td>
            <td>{{ $igd_alas_kaki }}</td>
            <td>{{ $igd_lps_apd }}</td>
            <td>{{ $igd_tdk_gtg_masker }}</td>
            <td>{{ $igd_tdk_guna_srg_tgn }}</td>
            <td>{{ $igd_jumlah }}</td>
            <td>{{ ($igd_jumlah != 0 && $denominator_igd != 0) ? number_format(($igd_jumlah / $denominator_igd) * 100,
                2)
                : 0 }} %</td>
        </tr>
        <tr>
            <th>Intensif</th>
            <td>{{ $int_pntp_kpl }}</td>
            <td>{{ $int_masker }}</td>
            <td>{{ $int_pntp_wjh }}</td>
            <td>{{ $int_apron }}</td>
            <td>{{ $int_srg_tgn }}</td>
            <td>{{ $int_alas_kaki }}</td>
            <td>{{ $int_lps_apd }}</td>
            <td>{{ $int_tdk_gtg_masker }}</td>
            <td>{{ $int_tdk_guna_srg_tgn }}</td>
            <td>{{ $int_jumlah }}</td>
            <td>{{ ($int_jumlah != 0 && $denominator_int != 0) ? number_format(($int_jumlah / $denominator_int) * 100,
                2)
                : 0 }} %</td>
        </tr>
        <tr>
            <th>KBBL</th>
            <td>{{ $kbbl_pntp_kpl }}</td>
            <td>{{ $kbbl_masker }}</td>
            <td>{{ $kbbl_pntp_wjh }}</td>
            <td>{{ $kbbl_apron }}</td>
            <td>{{ $kbbl_srg_tgn }}</td>
            <td>{{ $kbbl_alas_kaki }}</td>
            <td>{{ $kbbl_lps_apd }}</td>
            <td>{{ $kbbl_tdk_gtg_masker }}</td>
            <td>{{ $kbbl_tdk_guna_srg_tgn }}</td>
            <td>{{ $kbbl_jumlah }}</td>
            <td>{{ ($kbbl_jumlah != 0 && $denominator_kbbl != 0) ? number_format(($kbbl_jumlah / $denominator_kbbl) *
                100,
                2) : 0 }} %</td>
        </tr>
        <tr>
            <th>Laboratorium</th>
            <td>{{ $lab_pntp_kpl }}</td>
            <td>{{ $lab_masker }}</td>
            <td>{{ $lab_pntp_wjh }}</td>
            <td>{{ $lab_apron }}</td>
            <td>{{ $lab_srg_tgn }}</td>
            <td>{{ $lab_alas_kaki }}</td>
            <td>{{ $lab_lps_apd }}</td>
            <td>{{ $lab_tdk_gtg_masker }}</td>
            <td>{{ $lab_tdk_guna_srg_tgn }}</td>
            <td>{{ $lab_jumlah }}</td>
            <td>{{ ($lab_jumlah != 0 && $denominator_lab != 0) ? number_format(($lab_jumlah / $denominator_lab) * 100,
                2)
                : 0 }} %</td>
        </tr>
        <tr>
            <th>Laundry</th>
            <td>{{ $laundry_pntp_kpl }}</td>
            <td>{{ $laundry_masker }}</td>
            <td>{{ $laundry_pntp_wjh }}</td>
            <td>{{ $laundry_apron }}</td>
            <td>{{ $laundry_srg_tgn }}</td>
            <td>{{ $laundry_alas_kaki }}</td>
            <td>{{ $laundry_lps_apd }}</td>
            <td>{{ $laundry_tdk_gtg_masker }}</td>
            <td>{{ $laundry_tdk_guna_srg_tgn }}</td>
            <td>{{ $laundry_jumlah }}</td>
            <td>{{ ($laundry_jumlah != 0 && $denominator_laundry != 0) ? number_format(($laundry_jumlah /
                $denominator_laundry) * 100, 2) : 0 }} %</td>
        </tr>
        <tr>
            <th>OK</th>
            <td>{{ $ok_pntp_kpl }}</td>
            <td>{{ $ok_masker }}</td>
            <td>{{ $ok_pntp_wjh }}</td>
            <td>{{ $ok_apron }}</td>
            <td>{{ $ok_srg_tgn }}</td>
            <td>{{ $ok_alas_kaki }}</td>
            <td>{{ $ok_lps_apd }}</td>
            <td>{{ $ok_tdk_gtg_masker }}</td>
            <td>{{ $ok_tdk_guna_srg_tgn }}</td>
            <td>{{ $ok_jumlah }}</td>
            <td>{{ ($ok_jumlah != 0 && $denominator_ok != 0) ? number_format(($ok_jumlah / $denominator_ok) * 100, 2) :
                0
                }} %</td>
        </tr>
        <tr>
            <th>Perawatan Padma</th>
            <td>{{ $lt2_pntp_kpl }}</td>
            <td>{{ $lt2_masker }}</td>
            <td>{{ $lt2_pntp_wjh }}</td>
            <td>{{ $lt2_apron }}</td>
            <td>{{ $lt2_srg_tgn }}</td>
            <td>{{ $lt2_alas_kaki }}</td>
            <td>{{ $lt2_lps_apd }}</td>
            <td>{{ $lt2_tdk_gtg_masker }}</td>
            <td>{{ $lt2_tdk_guna_srg_tgn }}</td>
            <td>{{ $lt2_jumlah }}</td>
            <td>{{ ($lt2_jumlah != 0 && $denominator_lt2 != 0) ? number_format(($lt2_jumlah / $denominator_lt2) * 100,
                2)
                : 0 }} %</td>
        </tr>
        <tr>
            <th>Perawatan Reguler lt.4</th>
            <td>{{ $lt4_pntp_kpl }}</td>
            <td>{{ $lt4_masker }}</td>
            <td>{{ $lt4_pntp_wjh }}</td>
            <td>{{ $lt4_apron }}</td>
            <td>{{ $lt4_srg_tgn }}</td>
            <td>{{ $lt4_alas_kaki }}</td>
            <td>{{ $lt4_lps_apd }}</td>
            <td>{{ $lt4_tdk_gtg_masker }}</td>
            <td>{{ $lt4_tdk_guna_srg_tgn }}</td>
            <td>{{ $lt4_jumlah }}</td>
            <td>{{ ($lt4_jumlah != 0 && $denominator_lt4 != 0) ? number_format(($lt4_jumlah / $denominator_lt4) * 100,
                2)
                : 0 }} %</td>
        </tr>
        <tr>
            <th>Perawatan Reguler lt.5</th>
            <td>{{ $lt5_pntp_kpl }}</td>
            <td>{{ $lt5_masker }}</td>
            <td>{{ $lt5_pntp_wjh }}</td>
            <td>{{ $lt5_apron }}</td>
            <td>{{ $lt5_srg_tgn }}</td>
            <td>{{ $lt5_alas_kaki }}</td>
            <td>{{ $lt5_lps_apd }}</td>
            <td>{{ $lt5_tdk_gtg_masker }}</td>
            <td>{{ $lt5_tdk_guna_srg_tgn }}</td>
            <td>{{ $lt5_jumlah }}</td>
            <td>{{ ($lt5_jumlah != 0 && $denominator_lt5 != 0) ? number_format(($lt5_jumlah / $denominator_lt5) * 100,
                2)
                : 0 }} %</td>
        </tr>
        <tr>
            <th>Poliklinik</th>
            <td>{{ $poli_pntp_kpl }}</td>
            <td>{{ $poli_masker }}</td>
            <td>{{ $poli_pntp_wjh }}</td>
            <td>{{ $poli_apron }}</td>
            <td>{{ $poli_srg_tgn }}</td>
            <td>{{ $poli_alas_kaki }}</td>
            <td>{{ $poli_lps_apd }}</td>
            <td>{{ $poli_tdk_gtg_masker }}</td>
            <td>{{ $poli_tdk_guna_srg_tgn }}</td>
            <td>{{ $poli_jumlah }}</td>
            <td>{{ ($poli_jumlah != 0 && $denominator_poli != 0) ? number_format(($poli_jumlah / $denominator_poli) *
                100,
                2) : 0 }} %</td>
        </tr>
        <tr>
            <th>Radiologi</th>
            <td>{{ $rad_pntp_kpl }}</td>
            <td>{{ $rad_masker }}</td>
            <td>{{ $rad_pntp_wjh }}</td>
            <td>{{ $rad_apron }}</td>
            <td>{{ $rad_srg_tgn }}</td>
            <td>{{ $rad_alas_kaki }}</td>
            <td>{{ $rad_lps_apd }}</td>
            <td>{{ $rad_tdk_gtg_masker }}</td>
            <td>{{ $rad_tdk_guna_srg_tgn }}</td>
            <td>{{ $rad_jumlah }}</td>
            <td>{{ ($rad_jumlah != 0 && $denominator_rad != 0) ? number_format(($rad_jumlah / $denominator_rad) * 100,
                2)
                : 0 }} %</td>
        </tr>
        <tr>
            <th>VK</th>
            <td>{{ $vk_pntp_kpl }}</td>
            <td>{{ $vk_masker }}</td>
            <td>{{ $vk_pntp_wjh }}</td>
            <td>{{ $vk_apron }}</td>
            <td>{{ $vk_srg_tgn }}</td>
            <td>{{ $vk_alas_kaki }}</td>
            <td>{{ $vk_lps_apd }}</td>
            <td>{{ $vk_tdk_gtg_masker }}</td>
            <td>{{ $vk_tdk_guna_srg_tgn }}</td>
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