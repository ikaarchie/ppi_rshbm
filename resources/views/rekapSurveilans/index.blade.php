@extends('layouts.app')

@section('content')
<div class="header-waves">
  <div class="container pt-3">
    <h1 class="text-center"><b>REKAP SURVEILANS</b></h1>
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
</div>

<div class="container justify-content-center mt-1">
  <form action="{{ route('rekapSurveilans') }}" method="GET">
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
      <div class="col-sm-3 text-center">
        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i> Search</button>
        <button formaction="{{ route('excelSurveilans') }}" class="btn btn-success" type="submit">
          <i class="fa-solid fa-table"></i> Excel</button>
        <button formaction="{{ route('pdfSurveilans') }}" class="btn btn-danger" type="submit">
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
    <table class="table table-bordered border-dark">
      <thead class="sticky text-dark text-center align-middle">
        <tr>
          <th rowspan="2"></th>
          <th colspan="4">Pemasangan Alat</th>
          <th rowspan="2">Pasien<br />Tirah<br />Baring</th>
          <th colspan="14">HAIs</th>
          <th rowspan="2">Terpajan</th>
          <th rowspan="2">Standar<br />0</th>
        </tr>
        <tr>
          <th>IVL</th>
          <th>DC</th>
          <th>Vent</th>
          <th>IAD</th>
          <th>Plebitis</th>
          <th>Standar <br /> 1&permil;</th>
          <th>ISK</th>
          <th>Standar <br /> &lt;4,7&permil;</th>
          <th>VAP</th>
          <th>Standar <br /> &lt;5,8&permil;</th>
          <th>IAD</th>
          <th>Standar <br /> 3,5&permil;</th>
          <th>DEKU</th>
          <th>Standar <br /> &lt;1,5&permil;</th>
          <th>HAP</th>
          <th>Standar <br /> &lt;1&permil;</th>
          <th>IDO</th>
          <th>Standar <br /> 2&percnt;</th>
        </tr>
      </thead>
      <tbody style="background-color: #FFECB3">
        <tr>
          <th>Intensif</th>
          <td>{{ $int_pa_ivl }}</td>
          <td>{{ $int_pa_dc }}</td>
          <td>{{ $int_pa_vent }}</td>
          <td>{{ $int_pa_iad }}</td>
          <td>{{ $int_tirah_baring }}</td>
          <td>{{ $int_hais_plebitis }}</td>
          <td></td>
          <td>{{ $int_hais_isk }}</td>
          <td></td>
          <td>{{ $int_hais_vap }}</td>
          <td></td>
          <td>{{ $int_hais_iad }}</td>
          <td></td>
          <td>{{ $int_hais_deku }}</td>
          <td></td>
          <td>{{ $int_hais_hap }}</td>
          <td></td>
          <td>{{ $int_hais_ido }}</td>
          <td></td>
          <td>{{ $int_terpajan }}</td>
          <td></td>
        </tr>
        <tr>
          <th>Perawatan Eksekutif lt.2</th>
          <td>{{ $lt2_pa_ivl }}</td>
          <td>{{ $lt2_pa_dc }}</td>
          <td>{{ $lt2_pa_vent }}</td>
          <td>{{ $lt2_pa_iad }}</td>
          <td>{{ $lt2_tirah_baring }}</td>
          <td>{{ $lt2_hais_plebitis }}</td>
          <td></td>
          <td>{{ $lt2_hais_isk }}</td>
          <td></td>
          <td>{{ $lt2_hais_vap }}</td>
          <td></td>
          <td>{{ $lt2_hais_iad }}</td>
          <td></td>
          <td>{{ $lt2_hais_deku }}</td>
          <td></td>
          <td>{{ $lt2_hais_hap }}</td>
          <td></td>
          <td>{{ $lt2_hais_ido }}</td>
          <td></td>
          <td>{{ $lt2_terpajan }}</td>
          <td></td>
        </tr>
        <tr>
          <th>Perawatan Reguler lt.4</th>
          <td>{{ $lt4_pa_ivl }}</td>
          <td>{{ $lt4_pa_dc }}</td>
          <td>{{ $lt4_pa_vent }}</td>
          <td>{{ $lt4_pa_iad }}</td>
          <td>{{ $lt4_tirah_baring }}</td>
          <td>{{ $lt4_hais_plebitis }}</td>
          <td></td>
          <td>{{ $lt4_hais_isk }}</td>
          <td></td>
          <td>{{ $lt4_hais_vap }}</td>
          <td></td>
          <td>{{ $lt4_hais_iad }}</td>
          <td></td>
          <td>{{ $lt4_hais_deku }}</td>
          <td></td>
          <td>{{ $lt4_hais_hap }}</td>
          <td></td>
          <td>{{ $lt4_hais_ido }}</td>
          <td></td>
          <td>{{ $lt4_terpajan }}</td>
          <td></td>
        </tr>
        <tr>
          <th>Perawatan Reguler lt.5</th>
          <td>{{ $lt5_pa_ivl }}</td>
          <td>{{ $lt5_pa_dc }}</td>
          <td>{{ $lt5_pa_vent }}</td>
          <td>{{ $lt5_pa_iad }}</td>
          <td>{{ $lt5_tirah_baring }}</td>
          <td>{{ $lt5_hais_plebitis }}</td>
          <td></td>
          <td>{{ $lt5_hais_isk }}</td>
          <td></td>
          <td>{{ $lt5_hais_vap }}</td>
          <td></td>
          <td>{{ $lt5_hais_iad }}</td>
          <td></td>
          <td>{{ $lt5_hais_deku }}</td>
          <td></td>
          <td>{{ $lt5_hais_hap }}</td>
          <td></td>
          <td>{{ $lt5_hais_ido }}</td>
          <td></td>
          <td>{{ $lt5_terpajan }}</td>
          <td></td>
        </tr>
        <tr>
          <th>VK</th>
          <td>{{ $vk_pa_ivl }}</td>
          <td>{{ $vk_pa_dc }}</td>
          <td>{{ $vk_pa_vent }}</td>
          <td>{{ $vk_pa_iad }}</td>
          <td>{{ $vk_tirah_baring }}</td>
          <td>{{ $vk_hais_plebitis }}</td>
          <td></td>
          <td>{{ $vk_hais_isk }}</td>
          <td></td>
          <td>{{ $vk_hais_vap }}</td>
          <td></td>
          <td>{{ $vk_hais_iad }}</td>
          <td></td>
          <td>{{ $vk_hais_deku }}</td>
          <td></td>
          <td>{{ $vk_hais_hap }}</td>
          <td></td>
          <td>{{ $vk_hais_ido }}</td>
          <td></td>
          <td>{{ $vk_terpajan }}</td>
          <td></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<div class="container-fluid justify-content-center py-3">
  <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
    <div class="col-sm-9 align-self-stretch">
      <canvas id="barChart"></canvas>
    </div>

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
          <button type="button" data-bs-toggle="modal" data-bs-target="#editRekap{{ $rekaps->id }}"
            class="btn btn-sm btn-warning"><i class="fa-solid fa-pen-to-square"></i>
            <b> Ubah Analisa dan Tindak Lanjut</b>
          </button>
          @include('rekapSurveilans.edit')
          @empty
          <button type="button" data-bs-toggle="modal" data-bs-target="#tambahRekap" class="btn btn-sm btn-primary">
            <i class="fa-solid fa-plus"></i><b> Tambah Analisa dan Tindak Lanjut</b>
          </button>
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
          <th rowspan="2">No</th>
          <th rowspan="2">MRN</th>
          <th rowspan="2">Nama Pasien</th>
          <th rowspan="2">Usia</th>
          <th rowspan="2">Jenis Kelamin</th>
          <th rowspan="2">Unit</th>
          <th colspan="4">Pemasangan Alat</th>
          <th rowspan="2">Pasien<br />Tirah<br />Baring</th>
          <th colspan="7">HAIs</th>
          <th rowspan="2">Terpajan</th>
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
      <tbody style="background-color: #FFECB3">
        @php $no = 1; @endphp
        @forelse($tabel as $key => $isi)
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
        @empty
        <tr>
          <td colspan="20" class="text-center"><b>Tidak ada data</b></td>
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
  var dataPertama = {
    label: ['Intensif'],
    data: [
        {{ $int_pa_ivl }},
        {{ $int_pa_dc }},
        {{ $int_pa_vent }},
        {{ $int_pa_iad }},
        {{ $int_tirah_baring }},
        {{ $int_hais_plebitis }},
        {{ $int_hais_isk }},
        {{ $int_hais_vap }},
        {{ $int_hais_iad }},
        {{ $int_hais_deku }},
        {{ $int_hais_hap }},
        {{ $int_hais_ido }},
        {{ $int_terpajan }},
    ],
    backgroundColor: [
      'rgba(255, 61, 0, 0.2)'
    ],
    borderColor: [
      'rgb(255, 61, 0)'
    ],
    borderWidth: 1
  };

  var dataKedua = {
    label: ['Perawatan Eksekutif lt.2'],
    data: [
        {{ $lt2_pa_ivl }},
        {{ $lt2_pa_dc }},
        {{ $lt2_pa_vent }},
        {{ $lt2_pa_iad }},
        {{ $lt2_tirah_baring }},
        {{ $lt2_hais_plebitis }},
        {{ $lt2_hais_isk }},
        {{ $lt2_hais_vap }},
        {{ $lt2_hais_iad }},
        {{ $lt2_hais_deku }},
        {{ $lt2_hais_hap }},
        {{ $lt2_hais_ido }},
        {{ $lt2_terpajan }},
    ],
    backgroundColor: [
      'rgba(255, 214, 0, 0.2)'
    ],
    borderColor: [
      'rgb(255, 214, 0)'
    ],
    borderWidth: 1
  };

  var dataKetiga = {
    label: ['Perawatan Reguler lt.4'],
    data: [
        {{ $lt4_pa_ivl }},
        {{ $lt4_pa_dc }},
        {{ $lt4_pa_vent }},
        {{ $lt4_pa_iad }},
        {{ $lt4_tirah_baring }},
        {{ $lt4_hais_plebitis }},
        {{ $lt4_hais_isk }},
        {{ $lt4_hais_vap }},
        {{ $lt4_hais_iad }},
        {{ $lt4_hais_deku }},
        {{ $lt4_hais_hap }},
        {{ $lt4_hais_ido }},
        {{ $lt4_terpajan }},
    ],
    backgroundColor: [
      'rgba(0, 145, 234, 0.2)'
    ],
    borderColor: [
      'rgb(0, 145, 234)'
    ],
    borderWidth: 1
  };

  var dataKeempat = {
    label: ['Perawatan Reguler lt.5'],
    data: [
        {{ $lt5_pa_ivl }},
        {{ $lt5_pa_dc }},
        {{ $lt5_pa_vent }},
        {{ $lt5_pa_iad }},
        {{ $lt5_tirah_baring }},
        {{ $lt5_hais_plebitis }},
        {{ $lt5_hais_isk }},
        {{ $lt5_hais_vap }},
        {{ $lt5_hais_iad }},
        {{ $lt5_hais_deku }},
        {{ $lt5_hais_hap }},
        {{ $lt5_hais_ido }},
        {{ $lt5_terpajan }},
    ],
    backgroundColor: [
      'rgba(0, 200, 83, 0.2)'
    ],
    borderColor: [
      'rgb(0, 200, 83)'
    ],
    borderWidth: 1
  };

  var dataKelima = {
    label: ['VK'],
    data: [
        {{ $vk_pa_ivl }},
        {{ $vk_pa_dc }},
        {{ $vk_pa_vent }},
        {{ $vk_pa_iad }},
        {{ $vk_tirah_baring }},
        {{ $vk_hais_plebitis }},
        {{ $vk_hais_isk }},
        {{ $vk_hais_vap }},
        {{ $vk_hais_iad }},
        {{ $vk_hais_deku }},
        {{ $vk_hais_hap }},
        {{ $vk_hais_ido }},
        {{ $vk_terpajan }},
    ],
    backgroundColor: [
      'rgba(213, 0, 249, 0.2)'
    ],
    borderColor: [
      'rgb(213, 0, 249)'
    ],
    borderWidth: 1
  };

  var barData = {
    labels: [
      ['Pemasangan Alat', 'IVL'],
      ['Pemasangan Alat', 'DC'],
      ['Pemasangan Alat', 'Vent'],
      ['Pemasangan Alat', 'IAD'],
      ['Pasien', 'Tirah Baring'],
      ['HAIs', 'Plebitis'],
      ['HAIs', 'ISK'],
      ['HAIs', 'VAP'],
      ['HAIs', 'IAD'],
      ['HAIs', 'DEKU'],
      ['HAIs', 'HAP'],
      ['HAIs', 'IDO'],
      ['Karyawan', 'Tertusuk Jarum'],
    ],
    datasets: [dataPertama, dataKedua, dataKetiga, dataKeempat, dataKelima]
  };

  var config = {
    type: 'bar',
    data: barData,
    options: {
      plugins: {
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
  
  const barChart = new Chart(
    document.getElementById('barChart'),
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