@extends('layouts.Apd')

@section('apdContent')
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
      <use xlink:alas_kakief="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.7" />
      <use xlink:alas_kakief="#gentle-wave" x="48" y="1" fill="rgba(255,255,255,0.5)" />
      <use xlink:alas_kakief="#gentle-wave" x="48" y="2" fill="rgba(255,255,255,0.3)" />
      <use xlink:alas_kakief="#gentle-wave" x="48" y="3" fill="#fff" />
    </g>
  </svg>
</div> --}}

<div class="container justify-content-center mt-1">
  <form action="{{ route('rekapAPD') }}" method="GET">
    <div class="d-grid gap-1 d-sm-flex justify-content-sm-center align-self-center">
      <div class="col-sm-2 text-center">
        <input type="date" name="dari" id="dari" value="{{ request()->get('dari') ?? date('Y-m-d')}}"
          class="form-control input-sm" style="border-color: #ff6d00" required />
      </div>
      <h2 class="text-center">-</h2>
      <div class="col-sm-2 text-center">
        <input type="date" name="sampai" id="sampai" value="{{ request()->get('sampai') ?? date('Y-m-d')}}"
          class="form-control input-sm" style="border-color: #ff6d00" required />
      </div>
      {{-- <div class="col-sm-2 text-center">
        <input type="month" name="filter_bulan" id="filter_bulan"
          value="{{ request()->get('filter_bulan') ?? date('Y-m')}}" class="form-control input-sm"
          style="border-color: #ff6d00" required />
      </div> --}}
      <div class="col-sm-3 text-center">
        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i> Search</button>
        <button formaction="{{ route('excelAPD') }}" class="btn btn-success" type="submit">
          <i class="fa-solid fa-table"></i> Excel</button>
        <button formaction="{{ route('pdfAPD') }}" class="btn btn-danger" type="submit">
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
<div class="container-fluid align-item-center justify-content-center py-3 px-5">
  <div class="table-responsive">
    <table class="table table-bordered border-dark">
      <thead class="sticky text-dark text-center align-middle">
        <tr class="align-middle">
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
      <tbody style="background-color: #FFECB3">
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
          <td>{{ ($cssu_jumlah != 0 && $denominator_cssu != 0) ? number_format(($cssu_jumlah / $denominator_cssu) * 100,
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
          <td>{{ ($dapur_jumlah != 0 && $denominator_dapur != 0) ? number_format(($dapur_jumlah / $denominator_dapur) *
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
          <td>{{ ($dpjp_jumlah != 0 && $denominator_dpjp != 0) ? number_format(($dpjp_jumlah / $denominator_dpjp) * 100,
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
          <td>{{ ($igd_jumlah != 0 && $denominator_igd != 0) ? number_format(($igd_jumlah / $denominator_igd) * 100, 2)
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
          <td>{{ ($int_jumlah != 0 && $denominator_int != 0) ? number_format(($int_jumlah / $denominator_int) * 100, 2)
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
          <td>{{ ($kbbl_jumlah != 0 && $denominator_kbbl != 0) ? number_format(($kbbl_jumlah / $denominator_kbbl) * 100,
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
          <td>{{ ($lab_jumlah != 0 && $denominator_lab != 0) ? number_format(($lab_jumlah / $denominator_lab) * 100, 2)
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
          <td>{{ ($ok_jumlah != 0 && $denominator_ok != 0) ? number_format(($ok_jumlah / $denominator_ok) * 100, 2) : 0
            }} %</td>
        </tr>
        <tr>
          <th>Perawatan Eksekutif lt.2</th>
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
          <td>{{ ($lt2_jumlah != 0 && $denominator_lt2 != 0) ? number_format(($lt2_jumlah / $denominator_lt2) * 100, 2)
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
          <td>{{ ($lt4_jumlah != 0 && $denominator_lt4 != 0) ? number_format(($lt4_jumlah / $denominator_lt4) * 100, 2)
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
          <td>{{ ($lt5_jumlah != 0 && $denominator_lt5 != 0) ? number_format(($lt5_jumlah / $denominator_lt5) * 100, 2)
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
          <td>{{ ($poli_jumlah != 0 && $denominator_poli != 0) ? number_format(($poli_jumlah / $denominator_poli) * 100,
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
          <td>{{ ($rad_jumlah != 0 && $denominator_rad != 0) ? number_format(($rad_jumlah / $denominator_rad) * 100, 2)
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
          <td>{{ ($vk_jumlah != 0 && $denominator_vk != 0) ? number_format(($vk_jumlah / $denominator_vk) * 100, 2) : 0
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
          <button class="btn btn-warning" onclick="grafikYA()">DATA YA</button>
          <button class="btn btn-warning" onclick="grafikTIDAK()">DATA TIDAK</button>
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
      <div class="card" style="border-color: #FFAB00">
        <div class="card-header text-center bg-warning" style="border-color: #FFAB00;">
          <b>Analisa</b>
        </div>
        <div class="card-body">
          @foreach($rekap as $rekaps)
          {{ $rekaps->analisa }}
          @endforeach
        </div>
      </div>

      <div class="card mt-3" style="border-color: #FFAB00">
        <div class="card-header text-center bg-warning" style="border-color: #FFAB00;"><b></b>
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
          <button type="button" data-bs-toggle="modal" data-bs-target="#editRekapApd{{ $rekaps->id }}"
            class="btn btn-sm btn-warning"><i class="fa-solid fa-pen-to-square"></i>
            <b> Ubah Analisa dan Tindak Lanjut</b>
          </button>
          @include('rekapApd.edit')
          @empty
          <button type="button" data-bs-toggle="modal" data-bs-target="#tambahRekapApd" class="btn btn-sm btn-primary">
            <i class="fa-solid fa-plus"></i><b> Tambah Analisa dan Tindak Lanjut</b>
          </button>
          @include('rekapApd.add')
          @endforelse
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid align-item-center justify-content-center py-3">
  <div class="table-responsive table-data tbl-fixed">
    <table class="table table-bordered border-dark align-middle w-100">
      <thead class="sticky text-dark text-center align-middle">
        <tr>
          <th style="width: 1%">No</th>
          <th>Nama</th>
          <th>Unit</th>
          <th>Tanggal</th>
          <th style="width:15%">Aksi</th>
        </tr>
      </thead>
      <tbody style="background-color: #FFECB3">
        @php $no = 1; @endphp
        @forelse($tabel as $key => $isi)
        <tr>
          <td>{{ $tabel->firstItem() + $key }}</td>
          <td>{{ $isi->nama }}</td>
          <td>{{ $isi->unit }}</td>
          <td>{{ date("d/m/Y", strtotime($isi->tgl_input)) }}</td>
          <td>
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
              <a href="#detailapd{{ $isi->id }}" data-bs-toggle="modal" class="btn btn-sm btn-primary"><i
                  class="fa-regular fa-eye"></i> Detail</a>
              @include('apd.detail')
            </div>
          </td>
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
        {{ $cssu_pntp_kpl }},
        {{ $cssu_masker }},
        {{ $cssu_pntp_wjh }},
        {{ $cssu_apron }},
        {{ $cssu_srg_tgn }},
        {{ $cssu_alas_kaki }},
        {{ $cssu_lps_apd }},
        {{ $cssu_tdk_gtg_masker }},
        {{ $cssu_tdk_guna_srg_tgn }},
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
        {{ $dapur_pntp_kpl }},
        {{ $dapur_masker }},
        {{ $dapur_pntp_wjh }},
        {{ $dapur_apron }},
        {{ $dapur_srg_tgn }},
        {{ $dapur_alas_kaki }},
        {{ $dapur_lps_apd }},
        {{ $dapur_tdk_gtg_masker }},
        {{ $dapur_tdk_guna_srg_tgn }},
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
        {{ $dpjp_pntp_kpl }},
        {{ $dpjp_masker }},
        {{ $dpjp_pntp_wjh }},
        {{ $dpjp_apron }},
        {{ $dpjp_srg_tgn }},
        {{ $dpjp_alas_kaki }},
        {{ $dpjp_lps_apd }},
        {{ $dpjp_tdk_gtg_masker }},
        {{ $dpjp_tdk_guna_srg_tgn }},
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
        {{ $farmasi_pntp_kpl }},
        {{ $farmasi_masker }},
        {{ $farmasi_pntp_wjh }},
        {{ $farmasi_apron }},
        {{ $farmasi_srg_tgn }},
        {{ $farmasi_alas_kaki }},
        {{ $farmasi_lps_apd }},
        {{ $farmasi_tdk_gtg_masker }},
        {{ $farmasi_tdk_guna_srg_tgn }},
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
        {{ $igd_pntp_kpl }},
        {{ $igd_masker }},
        {{ $igd_pntp_wjh }},
        {{ $igd_apron }},
        {{ $igd_srg_tgn }},
        {{ $igd_alas_kaki }},
        {{ $igd_lps_apd }},
        {{ $igd_tdk_gtg_masker }},
        {{ $igd_tdk_guna_srg_tgn }},
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
        {{ $int_pntp_kpl }},
        {{ $int_masker }},
        {{ $int_pntp_wjh }},
        {{ $int_apron }},
        {{ $int_srg_tgn }},
        {{ $int_alas_kaki }},
        {{ $int_lps_apd }},
        {{ $int_tdk_gtg_masker }},
        {{ $int_tdk_guna_srg_tgn }},
    ],
    backgroundColor: [
      'rgba(41, 121, 255, 0.2)'
    ],
    borderColor: [
      'rgb(41, 121, 255)'
    ],
    borderWidth: 1
  };

  var kbbl1 = {
    label: ['KBBL'],
    data: [
        {{ $kbbl_pntp_kpl }},
        {{ $kbbl_masker }},
        {{ $kbbl_pntp_wjh }},
        {{ $kbbl_apron }},
        {{ $kbbl_srg_tgn }},
        {{ $kbbl_alas_kaki }},
        {{ $kbbl_lps_apd }},
        {{ $kbbl_tdk_gtg_masker }},
        {{ $kbbl_tdk_guna_srg_tgn }},
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
        {{ $lab_pntp_kpl }},
        {{ $lab_masker }},
        {{ $lab_pntp_wjh }},
        {{ $lab_apron }},
        {{ $lab_srg_tgn }},
        {{ $lab_alas_kaki }},
        {{ $lab_lps_apd }},
        {{ $lab_tdk_gtg_masker }},
        {{ $lab_tdk_guna_srg_tgn }},
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
        {{ $laundry_pntp_kpl }},
        {{ $laundry_masker }},
        {{ $laundry_pntp_wjh }},
        {{ $laundry_apron }},
        {{ $laundry_srg_tgn }},
        {{ $laundry_alas_kaki }},
        {{ $laundry_lps_apd }},
        {{ $laundry_tdk_gtg_masker }},
        {{ $laundry_tdk_guna_srg_tgn }},
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
        {{ $ok_pntp_kpl }},
        {{ $ok_masker }},
        {{ $ok_pntp_wjh }},
        {{ $ok_apron }},
        {{ $ok_srg_tgn }},
        {{ $ok_alas_kaki }},
        {{ $ok_lps_apd }},
        {{ $ok_tdk_gtg_masker }},
        {{ $ok_tdk_guna_srg_tgn }},
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
        {{ $lt2_pntp_kpl }},
        {{ $lt2_masker }},
        {{ $lt2_pntp_wjh }},
        {{ $lt2_apron }},
        {{ $lt2_srg_tgn }},
        {{ $lt2_alas_kaki }},
        {{ $lt2_lps_apd }},
        {{ $lt2_tdk_gtg_masker }},
        {{ $lt2_tdk_guna_srg_tgn }},
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
        {{ $lt4_pntp_kpl }},
        {{ $lt4_masker }},
        {{ $lt4_pntp_wjh }},
        {{ $lt4_apron }},
        {{ $lt4_srg_tgn }},
        {{ $lt4_alas_kaki }},
        {{ $lt4_lps_apd }},
        {{ $lt4_tdk_gtg_masker }},
        {{ $lt4_tdk_guna_srg_tgn }},
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
        {{ $lt5_pntp_kpl }},
        {{ $lt5_masker }},
        {{ $lt5_pntp_wjh }},
        {{ $lt5_apron }},
        {{ $lt5_srg_tgn }},
        {{ $lt5_alas_kaki }},
        {{ $lt5_lps_apd }},
        {{ $lt5_tdk_gtg_masker }},
        {{ $lt5_tdk_guna_srg_tgn }},
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
        {{ $poli_pntp_kpl }},
        {{ $poli_masker }},
        {{ $poli_pntp_wjh }},
        {{ $poli_apron }},
        {{ $poli_srg_tgn }},
        {{ $poli_alas_kaki }},
        {{ $poli_lps_apd }},
        {{ $poli_tdk_gtg_masker }},
        {{ $poli_tdk_guna_srg_tgn }},
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
        {{ $rad_pntp_kpl }},
        {{ $rad_masker }},
        {{ $rad_pntp_wjh }},
        {{ $rad_apron }},
        {{ $rad_srg_tgn }},
        {{ $rad_alas_kaki }},
        {{ $rad_lps_apd }},
        {{ $rad_tdk_gtg_masker }},
        {{ $rad_tdk_guna_srg_tgn }},
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
        {{ $vk_pntp_kpl }},
        {{ $vk_masker }},
        {{ $vk_pntp_wjh }},
        {{ $vk_apron }},
        {{ $vk_srg_tgn }},
        {{ $vk_alas_kaki }},
        {{ $vk_lps_apd }},
        {{ $vk_tdk_gtg_masker }},
        {{ $vk_tdk_guna_srg_tgn }},
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
      ['Penutup kepala'],
      ['Masker'],
      ['Kacamata google /', 'faceshield'],
      ['Apron'],
      ['Sarung tangan'],
      ['Sandal / sepatu boot'],
      ['Segera melepas APD', 'selesai melakukan'],
      ['Tidak menggantung', 'masker di leher'],
      ['Tidak menggunakan', 'sarung tangan sambil', 'menulis / menyentuh', 'lingkungan yang', 'tidak direkomendasikan'],
    ],
    datasets: [
      cssu1, 
      dapur1, 
      dpjp1, 
      farmasi1, 
      igd1,
      int1,
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
        {{ $no_cssu_pntp_kpl }},
        {{ $no_cssu_masker }},
        {{ $no_cssu_pntp_wjh }},
        {{ $no_cssu_apron }},
        {{ $no_cssu_srg_tgn }},
        {{ $no_cssu_alas_kaki }},
        {{ $no_cssu_lps_apd }},
        {{ $no_cssu_tdk_gtg_masker }},
        {{ $no_cssu_tdk_guna_srg_tgn }},
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
        {{ $no_dapur_pntp_kpl }},
        {{ $no_dapur_masker }},
        {{ $no_dapur_pntp_wjh }},
        {{ $no_dapur_apron }},
        {{ $no_dapur_srg_tgn }},
        {{ $no_dapur_alas_kaki }},
        {{ $no_dapur_lps_apd }},
        {{ $no_dapur_tdk_gtg_masker }},
        {{ $no_dapur_tdk_guna_srg_tgn }},
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
        {{ $no_dpjp_pntp_kpl }},
        {{ $no_dpjp_masker }},
        {{ $no_dpjp_pntp_wjh }},
        {{ $no_dpjp_apron }},
        {{ $no_dpjp_srg_tgn }},
        {{ $no_dpjp_alas_kaki }},
        {{ $no_dpjp_lps_apd }},
        {{ $no_dpjp_tdk_gtg_masker }},
        {{ $no_dpjp_tdk_guna_srg_tgn }},
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
        {{ $no_farmasi_pntp_kpl }},
        {{ $no_farmasi_masker }},
        {{ $no_farmasi_pntp_wjh }},
        {{ $no_farmasi_apron }},
        {{ $no_farmasi_srg_tgn }},
        {{ $no_farmasi_alas_kaki }},
        {{ $no_farmasi_lps_apd }},
        {{ $no_farmasi_tdk_gtg_masker }},
        {{ $no_farmasi_tdk_guna_srg_tgn }},
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
        {{ $no_igd_pntp_kpl }},
        {{ $no_igd_masker }},
        {{ $no_igd_pntp_wjh }},
        {{ $no_igd_apron }},
        {{ $no_igd_srg_tgn }},
        {{ $no_igd_alas_kaki }},
        {{ $no_igd_lps_apd }},
        {{ $no_igd_tdk_gtg_masker }},
        {{ $no_igd_tdk_guna_srg_tgn }},
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
        {{ $no_int_pntp_kpl }},
        {{ $no_int_masker }},
        {{ $no_int_pntp_wjh }},
        {{ $no_int_apron }},
        {{ $no_int_srg_tgn }},
        {{ $no_int_alas_kaki }},
        {{ $no_int_lps_apd }},
        {{ $no_int_tdk_gtg_masker }},
        {{ $no_int_tdk_guna_srg_tgn }},
    ],
    backgroundColor: [
      'rgba(41, 121, 255, 0.2)'
    ],
    borderColor: [
      'rgb(41, 121, 255)'
    ],
    borderWidth: 1
  };

  var kbbl0 = {
    label: ['KBBL'],
    data: [
        {{ $no_kbbl_pntp_kpl }},
        {{ $no_kbbl_masker }},
        {{ $no_kbbl_pntp_wjh }},
        {{ $no_kbbl_apron }},
        {{ $no_kbbl_srg_tgn }},
        {{ $no_kbbl_alas_kaki }},
        {{ $no_kbbl_lps_apd }},
        {{ $no_kbbl_tdk_gtg_masker }},
        {{ $no_kbbl_tdk_guna_srg_tgn }},
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
        {{ $no_lab_pntp_kpl }},
        {{ $no_lab_masker }},
        {{ $no_lab_pntp_wjh }},
        {{ $no_lab_apron }},
        {{ $no_lab_srg_tgn }},
        {{ $no_lab_alas_kaki }},
        {{ $no_lab_lps_apd }},
        {{ $no_lab_tdk_gtg_masker }},
        {{ $no_lab_tdk_guna_srg_tgn }},
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
        {{ $no_laundry_pntp_kpl }},
        {{ $no_laundry_masker }},
        {{ $no_laundry_pntp_wjh }},
        {{ $no_laundry_apron }},
        {{ $no_laundry_srg_tgn }},
        {{ $no_laundry_alas_kaki }},
        {{ $no_laundry_lps_apd }},
        {{ $no_laundry_tdk_gtg_masker }},
        {{ $no_laundry_tdk_guna_srg_tgn }},
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
        {{ $no_ok_pntp_kpl }},
        {{ $no_ok_masker }},
        {{ $no_ok_pntp_wjh }},
        {{ $no_ok_apron }},
        {{ $no_ok_srg_tgn }},
        {{ $no_ok_alas_kaki }},
        {{ $no_ok_lps_apd }},
        {{ $no_ok_tdk_gtg_masker }},
        {{ $no_ok_tdk_guna_srg_tgn }},
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
        {{ $no_lt2_pntp_kpl }},
        {{ $no_lt2_masker }},
        {{ $no_lt2_pntp_wjh }},
        {{ $no_lt2_apron }},
        {{ $no_lt2_srg_tgn }},
        {{ $no_lt2_alas_kaki }},
        {{ $no_lt2_lps_apd }},
        {{ $no_lt2_tdk_gtg_masker }},
        {{ $no_lt2_tdk_guna_srg_tgn }},
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
        {{ $no_lt4_pntp_kpl }},
        {{ $no_lt4_masker }},
        {{ $no_lt4_pntp_wjh }},
        {{ $no_lt4_apron }},
        {{ $no_lt4_srg_tgn }},
        {{ $no_lt4_alas_kaki }},
        {{ $no_lt4_lps_apd }},
        {{ $no_lt4_tdk_gtg_masker }},
        {{ $no_lt4_tdk_guna_srg_tgn }},
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
        {{ $no_lt5_pntp_kpl }},
        {{ $no_lt5_masker }},
        {{ $no_lt5_pntp_wjh }},
        {{ $no_lt5_apron }},
        {{ $no_lt5_srg_tgn }},
        {{ $no_lt5_alas_kaki }},
        {{ $no_lt5_lps_apd }},
        {{ $no_lt5_tdk_gtg_masker }},
        {{ $no_lt5_tdk_guna_srg_tgn }},
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
        {{ $no_poli_pntp_kpl }},
        {{ $no_poli_masker }},
        {{ $no_poli_pntp_wjh }},
        {{ $no_poli_apron }},
        {{ $no_poli_srg_tgn }},
        {{ $no_poli_alas_kaki }},
        {{ $no_poli_lps_apd }},
        {{ $no_poli_tdk_gtg_masker }},
        {{ $no_poli_tdk_guna_srg_tgn }},
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
        {{ $no_rad_pntp_kpl }},
        {{ $no_rad_masker }},
        {{ $no_rad_pntp_wjh }},
        {{ $no_rad_apron }},
        {{ $no_rad_srg_tgn }},
        {{ $no_rad_alas_kaki }},
        {{ $no_rad_lps_apd }},
        {{ $no_rad_tdk_gtg_masker }},
        {{ $no_rad_tdk_guna_srg_tgn }},
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
        {{ $no_vk_pntp_kpl }},
        {{ $no_vk_masker }},
        {{ $no_vk_pntp_wjh }},
        {{ $no_vk_apron }},
        {{ $no_vk_srg_tgn }},
        {{ $no_vk_alas_kaki }},
        {{ $no_vk_lps_apd }},
        {{ $no_vk_tdk_gtg_masker }},
        {{ $no_vk_tdk_guna_srg_tgn }},
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
    ['Penutup kepala'],
    ['Masker'],
    ['Kacamata google /', 'faceshield'],
    ['Apron'],
    ['Sarung tangan'],
    ['Sandal / sepatu boot'],
    ['Segera melepas APD', 'selesai melakukan'],
    ['Tidak menggantung', 'masker di leher'],
    ['Tidak menggunakan', 'sarung tangan sambil', 'menulis / menyentuh', 'lingkungan yang', 'tidak direkomendasikan'],
    ],
    datasets: [
      cssu0, 
      dapur0, 
      dpjp0, 
      farmasi0, 
      igd0,
      int0,
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

@extends('layouts.footer')