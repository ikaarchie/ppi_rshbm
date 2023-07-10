<div class="modal fade" id="master" tabindex="-1" data-bs-backdrop="static" aria-labelledby="modalMaster"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalMaster">Tambah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['url' => 'mstKodeBundle/save']) !!}
                {!! Form::hidden('id') !!}

                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                    <div class="col-sm-3 mb-3 form-floating">
                        {!! Form::text('kode', '', ['style' => 'height: auto', 'class' => 'form-control', 'id' =>
                        'kode', 'placeholder' => 'Kode', 'required']) !!}
                        {!! Form::label('kode', 'Kode') !!}
                    </div>

                    <div class="col-sm-9 mb-3 form-floating">
                        {!! Form::text('deskripsi', '', ['style' => 'height: auto', 'class' => 'form-control', 'id' =>
                        'deskripsi', 'placeholder' => 'Deskripsi', 'required']) !!}
                        {!! Form::label('deskripsi', 'Deskripsi') !!}
                    </div>
                </div>

                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                    <div class="col-sm-6 mb-3 form-floating">
                        {!! Form::select('fungsi', [
                        'Bundle Pemasangan' => 'Bundle Pemasangan',
                        'Bundle Maintenance' => 'Bundle Maintenance',
                        'Bundle Insersi' => 'Bundle Insersi',
                        'Bundle Pre Operasi' => 'Bundle Pre Operasi',
                        'Bundle Intra Operasi' => 'Bundle Intra Operasi',
                        'Bundle Post Operasi' => 'Bundle Post Operasi'
                        ], '', ['style' => 'height: auto', 'class' => 'form-select', 'id' =>
                        'fungsi', 'placeholder' =>
                        '-- Pilih fungsi --','required']) !!}
                        {!! Form::label('fungsi', 'Fungsi') !!}
                    </div>

                    <div class="col-sm-6 mb-3 form-floating">
                        {!! Form::select('jenis', [
                        'Bundle IAD' => 'Bundle IAD',
                        'Bundle IDO' => 'Bundle IDO',
                        'Bundle ISK' => 'Bundle ISK',
                        'Bundle Plebitis' => 'Bundle Plebitis',
                        'Bundle VAP' => 'Bundle VAP'
                        ], '', ['style' => 'height: auto', 'class' => 'form-select', 'id' =>
                        'jenis', 'placeholder' =>
                        '-- Pilih jenis --','required']) !!}
                        {!! Form::label('jenis', 'Jenis') !!}
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">
                    <i class="fa-solid fa-xmark"></i> Batal</button>
                <button type="submit" class="btn btn-sm btn-success">
                    <i class="fa-solid fa-check"></i> Simpan</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>