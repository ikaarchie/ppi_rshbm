@extends('layouts.RekapBundlePpi')

@section('bundleContent')
{{-- <div class="header-waves">
  <div class="container pt-3">
    <h1 class="text-center"><b>REKAP BUNDLE PPI</b></h1>
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
  <form action="{{ route('rekapBundleIdo') }}" method="GET">
    <div class="d-grid gap-1 d-sm-flex justify-content-sm-center align-self-center">
      <div class="col-sm-2 text-center">
        <input type="date" name="dari" id="dari" value="{{ request()->get('dari') ?? date('Y-m-d')}}"
          class="form-control input-sm" style="border-color: #00B0FF" required />
      </div>
      <h2 class="text-center">-</h2>
      <div class="col-sm-2 text-center">
        <input type="date" name="sampai" id="sampai" value="{{ request()->get('sampai') ?? date('Y-m-d')}}"
          class="form-control input-sm" style="border-color: #00B0FF" required />
      </div>
      <div class="col-sm-3 text-center">
        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i>
          Search</button>
        <button formaction="{{ route('excelBundleIdo') }}" class="btn btn-success" type="submit">
          <i class="fa-solid fa-table"></i> Excel</button>
        <button formaction="{{ route('pdfBundleIdo') }}" class="btn btn-danger" type="submit">
          <i class="fa-solid fa-file-pdf"></i> PDF</button>
      </div>
    </div>
    @if($errors->any())
    <div class="alert alert-danger align-items-center text-center" role="alert">
      <strong>{{$errors->first()}}</strong>
    </div>
    @endif
  </form>
</div>
{{-- {{ dd($rekap) }}; --}}
<div class="container-fluid align-item-center justify-content-center py-3 px-5">
  <div class="table-responsive">
    <table class="table table-bordered border-dark align-middle w-100">
      <thead class="sticky-bundle text-dark text-center align-middle">
        <tr>
          <th colspan="2"></th>
          <th style="width:10%">IGD</th>
          <th style="width:10%">Intensif</th>
          <th style="width:10%">OK</th>
          <th style="width:10%">Perawatan Padma</th>
          <th style="width:10%">Perawatan Reguler lt.4</th>
          <th style="width:10%">Perawatan Reguler lt.5</th>
          <th style="width:10%">VK</th>
        </tr>
      </thead>
      <tbody style="background-color: #B3E5FC">
        <tr>
          <th colspan="2" class="text-center h4">Bundle Pre Operasi</th>
          <th colspan="7"></th>
        </tr>
        <tr>
          <th style="width:1%">A</th>
          <th>Pasien</th>
          <th colspan="7"></th>
        </tr>
        <tr>
          <th style="width:1%"></th>
          <th>Mandi dengan antiseptik / sabun mandi cair 2x sebelum tindakan operasi (WP)</th>
          <td>{{ $igd_IDO04A01 }}</td>
          <td>{{ $int_IDO04A01 }}</td>
          <td>{{ $ok_IDO04A01 }}</td>
          <td>{{ $lt2_IDO04A01 }}</td>
          <td>{{ $lt4_IDO04A01 }}</td>
          <td>{{ $lt5_IDO04A01 }}</td>
          <td>{{ $vk_IDO04A01 }}</td>
        </tr>
        <tr>
          <th style="width:1%"></th>
          <th>Pencukuran bila diperlukan dan dengan menggunakan Clipper 1 jam sebelum tindakan
            operasi (BRM)</th>
          <td>{{ $igd_IDO04A02 }}</td>
          <td>{{ $int_IDO04A02 }}</td>
          <td>{{ $ok_IDO04A02 }}</td>
          <td>{{ $lt2_IDO04A02 }}</td>
          <td>{{ $lt4_IDO04A02 }}</td>
          <td>{{ $lt5_IDO04A02 }}</td>
          <td>{{ $vk_IDO04A02 }}</td>
        </tr>
        <tr>
          <th style="width:1%"></th>
          <th>Gula darah <200 Mg / DI / Normal (BRM)</th>
          <td>{{ $igd_IDO04A03 }}</td>
          <td>{{ $int_IDO04A03 }}</td>
          <td>{{ $ok_IDO04A03 }}</td>
          <td>{{ $lt2_IDO04A03 }}</td>
          <td>{{ $lt4_IDO04A03 }}</td>
          <td>{{ $lt5_IDO04A03 }}</td>
          <td>{{ $vk_IDO04A03 }}</td>
        </tr>
        <tr>
          <th style="width:1%"></th>
          <th>Antibiotik 30-60 menit sebelum insisi atau sesuai dengan empirik (BRM)</th>
          <td>{{ $igd_IDO04A04 }}</td>
          <td>{{ $int_IDO04A04 }}</td>
          <td>{{ $ok_IDO04A04 }}</td>
          <td>{{ $lt2_IDO04A04 }}</td>
          <td>{{ $lt4_IDO04A04 }}</td>
          <td>{{ $lt5_IDO04A04 }}</td>
          <td>{{ $vk_IDO04A04 }}</td>
        </tr>
        <tr>
          <th style="width:1%"></th>
          <th>Tidak merokok atau berhenti merokok 30 hari sebelum operasi elektif (WP)</th>
          <td>{{ $igd_IDO04A05 }}</td>
          <td>{{ $int_IDO04A05 }}</td>
          <td>{{ $ok_IDO04A05 }}</td>
          <td>{{ $lt2_IDO04A05 }}</td>
          <td>{{ $lt4_IDO04A05 }}</td>
          <td>{{ $lt5_IDO04A05 }}</td>
          <td>{{ $vk_IDO04A05 }}</td>
        </tr>
        <tr>
          <th style="width:1%"></th>
          <th>Cuci dan bersihkan area pembedahan dan sekitarnya (BRM)</th>
          <td>{{ $igd_IDO04A06 }}</td>
          <td>{{ $int_IDO04A06 }}</td>
          <td>{{ $ok_IDO04A06 }}</td>
          <td>{{ $lt2_IDO04A06 }}</td>
          <td>{{ $lt4_IDO04A06 }}</td>
          <td>{{ $lt5_IDO04A06 }}</td>
          <td>{{ $vk_IDO04A06 }}</td>
        </tr>
        <tr>
          <th style="width:1%"></th>
          <th>Menggunakan antiseptik untuk membersihkan kulit (BRM)</th>
          <td>{{ $igd_IDO04A07 }}</td>
          <td>{{ $int_IDO04A07 }}</td>
          <td>{{ $ok_IDO04A07 }}</td>
          <td>{{ $lt2_IDO04A07 }}</td>
          <td>{{ $lt4_IDO04A07 }}</td>
          <td>{{ $lt5_IDO04A07 }}</td>
          <td>{{ $vk_IDO04A07 }}</td>
        </tr>
        <tr>
          <th style="width:1%"></th>
          <th>Tidak rawat inap > 2x24 jam sebelum tindakan operasi (BRM)</th>
          <td>{{ $igd_IDO04A08 }}</td>
          <td>{{ $int_IDO04A08 }}</td>
          <td>{{ $ok_IDO04A08 }}</td>
          <td>{{ $lt2_IDO04A08 }}</td>
          <td>{{ $lt4_IDO04A08 }}</td>
          <td>{{ $lt5_IDO04A08 }}</td>
          <td>{{ $vk_IDO04A08 }}</td>
        </tr>
        <tr>
          <th style="width:1%">B</th>
          <th>Tim Bedah</th>
          <th colspan="7"></th>
        </tr>
        <tr>
          <th style="width:1%"></th>
          <th>Kuku pendek, tidak menggunakan cat kuku atau kuku palsu (O)</th>
          <td>{{ $igd_IDO04B01 }}</td>
          <td>{{ $int_IDO04B01 }}</td>
          <td>{{ $ok_IDO04B01 }}</td>
          <td>{{ $lt2_IDO04B01 }}</td>
          <td>{{ $lt4_IDO04B01 }}</td>
          <td>{{ $lt5_IDO04B01 }}</td>
          <td>{{ $vk_IDO04B01 }}</td>
        </tr>
        <tr>
          <th style="width:1%"></th>
          <th>Cuci tangan bedah (surgical scrub) dengan antiseptik standar (O)</th>
          <td>{{ $igd_IDO04B02 }}</td>
          <td>{{ $int_IDO04B02 }}</td>
          <td>{{ $ok_IDO04B02 }}</td>
          <td>{{ $lt2_IDO04B02 }}</td>
          <td>{{ $lt4_IDO04B02 }}</td>
          <td>{{ $lt5_IDO04B02 }}</td>
          <td>{{ $vk_IDO04B02 }}</td>
        </tr>
        <tr>
          <th style="width:1%"></th>
          <th>Menggunakan APD lengkap (O)</th>
          <td>{{ $igd_IDO04B03 }}</td>
          <td>{{ $int_IDO04B03 }}</td>
          <td>{{ $ok_IDO04B03 }}</td>
          <td>{{ $lt2_IDO04B03 }}</td>
          <td>{{ $lt4_IDO04B03 }}</td>
          <td>{{ $lt5_IDO04B03 }}</td>
          <td>{{ $vk_IDO04B03 }}</td>
        </tr>
        <tr>
          <th colspan="2" class="text-center h4">Bundle Intra Operasi</th>
          <th colspan="7"></th>
        </tr>
        <tr>
          <th style="width:1%">A</th>
          <th>Tim Bedah</th>
          <th colspan="7"></th>
        </tr>
        <tr>
          <th style="width:1%"></th>
          <th>Gunakan masker bedah untuk menutup mulut dan hidung secara menyeluruh saat memasuki
            kamar bedah, saat operasi akan
            dimulai atau operasi sedang berjalan</th>
          <td>{{ $igd_IDO05A01 }}</td>
          <td>{{ $int_IDO05A01 }}</td>
          <td>{{ $ok_IDO05A01 }}</td>
          <td>{{ $lt2_IDO05A01 }}</td>
          <td>{{ $lt4_IDO05A01 }}</td>
          <td>{{ $lt5_IDO05A01 }}</td>
          <td>{{ $vk_IDO05A01 }}</td>
        </tr>
        <tr>
          <th style="width:1%"></th>
          <th>Gunakan tutup kepala sampai anak rambut</th>
          <td>{{ $igd_IDO05A02 }}</td>
          <td>{{ $int_IDO05A02 }}</td>
          <td>{{ $ok_IDO05A02 }}</td>
          <td>{{ $lt2_IDO05A02 }}</td>
          <td>{{ $lt4_IDO05A02 }}</td>
          <td>{{ $lt5_IDO05A02 }}</td>
          <td>{{ $vk_IDO05A02 }}</td>
        </tr>
        <tr>
          <th style="width:1%"></th>
          <th>Tidak boleh menggunakan cover shoes untuk mencegah IDO</th>
          <td>{{ $igd_IDO05A03 }}</td>
          <td>{{ $int_IDO05A03 }}</td>
          <td>{{ $ok_IDO05A03 }}</td>
          <td>{{ $lt2_IDO05A03 }}</td>
          <td>{{ $lt4_IDO05A03 }}</td>
          <td>{{ $lt5_IDO05A03 }}</td>
          <td>{{ $vk_IDO05A03 }}</td>
        </tr>
        <tr>
          <th style="width:1%"></th>
          <th>Gunakan sarung tangan steril setelah memakai gaun steril</th>
          <td>{{ $igd_IDO05A04 }}</td>
          <td>{{ $int_IDO05A04 }}</td>
          <td>{{ $ok_IDO05A04 }}</td>
          <td>{{ $lt2_IDO05A04 }}</td>
          <td>{{ $lt4_IDO05A04 }}</td>
          <td>{{ $lt5_IDO05A04 }}</td>
          <td>{{ $vk_IDO05A04 }}</td>
        </tr>
        <tr>
          <th style="width:1%">B</th>
          <th>Ventilasi & peralatan</th>
          <th colspan="7"></th>
        </tr>
        <tr>
          <th style="width:1%"></th>
          <th>Instrumen steril</th>
          <td>{{ $igd_IDO05B01 }}</td>
          <td>{{ $int_IDO05B01 }}</td>
          <td>{{ $ok_IDO05B01 }}</td>
          <td>{{ $lt2_IDO05B01 }}</td>
          <td>{{ $lt4_IDO05B01 }}</td>
          <td>{{ $lt5_IDO05B01 }}</td>
          <td>{{ $vk_IDO05B01 }}</td>
        </tr>
        <tr>
          <th style="width:1%"></th>
          <th>Menggunakan antiseptik skin preparasi</th>
          <td>{{ $igd_IDO05B02 }}</td>
          <td>{{ $int_IDO05B02 }}</td>
          <td>{{ $ok_IDO05B02 }}</td>
          <td>{{ $lt2_IDO05B02 }}</td>
          <td>{{ $lt4_IDO05B02 }}</td>
          <td>{{ $lt5_IDO05B02 }}</td>
          <td>{{ $vk_IDO05B02 }}</td>
        </tr>
        <tr>
          <th style="width:1%"></th>
          <th>Suhu / kelembaban udara 19-20 derajat celcius / 40-60%</th>
          <td>{{ $igd_IDO05B03 }}</td>
          <td>{{ $int_IDO05B03 }}</td>
          <td>{{ $ok_IDO05B03 }}</td>
          <td>{{ $lt2_IDO05B03 }}</td>
          <td>{{ $lt4_IDO05B03 }}</td>
          <td>{{ $lt5_IDO05B03 }}</td>
          <td>{{ $vk_IDO05B03 }}</td>
        </tr>
        <tr>
          <th style="width:1%"></th>
          <th>Pintu kamar bedah selalu tertutup kecuali untuk lewat alat, petugas dan pasien</th>
          <td>{{ $igd_IDO05B04 }}</td>
          <td>{{ $int_IDO05B04 }}</td>
          <td>{{ $ok_IDO05B04 }}</td>
          <td>{{ $lt2_IDO05B04 }}</td>
          <td>{{ $lt4_IDO05B04 }}</td>
          <td>{{ $lt5_IDO05B04 }}</td>
          <td>{{ $vk_IDO05B04 }}</td>
        </tr>
        <tr>
          <th colspan="2" class="text-center h4">Bundle Post Operasi</th>
          <th colspan="7"></th>
        </tr>
        <tr>
          <th style="width:1%"></th>
          <th>Luka ditutup 2x24 jam / bila terjadi rembesan segera diganti</th>
          <td>{{ $igd_IDO0601 }}</td>
          <td>{{ $int_IDO0601 }}</td>
          <td>{{ $ok_IDO0601 }}</td>
          <td>{{ $lt2_IDO0601 }}</td>
          <td>{{ $lt4_IDO0601 }}</td>
          <td>{{ $lt5_IDO0601 }}</td>
          <td>{{ $vk_IDO0601 }}</td>
        </tr>
        <tr>
          <th style="width:1%"></th>
          <th>Rawat luka dengan tehnik steril menggunakan cairan NaCl</th>
          <td>{{ $igd_IDO0602 }}</td>
          <td>{{ $int_IDO0602 }}</td>
          <td>{{ $ok_IDO0602 }}</td>
          <td>{{ $lt2_IDO0602 }}</td>
          <td>{{ $lt4_IDO0602 }}</td>
          <td>{{ $lt5_IDO0602 }}</td>
          <td>{{ $vk_IDO0602 }}</td>
        </tr>
        <tr>
          <th style="width:1%"></th>
          <th>Pankes gizi, kebersihan diri, cara merawat luka dan mobilisasi</th>
          <td>{{ $igd_IDO0603 }}</td>
          <td>{{ $int_IDO0603 }}</td>
          <td>{{ $ok_IDO0603 }}</td>
          <td>{{ $lt2_IDO0603 }}</td>
          <td>{{ $lt4_IDO0603 }}</td>
          <td>{{ $lt5_IDO0603 }}</td>
          <td>{{ $vk_IDO0603 }}</td>
        </tr>
        <tr>
          <th style="width:1%"></th>
          <th>Menggunakan APD saat merawat luka sesuai kebutuhan</th>
          <td>{{ $igd_IDO0604 }}</td>
          <td>{{ $int_IDO0604 }}</td>
          <td>{{ $ok_IDO0604 }}</td>
          <td>{{ $lt2_IDO0604 }}</td>
          <td>{{ $lt4_IDO0604 }}</td>
          <td>{{ $lt5_IDO0604 }}</td>
          <td>{{ $vk_IDO0604 }}</td>
        </tr>
        <tr>
          <td colspan="9"></td>
        </tr>
        <tr>
          <th style="width:1%"></th>
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
          <th style="width:1%"></th>
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
  </div>
</div>

<div class="container-fluid justify-content-center py-3">
  <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
    <section class="col-sm-9 align-self-stretch">
      <div class="d-grid gap-3 d-sm-flex justify-content-sm-center align-self-center">
        <section class="col-sm text-start">
          <button class="btn" style=" background-color: #00B0FF" onclick="grafikYA()"><b>DATA YA</b></button>
          <button class="btn" style=" background-color: #00B0FF" onclick="grafikTIDAK()"><b>DATA TIDAK</b></button>
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
      <div class="card" style="border-color: #00B0FF">
        <div class="card-header text-center" style="background-color: #00B0FF;border-color: #00B0FF;">
          <b>Analisa</b>
        </div>
        <div class="card-body">
          @foreach($rekap as $rekaps)
          {{ $rekaps->analisa }}
          @endforeach
        </div>
      </div>

      <div class="card mt-3" style="border-color: #00B0FF">
        <div class="card-header text-center" style="background-color: #00B0FF;border-color: #00B0FF;"><b></b>
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
          <button type="button" data-bs-toggle="modal" data-bs-target="#editRekapBundleIdo{{ $rekaps->id }}"
            class="btn btn-sm btn-warning"><i class="fa-solid fa-pen-to-square"></i>
            <b> Ubah Analisa dan Tindak Lanjut</b>
          </button>
          @include('rekapBundleIDO.edit')
          @empty
          <button type="button" data-bs-toggle="modal" data-bs-target="#tambahRekapBundleIdo"
            class="btn btn-sm btn-primary">
            <i class="fa-solid fa-plus"></i><b> Tambah Analisa dan Tindak Lanjut</b>
          </button>
          @include('rekapBundleIDO.add')
          @endforelse
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid align-item-center justify-content-center py-3">
  <div class="table-responsive table-data tbl-fixed">
    <table class="table table-bordered border-dark align-middle w-100">
      <thead class="sticky-bundle text-dark text-center align-middle">
        <tr>
          <th style="width:1%">No</th>
          <th style="width:10%">MRN</th>
          <th>Nama Pasien</th>
          <th>Diagnosa</th>
          <th style="width:15%">Unit</th>
          <th style="width:5%">Tanggal</th>
          <th style="width:5%">Aksi</th>
        </tr>
      </thead>
      <tbody style=" background-color: #B3E5FC">
        @php $no = 1; @endphp
        @forelse($tabel as $key => $isi)
        <tr>
          <td>{{ $tabel->firstItem() + $key }}</td>
          <td>{{ $isi->mrn }}</td>
          <td>{{ $isi->nama_pasien }}</td>
          <td>{{ $isi->diagnosa }}</td>
          <td>{{ $isi->unit }}</td>
          <td>{{ date("d/m/Y", strtotime($isi->tgl)) }}</td>
          <td>
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
              <a href="#detailBundleIDO{{ $isi->id }}" data-bs-toggle="modal" class="btn btn-sm btn-primary"><i
                  class="fa-regular fa-eye"></i> Detail</a>
              @include('bundleIDO.detail')
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="7" class="text-center"><b>Tidak ada data</b></td>
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
  var igd1 = {
    label: ['IGD'],
    data: [
        {{ $igd_IDO04A01 }},
        {{ $igd_IDO04A02 }},
        {{ $igd_IDO04A03 }},
        {{ $igd_IDO04A04 }},
        {{ $igd_IDO04A05 }},
        {{ $igd_IDO04A06 }},
        {{ $igd_IDO04A07 }},
        {{ $igd_IDO04A08 }},
        {{ $igd_IDO04B01 }},
        {{ $igd_IDO04B02 }},
        {{ $igd_IDO04B03 }},
        {{ $igd_IDO05A01 }},
        {{ $igd_IDO05A02 }},
        {{ $igd_IDO05A03 }},
        {{ $igd_IDO05A04 }},
        {{ $igd_IDO05B01 }},
        {{ $igd_IDO05B02 }},
        {{ $igd_IDO05B03 }},
        {{ $igd_IDO05B04 }},
        {{ $igd_IDO0601 }},
        {{ $igd_IDO0602 }},
        {{ $igd_IDO0603 }},
        {{ $igd_IDO0604 }},
    ],
    backgroundColor: [
      'rgba(213, 0, 0, 0.2)'
    ],
    borderColor: [
      'rgb(213, 0, 0)'
    ],
    borderWidth: 1
  };

  var int1 = {
    label: ['Intensif'],
    data: [
        {{ $int_IDO04A01 }},
        {{ $int_IDO04A02 }},
        {{ $int_IDO04A03 }},
        {{ $int_IDO04A04 }},
        {{ $int_IDO04A05 }},
        {{ $int_IDO04A06 }},
        {{ $int_IDO04A07 }},
        {{ $int_IDO04A08 }},
        {{ $int_IDO04B01 }},
        {{ $int_IDO04B02 }},
        {{ $int_IDO04B03 }},
        {{ $int_IDO05A01 }},
        {{ $int_IDO05A02 }},
        {{ $int_IDO05A03 }},
        {{ $int_IDO05A04 }},
        {{ $int_IDO05B01 }},
        {{ $int_IDO05B02 }},
        {{ $int_IDO05B03 }},
        {{ $int_IDO05B04 }},
        {{ $int_IDO0601 }},
        {{ $int_IDO0602 }},
        {{ $int_IDO0603 }},
        {{ $int_IDO0604 }},
    ],
    backgroundColor: [
      'rgba(24, 255, 255, 0.2)'
    ],
    borderColor: [
      'rgb(24, 255, 255)'
    ],
    borderWidth: 1
  };

  var ok1 = {
    label: ['OK'],
    data: [
        {{ $ok_IDO04A01 }},
        {{ $ok_IDO04A02 }},
        {{ $ok_IDO04A03 }},
        {{ $ok_IDO04A04 }},
        {{ $ok_IDO04A05 }},
        {{ $ok_IDO04A06 }},
        {{ $ok_IDO04A07 }},
        {{ $ok_IDO04A08 }},
        {{ $ok_IDO04B01 }},
        {{ $ok_IDO04B02 }},
        {{ $ok_IDO04B03 }},
        {{ $ok_IDO05A01 }},
        {{ $ok_IDO05A02 }},
        {{ $ok_IDO05A03 }},
        {{ $ok_IDO05A04 }},
        {{ $ok_IDO05B01 }},
        {{ $ok_IDO05B02 }},
        {{ $ok_IDO05B03 }},
        {{ $ok_IDO05B04 }},
        {{ $ok_IDO0601 }},
        {{ $ok_IDO0602 }},
        {{ $ok_IDO0603 }},
        {{ $ok_IDO0604 }},
    ],
    backgroundColor: [
      'rgba(0, 200, 83, 0.2)'
    ],
    borderColor: [
      'rgb(0, 200, 83)'
    ],
    borderWidth: 1
  };

  var lt21 = {
    label: ['Perawatan Padma'],
    data: [
        {{ $lt2_IDO04A01 }},
        {{ $lt2_IDO04A02 }},
        {{ $lt2_IDO04A03 }},
        {{ $lt2_IDO04A04 }},
        {{ $lt2_IDO04A05 }},
        {{ $lt2_IDO04A06 }},
        {{ $lt2_IDO04A07 }},
        {{ $lt2_IDO04A08 }},
        {{ $lt2_IDO04B01 }},
        {{ $lt2_IDO04B02 }},
        {{ $lt2_IDO04B03 }},
        {{ $lt2_IDO05A01 }},
        {{ $lt2_IDO05A02 }},
        {{ $lt2_IDO05A03 }},
        {{ $lt2_IDO05A04 }},
        {{ $lt2_IDO05B01 }},
        {{ $lt2_IDO05B02 }},
        {{ $lt2_IDO05B03 }},
        {{ $lt2_IDO05B04 }},
        {{ $lt2_IDO0601 }},
        {{ $lt2_IDO0602 }},
        {{ $lt2_IDO0603 }},
        {{ $lt2_IDO0604 }},
    ],
    backgroundColor: [
      'rgba(224, 64, 251, 0.2)'
    ],
    borderColor: [
      'rgb(224, 64, 251)'
    ],
    borderWidth: 1
  };

  var lt41 = {
    label: ['Perawatan Reguler lt.4'],
    data: [
        {{ $lt4_IDO04A01 }},
        {{ $lt4_IDO04A02 }},
        {{ $lt4_IDO04A03 }},
        {{ $lt4_IDO04A04 }},
        {{ $lt4_IDO04A05 }},
        {{ $lt4_IDO04A06 }},
        {{ $lt4_IDO04A07 }},
        {{ $lt4_IDO04A08 }},
        {{ $lt4_IDO04B01 }},
        {{ $lt4_IDO04B02 }},
        {{ $lt4_IDO04B03 }},
        {{ $lt4_IDO05A01 }},
        {{ $lt4_IDO05A02 }},
        {{ $lt4_IDO05A03 }},
        {{ $lt4_IDO05A04 }},
        {{ $lt4_IDO05B01 }},
        {{ $lt4_IDO05B02 }},
        {{ $lt4_IDO05B03 }},
        {{ $lt4_IDO05B04 }},
        {{ $lt4_IDO0601 }},
        {{ $lt4_IDO0602 }},
        {{ $lt4_IDO0603 }},
        {{ $lt4_IDO0604 }},
    ],
    backgroundColor: [
      'rgba(255, 109, 0, 0.2)'
    ],
    borderColor: [
      'rgb(255, 109, 0)'
    ],
    borderWidth: 1
  };

  var lt51 = {
    label: ['Perawatan Reguler lt.5'],
    data: [
        {{ $lt5_IDO04A01 }},
        {{ $lt5_IDO04A02 }},
        {{ $lt5_IDO04A03 }},
        {{ $lt5_IDO04A04 }},
        {{ $lt5_IDO04A05 }},
        {{ $lt5_IDO04A06 }},
        {{ $lt5_IDO04A07 }},
        {{ $lt5_IDO04A08 }},
        {{ $lt5_IDO04B01 }},
        {{ $lt5_IDO04B02 }},
        {{ $lt5_IDO04B03 }},
        {{ $lt5_IDO05A01 }},
        {{ $lt5_IDO05A02 }},
        {{ $lt5_IDO05A03 }},
        {{ $lt5_IDO05A04 }},
        {{ $lt5_IDO05B01 }},
        {{ $lt5_IDO05B02 }},
        {{ $lt5_IDO05B03 }},
        {{ $lt5_IDO05B04 }},
        {{ $lt5_IDO0601 }},
        {{ $lt5_IDO0602 }},
        {{ $lt5_IDO0603 }},
        {{ $lt5_IDO0604 }},
    ],
    backgroundColor: [
      'rgba(41, 98, 255, 0.2)'
    ],
    borderColor: [
      'rgb(41, 98, 255)'
    ],
    borderWidth: 1
  };

  var vk1 = {
    label: ['VK'],
    data: [
        {{ $vk_IDO04A01 }},
        {{ $vk_IDO04A02 }},
        {{ $vk_IDO04A03 }},
        {{ $vk_IDO04A04 }},
        {{ $vk_IDO04A05 }},
        {{ $vk_IDO04A06 }},
        {{ $vk_IDO04A07 }},
        {{ $vk_IDO04A08 }},
        {{ $vk_IDO04B01 }},
        {{ $vk_IDO04B02 }},
        {{ $vk_IDO04B03 }},
        {{ $vk_IDO05A01 }},
        {{ $vk_IDO05A02 }},
        {{ $vk_IDO05A03 }},
        {{ $vk_IDO05A04 }},
        {{ $vk_IDO05B01 }},
        {{ $vk_IDO05B02 }},
        {{ $vk_IDO05B03 }},
        {{ $vk_IDO05B04 }},
        {{ $vk_IDO0601 }},
        {{ $vk_IDO0602 }},
        {{ $vk_IDO0603 }},
        {{ $vk_IDO0604 }},
    ],
    backgroundColor: [
      'rgba(255, 234, 0, 0.2)'
    ],
    borderColor: [
      'rgb(255, 234, 0)'
    ],
    borderWidth: 1
  };

  var barData1 = {
    labels: [
        ['1'],
        ['2'],
        ['3'],
        ['4'],
        ['5'],
        ['6'],
        ['7'],
        ['8'],
        ['9'],
        ['10'],
        ['11'],
        ['12'],
        ['13'],
        ['14'],
        ['15'],
        ['16'],
        ['17'],
        ['18'],
        ['19'],
        ['20'],
        ['21'],
        ['22'],
        ['23'],
    ],
    datasets: [
      igd1,
      int1,
      ok1,
      lt21,
      lt41,
      lt51,
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
  var igd0 = {
    label: ['IGD'],
    data: [
        {{ $no_igd_IDO04A01 }},
        {{ $no_igd_IDO04A02 }},
        {{ $no_igd_IDO04A03 }},
        {{ $no_igd_IDO04A04 }},
        {{ $no_igd_IDO04A05 }},
        {{ $no_igd_IDO04A06 }},
        {{ $no_igd_IDO04A07 }},
        {{ $no_igd_IDO04A08 }},
        {{ $no_igd_IDO04B01 }},
        {{ $no_igd_IDO04B02 }},
        {{ $no_igd_IDO04B03 }},
        {{ $no_igd_IDO05A01 }},
        {{ $no_igd_IDO05A02 }},
        {{ $no_igd_IDO05A03 }},
        {{ $no_igd_IDO05A04 }},
        {{ $no_igd_IDO05B01 }},
        {{ $no_igd_IDO05B02 }},
        {{ $no_igd_IDO05B03 }},
        {{ $no_igd_IDO05B04 }},
        {{ $no_igd_IDO0601 }},
        {{ $no_igd_IDO0602 }},
        {{ $no_igd_IDO0603 }},
        {{ $no_igd_IDO0604 }},
    ],
    backgroundColor: [
      'rgba(213, 0, 0, 0.2)'
    ],
    borderColor: [
      'rgb(213, 0, 0)'
    ],
    borderWidth: 1
  };

  var int0 = {
    label: ['Intensif'],
    data: [
        {{ $no_int_IDO04A01 }},
        {{ $no_int_IDO04A02 }},
        {{ $no_int_IDO04A03 }},
        {{ $no_int_IDO04A04 }},
        {{ $no_int_IDO04A05 }},
        {{ $no_int_IDO04A06 }},
        {{ $no_int_IDO04A07 }},
        {{ $no_int_IDO04A08 }},
        {{ $no_int_IDO04B01 }},
        {{ $no_int_IDO04B02 }},
        {{ $no_int_IDO04B03 }},
        {{ $no_int_IDO05A01 }},
        {{ $no_int_IDO05A02 }},
        {{ $no_int_IDO05A03 }},
        {{ $no_int_IDO05A04 }},
        {{ $no_int_IDO05B01 }},
        {{ $no_int_IDO05B02 }},
        {{ $no_int_IDO05B03 }},
        {{ $no_int_IDO05B04 }},
        {{ $no_int_IDO0601 }},
        {{ $no_int_IDO0602 }},
        {{ $no_int_IDO0603 }},
        {{ $no_int_IDO0604 }},
    ],
    backgroundColor: [
      'rgba(24, 255, 255, 0.2)'
    ],
    borderColor: [
      'rgb(24, 255, 255)'
    ],
    borderWidth: 1
  };

  var ok0 = {
    label: ['OK'],
    data: [
        {{ $no_ok_IDO04A01 }},
        {{ $no_ok_IDO04A02 }},
        {{ $no_ok_IDO04A03 }},
        {{ $no_ok_IDO04A04 }},
        {{ $no_ok_IDO04A05 }},
        {{ $no_ok_IDO04A06 }},
        {{ $no_ok_IDO04A07 }},
        {{ $no_ok_IDO04A08 }},
        {{ $no_ok_IDO04B01 }},
        {{ $no_ok_IDO04B02 }},
        {{ $no_ok_IDO04B03 }},
        {{ $no_ok_IDO05A01 }},
        {{ $no_ok_IDO05A02 }},
        {{ $no_ok_IDO05A03 }},
        {{ $no_ok_IDO05A04 }},
        {{ $no_ok_IDO05B01 }},
        {{ $no_ok_IDO05B02 }},
        {{ $no_ok_IDO05B03 }},
        {{ $no_ok_IDO05B04 }},
        {{ $no_ok_IDO0601 }},
        {{ $no_ok_IDO0602 }},
        {{ $no_ok_IDO0603 }},
        {{ $no_ok_IDO0604 }},
    ],
    backgroundColor: [
      'rgba(0, 200, 83, 0.2)'
    ],
    borderColor: [
      'rgb(0, 200, 83)'
    ],
    borderWidth: 1
  };

  var lt20 = {
    label: ['Perawatan Padma'],
    data: [
        {{ $no_lt2_IDO04A01 }},
        {{ $no_lt2_IDO04A02 }},
        {{ $no_lt2_IDO04A03 }},
        {{ $no_lt2_IDO04A04 }},
        {{ $no_lt2_IDO04A05 }},
        {{ $no_lt2_IDO04A06 }},
        {{ $no_lt2_IDO04A07 }},
        {{ $no_lt2_IDO04A08 }},
        {{ $no_lt2_IDO04B01 }},
        {{ $no_lt2_IDO04B02 }},
        {{ $no_lt2_IDO04B03 }},
        {{ $no_lt2_IDO05A01 }},
        {{ $no_lt2_IDO05A02 }},
        {{ $no_lt2_IDO05A03 }},
        {{ $no_lt2_IDO05A04 }},
        {{ $no_lt2_IDO05B01 }},
        {{ $no_lt2_IDO05B02 }},
        {{ $no_lt2_IDO05B03 }},
        {{ $no_lt2_IDO05B04 }},
        {{ $no_lt2_IDO0601 }},
        {{ $no_lt2_IDO0602 }},
        {{ $no_lt2_IDO0603 }},
        {{ $no_lt2_IDO0604 }},
    ],
    backgroundColor: [
      'rgba(224, 64, 251, 0.2)'
    ],
    borderColor: [
      'rgb(224, 64, 251)'
    ],
    borderWidth: 1
  };

  var lt40 = {
    label: ['Perawatan Reguler lt.4'],
    data: [
        {{ $no_lt4_IDO04A01 }},
        {{ $no_lt4_IDO04A02 }},
        {{ $no_lt4_IDO04A03 }},
        {{ $no_lt4_IDO04A04 }},
        {{ $no_lt4_IDO04A05 }},
        {{ $no_lt4_IDO04A06 }},
        {{ $no_lt4_IDO04A07 }},
        {{ $no_lt4_IDO04A08 }},
        {{ $no_lt4_IDO04B01 }},
        {{ $no_lt4_IDO04B02 }},
        {{ $no_lt4_IDO04B03 }},
        {{ $no_lt4_IDO05A01 }},
        {{ $no_lt4_IDO05A02 }},
        {{ $no_lt4_IDO05A03 }},
        {{ $no_lt4_IDO05A04 }},
        {{ $no_lt4_IDO05B01 }},
        {{ $no_lt4_IDO05B02 }},
        {{ $no_lt4_IDO05B03 }},
        {{ $no_lt4_IDO05B04 }},
        {{ $no_lt4_IDO0601 }},
        {{ $no_lt4_IDO0602 }},
        {{ $no_lt4_IDO0603 }},
        {{ $no_lt4_IDO0604 }},
    ],
    backgroundColor: [
      'rgba(255, 109, 0, 0.2)'
    ],
    borderColor: [
      'rgb(255, 109, 0)'
    ],
    borderWidth: 1
  };

  var lt50 = {
    label: ['Perawatan Reguler lt.5'],
    data: [
        {{ $no_lt5_IDO04A01 }},
        {{ $no_lt5_IDO04A02 }},
        {{ $no_lt5_IDO04A03 }},
        {{ $no_lt5_IDO04A04 }},
        {{ $no_lt5_IDO04A05 }},
        {{ $no_lt5_IDO04A06 }},
        {{ $no_lt5_IDO04A07 }},
        {{ $no_lt5_IDO04A08 }},
        {{ $no_lt5_IDO04B01 }},
        {{ $no_lt5_IDO04B02 }},
        {{ $no_lt5_IDO04B03 }},
        {{ $no_lt5_IDO05A01 }},
        {{ $no_lt5_IDO05A02 }},
        {{ $no_lt5_IDO05A03 }},
        {{ $no_lt5_IDO05A04 }},
        {{ $no_lt5_IDO05B01 }},
        {{ $no_lt5_IDO05B02 }},
        {{ $no_lt5_IDO05B03 }},
        {{ $no_lt5_IDO05B04 }},
        {{ $no_lt5_IDO0601 }},
        {{ $no_lt5_IDO0602 }},
        {{ $no_lt5_IDO0603 }},
        {{ $no_lt5_IDO0604 }},
    ],
    backgroundColor: [
      'rgba(41, 98, 255, 0.2)'
    ],
    borderColor: [
      'rgb(41, 98, 255)'
    ],
    borderWidth: 1
  };

  var vk0 = {
    label: ['VK'],
    data: [
        {{ $no_vk_IDO04A01 }},
        {{ $no_vk_IDO04A02 }},
        {{ $no_vk_IDO04A03 }},
        {{ $no_vk_IDO04A04 }},
        {{ $no_vk_IDO04A05 }},
        {{ $no_vk_IDO04A06 }},
        {{ $no_vk_IDO04A07 }},
        {{ $no_vk_IDO04A08 }},
        {{ $no_vk_IDO04B01 }},
        {{ $no_vk_IDO04B02 }},
        {{ $no_vk_IDO04B03 }},
        {{ $no_vk_IDO05A01 }},
        {{ $no_vk_IDO05A02 }},
        {{ $no_vk_IDO05A03 }},
        {{ $no_vk_IDO05A04 }},
        {{ $no_vk_IDO05B01 }},
        {{ $no_vk_IDO05B02 }},
        {{ $no_vk_IDO05B03 }},
        {{ $no_vk_IDO05B04 }},
        {{ $no_vk_IDO0601 }},
        {{ $no_vk_IDO0602 }},
        {{ $no_vk_IDO0603 }},
        {{ $no_vk_IDO0604 }},
    ],
    backgroundColor: [
      'rgba(255, 234, 0, 0.2)'
    ],
    borderColor: [
      'rgb(255, 234, 0)'
    ],
    borderWidth: 1
  };

  var barData0 = {
    labels: [
        ['1'],
        ['2'],
        ['3'],
        ['4'],
        ['5'],
        ['6'],
        ['7'],
        ['8'],
        ['9'],
        ['10'],
        ['11'],
        ['12'],
        ['13'],
        ['14'],
        ['15'],
        ['16'],
        ['17'],
        ['18'],
        ['19'],
        ['20'],
        ['21'],
        ['22'],
        ['23'],
    ],
    datasets: [
      igd0,
      int0,
      ok0,
      lt20,
      lt40,
      lt50,
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

@extends('layouts.footer-bundle')