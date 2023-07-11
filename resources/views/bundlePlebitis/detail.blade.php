<div class="modal fade" id="detailBundlePlebitis{{$isi->id}}" tabindex="-1" data-bs-backdrop="static"
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

                    <div class="table-responsive">
                        <table class="table table-bordered align-middle">
                            <thead class="text-dark text-center align-middle">
                                <tr>
                                    <th style="width:1%">No</th>
                                    <th>Bundle Insersi</th>
                                    <th style="width:5%">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>1</th>
                                    <th>Hand hygiene</th>
                                    <td>{{ $isi->PLB0301 == 1 ? 'Ya' : 'Tidak' }}</td>
                                </tr>
                                <tr>
                                    <th>2</th>
                                    <th>Kaji kebutuhan</th>
                                    <td>{{ $isi->PLB0302 == 1 ? 'Ya' : 'Tidak' }}</td>
                                </tr>
                                <tr>
                                    <th>3</th>
                                    <th>Tehnik steril</th>
                                    <td>{{ $isi->PLB0303 == 1 ? 'Ya' : 'Tidak' }}</td>
                                </tr>
                                <tr>
                                    <th>4</th>
                                    <th>Desinfeksi area insersi</th>
                                    <td>{{ $isi->PLB0304 == 1 ? 'Ya' : 'Tidak' }}</td>
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
                                    <td>{{ $isi->PLB0201 == 1 ? 'Ya' : 'Tidak' }}</td>
                                </tr>
                                <tr>
                                    <th>2</th>
                                    <th>Perawatan area insersi</th>
                                    <td>{{ $isi->PLB0202 == 1 ? 'Ya' : 'Tidak' }}</td>
                                </tr>
                                <tr>
                                    <th>3</th>
                                    <th>Kaji kebutuhan, jika tidak diperlukan segera lepas</th>
                                    <td>{{ $isi->PLB0203 == 1 ? 'Ya' : 'Tidak' }}</td>
                                </tr>
                                <tr>
                                    <th>4</th>
                                    <th>Penggantian administrasi set</th>
                                    <td>{{ $isi->PLB0204 == 1 ? 'Ya' : 'Tidak' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>