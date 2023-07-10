<div class="modal fade" id="bundle" tabindex="-1" data-bs-backdrop="static" aria-labelledby="modalBundle"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalBundle">Tambah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
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

                <div class="col-sm mb-3 form-floating">
                    {!! Form::text('tindakan', '', ['style' => 'height: auto', 'class' => 'form-control', 'id' =>
                    'tindakan', 'placeholder' => 'Tindakan', 'required']) !!}
                    {!! Form::label('tindakan', 'Tindakan') !!}
                </div>

                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                    <div class="col-sm-8 mb-3 form-floating">
                        {!! Form::select('unit', [
                        'CSSU' => 'CSSU',
                        'Dapur' => 'Dapur',
                        'DPJP' => 'DPJP',
                        'Farmasi' => 'Farmasi',
                        'IGD' => 'IGD',
                        'Intensif' => 'Intensif',
                        'Kebersihan' => 'Kebersihan',
                        'KBBL' => 'KBBL',
                        'Laboratorium' => 'Laboratorium',
                        'Laundry' => 'Laundry',
                        'OK' => 'OK',
                        'Perawatan Eksekutif lt.2' => 'Perawatan Eksekutif lt.2',
                        'Perawatan Reguler lt.4' => 'Perawatan Reguler lt.4',
                        'Perawatan Reguler lt.5' => 'Perawatan Reguler lt.5',
                        'Poliklinik' => 'Poliklinik',
                        'Radiologi' => 'Radiologi',
                        'VK' => 'VK'], null, ['style' => 'height: auto', 'class' => 'form-select', 'id' =>
                        'unit','placeholder' => '-- Pilih Unit --', 'required']) !!}
                        {!! Form::label('unit', 'Unit') !!}
                    </div>

                    <div class="col-sm-4 mb-3 form-floating">
                        {!! Form::date('tgl_input', '', ['style' => 'height: auto', 'class' => 'form-control',
                        'id' => 'tgl_input', 'required']) !!}
                        {!! Form::label('tgl_input', 'Tanggal') !!}
                    </div>
                </div>

                {{-- <form class="formm"> --}}
                    {{-- <div class="form1"> --}}
                        <div class="card mb-2">
                            <div class="card-header">
                                Bundle IAD
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered align-middle">
                                        <thead class="text-dark text-center align-middle">
                                            <tr>
                                                <th class="col-1">No</th>
                                                <th>Bundle Insersi</th>
                                                <th class="col-1">Ya</th>
                                                <th class="col-1">Tidak</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>1</th>
                                                <th>Hand hygiene</th>
                                                <td class="text-center">{!! Form::radio('aa', '1', '', ['class' =>
                                                    'form-check-input'], 'required') !!}</td>
                                                <td class="text-center">{!! Form::radio('aa', '0', '', ['class' =>
                                                    'form-check-input'], 'required') !!}</td>
                                            </tr>
                                            <tr>
                                                <th>2</th>
                                                <th>Seleksi area</th>
                                                <td class="text-center">{!! Form::radio('bb', '1', '', ['class' =>
                                                    'form-check-input'], 'required') !!}</td>
                                                <td class="text-center">{!! Form::radio('bbb', '0', '', ['class' =>
                                                    'form-check-input'], 'required') !!}</td>
                                            </tr>
                                            <tr>
                                                <th>3</th>
                                                <th>Antiseptik alkohol based / chlorhexidine</th>
                                                <td class="text-center">{!! Form::radio('cc', '1', '', ['class' =>
                                                    'form-check-input'], 'required') !!}</td>
                                                <td class="text-center">{!! Form::radio('cc', '0', '', ['class' =>
                                                    'form-check-input'], 'required') !!}</td>
                                            </tr>
                                            <tr>
                                                <th>4</th>
                                                <th>Maksimal pemakaian APD</th>
                                                <td class="text-center">{!! Form::radio('dd', '1', '', ['class' =>
                                                    'form-check-input'], 'required') !!}</td>
                                                <td class="text-center">{!! Form::radio('dd', '0', '', ['class' =>
                                                    'form-check-input'], 'required') !!}</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <table class="table table-bordered align-middle">
                                        <thead class="text-dark text-center align-middle">
                                            <tr>
                                                <th class="col-1">No</th>
                                                <th>Bundle Maintenance</th>
                                                <th class="col-1">Ya</th>
                                                <th class="col-1">Tidak</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>1</th>
                                                <th>Hand hygiene</th>
                                                <td class="text-center">{!! Form::radio('aaa', '1', '', ['class' =>
                                                    'form-check-input'], 'required') !!}</td>
                                                <td class="text-center">{!! Form::radio('aaa', '0', '', ['class' =>
                                                    'form-check-input'], 'required') !!}</td>
                                            </tr>
                                            <tr>
                                                <th>2</th>
                                                <th>Disinfeksi CVC dengan alkohol 70%</th>
                                                <td class="text-center">{!! Form::radio('bbb', '1', '', ['class' =>
                                                    'form-check-input'], 'required') !!}</td>
                                                <td class="text-center">{!! Form::radio('bbb', '0', '', ['class' =>
                                                    'form-check-input'], 'required') !!}</td>
                                            </tr>
                                            <tr>
                                                <th>3</th>
                                                <th>Ganti dressing jika kotor</th>
                                                <td class="text-center">{!! Form::radio('ccc', '1', '', ['class' =>
                                                    'form-check-input'], 'required') !!}</td>
                                                <td class="text-center">{!! Form::radio('ccc', '0', '', ['class' =>
                                                    'form-check-input'], 'required') !!}</td>
                                            </tr>
                                            <tr>
                                                <th>4</th>
                                                <th>Lepas infus jika tidak perlu</th>
                                                <td class="text-center">{!! Form::radio('ddd', '1', '', ['class' =>
                                                    'form-check-input'], 'required') !!}</td>
                                                <td class="text-center">{!! Form::radio('ddd', '0', '', ['class' =>
                                                    'form-check-input'], 'required') !!}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="d-sm-flex justify-content-sm-end">
                            <button type="submit" class="btn btn-outline-primary next">Selanjutnya <i
                                    class="fa-solid fa-angles-right"></i></button>
                        </div>
                        {{--
                    </div> --}}

                    {{-- <div class="form2"> --}}
                        <div class="card mb-2">
                            <div class="card-header">
                                Bundle IAD
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered align-middle">
                                        <thead class="text-dark text-center align-middle">
                                            <tr>
                                                <th class="col-1">No</th>
                                                <th>Bundle Insersi</th>
                                                <th class="col-1">Ya</th>
                                                <th class="col-1">Tidak</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>1</th>
                                                <th>Hand hygiene</th>
                                                <td class="text-center">{!! Form::radio('aa', '1', '', ['class' =>
                                                    'form-check-input'], 'required') !!}</td>
                                                <td class="text-center">{!! Form::radio('aa', '0', '', ['class' =>
                                                    'form-check-input'], 'required') !!}</td>
                                            </tr>
                                            <tr>
                                                <th>2</th>
                                                <th>Seleksi area</th>
                                                <td class="text-center">{!! Form::radio('bb', '1', '', ['class' =>
                                                    'form-check-input'], 'required') !!}</td>
                                                <td class="text-center">{!! Form::radio('bbb', '0', '', ['class' =>
                                                    'form-check-input'], 'required') !!}</td>
                                            </tr>
                                            <tr>
                                                <th>3</th>
                                                <th>Antiseptik alkohol based / chlorhexidine</th>
                                                <td class="text-center">{!! Form::radio('cc', '1', '', ['class' =>
                                                    'form-check-input'], 'required') !!}</td>
                                                <td class="text-center">{!! Form::radio('cc', '0', '', ['class' =>
                                                    'form-check-input'], 'required') !!}</td>
                                            </tr>
                                            <tr>
                                                <th>4</th>
                                                <th>Maksimal pemakaian APD</th>
                                                <td class="text-center">{!! Form::radio('dd', '1', '', ['class' =>
                                                    'form-check-input'], 'required') !!}</td>
                                                <td class="text-center">{!! Form::radio('dd', '0', '', ['class' =>
                                                    'form-check-input'], 'required') !!}</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <table class="table table-bordered align-middle">
                                        <thead class="text-dark text-center align-middle">
                                            <tr>
                                                <th class="col-1">No</th>
                                                <th>Bundle Maintenance</th>
                                                <th class="col-1">Ya</th>
                                                <th class="col-1">Tidak</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>1</th>
                                                <th>Hand hygiene</th>
                                                <td class="text-center">{!! Form::radio('aaa', '1', '', ['class' =>
                                                    'form-check-input'], 'required') !!}</td>
                                                <td class="text-center">{!! Form::radio('aaa', '0', '', ['class' =>
                                                    'form-check-input'], 'required') !!}</td>
                                            </tr>
                                            <tr>
                                                <th>2</th>
                                                <th>Disinfeksi CVC dengan alkohol 70%</th>
                                                <td class="text-center">{!! Form::radio('bbb', '1', '', ['class' =>
                                                    'form-check-input'], 'required') !!}</td>
                                                <td class="text-center">{!! Form::radio('bbb', '0', '', ['class' =>
                                                    'form-check-input'], 'required') !!}</td>
                                            </tr>
                                            <tr>
                                                <th>3</th>
                                                <th>Ganti dressing jika kotor</th>
                                                <td class="text-center">{!! Form::radio('ccc', '1', '', ['class' =>
                                                    'form-check-input'], 'required') !!}</td>
                                                <td class="text-center">{!! Form::radio('ccc', '0', '', ['class' =>
                                                    'form-check-input'], 'required') !!}</td>
                                            </tr>
                                            <tr>
                                                <th>4</th>
                                                <th>Lepas infus jika tidak perlu</th>
                                                <td class="text-center">{!! Form::radio('ddd', '1', '', ['class' =>
                                                    'form-check-input'], 'required') !!}</td>
                                                <td class="text-center">{!! Form::radio('ddd', '0', '', ['class' =>
                                                    'form-check-input'], 'required') !!}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="d-sm-flex justify-content-sm-between">
                            <button type="button" class="btn btn-outline-primary"><i
                                    class="fa-solid fa-angles-left back"></i>
                                Sebelumnya</button>
                            <button type="button" class="btn btn-outline-primary">Selanjutnya <i
                                    class="fa-solid fa-angles-right next"></i></button>
                        </div>
                        {{--
                    </div> --}}
                    {{-- </form> --}}
            </div>
        </div>
    </div>
</div>

<script>

</script>