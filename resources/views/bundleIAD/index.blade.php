@extends('layouts.BundlePpi')

@section('bundleContent')
{{-- <div class="header-waves">
    <div class="container pt-3">
        <h1 class="text-center"><b>BUNDLE PPI</b></h1>
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

<div class="container-fluid justify-content-center bg-white">
    <div class="d-md-flex justify-content-between">
        <div class="gap-1 d-md-flex justify-content-md-start mt-2">
            <button type="button" data-bs-toggle="modal" data-bs-target="#bundleIAD" class="btn"
                style="background-color: #00B0FF;">
                <i class="fa-solid fa-plus"></i><b> Tambah Data</b>
            </button>
        </div>

        <div class="gap-1 d-md-flex justify-content-md-end mt-2">
            <div class="form-group w-10">
                <div class="input-group">
                    <input type="text" class="form-control" style="outline: 0.5px solid; outline-color: #00B0FF;"
                        id="myInput" onkeyup="cari()" placeholder="Cari Nama Pasien">
                    <span class="input-group-text"
                        style="outline: 0.5px solid; outline-color: #00B0FF; background-color: #00B0FF;">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="table-responsive mt-1 table-data tbl-fixed">
        <table class="table table-bordered border-dark align-middle w-100" id="myTable">
            <thead class="sticky-bundle text-dark text-center align-middle">
                <tr>
                    <th style="width:1%">No</th>
                    <th style="width:10%">MRN</th>
                    <th>Nama Pasien</th>
                    <th>Diagnosa</th>
                    <th style="width:10%">Unit</th>
                    <th style="width:5%">Tanggal</th>
                    <th style="width:15%">Aksi</th>
                </tr>
            </thead>
            <tbody style=" background-color: #B3E5FC">
                @php $no = 1; @endphp
                @forelse($bundleIAD as $key => $isi)
                <tr>
                    <td>{{ $bundleIAD->firstItem() + $key }}</td>
                    <td>{{ $isi->mrn }}</td>
                    <td>{{ $isi->nama_pasien }}</td>
                    <td>{{ $isi->diagnosa }}</td>
                    <td>{{ $isi->unit }}</td>
                    <td>{{ date("d/m/Y", strtotime($isi->tgl)) }}</td>
                    <td>
                        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                            <a href="#detailBundleIAD{{ $isi->id }}" data-bs-toggle="modal"
                                class="btn btn-sm btn-primary"><i class="fa-regular fa-eye"></i> Detail</a>
                            <a href="#editBundleIAD{{ $isi->id }}" data-bs-toggle="modal"
                                class="btn btn-sm btn-warning"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                            <a href="#" class="btn btn-sm btn-danger deleteSwal" data-id="{{ $isi->id }}"
                                data-nama="{{ $isi->nama_pasien }}"><i class="fa-solid fa-trash"></i> Delete</a>
                            @include('bundleIAD.detail')
                            @include('bundleIAD.edit')
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
                Menampilkan
                {{ $bundleIAD->firstItem() }} - {{ $bundleIAD->lastItem() }}
                dari
                {{ $bundleIAD->total() }}
                data
            </div>
            <div>
                {{ $bundleIAD->links() }}
            </div>
        </div>
    </div>
</div>
@include('bundleIAD.add')

{{-- fungsi search --}}
<script>
    function cari() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[2];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }       
        }
    }
</script>

{{-- fungsi sweet alert --}}
<script>
    $('.deleteSwal').click(function(){  
        var id = $(this).attr('data-id');
        var nama = $(this).attr('data-nama');
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success me-md-2',
                cancelButton: 'btn btn-danger me-md-2'
            },
            buttonsStyling: false
        })
        
        swalWithBootstrapButtons.fire({
            title: "Yakin?",
            text: "Data "+nama+" akan dihapus",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "bundle/delete/"+id+""
                swalWithBootstrapButtons.fire(
                    'Terhapus!',
                    'Data berhasil dihapus',
                    'success'
                )
            } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Dibatalkan!',
                    'Data batal dihapus',
                    'error'
                    )
            }
        })
    })
</script>

{{-- fungsi toastr --}}
<script>
    // toastr.success('Have fun storming the castle!', 'Miracle Max Says')
    @if (Session::has('success'))
        toastr.success("{{ Session::get('success') }}")
    @endif
</script>

@endsection

@extends('layouts.footer-bundle')