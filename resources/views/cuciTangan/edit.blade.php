<div class="modal fade" id="editCuciTangan{{$isi->id}}" tabindex="-1" data-bs-backdrop="static"
    aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Ubah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::model($isi, [ 'method' => 'patch','route' => ['updateCuciTangan', $isi->id] ]) !!}

                <div class="col-sm mb-3 form-floating">
                    {!! Form::text('nama', $isi->nama, ['style' => 'height: auto', 'class' => 'form-control', 'id' =>
                    'nama', 'placeholder' => 'Nama Pasien', 'required']) !!}
                    {!! Form::label('nama', 'Nama') !!}
                </div>

                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                    <div class="col-sm-6 mb-3 form-floating">
                        {!! Form::select('unit', [
                        'CSSU' => 'CSSU',
                        'Dapur' => 'Dapur',
                        'DPJP' => 'DPJP',
                        'Farmasi' => 'Farmasi',
                        'IGD' => 'IGD',
                        'Intensif' => 'Intensif',
                        'KBBL' => 'KBBL',
                        'Laboratorium' => 'Laboratorium',
                        'Laundry' => 'Laundry',
                        'OK' => 'OK',
                        'Perawatan Eksekutif lt.2' => 'Perawatan Eksekutif lt.2',
                        'Perawatan Reguler lt.4' => 'Perawatan Reguler lt.4',
                        'Perawatan Reguler lt.5' => 'Perawatan Reguler lt.5',
                        'Poliklinik' => 'Poliklinik',
                        'Radiologi' => 'Radiologi',
                        'VK' => 'VK'], $isi->unit, ['style' => 'height: auto', 'class' => 'form-select', 'id' =>
                        'unit','placeholder' => '-- Pilih Unit --', 'required']) !!}
                        {!! Form::label('unit', 'Unit') !!}
                    </div>

                    <div class="col-sm-6 mb-3 form-floating">
                        {!! Form::date('tgl_input', $isi->tgl_input, ['style' => 'height: auto', 'class' =>
                        'form-control',
                        'id' => 'tgl_input', 'required']) !!}
                        {!! Form::label('tgl_input', 'Tanggal') !!}
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header">
                        OPP
                    </div>
                    <div class="card-body">
                        <div class="d-sm-flex justify-content-sm-center mb-2">
                            <div class="col-sm-6">
                                {!! Form::label('sbl_kon_psn', 'Sebelum kontak pasien') !!}
                            </div>
                            <div class="col-sm-6 text-end">
                                {!! Form::radio('sbl_kon_psn', '1', '', ['class' => 'form-check-input'], 'required')
                                !!}
                                {!! Form::label('sbl_kon_psn', 'Ya', ['class' => 'form-check-label']) !!}
                                {!! Form::radio('sbl_kon_psn', '0', '', ['class' => 'form-check-input'], 'required')
                                !!}
                                {!! Form::label('sbl_kon_psn', 'Tidak', ['class' => 'form-check-label']) !!}
                                {!! Form::radio('sbl_kon_psn', 'td', '', ['class' => 'form-check-input'], 'required')
                                !!}
                                {!! Form::label('sbl_kon_psn', 'Tidak dilakukan', ['class' => 'form-check-label']) !!}
                            </div>
                        </div>

                        <div class="d-sm-flex justify-content-sm-center mb-2">
                            <div class="col-sm-6">
                                {!! Form::label('sbl_tin_aseptik', 'Sebelum tindakan aseptik') !!}
                            </div>
                            <div class="col-sm-6 text-end">
                                {!! Form::radio('sbl_tin_aseptik', '1', '', ['class' => 'form-check-input'],
                                'required')
                                !!}
                                {!! Form::label('sbl_tin_aseptik', 'Ya', ['class' => 'form-check-label']) !!}
                                {!! Form::radio('sbl_tin_aseptik', '0', '', ['class' => 'form-check-input'],
                                'required')
                                !!}
                                {!! Form::label('sbl_tin_aseptik', 'Tidak', ['class' => 'form-check-label']) !!}
                                {!! Form::radio('sbl_tin_aseptik', 'td', '', ['class' => 'form-check-input'],
                                'required')
                                !!}
                                {!! Form::label('sbl_tin_aseptik', 'Tidak dilakukan', ['class' => 'form-check-label'])
                                !!}
                            </div>
                        </div>

                        <div class="d-sm-flex justify-content-sm-center mb-2">
                            <div class="col-sm-6">
                                {!! Form::label('stl_kon_cairan', 'Sebelum kontak cairan') !!}
                            </div>
                            <div class="col-sm-6 text-end">
                                {!! Form::radio('stl_kon_cairan', '1', '', ['class' => 'form-check-input'], 'required')
                                !!}
                                {!! Form::label('stl_kon_cairan', 'Ya', ['class' => 'form-check-label']) !!}
                                {!! Form::radio('stl_kon_cairan', '0', '', ['class' => 'form-check-input'],
                                'required')
                                !!}
                                {!! Form::label('stl_kon_cairan', 'Tidak', ['class' => 'form-check-label']) !!}
                                {!! Form::radio('stl_kon_cairan', 'td', '', ['class' => 'form-check-input'],
                                'required')
                                !!}
                                {!! Form::label('stl_kon_cairan', 'Tidak dilakukan', ['class' => 'form-check-label'])
                                !!}
                            </div>
                        </div>

                        <div class="d-sm-flex justify-content-sm-center mb-2">
                            <div class="col-sm-6">
                                {!! Form::label('stl_kon_psn', 'Setelah kontak pasien') !!}
                            </div>
                            <div class="col-sm-6 text-end">
                                {!! Form::radio('stl_kon_psn', '1', '', ['class' => 'form-check-input'], 'required')
                                !!}
                                {!! Form::label('stl_kon_psn', 'Ya', ['class' => 'form-check-label']) !!}
                                {!! Form::radio('stl_kon_psn', '0', '', ['class' => 'form-check-input'], 'required')
                                !!}
                                {!! Form::label('stl_kon_psn', 'Tidak', ['class' => 'form-check-label']) !!}
                                {!! Form::radio('stl_kon_psn', 'td', '', ['class' => 'form-check-input'], 'required')
                                !!}
                                {!! Form::label('stl_kon_psn', 'Tidak dilakukan', ['class' => 'form-check-label']) !!}
                            </div>
                        </div>

                        <div class="d-sm-flex justify-content-sm-center">
                            <div class="col-sm-6">
                                {!! Form::label('stl_kon_ling_psn', 'Setelah kontak lingkungan pasien') !!}
                            </div>
                            <div class="col-sm-6 text-end">
                                {!! Form::radio('stl_kon_ling_psn', '1', '', ['class' => 'form-check-input'],
                                'required')
                                !!}
                                {!! Form::label('stl_kon_ling_psn', 'Ya', ['class' => 'form-check-label']) !!}
                                {!! Form::radio('stl_kon_ling_psn', '0', '', ['class' => 'form-check-input'],
                                'required') !!}
                                {!! Form::label('stl_kon_ling_psn', 'Tidak', ['class' => 'form-check-label']) !!}
                                {!! Form::radio('stl_kon_ling_psn', 'td', '', ['class' => 'form-check-input'],
                                'required') !!}
                                {!! Form::label('stl_kon_ling_psn', 'Tidak dilakukan', ['class' => 'form-check-label'])
                                !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header">
                        HH Action
                    </div>
                    <div class="card-body">
                        <div class="d-sm-flex justify-content-sm-center mb-2">
                            <div class="col-sm-6">
                                {!! Form::label('hr', 'HR') !!}
                            </div>
                            <div class="col-sm-6 text-end">
                                {!! Form::radio('hr', '1', '', ['class' => 'form-check-input'], 'required') !!}
                                {!! Form::label('hr', 'Ya', ['class' => 'form-check-label']) !!}
                                {!! Form::radio('hr', '0', '', ['class' => 'form-check-input'], 'required') !!}
                                {!! Form::label('hr', 'Tidak', ['class' => 'form-check-label']) !!}
                                {!! Form::radio('hr', 'td', '', ['class' => 'form-check-input'], 'required') !!}
                                {!! Form::label('hr', 'Tidak dilakukan', ['class' => 'form-check-label']) !!}
                            </div>
                        </div>

                        <div class="d-sm-flex justify-content-sm-center mb-2">
                            <div class="col-sm-6">
                                {!! Form::label('hw', 'HW') !!}
                            </div>
                            <div class="col-sm-6 text-end">
                                {!! Form::radio('hw', '1', '', ['class' => 'form-check-input'], 'required') !!}
                                {!! Form::label('hw', 'Ya', ['class' => 'form-check-label']) !!}
                                {!! Form::radio('hw', '0', '', ['class' => 'form-check-input'], 'required') !!}
                                {!! Form::label('hw', 'Tidak', ['class' => 'form-check-label']) !!}
                                {!! Form::radio('hw', 'td', '', ['class' => 'form-check-input'], 'required') !!}
                                {!! Form::label('hw', 'Tidak dilakukan', ['class' => 'form-check-label']) !!}
                            </div>
                        </div>

                        <div class="d-sm-flex justify-content-sm-center mb-2">
                            <div class="col-sm-6">
                                {!! Form::label('gagal', 'Gagal') !!}
                            </div>
                            <div class="col-sm-6 text-end">
                                {!! Form::radio('gagal', '1', '', ['class' => 'form-check-input'], 'required') !!}
                                {!! Form::label('gagal', 'Ya', ['class' => 'form-check-label']) !!}
                                {!! Form::radio('gagal', '0', '', ['class' => 'form-check-input'], 'required') !!}
                                {!! Form::label('gagal', 'Tidak', ['class' => 'form-check-label']) !!}
                                {!! Form::radio('gagal', 'td', '', ['class' => 'form-check-input'], 'required') !!}
                                {!! Form::label('gagal', 'Tidak dilakukan', ['class' => 'form-check-label']) !!}
                            </div>
                        </div>

                        <div class="d-sm-flex justify-content-sm-center">
                            <div class="col-sm-6">
                                {!! Form::label('st', 'ST') !!}
                            </div>
                            <div class="col-sm-6 text-end">
                                {!! Form::radio('st', '1', '', ['class' => 'form-check-input'], 'required') !!}
                                {!! Form::label('st', 'Ya', ['class' => 'form-check-label']) !!}
                                {!! Form::radio('st', '0', '', ['class' => 'form-check-input'], 'required') !!}
                                {!! Form::label('st', 'Tidak', ['class' => 'form-check-label']) !!}
                                {!! Form::radio('st', 'td', '', ['class' => 'form-check-input'], 'required') !!}
                                {!! Form::label('st', 'Tidak dilakukan', ['class' => 'form-check-label']) !!}
                            </div>
                        </div>
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