<div class="modal fade" id="detailBundleISK{{$isi->id}}" tabindex="-1" data-bs-backdrop="static"
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
                                <th style="width:10%">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>1</th>
                                <th>Kaji kebutuhan / ada indikasi</th>
                                <td>{{ ($isi->ISK0101 == 1) ? 'Ya' : (($isi->ISK0101 == 0) ? 'Tidak' : 'Tidak
                                    dilakukan') }}</td>
                            </tr>
                            <tr>
                                <th>2</th>
                                <th>Pemasangan oleh petugas yang terlatih</th>
                                <td>{{ ($isi->ISK0102 == 1) ? 'Ya' : (($isi->ISK0102 == 0) ? 'Tidak' : 'Tidak
                                    dilakukan') }}</td>
                            </tr>
                            <tr>
                                <th>3</th>
                                <th>Kebersihan tangan</th>
                                <td>{{ ($isi->ISK0103 == 1) ? 'Ya' : (($isi->ISK0103 == 0) ? 'Tidak' : 'Tidak
                                    dilakukan') }}</td>
                            </tr>
                            <tr>
                                <th>4</th>
                                <th>Tehnik steril</th>
                                <td>{{ ($isi->ISK0104 == 1) ? 'Ya' : (($isi->ISK0104 == 0) ? 'Tidak' : 'Tidak
                                    dilakukan') }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="table table-bordered align-middle">
                        <thead class="text-dark text-center align-middle">
                            <tr>
                                <th style="width:1%">No</th>
                                <th>Bundle Maintenance</th>
                                <th style="width:10%">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>1</th>
                                <th>Hand hygiene</th>
                                <td>{{ ($isi->ISK0201 == 1) ? 'Ya' : (($isi->ISK0201 == 0) ? 'Tidak' : 'Tidak
                                    dilakukan') }}</td>
                            </tr>
                            <tr>
                                <th>2</th>
                                <th>Perawatan cateter perineal setiap hari sesudah BAB</th>
                                <td>{{ ($isi->ISK0202 == 1) ? 'Ya' : (($isi->ISK0202 == 0) ? 'Tidak' : 'Tidak
                                    dilakukan') }}</td>
                            </tr>
                            <tr>
                                <th>3</th>
                                <th>Urine bag tidak dilantai</th>
                                <td>{{ ($isi->ISK0203 == 1) ? 'Ya' : (($isi->ISK0203 == 0) ? 'Tidak' : 'Tidak
                                    dilakukan') }}</td>
                            </tr>
                            <tr>
                                <th>4</th>
                                <th>Urine bag lebih rendah dari kandung kemih</th>
                                <td>{{ ($isi->ISK0204 == 1) ? 'Ya' : (($isi->ISK0204 == 0) ? 'Tidak' : 'Tidak
                                    dilakukan') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>