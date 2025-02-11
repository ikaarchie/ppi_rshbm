<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\BundleISK;
use Illuminate\Http\Request;
use App\Models\RekapBundleIsk;
use App\Exports\ExportBundleISK;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Redirect;

class BundleISKController extends Controller
{
    public function index()
    {
        return view('bundleISK.index');
    }

    public function getData()
    {
        $bundleISK = BundleISK::latest('id')->paginate(10);

        return view('bundleISK.index')->with('bundleISK', $bundleISK);
    }

    public function save(Request $request)
    {
        $data = new BundleISK();
        $data->mrn = $request->input('mrn');
        $data->nama_pasien = $request->input('nama_pasien');
        $data->diagnosa = $request->input('diagnosa');
        $data->unit = $request->input('unit');
        $data->tgl = $request->input('tgl');
        $data->ISK0101 = $request->input('ISK0101');
        $data->ISK0102 = $request->input('ISK0102');
        $data->ISK0103 = $request->input('ISK0103');
        $data->ISK0104 = $request->input('ISK0104');
        $data->ISK0201 = $request->input('ISK0201');
        $data->ISK0202 = $request->input('ISK0202');
        $data->ISK0203 = $request->input('ISK0203');
        $data->ISK0204 = $request->input('ISK0204');
        $data->save();

        return redirect('/bundleIsk')->with('success', 'Data berhasil disimpan!');
    }

    public function update(Request $request, $id)
    {
        $bundleISK = BundleISK::find($id);
        $input = $request->all();
        $bundleISK->fill($input)->save();

        return redirect('/bundleIsk');
    }

    public function destroy($id)
    {
        $bundleISK = BundleISK::find($id);
        $bundleISK->delete();

        return redirect('/bundleIsk');
    }

    public function inputRekap(Request $request)
    {
        $tgl_skg = date('Y-m-d');

        $data = new RekapBundleIsk();
        $data->dari = $request->input('dari') ?? $tgl_skg;
        $data->sampai = $request->input('sampai') ?? $tgl_skg;
        $data->analisa = $request->input('analisa');
        $data->tindak_lanjut = $request->input('tindak_lanjut');
        $data->save();

        return redirect('/rekapBundleIsk')->with('success', 'Data berhasil disimpan!');
    }

    public function updateRekap(Request $request, $id)
    {
        $rekap = RekapBundleIsk::find($id);
        $input = $request->all();
        $rekap->fill($input)->save();

        return redirect('/rekapBundleIsk');
    }

