<div class="modal fade" id="bundleIAD" tabindex="-1" data-bs-backdrop="static" aria-labelledby="modalBundleIAD"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalBundleIAD">Tambah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['url' => 'bundle/save']) !!}
                {!! Form::hidden('id') !!}

                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                    <div class="col-sm-4 mb-3 form-floating">
                        {!! Form::number('mrn', '', ['style' => 'height: auto', 'class' => 'form-control', 'id' =>
                        'mrn', 'placeholder' => 'MRN', 'required']) !!}
                        {!! Form::label('mrn', 'MRN') !!}
                    </div>

                    <div class="col-sm-8 mb-3 form-floating">
                        {!! Form::text('nama_pasien', '', ['style' => 'height: auto', 'class' => 'form-control', 'id' =>
                        'nama_pasien', 'placeholder' => 'Nama Pasien', 'required']) !!}
                        {!! Form::label('nama_pasien', 'Nama Pasien') !!}
                    </div>
                </div>

                <div class="col-sm-12 mb-3 form-floating">
                    {!! Form::text('diagnosa', '', ['style' => 'height: auto', 'class' => 'form-control', 'id' =>
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
                        'VK' => 'VK'], null, ['style' => 'height: auto', 'class' => 'form-select', 'id' =>
                        'unit','placeholder' => '-- Pilih Unit --', 'required']) !!}
                        {!! Form::label('unit', 'Unit') !!}
                    </div>

                    <div class="col-sm-4 mb-3 form-floating">
                        {!! Form::date('tgl', '', ['style' => 'height: auto', 'class' => 'form-control',
                        'id' => 'tgl', 'required']) !!}
                        {!! Form::label('tgl', 'Tanggal') !!}
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="text-dark text-center align-middle">
                            <tr>
                                <th style="width:1%">No</th>
                                <th>Bundle Insersi</th>
                                <th class="col-1">Ya</th>
                                <th class="col-1">Tidak</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>1</th>
                                <th>Hand hygiene</th>
                                <td class="text-center">{!! Form::radio('IAD0301', '1', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('IAD0301', '0', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                            </tr>
                            <tr>
                                <th>2</th>
                                <th>Seleksi area</th>
                                <td class="text-center">{!! Form::radio('IAD0302', '1', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('IAD0302', '0', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                            </tr>
                            <tr>
                                <th>3</th>
                                <th>Antiseptik alkohol based / chlorhexidine</th>
                                <td class="text-center">{!! Form::radio('IAD0303', '1', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('IAD0303', '0', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                            </tr>
                            <tr>
                                <th>4</th>
                                <th>Maksimal pemakaian APD</th>
                                <td class="text-center">{!! Form::radio('IAD0304', '1', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('IAD0304', '0', '', ['class' =>
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
                                <td class="text-center">{!! Form::radio('IAD0201', '1', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('IAD0201', '0', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                            </tr>
                            <tr>
                                <th>2</th>
                                <th>Disinfeksi CVC dengan alkohol 70%</th>
                                <td class="text-center">{!! Form::radio('IAD0202', '1', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('IAD0202', '0', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                            </tr>
                            <tr>
                                <th>3</th>
                                <th>Ganti dressing jika kotor</th>
                                <td class="text-center">{!! Form::radio('IAD0203', '1', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('IAD0203', '0', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                            </tr>
                            <tr>
                                <th>4</th>
                                <th>Lepas infus jika tidak perlu</th>
                                <td class="text-center">{!! Form::radio('IAD0204', '1', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('IAD0204', '0', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                            </tr>
                        </tbody>
                    </table>
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
</div>
</div>

<script>

</script>