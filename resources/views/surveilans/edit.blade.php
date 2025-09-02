<div class="modal fade" id="edit{{$isi->id}}" tabindex="-1" data-bs-backdrop="static" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Ubah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::model($isi, [ 'method' => 'patch','route' => ['updateSurveilans', $isi->id] ]) !!}
                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                    <div class="col-sm-4 mb-3 form-floating">
                        {!! Form::number('mrn', $isi->mrn, ['style' => 'height: auto', 'class' => 'form-control', 'id'
                        => 'mrn', 'placeholder' => 'MRN', 'required']) !!}
                        {!! Form::label('mrn', 'MRN') !!}
                    </div>

                    <div class="col-sm-8 mb-3 form-floating">
                        {!! Form::text('nama_pasien', $isi->nama_pasien, ['style' => 'height: auto', 'class' =>
                        'form-control', 'id' =>
                        'nama_pasien', 'placeholder' => 'Nama Pasien', 'required']) !!}
                        {!! Form::label('nama_pasien', 'Nama Pasien') !!}
                    </div>
                </div>

                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                    <div class="col-sm-4 mb-3 form-floating">
                        {!! Form::text('usia', $isi->usia, ['style' => 'height: auto', 'class' => 'form-control',
                        'id' =>
                        'usia', 'placeholder' => 'Usia', 'step'=>'any', 'required']) !!}
                        {!! Form::label('usia', 'Usia') !!}
                    </div>

                    <div class="col-sm-8 mb-3 form-floating">
                        {!! Form::select('jenis_kelamin', [
                        'Laki-laki' => 'Laki-laki',
                        'Perempuan' => 'Perempuan'
                        ], $isi->jenis_kelamin, ['style' => 'height: auto', 'class' => 'form-select', 'id' =>
                        'jenis_kelamin', 'placeholder' =>
                        '-- Pilih jenis kelamin --','required']) !!}
                        {!! Form::label('jenis_kelamin', 'Jenis Kelamin') !!}
                    </div>
                </div>

                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                    <div class="col-sm-6 mb-3 form-floating">
                        {{-- {!! Form::label('unit', 'Unit') !!} --}}
                        {!! Form::select('unit', [
                        'ICU' => 'ICU',
                        'PICU' => 'PICU',
                        'NICU' => 'NICU',
                        'HCU' => 'HCU',
                        'Perawatan Padma' => 'Perawatan Padma',
                        'Perawatan Reguler lt.4' => 'Perawatan Reguler lt.4',
                        'Perawatan Reguler lt.5' => 'Perawatan Reguler lt.5',
                        'VK' => 'VK'
                        ], $isi->unit, ['style' => 'height: auto', 'class' => 'form-select', 'id' =>
                        'unit','placeholder' => '-- Pilih Unit --', 'required']) !!}
                        {!! Form::label('unit', 'Unit') !!}
                    </div>

                    <div class="col-sm-6 mb-3 form-floating">
                        {!! Form::date('tgl_input', $isi->tgl_input, ['style' => 'height: auto', 'class' =>
                        'form-control', 'id' => 'tgl_input', 'required']) !!}
                        {!! Form::label('tgl_input', 'Tanggal') !!}
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header">
                        Pemasangan Alat
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                            <div class="col-sm-3 form-floating">
                                {!! Form::number('pa_ivl', $isi->pa_ivl, ['style' => 'height: auto', 'class' =>
                                'form-control', 'id' => 'pa_ivl', 'placeholder' => 'IVL', 'step'=>'any', 'required'])
                                !!}
                                {!! Form::label('pa_ivl', 'IVL') !!}
                            </div>
                            <div class="col-sm-3 form-floating">
                                {!! Form::number('pa_dc', $isi->pa_dc, ['style' => 'height: auto', 'class' =>
                                'form-control', 'id' => 'pa_dc', 'placeholder' => 'DC', 'step'=>'any', 'required']) !!}
                                {!! Form::label('pa_dc', 'DC') !!}
                            </div>
                            <div class="col-sm-3 form-floating">
                                {!! Form::number('pa_vent', $isi->pa_vent, ['style' => 'height: auto', 'class' =>
                                'form-control', 'id' => 'pa_vent', 'placeholder' => 'Vent', 'step'=>'any', 'required'])
                                !!}
                                {!! Form::label('pa_vent', 'Vent') !!}
                            </div>
                            <div class="col-sm-3 form-floating">
                                {!! Form::number('pa_iad', $isi->pa_iad, ['style' => 'height: auto', 'class' =>
                                'form-control', 'id' => 'pa_iad', 'placeholder' => 'CVC', 'step'=>'any', 'required'])
                                !!}
                                {!! Form::label('pa_iad', 'CVC') !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header">
                        HAIs
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mb-2">
                            <div class="col-sm-3 form-floating">
                                {!! Form::number('hais_plebitis', $isi->hais_plebitis, ['style' => 'height: auto',
                                'class' => 'form-control', 'id' => 'hais_plebitis', 'placeholder' => 'Plebitis',
                                'step'=>'any','required']) !!}
                                {!! Form::label('hais_plebitis', 'Plebitis') !!}
                            </div>
                            <div class="col-sm-3 form-floating">
                                {!! Form::number('hais_isk', $isi->hais_isk, ['style' => 'height: auto', 'class' =>
                                'form-control', 'id' => 'hais_isk', 'placeholder' => 'ISK',
                                'step'=>'any', 'required']) !!}
                                {!! Form::label('hais_isk', 'ISK') !!}
                            </div>
                            <div class="col-sm-3 form-floating">
                                {!! Form::number('hais_vap', $isi->hais_vap, ['style' => 'height: auto', 'class' =>
                                'form-control', 'id' => 'hais_vap', 'placeholder' => 'VAP',
                                'step'=>'any','required']) !!}
                                {!! Form::label('hais_vap', 'VAP') !!}
                            </div>
                        </div>
                        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                            <div class="col-sm-3 form-floating">
                                {!! Form::number('hais_iad', $isi->hais_iad, ['style' => 'height: auto', 'class' =>
                                'form-control', 'id' => 'hais_iad', 'placeholder' => 'IAD',
                                'step'=>'any', 'required']) !!}
                                {!! Form::label('hais_iad', 'IAD') !!}
                            </div>
                            <div class="col-sm-3 form-floating">
                                {!! Form::number('hais_deku', $isi->hais_deku, ['style' => 'height: auto', 'class' =>
                                'form-control', 'id' => 'hais_deku', 'placeholder' => 'DEKU',
                                'step'=>'any', 'required']) !!}
                                {!! Form::label('hais_deku', 'DEKU') !!}
                            </div>
                            <div class="col-sm-3 form-floating">
                                {!! Form::number('hais_hap', $isi->hais_hap, ['style' => 'height: auto', 'class' =>
                                'form-control', 'id' => 'hais_hap', 'placeholder' => 'HAP',
                                'step'=>'any', 'required']) !!}
                                {!! Form::label('hais_hap', 'HAP') !!}
                            </div>
                            <div class="col-sm-3 form-floating">
                                {!! Form::number('hais_ido', $isi->hais_ido, ['style' => 'height: auto', 'class' =>
                                'form-control', 'id' => 'hais_ido', 'placeholder' => 'IDO',
                                'step'=>'any', 'required']) !!}
                                {!! Form::label('hais_ido', 'IDO') !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                    <div class="col-sm-6 mb-3 form-floating">
                        {!! Form::number('terpajan', $isi->terpajan, ['style' => 'height: auto', 'class' =>
                        'form-control', 'id' => 'terpajan', 'placeholder' => 'Karyawan Tertusuk Jarum',
                        'step'=>'any', 'required']) !!}
                        {!! Form::label('terpajan', 'Karyawan Tertusuk Jarum') !!}
                    </div>
                    <div class="col-sm-6 mb-3 form-floating">
                        {!! Form::number('tirah_baring', $isi->tirah_baring, ['style' => 'height: auto', 'class' =>
                        'form-control', 'id' => 'tirah_baring', 'placeholder' => 'Pasien Tirah Baring',
                        'step'=>'any', 'required']) !!}
                        {!! Form::label('tirah_baring', 'Pasien Tirah Baring') !!}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal"><i
                        class="fa-solid fa-xmark"></i> Batal</button>
                {{Form::button('<i class="fa-solid fa-check"></i> Ubah Data', ['class' => 'btn btn-sm
                btn-success',
                'type' => 'submit'])}}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>