<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\BundleVAP;
use Illuminate\Http\Request;
use App\Models\RekapBundleVap;
use App\Exports\ExportBundleVAP;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Redirect;

class BundleVAPController extends Controller
{
    public function index()
    {
        return view('bundleVAP.index');
    }

    public function getData()
    {
        $bundleVAP = BundleVAP::latest('id')->paginate(10);

        return view('bundleVAP.index')->with('bundleVAP', $bundleVAP);
    }

    public function save(Request $request)
    {
        $data = new BundleVAP();
        $data->mrn = $request->input('mrn');
        $data->nama_pasien = $request->input('nama_pasien');
        $data->diagnosa = $request->input('diagnosa');
        $data->unit = $request->input('unit');
        $data->tgl = $request->input('tgl');
        $data->VAP0101 = $request->input('VAP0101');
        $data->VAP0102 = $request->input('VAP0102');
        $data->VAP0103 = $request->input('VAP0103');
        $data->VAP0104 = $request->input('VAP0104');
        $data->VAP0201 = $request->input('VAP0201');
        $data->VAP0202 = $request->input('VAP0202');
        $data->VAP0203 = $request->input('VAP0203');
        $data->VAP0204 = $request->input('VAP0204');
        $data->VAP0205 = $request->input('VAP0205');
        $data->VAP0206 = $request->input('VAP0206');
        $data->VAP0207 = $request->input('VAP0207');
        $data->VAP0208 = $request->input('VAP0208');
        $data->VAP0209 = $request->input('VAP0209');
        $data->VAP0210 = $request->input('VAP0210');
        $data->save();

        return redirect('/bundleVap')->with('success', 'Data berhasil disimpan!');
    }

    public function update(Request $request, $id)
    {
        $bundleVAP = BundleVAP::find($id);
        $input = $request->all();
        $bundleVAP->fill($input)->save();

        return redirect('/bundleVap');
    }

    public function destroy($id)
    {
        $bundleVAP = BundleVAP::find($id);
        $bundleVAP->delete();

        return redirect('/bundleVap');
    }

    public function inputRekap(Request $request)
    {
        $tgl_skg = date('Y-m-d');

        $data = new RekapBundleVap();
        $data->dari = $request->input('dari') ?? $tgl_skg;
        $data->sampai = $request->input('sampai') ?? $tgl_skg;
        $data->analisa = $request->input('analisa');
        $data->tindak_lanjut = $request->input('tindak_lanjut');
        $data->save();

        return redirect('/rekapBundleVap')->with('success', 'Data berhasil disimpan!');
    }

    public function updateRekap(Request $request, $id)
    {
        $rekap = RekapBundleVap::find($id);
        $input = $request->all();
        $rekap->fill($input)->save();

        return redirect('/rekapBundleVap');
    }

