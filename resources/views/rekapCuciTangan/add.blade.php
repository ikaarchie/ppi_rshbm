<div class="modal fade" id="tambahRekapCuciTangan" tabindex="-1" data-bs-backdrop="static"
    aria-labelledby="modalTambahRekapCuciTangan" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahRekapCuciTangan">Cuci Tangan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['url' => 'inputRekapCuciTangan']) !!}
                {!! Form::hidden('dari', request()->get('dari') ) !!}
                {!! Form::hidden('sampai', request()->get('sampai') ) !!}

                <div class="col-sm-12 mb-3 form-floating">
                    {!! Form::textarea('analisa', '', ['style' => 'height: auto', 'class' => 'form-control', 'id' =>
                    'analisa', 'placeholder' => 'Analisa']) !!}
                    {!! Form::label('analisa', 'Analisa') !!}
                </div>

                <div class="col-sm-12 mb-3 form-floating">
                    {!! Form::textarea('tindak_lanjut', '', ['style' => 'height: auto', 'class' => 'form-control', 'id'
                    => 'tindak_lanjut', 'placeholder' => 'Tindak Lanjut']) !!}
                    {!! Form::label('tindak_lanjut', 'Tindak Lanjut') !!}
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