<div class="modal fade" id="detailBundleVAP{{$isi->id}}" tabindex="-1" data-bs-backdrop="static"
    aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Preview Data</h5>
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
                                <th>Bundle Pemasangan</th>
                                <th style="width:5%">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>1</th>
                                <th>Hand hygiene</th>
                                <td>{{ ($isi->VAP0101 == 1) ? 'Ya' : (($isi->VAP0101 == 0) ? 'Tidak' : 'Tidak
                                    dilakukan') }}</td>
                            </tr>
                            <tr>
                                <th>2</th>
                                <th>Tehnik steril</th>
                                <td>{{ ($isi->VAP0102 == 1) ? 'Ya' : (($isi->VAP0102 == 0) ? 'Tidak' : 'Tidak
                                    dilakukan') }}</td>
                            </tr>
                            <tr>
                                <th>3</th>
                                <th>Pemakaian APD</th>
                                <td>{{ ($isi->VAP0103 == 1) ? 'Ya' : (($isi->VAP0103 == 0) ? 'Tidak' : 'Tidak
                                    dilakukan') }}</td>
                            </tr>
                            <tr>
                                <th>4</th>
                                <th>Sedasi</th>
                                <td>{{ ($isi->VAP0104 == 1) ? 'Ya' : (($isi->VAP0104 == 0) ? 'Tidak' : 'Tidak
                                    dilakukan') }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="table table-bordered align-middle">
                        <thead class="text-dark text-center align-middle">
                            <tr>
                                <th style="width:1%">No</th>
                                <th>Bundle Maintenance</th>
                                <th style="width:5%">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>1</th>
                                <th>Hand hygiene</th>
                                <td>{{ ($isi->VAP0201 == 1) ? 'Ya' : (($isi->VAP0201 == 0) ? 'Tidak' : 'Tidak
                                    dilakukan') }}</td>
                            </tr>
                            <tr>
                                <th>2</th>
                                <th>Oral hygiene 4-6x sehari atau jika perlu</th>
                                <td>{{ ($isi->VAP0202 == 1) ? 'Ya' : (($isi->VAP0202 == 0) ? 'Tidak' : 'Tidak
                                    dilakukan') }}</td>
                            </tr>
                            <tr>
                                <th>3</th>
                                <th>Sikat gigi setiap 12 jam</th>
                                <td>{{ ($isi->VAP0203 == 1) ? 'Ya' : (($isi->IDO04A01 == 0) ? 'Tidak' : 'Tidak
                                    dilakukan') }}</td>
                            </tr>
                            <tr>
                                <th>4</th>
                                <th>Pengkajian sedasi ekstubasi</th>
                                <td>{{ ($isi->VAP0204 == 1) ? 'Ya' : (($isi->VAP0204 == 0) ? 'Tidak' : 'Tidak
                                    dilakukan') }}</td>
                            </tr>
                            <tr>
                                <th>5</th>
                                <th>Posisi kepala 30-45 derajat</th>
                                <td>{{ ($isi->VAP0205 == 1) ? 'Ya' : (($isi->VAP0205 == 0) ? 'Tidak' : 'Tidak
                                    dilakukan') }}</td>
                            </tr>
                            <tr>
                                <th>6</th>
                                <th>Manajemen sekresi / suction</th>
                                <td>{{ ($isi->VAP0206 == 1) ? 'Ya' : (($isi->VAP0206 == 0) ? 'Tidak' : 'Tidak
                                    dilakukan') }}</td>
                            </tr>
                            <tr>
                                <th>7</th>
                                <th>Penggantian selang suction tiap sekali pakai</th>
                                <td>{{ ($isi->VAP0207 == 1) ? 'Ya' : (($isi->VAP0207 == 0) ? 'Tidak' : 'Tidak
                                    dilakukan') }}</td>
                            </tr>
                            <tr>
                                <th>8</th>
                                <th>Penggantian cairan yang digunakan untuk suction pershif</th>
                                <td>{{ ($isi->VAP0208 == 1) ? 'Ya' : (($isi->VAP0208 == 0) ? 'Tidak' : 'Tidak
                                    dilakukan') }}</td>
                            </tr>
                            <tr>
                                <th>9</th>
                                <th>Peptic disease prophylaxis diberikan pada pasien dengan resiko tinggi</th>
                                <td>{{ ($isi->VAP0209 == 1) ? 'Ya' : (($isi->VAP0209 == 0) ? 'Tidak' : 'Tidak
                                    dilakukan') }}</td>
                            </tr>
                            <tr>
                                <th>10</th>
                                <th>Berikan Deep Vein Trombosis (DVT)</th>
                                <td>{{ ($isi->VAP0210 == 1) ? 'Ya' : (($isi->VAP0210 == 0) ? 'Tidak' : 'Tidak
                                    dilakukan') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>