    public function rekap(Request $request)
    {
        $tgl_skg = date('Y-m-d');
        $dari = date_create($request->input('dari'));
        $sampai = date_create($request->input('sampai'));
        $diff  = date_diff($dari, $sampai);
        $range_tgl = $diff->d + 1;

        if ($request->input('dari') <= $request->input('sampai')) {
            $tabel = BundleVAP::whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')->paginate(1000);
            // dd($tabel);

            $rekap = RekapBundleVap::whereDate('dari', '=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('sampai', '=', $request->input('sampai') ?? $tgl_skg)
                ->get();

            $analisa = RekapBundleVap::select('analisa')
                ->whereDate('dari', '=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('sampai', '=', $request->input('sampai') ?? $tgl_skg)
                ->get();

            $tindak_lanjut = RekapBundleVap::select('tindak_lanjut')
                ->whereDate('dari', '=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('sampai', '=', $request->input('sampai') ?? $tgl_skg)
                ->get();

            $igd = BundleVAP::where('unit', 'IGD')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $int = BundleVAP::where('unit', 'Intensif')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $ok = BundleVAP::where('unit', 'OK')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt2 = BundleVAP::where('unit', 'Perawatan Eksekutif lt.2')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt4 = BundleVAP::where('unit', 'Perawatan Reguler lt.4')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt5 = BundleVAP::where('unit', 'Perawatan Reguler lt.5')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $vk = BundleVAP::where('unit', 'VK')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();

            $igd_VAP0101 = $igd->where('VAP0101', '1')->count();
            $igd_VAP0102 = $igd->where('VAP0102', '1')->count();
            $igd_VAP0103 = $igd->where('VAP0103', '1')->count();
            $igd_VAP0104 = $igd->where('VAP0104', '1')->count();
            $igd_VAP0201 = $igd->where('VAP0201', '1')->count();
            $igd_VAP0202 = $igd->where('VAP0202', '1')->count();
            $igd_VAP0203 = $igd->where('VAP0203', '1')->count();
            $igd_VAP0204 = $igd->where('VAP0204', '1')->count();
            $igd_VAP0205 = $igd->where('VAP0205', '1')->count();
            $igd_VAP0206 = $igd->where('VAP0206', '1')->count();
            $igd_VAP0207 = $igd->where('VAP0207', '1')->count();
            $igd_VAP0208 = $igd->where('VAP0208', '1')->count();
            $igd_VAP0209 = $igd->where('VAP0209', '1')->count();
            $igd_VAP0210 = $igd->where('VAP0210', '1')->count();
            $igd_jumlah = $igd_VAP0101 + $igd_VAP0102 + $igd_VAP0103 + $igd_VAP0104 + $igd_VAP0201 + $igd_VAP0202 + $igd_VAP0203 + $igd_VAP0204 + $igd_VAP0205 + $igd_VAP0206 + $igd_VAP0207 + $igd_VAP0208 + $igd_VAP0209 + $igd_VAP0210;

            $no_igd_VAP0101 = $igd->where('VAP0101', '0')->count();
            $no_igd_VAP0102 = $igd->where('VAP0102', '0')->count();
            $no_igd_VAP0103 = $igd->where('VAP0103', '0')->count();
            $no_igd_VAP0104 = $igd->where('VAP0104', '0')->count();
            $no_igd_VAP0201 = $igd->where('VAP0201', '0')->count();
            $no_igd_VAP0202 = $igd->where('VAP0202', '0')->count();
            $no_igd_VAP0203 = $igd->where('VAP0203', '0')->count();
            $no_igd_VAP0204 = $igd->where('VAP0204', '0')->count();
            $no_igd_VAP0205 = $igd->where('VAP0205', '0')->count();
            $no_igd_VAP0206 = $igd->where('VAP0206', '0')->count();
            $no_igd_VAP0207 = $igd->where('VAP0207', '0')->count();
            $no_igd_VAP0208 = $igd->where('VAP0208', '0')->count();
            $no_igd_VAP0209 = $igd->where('VAP0209', '0')->count();
            $no_igd_VAP0210 = $igd->where('VAP0210', '0')->count();
            $no_igd_jumlah = $no_igd_VAP0101 + $no_igd_VAP0102 + $no_igd_VAP0103 + $no_igd_VAP0104 + $no_igd_VAP0201 + $no_igd_VAP0202 + $no_igd_VAP0203 + $no_igd_VAP0204 + $no_igd_VAP0205 + $no_igd_VAP0206 + $no_igd_VAP0207 + $no_igd_VAP0208 + $no_igd_VAP0209 + $no_igd_VAP0210;

            $denominator_igd = $igd_jumlah + $no_igd_jumlah;

            $int_VAP0101 = $int->where('VAP0101', '1')->count();
            $int_VAP0102 = $int->where('VAP0102', '1')->count();
            $int_VAP0103 = $int->where('VAP0103', '1')->count();
            $int_VAP0104 = $int->where('VAP0104', '1')->count();
            $int_VAP0201 = $int->where('VAP0201', '1')->count();
            $int_VAP0202 = $int->where('VAP0202', '1')->count();
            $int_VAP0203 = $int->where('VAP0203', '1')->count();
            $int_VAP0204 = $int->where('VAP0204', '1')->count();
            $int_VAP0205 = $int->where('VAP0205', '1')->count();
            $int_VAP0206 = $int->where('VAP0206', '1')->count();
            $int_VAP0207 = $int->where('VAP0207', '1')->count();
            $int_VAP0208 = $int->where('VAP0208', '1')->count();
            $int_VAP0209 = $int->where('VAP0209', '1')->count();
            $int_VAP0210 = $int->where('VAP0210', '1')->count();
            $int_jumlah = $int_VAP0101 + $int_VAP0102 + $int_VAP0103 + $int_VAP0104 + $int_VAP0201 + $int_VAP0202 + $int_VAP0203 + $int_VAP0204 + $int_VAP0205 + $int_VAP0206 + $int_VAP0207 + $int_VAP0208 + $int_VAP0209 + $int_VAP0210;

            $no_int_VAP0101 = $int->where('VAP0101', '0')->count();
            $no_int_VAP0102 = $int->where('VAP0102', '0')->count();
            $no_int_VAP0103 = $int->where('VAP0103', '0')->count();
            $no_int_VAP0104 = $int->where('VAP0104', '0')->count();
            $no_int_VAP0201 = $int->where('VAP0201', '0')->count();
            $no_int_VAP0202 = $int->where('VAP0202', '0')->count();
            $no_int_VAP0203 = $int->where('VAP0203', '0')->count();
            $no_int_VAP0204 = $int->where('VAP0204', '0')->count();
            $no_int_VAP0205 = $int->where('VAP0205', '0')->count();
            $no_int_VAP0206 = $int->where('VAP0206', '0')->count();
            $no_int_VAP0207 = $int->where('VAP0207', '0')->count();
            $no_int_VAP0208 = $int->where('VAP0208', '0')->count();
            $no_int_VAP0209 = $int->where('VAP0209', '0')->count();
            $no_int_VAP0210 = $int->where('VAP0210', '0')->count();
            $no_int_jumlah = $no_int_VAP0101 + $no_int_VAP0102 + $no_int_VAP0103 + $no_int_VAP0104 + $no_int_VAP0201 + $no_int_VAP0202 + $no_int_VAP0203 + $no_int_VAP0204 + $no_int_VAP0205 + $no_int_VAP0206 + $no_int_VAP0207 + $no_int_VAP0208 + $no_int_VAP0209 + $no_int_VAP0210;

            $denominator_int = $int_jumlah + $no_int_jumlah;

            $ok_VAP0101 = $ok->where('VAP0101', '1')->count();
            $ok_VAP0102 = $ok->where('VAP0102', '1')->count();
            $ok_VAP0103 = $ok->where('VAP0103', '1')->count();
            $ok_VAP0104 = $ok->where('VAP0104', '1')->count();
            $ok_VAP0201 = $ok->where('VAP0201', '1')->count();
            $ok_VAP0202 = $ok->where('VAP0202', '1')->count();
            $ok_VAP0203 = $ok->where('VAP0203', '1')->count();
            $ok_VAP0204 = $ok->where('VAP0204', '1')->count();
            $ok_VAP0205 = $ok->where('VAP0205', '1')->count();
            $ok_VAP0206 = $ok->where('VAP0206', '1')->count();
            $ok_VAP0207 = $ok->where('VAP0207', '1')->count();
            $ok_VAP0208 = $ok->where('VAP0208', '1')->count();
            $ok_VAP0209 = $ok->where('VAP0209', '1')->count();
            $ok_VAP0210 = $ok->where('VAP0210', '1')->count();
            $ok_jumlah = $ok_VAP0101 + $ok_VAP0102 + $ok_VAP0103 + $ok_VAP0104 + $ok_VAP0201 + $ok_VAP0202 + $ok_VAP0203 + $ok_VAP0204 + $ok_VAP0205 + $ok_VAP0206 + $ok_VAP0207 + $ok_VAP0208 + $ok_VAP0209 + $ok_VAP0210;

            $no_ok_VAP0101 = $ok->where('VAP0101', '0')->count();
            $no_ok_VAP0102 = $ok->where('VAP0102', '0')->count();
            $no_ok_VAP0103 = $ok->where('VAP0103', '0')->count();
            $no_ok_VAP0104 = $ok->where('VAP0104', '0')->count();
            $no_ok_VAP0201 = $ok->where('VAP0201', '0')->count();
            $no_ok_VAP0202 = $ok->where('VAP0202', '0')->count();
            $no_ok_VAP0203 = $ok->where('VAP0203', '0')->count();
            $no_ok_VAP0204 = $ok->where('VAP0204', '0')->count();
            $no_ok_VAP0205 = $ok->where('VAP0205', '0')->count();
            $no_ok_VAP0206 = $ok->where('VAP0206', '0')->count();
            $no_ok_VAP0207 = $ok->where('VAP0207', '0')->count();
            $no_ok_VAP0208 = $ok->where('VAP0208', '0')->count();
            $no_ok_VAP0209 = $ok->where('VAP0209', '0')->count();
            $no_ok_VAP0210 = $ok->where('VAP0210', '0')->count();
            $no_ok_jumlah = $no_ok_VAP0101 + $no_ok_VAP0102 + $no_ok_VAP0103 + $no_ok_VAP0104 + $no_ok_VAP0201 + $no_ok_VAP0202 + $no_ok_VAP0203 + $no_ok_VAP0204 + $no_ok_VAP0205 + $no_ok_VAP0206 + $no_ok_VAP0207 + $no_ok_VAP0208 + $no_ok_VAP0209 + $no_ok_VAP0210;

            $denominator_ok = $ok_jumlah + $no_ok_jumlah;

            $lt2_VAP0101 = $lt2->where('VAP0101', '1')->count();
            $lt2_VAP0102 = $lt2->where('VAP0102', '1')->count();
            $lt2_VAP0103 = $lt2->where('VAP0103', '1')->count();
            $lt2_VAP0104 = $lt2->where('VAP0104', '1')->count();
            $lt2_VAP0201 = $lt2->where('VAP0201', '1')->count();
            $lt2_VAP0202 = $lt2->where('VAP0202', '1')->count();
            $lt2_VAP0203 = $lt2->where('VAP0203', '1')->count();
            $lt2_VAP0204 = $lt2->where('VAP0204', '1')->count();
            $lt2_VAP0205 = $lt2->where('VAP0205', '1')->count();
            $lt2_VAP0206 = $lt2->where('VAP0206', '1')->count();
            $lt2_VAP0207 = $lt2->where('VAP0207', '1')->count();
            $lt2_VAP0208 = $lt2->where('VAP0208', '1')->count();
            $lt2_VAP0209 = $lt2->where('VAP0209', '1')->count();
            $lt2_VAP0210 = $lt2->where('VAP0210', '1')->count();
            $lt2_jumlah = $lt2_VAP0101 + $lt2_VAP0102 + $lt2_VAP0103 + $lt2_VAP0104 + $lt2_VAP0201 + $lt2_VAP0202 + $lt2_VAP0203 + $lt2_VAP0204 + $lt2_VAP0205 + $lt2_VAP0206 + $lt2_VAP0207 + $lt2_VAP0208 + $lt2_VAP0209 + $lt2_VAP0210;

            $no_lt2_VAP0101 = $lt2->where('VAP0101', '0')->count();
            $no_lt2_VAP0102 = $lt2->where('VAP0102', '0')->count();
            $no_lt2_VAP0103 = $lt2->where('VAP0103', '0')->count();
            $no_lt2_VAP0104 = $lt2->where('VAP0104', '0')->count();
            $no_lt2_VAP0201 = $lt2->where('VAP0201', '0')->count();
            $no_lt2_VAP0202 = $lt2->where('VAP0202', '0')->count();
            $no_lt2_VAP0203 = $lt2->where('VAP0203', '0')->count();
            $no_lt2_VAP0204 = $lt2->where('VAP0204', '0')->count();
            $no_lt2_VAP0205 = $lt2->where('VAP0205', '0')->count();
            $no_lt2_VAP0206 = $lt2->where('VAP0206', '0')->count();
            $no_lt2_VAP0207 = $lt2->where('VAP0207', '0')->count();
            $no_lt2_VAP0208 = $lt2->where('VAP0208', '0')->count();
            $no_lt2_VAP0209 = $lt2->where('VAP0209', '0')->count();
            $no_lt2_VAP0210 = $lt2->where('VAP0210', '0')->count();
            $no_lt2_jumlah = $no_lt2_VAP0101 + $no_lt2_VAP0102 + $no_lt2_VAP0103 + $no_lt2_VAP0104 + $no_lt2_VAP0201 + $no_lt2_VAP0202 + $no_lt2_VAP0203 + $no_lt2_VAP0204 + $no_lt2_VAP0205 + $no_lt2_VAP0206 + $no_lt2_VAP0207 + $no_lt2_VAP0208 + $no_lt2_VAP0209 + $no_lt2_VAP0210;

            $denominator_lt2 = $lt2_jumlah + $no_lt2_jumlah;

            $lt4_VAP0101 = $lt4->where('VAP0101', '1')->count();
            $lt4_VAP0102 = $lt4->where('VAP0102', '1')->count();
            $lt4_VAP0103 = $lt4->where('VAP0103', '1')->count();
            $lt4_VAP0104 = $lt4->where('VAP0104', '1')->count();
            $lt4_VAP0201 = $lt4->where('VAP0201', '1')->count();
            $lt4_VAP0202 = $lt4->where('VAP0202', '1')->count();
            $lt4_VAP0203 = $lt4->where('VAP0203', '1')->count();
            $lt4_VAP0204 = $lt4->where('VAP0204', '1')->count();
            $lt4_VAP0205 = $lt4->where('VAP0205', '1')->count();
            $lt4_VAP0206 = $lt4->where('VAP0206', '1')->count();
            $lt4_VAP0207 = $lt4->where('VAP0207', '1')->count();
            $lt4_VAP0208 = $lt4->where('VAP0208', '1')->count();
            $lt4_VAP0209 = $lt4->where('VAP0209', '1')->count();
            $lt4_VAP0210 = $lt4->where('VAP0210', '1')->count();
            $lt4_jumlah = $lt4_VAP0101 + $lt4_VAP0102 + $lt4_VAP0103 + $lt4_VAP0104 + $lt4_VAP0201 + $lt4_VAP0202 + $lt4_VAP0203 + $lt4_VAP0204 + $lt4_VAP0205 + $lt4_VAP0206 + $lt4_VAP0207 + $lt4_VAP0208 + $lt4_VAP0209 + $lt4_VAP0210;

            $no_lt4_VAP0101 = $lt4->where('VAP0101', '0')->count();
            $no_lt4_VAP0102 = $lt4->where('VAP0102', '0')->count();
            $no_lt4_VAP0103 = $lt4->where('VAP0103', '0')->count();
            $no_lt4_VAP0104 = $lt4->where('VAP0104', '0')->count();
            $no_lt4_VAP0201 = $lt4->where('VAP0201', '0')->count();
            $no_lt4_VAP0202 = $lt4->where('VAP0202', '0')->count();
            $no_lt4_VAP0203 = $lt4->where('VAP0203', '0')->count();
            $no_lt4_VAP0204 = $lt4->where('VAP0204', '0')->count();
            $no_lt4_VAP0205 = $lt4->where('VAP0205', '0')->count();
            $no_lt4_VAP0206 = $lt4->where('VAP0206', '0')->count();
            $no_lt4_VAP0207 = $lt4->where('VAP0207', '0')->count();
            $no_lt4_VAP0208 = $lt4->where('VAP0208', '0')->count();
            $no_lt4_VAP0209 = $lt4->where('VAP0209', '0')->count();
            $no_lt4_VAP0210 = $lt4->where('VAP0210', '0')->count();
            $no_lt4_jumlah = $no_lt4_VAP0101 + $no_lt4_VAP0102 + $no_lt4_VAP0103 + $no_lt4_VAP0104 + $no_lt4_VAP0201 + $no_lt4_VAP0202 + $no_lt4_VAP0203 + $no_lt4_VAP0204 + $no_lt4_VAP0205 + $no_lt4_VAP0206 + $no_lt4_VAP0207 + $no_lt4_VAP0208 + $no_lt4_VAP0209 + $no_lt4_VAP0210;

            $denominator_lt4 = $lt4_jumlah + $no_lt4_jumlah;

            $lt5_VAP0101 = $lt5->where('VAP0101', '1')->count();
            $lt5_VAP0102 = $lt5->where('VAP0102', '1')->count();
            $lt5_VAP0103 = $lt5->where('VAP0103', '1')->count();
            $lt5_VAP0104 = $lt5->where('VAP0104', '1')->count();
            $lt5_VAP0201 = $lt5->where('VAP0201', '1')->count();
            $lt5_VAP0202 = $lt5->where('VAP0202', '1')->count();
            $lt5_VAP0203 = $lt5->where('VAP0203', '1')->count();
            $lt5_VAP0204 = $lt5->where('VAP0204', '1')->count();
            $lt5_VAP0205 = $lt5->where('VAP0205', '1')->count();
            $lt5_VAP0206 = $lt5->where('VAP0206', '1')->count();
            $lt5_VAP0207 = $lt5->where('VAP0207', '1')->count();
            $lt5_VAP0208 = $lt5->where('VAP0208', '1')->count();
            $lt5_VAP0209 = $lt5->where('VAP0209', '1')->count();
            $lt5_VAP0210 = $lt5->where('VAP0210', '1')->count();
            $lt5_jumlah = $lt5_VAP0101 + $lt5_VAP0102 + $lt5_VAP0103 + $lt5_VAP0104 + $lt5_VAP0201 + $lt5_VAP0202 + $lt5_VAP0203 + $lt5_VAP0204 + $lt5_VAP0205 + $lt5_VAP0206 + $lt5_VAP0207 + $lt5_VAP0208 + $lt5_VAP0209 + $lt5_VAP0210;

            $no_lt5_VAP0101 = $lt5->where('VAP0101', '0')->count();
            $no_lt5_VAP0102 = $lt5->where('VAP0102', '0')->count();
            $no_lt5_VAP0103 = $lt5->where('VAP0103', '0')->count();
            $no_lt5_VAP0104 = $lt5->where('VAP0104', '0')->count();
            $no_lt5_VAP0201 = $lt5->where('VAP0201', '0')->count();
            $no_lt5_VAP0202 = $lt5->where('VAP0202', '0')->count();
            $no_lt5_VAP0203 = $lt5->where('VAP0203', '0')->count();
            $no_lt5_VAP0204 = $lt5->where('VAP0204', '0')->count();
            $no_lt5_VAP0205 = $lt5->where('VAP0205', '0')->count();
            $no_lt5_VAP0206 = $lt5->where('VAP0206', '0')->count();
            $no_lt5_VAP0207 = $lt5->where('VAP0207', '0')->count();
            $no_lt5_VAP0208 = $lt5->where('VAP0208', '0')->count();
            $no_lt5_VAP0209 = $lt5->where('VAP0209', '0')->count();
            $no_lt5_VAP0210 = $lt5->where('VAP0210', '0')->count();
            $no_lt5_jumlah = $no_lt5_VAP0101 + $no_lt5_VAP0102 + $no_lt5_VAP0103 + $no_lt5_VAP0104 + $no_lt5_VAP0201 + $no_lt5_VAP0202 + $no_lt5_VAP0203 + $no_lt5_VAP0204 + $no_lt5_VAP0205 + $no_lt5_VAP0206 + $no_lt5_VAP0207 + $no_lt5_VAP0208 + $no_lt5_VAP0209 + $no_lt5_VAP0210;

            $denominator_lt5 = $lt5_jumlah + $no_lt5_jumlah;

            $vk_VAP0101 = $vk->where('VAP0101', '1')->count();
            $vk_VAP0102 = $vk->where('VAP0102', '1')->count();
            $vk_VAP0103 = $vk->where('VAP0103', '1')->count();
            $vk_VAP0104 = $vk->where('VAP0104', '1')->count();
            $vk_VAP0201 = $vk->where('VAP0201', '1')->count();
            $vk_VAP0202 = $vk->where('VAP0202', '1')->count();
            $vk_VAP0203 = $vk->where('VAP0203', '1')->count();
            $vk_VAP0204 = $vk->where('VAP0204', '1')->count();
            $vk_VAP0205 = $vk->where('VAP0205', '1')->count();
            $vk_VAP0206 = $vk->where('VAP0206', '1')->count();
            $vk_VAP0207 = $vk->where('VAP0207', '1')->count();
            $vk_VAP0208 = $vk->where('VAP0208', '1')->count();
            $vk_VAP0209 = $vk->where('VAP0209', '1')->count();
            $vk_VAP0210 = $vk->where('VAP0210', '1')->count();
            $vk_jumlah = $vk_VAP0101 + $vk_VAP0102 + $vk_VAP0103 + $vk_VAP0104 + $vk_VAP0201 + $vk_VAP0202 + $vk_VAP0203 + $vk_VAP0204 + $vk_VAP0205 + $vk_VAP0206 + $vk_VAP0207 + $vk_VAP0208 + $vk_VAP0209 + $vk_VAP0210;

            $no_vk_VAP0101 = $vk->where('VAP0101', '0')->count();
            $no_vk_VAP0102 = $vk->where('VAP0102', '0')->count();
            $no_vk_VAP0103 = $vk->where('VAP0103', '0')->count();
            $no_vk_VAP0104 = $vk->where('VAP0104', '0')->count();
            $no_vk_VAP0201 = $vk->where('VAP0201', '0')->count();
            $no_vk_VAP0202 = $vk->where('VAP0202', '0')->count();
            $no_vk_VAP0203 = $vk->where('VAP0203', '0')->count();
            $no_vk_VAP0204 = $vk->where('VAP0204', '0')->count();
            $no_vk_VAP0205 = $vk->where('VAP0205', '0')->count();
            $no_vk_VAP0206 = $vk->where('VAP0206', '0')->count();
            $no_vk_VAP0207 = $vk->where('VAP0207', '0')->count();
            $no_vk_VAP0208 = $vk->where('VAP0208', '0')->count();
            $no_vk_VAP0209 = $vk->where('VAP0209', '0')->count();
            $no_vk_VAP0210 = $vk->where('VAP0210', '0')->count();
            $no_vk_jumlah = $no_vk_VAP0101 + $no_vk_VAP0102 + $no_vk_VAP0103 + $no_vk_VAP0104 + $no_vk_VAP0201 + $no_vk_VAP0202 + $no_vk_VAP0203 + $no_vk_VAP0204 + $no_vk_VAP0205 + $no_vk_VAP0206 + $no_vk_VAP0207 + $no_vk_VAP0208 + $no_vk_VAP0209 + $no_vk_VAP0210;

            $denominator_vk = $vk_jumlah + $no_vk_jumlah;

            return view('rekapBundleVAP.index', compact(
                'range_tgl',
                'tabel',
                'rekap',
                'analisa',
                'tindak_lanjut',

                'igd_VAP0101',
                'igd_VAP0102',
                'igd_VAP0103',
                'igd_VAP0104',
                'igd_VAP0201',
                'igd_VAP0202',
                'igd_VAP0203',
                'igd_VAP0204',
                'igd_VAP0205',
                'igd_VAP0206',
                'igd_VAP0207',
                'igd_VAP0208',
                'igd_VAP0209',
                'igd_VAP0210',
                'igd_jumlah',

                'no_igd_VAP0101',
                'no_igd_VAP0102',
                'no_igd_VAP0103',
                'no_igd_VAP0104',
                'no_igd_VAP0201',
                'no_igd_VAP0202',
                'no_igd_VAP0203',
                'no_igd_VAP0204',
                'no_igd_VAP0205',
                'no_igd_VAP0206',
                'no_igd_VAP0207',
                'no_igd_VAP0208',
                'no_igd_VAP0209',
                'no_igd_VAP0210',
                'no_igd_jumlah',

                'denominator_igd',

                'int_VAP0101',
                'int_VAP0102',
                'int_VAP0103',
                'int_VAP0104',
                'int_VAP0201',
                'int_VAP0202',
                'int_VAP0203',
                'int_VAP0204',
                'int_VAP0205',
                'int_VAP0206',
                'int_VAP0207',
                'int_VAP0208',
                'int_VAP0209',
                'int_VAP0210',
                'int_jumlah',

                'no_int_VAP0101',
                'no_int_VAP0102',
                'no_int_VAP0103',
                'no_int_VAP0104',
                'no_int_VAP0201',
                'no_int_VAP0202',
                'no_int_VAP0203',
                'no_int_VAP0204',
                'no_int_VAP0205',
                'no_int_VAP0206',
                'no_int_VAP0207',
                'no_int_VAP0208',
                'no_int_VAP0209',
                'no_int_VAP0210',
                'no_int_jumlah',

                'denominator_int',

                'ok_VAP0101',
                'ok_VAP0102',
                'ok_VAP0103',
                'ok_VAP0104',
                'ok_VAP0201',
                'ok_VAP0202',
                'ok_VAP0203',
                'ok_VAP0204',
                'ok_VAP0205',
                'ok_VAP0206',
                'ok_VAP0207',
                'ok_VAP0208',
                'ok_VAP0209',
                'ok_VAP0210',
                'ok_jumlah',

                'no_ok_VAP0101',
                'no_ok_VAP0102',
                'no_ok_VAP0103',
                'no_ok_VAP0104',
                'no_ok_VAP0201',
                'no_ok_VAP0202',
                'no_ok_VAP0203',
                'no_ok_VAP0204',
                'no_ok_VAP0205',
                'no_ok_VAP0206',
                'no_ok_VAP0207',
                'no_ok_VAP0208',
                'no_ok_VAP0209',
                'no_ok_VAP0210',
                'no_ok_jumlah',

                'denominator_ok',

                'lt2_VAP0101',
                'lt2_VAP0102',
                'lt2_VAP0103',
                'lt2_VAP0104',
                'lt2_VAP0201',
                'lt2_VAP0202',
                'lt2_VAP0203',
                'lt2_VAP0204',
                'lt2_VAP0205',
                'lt2_VAP0206',
                'lt2_VAP0207',
                'lt2_VAP0208',
                'lt2_VAP0209',
                'lt2_VAP0210',
                'lt2_jumlah',

                'no_lt2_VAP0101',
                'no_lt2_VAP0102',
                'no_lt2_VAP0103',
                'no_lt2_VAP0104',
                'no_lt2_VAP0201',
                'no_lt2_VAP0202',
                'no_lt2_VAP0203',
                'no_lt2_VAP0204',
                'no_lt2_VAP0205',
                'no_lt2_VAP0206',
                'no_lt2_VAP0207',
                'no_lt2_VAP0208',
                'no_lt2_VAP0209',
                'no_lt2_VAP0210',
                'no_lt2_jumlah',

                'denominator_lt2',

                'lt4_VAP0101',
                'lt4_VAP0102',
                'lt4_VAP0103',
                'lt4_VAP0104',
                'lt4_VAP0201',
                'lt4_VAP0202',
                'lt4_VAP0203',
                'lt4_VAP0204',
                'lt4_VAP0205',
                'lt4_VAP0206',
                'lt4_VAP0207',
                'lt4_VAP0208',
                'lt4_VAP0209',
                'lt4_VAP0210',
                'lt4_jumlah',

                'no_lt4_VAP0101',
                'no_lt4_VAP0102',
                'no_lt4_VAP0103',
                'no_lt4_VAP0104',
                'no_lt4_VAP0201',
                'no_lt4_VAP0202',
                'no_lt4_VAP0203',
                'no_lt4_VAP0204',
                'no_lt4_VAP0205',
                'no_lt4_VAP0206',
                'no_lt4_VAP0207',
                'no_lt4_VAP0208',
                'no_lt4_VAP0209',
                'no_lt4_VAP0210',
                'no_lt4_jumlah',

                'denominator_lt4',

                'lt5_VAP0101',
                'lt5_VAP0102',
                'lt5_VAP0103',
                'lt5_VAP0104',
                'lt5_VAP0201',
                'lt5_VAP0202',
                'lt5_VAP0203',
                'lt5_VAP0204',
                'lt5_VAP0205',
                'lt5_VAP0206',
                'lt5_VAP0207',
                'lt5_VAP0208',
                'lt5_VAP0209',
                'lt5_VAP0210',
                'lt5_jumlah',

                'no_lt5_VAP0101',
                'no_lt5_VAP0102',
                'no_lt5_VAP0103',
                'no_lt5_VAP0104',
                'no_lt5_VAP0201',
                'no_lt5_VAP0202',
                'no_lt5_VAP0203',
                'no_lt5_VAP0204',
                'no_lt5_VAP0205',
                'no_lt5_VAP0206',
                'no_lt5_VAP0207',
                'no_lt5_VAP0208',
                'no_lt5_VAP0209',
                'no_lt5_VAP0210',
                'no_lt5_jumlah',

                'denominator_lt5',

                'vk_VAP0101',
                'vk_VAP0102',
                'vk_VAP0103',
                'vk_VAP0104',
                'vk_VAP0201',
                'vk_VAP0202',
                'vk_VAP0203',
                'vk_VAP0204',
                'vk_VAP0205',
                'vk_VAP0206',
                'vk_VAP0207',
                'vk_VAP0208',
                'vk_VAP0209',
                'vk_VAP0210',
                'vk_jumlah',

                'no_vk_VAP0101',
                'no_vk_VAP0102',
                'no_vk_VAP0103',
                'no_vk_VAP0104',
                'no_vk_VAP0201',
                'no_vk_VAP0202',
                'no_vk_VAP0203',
                'no_vk_VAP0204',
                'no_vk_VAP0205',
                'no_vk_VAP0206',
                'no_vk_VAP0207',
                'no_vk_VAP0208',
                'no_vk_VAP0209',
                'no_vk_VAP0210',
                'no_vk_jumlah',

                'denominator_vk',
            ));
        } else {
            return Redirect::back()->withErrors(['msg' => 'Tanggal tidak boleh Lebih kecil dari sebelumnya']);
        }
    }

    public function excel(Request $request)
    {
        $tgl_skg = date('Y-m-d');

        if ($request->input('dari') <= $request->input('sampai')) {
            $tabel = BundleVAP::whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')->paginate(1000);
            // dd($tabel);

            $rekap = RekapBundleVap::whereDate('dari', '=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('sampai', '=', $request->input('sampai') ?? $tgl_skg)
                ->get();

            $analisa = RekapBundleVap::select('analisa')
                ->whereDate('dari', '=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('sampai', '=', $request->input('sampai') ?? $tgl_skg)
                ->get();

            $tindak_lanjut = RekapBundleVap::select('tindak_lanjut')
                ->whereDate('dari', '=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('sampai', '=', $request->input('sampai') ?? $tgl_skg)
                ->get();

            $igd = BundleVAP::where('unit', 'IGD')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $int = BundleVAP::where('unit', 'Intensif')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $ok = BundleVAP::where('unit', 'OK')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt2 = BundleVAP::where('unit', 'Perawatan Eksekutif lt.2')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt4 = BundleVAP::where('unit', 'Perawatan Reguler lt.4')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt5 = BundleVAP::where('unit', 'Perawatan Reguler lt.5')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $vk = BundleVAP::where('unit', 'VK')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();

            $igd_VAP0101 = $igd->where('VAP0101', '1')->count();
            $igd_VAP0102 = $igd->where('VAP0102', '1')->count();
            $igd_VAP0103 = $igd->where('VAP0103', '1')->count();
            $igd_VAP0104 = $igd->where('VAP0104', '1')->count();
            $igd_VAP0201 = $igd->where('VAP0201', '1')->count();
            $igd_VAP0202 = $igd->where('VAP0202', '1')->count();
            $igd_VAP0203 = $igd->where('VAP0203', '1')->count();
            $igd_VAP0204 = $igd->where('VAP0204', '1')->count();
            $igd_VAP0205 = $igd->where('VAP0205', '1')->count();
            $igd_VAP0206 = $igd->where('VAP0206', '1')->count();
            $igd_VAP0207 = $igd->where('VAP0207', '1')->count();
            $igd_VAP0208 = $igd->where('VAP0208', '1')->count();
            $igd_VAP0209 = $igd->where('VAP0209', '1')->count();
            $igd_VAP0210 = $igd->where('VAP0210', '1')->count();
            $igd_jumlah = $igd_VAP0101 + $igd_VAP0102 + $igd_VAP0103 + $igd_VAP0104 + $igd_VAP0201 + $igd_VAP0202 + $igd_VAP0203 + $igd_VAP0204 + $igd_VAP0205 + $igd_VAP0206 + $igd_VAP0207 + $igd_VAP0208 + $igd_VAP0209 + $igd_VAP0210;

            $no_igd_VAP0101 = $igd->where('VAP0101', '0')->count();
            $no_igd_VAP0102 = $igd->where('VAP0102', '0')->count();
            $no_igd_VAP0103 = $igd->where('VAP0103', '0')->count();
            $no_igd_VAP0104 = $igd->where('VAP0104', '0')->count();
            $no_igd_VAP0201 = $igd->where('VAP0201', '0')->count();
            $no_igd_VAP0202 = $igd->where('VAP0202', '0')->count();
            $no_igd_VAP0203 = $igd->where('VAP0203', '0')->count();
            $no_igd_VAP0204 = $igd->where('VAP0204', '0')->count();
            $no_igd_VAP0205 = $igd->where('VAP0205', '0')->count();
            $no_igd_VAP0206 = $igd->where('VAP0206', '0')->count();
            $no_igd_VAP0207 = $igd->where('VAP0207', '0')->count();
            $no_igd_VAP0208 = $igd->where('VAP0208', '0')->count();
            $no_igd_VAP0209 = $igd->where('VAP0209', '0')->count();
            $no_igd_VAP0210 = $igd->where('VAP0210', '0')->count();
            $no_igd_jumlah = $no_igd_VAP0101 + $no_igd_VAP0102 + $no_igd_VAP0103 + $no_igd_VAP0104 + $no_igd_VAP0201 + $no_igd_VAP0202 + $no_igd_VAP0203 + $no_igd_VAP0204 + $no_igd_VAP0205 + $no_igd_VAP0206 + $no_igd_VAP0207 + $no_igd_VAP0208 + $no_igd_VAP0209 + $no_igd_VAP0210;

            $denominator_igd = $igd_jumlah + $no_igd_jumlah;

            $int_VAP0101 = $int->where('VAP0101', '1')->count();
            $int_VAP0102 = $int->where('VAP0102', '1')->count();
            $int_VAP0103 = $int->where('VAP0103', '1')->count();
            $int_VAP0104 = $int->where('VAP0104', '1')->count();
            $int_VAP0201 = $int->where('VAP0201', '1')->count();
            $int_VAP0202 = $int->where('VAP0202', '1')->count();
            $int_VAP0203 = $int->where('VAP0203', '1')->count();
            $int_VAP0204 = $int->where('VAP0204', '1')->count();
            $int_VAP0205 = $int->where('VAP0205', '1')->count();
            $int_VAP0206 = $int->where('VAP0206', '1')->count();
            $int_VAP0207 = $int->where('VAP0207', '1')->count();
            $int_VAP0208 = $int->where('VAP0208', '1')->count();
            $int_VAP0209 = $int->where('VAP0209', '1')->count();
            $int_VAP0210 = $int->where('VAP0210', '1')->count();
            $int_jumlah = $int_VAP0101 + $int_VAP0102 + $int_VAP0103 + $int_VAP0104 + $int_VAP0201 + $int_VAP0202 + $int_VAP0203 + $int_VAP0204 + $int_VAP0205 + $int_VAP0206 + $int_VAP0207 + $int_VAP0208 + $int_VAP0209 + $int_VAP0210;

            $no_int_VAP0101 = $int->where('VAP0101', '0')->count();
            $no_int_VAP0102 = $int->where('VAP0102', '0')->count();
            $no_int_VAP0103 = $int->where('VAP0103', '0')->count();
            $no_int_VAP0104 = $int->where('VAP0104', '0')->count();
            $no_int_VAP0201 = $int->where('VAP0201', '0')->count();
            $no_int_VAP0202 = $int->where('VAP0202', '0')->count();
            $no_int_VAP0203 = $int->where('VAP0203', '0')->count();
            $no_int_VAP0204 = $int->where('VAP0204', '0')->count();
            $no_int_VAP0205 = $int->where('VAP0205', '0')->count();
            $no_int_VAP0206 = $int->where('VAP0206', '0')->count();
            $no_int_VAP0207 = $int->where('VAP0207', '0')->count();
            $no_int_VAP0208 = $int->where('VAP0208', '0')->count();
            $no_int_VAP0209 = $int->where('VAP0209', '0')->count();
            $no_int_VAP0210 = $int->where('VAP0210', '0')->count();
            $no_int_jumlah = $no_int_VAP0101 + $no_int_VAP0102 + $no_int_VAP0103 + $no_int_VAP0104 + $no_int_VAP0201 + $no_int_VAP0202 + $no_int_VAP0203 + $no_int_VAP0204 + $no_int_VAP0205 + $no_int_VAP0206 + $no_int_VAP0207 + $no_int_VAP0208 + $no_int_VAP0209 + $no_int_VAP0210;

            $denominator_int = $int_jumlah + $no_int_jumlah;

            $ok_VAP0101 = $ok->where('VAP0101', '1')->count();
            $ok_VAP0102 = $ok->where('VAP0102', '1')->count();
            $ok_VAP0103 = $ok->where('VAP0103', '1')->count();
            $ok_VAP0104 = $ok->where('VAP0104', '1')->count();
            $ok_VAP0201 = $ok->where('VAP0201', '1')->count();
            $ok_VAP0202 = $ok->where('VAP0202', '1')->count();
            $ok_VAP0203 = $ok->where('VAP0203', '1')->count();
            $ok_VAP0204 = $ok->where('VAP0204', '1')->count();
            $ok_VAP0205 = $ok->where('VAP0205', '1')->count();
            $ok_VAP0206 = $ok->where('VAP0206', '1')->count();
            $ok_VAP0207 = $ok->where('VAP0207', '1')->count();
            $ok_VAP0208 = $ok->where('VAP0208', '1')->count();
            $ok_VAP0209 = $ok->where('VAP0209', '1')->count();
            $ok_VAP0210 = $ok->where('VAP0210', '1')->count();
            $ok_jumlah = $ok_VAP0101 + $ok_VAP0102 + $ok_VAP0103 + $ok_VAP0104 + $ok_VAP0201 + $ok_VAP0202 + $ok_VAP0203 + $ok_VAP0204 + $ok_VAP0205 + $ok_VAP0206 + $ok_VAP0207 + $ok_VAP0208 + $ok_VAP0209 + $ok_VAP0210;

            $no_ok_VAP0101 = $ok->where('VAP0101', '0')->count();
            $no_ok_VAP0102 = $ok->where('VAP0102', '0')->count();
            $no_ok_VAP0103 = $ok->where('VAP0103', '0')->count();
            $no_ok_VAP0104 = $ok->where('VAP0104', '0')->count();
            $no_ok_VAP0201 = $ok->where('VAP0201', '0')->count();
            $no_ok_VAP0202 = $ok->where('VAP0202', '0')->count();
            $no_ok_VAP0203 = $ok->where('VAP0203', '0')->count();
            $no_ok_VAP0204 = $ok->where('VAP0204', '0')->count();
            $no_ok_VAP0205 = $ok->where('VAP0205', '0')->count();
            $no_ok_VAP0206 = $ok->where('VAP0206', '0')->count();
            $no_ok_VAP0207 = $ok->where('VAP0207', '0')->count();
            $no_ok_VAP0208 = $ok->where('VAP0208', '0')->count();
            $no_ok_VAP0209 = $ok->where('VAP0209', '0')->count();
            $no_ok_VAP0210 = $ok->where('VAP0210', '0')->count();
            $no_ok_jumlah = $no_ok_VAP0101 + $no_ok_VAP0102 + $no_ok_VAP0103 + $no_ok_VAP0104 + $no_ok_VAP0201 + $no_ok_VAP0202 + $no_ok_VAP0203 + $no_ok_VAP0204 + $no_ok_VAP0205 + $no_ok_VAP0206 + $no_ok_VAP0207 + $no_ok_VAP0208 + $no_ok_VAP0209 + $no_ok_VAP0210;

            $denominator_ok = $ok_jumlah + $no_ok_jumlah;

            $lt2_VAP0101 = $lt2->where('VAP0101', '1')->count();
            $lt2_VAP0102 = $lt2->where('VAP0102', '1')->count();
            $lt2_VAP0103 = $lt2->where('VAP0103', '1')->count();
            $lt2_VAP0104 = $lt2->where('VAP0104', '1')->count();
            $lt2_VAP0201 = $lt2->where('VAP0201', '1')->count();
            $lt2_VAP0202 = $lt2->where('VAP0202', '1')->count();
            $lt2_VAP0203 = $lt2->where('VAP0203', '1')->count();
            $lt2_VAP0204 = $lt2->where('VAP0204', '1')->count();
            $lt2_VAP0205 = $lt2->where('VAP0205', '1')->count();
            $lt2_VAP0206 = $lt2->where('VAP0206', '1')->count();
            $lt2_VAP0207 = $lt2->where('VAP0207', '1')->count();
            $lt2_VAP0208 = $lt2->where('VAP0208', '1')->count();
            $lt2_VAP0209 = $lt2->where('VAP0209', '1')->count();
            $lt2_VAP0210 = $lt2->where('VAP0210', '1')->count();
            $lt2_jumlah = $lt2_VAP0101 + $lt2_VAP0102 + $lt2_VAP0103 + $lt2_VAP0104 + $lt2_VAP0201 + $lt2_VAP0202 + $lt2_VAP0203 + $lt2_VAP0204 + $lt2_VAP0205 + $lt2_VAP0206 + $lt2_VAP0207 + $lt2_VAP0208 + $lt2_VAP0209 + $lt2_VAP0210;

            $no_lt2_VAP0101 = $lt2->where('VAP0101', '0')->count();
            $no_lt2_VAP0102 = $lt2->where('VAP0102', '0')->count();
            $no_lt2_VAP0103 = $lt2->where('VAP0103', '0')->count();
            $no_lt2_VAP0104 = $lt2->where('VAP0104', '0')->count();
            $no_lt2_VAP0201 = $lt2->where('VAP0201', '0')->count();
            $no_lt2_VAP0202 = $lt2->where('VAP0202', '0')->count();
            $no_lt2_VAP0203 = $lt2->where('VAP0203', '0')->count();
            $no_lt2_VAP0204 = $lt2->where('VAP0204', '0')->count();
            $no_lt2_VAP0205 = $lt2->where('VAP0205', '0')->count();
            $no_lt2_VAP0206 = $lt2->where('VAP0206', '0')->count();
            $no_lt2_VAP0207 = $lt2->where('VAP0207', '0')->count();
            $no_lt2_VAP0208 = $lt2->where('VAP0208', '0')->count();
            $no_lt2_VAP0209 = $lt2->where('VAP0209', '0')->count();
            $no_lt2_VAP0210 = $lt2->where('VAP0210', '0')->count();
            $no_lt2_jumlah = $no_lt2_VAP0101 + $no_lt2_VAP0102 + $no_lt2_VAP0103 + $no_lt2_VAP0104 + $no_lt2_VAP0201 + $no_lt2_VAP0202 + $no_lt2_VAP0203 + $no_lt2_VAP0204 + $no_lt2_VAP0205 + $no_lt2_VAP0206 + $no_lt2_VAP0207 + $no_lt2_VAP0208 + $no_lt2_VAP0209 + $no_lt2_VAP0210;

            $denominator_lt2 = $lt2_jumlah + $no_lt2_jumlah;

            $lt4_VAP0101 = $lt4->where('VAP0101', '1')->count();
            $lt4_VAP0102 = $lt4->where('VAP0102', '1')->count();
            $lt4_VAP0103 = $lt4->where('VAP0103', '1')->count();
            $lt4_VAP0104 = $lt4->where('VAP0104', '1')->count();
            $lt4_VAP0201 = $lt4->where('VAP0201', '1')->count();
            $lt4_VAP0202 = $lt4->where('VAP0202', '1')->count();
            $lt4_VAP0203 = $lt4->where('VAP0203', '1')->count();
            $lt4_VAP0204 = $lt4->where('VAP0204', '1')->count();
            $lt4_VAP0205 = $lt4->where('VAP0205', '1')->count();
            $lt4_VAP0206 = $lt4->where('VAP0206', '1')->count();
            $lt4_VAP0207 = $lt4->where('VAP0207', '1')->count();
            $lt4_VAP0208 = $lt4->where('VAP0208', '1')->count();
            $lt4_VAP0209 = $lt4->where('VAP0209', '1')->count();
            $lt4_VAP0210 = $lt4->where('VAP0210', '1')->count();
            $lt4_jumlah = $lt4_VAP0101 + $lt4_VAP0102 + $lt4_VAP0103 + $lt4_VAP0104 + $lt4_VAP0201 + $lt4_VAP0202 + $lt4_VAP0203 + $lt4_VAP0204 + $lt4_VAP0205 + $lt4_VAP0206 + $lt4_VAP0207 + $lt4_VAP0208 + $lt4_VAP0209 + $lt4_VAP0210;

            $no_lt4_VAP0101 = $lt4->where('VAP0101', '0')->count();
            $no_lt4_VAP0102 = $lt4->where('VAP0102', '0')->count();
            $no_lt4_VAP0103 = $lt4->where('VAP0103', '0')->count();
            $no_lt4_VAP0104 = $lt4->where('VAP0104', '0')->count();
            $no_lt4_VAP0201 = $lt4->where('VAP0201', '0')->count();
            $no_lt4_VAP0202 = $lt4->where('VAP0202', '0')->count();
            $no_lt4_VAP0203 = $lt4->where('VAP0203', '0')->count();
            $no_lt4_VAP0204 = $lt4->where('VAP0204', '0')->count();
            $no_lt4_VAP0205 = $lt4->where('VAP0205', '0')->count();
            $no_lt4_VAP0206 = $lt4->where('VAP0206', '0')->count();
            $no_lt4_VAP0207 = $lt4->where('VAP0207', '0')->count();
            $no_lt4_VAP0208 = $lt4->where('VAP0208', '0')->count();
            $no_lt4_VAP0209 = $lt4->where('VAP0209', '0')->count();
            $no_lt4_VAP0210 = $lt4->where('VAP0210', '0')->count();
            $no_lt4_jumlah = $no_lt4_VAP0101 + $no_lt4_VAP0102 + $no_lt4_VAP0103 + $no_lt4_VAP0104 + $no_lt4_VAP0201 + $no_lt4_VAP0202 + $no_lt4_VAP0203 + $no_lt4_VAP0204 + $no_lt4_VAP0205 + $no_lt4_VAP0206 + $no_lt4_VAP0207 + $no_lt4_VAP0208 + $no_lt4_VAP0209 + $no_lt4_VAP0210;

            $denominator_lt4 = $lt4_jumlah + $no_lt4_jumlah;

            $lt5_VAP0101 = $lt5->where('VAP0101', '1')->count();
            $lt5_VAP0102 = $lt5->where('VAP0102', '1')->count();
            $lt5_VAP0103 = $lt5->where('VAP0103', '1')->count();
            $lt5_VAP0104 = $lt5->where('VAP0104', '1')->count();
            $lt5_VAP0201 = $lt5->where('VAP0201', '1')->count();
            $lt5_VAP0202 = $lt5->where('VAP0202', '1')->count();
            $lt5_VAP0203 = $lt5->where('VAP0203', '1')->count();
            $lt5_VAP0204 = $lt5->where('VAP0204', '1')->count();
            $lt5_VAP0205 = $lt5->where('VAP0205', '1')->count();
            $lt5_VAP0206 = $lt5->where('VAP0206', '1')->count();
            $lt5_VAP0207 = $lt5->where('VAP0207', '1')->count();
            $lt5_VAP0208 = $lt5->where('VAP0208', '1')->count();
            $lt5_VAP0209 = $lt5->where('VAP0209', '1')->count();
            $lt5_VAP0210 = $lt5->where('VAP0210', '1')->count();
            $lt5_jumlah = $lt5_VAP0101 + $lt5_VAP0102 + $lt5_VAP0103 + $lt5_VAP0104 + $lt5_VAP0201 + $lt5_VAP0202 + $lt5_VAP0203 + $lt5_VAP0204 + $lt5_VAP0205 + $lt5_VAP0206 + $lt5_VAP0207 + $lt5_VAP0208 + $lt5_VAP0209 + $lt5_VAP0210;

            $no_lt5_VAP0101 = $lt5->where('VAP0101', '0')->count();
            $no_lt5_VAP0102 = $lt5->where('VAP0102', '0')->count();
            $no_lt5_VAP0103 = $lt5->where('VAP0103', '0')->count();
            $no_lt5_VAP0104 = $lt5->where('VAP0104', '0')->count();
            $no_lt5_VAP0201 = $lt5->where('VAP0201', '0')->count();
            $no_lt5_VAP0202 = $lt5->where('VAP0202', '0')->count();
            $no_lt5_VAP0203 = $lt5->where('VAP0203', '0')->count();
            $no_lt5_VAP0204 = $lt5->where('VAP0204', '0')->count();
            $no_lt5_VAP0205 = $lt5->where('VAP0205', '0')->count();
            $no_lt5_VAP0206 = $lt5->where('VAP0206', '0')->count();
            $no_lt5_VAP0207 = $lt5->where('VAP0207', '0')->count();
            $no_lt5_VAP0208 = $lt5->where('VAP0208', '0')->count();
            $no_lt5_VAP0209 = $lt5->where('VAP0209', '0')->count();
            $no_lt5_VAP0210 = $lt5->where('VAP0210', '0')->count();
            $no_lt5_jumlah = $no_lt5_VAP0101 + $no_lt5_VAP0102 + $no_lt5_VAP0103 + $no_lt5_VAP0104 + $no_lt5_VAP0201 + $no_lt5_VAP0202 + $no_lt5_VAP0203 + $no_lt5_VAP0204 + $no_lt5_VAP0205 + $no_lt5_VAP0206 + $no_lt5_VAP0207 + $no_lt5_VAP0208 + $no_lt5_VAP0209 + $no_lt5_VAP0210;

            $denominator_lt5 = $lt5_jumlah + $no_lt5_jumlah;

            $vk_VAP0101 = $vk->where('VAP0101', '1')->count();
            $vk_VAP0102 = $vk->where('VAP0102', '1')->count();
            $vk_VAP0103 = $vk->where('VAP0103', '1')->count();
            $vk_VAP0104 = $vk->where('VAP0104', '1')->count();
            $vk_VAP0201 = $vk->where('VAP0201', '1')->count();
            $vk_VAP0202 = $vk->where('VAP0202', '1')->count();
            $vk_VAP0203 = $vk->where('VAP0203', '1')->count();
            $vk_VAP0204 = $vk->where('VAP0204', '1')->count();
            $vk_VAP0205 = $vk->where('VAP0205', '1')->count();
            $vk_VAP0206 = $vk->where('VAP0206', '1')->count();
            $vk_VAP0207 = $vk->where('VAP0207', '1')->count();
            $vk_VAP0208 = $vk->where('VAP0208', '1')->count();
            $vk_VAP0209 = $vk->where('VAP0209', '1')->count();
            $vk_VAP0210 = $vk->where('VAP0210', '1')->count();
            $vk_jumlah = $vk_VAP0101 + $vk_VAP0102 + $vk_VAP0103 + $vk_VAP0104 + $vk_VAP0201 + $vk_VAP0202 + $vk_VAP0203 + $vk_VAP0204 + $vk_VAP0205 + $vk_VAP0206 + $vk_VAP0207 + $vk_VAP0208 + $vk_VAP0209 + $vk_VAP0210;

            $no_vk_VAP0101 = $vk->where('VAP0101', '0')->count();
            $no_vk_VAP0102 = $vk->where('VAP0102', '0')->count();
            $no_vk_VAP0103 = $vk->where('VAP0103', '0')->count();
            $no_vk_VAP0104 = $vk->where('VAP0104', '0')->count();
            $no_vk_VAP0201 = $vk->where('VAP0201', '0')->count();
            $no_vk_VAP0202 = $vk->where('VAP0202', '0')->count();
            $no_vk_VAP0203 = $vk->where('VAP0203', '0')->count();
            $no_vk_VAP0204 = $vk->where('VAP0204', '0')->count();
            $no_vk_VAP0205 = $vk->where('VAP0205', '0')->count();
            $no_vk_VAP0206 = $vk->where('VAP0206', '0')->count();
            $no_vk_VAP0207 = $vk->where('VAP0207', '0')->count();
            $no_vk_VAP0208 = $vk->where('VAP0208', '0')->count();
            $no_vk_VAP0209 = $vk->where('VAP0209', '0')->count();
            $no_vk_VAP0210 = $vk->where('VAP0210', '0')->count();
            $no_vk_jumlah = $no_vk_VAP0101 + $no_vk_VAP0102 + $no_vk_VAP0103 + $no_vk_VAP0104 + $no_vk_VAP0201 + $no_vk_VAP0202 + $no_vk_VAP0203 + $no_vk_VAP0204 + $no_vk_VAP0205 + $no_vk_VAP0206 + $no_vk_VAP0207 + $no_vk_VAP0208 + $no_vk_VAP0209 + $no_vk_VAP0210;

            $denominator_vk = $vk_jumlah + $no_vk_jumlah;

            $tanggal = Carbon::parse($request->input('dari'))->isoFormat('DD MMMM YYYY') . ' - ' . Carbon::parse($request->input('sampai'))->isoFormat('DD MMMM YYYY');

            return Excel::download(new ExportBundleVAP(
                $igd_VAP0101,
                $igd_VAP0102,
                $igd_VAP0103,
                $igd_VAP0104,
                $igd_VAP0201,
                $igd_VAP0202,
                $igd_VAP0203,
                $igd_VAP0204,
                $igd_VAP0205,
                $igd_VAP0206,
                $igd_VAP0207,
                $igd_VAP0208,
                $igd_VAP0209,
                $igd_VAP0210,
                $igd_jumlah,

                $no_igd_VAP0101,
                $no_igd_VAP0102,
                $no_igd_VAP0103,
                $no_igd_VAP0104,
                $no_igd_VAP0201,
                $no_igd_VAP0202,
                $no_igd_VAP0203,
                $no_igd_VAP0204,
                $no_igd_VAP0205,
                $no_igd_VAP0206,
                $no_igd_VAP0207,
                $no_igd_VAP0208,
                $no_igd_VAP0209,
                $no_igd_VAP0210,
                $no_igd_jumlah,

                $denominator_igd,

                $int_VAP0101,
                $int_VAP0102,
                $int_VAP0103,
                $int_VAP0104,
                $int_VAP0201,
                $int_VAP0202,
                $int_VAP0203,
                $int_VAP0204,
                $int_VAP0205,
                $int_VAP0206,
                $int_VAP0207,
                $int_VAP0208,
                $int_VAP0209,
                $int_VAP0210,
                $int_jumlah,

                $no_int_VAP0101,
                $no_int_VAP0102,
                $no_int_VAP0103,
                $no_int_VAP0104,
                $no_int_VAP0201,
                $no_int_VAP0202,
                $no_int_VAP0203,
                $no_int_VAP0204,
                $no_int_VAP0205,
                $no_int_VAP0206,
                $no_int_VAP0207,
                $no_int_VAP0208,
                $no_int_VAP0209,
                $no_int_VAP0210,
                $no_int_jumlah,

                $denominator_int,

                $ok_VAP0101,
                $ok_VAP0102,
                $ok_VAP0103,
                $ok_VAP0104,
                $ok_VAP0201,
                $ok_VAP0202,
                $ok_VAP0203,
                $ok_VAP0204,
                $ok_VAP0205,
                $ok_VAP0206,
                $ok_VAP0207,
                $ok_VAP0208,
                $ok_VAP0209,
                $ok_VAP0210,
                $ok_jumlah,

                $no_ok_VAP0101,
                $no_ok_VAP0102,
                $no_ok_VAP0103,
                $no_ok_VAP0104,
                $no_ok_VAP0201,
                $no_ok_VAP0202,
                $no_ok_VAP0203,
                $no_ok_VAP0204,
                $no_ok_VAP0205,
                $no_ok_VAP0206,
                $no_ok_VAP0207,
                $no_ok_VAP0208,
                $no_ok_VAP0209,
                $no_ok_VAP0210,
                $no_ok_jumlah,

                $denominator_ok,

                $lt2_VAP0101,
                $lt2_VAP0102,
                $lt2_VAP0103,
                $lt2_VAP0104,
                $lt2_VAP0201,
                $lt2_VAP0202,
                $lt2_VAP0203,
                $lt2_VAP0204,
                $lt2_VAP0205,
                $lt2_VAP0206,
                $lt2_VAP0207,
                $lt2_VAP0208,
                $lt2_VAP0209,
                $lt2_VAP0210,
                $lt2_jumlah,

                $no_lt2_VAP0101,
                $no_lt2_VAP0102,
                $no_lt2_VAP0103,
                $no_lt2_VAP0104,
                $no_lt2_VAP0201,
                $no_lt2_VAP0202,
                $no_lt2_VAP0203,
                $no_lt2_VAP0204,
                $no_lt2_VAP0205,
                $no_lt2_VAP0206,
                $no_lt2_VAP0207,
                $no_lt2_VAP0208,
                $no_lt2_VAP0209,
                $no_lt2_VAP0210,
                $no_lt2_jumlah,

                $denominator_lt2,

                $lt4_VAP0101,
                $lt4_VAP0102,
                $lt4_VAP0103,
                $lt4_VAP0104,
                $lt4_VAP0201,
                $lt4_VAP0202,
                $lt4_VAP0203,
                $lt4_VAP0204,
                $lt4_VAP0205,
                $lt4_VAP0206,
                $lt4_VAP0207,
                $lt4_VAP0208,
                $lt4_VAP0209,
                $lt4_VAP0210,
                $lt4_jumlah,

                $no_lt4_VAP0101,
                $no_lt4_VAP0102,
                $no_lt4_VAP0103,
                $no_lt4_VAP0104,
                $no_lt4_VAP0201,
                $no_lt4_VAP0202,
                $no_lt4_VAP0203,
                $no_lt4_VAP0204,
                $no_lt4_VAP0205,
                $no_lt4_VAP0206,
                $no_lt4_VAP0207,
                $no_lt4_VAP0208,
                $no_lt4_VAP0209,
                $no_lt4_VAP0210,
                $no_lt4_jumlah,

                $denominator_lt4,

                $lt5_VAP0101,
                $lt5_VAP0102,
                $lt5_VAP0103,
                $lt5_VAP0104,
                $lt5_VAP0201,
                $lt5_VAP0202,
                $lt5_VAP0203,
                $lt5_VAP0204,
                $lt5_VAP0205,
                $lt5_VAP0206,
                $lt5_VAP0207,
                $lt5_VAP0208,
                $lt5_VAP0209,
                $lt5_VAP0210,
                $lt5_jumlah,

                $no_lt5_VAP0101,
                $no_lt5_VAP0102,
                $no_lt5_VAP0103,
                $no_lt5_VAP0104,
                $no_lt5_VAP0201,
                $no_lt5_VAP0202,
                $no_lt5_VAP0203,
                $no_lt5_VAP0204,
                $no_lt5_VAP0205,
                $no_lt5_VAP0206,
                $no_lt5_VAP0207,
                $no_lt5_VAP0208,
                $no_lt5_VAP0209,
                $no_lt5_VAP0210,
                $no_lt5_jumlah,

                $denominator_lt5,

                $vk_VAP0101,
                $vk_VAP0102,
                $vk_VAP0103,
                $vk_VAP0104,
                $vk_VAP0201,
                $vk_VAP0202,
                $vk_VAP0203,
                $vk_VAP0204,
                $vk_VAP0205,
                $vk_VAP0206,
                $vk_VAP0207,
                $vk_VAP0208,
                $vk_VAP0209,
                $vk_VAP0210,
                $vk_jumlah,

                $no_vk_VAP0101,
                $no_vk_VAP0102,
                $no_vk_VAP0103,
                $no_vk_VAP0104,
                $no_vk_VAP0201,
                $no_vk_VAP0202,
                $no_vk_VAP0203,
                $no_vk_VAP0204,
                $no_vk_VAP0205,
                $no_vk_VAP0206,
                $no_vk_VAP0207,
                $no_vk_VAP0208,
                $no_vk_VAP0209,
                $no_vk_VAP0210,
                $no_vk_jumlah,

                $denominator_vk,

                $tabel,
                $rekap,
                $tanggal
            ), 'Rekap Bundle VAP ' . $tanggal . '.xlsx');
        } else {
            return Redirect::back()->withErrors(['msg' => 'Tanggal tidak boleh Lebih kecil dari sebelumnya']);
        }
    }

    public function pdf(Request $request)
    {
        $tgl_skg = date('Y-m-d');

        if ($request->input('dari') <= $request->input('sampai')) {
            $tabel = BundleVAP::whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')->paginate(1000);
            // dd($tabel);

            $rekap = RekapBundleVap::whereDate('dari', '=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('sampai', '=', $request->input('sampai') ?? $tgl_skg)
                ->get();

            $analisa = RekapBundleVap::select('analisa')
                ->whereDate('dari', '=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('sampai', '=', $request->input('sampai') ?? $tgl_skg)
                ->get();

            $tindak_lanjut = RekapBundleVap::select('tindak_lanjut')
                ->whereDate('dari', '=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('sampai', '=', $request->input('sampai') ?? $tgl_skg)
                ->get();

            $igd = BundleVAP::where('unit', 'IGD')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $int = BundleVAP::where('unit', 'Intensif')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $ok = BundleVAP::where('unit', 'OK')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt2 = BundleVAP::where('unit', 'Perawatan Eksekutif lt.2')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt4 = BundleVAP::where('unit', 'Perawatan Reguler lt.4')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt5 = BundleVAP::where('unit', 'Perawatan Reguler lt.5')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $vk = BundleVAP::where('unit', 'VK')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();

            $igd_VAP0101 = $igd->where('VAP0101', '1')->count();
            $igd_VAP0102 = $igd->where('VAP0102', '1')->count();
            $igd_VAP0103 = $igd->where('VAP0103', '1')->count();
            $igd_VAP0104 = $igd->where('VAP0104', '1')->count();
            $igd_VAP0201 = $igd->where('VAP0201', '1')->count();
            $igd_VAP0202 = $igd->where('VAP0202', '1')->count();
            $igd_VAP0203 = $igd->where('VAP0203', '1')->count();
            $igd_VAP0204 = $igd->where('VAP0204', '1')->count();
            $igd_VAP0205 = $igd->where('VAP0205', '1')->count();
            $igd_VAP0206 = $igd->where('VAP0206', '1')->count();
            $igd_VAP0207 = $igd->where('VAP0207', '1')->count();
            $igd_VAP0208 = $igd->where('VAP0208', '1')->count();
            $igd_VAP0209 = $igd->where('VAP0209', '1')->count();
            $igd_VAP0210 = $igd->where('VAP0210', '1')->count();
            $igd_jumlah = $igd_VAP0101 + $igd_VAP0102 + $igd_VAP0103 + $igd_VAP0104 + $igd_VAP0201 + $igd_VAP0202 + $igd_VAP0203 + $igd_VAP0204 + $igd_VAP0205 + $igd_VAP0206 + $igd_VAP0207 + $igd_VAP0208 + $igd_VAP0209 + $igd_VAP0210;

            $no_igd_VAP0101 = $igd->where('VAP0101', '0')->count();
            $no_igd_VAP0102 = $igd->where('VAP0102', '0')->count();
            $no_igd_VAP0103 = $igd->where('VAP0103', '0')->count();
            $no_igd_VAP0104 = $igd->where('VAP0104', '0')->count();
            $no_igd_VAP0201 = $igd->where('VAP0201', '0')->count();
            $no_igd_VAP0202 = $igd->where('VAP0202', '0')->count();
            $no_igd_VAP0203 = $igd->where('VAP0203', '0')->count();
            $no_igd_VAP0204 = $igd->where('VAP0204', '0')->count();
            $no_igd_VAP0205 = $igd->where('VAP0205', '0')->count();
            $no_igd_VAP0206 = $igd->where('VAP0206', '0')->count();
            $no_igd_VAP0207 = $igd->where('VAP0207', '0')->count();
            $no_igd_VAP0208 = $igd->where('VAP0208', '0')->count();
            $no_igd_VAP0209 = $igd->where('VAP0209', '0')->count();
            $no_igd_VAP0210 = $igd->where('VAP0210', '0')->count();
            $no_igd_jumlah = $no_igd_VAP0101 + $no_igd_VAP0102 + $no_igd_VAP0103 + $no_igd_VAP0104 + $no_igd_VAP0201 + $no_igd_VAP0202 + $no_igd_VAP0203 + $no_igd_VAP0204 + $no_igd_VAP0205 + $no_igd_VAP0206 + $no_igd_VAP0207 + $no_igd_VAP0208 + $no_igd_VAP0209 + $no_igd_VAP0210;

            $denominator_igd = $igd_jumlah + $no_igd_jumlah;

            $int_VAP0101 = $int->where('VAP0101', '1')->count();
            $int_VAP0102 = $int->where('VAP0102', '1')->count();
            $int_VAP0103 = $int->where('VAP0103', '1')->count();
            $int_VAP0104 = $int->where('VAP0104', '1')->count();
            $int_VAP0201 = $int->where('VAP0201', '1')->count();
            $int_VAP0202 = $int->where('VAP0202', '1')->count();
            $int_VAP0203 = $int->where('VAP0203', '1')->count();
            $int_VAP0204 = $int->where('VAP0204', '1')->count();
            $int_VAP0205 = $int->where('VAP0205', '1')->count();
            $int_VAP0206 = $int->where('VAP0206', '1')->count();
            $int_VAP0207 = $int->where('VAP0207', '1')->count();
            $int_VAP0208 = $int->where('VAP0208', '1')->count();
            $int_VAP0209 = $int->where('VAP0209', '1')->count();
            $int_VAP0210 = $int->where('VAP0210', '1')->count();
            $int_jumlah = $int_VAP0101 + $int_VAP0102 + $int_VAP0103 + $int_VAP0104 + $int_VAP0201 + $int_VAP0202 + $int_VAP0203 + $int_VAP0204 + $int_VAP0205 + $int_VAP0206 + $int_VAP0207 + $int_VAP0208 + $int_VAP0209 + $int_VAP0210;

            $no_int_VAP0101 = $int->where('VAP0101', '0')->count();
            $no_int_VAP0102 = $int->where('VAP0102', '0')->count();
            $no_int_VAP0103 = $int->where('VAP0103', '0')->count();
            $no_int_VAP0104 = $int->where('VAP0104', '0')->count();
            $no_int_VAP0201 = $int->where('VAP0201', '0')->count();
            $no_int_VAP0202 = $int->where('VAP0202', '0')->count();
            $no_int_VAP0203 = $int->where('VAP0203', '0')->count();
            $no_int_VAP0204 = $int->where('VAP0204', '0')->count();
            $no_int_VAP0205 = $int->where('VAP0205', '0')->count();
            $no_int_VAP0206 = $int->where('VAP0206', '0')->count();
            $no_int_VAP0207 = $int->where('VAP0207', '0')->count();
            $no_int_VAP0208 = $int->where('VAP0208', '0')->count();
            $no_int_VAP0209 = $int->where('VAP0209', '0')->count();
            $no_int_VAP0210 = $int->where('VAP0210', '0')->count();
            $no_int_jumlah = $no_int_VAP0101 + $no_int_VAP0102 + $no_int_VAP0103 + $no_int_VAP0104 + $no_int_VAP0201 + $no_int_VAP0202 + $no_int_VAP0203 + $no_int_VAP0204 + $no_int_VAP0205 + $no_int_VAP0206 + $no_int_VAP0207 + $no_int_VAP0208 + $no_int_VAP0209 + $no_int_VAP0210;

            $denominator_int = $int_jumlah + $no_int_jumlah;

            $ok_VAP0101 = $ok->where('VAP0101', '1')->count();
            $ok_VAP0102 = $ok->where('VAP0102', '1')->count();
            $ok_VAP0103 = $ok->where('VAP0103', '1')->count();
            $ok_VAP0104 = $ok->where('VAP0104', '1')->count();
            $ok_VAP0201 = $ok->where('VAP0201', '1')->count();
            $ok_VAP0202 = $ok->where('VAP0202', '1')->count();
            $ok_VAP0203 = $ok->where('VAP0203', '1')->count();
            $ok_VAP0204 = $ok->where('VAP0204', '1')->count();
            $ok_VAP0205 = $ok->where('VAP0205', '1')->count();
            $ok_VAP0206 = $ok->where('VAP0206', '1')->count();
            $ok_VAP0207 = $ok->where('VAP0207', '1')->count();
            $ok_VAP0208 = $ok->where('VAP0208', '1')->count();
            $ok_VAP0209 = $ok->where('VAP0209', '1')->count();
            $ok_VAP0210 = $ok->where('VAP0210', '1')->count();
            $ok_jumlah = $ok_VAP0101 + $ok_VAP0102 + $ok_VAP0103 + $ok_VAP0104 + $ok_VAP0201 + $ok_VAP0202 + $ok_VAP0203 + $ok_VAP0204 + $ok_VAP0205 + $ok_VAP0206 + $ok_VAP0207 + $ok_VAP0208 + $ok_VAP0209 + $ok_VAP0210;

            $no_ok_VAP0101 = $ok->where('VAP0101', '0')->count();
            $no_ok_VAP0102 = $ok->where('VAP0102', '0')->count();
            $no_ok_VAP0103 = $ok->where('VAP0103', '0')->count();
            $no_ok_VAP0104 = $ok->where('VAP0104', '0')->count();
            $no_ok_VAP0201 = $ok->where('VAP0201', '0')->count();
            $no_ok_VAP0202 = $ok->where('VAP0202', '0')->count();
            $no_ok_VAP0203 = $ok->where('VAP0203', '0')->count();
            $no_ok_VAP0204 = $ok->where('VAP0204', '0')->count();
            $no_ok_VAP0205 = $ok->where('VAP0205', '0')->count();
            $no_ok_VAP0206 = $ok->where('VAP0206', '0')->count();
            $no_ok_VAP0207 = $ok->where('VAP0207', '0')->count();
            $no_ok_VAP0208 = $ok->where('VAP0208', '0')->count();
            $no_ok_VAP0209 = $ok->where('VAP0209', '0')->count();
            $no_ok_VAP0210 = $ok->where('VAP0210', '0')->count();
            $no_ok_jumlah = $no_ok_VAP0101 + $no_ok_VAP0102 + $no_ok_VAP0103 + $no_ok_VAP0104 + $no_ok_VAP0201 + $no_ok_VAP0202 + $no_ok_VAP0203 + $no_ok_VAP0204 + $no_ok_VAP0205 + $no_ok_VAP0206 + $no_ok_VAP0207 + $no_ok_VAP0208 + $no_ok_VAP0209 + $no_ok_VAP0210;

            $denominator_ok = $ok_jumlah + $no_ok_jumlah;

            $lt2_VAP0101 = $lt2->where('VAP0101', '1')->count();
            $lt2_VAP0102 = $lt2->where('VAP0102', '1')->count();
            $lt2_VAP0103 = $lt2->where('VAP0103', '1')->count();
            $lt2_VAP0104 = $lt2->where('VAP0104', '1')->count();
            $lt2_VAP0201 = $lt2->where('VAP0201', '1')->count();
            $lt2_VAP0202 = $lt2->where('VAP0202', '1')->count();
            $lt2_VAP0203 = $lt2->where('VAP0203', '1')->count();
            $lt2_VAP0204 = $lt2->where('VAP0204', '1')->count();
            $lt2_VAP0205 = $lt2->where('VAP0205', '1')->count();
            $lt2_VAP0206 = $lt2->where('VAP0206', '1')->count();
            $lt2_VAP0207 = $lt2->where('VAP0207', '1')->count();
            $lt2_VAP0208 = $lt2->where('VAP0208', '1')->count();
            $lt2_VAP0209 = $lt2->where('VAP0209', '1')->count();
            $lt2_VAP0210 = $lt2->where('VAP0210', '1')->count();
            $lt2_jumlah = $lt2_VAP0101 + $lt2_VAP0102 + $lt2_VAP0103 + $lt2_VAP0104 + $lt2_VAP0201 + $lt2_VAP0202 + $lt2_VAP0203 + $lt2_VAP0204 + $lt2_VAP0205 + $lt2_VAP0206 + $lt2_VAP0207 + $lt2_VAP0208 + $lt2_VAP0209 + $lt2_VAP0210;

            $no_lt2_VAP0101 = $lt2->where('VAP0101', '0')->count();
            $no_lt2_VAP0102 = $lt2->where('VAP0102', '0')->count();
            $no_lt2_VAP0103 = $lt2->where('VAP0103', '0')->count();
            $no_lt2_VAP0104 = $lt2->where('VAP0104', '0')->count();
            $no_lt2_VAP0201 = $lt2->where('VAP0201', '0')->count();
            $no_lt2_VAP0202 = $lt2->where('VAP0202', '0')->count();
            $no_lt2_VAP0203 = $lt2->where('VAP0203', '0')->count();
            $no_lt2_VAP0204 = $lt2->where('VAP0204', '0')->count();
            $no_lt2_VAP0205 = $lt2->where('VAP0205', '0')->count();
            $no_lt2_VAP0206 = $lt2->where('VAP0206', '0')->count();
            $no_lt2_VAP0207 = $lt2->where('VAP0207', '0')->count();
            $no_lt2_VAP0208 = $lt2->where('VAP0208', '0')->count();
            $no_lt2_VAP0209 = $lt2->where('VAP0209', '0')->count();
            $no_lt2_VAP0210 = $lt2->where('VAP0210', '0')->count();
            $no_lt2_jumlah = $no_lt2_VAP0101 + $no_lt2_VAP0102 + $no_lt2_VAP0103 + $no_lt2_VAP0104 + $no_lt2_VAP0201 + $no_lt2_VAP0202 + $no_lt2_VAP0203 + $no_lt2_VAP0204 + $no_lt2_VAP0205 + $no_lt2_VAP0206 + $no_lt2_VAP0207 + $no_lt2_VAP0208 + $no_lt2_VAP0209 + $no_lt2_VAP0210;

            $denominator_lt2 = $lt2_jumlah + $no_lt2_jumlah;

            $lt4_VAP0101 = $lt4->where('VAP0101', '1')->count();
            $lt4_VAP0102 = $lt4->where('VAP0102', '1')->count();
            $lt4_VAP0103 = $lt4->where('VAP0103', '1')->count();
            $lt4_VAP0104 = $lt4->where('VAP0104', '1')->count();
            $lt4_VAP0201 = $lt4->where('VAP0201', '1')->count();
            $lt4_VAP0202 = $lt4->where('VAP0202', '1')->count();
            $lt4_VAP0203 = $lt4->where('VAP0203', '1')->count();
            $lt4_VAP0204 = $lt4->where('VAP0204', '1')->count();
            $lt4_VAP0205 = $lt4->where('VAP0205', '1')->count();
            $lt4_VAP0206 = $lt4->where('VAP0206', '1')->count();
            $lt4_VAP0207 = $lt4->where('VAP0207', '1')->count();
            $lt4_VAP0208 = $lt4->where('VAP0208', '1')->count();
            $lt4_VAP0209 = $lt4->where('VAP0209', '1')->count();
            $lt4_VAP0210 = $lt4->where('VAP0210', '1')->count();
            $lt4_jumlah = $lt4_VAP0101 + $lt4_VAP0102 + $lt4_VAP0103 + $lt4_VAP0104 + $lt4_VAP0201 + $lt4_VAP0202 + $lt4_VAP0203 + $lt4_VAP0204 + $lt4_VAP0205 + $lt4_VAP0206 + $lt4_VAP0207 + $lt4_VAP0208 + $lt4_VAP0209 + $lt4_VAP0210;

            $no_lt4_VAP0101 = $lt4->where('VAP0101', '0')->count();
            $no_lt4_VAP0102 = $lt4->where('VAP0102', '0')->count();
            $no_lt4_VAP0103 = $lt4->where('VAP0103', '0')->count();
            $no_lt4_VAP0104 = $lt4->where('VAP0104', '0')->count();
            $no_lt4_VAP0201 = $lt4->where('VAP0201', '0')->count();
            $no_lt4_VAP0202 = $lt4->where('VAP0202', '0')->count();
            $no_lt4_VAP0203 = $lt4->where('VAP0203', '0')->count();
            $no_lt4_VAP0204 = $lt4->where('VAP0204', '0')->count();
            $no_lt4_VAP0205 = $lt4->where('VAP0205', '0')->count();
            $no_lt4_VAP0206 = $lt4->where('VAP0206', '0')->count();
            $no_lt4_VAP0207 = $lt4->where('VAP0207', '0')->count();
            $no_lt4_VAP0208 = $lt4->where('VAP0208', '0')->count();
            $no_lt4_VAP0209 = $lt4->where('VAP0209', '0')->count();
            $no_lt4_VAP0210 = $lt4->where('VAP0210', '0')->count();
            $no_lt4_jumlah = $no_lt4_VAP0101 + $no_lt4_VAP0102 + $no_lt4_VAP0103 + $no_lt4_VAP0104 + $no_lt4_VAP0201 + $no_lt4_VAP0202 + $no_lt4_VAP0203 + $no_lt4_VAP0204 + $no_lt4_VAP0205 + $no_lt4_VAP0206 + $no_lt4_VAP0207 + $no_lt4_VAP0208 + $no_lt4_VAP0209 + $no_lt4_VAP0210;

            $denominator_lt4 = $lt4_jumlah + $no_lt4_jumlah;

            $lt5_VAP0101 = $lt5->where('VAP0101', '1')->count();
            $lt5_VAP0102 = $lt5->where('VAP0102', '1')->count();
            $lt5_VAP0103 = $lt5->where('VAP0103', '1')->count();
            $lt5_VAP0104 = $lt5->where('VAP0104', '1')->count();
            $lt5_VAP0201 = $lt5->where('VAP0201', '1')->count();
            $lt5_VAP0202 = $lt5->where('VAP0202', '1')->count();
            $lt5_VAP0203 = $lt5->where('VAP0203', '1')->count();
            $lt5_VAP0204 = $lt5->where('VAP0204', '1')->count();
            $lt5_VAP0205 = $lt5->where('VAP0205', '1')->count();
            $lt5_VAP0206 = $lt5->where('VAP0206', '1')->count();
            $lt5_VAP0207 = $lt5->where('VAP0207', '1')->count();
            $lt5_VAP0208 = $lt5->where('VAP0208', '1')->count();
            $lt5_VAP0209 = $lt5->where('VAP0209', '1')->count();
            $lt5_VAP0210 = $lt5->where('VAP0210', '1')->count();
            $lt5_jumlah = $lt5_VAP0101 + $lt5_VAP0102 + $lt5_VAP0103 + $lt5_VAP0104 + $lt5_VAP0201 + $lt5_VAP0202 + $lt5_VAP0203 + $lt5_VAP0204 + $lt5_VAP0205 + $lt5_VAP0206 + $lt5_VAP0207 + $lt5_VAP0208 + $lt5_VAP0209 + $lt5_VAP0210;

            $no_lt5_VAP0101 = $lt5->where('VAP0101', '0')->count();
            $no_lt5_VAP0102 = $lt5->where('VAP0102', '0')->count();
            $no_lt5_VAP0103 = $lt5->where('VAP0103', '0')->count();
            $no_lt5_VAP0104 = $lt5->where('VAP0104', '0')->count();
            $no_lt5_VAP0201 = $lt5->where('VAP0201', '0')->count();
            $no_lt5_VAP0202 = $lt5->where('VAP0202', '0')->count();
            $no_lt5_VAP0203 = $lt5->where('VAP0203', '0')->count();
            $no_lt5_VAP0204 = $lt5->where('VAP0204', '0')->count();
            $no_lt5_VAP0205 = $lt5->where('VAP0205', '0')->count();
            $no_lt5_VAP0206 = $lt5->where('VAP0206', '0')->count();
            $no_lt5_VAP0207 = $lt5->where('VAP0207', '0')->count();
            $no_lt5_VAP0208 = $lt5->where('VAP0208', '0')->count();
            $no_lt5_VAP0209 = $lt5->where('VAP0209', '0')->count();
            $no_lt5_VAP0210 = $lt5->where('VAP0210', '0')->count();
            $no_lt5_jumlah = $no_lt5_VAP0101 + $no_lt5_VAP0102 + $no_lt5_VAP0103 + $no_lt5_VAP0104 + $no_lt5_VAP0201 + $no_lt5_VAP0202 + $no_lt5_VAP0203 + $no_lt5_VAP0204 + $no_lt5_VAP0205 + $no_lt5_VAP0206 + $no_lt5_VAP0207 + $no_lt5_VAP0208 + $no_lt5_VAP0209 + $no_lt5_VAP0210;

            $denominator_lt5 = $lt5_jumlah + $no_lt5_jumlah;

            $vk_VAP0101 = $vk->where('VAP0101', '1')->count();
            $vk_VAP0102 = $vk->where('VAP0102', '1')->count();
            $vk_VAP0103 = $vk->where('VAP0103', '1')->count();
            $vk_VAP0104 = $vk->where('VAP0104', '1')->count();
            $vk_VAP0201 = $vk->where('VAP0201', '1')->count();
            $vk_VAP0202 = $vk->where('VAP0202', '1')->count();
            $vk_VAP0203 = $vk->where('VAP0203', '1')->count();
            $vk_VAP0204 = $vk->where('VAP0204', '1')->count();
            $vk_VAP0205 = $vk->where('VAP0205', '1')->count();
            $vk_VAP0206 = $vk->where('VAP0206', '1')->count();
            $vk_VAP0207 = $vk->where('VAP0207', '1')->count();
            $vk_VAP0208 = $vk->where('VAP0208', '1')->count();
            $vk_VAP0209 = $vk->where('VAP0209', '1')->count();
            $vk_VAP0210 = $vk->where('VAP0210', '1')->count();
            $vk_jumlah = $vk_VAP0101 + $vk_VAP0102 + $vk_VAP0103 + $vk_VAP0104 + $vk_VAP0201 + $vk_VAP0202 + $vk_VAP0203 + $vk_VAP0204 + $vk_VAP0205 + $vk_VAP0206 + $vk_VAP0207 + $vk_VAP0208 + $vk_VAP0209 + $vk_VAP0210;

            $no_vk_VAP0101 = $vk->where('VAP0101', '0')->count();
            $no_vk_VAP0102 = $vk->where('VAP0102', '0')->count();
            $no_vk_VAP0103 = $vk->where('VAP0103', '0')->count();
            $no_vk_VAP0104 = $vk->where('VAP0104', '0')->count();
            $no_vk_VAP0201 = $vk->where('VAP0201', '0')->count();
            $no_vk_VAP0202 = $vk->where('VAP0202', '0')->count();
            $no_vk_VAP0203 = $vk->where('VAP0203', '0')->count();
            $no_vk_VAP0204 = $vk->where('VAP0204', '0')->count();
            $no_vk_VAP0205 = $vk->where('VAP0205', '0')->count();
            $no_vk_VAP0206 = $vk->where('VAP0206', '0')->count();
            $no_vk_VAP0207 = $vk->where('VAP0207', '0')->count();
            $no_vk_VAP0208 = $vk->where('VAP0208', '0')->count();
            $no_vk_VAP0209 = $vk->where('VAP0209', '0')->count();
            $no_vk_VAP0210 = $vk->where('VAP0210', '0')->count();
            $no_vk_jumlah = $no_vk_VAP0101 + $no_vk_VAP0102 + $no_vk_VAP0103 + $no_vk_VAP0104 + $no_vk_VAP0201 + $no_vk_VAP0202 + $no_vk_VAP0203 + $no_vk_VAP0204 + $no_vk_VAP0205 + $no_vk_VAP0206 + $no_vk_VAP0207 + $no_vk_VAP0208 + $no_vk_VAP0209 + $no_vk_VAP0210;

            $denominator_vk = $vk_jumlah + $no_vk_jumlah;

            $tanggal = Carbon::parse($request->input('dari'))->isoFormat('DD MMMM YYYY') . ' - ' . Carbon::parse($request->input('sampai'))->isoFormat('DD MMMM YYYY');

            return Excel::download(new ExportBundleVAP(
                $igd_VAP0101,
                $igd_VAP0102,
                $igd_VAP0103,
                $igd_VAP0104,
                $igd_VAP0201,
                $igd_VAP0202,
                $igd_VAP0203,
                $igd_VAP0204,
                $igd_VAP0205,
                $igd_VAP0206,
                $igd_VAP0207,
                $igd_VAP0208,
                $igd_VAP0209,
                $igd_VAP0210,
                $igd_jumlah,

                $no_igd_VAP0101,
                $no_igd_VAP0102,
                $no_igd_VAP0103,
                $no_igd_VAP0104,
                $no_igd_VAP0201,
                $no_igd_VAP0202,
                $no_igd_VAP0203,
                $no_igd_VAP0204,
                $no_igd_VAP0205,
                $no_igd_VAP0206,
                $no_igd_VAP0207,
                $no_igd_VAP0208,
                $no_igd_VAP0209,
                $no_igd_VAP0210,
                $no_igd_jumlah,

                $denominator_igd,

                $int_VAP0101,
                $int_VAP0102,
                $int_VAP0103,
                $int_VAP0104,
                $int_VAP0201,
                $int_VAP0202,
                $int_VAP0203,
                $int_VAP0204,
                $int_VAP0205,
                $int_VAP0206,
                $int_VAP0207,
                $int_VAP0208,
                $int_VAP0209,
                $int_VAP0210,
                $int_jumlah,

                $no_int_VAP0101,
                $no_int_VAP0102,
                $no_int_VAP0103,
                $no_int_VAP0104,
                $no_int_VAP0201,
                $no_int_VAP0202,
                $no_int_VAP0203,
                $no_int_VAP0204,
                $no_int_VAP0205,
                $no_int_VAP0206,
                $no_int_VAP0207,
                $no_int_VAP0208,
                $no_int_VAP0209,
                $no_int_VAP0210,
                $no_int_jumlah,

                $denominator_int,

                $ok_VAP0101,
                $ok_VAP0102,
                $ok_VAP0103,
                $ok_VAP0104,
                $ok_VAP0201,
                $ok_VAP0202,
                $ok_VAP0203,
                $ok_VAP0204,
                $ok_VAP0205,
                $ok_VAP0206,
                $ok_VAP0207,
                $ok_VAP0208,
                $ok_VAP0209,
                $ok_VAP0210,
                $ok_jumlah,

                $no_ok_VAP0101,
                $no_ok_VAP0102,
                $no_ok_VAP0103,
                $no_ok_VAP0104,
                $no_ok_VAP0201,
                $no_ok_VAP0202,
                $no_ok_VAP0203,
                $no_ok_VAP0204,
                $no_ok_VAP0205,
                $no_ok_VAP0206,
                $no_ok_VAP0207,
                $no_ok_VAP0208,
                $no_ok_VAP0209,
                $no_ok_VAP0210,
                $no_ok_jumlah,

                $denominator_ok,

                $lt2_VAP0101,
                $lt2_VAP0102,
                $lt2_VAP0103,
                $lt2_VAP0104,
                $lt2_VAP0201,
                $lt2_VAP0202,
                $lt2_VAP0203,
                $lt2_VAP0204,
                $lt2_VAP0205,
                $lt2_VAP0206,
                $lt2_VAP0207,
                $lt2_VAP0208,
                $lt2_VAP0209,
                $lt2_VAP0210,
                $lt2_jumlah,

                $no_lt2_VAP0101,
                $no_lt2_VAP0102,
                $no_lt2_VAP0103,
                $no_lt2_VAP0104,
                $no_lt2_VAP0201,
                $no_lt2_VAP0202,
                $no_lt2_VAP0203,
                $no_lt2_VAP0204,
                $no_lt2_VAP0205,
                $no_lt2_VAP0206,
                $no_lt2_VAP0207,
                $no_lt2_VAP0208,
                $no_lt2_VAP0209,
                $no_lt2_VAP0210,
                $no_lt2_jumlah,

                $denominator_lt2,

                $lt4_VAP0101,
                $lt4_VAP0102,
                $lt4_VAP0103,
                $lt4_VAP0104,
                $lt4_VAP0201,
                $lt4_VAP0202,
                $lt4_VAP0203,
                $lt4_VAP0204,
                $lt4_VAP0205,
                $lt4_VAP0206,
                $lt4_VAP0207,
                $lt4_VAP0208,
                $lt4_VAP0209,
                $lt4_VAP0210,
                $lt4_jumlah,

                $no_lt4_VAP0101,
                $no_lt4_VAP0102,
                $no_lt4_VAP0103,
                $no_lt4_VAP0104,
                $no_lt4_VAP0201,
                $no_lt4_VAP0202,
                $no_lt4_VAP0203,
                $no_lt4_VAP0204,
                $no_lt4_VAP0205,
                $no_lt4_VAP0206,
                $no_lt4_VAP0207,
                $no_lt4_VAP0208,
                $no_lt4_VAP0209,
                $no_lt4_VAP0210,
                $no_lt4_jumlah,

                $denominator_lt4,

                $lt5_VAP0101,
                $lt5_VAP0102,
                $lt5_VAP0103,
                $lt5_VAP0104,
                $lt5_VAP0201,
                $lt5_VAP0202,
                $lt5_VAP0203,
                $lt5_VAP0204,
                $lt5_VAP0205,
                $lt5_VAP0206,
                $lt5_VAP0207,
                $lt5_VAP0208,
                $lt5_VAP0209,
                $lt5_VAP0210,
                $lt5_jumlah,

                $no_lt5_VAP0101,
                $no_lt5_VAP0102,
                $no_lt5_VAP0103,
                $no_lt5_VAP0104,
                $no_lt5_VAP0201,
                $no_lt5_VAP0202,
                $no_lt5_VAP0203,
                $no_lt5_VAP0204,
                $no_lt5_VAP0205,
                $no_lt5_VAP0206,
                $no_lt5_VAP0207,
                $no_lt5_VAP0208,
                $no_lt5_VAP0209,
                $no_lt5_VAP0210,
                $no_lt5_jumlah,

                $denominator_lt5,

                $vk_VAP0101,
                $vk_VAP0102,
                $vk_VAP0103,
                $vk_VAP0104,
                $vk_VAP0201,
                $vk_VAP0202,
                $vk_VAP0203,
                $vk_VAP0204,
                $vk_VAP0205,
                $vk_VAP0206,
                $vk_VAP0207,
                $vk_VAP0208,
                $vk_VAP0209,
                $vk_VAP0210,
                $vk_jumlah,

                $no_vk_VAP0101,
                $no_vk_VAP0102,
                $no_vk_VAP0103,
                $no_vk_VAP0104,
                $no_vk_VAP0201,
                $no_vk_VAP0202,
                $no_vk_VAP0203,
                $no_vk_VAP0204,
                $no_vk_VAP0205,
                $no_vk_VAP0206,
                $no_vk_VAP0207,
                $no_vk_VAP0208,
                $no_vk_VAP0209,
                $no_vk_VAP0210,
                $no_vk_jumlah,

                $denominator_vk,

                $tabel,
                $rekap,
                $tanggal
            ), 'Rekap Bundle VAP ' . $tanggal . '.pdf', \Maatwebsite\Excel\Excel::MPDF);
        } else {
            return Redirect::back()->withErrors(['msg' => 'Tanggal tidak boleh Lebih kecil dari sebelumnya']);
        }
    }
}
