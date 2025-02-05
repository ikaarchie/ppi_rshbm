@extends('layouts.AuditCuciTangan')

@section('auditContent')
{{-- <div class="header-waves">
  <div class="container pt-3">
    <h1 class="text-center"><b>REKAP AUDIT CUCI TANGAN</b></h1>
    <h2 class="text-center">Rumah Sakit Hermina Banyumanik Semarang</h2>
  </div>

  <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28"
    preserveAspectRatio="none" shape-rendering="auto">
    <defs>
      <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
    </defs>
    <g class="parallax">
      <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.7" />
      <use xlink:href="#gentle-wave" x="48" y="1" fill="rgba(255,255,255,0.5)" />
      <use xlink:href="#gentle-wave" x="48" y="2" fill="rgba(255,255,255,0.3)" />
      <use xlink:href="#gentle-wave" x="48" y="3" fill="#fff" />
    </g>
  </svg>
</div> --}}

<div class="container justify-content-center mt-1">
  <form action="{{ route('rekapCuciTangan') }}" method="GET">
    <div class="d-grid gap-1 d-sm-flex justify-content-sm-center align-self-center">
      <div class="col-sm-2 text-center">
        <input type="date" name="dari" id="dari" value="{{ request()->get('dari') ?? date('Y-m-d')}}"
          class="form-control input-sm" style="border-color: #43ac2f" required />
      </div>
      <h2 class="text-center">-</h2>
      <div class="col-sm-2 text-center">
        <input type="date" name="sampai" id="sampai" value="{{ request()->get('sampai') ?? date('Y-m-d')}}"
          class="form-control input-sm" style="border-color: #43ac2f" required />
      </div>
      {{-- <div class="col-sm-2 text-center">
        <input type="month" name="filter_bulan" id="filter_bulan"
          value="{{ request()->get('filter_bulan') ?? date('Y-m')}}" class="form-control input-sm"
          style="border-color: #43ac2f" required />
      </div> --}}
      <div class="col-sm-3 text-center">
        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i> Search</button>
        <button formaction="{{ route('excelCuciTangan') }}" class="btn btn-success" type="submit">
          <i class="fa-solid fa-table"></i> Excel</button>
        <button formaction="{{ route('pdfCuciTangan') }}" class="btn btn-danger" type="submit">
          <i class="fa-solid fa-file-pdf"></i> PDF</button>
      </div>
    </div>
    @if($errors->any())
    <div class="alert alert-danger align-items-center text-center" role="33alert">
      <strong>{{$errors->first()}}</strong>
    </div>
    @endif
  </form>
</div>
{{-- {{ $dpjp_jumlah }};<br> --}}
{{-- {{ $no_ok_jumlah }};<br> --}}
{{-- {{ $denominator_dpjp }};<br> --}}
{{-- {{ 100/$range_tgl }};<br> --}}
{{-- {{ number_format(($dpjp_jumlah / $denominator_dpjp) * 100, 2) }}; --}}
{{-- {{ ($dpjp_jumlah != 0 && $denominator_dpjp != 0) ? number_format(($dpjp_jumlah / $denominator_dpjp) * 100, 2) : 0
}}; --}}

