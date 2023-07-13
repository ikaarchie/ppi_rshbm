@extends('layouts.app')

@section('content')
<div class="header-waves">
    <div class="container pt-3">
        <h1 class="text-center"><b>FEEDBACK PPI</b></h1>
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
</div>

<div class="container justify-content-center bg-white">
    <div class="d-md-flex justify-content-between">
        <div class="gap-1 d-md-flex justify-content-md-start mt-2">
            <button type="button" data-bs-toggle="modal" data-bs-target="#tambahFeedback" class="btn"
                style="background-color: #FFAB00;">
                <i class="fa-solid fa-plus"></i><b> Tambah Data</b>
            </button>
        </div>

        <div class="gap-1 d-md-flex justify-content-md-end mt-2">
            <div class="form-group w-10">
                <div class="input-group">
                    <input type="text" class="form-control" style="outline: 0.5px solid; outline-color: #FFAB00;"
                        id="myInput" onkeyup="cari()" placeholder="Cari Judul">
                    <span class="input-group-text"
                        style="outline: 0.5px solid; outline-color: #FFAB00; background-color: #FFAB00;">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="table-responsive mt-1 table-data tbl-fixed">
        <table class="table table-bordered border-dark align-middle w-100" id="myTable">
            <thead class="sticky text-dark text-center align-middle">
                <tr>
                    <th class="col">No</th>
                    <th class="col-2">Bagian</th>
                    <th class="col-1">Tanggal</th>
                    <th class="col-6">Judul</th>
                    <th class="col-3">Aksi</th>
                </tr>
            </thead>
            <tbody style="background-color: #FFECB3">
                @php $no = 1; @endphp
                @forelse($feedback as $key => $isi)
                <tr>
                    <td>{{ $feedback->firstItem() + $key }}</td>
                    <td>{{ $isi->bagian }}</td>
                    <td>{{ date("d/m/Y", strtotime($isi->tgl_input)) }}</td>
                    <td>{{ $isi->judul }}</td>
                    <td>
                        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                            <a href="#preview{{ $isi->id }}" data-bs-toggle="modal" class="btn btn-sm btn-primary"><i
                                    class="fa-regular fa-eye"></i> Preview</a>
                            <a href="#editFeedback{{ $isi->id }}" data-bs-toggle="modal"
                                class="btn btn-sm btn-warning"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                            <a href="#" class="btn btn-sm btn-danger deleteSwal" data-id="{{ $isi->id }}"
                                data-nama="{{ $isi->judul }}"><i class="fa-solid fa-trash"></i> Hapus</a>
                            @include('feedbackPPI.edit')
                            @include('feedbackPPI.preview')
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center"><b>Tidak ada data</b></td>
                </tr>
                {{-- {{ $isi->dokumen }} --}}
                @endforelse
            </tbody>
        </table>

        <div class="btn-toolbar justify-content-between">
            <div>
                {{ $feedback->links() }}
            </div>
        </div>
    </div>
</div>
@include('feedbackPPI.add')

{{-- fungsi search --}}
<script>
    function cari() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[3];
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
        var judul = $(this).attr('data-nama');
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success me-md-2',
                cancelButton: 'btn btn-danger me-md-2'
            },
            buttonsStyling: false
        })
        
        swalWithBootstrapButtons.fire({
            title: "Yakin?",
            text: "Data "+judul+" akan dihapus",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "feedback/delete/"+id+""
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

@extends('layouts.footer')