<div class="modal fade" id="editapd{{$isi->id}}" tabindex="-1" data-bs-backdrop="static" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Ubah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::model($isi, [ 'method' => 'patch','route' => ['updateAPD', $isi->id] ]) !!}

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
                        'Kebersihan' => 'Kebersihan',
                        'Laboratorium' => 'Laboratorium',
                        'Laundry' => 'Laundry',
                        'OK' => 'OK',
                        'Perawatan Padma' => 'Perawatan Padma',
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

                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="text-dark text-center align-middle">
                            <tr>
                                <th style="width:1%">No</th>
                                <th></th>
                                <th class="col-1">Ya</th>
                                <th class="col-1">Tidak</th>
                                <th class="col-1">TDD</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>1</th>
                                <th>Penutup kepala</th>
                                <td class="text-center">{!! Form::radio('pntp_kpl', '1', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('pntp_kpl', '0', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('pntp_kpl', 'tdd', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                            </tr>
                            <tr>
                                <th>2</th>
                                <th>Masker</th>
                                <td class="text-center">{!! Form::radio('masker', '1', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('masker', '0', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('masker', 'tdd', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                            </tr>
                            <tr>
                                <th>3</th>
                                <th>Kacamata google / faceshield</th>
                                <td class="text-center">{!! Form::radio('pntp_wjh', '1', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('pntp_wjh', '0', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('pntp_wjh', 'tdd', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                            </tr>
                            <tr>
                                <th>4</th>
                                <th>Apron</th>
                                <td class="text-center">{!! Form::radio('apron', '1', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('apron', '0', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('apron', 'tdd', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                            </tr>
                            <tr>
                                <th>5</th>
                                <th>Sarung tangan</th>
                                <td class="text-center">{!! Form::radio('srg_tgn', '1', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('srg_tgn', '0', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('srg_tgn', 'tdd', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                            </tr>
                            <tr>
                                <th>6</th>
                                <th>Sandal / sepatu boot</th>
                                <td class="text-center">{!! Form::radio('alas_kaki', '1', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('alas_kaki', '0', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('alas_kaki', 'tdd', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                            </tr>
                            <tr>
                                <th>7</th>
                                <th>Segera melepas APD selesai melakukan</th>
                                <td class="text-center">{!! Form::radio('lps_apd', '1', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('lps_apd', '0', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('lps_apd', 'tdd', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                            </tr>
                            <tr>
                                <th>8</th>
                                <th>Tidak menggantung masker di leher</th>
                                <td class="text-center">{!! Form::radio('tdk_gtg_masker', '1', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('tdk_gtg_masker', '0', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('tdk_gtg_masker', 'tdd', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                            </tr>
                            <tr>
                                <th>9</th>
                                <th>Tidak menggunakan sarung tangan sambil menulis / menyentuh lingkungan yang tidak
                                    direkomendasikan</th>
                                <td class="text-center">{!! Form::radio('tdk_guna_srg_tgn', '1', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('tdk_guna_srg_tgn', '0', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('tdk_guna_srg_tgn', 'tdd', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                            </tr>
                        </tbody>
                    </table>
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