@extends('layouts.RekapBundlePpi')

@section('bundleContent')
{{-- <div class="header-waves">
    <div class="container pt-3">
        <h1 class="text-center"><b>REKAP BUNDLE PPI</b></h1>
        <h2 class="text-center">Rumah Sakit Hermina Banyumanik Semarang</h2>
    </div>

    <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
        viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
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
    <form action="{{ route('rekapBundlePlebitis') }}" method="GET">
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
                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i>
                    Search</button>
                <button formaction="{{ route('excelBundlePlebitis') }}" class="btn btn-success" type="submit">
                    <i class="fa-solid fa-table"></i> Excel</button>
                <button formaction="{{ route('pdfBundlePlebitis') }}" class="btn btn-danger" type="submit">
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
            <thead class="sticky text-dark text-center align-middle">
                <tr>
                    <th></th>
                    <th style="width:10%">IGD</th>
                    <th style="width:10%">Intensif</th>
                    <th style="width:10%">OK</th>
                    <th style="width:10%">Perawatan Eksekutif lt.2</th>
                    <th style="width:10%">Perawatan Reguler lt.4</th>
                    <th style="width:10%">Perawatan Reguler lt.5</th>
                    <th style="width:10%">VK</th>
                </tr>
            </thead>
            <tbody style="background-color: #FFECB3">
                <tr>
                    <th class="text-center h4">Bundle Insersi</th>
                    <th colspan="7"></th>
                </tr>
                <tr>
                    <th>Hand hygiene</th>
                    <td>{{ $igd_PLB0301 }}</td>
                    <td>{{ $int_PLB0301 }}</td>
                    <td>{{ $ok_PLB0301 }}</td>
                    <td>{{ $lt2_PLB0301 }}</td>
                    <td>{{ $lt4_PLB0301 }}</td>
                    <td>{{ $lt5_PLB0301 }}</td>
                    <td>{{ $vk_PLB0301 }}</td>
                </tr>
                <tr>
                    <th>Kaji kebutuhan</th>
                    <td>{{ $igd_PLB0302 }}</td>
                    <td>{{ $int_PLB0302 }}</td>
                    <td>{{ $ok_PLB0302 }}</td>
                    <td>{{ $lt2_PLB0302 }}</td>
                    <td>{{ $lt4_PLB0302 }}</td>
                    <td>{{ $lt5_PLB0302 }}</td>
                    <td>{{ $vk_PLB0302 }}</td>
                </tr>
                <tr>
                    <th>Tehnik steril</th>
                    <td>{{ $igd_PLB0303 }}</td>
                    <td>{{ $int_PLB0303 }}</td>
                    <td>{{ $ok_PLB0303 }}</td>
                    <td>{{ $lt2_PLB0303 }}</td>
                    <td>{{ $lt4_PLB0303 }}</td>
                    <td>{{ $lt5_PLB0303 }}</td>
                    <td>{{ $vk_PLB0303 }}</td>
                </tr>
                <tr>
                    <th>Desinfeksi area insersi</th>
                    <td>{{ $igd_PLB0304 }}</td>
                    <td>{{ $int_PLB0304 }}</td>
                    <td>{{ $ok_PLB0304 }}</td>
                    <td>{{ $lt2_PLB0304 }}</td>
                    <td>{{ $lt4_PLB0304 }}</td>
                    <td>{{ $lt5_PLB0304 }}</td>
                    <td>{{ $vk_PLB0304 }}</td>
                </tr>
                <tr>
                    <th class="text-center h4">Bundle Maintenance</th>
                    <th colspan="7"></th>
                </tr>
                <tr>
                    <th>Hand hygiene</th>
                    <td>{{ $igd_PLB0201 }}</td>
                    <td>{{ $int_PLB0201 }}</td>
                    <td>{{ $ok_PLB0201 }}</td>
                    <td>{{ $lt2_PLB0201 }}</td>
                    <td>{{ $lt4_PLB0201 }}</td>
                    <td>{{ $lt5_PLB0201 }}</td>
                    <td>{{ $vk_PLB0201 }}</td>
                </tr>
                <tr>
                    <th>Perawatan area insersi</th>
                    <td>{{ $igd_PLB0202 }}</td>
                    <td>{{ $int_PLB0202 }}</td>
                    <td>{{ $ok_PLB0202 }}</td>
                    <td>{{ $lt2_PLB0202 }}</td>
                    <td>{{ $lt4_PLB0202 }}</td>
                    <td>{{ $lt5_PLB0202 }}</td>
                    <td>{{ $vk_PLB0202 }}</td>
                </tr>
                <tr>
                    <th>Kaji kebutuhan, jika tidak diperlukan segera lepas</th>
                    <td>{{ $igd_PLB0203 }}</td>
                    <td>{{ $int_PLB0203 }}</td>
                    <td>{{ $ok_PLB0203 }}</td>
                    <td>{{ $lt2_PLB0203 }}</td>
                    <td>{{ $lt4_PLB0203 }}</td>
                    <td>{{ $lt5_PLB0203 }}</td>
                    <td>{{ $vk_PLB0203 }}</td>
                </tr>
                <tr>
                    <th>Penggantian administrasi set</th>
                    <td>{{ $igd_PLB0204 }}</td>
                    <td>{{ $int_PLB0204 }}</td>
                    <td>{{ $ok_PLB0204 }}</td>
                    <td>{{ $lt2_PLB0204 }}</td>
                    <td>{{ $lt4_PLB0204 }}</td>
                    <td>{{ $lt5_PLB0204 }}</td>
                    <td>{{ $vk_PLB0204 }}</td>
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
                    <button type="button" data-bs-toggle="modal"
                        data-bs-target="#editRekapBundlePlebitis{{ $rekaps->id }}" class="btn btn-sm btn-warning"><i
                            class="fa-solid fa-pen-to-square"></i>
                        <b> Ubah Analisa dan Tindak Lanjut</b>
                    </button>
                    @include('rekapBundlePlebitis.edit')
                    @empty
                    <button type="button" data-bs-toggle="modal" data-bs-target="#tambahRekapBundlePlebitis"
                        class="btn btn-sm btn-primary">
                        <i class="fa-solid fa-plus"></i><b> Tambah Analisa dan Tindak Lanjut</b>
                    </button>
                    @include('rekapBundlePlebitis.add')
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
                    <th style="width:1%">No</th>
                    <th style="width:10%">MRN</th>
                    <th>Nama Pasien</th>
                    <th>Diagnosa</th>
                    <th style="width:15%">Unit</th>
                    <th style="width:5%">Tanggal</th>
                    <th style="width:5%">Aksi</th>
                </tr>
            </thead>
            <tbody style=" background-color: #FFECB3">
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
                            <a href="#detailBundlePlebitis{{ $isi->id }}" data-bs-toggle="modal"
                                class="btn btn-sm btn-primary"><i class="fa-regular fa-eye"></i> Detail</a>
                            @include('bundlePlebitis.detail')
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
        {{ $igd_PLB0301 }},
        {{ $igd_PLB0302 }},
        {{ $igd_PLB0303 }},
        {{ $igd_PLB0304 }},
        {{ $igd_PLB0201, }},
        {{ $igd_PLB0202 }},
        {{ $igd_PLB0203 }},
        {{ $igd_PLB0204 }},
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
        {{ $int_PLB0301 }},
        {{ $int_PLB0302 }},
        {{ $int_PLB0303 }},
        {{ $int_PLB0304 }},
        {{ $int_PLB0201 }},
        {{ $int_PLB0202 }},
        {{ $int_PLB0203 }},
        {{ $int_PLB0204 }},
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
        {{ $ok_PLB0301 }},
        {{ $ok_PLB0302 }},
        {{ $ok_PLB0303 }},
        {{ $ok_PLB0304 }},
        {{ $ok_PLB0201 }},
        {{ $ok_PLB0202 }},
        {{ $ok_PLB0203 }},
        {{ $ok_PLB0204 }},
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
    label: ['Perawatan Eksekutif lt.2'],
    data: [
        {{ $lt2_PLB0301 }},
        {{ $lt2_PLB0302 }},
        {{ $lt2_PLB0303 }},
        {{ $lt2_PLB0304 }},
        {{ $lt2_PLB0201 }},
        {{ $lt2_PLB0202 }},
        {{ $lt2_PLB0203 }},
        {{ $lt2_PLB0204 }},
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
        {{ $lt4_PLB0301 }},
        {{ $lt4_PLB0302 }},
        {{ $lt4_PLB0303 }},
        {{ $lt4_PLB0304 }},
        {{ $lt4_PLB0201 }},
        {{ $lt4_PLB0202 }},
        {{ $lt4_PLB0203 }},
        {{ $lt4_PLB0204 }},
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
        {{ $lt5_PLB0301 }},
        {{ $lt5_PLB0302 }},
        {{ $lt5_PLB0303 }},
        {{ $lt5_PLB0304 }},
        {{ $lt5_PLB0201 }},
        {{ $lt5_PLB0202 }},
        {{ $lt5_PLB0203 }},
        {{ $lt5_PLB0204 }},
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
        {{ $vk_PLB0301 }},
        {{ $vk_PLB0302 }},
        {{ $vk_PLB0303 }},
        {{ $vk_PLB0304 }},
        {{ $vk_PLB0201 }},
        {{ $vk_PLB0202 }},
        {{ $vk_PLB0203 }},
        {{ $vk_PLB0204 }},
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
        ['Hand hygiene'],
        ['Kaji kebutuhan'],
        ['Tehnik steril'],
        ['Desinfeksi area insersi'],
        ['Hand hygiene'],
        ['Perawatan area insersi'],
        ['Kaji kebutuhan,','jika tidak diperlukan','segera lepas'],
        ['Penggantian administrasi set'],
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
        {{ $no_igd_PLB0301 }},
        {{ $no_igd_PLB0302 }},
        {{ $no_igd_PLB0303 }},
        {{ $no_igd_PLB0304 }},
        {{ $no_igd_PLB0201 }},
        {{ $no_igd_PLB0202 }},
        {{ $no_igd_PLB0203 }},
        {{ $no_igd_PLB0204 }},
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
        {{ $no_int_PLB0301 }},
        {{ $no_int_PLB0302 }},
        {{ $no_int_PLB0303 }},
        {{ $no_int_PLB0304 }},
        {{ $no_int_PLB0201 }},
        {{ $no_int_PLB0202 }},
        {{ $no_int_PLB0203 }},
        {{ $no_int_PLB0204 }},
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
        {{ $no_ok_PLB0301 }},
        {{ $no_ok_PLB0302 }},
        {{ $no_ok_PLB0303 }},
        {{ $no_ok_PLB0304 }},
        {{ $no_ok_PLB0201 }},
        {{ $no_ok_PLB0202 }},
        {{ $no_ok_PLB0203 }},
        {{ $no_ok_PLB0204 }},
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
    label: ['Perawatan Eksekutif lt.2'],
    data: [
        {{ $no_lt2_PLB0301 }},
        {{ $no_lt2_PLB0302 }},
        {{ $no_lt2_PLB0303 }},
        {{ $no_lt2_PLB0304 }},
        {{ $no_lt2_PLB0201 }},
        {{ $no_lt2_PLB0202 }},
        {{ $no_lt2_PLB0203 }},
        {{ $no_lt2_PLB0204 }},
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
        {{ $no_lt4_PLB0301 }},
        {{ $no_lt4_PLB0302 }},
        {{ $no_lt4_PLB0303 }},
        {{ $no_lt4_PLB0304 }},
        {{ $no_lt4_PLB0201 }},
        {{ $no_lt4_PLB0202 }},
        {{ $no_lt4_PLB0203 }},
        {{ $no_lt4_PLB0204 }},
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
        {{ $no_lt5_PLB0301 }},
        {{ $no_lt5_PLB0302 }},
        {{ $no_lt5_PLB0303 }},
        {{ $no_lt5_PLB0304 }},
        {{ $no_lt5_PLB0201 }},
        {{ $no_lt5_PLB0202 }},
        {{ $no_lt5_PLB0203 }},
        {{ $no_lt5_PLB0204 }},
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
        {{ $no_vk_PLB0301 }},
        {{ $no_vk_PLB0302 }},
        {{ $no_vk_PLB0303 }},
        {{ $no_vk_PLB0304 }},
        {{ $no_vk_PLB0201 }},
        {{ $no_vk_PLB0202 }},
        {{ $no_vk_PLB0203 }},
        {{ $no_vk_PLB0204 }},
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
        ['Hand hygiene'],
        ['Kaji kebutuhan'],
        ['Tehnik steril'],
        ['Desinfeksi area insersi'],
        ['Hand hygiene'],
        ['Perawatan area insersi'],
        ['Kaji kebutuhan,','jika tidak diperlukan','segera lepas'],
        ['Penggantian administrasi set'],
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

@extends('layouts.footer')