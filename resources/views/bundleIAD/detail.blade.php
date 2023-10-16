<div class="modal fade" id="detailBundleIAD{{$isi->id}}" tabindex="-1" data-bs-backdrop="static"
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
                                <th>Bundle Insersi</th>
                                <th style="width:10%">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>1</th>
                                <th>Hand hygiene</th>
                                <td>{{ ($isi->IAD0301 == 1) ? 'Ya' : (($isi->IAD0301 == 0) ? 'Tidak' : 'Tidak
                                    dilakukan') }}</td>
                            </tr>
                            <tr>
                                <th>2</th>
                                <th>Seleksi area</th>
                                <td>{{ ($isi->IAD0302 == 1) ? 'Ya' : (($isi->IAD0302 == 0) ? 'Tidak' : 'Tidak
                                    dilakukan') }}</td>
                            </tr>
                            <tr>
                                <th>3</th>
                                <th>Antiseptik alkohol based / chlorhexidine</th>
                                <td>{{ ($isi->IAD0303 == 1) ? 'Ya' : (($isi->IAD0303 == 0) ? 'Tidak' : 'Tidak
                                    dilakukan') }}</td>
                            </tr>
                            <tr>
                                <th>4</th>
                                <th>Maksimal pemakaian APD</th>
                                <td>{{ ($isi->IAD0304 == 1) ? 'Ya' : (($isi->IAD0304 == 0) ? 'Tidak' : 'Tidak
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
                                <td>{{ ($isi->IAD0201 == 1) ? 'Ya' : (($isi->IAD0201 == 0) ? 'Tidak' : 'Tidak
                                    dilakukan') }}</td>
                            </tr>
                            <tr>
                                <th>2</th>
                                <th>Disinfeksi CVC dengan alkohol 70%</th>
                                <td>{{ ($isi->IAD0202 == 1) ? 'Ya' : (($isi->IAD0202 == 0) ? 'Tidak' : 'Tidak
                                    dilakukan') }}</td>
                            </tr>
                            <tr>
                                <th>3</th>
                                <th>Ganti dressing jika kotor</th>
                                <td>{{ ($isi->IAD0203 == 1) ? 'Ya' : (($isi->IAD0203 == 0) ? 'Tidak' : 'Tidak
                                    dilakukan') }}</td>
                            </tr>
                            <tr>
                                <th>4</th>
                                <th>Lepas infus jika tidak perlu</th>
                                <td>{{ ($isi->IAD0204 == 1) ? 'Ya' : (($isi->IAD0204 == 0) ? 'Tidak' : 'Tidak
                                    dilakukan') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>