    public function rekap(Request $request)
    {
        $tgl_skg = date('Y-m-d');
        $dari = date_create($request->input('dari'));
        $sampai = date_create($request->input('sampai'));
        $diff  = date_diff($dari, $sampai);
        $range_tgl = $diff->d + 1;

        if ($request->input('dari') <= $request->input('sampai')) {
            $tabel = BundleISK::whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')->paginate(1000);
            // dd($tabel);

            $rekap = RekapBundleIsk::whereDate('dari', '=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('sampai', '=', $request->input('sampai') ?? $tgl_skg)
                ->get();

            $analisa = RekapBundleIsk::select('analisa')
                ->whereDate('dari', '=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('sampai', '=', $request->input('sampai') ?? $tgl_skg)
                ->get();

            $tindak_lanjut = RekapBundleIsk::select('tindak_lanjut')
                ->whereDate('dari', '=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('sampai', '=', $request->input('sampai') ?? $tgl_skg)
                ->get();

            $igd = BundleISK::where('unit', 'IGD')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $int = BundleISK::where('unit', 'Intensif')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $ok = BundleISK::where('unit', 'OK')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt2 = BundleISK::where('unit', 'Perawatan Eksekutif lt.2')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt4 = BundleISK::where('unit', 'Perawatan Reguler lt.4')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt5 = BundleISK::where('unit', 'Perawatan Reguler lt.5')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $vk = BundleISK::where('unit', 'VK')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();

            $igd_ISK0101 = $igd->where('ISK0101', '1')->count();
            $igd_ISK0102 = $igd->where('ISK0102', '1')->count();
            $igd_ISK0103 = $igd->where('ISK0103', '1')->count();
            $igd_ISK0104 = $igd->where('ISK0104', '1')->count();
            $igd_ISK0201 = $igd->where('ISK0201', '1')->count();
            $igd_ISK0202 = $igd->where('ISK0202', '1')->count();
            $igd_ISK0203 = $igd->where('ISK0203', '1')->count();
            $igd_ISK0204 = $igd->where('ISK0204', '1')->count();
            $igd_jumlah = $igd_ISK0101 + $igd_ISK0102 + $igd_ISK0103 + $igd_ISK0104 + $igd_ISK0201 + $igd_ISK0202 + $igd_ISK0203 + $igd_ISK0204;

            $no_igd_ISK0101 = $igd->where('ISK0101', '0')->count();
            $no_igd_ISK0102 = $igd->where('ISK0102', '0')->count();
            $no_igd_ISK0103 = $igd->where('ISK0103', '0')->count();
            $no_igd_ISK0104 = $igd->where('ISK0104', '0')->count();
            $no_igd_ISK0201 = $igd->where('ISK0201', '0')->count();
            $no_igd_ISK0202 = $igd->where('ISK0202', '0')->count();
            $no_igd_ISK0203 = $igd->where('ISK0203', '0')->count();
            $no_igd_ISK0204 = $igd->where('ISK0204', '0')->count();
            $no_igd_jumlah = $no_igd_ISK0101 + $no_igd_ISK0102 + $no_igd_ISK0103 + $no_igd_ISK0104 + $no_igd_ISK0201 + $no_igd_ISK0202 + $no_igd_ISK0203 + $no_igd_ISK0204;

            $denominator_igd = $igd_jumlah + $no_igd_jumlah;

            $int_ISK0101 = $int->where('ISK0101', '1')->count();
            $int_ISK0102 = $int->where('ISK0102', '1')->count();
            $int_ISK0103 = $int->where('ISK0103', '1')->count();
            $int_ISK0104 = $int->where('ISK0104', '1')->count();
            $int_ISK0201 = $int->where('ISK0201', '1')->count();
            $int_ISK0202 = $int->where('ISK0202', '1')->count();
            $int_ISK0203 = $int->where('ISK0203', '1')->count();
            $int_ISK0204 = $int->where('ISK0204', '1')->count();
            $int_jumlah = $int_ISK0101 + $int_ISK0102 + $int_ISK0103 + $int_ISK0104 + $int_ISK0201 + $int_ISK0202 + $int_ISK0203 + $int_ISK0204;

            $no_int_ISK0101 = $int->where('ISK0101', '0')->count();
            $no_int_ISK0102 = $int->where('ISK0102', '0')->count();
            $no_int_ISK0103 = $int->where('ISK0103', '0')->count();
            $no_int_ISK0104 = $int->where('ISK0104', '0')->count();
            $no_int_ISK0201 = $int->where('ISK0201', '0')->count();
            $no_int_ISK0202 = $int->where('ISK0202', '0')->count();
            $no_int_ISK0203 = $int->where('ISK0203', '0')->count();
            $no_int_ISK0204 = $int->where('ISK0204', '0')->count();
            $no_int_jumlah = $no_int_ISK0101 + $no_int_ISK0102 + $no_int_ISK0103 + $no_int_ISK0104 + $no_int_ISK0201 + $no_int_ISK0202 + $no_int_ISK0203 + $no_int_ISK0204;

            $denominator_int = $int_jumlah + $no_int_jumlah;

            $ok_ISK0101 = $ok->where('ISK0101', '1')->count();
            $ok_ISK0102 = $ok->where('ISK0102', '1')->count();
            $ok_ISK0103 = $ok->where('ISK0103', '1')->count();
            $ok_ISK0104 = $ok->where('ISK0104', '1')->count();
            $ok_ISK0201 = $ok->where('ISK0201', '1')->count();
            $ok_ISK0202 = $ok->where('ISK0202', '1')->count();
            $ok_ISK0203 = $ok->where('ISK0203', '1')->count();
            $ok_ISK0204 = $ok->where('ISK0204', '1')->count();
            $ok_jumlah = $ok_ISK0101 + $ok_ISK0102 + $ok_ISK0103 + $ok_ISK0104 + $ok_ISK0201 + $ok_ISK0202 + $ok_ISK0203 + $ok_ISK0204;

            $no_ok_ISK0101 = $ok->where('ISK0101', '0')->count();
            $no_ok_ISK0102 = $ok->where('ISK0102', '0')->count();
            $no_ok_ISK0103 = $ok->where('ISK0103', '0')->count();
            $no_ok_ISK0104 = $ok->where('ISK0104', '0')->count();
            $no_ok_ISK0201 = $ok->where('ISK0201', '0')->count();
            $no_ok_ISK0202 = $ok->where('ISK0202', '0')->count();
            $no_ok_ISK0203 = $ok->where('ISK0203', '0')->count();
            $no_ok_ISK0204 = $ok->where('ISK0204', '0')->count();
            $no_ok_jumlah = $no_ok_ISK0101 + $no_ok_ISK0102 + $no_ok_ISK0103 + $no_ok_ISK0104 + $no_ok_ISK0201 + $no_ok_ISK0202 + $no_ok_ISK0203 + $no_ok_ISK0204;

            $denominator_ok = $ok_jumlah + $no_ok_jumlah;

            $lt2_ISK0101 = $lt2->where('ISK0101', '1')->count();
            $lt2_ISK0102 = $lt2->where('ISK0102', '1')->count();
            $lt2_ISK0103 = $lt2->where('ISK0103', '1')->count();
            $lt2_ISK0104 = $lt2->where('ISK0104', '1')->count();
            $lt2_ISK0201 = $lt2->where('ISK0201', '1')->count();
            $lt2_ISK0202 = $lt2->where('ISK0202', '1')->count();
            $lt2_ISK0203 = $lt2->where('ISK0203', '1')->count();
            $lt2_ISK0204 = $lt2->where('ISK0204', '1')->count();
            $lt2_jumlah = $lt2_ISK0101 + $lt2_ISK0102 + $lt2_ISK0103 + $lt2_ISK0104 + $lt2_ISK0201 + $lt2_ISK0202 + $lt2_ISK0203 + $lt2_ISK0204;

            $no_lt2_ISK0101 = $lt2->where('ISK0101', '0')->count();
            $no_lt2_ISK0102 = $lt2->where('ISK0102', '0')->count();
            $no_lt2_ISK0103 = $lt2->where('ISK0103', '0')->count();
            $no_lt2_ISK0104 = $lt2->where('ISK0104', '0')->count();
            $no_lt2_ISK0201 = $lt2->where('ISK0201', '0')->count();
            $no_lt2_ISK0202 = $lt2->where('ISK0202', '0')->count();
            $no_lt2_ISK0203 = $lt2->where('ISK0203', '0')->count();
            $no_lt2_ISK0204 = $lt2->where('ISK0204', '0')->count();
            $no_lt2_jumlah = $no_lt2_ISK0101 + $no_lt2_ISK0102 + $no_lt2_ISK0103 + $no_lt2_ISK0104 + $no_lt2_ISK0201 + $no_lt2_ISK0202 + $no_lt2_ISK0203 + $no_lt2_ISK0204;

            $denominator_lt2 = $lt2_jumlah + $no_lt2_jumlah;

            $lt4_ISK0101 = $lt4->where('ISK0101', '1')->count();
            $lt4_ISK0102 = $lt4->where('ISK0102', '1')->count();
            $lt4_ISK0103 = $lt4->where('ISK0103', '1')->count();
            $lt4_ISK0104 = $lt4->where('ISK0104', '1')->count();
            $lt4_ISK0201 = $lt4->where('ISK0201', '1')->count();
            $lt4_ISK0202 = $lt4->where('ISK0202', '1')->count();
            $lt4_ISK0203 = $lt4->where('ISK0203', '1')->count();
            $lt4_ISK0204 = $lt4->where('ISK0204', '1')->count();
            $lt4_jumlah = $lt4_ISK0101 + $lt4_ISK0102 + $lt4_ISK0103 + $lt4_ISK0104 + $lt4_ISK0201 + $lt4_ISK0202 + $lt4_ISK0203 + $lt4_ISK0204;

            $no_lt4_ISK0101 = $lt4->where('ISK0101', '0')->count();
            $no_lt4_ISK0102 = $lt4->where('ISK0102', '0')->count();
            $no_lt4_ISK0103 = $lt4->where('ISK0103', '0')->count();
            $no_lt4_ISK0104 = $lt4->where('ISK0104', '0')->count();
            $no_lt4_ISK0201 = $lt4->where('ISK0201', '0')->count();
            $no_lt4_ISK0202 = $lt4->where('ISK0202', '0')->count();
            $no_lt4_ISK0203 = $lt4->where('ISK0203', '0')->count();
            $no_lt4_ISK0204 = $lt4->where('ISK0204', '0')->count();
            $no_lt4_jumlah = $no_lt4_ISK0101 + $no_lt4_ISK0102 + $no_lt4_ISK0103 + $no_lt4_ISK0104 + $no_lt4_ISK0201 + $no_lt4_ISK0202 + $no_lt4_ISK0203 + $no_lt4_ISK0204;

            $denominator_lt4 = $lt4_jumlah + $no_lt4_jumlah;

            $lt5_ISK0101 = $lt5->where('ISK0101', '1')->count();
            $lt5_ISK0102 = $lt5->where('ISK0102', '1')->count();
            $lt5_ISK0103 = $lt5->where('ISK0103', '1')->count();
            $lt5_ISK0104 = $lt5->where('ISK0104', '1')->count();
            $lt5_ISK0201 = $lt5->where('ISK0201', '1')->count();
            $lt5_ISK0202 = $lt5->where('ISK0202', '1')->count();
            $lt5_ISK0203 = $lt5->where('ISK0203', '1')->count();
            $lt5_ISK0204 = $lt5->where('ISK0204', '1')->count();
            $lt5_jumlah = $lt5_ISK0101 + $lt5_ISK0102 + $lt5_ISK0103 + $lt5_ISK0104 + $lt5_ISK0201 + $lt5_ISK0202 + $lt5_ISK0203 + $lt5_ISK0204;

            $no_lt5_ISK0101 = $lt5->where('ISK0101', '0')->count();
            $no_lt5_ISK0102 = $lt5->where('ISK0102', '0')->count();
            $no_lt5_ISK0103 = $lt5->where('ISK0103', '0')->count();
            $no_lt5_ISK0104 = $lt5->where('ISK0104', '0')->count();
            $no_lt5_ISK0201 = $lt5->where('ISK0201', '0')->count();
            $no_lt5_ISK0202 = $lt5->where('ISK0202', '0')->count();
            $no_lt5_ISK0203 = $lt5->where('ISK0203', '0')->count();
            $no_lt5_ISK0204 = $lt5->where('ISK0204', '0')->count();
            $no_lt5_jumlah = $no_lt5_ISK0101 + $no_lt5_ISK0102 + $no_lt5_ISK0103 + $no_lt5_ISK0104 + $no_lt5_ISK0201 + $no_lt5_ISK0202 + $no_lt5_ISK0203 + $no_lt5_ISK0204;

            $denominator_lt5 = $lt5_jumlah + $no_lt5_jumlah;

            $vk_ISK0101 = $vk->where('ISK0101', '1')->count();
            $vk_ISK0102 = $vk->where('ISK0102', '1')->count();
            $vk_ISK0103 = $vk->where('ISK0103', '1')->count();
            $vk_ISK0104 = $vk->where('ISK0104', '1')->count();
            $vk_ISK0201 = $vk->where('ISK0201', '1')->count();
            $vk_ISK0202 = $vk->where('ISK0202', '1')->count();
            $vk_ISK0203 = $vk->where('ISK0203', '1')->count();
            $vk_ISK0204 = $vk->where('ISK0204', '1')->count();
            $vk_jumlah = $vk_ISK0101 + $vk_ISK0102 + $vk_ISK0103 + $vk_ISK0104 + $vk_ISK0201 + $vk_ISK0202 + $vk_ISK0203 + $vk_ISK0204;

            $no_vk_ISK0101 = $vk->where('ISK0101', '0')->count();
            $no_vk_ISK0102 = $vk->where('ISK0102', '0')->count();
            $no_vk_ISK0103 = $vk->where('ISK0103', '0')->count();
            $no_vk_ISK0104 = $vk->where('ISK0104', '0')->count();
            $no_vk_ISK0201 = $vk->where('ISK0201', '0')->count();
            $no_vk_ISK0202 = $vk->where('ISK0202', '0')->count();
            $no_vk_ISK0203 = $vk->where('ISK0203', '0')->count();
            $no_vk_ISK0204 = $vk->where('ISK0204', '0')->count();
            $no_vk_jumlah = $no_vk_ISK0101 + $no_vk_ISK0102 + $no_vk_ISK0103 + $no_vk_ISK0104 + $no_vk_ISK0201 + $no_vk_ISK0202 + $no_vk_ISK0203 + $no_vk_ISK0204;

            $denominator_vk = $vk_jumlah + $no_vk_jumlah;

            return view('rekapBundleISK.index', compact(
                'range_tgl',
                'tabel',
                'rekap',
                'analisa',
                'tindak_lanjut',

                'igd_ISK0101',
                'igd_ISK0102',
                'igd_ISK0103',
                'igd_ISK0104',
                'igd_ISK0201',
                'igd_ISK0202',
                'igd_ISK0203',
                'igd_ISK0204',
                'igd_jumlah',

                'no_igd_ISK0101',
                'no_igd_ISK0102',
                'no_igd_ISK0103',
                'no_igd_ISK0104',
                'no_igd_ISK0201',
                'no_igd_ISK0202',
                'no_igd_ISK0203',
                'no_igd_ISK0204',
                'no_igd_jumlah',

                'denominator_igd',

                'int_ISK0101',
                'int_ISK0102',
                'int_ISK0103',
                'int_ISK0104',
                'int_ISK0201',
                'int_ISK0202',
                'int_ISK0203',
                'int_ISK0204',
                'int_jumlah',

                'no_int_ISK0101',
                'no_int_ISK0102',
                'no_int_ISK0103',
                'no_int_ISK0104',
                'no_int_ISK0201',
                'no_int_ISK0202',
                'no_int_ISK0203',
                'no_int_ISK0204',
                'no_int_jumlah',

                'denominator_int',

                'ok_ISK0101',
                'ok_ISK0102',
                'ok_ISK0103',
                'ok_ISK0104',
                'ok_ISK0201',
                'ok_ISK0202',
                'ok_ISK0203',
                'ok_ISK0204',
                'ok_jumlah',

                'no_ok_ISK0101',
                'no_ok_ISK0102',
                'no_ok_ISK0103',
                'no_ok_ISK0104',
                'no_ok_ISK0201',
                'no_ok_ISK0202',
                'no_ok_ISK0203',
                'no_ok_ISK0204',
                'no_ok_jumlah',

                'denominator_ok',

                'lt2_ISK0101',
                'lt2_ISK0102',
                'lt2_ISK0103',
                'lt2_ISK0104',
                'lt2_ISK0201',
                'lt2_ISK0202',
                'lt2_ISK0203',
                'lt2_ISK0204',
                'lt2_jumlah',

                'no_lt2_ISK0101',
                'no_lt2_ISK0102',
                'no_lt2_ISK0103',
                'no_lt2_ISK0104',
                'no_lt2_ISK0201',
                'no_lt2_ISK0202',
                'no_lt2_ISK0203',
                'no_lt2_ISK0204',
                'no_lt2_jumlah',

                'denominator_lt2',

                'lt4_ISK0101',
                'lt4_ISK0102',
                'lt4_ISK0103',
                'lt4_ISK0104',
                'lt4_ISK0201',
                'lt4_ISK0202',
                'lt4_ISK0203',
                'lt4_ISK0204',
                'lt4_jumlah',

                'no_lt4_ISK0101',
                'no_lt4_ISK0102',
                'no_lt4_ISK0103',
                'no_lt4_ISK0104',
                'no_lt4_ISK0201',
                'no_lt4_ISK0202',
                'no_lt4_ISK0203',
                'no_lt4_ISK0204',
                'no_lt4_jumlah',

                'denominator_lt4',

                'lt5_ISK0101',
                'lt5_ISK0102',
                'lt5_ISK0103',
                'lt5_ISK0104',
                'lt5_ISK0201',
                'lt5_ISK0202',
                'lt5_ISK0203',
                'lt5_ISK0204',
                'lt5_jumlah',

                'no_lt5_ISK0101',
                'no_lt5_ISK0102',
                'no_lt5_ISK0103',
                'no_lt5_ISK0104',
                'no_lt5_ISK0201',
                'no_lt5_ISK0202',
                'no_lt5_ISK0203',
                'no_lt5_ISK0204',
                'no_lt5_jumlah',

                'denominator_lt5',

                'vk_ISK0101',
                'vk_ISK0102',
                'vk_ISK0103',
                'vk_ISK0104',
                'vk_ISK0201',
                'vk_ISK0202',
                'vk_ISK0203',
                'vk_ISK0204',
                'vk_jumlah',

                'no_vk_ISK0101',
                'no_vk_ISK0102',
                'no_vk_ISK0103',
                'no_vk_ISK0104',
                'no_vk_ISK0201',
                'no_vk_ISK0202',
                'no_vk_ISK0203',
                'no_vk_ISK0204',
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
            $tabel = BundleISK::whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')->paginate(1000);
            // dd($tabel);

            $rekap = RekapBundleIsk::whereDate('dari', '=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('sampai', '=', $request->input('sampai') ?? $tgl_skg)
                ->get();

            $analisa = RekapBundleIsk::select('analisa')
                ->whereDate('dari', '=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('sampai', '=', $request->input('sampai') ?? $tgl_skg)
                ->get();

            $tindak_lanjut = RekapBundleIsk::select('tindak_lanjut')
                ->whereDate('dari', '=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('sampai', '=', $request->input('sampai') ?? $tgl_skg)
                ->get();

            $igd = BundleISK::where('unit', 'IGD')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $int = BundleISK::where('unit', 'Intensif')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $ok = BundleISK::where('unit', 'OK')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt2 = BundleISK::where('unit', 'Perawatan Eksekutif lt.2')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt4 = BundleISK::where('unit', 'Perawatan Reguler lt.4')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt5 = BundleISK::where('unit', 'Perawatan Reguler lt.5')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $vk = BundleISK::where('unit', 'VK')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();

            $igd_ISK0101 = $igd->where('ISK0101', '1')->count();
            $igd_ISK0102 = $igd->where('ISK0102', '1')->count();
            $igd_ISK0103 = $igd->where('ISK0103', '1')->count();
            $igd_ISK0104 = $igd->where('ISK0104', '1')->count();
            $igd_ISK0201 = $igd->where('ISK0201', '1')->count();
            $igd_ISK0202 = $igd->where('ISK0202', '1')->count();
            $igd_ISK0203 = $igd->where('ISK0203', '1')->count();
            $igd_ISK0204 = $igd->where('ISK0204', '1')->count();
            $igd_jumlah = $igd_ISK0101 + $igd_ISK0102 + $igd_ISK0103 + $igd_ISK0104 + $igd_ISK0201 + $igd_ISK0202 + $igd_ISK0203 + $igd_ISK0204;

            $no_igd_ISK0101 = $igd->where('ISK0101', '0')->count();
            $no_igd_ISK0102 = $igd->where('ISK0102', '0')->count();
            $no_igd_ISK0103 = $igd->where('ISK0103', '0')->count();
            $no_igd_ISK0104 = $igd->where('ISK0104', '0')->count();
            $no_igd_ISK0201 = $igd->where('ISK0201', '0')->count();
            $no_igd_ISK0202 = $igd->where('ISK0202', '0')->count();
            $no_igd_ISK0203 = $igd->where('ISK0203', '0')->count();
            $no_igd_ISK0204 = $igd->where('ISK0204', '0')->count();
            $no_igd_jumlah = $no_igd_ISK0101 + $no_igd_ISK0102 + $no_igd_ISK0103 + $no_igd_ISK0104 + $no_igd_ISK0201 + $no_igd_ISK0202 + $no_igd_ISK0203 + $no_igd_ISK0204;

            $denominator_igd = $igd_jumlah + $no_igd_jumlah;

            $int_ISK0101 = $int->where('ISK0101', '1')->count();
            $int_ISK0102 = $int->where('ISK0102', '1')->count();
            $int_ISK0103 = $int->where('ISK0103', '1')->count();
            $int_ISK0104 = $int->where('ISK0104', '1')->count();
            $int_ISK0201 = $int->where('ISK0201', '1')->count();
            $int_ISK0202 = $int->where('ISK0202', '1')->count();
            $int_ISK0203 = $int->where('ISK0203', '1')->count();
            $int_ISK0204 = $int->where('ISK0204', '1')->count();
            $int_jumlah = $int_ISK0101 + $int_ISK0102 + $int_ISK0103 + $int_ISK0104 + $int_ISK0201 + $int_ISK0202 + $int_ISK0203 + $int_ISK0204;

            $no_int_ISK0101 = $int->where('ISK0101', '0')->count();
            $no_int_ISK0102 = $int->where('ISK0102', '0')->count();
            $no_int_ISK0103 = $int->where('ISK0103', '0')->count();
            $no_int_ISK0104 = $int->where('ISK0104', '0')->count();
            $no_int_ISK0201 = $int->where('ISK0201', '0')->count();
            $no_int_ISK0202 = $int->where('ISK0202', '0')->count();
            $no_int_ISK0203 = $int->where('ISK0203', '0')->count();
            $no_int_ISK0204 = $int->where('ISK0204', '0')->count();
            $no_int_jumlah = $no_int_ISK0101 + $no_int_ISK0102 + $no_int_ISK0103 + $no_int_ISK0104 + $no_int_ISK0201 + $no_int_ISK0202 + $no_int_ISK0203 + $no_int_ISK0204;

            $denominator_int = $int_jumlah + $no_int_jumlah;

            $ok_ISK0101 = $ok->where('ISK0101', '1')->count();
            $ok_ISK0102 = $ok->where('ISK0102', '1')->count();
            $ok_ISK0103 = $ok->where('ISK0103', '1')->count();
            $ok_ISK0104 = $ok->where('ISK0104', '1')->count();
            $ok_ISK0201 = $ok->where('ISK0201', '1')->count();
            $ok_ISK0202 = $ok->where('ISK0202', '1')->count();
            $ok_ISK0203 = $ok->where('ISK0203', '1')->count();
            $ok_ISK0204 = $ok->where('ISK0204', '1')->count();
            $ok_jumlah = $ok_ISK0101 + $ok_ISK0102 + $ok_ISK0103 + $ok_ISK0104 + $ok_ISK0201 + $ok_ISK0202 + $ok_ISK0203 + $ok_ISK0204;

            $no_ok_ISK0101 = $ok->where('ISK0101', '0')->count();
            $no_ok_ISK0102 = $ok->where('ISK0102', '0')->count();
            $no_ok_ISK0103 = $ok->where('ISK0103', '0')->count();
            $no_ok_ISK0104 = $ok->where('ISK0104', '0')->count();
            $no_ok_ISK0201 = $ok->where('ISK0201', '0')->count();
            $no_ok_ISK0202 = $ok->where('ISK0202', '0')->count();
            $no_ok_ISK0203 = $ok->where('ISK0203', '0')->count();
            $no_ok_ISK0204 = $ok->where('ISK0204', '0')->count();
            $no_ok_jumlah = $no_ok_ISK0101 + $no_ok_ISK0102 + $no_ok_ISK0103 + $no_ok_ISK0104 + $no_ok_ISK0201 + $no_ok_ISK0202 + $no_ok_ISK0203 + $no_ok_ISK0204;

            $denominator_ok = $ok_jumlah + $no_ok_jumlah;

            $lt2_ISK0101 = $lt2->where('ISK0101', '1')->count();
            $lt2_ISK0102 = $lt2->where('ISK0102', '1')->count();
            $lt2_ISK0103 = $lt2->where('ISK0103', '1')->count();
            $lt2_ISK0104 = $lt2->where('ISK0104', '1')->count();
            $lt2_ISK0201 = $lt2->where('ISK0201', '1')->count();
            $lt2_ISK0202 = $lt2->where('ISK0202', '1')->count();
            $lt2_ISK0203 = $lt2->where('ISK0203', '1')->count();
            $lt2_ISK0204 = $lt2->where('ISK0204', '1')->count();
            $lt2_jumlah = $lt2_ISK0101 + $lt2_ISK0102 + $lt2_ISK0103 + $lt2_ISK0104 + $lt2_ISK0201 + $lt2_ISK0202 + $lt2_ISK0203 + $lt2_ISK0204;

            $no_lt2_ISK0101 = $lt2->where('ISK0101', '0')->count();
            $no_lt2_ISK0102 = $lt2->where('ISK0102', '0')->count();
            $no_lt2_ISK0103 = $lt2->where('ISK0103', '0')->count();
            $no_lt2_ISK0104 = $lt2->where('ISK0104', '0')->count();
            $no_lt2_ISK0201 = $lt2->where('ISK0201', '0')->count();
            $no_lt2_ISK0202 = $lt2->where('ISK0202', '0')->count();
            $no_lt2_ISK0203 = $lt2->where('ISK0203', '0')->count();
            $no_lt2_ISK0204 = $lt2->where('ISK0204', '0')->count();
            $no_lt2_jumlah = $no_lt2_ISK0101 + $no_lt2_ISK0102 + $no_lt2_ISK0103 + $no_lt2_ISK0104 + $no_lt2_ISK0201 + $no_lt2_ISK0202 + $no_lt2_ISK0203 + $no_lt2_ISK0204;

            $denominator_lt2 = $lt2_jumlah + $no_lt2_jumlah;

            $lt4_ISK0101 = $lt4->where('ISK0101', '1')->count();
            $lt4_ISK0102 = $lt4->where('ISK0102', '1')->count();
            $lt4_ISK0103 = $lt4->where('ISK0103', '1')->count();
            $lt4_ISK0104 = $lt4->where('ISK0104', '1')->count();
            $lt4_ISK0201 = $lt4->where('ISK0201', '1')->count();
            $lt4_ISK0202 = $lt4->where('ISK0202', '1')->count();
            $lt4_ISK0203 = $lt4->where('ISK0203', '1')->count();
            $lt4_ISK0204 = $lt4->where('ISK0204', '1')->count();
            $lt4_jumlah = $lt4_ISK0101 + $lt4_ISK0102 + $lt4_ISK0103 + $lt4_ISK0104 + $lt4_ISK0201 + $lt4_ISK0202 + $lt4_ISK0203 + $lt4_ISK0204;

            $no_lt4_ISK0101 = $lt4->where('ISK0101', '0')->count();
            $no_lt4_ISK0102 = $lt4->where('ISK0102', '0')->count();
            $no_lt4_ISK0103 = $lt4->where('ISK0103', '0')->count();
            $no_lt4_ISK0104 = $lt4->where('ISK0104', '0')->count();
            $no_lt4_ISK0201 = $lt4->where('ISK0201', '0')->count();
            $no_lt4_ISK0202 = $lt4->where('ISK0202', '0')->count();
            $no_lt4_ISK0203 = $lt4->where('ISK0203', '0')->count();
            $no_lt4_ISK0204 = $lt4->where('ISK0204', '0')->count();
            $no_lt4_jumlah = $no_lt4_ISK0101 + $no_lt4_ISK0102 + $no_lt4_ISK0103 + $no_lt4_ISK0104 + $no_lt4_ISK0201 + $no_lt4_ISK0202 + $no_lt4_ISK0203 + $no_lt4_ISK0204;

            $denominator_lt4 = $lt4_jumlah + $no_lt4_jumlah;

            $lt5_ISK0101 = $lt5->where('ISK0101', '1')->count();
            $lt5_ISK0102 = $lt5->where('ISK0102', '1')->count();
            $lt5_ISK0103 = $lt5->where('ISK0103', '1')->count();
            $lt5_ISK0104 = $lt5->where('ISK0104', '1')->count();
            $lt5_ISK0201 = $lt5->where('ISK0201', '1')->count();
            $lt5_ISK0202 = $lt5->where('ISK0202', '1')->count();
            $lt5_ISK0203 = $lt5->where('ISK0203', '1')->count();
            $lt5_ISK0204 = $lt5->where('ISK0204', '1')->count();
            $lt5_jumlah = $lt5_ISK0101 + $lt5_ISK0102 + $lt5_ISK0103 + $lt5_ISK0104 + $lt5_ISK0201 + $lt5_ISK0202 + $lt5_ISK0203 + $lt5_ISK0204;

            $no_lt5_ISK0101 = $lt5->where('ISK0101', '0')->count();
            $no_lt5_ISK0102 = $lt5->where('ISK0102', '0')->count();
            $no_lt5_ISK0103 = $lt5->where('ISK0103', '0')->count();
            $no_lt5_ISK0104 = $lt5->where('ISK0104', '0')->count();
            $no_lt5_ISK0201 = $lt5->where('ISK0201', '0')->count();
            $no_lt5_ISK0202 = $lt5->where('ISK0202', '0')->count();
            $no_lt5_ISK0203 = $lt5->where('ISK0203', '0')->count();
            $no_lt5_ISK0204 = $lt5->where('ISK0204', '0')->count();
            $no_lt5_jumlah = $no_lt5_ISK0101 + $no_lt5_ISK0102 + $no_lt5_ISK0103 + $no_lt5_ISK0104 + $no_lt5_ISK0201 + $no_lt5_ISK0202 + $no_lt5_ISK0203 + $no_lt5_ISK0204;

            $denominator_lt5 = $lt5_jumlah + $no_lt5_jumlah;

            $vk_ISK0101 = $vk->where('ISK0101', '1')->count();
            $vk_ISK0102 = $vk->where('ISK0102', '1')->count();
            $vk_ISK0103 = $vk->where('ISK0103', '1')->count();
            $vk_ISK0104 = $vk->where('ISK0104', '1')->count();
            $vk_ISK0201 = $vk->where('ISK0201', '1')->count();
            $vk_ISK0202 = $vk->where('ISK0202', '1')->count();
            $vk_ISK0203 = $vk->where('ISK0203', '1')->count();
            $vk_ISK0204 = $vk->where('ISK0204', '1')->count();
            $vk_jumlah = $vk_ISK0101 + $vk_ISK0102 + $vk_ISK0103 + $vk_ISK0104 + $vk_ISK0201 + $vk_ISK0202 + $vk_ISK0203 + $vk_ISK0204;

            $no_vk_ISK0101 = $vk->where('ISK0101', '0')->count();
            $no_vk_ISK0102 = $vk->where('ISK0102', '0')->count();
            $no_vk_ISK0103 = $vk->where('ISK0103', '0')->count();
            $no_vk_ISK0104 = $vk->where('ISK0104', '0')->count();
            $no_vk_ISK0201 = $vk->where('ISK0201', '0')->count();
            $no_vk_ISK0202 = $vk->where('ISK0202', '0')->count();
            $no_vk_ISK0203 = $vk->where('ISK0203', '0')->count();
            $no_vk_ISK0204 = $vk->where('ISK0204', '0')->count();
            $no_vk_jumlah = $no_vk_ISK0101 + $no_vk_ISK0102 + $no_vk_ISK0103 + $no_vk_ISK0104 + $no_vk_ISK0201 + $no_vk_ISK0202 + $no_vk_ISK0203 + $no_vk_ISK0204;

            $denominator_vk = $vk_jumlah + $no_vk_jumlah;

            $tanggal = Carbon::parse($request->input('dari'))->isoFormat('DD MMMM YYYY') . ' - ' . Carbon::parse($request->input('sampai'))->isoFormat('DD MMMM YYYY');

            return Excel::download(new ExportBundleISK(
                $igd_ISK0101,
                $igd_ISK0102,
                $igd_ISK0103,
                $igd_ISK0104,
                $igd_ISK0201,
                $igd_ISK0202,
                $igd_ISK0203,
                $igd_ISK0204,
                $igd_jumlah,

                $no_igd_ISK0101,
                $no_igd_ISK0102,
                $no_igd_ISK0103,
                $no_igd_ISK0104,
                $no_igd_ISK0201,
                $no_igd_ISK0202,
                $no_igd_ISK0203,
                $no_igd_ISK0204,
                $no_igd_jumlah,

                $denominator_igd,

                $int_ISK0101,
                $int_ISK0102,
                $int_ISK0103,
                $int_ISK0104,
                $int_ISK0201,
                $int_ISK0202,
                $int_ISK0203,
                $int_ISK0204,
                $int_jumlah,

                $no_int_ISK0101,
                $no_int_ISK0102,
                $no_int_ISK0103,
                $no_int_ISK0104,
                $no_int_ISK0201,
                $no_int_ISK0202,
                $no_int_ISK0203,
                $no_int_ISK0204,
                $no_int_jumlah,

                $denominator_int,

                $ok_ISK0101,
                $ok_ISK0102,
                $ok_ISK0103,
                $ok_ISK0104,
                $ok_ISK0201,
                $ok_ISK0202,
                $ok_ISK0203,
                $ok_ISK0204,
                $ok_jumlah,

                $no_ok_ISK0101,
                $no_ok_ISK0102,
                $no_ok_ISK0103,
                $no_ok_ISK0104,
                $no_ok_ISK0201,
                $no_ok_ISK0202,
                $no_ok_ISK0203,
                $no_ok_ISK0204,
                $no_ok_jumlah,

                $denominator_ok,

                $lt2_ISK0101,
                $lt2_ISK0102,
                $lt2_ISK0103,
                $lt2_ISK0104,
                $lt2_ISK0201,
                $lt2_ISK0202,
                $lt2_ISK0203,
                $lt2_ISK0204,
                $lt2_jumlah,

                $no_lt2_ISK0101,
                $no_lt2_ISK0102,
                $no_lt2_ISK0103,
                $no_lt2_ISK0104,
                $no_lt2_ISK0201,
                $no_lt2_ISK0202,
                $no_lt2_ISK0203,
                $no_lt2_ISK0204,
                $no_lt2_jumlah,

                $denominator_lt2,

                $lt4_ISK0101,
                $lt4_ISK0102,
                $lt4_ISK0103,
                $lt4_ISK0104,
                $lt4_ISK0201,
                $lt4_ISK0202,
                $lt4_ISK0203,
                $lt4_ISK0204,
                $lt4_jumlah,

                $no_lt4_ISK0101,
                $no_lt4_ISK0102,
                $no_lt4_ISK0103,
                $no_lt4_ISK0104,
                $no_lt4_ISK0201,
                $no_lt4_ISK0202,
                $no_lt4_ISK0203,
                $no_lt4_ISK0204,
                $no_lt4_jumlah,

                $denominator_lt4,

                $lt5_ISK0101,
                $lt5_ISK0102,
                $lt5_ISK0103,
                $lt5_ISK0104,
                $lt5_ISK0201,
                $lt5_ISK0202,
                $lt5_ISK0203,
                $lt5_ISK0204,
                $lt5_jumlah,

                $no_lt5_ISK0101,
                $no_lt5_ISK0102,
                $no_lt5_ISK0103,
                $no_lt5_ISK0104,
                $no_lt5_ISK0201,
                $no_lt5_ISK0202,
                $no_lt5_ISK0203,
                $no_lt5_ISK0204,
                $no_lt5_jumlah,

                $denominator_lt5,

                $vk_ISK0101,
                $vk_ISK0102,
                $vk_ISK0103,
                $vk_ISK0104,
                $vk_ISK0201,
                $vk_ISK0202,
                $vk_ISK0203,
                $vk_ISK0204,
                $vk_jumlah,

                $no_vk_ISK0101,
                $no_vk_ISK0102,
                $no_vk_ISK0103,
                $no_vk_ISK0104,
                $no_vk_ISK0201,
                $no_vk_ISK0202,
                $no_vk_ISK0203,
                $no_vk_ISK0204,
                $no_vk_jumlah,

                $denominator_vk,

                $tabel,
                $rekap,
                $tanggal
            ), 'Rekap Bundle ISK ' . $tanggal . '.xlsx');
        } else {
            return Redirect::back()->withErrors(['msg' => 'Tanggal tidak boleh Lebih kecil dari sebelumnya']);
        }
    }

    public function pdf(Request $request)
    {
        $tgl_skg = date('Y-m-d');

        if ($request->input('dari') <= $request->input('sampai')) {
            $tabel = BundleISK::whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')->paginate(1000);
            // dd($tabel);

            $rekap = RekapBundleIsk::whereDate('dari', '=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('sampai', '=', $request->input('sampai') ?? $tgl_skg)
                ->get();

            $analisa = RekapBundleIsk::select('analisa')
                ->whereDate('dari', '=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('sampai', '=', $request->input('sampai') ?? $tgl_skg)
                ->get();

            $tindak_lanjut = RekapBundleIsk::select('tindak_lanjut')
                ->whereDate('dari', '=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('sampai', '=', $request->input('sampai') ?? $tgl_skg)
                ->get();

            $igd = BundleISK::where('unit', 'IGD')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $int = BundleISK::where('unit', 'Intensif')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $ok = BundleISK::where('unit', 'OK')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt2 = BundleISK::where('unit', 'Perawatan Eksekutif lt.2')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt4 = BundleISK::where('unit', 'Perawatan Reguler lt.4')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt5 = BundleISK::where('unit', 'Perawatan Reguler lt.5')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $vk = BundleISK::where('unit', 'VK')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();

            $igd_ISK0101 = $igd->where('ISK0101', '1')->count();
            $igd_ISK0102 = $igd->where('ISK0102', '1')->count();
            $igd_ISK0103 = $igd->where('ISK0103', '1')->count();
            $igd_ISK0104 = $igd->where('ISK0104', '1')->count();
            $igd_ISK0201 = $igd->where('ISK0201', '1')->count();
            $igd_ISK0202 = $igd->where('ISK0202', '1')->count();
            $igd_ISK0203 = $igd->where('ISK0203', '1')->count();
            $igd_ISK0204 = $igd->where('ISK0204', '1')->count();
            $igd_jumlah = $igd_ISK0101 + $igd_ISK0102 + $igd_ISK0103 + $igd_ISK0104 + $igd_ISK0201 + $igd_ISK0202 + $igd_ISK0203 + $igd_ISK0204;

            $no_igd_ISK0101 = $igd->where('ISK0101', '0')->count();
            $no_igd_ISK0102 = $igd->where('ISK0102', '0')->count();
            $no_igd_ISK0103 = $igd->where('ISK0103', '0')->count();
            $no_igd_ISK0104 = $igd->where('ISK0104', '0')->count();
            $no_igd_ISK0201 = $igd->where('ISK0201', '0')->count();
            $no_igd_ISK0202 = $igd->where('ISK0202', '0')->count();
            $no_igd_ISK0203 = $igd->where('ISK0203', '0')->count();
            $no_igd_ISK0204 = $igd->where('ISK0204', '0')->count();
            $no_igd_jumlah = $no_igd_ISK0101 + $no_igd_ISK0102 + $no_igd_ISK0103 + $no_igd_ISK0104 + $no_igd_ISK0201 + $no_igd_ISK0202 + $no_igd_ISK0203 + $no_igd_ISK0204;

            $denominator_igd = $igd_jumlah + $no_igd_jumlah;

            $int_ISK0101 = $int->where('ISK0101', '1')->count();
            $int_ISK0102 = $int->where('ISK0102', '1')->count();
            $int_ISK0103 = $int->where('ISK0103', '1')->count();
            $int_ISK0104 = $int->where('ISK0104', '1')->count();
            $int_ISK0201 = $int->where('ISK0201', '1')->count();
            $int_ISK0202 = $int->where('ISK0202', '1')->count();
            $int_ISK0203 = $int->where('ISK0203', '1')->count();
            $int_ISK0204 = $int->where('ISK0204', '1')->count();
            $int_jumlah = $int_ISK0101 + $int_ISK0102 + $int_ISK0103 + $int_ISK0104 + $int_ISK0201 + $int_ISK0202 + $int_ISK0203 + $int_ISK0204;

            $no_int_ISK0101 = $int->where('ISK0101', '0')->count();
            $no_int_ISK0102 = $int->where('ISK0102', '0')->count();
            $no_int_ISK0103 = $int->where('ISK0103', '0')->count();
            $no_int_ISK0104 = $int->where('ISK0104', '0')->count();
            $no_int_ISK0201 = $int->where('ISK0201', '0')->count();
            $no_int_ISK0202 = $int->where('ISK0202', '0')->count();
            $no_int_ISK0203 = $int->where('ISK0203', '0')->count();
            $no_int_ISK0204 = $int->where('ISK0204', '0')->count();
            $no_int_jumlah = $no_int_ISK0101 + $no_int_ISK0102 + $no_int_ISK0103 + $no_int_ISK0104 + $no_int_ISK0201 + $no_int_ISK0202 + $no_int_ISK0203 + $no_int_ISK0204;

            $denominator_int = $int_jumlah + $no_int_jumlah;

            $ok_ISK0101 = $ok->where('ISK0101', '1')->count();
            $ok_ISK0102 = $ok->where('ISK0102', '1')->count();
            $ok_ISK0103 = $ok->where('ISK0103', '1')->count();
            $ok_ISK0104 = $ok->where('ISK0104', '1')->count();
            $ok_ISK0201 = $ok->where('ISK0201', '1')->count();
            $ok_ISK0202 = $ok->where('ISK0202', '1')->count();
            $ok_ISK0203 = $ok->where('ISK0203', '1')->count();
            $ok_ISK0204 = $ok->where('ISK0204', '1')->count();
            $ok_jumlah = $ok_ISK0101 + $ok_ISK0102 + $ok_ISK0103 + $ok_ISK0104 + $ok_ISK0201 + $ok_ISK0202 + $ok_ISK0203 + $ok_ISK0204;

            $no_ok_ISK0101 = $ok->where('ISK0101', '0')->count();
            $no_ok_ISK0102 = $ok->where('ISK0102', '0')->count();
            $no_ok_ISK0103 = $ok->where('ISK0103', '0')->count();
            $no_ok_ISK0104 = $ok->where('ISK0104', '0')->count();
            $no_ok_ISK0201 = $ok->where('ISK0201', '0')->count();
            $no_ok_ISK0202 = $ok->where('ISK0202', '0')->count();
            $no_ok_ISK0203 = $ok->where('ISK0203', '0')->count();
            $no_ok_ISK0204 = $ok->where('ISK0204', '0')->count();
            $no_ok_jumlah = $no_ok_ISK0101 + $no_ok_ISK0102 + $no_ok_ISK0103 + $no_ok_ISK0104 + $no_ok_ISK0201 + $no_ok_ISK0202 + $no_ok_ISK0203 + $no_ok_ISK0204;

            $denominator_ok = $ok_jumlah + $no_ok_jumlah;

            $lt2_ISK0101 = $lt2->where('ISK0101', '1')->count();
            $lt2_ISK0102 = $lt2->where('ISK0102', '1')->count();
            $lt2_ISK0103 = $lt2->where('ISK0103', '1')->count();
            $lt2_ISK0104 = $lt2->where('ISK0104', '1')->count();
            $lt2_ISK0201 = $lt2->where('ISK0201', '1')->count();
            $lt2_ISK0202 = $lt2->where('ISK0202', '1')->count();
            $lt2_ISK0203 = $lt2->where('ISK0203', '1')->count();
            $lt2_ISK0204 = $lt2->where('ISK0204', '1')->count();
            $lt2_jumlah = $lt2_ISK0101 + $lt2_ISK0102 + $lt2_ISK0103 + $lt2_ISK0104 + $lt2_ISK0201 + $lt2_ISK0202 + $lt2_ISK0203 + $lt2_ISK0204;

            $no_lt2_ISK0101 = $lt2->where('ISK0101', '0')->count();
            $no_lt2_ISK0102 = $lt2->where('ISK0102', '0')->count();
            $no_lt2_ISK0103 = $lt2->where('ISK0103', '0')->count();
            $no_lt2_ISK0104 = $lt2->where('ISK0104', '0')->count();
            $no_lt2_ISK0201 = $lt2->where('ISK0201', '0')->count();
            $no_lt2_ISK0202 = $lt2->where('ISK0202', '0')->count();
            $no_lt2_ISK0203 = $lt2->where('ISK0203', '0')->count();
            $no_lt2_ISK0204 = $lt2->where('ISK0204', '0')->count();
            $no_lt2_jumlah = $no_lt2_ISK0101 + $no_lt2_ISK0102 + $no_lt2_ISK0103 + $no_lt2_ISK0104 + $no_lt2_ISK0201 + $no_lt2_ISK0202 + $no_lt2_ISK0203 + $no_lt2_ISK0204;

            $denominator_lt2 = $lt2_jumlah + $no_lt2_jumlah;

            $lt4_ISK0101 = $lt4->where('ISK0101', '1')->count();
            $lt4_ISK0102 = $lt4->where('ISK0102', '1')->count();
            $lt4_ISK0103 = $lt4->where('ISK0103', '1')->count();
            $lt4_ISK0104 = $lt4->where('ISK0104', '1')->count();
            $lt4_ISK0201 = $lt4->where('ISK0201', '1')->count();
            $lt4_ISK0202 = $lt4->where('ISK0202', '1')->count();
            $lt4_ISK0203 = $lt4->where('ISK0203', '1')->count();
            $lt4_ISK0204 = $lt4->where('ISK0204', '1')->count();
            $lt4_jumlah = $lt4_ISK0101 + $lt4_ISK0102 + $lt4_ISK0103 + $lt4_ISK0104 + $lt4_ISK0201 + $lt4_ISK0202 + $lt4_ISK0203 + $lt4_ISK0204;

            $no_lt4_ISK0101 = $lt4->where('ISK0101', '0')->count();
            $no_lt4_ISK0102 = $lt4->where('ISK0102', '0')->count();
            $no_lt4_ISK0103 = $lt4->where('ISK0103', '0')->count();
            $no_lt4_ISK0104 = $lt4->where('ISK0104', '0')->count();
            $no_lt4_ISK0201 = $lt4->where('ISK0201', '0')->count();
            $no_lt4_ISK0202 = $lt4->where('ISK0202', '0')->count();
            $no_lt4_ISK0203 = $lt4->where('ISK0203', '0')->count();
            $no_lt4_ISK0204 = $lt4->where('ISK0204', '0')->count();
            $no_lt4_jumlah = $no_lt4_ISK0101 + $no_lt4_ISK0102 + $no_lt4_ISK0103 + $no_lt4_ISK0104 + $no_lt4_ISK0201 + $no_lt4_ISK0202 + $no_lt4_ISK0203 + $no_lt4_ISK0204;

            $denominator_lt4 = $lt4_jumlah + $no_lt4_jumlah;

            $lt5_ISK0101 = $lt5->where('ISK0101', '1')->count();
            $lt5_ISK0102 = $lt5->where('ISK0102', '1')->count();
            $lt5_ISK0103 = $lt5->where('ISK0103', '1')->count();
            $lt5_ISK0104 = $lt5->where('ISK0104', '1')->count();
            $lt5_ISK0201 = $lt5->where('ISK0201', '1')->count();
            $lt5_ISK0202 = $lt5->where('ISK0202', '1')->count();
            $lt5_ISK0203 = $lt5->where('ISK0203', '1')->count();
            $lt5_ISK0204 = $lt5->where('ISK0204', '1')->count();
            $lt5_jumlah = $lt5_ISK0101 + $lt5_ISK0102 + $lt5_ISK0103 + $lt5_ISK0104 + $lt5_ISK0201 + $lt5_ISK0202 + $lt5_ISK0203 + $lt5_ISK0204;

            $no_lt5_ISK0101 = $lt5->where('ISK0101', '0')->count();
            $no_lt5_ISK0102 = $lt5->where('ISK0102', '0')->count();
            $no_lt5_ISK0103 = $lt5->where('ISK0103', '0')->count();
            $no_lt5_ISK0104 = $lt5->where('ISK0104', '0')->count();
            $no_lt5_ISK0201 = $lt5->where('ISK0201', '0')->count();
            $no_lt5_ISK0202 = $lt5->where('ISK0202', '0')->count();
            $no_lt5_ISK0203 = $lt5->where('ISK0203', '0')->count();
            $no_lt5_ISK0204 = $lt5->where('ISK0204', '0')->count();
            $no_lt5_jumlah = $no_lt5_ISK0101 + $no_lt5_ISK0102 + $no_lt5_ISK0103 + $no_lt5_ISK0104 + $no_lt5_ISK0201 + $no_lt5_ISK0202 + $no_lt5_ISK0203 + $no_lt5_ISK0204;

            $denominator_lt5 = $lt5_jumlah + $no_lt5_jumlah;

            $vk_ISK0101 = $vk->where('ISK0101', '1')->count();
            $vk_ISK0102 = $vk->where('ISK0102', '1')->count();
            $vk_ISK0103 = $vk->where('ISK0103', '1')->count();
            $vk_ISK0104 = $vk->where('ISK0104', '1')->count();
            $vk_ISK0201 = $vk->where('ISK0201', '1')->count();
            $vk_ISK0202 = $vk->where('ISK0202', '1')->count();
            $vk_ISK0203 = $vk->where('ISK0203', '1')->count();
            $vk_ISK0204 = $vk->where('ISK0204', '1')->count();
            $vk_jumlah = $vk_ISK0101 + $vk_ISK0102 + $vk_ISK0103 + $vk_ISK0104 + $vk_ISK0201 + $vk_ISK0202 + $vk_ISK0203 + $vk_ISK0204;

            $no_vk_ISK0101 = $vk->where('ISK0101', '0')->count();
            $no_vk_ISK0102 = $vk->where('ISK0102', '0')->count();
            $no_vk_ISK0103 = $vk->where('ISK0103', '0')->count();
            $no_vk_ISK0104 = $vk->where('ISK0104', '0')->count();
            $no_vk_ISK0201 = $vk->where('ISK0201', '0')->count();
            $no_vk_ISK0202 = $vk->where('ISK0202', '0')->count();
            $no_vk_ISK0203 = $vk->where('ISK0203', '0')->count();
            $no_vk_ISK0204 = $vk->where('ISK0204', '0')->count();
            $no_vk_jumlah = $no_vk_ISK0101 + $no_vk_ISK0102 + $no_vk_ISK0103 + $no_vk_ISK0104 + $no_vk_ISK0201 + $no_vk_ISK0202 + $no_vk_ISK0203 + $no_vk_ISK0204;

            $denominator_vk = $vk_jumlah + $no_vk_jumlah;

            $tanggal = Carbon::parse($request->input('dari'))->isoFormat('DD MMMM YYYY') . ' - ' . Carbon::parse($request->input('sampai'))->isoFormat('DD MMMM YYYY');

            return Excel::download(new ExportBundleISK(
                $igd_ISK0101,
                $igd_ISK0102,
                $igd_ISK0103,
                $igd_ISK0104,
                $igd_ISK0201,
                $igd_ISK0202,
                $igd_ISK0203,
                $igd_ISK0204,
                $igd_jumlah,

                $no_igd_ISK0101,
                $no_igd_ISK0102,
                $no_igd_ISK0103,
                $no_igd_ISK0104,
                $no_igd_ISK0201,
                $no_igd_ISK0202,
                $no_igd_ISK0203,
                $no_igd_ISK0204,
                $no_igd_jumlah,

                $denominator_igd,

                $int_ISK0101,
                $int_ISK0102,
                $int_ISK0103,
                $int_ISK0104,
                $int_ISK0201,
                $int_ISK0202,
                $int_ISK0203,
                $int_ISK0204,
                $int_jumlah,

                $no_int_ISK0101,
                $no_int_ISK0102,
                $no_int_ISK0103,
                $no_int_ISK0104,
                $no_int_ISK0201,
                $no_int_ISK0202,
                $no_int_ISK0203,
                $no_int_ISK0204,
                $no_int_jumlah,

                $denominator_int,

                $ok_ISK0101,
                $ok_ISK0102,
                $ok_ISK0103,
                $ok_ISK0104,
                $ok_ISK0201,
                $ok_ISK0202,
                $ok_ISK0203,
                $ok_ISK0204,
                $ok_jumlah,

                $no_ok_ISK0101,
                $no_ok_ISK0102,
                $no_ok_ISK0103,
                $no_ok_ISK0104,
                $no_ok_ISK0201,
                $no_ok_ISK0202,
                $no_ok_ISK0203,
                $no_ok_ISK0204,
                $no_ok_jumlah,

                $denominator_ok,

                $lt2_ISK0101,
                $lt2_ISK0102,
                $lt2_ISK0103,
                $lt2_ISK0104,
                $lt2_ISK0201,
                $lt2_ISK0202,
                $lt2_ISK0203,
                $lt2_ISK0204,
                $lt2_jumlah,

                $no_lt2_ISK0101,
                $no_lt2_ISK0102,
                $no_lt2_ISK0103,
                $no_lt2_ISK0104,
                $no_lt2_ISK0201,
                $no_lt2_ISK0202,
                $no_lt2_ISK0203,
                $no_lt2_ISK0204,
                $no_lt2_jumlah,

                $denominator_lt2,

                $lt4_ISK0101,
                $lt4_ISK0102,
                $lt4_ISK0103,
                $lt4_ISK0104,
                $lt4_ISK0201,
                $lt4_ISK0202,
                $lt4_ISK0203,
                $lt4_ISK0204,
                $lt4_jumlah,

                $no_lt4_ISK0101,
                $no_lt4_ISK0102,
                $no_lt4_ISK0103,
                $no_lt4_ISK0104,
                $no_lt4_ISK0201,
                $no_lt4_ISK0202,
                $no_lt4_ISK0203,
                $no_lt4_ISK0204,
                $no_lt4_jumlah,

                $denominator_lt4,

                $lt5_ISK0101,
                $lt5_ISK0102,
                $lt5_ISK0103,
                $lt5_ISK0104,
                $lt5_ISK0201,
                $lt5_ISK0202,
                $lt5_ISK0203,
                $lt5_ISK0204,
                $lt5_jumlah,

                $no_lt5_ISK0101,
                $no_lt5_ISK0102,
                $no_lt5_ISK0103,
                $no_lt5_ISK0104,
                $no_lt5_ISK0201,
                $no_lt5_ISK0202,
                $no_lt5_ISK0203,
                $no_lt5_ISK0204,
                $no_lt5_jumlah,

                $denominator_lt5,

                $vk_ISK0101,
                $vk_ISK0102,
                $vk_ISK0103,
                $vk_ISK0104,
                $vk_ISK0201,
                $vk_ISK0202,
                $vk_ISK0203,
                $vk_ISK0204,
                $vk_jumlah,

                $no_vk_ISK0101,
                $no_vk_ISK0102,
                $no_vk_ISK0103,
                $no_vk_ISK0104,
                $no_vk_ISK0201,
                $no_vk_ISK0202,
                $no_vk_ISK0203,
                $no_vk_ISK0204,
                $no_vk_jumlah,

                $denominator_vk,

                $tabel,
                $rekap,
                $tanggal
            ), 'Rekap Bundle ISK ' . $tanggal . '.pdf', \Maatwebsite\Excel\Excel::MPDF);
        } else {
            return Redirect::back()->withErrors(['msg' => 'Tanggal tidak boleh Lebih kecil dari sebelumnya']);
        }
    }
}