<div class="container-fluid align-item-center justify-content-center mt-1 mb-3 px-5">
  <div class="table-responsive table-data tbl-fixed">
    <table class="table table-bordered border-dark align-middle">
      <thead class="sticky-cucitangan text-dark text-center align-middle">
        <tr>
          <th></th>
          <th width="9%">Sebelum kontak</br>pasien</th>
          <th width="9%">Sebelum tindakan</br>aseptik</th>
          <th width="9%">Setelah kontak</br>cairan tubuh pasien</th>
          <th width="9%">Setelah kontak</br>pasien</th>
          <th width="9%">Setelah kontak</br>lingkungan pasien</th>
          <th width="5%">HR</th>
          <th width="5%">HW</th>
          <th width="5%">Gagal</th>
          <th width="5%">ST</th>
          <th width="5%">Jumlah</th>
          <th width="5%">N</th>
          <th width="5%">D</th>
          <th width="5%">Persentase</th>
        </tr>
      </thead>
      <tbody style="background-color: #C8E6C9">
        <tr>
          <th colspan="14">
            <h4><strong>Data per unit</strong></h4>
          </th>
        </tr>
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
          <td>{{ $cssu_jumlah }}</td>
          <td>{{ $denominator_cssu }}</td>
          <td>{{ ($cssu_jumlah != 0 && $denominator_cssu != 0) ? number_format(($cssu_jumlah / $denominator_cssu) * 100,
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
          <td>{{ $dapur_jumlah }}</td>
          <td>{{ $denominator_dapur }}</td>
          <td>{{ ($dapur_jumlah != 0 && $denominator_dapur != 0) ? number_format(($dapur_jumlah / $denominator_dapur) *
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
          <td>{{ $dpjp_jumlah }}</td>
          <td>{{ $denominator_dpjp }}</td>
          <td>{{ ($dpjp_jumlah != 0 && $denominator_dpjp != 0) ? number_format(($dpjp_jumlah / $denominator_dpjp) * 100,
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
          <td>{{ $farmasi_jumlah }}</td>
          <td>{{ $denominator_farmasi }}</td>
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
          <td>{{ $igd_jumlah }}</td>
          <td>{{ $denominator_igd }}</td>
          <td>{{ ($igd_jumlah != 0 && $denominator_igd != 0) ? number_format(($igd_jumlah / $denominator_igd) * 100, 2)
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
          <td>{{ $int_jumlah }}</td>
          <td>{{ $denominator_int }}</td>
          <td>{{ ($int_jumlah != 0 && $denominator_int != 0) ? number_format(($int_jumlah / $denominator_int) * 100, 2)
            : 0 }} %</td>
        </tr>
        <tr>
          <th>Kebersihan</th>
          <td>{{ $kebersihan_sbl_kon_psn }}</td>
          <td>{{ $kebersihan_sbl_tin_aseptik }}</td>
          <td>{{ $kebersihan_stl_kon_cairan }}</td>
          <td>{{ $kebersihan_stl_kon_psn }}</td>
          <td>{{ $kebersihan_stl_kon_ling_psn }}</td>
          <td>{{ $kebersihan_hr }}</td>
          <td>{{ $kebersihan_hw }}</td>
          <td>{{ $kebersihan_gagal }}</td>
          <td>{{ $kebersihan_st }}</td>
          <td>{{ $kebersihan_jumlah }}</td>
          <td>{{ $kebersihan_jumlah }}</td>
          <td>{{ $denominator_kebersihan }}</td>
          <td>{{ ($kebersihan_jumlah != 0 && $denominator_kebersihan != 0) ? number_format(($kebersihan_jumlah /
            $denominator_kebersihan) * 100, 2) : 0 }} %</td>
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
          <td>{{ $kbbl_jumlah }}</td>
          <td>{{ $denominator_kbbl }}</td>
          <td>{{ ($kbbl_jumlah != 0 && $denominator_kbbl != 0) ? number_format(($kbbl_jumlah / $denominator_kbbl) * 100,
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
          <td>{{ $lab_jumlah }}</td>
          <td>{{ $denominator_lab }}</td>
          <td>{{ ($lab_jumlah != 0 && $denominator_lab != 0) ? number_format(($lab_jumlah / $denominator_lab) * 100, 2)
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
          <td>{{ $laundry_jumlah }}</td>
          <td>{{ $denominator_laundry }}</td>
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
          <td>{{ $ok_jumlah }}</td>
          <td>{{ $denominator_ok }}</td>
          <td>{{ ($ok_jumlah != 0 && $denominator_ok != 0) ? number_format(($ok_jumlah / $denominator_ok) * 100, 2) : 0
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
          <td>{{ $lt2_jumlah }}</td>
          <td>{{ $denominator_lt2 }}</td>
          <td>{{ ($lt2_jumlah != 0 && $denominator_lt2 != 0) ? number_format(($lt2_jumlah / $denominator_lt2) * 100, 2)
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
          <td>{{ $lt4_jumlah }}</td>
          <td>{{ $denominator_lt4 }}</td>
          <td>{{ ($lt4_jumlah != 0 && $denominator_lt4 != 0) ? number_format(($lt4_jumlah / $denominator_lt4) * 100, 2)
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
          <td>{{ $lt5_jumlah }}</td>
          <td>{{ $denominator_lt5 }}</td>
          <td>{{ ($lt5_jumlah != 0 && $denominator_lt5 != 0) ? number_format(($lt5_jumlah / $denominator_lt5) * 100, 2)
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
          <td>{{ $poli_jumlah }}</td>
          <td>{{ $denominator_poli }}</td>
          <td>{{ ($poli_jumlah != 0 && $denominator_poli != 0) ? number_format(($poli_jumlah / $denominator_poli) * 100,
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
          <td>{{ $rad_jumlah }}</td>
          <td>{{ $denominator_rad }}</td>
          <td>{{ ($rad_jumlah != 0 && $denominator_rad != 0) ? number_format(($rad_jumlah / $denominator_rad) * 100, 2)
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
          <td>{{ $vk_jumlah }}</td>
          <td>{{ $denominator_vk }}</td>
          <td>{{ ($vk_jumlah != 0 && $denominator_vk != 0) ? number_format(($vk_jumlah / $denominator_vk) * 100, 2) : 0
            }} %</td>
        </tr>
        <tr>
          <th colspan="14">
            <h4><strong>Data per grup</strong></h4>
          </th>
        </tr>
        <tr>
          <th>Jangmed</th>
          <td>{{ $jangmed_sbl_kon_psn }}</td>
          <td>{{ $jangmed_sbl_tin_aseptik }}</td>
          <td>{{ $jangmed_stl_kon_cairan }}</td>
          <td>{{ $jangmed_stl_kon_psn }}</td>
          <td>{{ $jangmed_stl_kon_ling_psn }}</td>
          <td>{{ $jangmed_hr }}</td>
          <td>{{ $jangmed_hw }}</td>
          <td>{{ $jangmed_gagal }}</td>
          <td>{{ $jangmed_st }}</td>
          <td>{{ $jangmed_jumlah }}</td>
          <td>{{ $jangmed_jumlah }}</td>
          <td>{{ $denominator_jangmed }}</td>
          <td>{{ ($jangmed_jumlah != 0 && $denominator_jangmed != 0) ? number_format(($jangmed_jumlah /
            $denominator_jangmed) * 100, 2) : 0
            }} %</td>
        </tr>
        <tr>
          <th>Jangum</th>
          <td>{{ $jangum_sbl_kon_psn }}</td>
          <td>{{ $jangum_sbl_tin_aseptik }}</td>
          <td>{{ $jangum_stl_kon_cairan }}</td>
          <td>{{ $jangum_stl_kon_psn }}</td>
          <td>{{ $jangum_stl_kon_ling_psn }}</td>
          <td>{{ $jangum_hr }}</td>
          <td>{{ $jangum_hw }}</td>
          <td>{{ $jangum_gagal }}</td>
          <td>{{ $jangum_st }}</td>
          <td>{{ $jangum_jumlah }}</td>
          <td>{{ $jangum_jumlah }}</td>
          <td>{{ $denominator_jangum }}</td>
          <td>{{ ($jangum_jumlah != 0 && $denominator_jangum != 0) ? number_format(($jangum_jumlah /
            $denominator_jangum) * 100, 2) : 0
            }} %</td>
        </tr>
        <tr>
          <th>Keperawatan</th>
          <td>{{ $keperawatan_sbl_kon_psn }}</td>
          <td>{{ $keperawatan_sbl_tin_aseptik }}</td>
          <td>{{ $keperawatan_stl_kon_cairan }}</td>
          <td>{{ $keperawatan_stl_kon_psn }}</td>
          <td>{{ $keperawatan_stl_kon_ling_psn }}</td>
          <td>{{ $keperawatan_hr }}</td>
          <td>{{ $keperawatan_hw }}</td>
          <td>{{ $keperawatan_gagal }}</td>
          <td>{{ $keperawatan_st }}</td>
          <td>{{ $keperawatan_jumlah }}</td>
          <td>{{ $keperawatan_jumlah }}</td>
          <td>{{ $denominator_keperawatan }}</td>
          <td>{{ ($keperawatan_jumlah != 0 && $denominator_keperawatan != 0) ? number_format(($keperawatan_jumlah /
            $denominator_keperawatan) * 100, 2) : 0
            }} %</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<div class="container-fluid justify-content-center py-3">
  <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
    <section class="col-sm-9 align-self-stretch">
      <div class="d-grid gap-3 d-sm-flex justify-content-sm-center align-self-center">
        <section class="col-sm text-start">
          <button class="btn" style="background-color: #43ac2f;" onclick="grafikYA()">DATA YA</button>
          <button class="btn" style="background-color: #43ac2f;" onclick="grafikTIDAK()">DATA TIDAK</button>
        </section>
      </div>
      <section id="ya">
        <canvas id="barYA"></canvas>
      </section>
      <section id="tidak" style="display: none">
        <canvas id="barTIDAK"></canvas>
      </section>
    </section>

    <div class="col-sm-3 align-self-stretch">
      <div class="card" style="border-color: #43ac2f">
        <div class="card-header text-center" style="background-color: #43ac2f;border-color: #43ac2f;">
          <b>Analisa</b>
        </div>
        <div class="card-body">
          @foreach($rekap as $rekaps)
          {{ $rekaps->analisa }}
          @endforeach
        </div>
      </div>

      <div class="card mt-3" style="border-color: #43ac2f">
        <div class="card-header text-center" style="background-color: #43ac2f;border-color: #43ac2f;"><b></b>
          <b>Tindak Lanjut</b>
        </div>
        <div class="card-body">
          @foreach($rekap as $rekaps)
          {{ $rekaps->tindak_lanjut }}
          @endforeach
        </div>
      </div>

      <div class="d-grid gap-1 d-sm-flex justify-content-sm-center mt-3">
        <div class="col-sm-11 d-grid">
          @forelse($rekap as $rekaps)
          <button type="button" data-bs-toggle="modal" data-bs-target="#editRekapCuciTangan{{ $rekaps->id }}"
            class="btn btn-sm btn-warning"><i class="fa-solid fa-pen-to-square"></i>
            <b> Ubah Analisa dan Tindak Lanjut</b>
          </button>
          @include('rekapCuciTangan.edit')
          @empty
          <button type="button" data-bs-toggle="modal" data-bs-target="#tambahRekapCuciTangan"
            class="btn btn-sm btn-primary">
            <i class="fa-solid fa-plus"></i><b> Tambah Analisa dan Tindak Lanjut</b>
          </button>
          @include('rekapCuciTangan.add')
          @endforelse
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid align-item-center justify-content-center py-3">
  <div class="table-responsive table-data tbl-fixed">
    <table class="table table-bordered border-dark align-middle w-100">
      <thead class="sticky-cucitangan text-dark text-center align-middle">
        <tr>
          <th>No</th>
          <th>Nama</th>
          <th>Unit</th>
          <th>Tanggal</th>
          <th>Sebelum kontak pasien</th>
          <th>Sebelum tindakan aseptik</th>
          <th>Setelah kontak cairan tubuh pasien</th>
          <th>Setelah kontak pasien</th>
          <th>Setelah kontak lingkungan pasien</th>
          <th>HR</th>
          <th>HW</th>
          <th>Gagal</th>
          <th>ST</th>
        </tr>
      </thead>
      <tbody style="background-color: #C8E6C9">
        @php $no = 1; @endphp
        @forelse($tabel as $key => $isi)
        <tr>
          <td>{{ $tabel->firstItem() + $key }}</td>
          <td>{{ $isi->nama }}</td>
          <td>{{ $isi->unit }}</td>
          <td>{{ date("d/m/Y", strtotime($isi->tgl_input)) }}</td>
          <td>{{ ($isi->sbl_kon_psn == 1) ? 'Ya' : (($isi->sbl_kon_psn == 0) ? 'Tidak' : 'Tidak dilakukan') }}
          </td>
          <td>{{ ($isi->sbl_tin_aseptik == 1) ? 'Ya' : (($isi->sbl_tin_aseptik == 0) ? 'Tidak' : 'Tidak
            dilakukan') }}</td>
          <td>{{ ($isi->stl_kon_cairan == 1) ? 'Ya' : (($isi->stl_kon_cairan == 0) ? 'Tidak' : 'Tidak
            dilakukan') }}</td>
          <td>{{ ($isi->stl_kon_psn == 1) ? 'Ya' : (($isi->stl_kon_psn == 0) ? 'Tidak' : 'Tidak dilakukan') }}
          </td>
          <td>{{ ($isi->stl_kon_ling_psn == 1) ? 'Ya' : (($isi->stl_kon_ling_psn == 0) ? 'Tidak' : 'Tidak
            dilakukan') }}</td>
          <td>{{ ($isi->hr == 1) ? 'Ya' : (($isi->hr == 0) ? 'Tidak' : 'Tidak dilakukan') }}</td>
          <td>{{ ($isi->hw == 1) ? 'Ya' : (($isi->hw == 0) ? 'Tidak' : 'Tidak dilakukan') }}</td>
          <td>{{ ($isi->gagal == 1) ? 'Ya' : (($isi->gagal == 0) ? 'Tidak' : 'Tidak dilakukan') }}</td>
          <td>{{ ($isi->st == 1) ? 'Ya' : (($isi->st == 0) ? 'Tidak' : 'Tidak dilakukan') }}</td>
        </tr>
        @empty
        <tr>
          <td colspan="21" class="text-center"><b>Tidak ada data</b></td>
        </tr>
        @endforelse
      </tbody>
    </table>

    <div class="btn-toolbar justify-content-between">
      <div>
        {{ $tabel->links() }}
      </div>
    </div>
  </div>
</div>

<script>
  function grafikYA() {
  var div1 = document.getElementById("ya");
  var div2 = document.getElementById("tidak");

  if (div1.style.display === "none") {
    div1.style.display = "block";
    div2.style.display = "none";
  } else {
    div1.style.display = "none";
    div2.style.display = "block";
  }
}
</script>

<script>
  function grafikTIDAK() {
  var div1 = document.getElementById("ya");
  var div2 = document.getElementById("tidak");

  if (div1.style.display === "block") {
    div1.style.display = "none";
    div2.style.display = "block";
  } else {
    div1.style.display = "block";
    div2.style.display = "none";
  }
}
</script>

<script>
  var cssu1 = {
    label: ['CSSU'],
    data: [
        {{ $cssu_sbl_kon_psn }},
        {{ $cssu_sbl_tin_aseptik }},
        {{ $cssu_stl_kon_cairan }},
        {{ $cssu_stl_kon_psn }},
        {{ $cssu_stl_kon_ling_psn }},
        // {{ $cssu_hr }},
        // {{ $cssu_hw }},
        // {{ $cssu_gagal }},
        // {{ $cssu_st }},
    ],
    backgroundColor: [
      'rgba(62, 39, 35, 0.2)'
    ],
    borderColor: [
      'rgb(62, 39, 35)'
    ],
    borderWidth: 1
  };

  var dapur1 = {
    label: ['Dapur'],
    data: [
        {{ $dapur_sbl_kon_psn }},
        {{ $dapur_sbl_tin_aseptik }},
        {{ $dapur_stl_kon_cairan }},
        {{ $dapur_stl_kon_psn }},
        {{ $dapur_stl_kon_ling_psn }},
        // {{ $dapur_hr }},
        // {{ $dapur_hw }},
        // {{ $dapur_gagal }},
        // {{ $dapur_st }},
    ],
    backgroundColor: [
      'rgba(213, 0, 0, 0.2)'
    ],
    borderColor: [
      'rgb(213, 0, 0)'
    ],
    borderWidth: 1
  };

  var dpjp1 = {
    label: ['DPJP'],
    data: [
        {{ $dpjp_sbl_kon_psn }},
        {{ $dpjp_sbl_tin_aseptik }},
        {{ $dpjp_stl_kon_cairan }},
        {{ $dpjp_stl_kon_psn }},
        {{ $dpjp_stl_kon_ling_psn }},
        // {{ $dpjp_hr }},
        // {{ $dpjp_hw }},
        // {{ $dpjp_gagal }},
        // {{ $dpjp_st }},
    ],
    backgroundColor: [
      'rgba(0, 229, 255, 0.2)'
    ],
    borderColor: [
      'rgb(0, 229, 255)'
    ],
    borderWidth: 1
  };

  var farmasi1 = {
    label: ['Farmasi'],
    data: [
        {{ $farmasi_sbl_kon_psn }},
        {{ $farmasi_sbl_tin_aseptik }},
        {{ $farmasi_stl_kon_cairan }},
        {{ $farmasi_stl_kon_psn }},
        {{ $farmasi_stl_kon_ling_psn }},
        // {{ $farmasi_hr }},
        // {{ $farmasi_hw }},
        // {{ $farmasi_gagal }},
        // {{ $farmasi_st }},
    ],
    backgroundColor: [
      'rgba(0, 200, 83, 0.2)'
    ],
    borderColor: [
      'rgb(0, 200, 83)'
    ],
    borderWidth: 1
  };

  var igd1 = {
    label: ['IGD'],
    data: [
        {{ $igd_sbl_kon_psn }},
        {{ $igd_sbl_tin_aseptik }},
        {{ $igd_stl_kon_cairan }},
        {{ $igd_stl_kon_psn }},
        {{ $igd_stl_kon_ling_psn }},
        // {{ $igd_hr }},
        // {{ $igd_hw }},
        // {{ $igd_gagal }},
        // {{ $igd_st }},
    ],
    backgroundColor: [
      'rgba(255, 128, 171, 0.2)'
    ],
    borderColor: [
      'rgb(255, 128, 171)'
    ],
    borderWidth: 1
  };

  var int1 = {
    label: ['Intensif'],
    data: [
        {{ $int_sbl_kon_psn }},
        {{ $int_sbl_tin_aseptik }},
        {{ $int_stl_kon_cairan }},
        {{ $int_stl_kon_psn }},
        {{ $int_stl_kon_ling_psn }},
        // {{ $int_hr }},
        // {{ $int_hw }},
        // {{ $int_gagal }},
        // {{ $int_st }},
    ],
    backgroundColor: [
      'rgba(41, 121, 255, 0.2)'
    ],
    borderColor: [
      'rgb(41, 121, 255)'
    ],
    borderWidth: 1
  };

  var kebersihan1 = {
    label: ['Kebersihan'],
    data: [
        {{ $kebersihan_sbl_kon_psn }},
        {{ $kebersihan_sbl_tin_aseptik }},
        {{ $kebersihan_stl_kon_cairan }},
        {{ $kebersihan_stl_kon_psn }},
        {{ $kebersihan_stl_kon_ling_psn }},
        // {{ $kebersihan_hr }},
        // {{ $kebersihan_hw }},
        // {{ $kebersihan_gagal }},
        // {{ $kebersihan_st }},
    ],
    backgroundColor: [
      'rgba(255, 234, 0, 0.2)'
    ],
    borderColor: [
      'rgb(255, 234, 0)'
    ],
    borderWidth: 1
  };

  var kbbl1 = {
    label: ['KBBL'],
    data: [
        {{ $kbbl_sbl_kon_psn }},
        {{ $kbbl_sbl_tin_aseptik }},
        {{ $kbbl_stl_kon_cairan }},
        {{ $kbbl_stl_kon_psn }},
        {{ $kbbl_stl_kon_ling_psn }},
        // {{ $kbbl_hr }},
        // {{ $kbbl_hw }},
        // {{ $kbbl_gagal }},
        // {{ $kbbl_st }},
    ],
    backgroundColor: [
      'rgba(255, 234, 0, 0.2)'
    ],
    borderColor: [
      'rgb(255, 234, 0)'
    ],
    borderWidth: 1
  };

  var lab1 = {
    label: ['Laboratorium'],
    data: [
        {{ $lab_sbl_kon_psn }},
        {{ $lab_sbl_tin_aseptik }},
        {{ $lab_stl_kon_cairan }},
        {{ $lab_stl_kon_psn }},
        {{ $lab_stl_kon_ling_psn }},
        // {{ $lab_hr }},
        // {{ $lab_hw }},
        // {{ $lab_gagal }},
        // {{ $lab_st }},
    ],
    backgroundColor: [
      'rgba(170, 0, 255, 0.2)'
    ],
    borderColor: [
      'rgb(170, 0, 255)'
    ],
    borderWidth: 1
  };

  var laundry1 = {
    label: ['Laundry'],
    data: [
        {{ $laundry_sbl_kon_psn }},
        {{ $laundry_sbl_tin_aseptik }},
        {{ $laundry_stl_kon_cairan }},
        {{ $laundry_stl_kon_psn }},
        {{ $laundry_stl_kon_ling_psn }},
        // {{ $laundry_hr }},
        // {{ $laundry_hw }},
        // {{ $laundry_gagal }},
        // {{ $laundry_st }},
    ],
    backgroundColor: [
      'rgba(0, 176, 255, 0.2)'
    ],
    borderColor: [
      'rgb(0, 176, 255)'
    ],
    borderWidth: 1
  };

  var ok1 = {
    label: ['OK'],
    data: [
        {{ $ok_sbl_kon_psn }},
        {{ $ok_sbl_tin_aseptik }},
        {{ $ok_stl_kon_cairan }},
        {{ $ok_stl_kon_psn }},
        {{ $ok_stl_kon_ling_psn }},
        // {{ $ok_hr }},
        // {{ $ok_hw }},
        // {{ $ok_gagal }},
        // {{ $ok_st }},
    ],
    backgroundColor: [
      'rgba(255, 109, 0, 0.2)'
    ],
    borderColor: [
      'rgb(255, 109, 0)'
    ],
    borderWidth: 1
  };

  var lt21 = {
    label: ['Perawatan Eksekutif lt.2'],
    data: [
        {{ $lt2_sbl_kon_psn }},
        {{ $lt2_sbl_tin_aseptik }},
        {{ $lt2_stl_kon_cairan }},
        {{ $lt2_stl_kon_psn }},
        {{ $lt2_stl_kon_ling_psn }},
        // {{ $lt2_hr }},
        // {{ $lt2_hw }},
        // {{ $lt2_gagal }},
        // {{ $lt2_st }},
    ],
    backgroundColor: [
      'rgba(198, 255, 0, 0.2)'
    ],
    borderColor: [
      'rgb(198, 255, 0)'
    ],
    borderWidth: 1
  };

  var lt41 = {
    label: ['Perawatan Reguler lt.4'],
    data: [
        {{ $lt4_sbl_kon_psn }},
        {{ $lt4_sbl_tin_aseptik }},
        {{ $lt4_stl_kon_cairan }},
        {{ $lt4_stl_kon_psn }},
        {{ $lt4_stl_kon_ling_psn }},
        // {{ $lt4_hr }},
        // {{ $lt4_hw }},
        // {{ $lt4_gagal }},
        // {{ $lt4_st }},
    ],
    backgroundColor: [
      'rgba(213, 0, 249, 0.2)'
    ],
    borderColor: [
      'rgb(213, 0, 249)'
    ],
    borderWidth: 1
  };

  var lt51 = {
    label: ['Perawatan Reguler lt.5'],
    data: [
        {{ $lt5_sbl_kon_psn }},
        {{ $lt5_sbl_tin_aseptik }},
        {{ $lt5_stl_kon_cairan }},
        {{ $lt5_stl_kon_psn }},
        {{ $lt5_stl_kon_ling_psn }},
        // {{ $lt5_hr }},
        // {{ $lt5_hw }},
        // {{ $lt5_gagal }},
        // {{ $lt5_st }},
    ],
    backgroundColor: [
      'rgba(61, 90, 254, 0.2)'
    ],
    borderColor: [
      'rgb(61, 90, 254)'
    ],
    borderWidth: 1
  };

  var poli1 = {
    label: ['Poliklinik'],
    data: [
        {{ $poli_sbl_kon_psn }},
        {{ $poli_sbl_tin_aseptik }},
        {{ $poli_stl_kon_cairan }},
        {{ $poli_stl_kon_psn }},
        {{ $poli_stl_kon_ling_psn }},
        // {{ $poli_hr }},
        // {{ $poli_hw }},
        // {{ $poli_gagal }},
        // {{ $poli_st }},
    ],
    backgroundColor: [
      'rgba(29, 233, 182, 0.2)'
    ],
    borderColor: [
      'rgb(29, 233, 182)'
    ],
    borderWidth: 1
  };

  var rad1 = {
    label: ['Radiologi'],
    data: [
        {{ $rad_sbl_kon_psn }},
        {{ $rad_sbl_tin_aseptik }},
        {{ $rad_stl_kon_cairan }},
        {{ $rad_stl_kon_psn }},
        {{ $rad_stl_kon_ling_psn }},
        // {{ $rad_hr }},
        // {{ $rad_hw }},
        // {{ $rad_gagal }},
        // {{ $rad_st }},
    ],
    backgroundColor: [
      'rgba(98, 0, 234, 0.2)'
    ],
    borderColor: [
      'rgb(98, 0, 234)'
    ],
    borderWidth: 1
  };

  var vk1 = {
    label: ['VK'],
    data: [
        {{ $vk_sbl_kon_psn }},
        {{ $vk_sbl_tin_aseptik }},
        {{ $vk_stl_kon_cairan }},
        {{ $vk_stl_kon_psn }},
        {{ $vk_stl_kon_ling_psn }},
        // {{ $vk_hr }},
        // {{ $vk_hw }},
        // {{ $vk_gagal }},
        // {{ $vk_st }},
    ],
    backgroundColor: [
      'rgba(255, 171, 0, 0.2)'
    ],
    borderColor: [
      'rgb(255, 171, 0)'
    ],
    borderWidth: 1
  };

  var barData1 = {
    labels: [
      ['Sebelum', 'Kontak Pasien'],
      ['Sebelum', 'Tindakan Aseptik'],
      ['Setelah Kontak', 'Cairan Tubuh Pasien'],
      ['Setelah', 'Kontak Pasien'],
      ['Setelah Kontak', 'Lingkungan Pasien'],
      // ['HR'],
      // ['HW'],
      // ['Gagal'],
      // ['ST'],
    ],
    datasets: [
      cssu1, 
      dapur1, 
      dpjp1, 
      farmasi1, 
      igd1,
      int1,
      kebersihan1,
      kbbl1,
      lab1,
      laundry1,
      ok1,
      lt21,
      lt41,
      lt51,
      poli1,
      rad1,
      vk1,
    ]
  };

  var config = {
    type: 'bar',
    data: barData1,
    options: {
      responsive: true,
      plugins: {
        title: {
          display: true,
          text: 'GRAFIK DATA YA',
          padding: {
            top: 10,
            bottom: 10
          },
          font: {
            size: 40
          }
        },
        tooltip: {
          callbacks: {
            title: (context) => {
              // console.log(context[0].label);
              return context[0].label.replaceAll(',', ' ');
            }
          }
        }
      },
      categoryPercentage: 0.8,
      barPercentage: 0.8,
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  };
  
  const barYA = new Chart(
    document.getElementById('barYA'),
    config
    );
</script>

<script>
  var cssu0 = {
    label: ['CSSU'],
    data: [
        {{ $no_cssu_sbl_kon_psn }},
        {{ $no_cssu_sbl_tin_aseptik }},
        {{ $no_cssu_stl_kon_cairan }},
        {{ $no_cssu_stl_kon_psn }},
        {{ $no_cssu_stl_kon_ling_psn }},
        // {{ $no_cssu_hr }},
        // {{ $no_cssu_hw }},
        // {{ $no_cssu_gagal }},
        // {{ $no_cssu_st }},
    ],
    backgroundColor: [
      'rgba(62, 39, 35, 0.2)'
    ],
    borderColor: [
      'rgb(62, 39, 35)'
    ],
    borderWidth: 1
  };

  var dapur0 = {
    label: ['Dapur'],
    data: [
        {{ $no_dapur_sbl_kon_psn }},
        {{ $no_dapur_sbl_tin_aseptik }},
        {{ $no_dapur_stl_kon_cairan }},
        {{ $no_dapur_stl_kon_psn }},
        {{ $no_dapur_stl_kon_ling_psn }},
        // {{ $no_dapur_hr }},
        // {{ $no_dapur_hw }},
        // {{ $no_dapur_gagal }},
        // {{ $no_dapur_st }},
    ],
    backgroundColor: [
      'rgba(213, 0, 0, 0.2)'
    ],
    borderColor: [
      'rgb(213, 0, 0)'
    ],
    borderWidth: 1
  };

  var dpjp0 = {
    label: ['DPJP'],
    data: [
        {{ $no_dpjp_sbl_kon_psn }},
        {{ $no_dpjp_sbl_tin_aseptik }},
        {{ $no_dpjp_stl_kon_cairan }},
        {{ $no_dpjp_stl_kon_psn }},
        {{ $no_dpjp_stl_kon_ling_psn }},
        // {{ $no_dpjp_hr }},
        // {{ $no_dpjp_hw }},
        // {{ $no_dpjp_gagal }},
        // {{ $no_dpjp_st }},
    ],
    backgroundColor: [
      'rgba(0, 229, 255, 0.2)'
    ],
    borderColor: [
      'rgb(0, 229, 255)'
    ],
    borderWidth: 1
  };

  var farmasi0 = {
    label: ['Farmasi'],
    data: [
        {{ $no_farmasi_sbl_kon_psn }},
        {{ $no_farmasi_sbl_tin_aseptik }},
        {{ $no_farmasi_stl_kon_cairan }},
        {{ $no_farmasi_stl_kon_psn }},
        {{ $no_farmasi_stl_kon_ling_psn }},
        // {{ $no_farmasi_hr }},
        // {{ $no_farmasi_hw }},
        // {{ $no_farmasi_gagal }},
        // {{ $no_farmasi_st }},
    ],
    backgroundColor: [
      'rgba(0, 200, 83, 0.2)'
    ],
    borderColor: [
      'rgb(0, 200, 83)'
    ],
    borderWidth: 1
  };

  var igd0 = {
    label: ['IGD'],
    data: [
        {{ $no_igd_sbl_kon_psn }},
        {{ $no_igd_sbl_tin_aseptik }},
        {{ $no_igd_stl_kon_cairan }},
        {{ $no_igd_stl_kon_psn }},
        {{ $no_igd_stl_kon_ling_psn }},
        // {{ $no_igd_hr }},
        // {{ $no_igd_hw }},
        // {{ $no_igd_gagal }},
        // {{ $no_igd_st }},
    ],
    backgroundColor: [
      'rgba(255, 128, 171, 0.2)'
    ],
    borderColor: [
      'rgb(255, 128, 171)'
    ],
    borderWidth: 1
  };

  var int0 = {
    label: ['Intensif'],
    data: [
        {{ $no_int_sbl_kon_psn }},
        {{ $no_int_sbl_tin_aseptik }},
        {{ $no_int_stl_kon_cairan }},
        {{ $no_int_stl_kon_psn }},
        {{ $no_int_stl_kon_ling_psn }},
        // {{ $no_int_hr }},
        // {{ $no_int_hw }},
        // {{ $no_int_gagal }},
        // {{ $no_int_st }},
    ],
    backgroundColor: [
      'rgba(41, 121, 255, 0.2)'
    ],
    borderColor: [
      'rgb(41, 121, 255)'
    ],
    borderWidth: 1
  };

  var kebersihan0 = {
    label: ['Kebersihan'],
    data: [
        {{ $no_kebersihan_sbl_kon_psn }},
        {{ $no_kebersihan_sbl_tin_aseptik }},
        {{ $no_kebersihan_stl_kon_cairan }},
        {{ $no_kebersihan_stl_kon_psn }},
        {{ $no_kebersihan_stl_kon_ling_psn }},
        // {{ $no_kebersihan_hr }},
        // {{ $no_kebersihan_hw }},
        // {{ $no_kebersihan_gagal }},
        // {{ $no_kebersihan_st }},
    ],
    backgroundColor: [
      'rgba(255, 234, 0, 0.2)'
    ],
    borderColor: [
      'rgb(255, 234, 0)'
    ],
    borderWidth: 1
  };

  var kbbl0 = {
    label: ['KBBL'],
    data: [
        {{ $no_kbbl_sbl_kon_psn }},
        {{ $no_kbbl_sbl_tin_aseptik }},
        {{ $no_kbbl_stl_kon_cairan }},
        {{ $no_kbbl_stl_kon_psn }},
        {{ $no_kbbl_stl_kon_ling_psn }},
        // {{ $no_kbbl_hr }},
        // {{ $no_kbbl_hw }},
        // {{ $no_kbbl_gagal }},
        // {{ $no_kbbl_st }},
    ],
    backgroundColor: [
      'rgba(255, 234, 0, 0.2)'
    ],
    borderColor: [
      'rgb(255, 234, 0)'
    ],
    borderWidth: 1
  };

  var lab0 = {
    label: ['Laboratorium'],
    data: [
        {{ $no_lab_sbl_kon_psn }},
        {{ $no_lab_sbl_tin_aseptik }},
        {{ $no_lab_stl_kon_cairan }},
        {{ $no_lab_stl_kon_psn }},
        {{ $no_lab_stl_kon_ling_psn }},
        // {{ $no_lab_hr }},
        // {{ $no_lab_hw }},
        // {{ $no_lab_gagal }},
        // {{ $no_lab_st }},
    ],
    backgroundColor: [
      'rgba(170, 0, 255, 0.2)'
    ],
    borderColor: [
      'rgb(170, 0, 255)'
    ],
    borderWidth: 1
  };

  var laundry0 = {
    label: ['Laundry'],
    data: [
        {{ $no_laundry_sbl_kon_psn }},
        {{ $no_laundry_sbl_tin_aseptik }},
        {{ $no_laundry_stl_kon_cairan }},
        {{ $no_laundry_stl_kon_psn }},
        {{ $no_laundry_stl_kon_ling_psn }},
        // {{ $no_laundry_hr }},
        // {{ $no_laundry_hw }},
        // {{ $no_laundry_gagal }},
        // {{ $no_laundry_st }},
    ],
    backgroundColor: [
      'rgba(0, 176, 255, 0.2)'
    ],
    borderColor: [
      'rgb(0, 176, 255)'
    ],
    borderWidth: 1
  };

  var ok0 = {
    label: ['OK'],
    data: [
        {{ $no_ok_sbl_kon_psn }},
        {{ $no_ok_sbl_tin_aseptik }},
        {{ $no_ok_stl_kon_cairan }},
        {{ $no_ok_stl_kon_psn }},
        {{ $no_ok_stl_kon_ling_psn }},
        // {{ $no_ok_hr }},
        // {{ $no_ok_hw }},
        // {{ $no_ok_gagal }},
        // {{ $no_ok_st }},
    ],
    backgroundColor: [
      'rgba(255, 109, 0, 0.2)'
    ],
    borderColor: [
      'rgb(255, 109, 0)'
    ],
    borderWidth: 1
  };

  var lt20 = {
    label: ['Perawatan Eksekutif lt.2'],
    data: [
        {{ $no_lt2_sbl_kon_psn }},
        {{ $no_lt2_sbl_tin_aseptik }},
        {{ $no_lt2_stl_kon_cairan }},
        {{ $no_lt2_stl_kon_psn }},
        {{ $no_lt2_stl_kon_ling_psn }},
        // {{ $no_lt2_hr }},
        // {{ $no_lt2_hw }},
        // {{ $no_lt2_gagal }},
        // {{ $no_lt2_st }},
    ],
    backgroundColor: [
      'rgba(198, 255, 0, 0.2)'
    ],
    borderColor: [
      'rgb(198, 255, 0)'
    ],
    borderWidth: 1
  };

  var lt40 = {
    label: ['Perawatan Reguler lt.4'],
    data: [
        {{ $no_lt4_sbl_kon_psn }},
        {{ $no_lt4_sbl_tin_aseptik }},
        {{ $no_lt4_stl_kon_cairan }},
        {{ $no_lt4_stl_kon_psn }},
        {{ $no_lt4_stl_kon_ling_psn }},
        // {{ $no_lt4_hr }},
        // {{ $no_lt4_hw }},
        // {{ $no_lt4_gagal }},
        // {{ $no_lt4_st }},
    ],
    backgroundColor: [
      'rgba(213, 0, 249, 0.2)'
    ],
    borderColor: [
      'rgb(213, 0, 249)'
    ],
    borderWidth: 1
  };

  var lt50 = {
    label: ['Perawatan Reguler lt.5'],
    data: [
        {{ $no_lt5_sbl_kon_psn }},
        {{ $no_lt5_sbl_tin_aseptik }},
        {{ $no_lt5_stl_kon_cairan }},
        {{ $no_lt5_stl_kon_psn }},
        {{ $no_lt5_stl_kon_ling_psn }},
        // {{ $no_lt5_hr }},
        // {{ $no_lt5_hw }},
        // {{ $no_lt5_gagal }},
        // {{ $no_lt5_st }},
    ],
    backgroundColor: [
      'rgba(61, 90, 254, 0.2)'
    ],
    borderColor: [
      'rgb(61, 90, 254)'
    ],
    borderWidth: 1
  };

  var poli0 = {
    label: ['Poliklinik'],
    data: [
        {{ $no_poli_sbl_kon_psn }},
        {{ $no_poli_sbl_tin_aseptik }},
        {{ $no_poli_stl_kon_cairan }},
        {{ $no_poli_stl_kon_psn }},
        {{ $no_poli_stl_kon_ling_psn }},
        // {{ $no_poli_hr }},
        // {{ $no_poli_hw }},
        // {{ $no_poli_gagal }},
        // {{ $no_poli_st }},
    ],
    backgroundColor: [
      'rgba(29, 233, 182, 0.2)'
    ],
    borderColor: [
      'rgb(29, 233, 182)'
    ],
    borderWidth: 1
  };

  var rad0 = {
    label: ['Radiologi'],
    data: [
        {{ $no_rad_sbl_kon_psn }},
        {{ $no_rad_sbl_tin_aseptik }},
        {{ $no_rad_stl_kon_cairan }},
        {{ $no_rad_stl_kon_psn }},
        {{ $no_rad_stl_kon_ling_psn }},
        // {{ $no_rad_hr }},
        // {{ $no_rad_hw }},
        // {{ $no_rad_gagal }},
        // {{ $no_rad_st }},
    ],
    backgroundColor: [
      'rgba(98, 0, 234, 0.2)'
    ],
    borderColor: [
      'rgb(98, 0, 234)'
    ],
    borderWidth: 1
  };

  var vk0 = {
    label: ['VK'],
    data: [
        {{ $no_vk_sbl_kon_psn }},
        {{ $no_vk_sbl_tin_aseptik }},
        {{ $no_vk_stl_kon_cairan }},
        {{ $no_vk_stl_kon_psn }},
        {{ $no_vk_stl_kon_ling_psn }},
        // {{ $no_vk_hr }},
        // {{ $no_vk_hw }},
        // {{ $no_vk_gagal }},
        // {{ $no_vk_st }},
    ],
    backgroundColor: [
      'rgba(255, 171, 0, 0.2)'
    ],
    borderColor: [
      'rgb(255, 171, 0)'
    ],
    borderWidth: 1
  };

  var barData0 = {
    labels: [
      ['Sebelum', 'Kontak Pasien'],
      ['Sebelum', 'Tindakan Aseptik'],
      ['Setelah Kontak', 'Cairan Tubuh Pasien'],
      ['Setelah', 'Kontak Pasien'],
      ['Setelah Kontak', 'Lingkungan Pasien'],
      // ['HR'],
      // ['HW'],
      // ['Gagal'],
      // ['ST'],
    ],
    datasets: [
      cssu0, 
      dapur0, 
      dpjp0, 
      farmasi0, 
      igd0,
      int0,
      kebersihan0,
      kbbl0,
      lab0,
      laundry0,
      ok0,
      lt20,
      lt40,
      lt50,
      poli0,
      rad0,
      vk0,
    ]
  };

  var config = {
    type: 'bar',
    data: barData0,
    options: {
      responsive: true,
      plugins: {
        title: {
          display: true,
          text: 'GRAFIK DATA TIDAK',
          padding: {
            top: 10,
            bottom: 10
          },
            font: {
            size: 40
          }
        },
        tooltip: {
          callbacks: {
            title: (context) => {
              // console.log(context[0].label);
              return context[0].label.replaceAll(',', ' ');
            }
          }
        }
      },
      categoryPercentage: 0.8,
      barPercentage: 0.8,
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  };
  
  const barTIDAK = new Chart(
    document.getElementById('barTIDAK'),
    config
    );
</script>

<script>
  $(document).ready(function() {
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove();
            });
        }, 3000);
    });    
</script>
@endsection

@extends('layouts.footer-cucitangan')