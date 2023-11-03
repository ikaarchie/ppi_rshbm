<div class="modal fade" id="editRekapBundleIsk{{ $rekaps->id }}" tabindex="-1" data-bs-backdrop="static"
    aria-labelledby="modalEditRekapBundleIsk" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditRekapBundleIsk">Ubah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::model($rekaps, [ 'method' => 'patch','route' => ['updateRekapBundleIsk', $rekaps->id] ]) !!}

                <div class="col-sm-12 mb-3 form-floating">
                    {!! Form::textarea('analisa', $rekaps->analisa, ['style' => 'height: auto', 'class' =>
                    'form-control', 'id' => 'analisa', 'placeholder' => 'Analisa']) !!}
                    {!! Form::label('analisa', 'Analisa') !!}
                </div>

                <div class="col-sm-12 mb-3 form-floating">
                    {!! Form::textarea('tindak_lanjut', $rekaps->tindak_lanjut, ['style' => 'height: auto', 'class' =>
                    'form-control', 'id' => 'tindak_lanjut', 'placeholder' => 'Tindak Lanjut']) !!}
                    {!! Form::label('tindak_lanjut', 'Tindak Lanjut') !!}
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">
                    <i class="fa-solid fa-xmark"></i> Batal</button>
                <button type="submit" class="btn btn-sm btn-primary">
                    <i class="fa-solid fa-check"></i></i> Simpan</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>