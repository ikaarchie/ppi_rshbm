<div class="modal fade" id="detailBundleIDO{{$isi->id}}" tabindex="-1" data-bs-backdrop="static"
    aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Detail Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-striped-columns align-middle">
                        <tbody>
                            <tr>
                                <th class="col-2">MRN</th>
                                <td>{{ $isi->mrn }}</td>
                            </tr>
                            <tr>
                                <th class="col-2">Nama Pasien</th>
                                <td>{{ $isi->nama_pasien }}</td>
                            </tr>
                            <tr>
                                <th class="col-2">Diagnosa</th>
                                <td>{{ $isi->diagnosa }}</td>
                            </tr>
                            <tr>
                                <th class="col-2">Tindakan</th>
                                <td>{{ $isi->tindakan }}</td>
                            </tr>
                            <tr>
                                <th class="col-2">Unit</th>
                                <td>{{ $isi->unit }}</td>
                            </tr>
                            <tr>
                                <th class="col-2">Tanggal</th>
                                <td>{{ date("d/m/Y", strtotime($isi->tgl)) }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="table table-bordered align-middle">
                        <thead class="text-dark text-center align-middle">
                            <tr>
                                <th style="width:1%">No</th>
                                <th>Bundle Pre Operasi</th>
                                <th style="width:10%">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>A</th>
                                <th colspan="3">Pasien</th>
                            </tr>
                            <tr>
                                <th>1</th>
                                <th>Mandi dengan antiseptik / sabun mandi cair 2x sebelum tindakan operasi (WP)</th>
                                <td>{{ ($isi->IDO04A01 == 1) ? 'Ya' : (($isi->IDO04A01 == 0) ? 'Tidak' : 'Tidak
                                    dilakukan') }}</td>
                            </tr>
                            <tr>
                                <th>2</th>
                                <th>Pencukuran bila diperlukan dan dengan menggunakan Clipper 1 jam sebelum tindakan
                                    operasi (BRM)</th>
                                <td>{{ ($isi->IDO04A02 == 1) ? 'Ya' : (($isi->IDO04A02 == 0) ? 'Tidak' : 'Tidak
                                    dilakukan') }}</td>
                            </tr>
                            <tr>
                                <th>3</th>
                                <th>Gula darah <200 Mg / DI / Normal (BRM)</th>
                                <td>{{ ($isi->IDO04A03 == 1) ? 'Ya' : (($isi->IDO04A03 == 0) ? 'Tidak' : 'Tidak
                                    dilakukan') }}</td>
                            </tr>
                            <tr>
                                <th>4</th>
                                <th>Antibiotik 30-60 menit sebelum insisi atau sesuai dengan empirik (BRM)</th>
                                <td>{{ ($isi->IDO04A04 == 1) ? 'Ya' : (($isi->IDO04A04 == 0) ? 'Tidak' : 'Tidak
                                    dilakukan') }}</td>
                            </tr>
                            <tr>
                                <th>5</th>
                                <th>Tidak merokok atau berhenti merokok 30 hari sebelum operasi elektif (WP)</th>
                                <td>{{ ($isi->IDO04A05 == 1) ? 'Ya' : (($isi->IDO04A05 == 0) ? 'Tidak' : 'Tidak
                                    dilakukan') }}</td>
                            </tr>
                            <tr>
                                <th>6</th>
                                <th>Cuci dan bersihkan area pembedahan dan sekitarnya (BRM)</th>
                                <td>{{ ($isi->IDO04A06 == 1) ? 'Ya' : (($isi->IDO04A06 == 0) ? 'Tidak' : 'Tidak
                                    dilakukan') }}</td>
                            </tr>
                            <tr>
                                <th>7</th>
                                <th>Menggunakan antiseptik untuk membersihkan kulit (BRM)</th>
                                <td>{{ ($isi->IDO04A07 == 1) ? 'Ya' : (($isi->IDO04A07 == 0) ? 'Tidak' : 'Tidak
                                    dilakukan') }}</td>
                            </tr>
                            <tr>
                                <th>8</th>
                                <th>Tidak rawat inap > 2x24 jam sebelum tindakan operasi (BRM)</th>
                                <td>{{ ($isi->IDO04A08 == 1) ? 'Ya' : (($isi->IDO04A08 == 0) ? 'Tidak' : 'Tidak
                                    dilakukan') }}</td>
                            </tr>

                            <tr>
                                <th colspan="4"></th>
                            </tr>
                            <tr>
                                <th>B</th>
                                <th colspan="3">Tim Bedah</th>
                            </tr>
                            <tr>
                                <th>1</th>
                                <th>Kuku pendek, tidak menggunakan cat kuku atau kuku palsu (O)</th>
                                <td>{{ ($isi->IDO04B01 == 1) ? 'Ya' : (($isi->IDO04B01 == 0) ? 'Tidak' : 'Tidak
                                    dilakukan') }}</td>
                            </tr>
                            <tr>
                                <th>2</th>
                                <th>Cuci tangan bedah (surgical scrub) dengan antiseptik standar (O)</th>
                                <td>{{ ($isi->IDO04B02 == 1) ? 'Ya' : (($isi->IDO04B02 == 0) ? 'Tidak' : 'Tidak
                                    dilakukan') }}</td>
                            </tr>
                            <tr>
                                <th>3</th>
                                <th>Menggunakan APD lengkap (O)</th>
                                <td>{{ ($isi->IDO04B03 == 1) ? 'Ya' : (($isi->IDO04B03 == 0) ? 'Tidak' : 'Tidak
                                    dilakukan') }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="table table-bordered align-middle">
                        <thead class="text-dark text-center align-middle">
                            <tr>
                                <th style="width:1%">No</th>
                                <th>Bundle Intra Operasi</th>
                                <th style="width:10%">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>A</th>
                                <th colspan="3">Tim Bedah</th>
                            </tr>
                            <tr>
                                <th>1</th>
                                <th>Gunakan masker bedah untuk menutup mulut dan hidung secara menyeluruh saat memasuki
                                    kamar bedah, saat operasi akan
                                    dimulai atau operasi sedang berjalan</th>
                                <td>{{ ($isi->IDO05A01 == 1) ? 'Ya' : (($isi->IDO05A01 == 0) ? 'Tidak' : 'Tidak
                                    dilakukan') }}</td>
                            </tr>
                            <tr>
                                <th>2</th>
                                <th>Gunakan tutup kepala sampai anak rambut</th>
                                <td>{{ ($isi->IDO05A02 == 1) ? 'Ya' : (($isi->IDO05A02 == 0) ? 'Tidak' : 'Tidak
                                    dilakukan') }}</td>
                            </tr>
                            <tr>
                                <th>3</th>
                                <th>Tidak boleh menggunakan cover shoes untuk mencegah IDO</th>
                                <td>{{ ($isi->IDO05A03 == 1) ? 'Ya' : (($isi->IDO05A03 == 0) ? 'Tidak' : 'Tidak
                                    dilakukan') }}</td>
                            </tr>
                            <tr>
                                <th>4</th>
                                <th>Gunakan sarung tangan steril setelah memakai gaun steril</th>
                                <td>{{ ($isi->IDO05A04 == 1) ? 'Ya' : (($isi->IDO05A04 == 0) ? 'Tidak' : 'Tidak
                                    dilakukan') }}</td>
                            </tr>
                            <tr>
                                <th colspan="4"></th>
                            </tr>
                            <tr>
                                <th>B</th>
                                <th colspan="3">Ventilasi & peralatan</th>
                            </tr>
                            <tr>
                                <th>1</th>
                                <th>Instrumen steril</th>
                                <td>{{ ($isi->IDO05B01 == 1) ? 'Ya' : (($isi->IDO05B01 == 0) ? 'Tidak' : 'Tidak
                                    dilakukan') }}</td>
                            </tr>
                            <tr>
                                <th>2</th>
                                <th>Menggunakan antiseptik skin preparasi</th>
                                <td>{{ ($isi->IDO05B02 == 1) ? 'Ya' : (($isi->IDO05B02 == 0) ? 'Tidak' : 'Tidak
                                    dilakukan') }}</td>
                            </tr>
                            <tr>
                                <th>3</th>
                                <th>Suhu / kelembaban udara 19-20 derajat celcius / 40-60%</th>
                                <td>{{ ($isi->IDO05B03 == 1) ? 'Ya' : (($isi->IDO05B03 == 0) ? 'Tidak' : 'Tidak
                                    dilakukan') }}</td>
                            </tr>
                            <tr>
                                <th>4</th>
                                <th>Pintu kamar bedah selalu tertutup kecuali untuk lewat alat, petugas dan pasien</th>
                                <td>{{ ($isi->IDO05B04 == 1) ? 'Ya' : (($isi->IDO05B04 == 0) ? 'Tidak' : 'Tidak
                                    dilakukan') }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="table table-bordered align-middle">
                        <thead class="text-dark text-center align-middle">
                            <tr>
                                <th style="width:1%">No</th>
                                <th>Bundle Post Operasi</th>
                                <th style="width:10%">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>1</th>
                                <th>Luka ditutup 2x24 jam / bila terjadi rembesan segera diganti</th>
                                <td>{{ ($isi->IDO0601 == 1) ? 'Ya' : (($isi->IDO0601 == 0) ? 'Tidak' : 'Tidak
                                    dilakukan') }}</td>
                            </tr>
                            <tr>
                                <th>2</th>
                                <th>Rawat luka dengan tehnik steril menggunakan cairan NaCl</th>
                                <td>{{ ($isi->IDO0602 == 1) ? 'Ya' : (($isi->IDO0602 == 0) ? 'Tidak' : 'Tidak
                                    dilakukan') }}</td>
                            </tr>
                            <tr>
                                <th>3</th>
                                <th>Pankes gizi, kebersihan diri, cara merawat luka dan mobilisasi</th>
                                <td>{{ ($isi->IDO0603 == 1) ? 'Ya' : (($isi->IDO0603 == 0) ? 'Tidak' : 'Tidak
                                    dilakukan') }}</td>
                            </tr>
                            <tr>
                                <th>4</th>
                                <th>Menggunakan APD saat merawat luka sesuai kebutuhan</th>
                                <td>{{ ($isi->IDO0604 == 1) ? 'Ya' : (($isi->IDO0604 == 0) ? 'Tidak' : 'Tidak
                                    dilakukan') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>