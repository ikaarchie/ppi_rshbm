<div class="modal fade" id="editBundleVAP{{$isi->id}}" tabindex="-1" data-bs-backdrop="static"
    aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Ubah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::model($isi, [ 'method' => 'patch','route' => ['updateBundleVap', $isi->id] ]) !!}

                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                    <div class="col-sm-4 mb-3 form-floating">
                        {!! Form::number('mrn', $isi->mrn, ['style' => 'height: auto', 'class' => 'form-control', 'id'
                        =>
                        'mrn', 'placeholder' => 'MRN', 'required']) !!}
                        {!! Form::label('mrn', 'MRN') !!}
                    </div>

                    <div class="col-sm-8 mb-3 form-floating">
                        {!! Form::text('nama_pasien', $isi->nama_pasien, ['style' => 'height: auto', 'class' =>
                        'form-control', 'id' =>
                        'nama_pasien', 'placeholder' => 'Nama Pasien', 'required']) !!}
                        {!! Form::label('nama_pasien', 'Nama Pasien') !!}
                    </div>
                </div>

                <div class="col-sm-12 mb-3 form-floating">
                    {!! Form::text('diagnosa', $isi->diagnosa, ['style' => 'height: auto', 'class' => 'form-control',
                    'id' =>
                    'diagnosa', 'placeholder' => 'Diagnosa', 'required']) !!}
                    {!! Form::label('diagnosa', 'Diagnosa') !!}
                </div>

                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                    <div class="col-sm-8 mb-3 form-floating">
                        {!! Form::select('unit', [
                        'IGD' => 'IGD',
                        'Intensif' => 'Intensif',
                        'OK' => 'OK',
                        'Perawatan Eksekutif lt.2' => 'Perawatan Eksekutif lt.2',
                        'Perawatan Reguler lt.4' => 'Perawatan Reguler lt.4',
                        'Perawatan Reguler lt.5' => 'Perawatan Reguler lt.5',
                        'VK' => 'VK'], $isi->unit, ['style' => 'height: auto', 'class' => 'form-select', 'id' =>
                        'unit','placeholder' => '-- Pilih Unit --', 'required']) !!}
                        {!! Form::label('unit', 'Unit') !!}
                    </div>

                    <div class="col-sm-4 mb-3 form-floating">
                        {!! Form::date('tgl', $isi->tgl, ['style' => 'height: auto', 'class' =>
                        'form-control', 'id' => 'tgl', 'required']) !!}
                        {!! Form::label('tgl', 'Tanggal') !!}
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="text-dark text-center align-middle">
                            <tr>
                                <th style="width:1%">No</th>
                                <th>Bundle Pemasangan</th>
                                <th class="col-1">Ya</th>
                                <th class="col-1">Tidak</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>1</th>
                                <th>Hand hygiene</th>
                                <td class="text-center">{!! Form::radio('VAP0101', '1', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('VAP0101', '0', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('VAP0101', 'td', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                            </tr>
                            <tr>
                                <th>2</th>
                                <th>Tehnik steril</th>
                                <td class="text-center">{!! Form::radio('VAP0102', '1', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('VAP0102', '0', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('VAP0102', 'td', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                            </tr>
                            <tr>
                                <th>3</th>
                                <th>Pemakaian APD</th>
                                <td class="text-center">{!! Form::radio('VAP0103', '1', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('VAP0103', '0', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('VAP0103', 'td', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                            </tr>
                            <tr>
                                <th>4</th>
                                <th>Sedasi</th>
                                <td class="text-center">{!! Form::radio('VAP0104', '1', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('VAP0104', '0', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('VAP0104', 'td', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="table table-bordered align-middle">
                        <thead class="text-dark text-center align-middle">
                            <tr>
                                <th style="width:1%">No</th>
                                <th>Bundle Maintenance</th>
                                <th class="col-1">Ya</th>
                                <th class="col-1">Tidak</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>1</th>
                                <th>Hand hygiene</th>
                                <td class="text-center">{!! Form::radio('VAP0201', '1', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('VAP0201', '0', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('VAP0201', 'td', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                            </tr>
                            <tr>
                                <th>2</th>
                                <th>Oral hygiene 4-6x sehari atau jika perlu</th>
                                <td class="text-center">{!! Form::radio('VAP0202', '1', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('VAP0202', '0', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('VAP0202', 'td', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                            </tr>
                            <tr>
                                <th>3</th>
                                <th>Sikat gigi setiap 12 jam</th>
                                <td class="text-center">{!! Form::radio('VAP0203', '1', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('VAP0203', '0', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('VAP0203', 'td', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                            </tr>
                            <tr>
                                <th>4</th>
                                <th>Pengkajian sedasi ekstubasi</th>
                                <td class="text-center">{!! Form::radio('VAP0204', '1', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('VAP0204', '0', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('VAP0204', 'td', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                            </tr>
                            <tr>
                                <th>5</th>
                                <th>Posisi kepala 33-45 derajat</th>
                                <td class="text-center">{!! Form::radio('VAP0205', '1', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('VAP0205', '0', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('VAP0205', 'td', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                            </tr>
                            <tr>
                                <th>6</th>
                                <th>Manajemen sekresi / suction</th>
                                <td class="text-center">{!! Form::radio('VAP0206', '1', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('VAP0206', '0', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('VAP0206', 'td', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                            </tr>
                            <tr>
                                <th>7</th>
                                <th>Penggantian selang suction 1x24 jam</th>
                                <td class="text-center">{!! Form::radio('VAP0207', '1', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('VAP0207', '0', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('VAP0207', 'td', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                            </tr>
                            <tr>
                                <th>8</th>
                                <th>Penggantian cairan yang digunakan untuk suction pershif</th>
                                <td class="text-center">{!! Form::radio('VAP0208', '1', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('VAP0208', '0', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('VAP0208', 'td', '', ['class' =>
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