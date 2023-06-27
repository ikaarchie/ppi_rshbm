<div class="modal fade" id="editFeedback{{$isi->id}}" tabindex="-1" data-bs-backdrop="static"
    aria-labelledby="modalEditFeedback" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditFeedback">Ubah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::model($isi, [ 'method' => 'patch','route' => ['updateFeedback', $isi->id], 'enctype' =>
                'multipart/form-data' ]) !!}
                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                    <div class="col-sm-6 mb-3 form-floating">
                        {!! Form::select('bagian', [
                        'BPJS' => 'BPJS',
                        'DIREKSI' => 'DIREKSI',
                        'IT' => 'IT',
                        'JANGMED' => 'JANGMED',
                        'JANGUM' => 'JANGUM',
                        'KEPERAWATAN' => 'KEPERAWATAN',
                        'KEUANGAN' => 'KEUANGAN',
                        'MARKETING' => 'MARKETING',
                        'MUTU' => 'MUTU',
                        'PERSONALIA' => 'PERSONALIA',
                        'PPI' => 'PPI',
                        'YANMED' => 'YANMED'], $isi->bagian, ['style' => 'height: auto', 'class' => 'form-select', 'id'
                        =>
                        'bagian','placeholder' => '-- Pilih Bagian --', 'required']) !!}
                        {!! Form::label('bagian', 'Bagian') !!}
                    </div>

                    <div class="col-sm-6 mb-3 form-floating">
                        {!! Form::date('tgl_input', $isi->tgl_input, ['style' => 'height: auto', 'class' =>
                        'form-control',
                        'id' => 'tgl_input', 'required']) !!}
                        {!! Form::label('tgl_input', 'Tanggal') !!}
                    </div>
                </div>

                <div class="col-sm-12 mb-3 form-floating">
                    {!! Form::text('judul', $isi->judul, ['style' => 'height: auto', 'class' => 'form-control', 'id' =>
                    'judul', 'placeholder' => 'Judul', 'required']) !!}
                    {!! Form::label('judul', 'Judul') !!}
                </div>

                <div class="input-group">
                    <input type="file" class="form-control" name="dokumen" required />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal"><i
                        class="fa-solid fa-xmark"></i> Batal</button>
                {{Form::button('<i class="fa-solid fa-check"></i> Ubah Data', ['class' => 'btn btn-sm
                btn-success', 'type' => 'submit'])}}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>