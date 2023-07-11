<div class="modal fade" id="bundleISK" tabindex="-1" data-bs-backdrop="static" aria-labelledby="modalBundleISK"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalBundleISK">Tambah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['url' => 'bundleIsk/save']) !!}
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
                                <th>Bundle Pemasangan</th>
                                <th class="col-1">Ya</th>
                                <th class="col-1">Tidak</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>1</th>
                                <th>Kaji kebutuhan / ada indikasi</th>
                                <td class="text-center">{!! Form::radio('ISK0101', '1', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('ISK0101', '0', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                            </tr>
                            <tr>
                                <th>2</th>
                                <th>Pemasangan oleh petugas yang terlatih</th>
                                <td class="text-center">{!! Form::radio('ISK0102', '1', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('ISK0102', '0', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                            </tr>
                            <tr>
                                <th>3</th>
                                <th>Kebersihan tangan</th>
                                <td class="text-center">{!! Form::radio('ISK0103', '1', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('ISK0103', '0', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                            </tr>
                            <tr>
                                <th>4</th>
                                <th>Tehnik steril</th>
                                <td class="text-center">{!! Form::radio('ISK0104', '1', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('ISK0104', '0', '', ['class' =>
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
                                <td class="text-center">{!! Form::radio('ISK0201', '1', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('ISK0201', '0', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                            </tr>
                            <tr>
                                <th>2</th>
                                <th>Perawatan cateter perineal setiap hari sesudah BAB</th>
                                <td class="text-center">{!! Form::radio('ISK0202', '1', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('ISK0202', '0', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                            </tr>
                            <tr>
                                <th>3</th>
                                <th>Urine bag tidak dilantai</th>
                                <td class="text-center">{!! Form::radio('ISK0203', '1', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('ISK0203', '0', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                            </tr>
                            <tr>
                                <th>4</th>
                                <th>Urine bag lebih rendah dari kandung kemih</th>
                                <td class="text-center">{!! Form::radio('ISK0204', '1', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('ISK0204', '0', '', ['class' =>
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