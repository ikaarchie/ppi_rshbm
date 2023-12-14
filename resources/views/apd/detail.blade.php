<div class="modal fade" id="detailapd{{$isi->id}}" tabindex="-1" data-bs-backdrop="static"
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
                                <th class="col-2">Nama</th>
                                <td>{{ $isi->nama }}</td>
                            </tr>
                            <tr>
                                <th class="col-2">Unit</th>
                                <td>{{ $isi->unit }}</td>
                            </tr>
                            <tr>
                                <th class="col-2">Tanggal</th>
                                <td>{{ date("d/m/Y", strtotime($isi->tgl_input)) }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="table table-bordered align-middle">
                        <thead class="text-dark text-center align-middle">
                            <tr>
                                <th style="width:1%">No</th>
                                <th></th>
                                <th style="width:10%">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>1</th>
                                <th>Penutup kepala</th>
                                <td>{{ ($isi->pntp_kpl == 1) ? 'Ya' : (($isi->pntp_kpl == 0) ? 'Tidak' : 'Tidak
                                    dilakukan') }}</td>
                            </tr>
                            <tr>
                                <th>2</th>
                                <th>Masker</th>
                                <td>{{ ($isi->masker == 1) ? 'Ya' : (($isi->masker == 0) ? 'Tidak' : 'Tidak
                                    dilakukan') }}</td>
                            </tr>
                            <tr>
                                <th>3</th>
                                <th>Kacamata google / faceshield</th>
                                <td>{{ ($isi->pntp_wjh == 1) ? 'Ya' : (($isi->pntp_wjh == 0) ? 'Tidak' : 'Tidak
                                    dilakukan') }}</td>
                            </tr>
                            <tr>
                                <th>4</th>
                                <th>Apron</th>
                                <td>{{ ($isi->apron == 1) ? 'Ya' : (($isi->apron == 0) ? 'Tidak' : 'Tidak
                                    dilakukan') }}</td>
                            </tr>
                            <tr>
                                <th>5</th>
                                <th>Sarung tangan</th>
                                <td>{{ ($isi->srg_tgn == 1) ? 'Ya' : (($isi->srg_tgn == 0) ? 'Tidak' : 'Tidak
                                    dilakukan') }}</td>
                            </tr>
                            <tr>
                                <th>6</th>
                                <th>Sandal / sepatu boot</th>
                                <td>{{ ($isi->alas_kaki == 1) ? 'Ya' : (($isi->alas_kaki == 0) ? 'Tidak' : 'Tidak
                                    dilakukan') }}</td>
                            </tr>
                            <tr>
                                <th>7</th>
                                <th>Segera melepas APD selesai melakukan</th>
                                <td>{{ ($isi->lps_apd == 1) ? 'Ya' : (($isi->lps_apd == 0) ? 'Tidak' : 'Tidak
                                    dilakukan') }}</td>
                            </tr>
                            <tr>
                                <th>8</th>
                                <th>Tidak menggantung masker di leher</th>
                                <td>{{ ($isi->tdk_gtg_masker == 1) ? 'Ya' : (($isi->tdk_gtg_masker == 0) ? 'Tidak' :
                                    'Tidak
                                    dilakukan') }}</td>
                            </tr>
                            <tr>
                                <th>9</th>
                                <th>Tidak menggunakan sarung tangan sambil menulis / menyentuh lingkungan yang
                                    tidak direkomendasikan</th>
                                <td>{{ ($isi->tdk_guna_srg_tgn == 1) ? 'Ya' : (($isi->tdk_guna_srg_tgn == 0) ? 'Tidak' :
                                    'Tidak
                                    dilakukan') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>