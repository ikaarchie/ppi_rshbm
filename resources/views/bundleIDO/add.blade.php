<div class="modal fade" id="bundleIDO" tabindex="-1" data-bs-backdrop="static" aria-labelledby="modalBundleIDO"
    aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalBundleIDO">Tambah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['url' => 'bundleIdo/save']) !!}
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

                <div class="col-sm-12 mb-3 form-floating">
                    {!! Form::text('tindakan', '', ['style' => 'height: auto', 'class' => 'form-control', 'id' =>
                    'tindakan', 'placeholder' => 'Tindakan', 'required']) !!}
                    {!! Form::label('tindakan', 'Tindakan') !!}
                </div>

                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                    <div class="col-sm-8 mb-3 form-floating">
                        {!! Form::select('unit', [
                        'IGD' => 'IGD',
                        'Intensif' => 'Intensif',
                        'OK' => 'OK',
                        'Perawatan Padma' => 'Perawatan Padma',
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
                                <th>Bundle Pre Operasi</th>
                                <th class="col-1">Ya</th>
                                <th class="col-1">Tidak</th>
                                <th class="col-1">TDD</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>A</th>
                                <th colspan="4">Pasien</th>
                            </tr>
                            <tr>
                                <th>1</th>
                                <th>Mandi dengan antiseptik / sabun mandi cair 2x sebelum tindakan operasi (WP)</th>
                                <td class="text-center">{!! Form::radio('IDO04A01', '1', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('IDO04A01', '0', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('IDO04A01', 'td', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                            </tr>
                            <tr>
                                <th>2</th>
                                <th>Pencukuran bila diperlukan dan dengan menggunakan Clipper 1 jam sebelum tindakan
                                    operasi (BRM)</th>
                                <td class="text-center">{!! Form::radio('IDO04A02', '1', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('IDO04A02', '0', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('IDO04A02', 'td', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                            </tr>
                            <tr>
                                <th>3</th>
                                <th>Gula darah <200 Mg / DI / Normal (BRM)</th>
                                <td class="text-center">{!! Form::radio('IDO04A03', '1', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('IDO04A03', '0', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('IDO04A03', 'td', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                            </tr>
                            <tr>
                                <th>4</th>
                                <th>Antibiotik 30-60 menit sebelum insisi atau sesuai dengan empirik (BRM)</th>
                                <td class="text-center">{!! Form::radio('IDO04A04', '1', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('IDO04A04', '0', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('IDO04A04', 'td', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                            </tr>
                            <tr>
                                <th>5</th>
                                <th>Tidak merokok atau berhenti merokok 30 hari sebelum operasi elektif (WP)</th>
                                <td class="text-center">{!! Form::radio('IDO04A05', '1', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('IDO04A05', '0', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('IDO04A05', 'td', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                            </tr>
                            <tr>
                                <th>6</th>
                                <th>Cuci dan bersihkan area pembedahan dan sekitarnya (BRM)</th>
                                <td class="text-center">{!! Form::radio('IDO04A06', '1', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('IDO04A06', '0', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('IDO04A06', 'td', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                            </tr>
                            <tr>
                                <th>7</th>
                                <th>Menggunakan antiseptik untuk membersihkan kulit (BRM)</th>
                                <td class="text-center">{!! Form::radio('IDO04A07', '1', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('IDO04A07', '0', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('IDO04A07', 'td', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                            </tr>
                            <tr>
                                <th>8</th>
                                <th>Tidak rawat inap > 2x24 jam sebelum tindakan operasi (BRM)</th>
                                <td class="text-center">{!! Form::radio('IDO04A08', '1', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('IDO04A08', '0', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('IDO04A08', 'td', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                            </tr>

                            <tr>
                                <th colspan="5"></th>
                            </tr>
                            <tr>
                                <th>B</th>
                                <th colspan="4">Tim Bedah</th>
                            </tr>
                            <tr>
                                <th>1</th>
                                <th>Kuku pendek, tidak menggunakan cat kuku atau kuku palsu (O)</th>
                                <td class="text-center">{!! Form::radio('IDO04B01', '1', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('IDO04B01', '0', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('IDO04B01', 'td', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                            </tr>
                            <tr>
                                <th>2</th>
                                <th>Cuci tangan bedah (surgical scrub) dengan antiseptik standar (O)</th>
                                <td class="text-center">{!! Form::radio('IDO04B02', '1', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('IDO04B02', '0', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('IDO04B02', 'td', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                            </tr>
                            <tr>
                                <th>3</th>
                                <th>Menggunakan APD lengkap (O)</th>
                                <td class="text-center">{!! Form::radio('IDO04B03', '1', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('IDO04B03', '0', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('IDO04B03', 'td', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="table table-bordered align-middle">
                        <thead class="text-dark text-center align-middle">
                            <tr>
                                <th style="width:1%">No</th>
                                <th>Bundle Intra Operasi</th>
                                <th class="col-1">Ya</th>
                                <th class="col-1">Tidak</th>
                                <th class="col-1">TDD</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>A</th>
                                <th colspan="4">Tim Bedah</th>
                            </tr>
                            <tr>
                                <th>1</th>
                                <th>Gunakan masker bedah untuk menutup mulut dan hidung secara menyeluruh saat memasuki
                                    kamar bedah, saat operasi akan
                                    dimulai atau operasi sedang berjalan</th>
                                <td class="text-center">{!! Form::radio('IDO05A01', '1', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('IDO05A01', '0', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('IDO05A01', 'td', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                            </tr>
                            <tr>
                                <th>2</th>
                                <th>Gunakan tutup kepala sampai anak rambut</th>
                                <td class="text-center">{!! Form::radio('IDO05A02', '1', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('IDO05A02', '0', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('IDO05A02', 'td', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                            </tr>
                            <tr>
                                <th>3</th>
                                <th>Tidak boleh menggunakan cover shoes untuk mencegah IDO</th>
                                <td class="text-center">{!! Form::radio('IDO05A03', '1', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('IDO05A03', '0', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('IDO05A03', 'td', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                            </tr>
                            <tr>
                                <th>4</th>
                                <th>Gunakan sarung tangan steril setelah memakai gaun steril</th>
                                <td class="text-center">{!! Form::radio('IDO05A04', '1', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('IDO05A04', '0', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('IDO05A04', 'td', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                            </tr>
                            <tr>
                                <th colspan="5"></th>
                            </tr>
                            <tr>
                                <th>B</th>
                                <th colspan="4">Ventilasi & peralatan</th>
                            </tr>
                            <tr>
                                <th>1</th>
                                <th>Instrumen steril</th>
                                <td class="text-center">{!! Form::radio('IDO05B01', '1', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('IDO05B01', '0', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('IDO05B01', 'td', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                            </tr>
                            <tr>
                                <th>2</th>
                                <th>Menggunakan antiseptik skin preparasi</th>
                                <td class="text-center">{!! Form::radio('IDO05B02', '1', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('IDO05B02', '0', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('IDO05B02', 'td', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                            </tr>
                            <tr>
                                <th>3</th>
                                <th>Suhu / kelembaban udara 19-20 derajat celcius / 40-60%</th>
                                <td class="text-center">{!! Form::radio('IDO05B03', '1', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('IDO05B03', '0', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('IDO05B03', 'td', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                            </tr>
                            <tr>
                                <th>4</th>
                                <th>Pintu kamar bedah selalu tertutup kecuali untuk lewat alat, petugas dan pasien</th>
                                <td class="text-center">{!! Form::radio('IDO05B04', '1', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('IDO05B04', '0', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('IDO05B04', 'td', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="table table-bordered align-middle">
                        <thead class="text-dark text-center align-middle">
                            <tr>
                                <th style="width:1%">No</th>
                                <th>Bundle Post Operasi</th>
                                <th class="col-1">Ya</th>
                                <th class="col-1">Tidak</th>
                                <th class="col-1">Tidak Dilakukan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>1</th>
                                <th>Luka ditutup 2x24 jam / bila terjadi rembesan segera diganti</th>
                                <td class="text-center">{!! Form::radio('IDO0601', '1', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('IDO0601', '0', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('IDO0601', 'td', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                            </tr>
                            <tr>
                                <th>2</th>
                                <th>Rawat luka dengan tehnik steril menggunakan cairan NaCl</th>
                                <td class="text-center">{!! Form::radio('IDO0602', '1', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('IDO0602', '0', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('IDO0602', 'td', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                            </tr>
                            <tr>
                                <th>3</th>
                                <th>Pankes gizi, kebersihan diri, cara merawat luka dan mobilisasi</th>
                                <td class="text-center">{!! Form::radio('IDO0603', '1', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('IDO0603', '0', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('IDO0603', 'td', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                            </tr>
                            <tr>
                                <th>4</th>
                                <th>Menggunakan APD saat merawat luka sesuai kebutuhan</th>
                                <td class="text-center">{!! Form::radio('IDO0604', '1', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('IDO0604', '0', '', ['class' =>
                                    'form-check-input', 'required']) !!}</td>
                                <td class="text-center">{!! Form::radio('IDO0604', 'td', '', ['class' =>
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