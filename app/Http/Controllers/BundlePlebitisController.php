<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\BundlePlebitis;
use App\Models\RekapBundlePlebitis;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportBundlePlebitis;
use Illuminate\Support\Facades\Redirect;

class BundlePlebitisController extends Controller
{
    public function index()
    {
        return view('bundlePlebitis.index');
    }

    public function getData()
    {
        $bundlePlebitis = BundlePlebitis::latest('id')->paginate(10);

        return view('bundlePlebitis.index')->with('bundlePlebitis', $bundlePlebitis);
    }

    public function save(Request $request)
    {
        $data = new BundlePlebitis();
        $data->mrn = $request->input('mrn');
        $data->nama_pasien = $request->input('nama_pasien');
        $data->diagnosa = $request->input('diagnosa');
        $data->unit = $request->input('unit');
        $data->tgl = $request->input('tgl');
        $data->PLB0301 = $request->input('PLB0301');
        $data->PLB0302 = $request->input('PLB0302');
        $data->PLB0303 = $request->input('PLB0303');
        $data->PLB0304 = $request->input('PLB0304');
        $data->PLB0201 = $request->input('PLB0201');
        $data->PLB0202 = $request->input('PLB0202');
        $data->PLB0203 = $request->input('PLB0203');
        $data->PLB0204 = $request->input('PLB0204');
        $data->save();

        return redirect('/bundlePlebitis')->with('success', 'Data berhasil disimpan!');
    }

    public function update(Request $request, $id)
    {
        $bundlePlebitis = BundlePlebitis::find($id);
        $input = $request->all();
        $bundlePlebitis->fill($input)->save();

        return redirect('/bundlePlebitis');
    }

    public function destroy($id)
    {
        $bundlePlebitis = BundlePlebitis::find($id);
        $bundlePlebitis->delete();

        return redirect('/bundlePlebitis');
    }

    public function inputRekap(Request $request)
    {
        $tgl_skg = date('Y-m-d');

        $data = new RekapBundlePlebitis();
        $data->dari = $request->input('dari') ?? $tgl_skg;
        $data->sampai = $request->input('sampai') ?? $tgl_skg;
        $data->analisa = $request->input('analisa');
        $data->tindak_lanjut = $request->input('tindak_lanjut');
        $data->save();

        return redirect('/rekapBundlePlebitis')->with('success', 'Data berhasil disimpan!');
    }

    public function updateRekap(Request $request, $id)
    {
        $rekap = RekapBundlePlebitis::find($id);
        $input = $request->all();
        $rekap->fill($input)->save();

        return redirect('/rekapBundlePlebitis');
    }

    public function rekap(Request $request)
    {
        $tgl_skg = date('Y-m-d');
        $dari = date_create($request->input('dari'));
        $sampai = date_create($request->input('sampai'));
        $diff  = date_diff($dari, $sampai);
        $range_tgl = $diff->d + 1;

        if ($request->input('dari') <= $request->input('sampai')) {
            $tabel = BundlePlebitis::whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')->paginate(1000);
            // dd($tabel);

            $rekap = RekapBundlePlebitis::whereDate('dari', '=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('sampai', '=', $request->input('sampai') ?? $tgl_skg)
                ->get();

            $analisa = RekapBundlePlebitis::select('analisa')
                ->whereDate('dari', '=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('sampai', '=', $request->input('sampai') ?? $tgl_skg)
                ->get();

            $tindak_lanjut = RekapBundlePlebitis::select('tindak_lanjut')
                ->whereDate('dari', '=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('sampai', '=', $request->input('sampai') ?? $tgl_skg)
                ->get();

            $igd = BundlePlebitis::where('unit', 'IGD')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $int = BundlePlebitis::where('unit', 'Intensif')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $ok = BundlePlebitis::where('unit', 'OK')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt2 = BundlePlebitis::whereIn('unit', ['Perawatan Eksekutif lt.2', 'Perawatan Padma'])
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt4 = BundlePlebitis::where('unit', 'Perawatan Reguler lt.4')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt5 = BundlePlebitis::where('unit', 'Perawatan Reguler lt.5')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $vk = BundlePlebitis::where('unit', 'VK')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();

            $igd_PLB0301 = $igd->where('PLB0301', '1')->count();
            $igd_PLB0302 = $igd->where('PLB0302', '1')->count();
            $igd_PLB0303 = $igd->where('PLB0303', '1')->count();
            $igd_PLB0304 = $igd->where('PLB0304', '1')->count();
            $igd_PLB0201 = $igd->where('PLB0201', '1')->count();
            $igd_PLB0202 = $igd->where('PLB0202', '1')->count();
            $igd_PLB0203 = $igd->where('PLB0203', '1')->count();
            $igd_PLB0204 = $igd->where('PLB0204', '1')->count();
            $igd_jumlah = $igd_PLB0301 + $igd_PLB0302 + $igd_PLB0303 + $igd_PLB0304 + $igd_PLB0201 + $igd_PLB0202 + $igd_PLB0203 + $igd_PLB0204;

            $no_igd_PLB0301 = $igd->where('PLB0301', '0')->count();
            $no_igd_PLB0302 = $igd->where('PLB0302', '0')->count();
            $no_igd_PLB0303 = $igd->where('PLB0303', '0')->count();
            $no_igd_PLB0304 = $igd->where('PLB0304', '0')->count();
            $no_igd_PLB0201 = $igd->where('PLB0201', '0')->count();
            $no_igd_PLB0202 = $igd->where('PLB0202', '0')->count();
            $no_igd_PLB0203 = $igd->where('PLB0203', '0')->count();
            $no_igd_PLB0204 = $igd->where('PLB0204', '0')->count();
            $no_igd_jumlah = $no_igd_PLB0301 + $no_igd_PLB0302 + $no_igd_PLB0303 + $no_igd_PLB0304 + $no_igd_PLB0201 + $no_igd_PLB0202 + $no_igd_PLB0203 + $no_igd_PLB0204;

            $denominator_igd = $igd_jumlah + $no_igd_jumlah;

            $int_PLB0301 = $int->where('PLB0301', '1')->count();
            $int_PLB0302 = $int->where('PLB0302', '1')->count();
            $int_PLB0303 = $int->where('PLB0303', '1')->count();
            $int_PLB0304 = $int->where('PLB0304', '1')->count();
            $int_PLB0201 = $int->where('PLB0201', '1')->count();
            $int_PLB0202 = $int->where('PLB0202', '1')->count();
            $int_PLB0203 = $int->where('PLB0203', '1')->count();
            $int_PLB0204 = $int->where('PLB0204', '1')->count();
            $int_jumlah = $int_PLB0301 + $int_PLB0302 + $int_PLB0303 + $int_PLB0304 + $int_PLB0201 + $int_PLB0202 + $int_PLB0203 + $int_PLB0204;

            $no_int_PLB0301 = $int->where('PLB0301', '0')->count();
            $no_int_PLB0302 = $int->where('PLB0302', '0')->count();
            $no_int_PLB0303 = $int->where('PLB0303', '0')->count();
            $no_int_PLB0304 = $int->where('PLB0304', '0')->count();
            $no_int_PLB0201 = $int->where('PLB0201', '0')->count();
            $no_int_PLB0202 = $int->where('PLB0202', '0')->count();
            $no_int_PLB0203 = $int->where('PLB0203', '0')->count();
            $no_int_PLB0204 = $int->where('PLB0204', '0')->count();
            $no_int_jumlah = $no_int_PLB0301 + $no_int_PLB0302 + $no_int_PLB0303 + $no_int_PLB0304 + $no_int_PLB0201 + $no_int_PLB0202 + $no_int_PLB0203 + $no_int_PLB0204;

            $denominator_int = $int_jumlah + $no_int_jumlah;

            $ok_PLB0301 = $ok->where('PLB0301', '1')->count();
            $ok_PLB0302 = $ok->where('PLB0302', '1')->count();
            $ok_PLB0303 = $ok->where('PLB0303', '1')->count();
            $ok_PLB0304 = $ok->where('PLB0304', '1')->count();
            $ok_PLB0201 = $ok->where('PLB0201', '1')->count();
            $ok_PLB0202 = $ok->where('PLB0202', '1')->count();
            $ok_PLB0203 = $ok->where('PLB0203', '1')->count();
            $ok_PLB0204 = $ok->where('PLB0204', '1')->count();
            $ok_jumlah = $ok_PLB0301 + $ok_PLB0302 + $ok_PLB0303 + $ok_PLB0304 + $ok_PLB0201 + $ok_PLB0202 + $ok_PLB0203 + $ok_PLB0204;

            $no_ok_PLB0301 = $ok->where('PLB0301', '0')->count();
            $no_ok_PLB0302 = $ok->where('PLB0302', '0')->count();
            $no_ok_PLB0303 = $ok->where('PLB0303', '0')->count();
            $no_ok_PLB0304 = $ok->where('PLB0304', '0')->count();
            $no_ok_PLB0201 = $ok->where('PLB0201', '0')->count();
            $no_ok_PLB0202 = $ok->where('PLB0202', '0')->count();
            $no_ok_PLB0203 = $ok->where('PLB0203', '0')->count();
            $no_ok_PLB0204 = $ok->where('PLB0204', '0')->count();
            $no_ok_jumlah = $no_ok_PLB0301 + $no_ok_PLB0302 + $no_ok_PLB0303 + $no_ok_PLB0304 + $no_ok_PLB0201 + $no_ok_PLB0202 + $no_ok_PLB0203 + $no_ok_PLB0204;

            $denominator_ok = $ok_jumlah + $no_ok_jumlah;

            $lt2_PLB0301 = $lt2->where('PLB0301', '1')->count();
            $lt2_PLB0302 = $lt2->where('PLB0302', '1')->count();
            $lt2_PLB0303 = $lt2->where('PLB0303', '1')->count();
            $lt2_PLB0304 = $lt2->where('PLB0304', '1')->count();
            $lt2_PLB0201 = $lt2->where('PLB0201', '1')->count();
            $lt2_PLB0202 = $lt2->where('PLB0202', '1')->count();
            $lt2_PLB0203 = $lt2->where('PLB0203', '1')->count();
            $lt2_PLB0204 = $lt2->where('PLB0204', '1')->count();
            $lt2_jumlah = $lt2_PLB0301 + $lt2_PLB0302 + $lt2_PLB0303 + $lt2_PLB0304 + $lt2_PLB0201 + $lt2_PLB0202 + $lt2_PLB0203 + $lt2_PLB0204;

            $no_lt2_PLB0301 = $lt2->where('PLB0301', '0')->count();
            $no_lt2_PLB0302 = $lt2->where('PLB0302', '0')->count();
            $no_lt2_PLB0303 = $lt2->where('PLB0303', '0')->count();
            $no_lt2_PLB0304 = $lt2->where('PLB0304', '0')->count();
            $no_lt2_PLB0201 = $lt2->where('PLB0201', '0')->count();
            $no_lt2_PLB0202 = $lt2->where('PLB0202', '0')->count();
            $no_lt2_PLB0203 = $lt2->where('PLB0203', '0')->count();
            $no_lt2_PLB0204 = $lt2->where('PLB0204', '0')->count();
            $no_lt2_jumlah = $no_lt2_PLB0301 + $no_lt2_PLB0302 + $no_lt2_PLB0303 + $no_lt2_PLB0304 + $no_lt2_PLB0201 + $no_lt2_PLB0202 + $no_lt2_PLB0203 + $no_lt2_PLB0204;

            $denominator_lt2 = $lt2_jumlah + $no_lt2_jumlah;

            $lt4_PLB0301 = $lt4->where('PLB0301', '1')->count();
            $lt4_PLB0302 = $lt4->where('PLB0302', '1')->count();
            $lt4_PLB0303 = $lt4->where('PLB0303', '1')->count();
            $lt4_PLB0304 = $lt4->where('PLB0304', '1')->count();
            $lt4_PLB0201 = $lt4->where('PLB0201', '1')->count();
            $lt4_PLB0202 = $lt4->where('PLB0202', '1')->count();
            $lt4_PLB0203 = $lt4->where('PLB0203', '1')->count();
            $lt4_PLB0204 = $lt4->where('PLB0204', '1')->count();
            $lt4_jumlah = $lt4_PLB0301 + $lt4_PLB0302 + $lt4_PLB0303 + $lt4_PLB0304 + $lt4_PLB0201 + $lt4_PLB0202 + $lt4_PLB0203 + $lt4_PLB0204;

            $no_lt4_PLB0301 = $lt4->where('PLB0301', '0')->count();
            $no_lt4_PLB0302 = $lt4->where('PLB0302', '0')->count();
            $no_lt4_PLB0303 = $lt4->where('PLB0303', '0')->count();
            $no_lt4_PLB0304 = $lt4->where('PLB0304', '0')->count();
            $no_lt4_PLB0201 = $lt4->where('PLB0201', '0')->count();
            $no_lt4_PLB0202 = $lt4->where('PLB0202', '0')->count();
            $no_lt4_PLB0203 = $lt4->where('PLB0203', '0')->count();
            $no_lt4_PLB0204 = $lt4->where('PLB0204', '0')->count();
            $no_lt4_jumlah = $no_lt4_PLB0301 + $no_lt4_PLB0302 + $no_lt4_PLB0303 + $no_lt4_PLB0304 + $no_lt4_PLB0201 + $no_lt4_PLB0202 + $no_lt4_PLB0203 + $no_lt4_PLB0204;

            $denominator_lt4 = $lt4_jumlah + $no_lt4_jumlah;

            $lt5_PLB0301 = $lt5->where('PLB0301', '1')->count();
            $lt5_PLB0302 = $lt5->where('PLB0302', '1')->count();
            $lt5_PLB0303 = $lt5->where('PLB0303', '1')->count();
            $lt5_PLB0304 = $lt5->where('PLB0304', '1')->count();
            $lt5_PLB0201 = $lt5->where('PLB0201', '1')->count();
            $lt5_PLB0202 = $lt5->where('PLB0202', '1')->count();
            $lt5_PLB0203 = $lt5->where('PLB0203', '1')->count();
            $lt5_PLB0204 = $lt5->where('PLB0204', '1')->count();
            $lt5_jumlah = $lt5_PLB0301 + $lt5_PLB0302 + $lt5_PLB0303 + $lt5_PLB0304 + $lt5_PLB0201 + $lt5_PLB0202 + $lt5_PLB0203 + $lt5_PLB0204;

            $no_lt5_PLB0301 = $lt5->where('PLB0301', '0')->count();
            $no_lt5_PLB0302 = $lt5->where('PLB0302', '0')->count();
            $no_lt5_PLB0303 = $lt5->where('PLB0303', '0')->count();
            $no_lt5_PLB0304 = $lt5->where('PLB0304', '0')->count();
            $no_lt5_PLB0201 = $lt5->where('PLB0201', '0')->count();
            $no_lt5_PLB0202 = $lt5->where('PLB0202', '0')->count();
            $no_lt5_PLB0203 = $lt5->where('PLB0203', '0')->count();
            $no_lt5_PLB0204 = $lt5->where('PLB0204', '0')->count();
            $no_lt5_jumlah = $no_lt5_PLB0301 + $no_lt5_PLB0302 + $no_lt5_PLB0303 + $no_lt5_PLB0304 + $no_lt5_PLB0201 + $no_lt5_PLB0202 + $no_lt5_PLB0203 + $no_lt5_PLB0204;

            $denominator_lt5 = $lt5_jumlah + $no_lt5_jumlah;

            $vk_PLB0301 = $vk->where('PLB0301', '1')->count();
            $vk_PLB0302 = $vk->where('PLB0302', '1')->count();
            $vk_PLB0303 = $vk->where('PLB0303', '1')->count();
            $vk_PLB0304 = $vk->where('PLB0304', '1')->count();
            $vk_PLB0201 = $vk->where('PLB0201', '1')->count();
            $vk_PLB0202 = $vk->where('PLB0202', '1')->count();
            $vk_PLB0203 = $vk->where('PLB0203', '1')->count();
            $vk_PLB0204 = $vk->where('PLB0204', '1')->count();
            $vk_jumlah = $vk_PLB0301 + $vk_PLB0302 + $vk_PLB0303 + $vk_PLB0304 + $vk_PLB0201 + $vk_PLB0202 + $vk_PLB0203 + $vk_PLB0204;

            $no_vk_PLB0301 = $vk->where('PLB0301', '0')->count();
            $no_vk_PLB0302 = $vk->where('PLB0302', '0')->count();
            $no_vk_PLB0303 = $vk->where('PLB0303', '0')->count();
            $no_vk_PLB0304 = $vk->where('PLB0304', '0')->count();
            $no_vk_PLB0201 = $vk->where('PLB0201', '0')->count();
            $no_vk_PLB0202 = $vk->where('PLB0202', '0')->count();
            $no_vk_PLB0203 = $vk->where('PLB0203', '0')->count();
            $no_vk_PLB0204 = $vk->where('PLB0204', '0')->count();
            $no_vk_jumlah = $no_vk_PLB0301 + $no_vk_PLB0302 + $no_vk_PLB0303 + $no_vk_PLB0304 + $no_vk_PLB0201 + $no_vk_PLB0202 + $no_vk_PLB0203 + $no_vk_PLB0204;

            $denominator_vk = $vk_jumlah + $no_vk_jumlah;

            return view('rekapBundlePlebitis.index', compact(
                'range_tgl',
                'tabel',
                'rekap',
                'analisa',
                'tindak_lanjut',

                'igd_PLB0301',
                'igd_PLB0302',
                'igd_PLB0303',
                'igd_PLB0304',
                'igd_PLB0201',
                'igd_PLB0202',
                'igd_PLB0203',
                'igd_PLB0204',
                'igd_jumlah',

                'no_igd_PLB0301',
                'no_igd_PLB0302',
                'no_igd_PLB0303',
                'no_igd_PLB0304',
                'no_igd_PLB0201',
                'no_igd_PLB0202',
                'no_igd_PLB0203',
                'no_igd_PLB0204',
                'no_igd_jumlah',

                'denominator_igd',

                'int_PLB0301',
                'int_PLB0302',
                'int_PLB0303',
                'int_PLB0304',
                'int_PLB0201',
                'int_PLB0202',
                'int_PLB0203',
                'int_PLB0204',
                'int_jumlah',

                'no_int_PLB0301',
                'no_int_PLB0302',
                'no_int_PLB0303',
                'no_int_PLB0304',
                'no_int_PLB0201',
                'no_int_PLB0202',
                'no_int_PLB0203',
                'no_int_PLB0204',
                'no_int_jumlah',

                'denominator_int',

                'ok_PLB0301',
                'ok_PLB0302',
                'ok_PLB0303',
                'ok_PLB0304',
                'ok_PLB0201',
                'ok_PLB0202',
                'ok_PLB0203',
                'ok_PLB0204',
                'ok_jumlah',

                'no_ok_PLB0301',
                'no_ok_PLB0302',
                'no_ok_PLB0303',
                'no_ok_PLB0304',
                'no_ok_PLB0201',
                'no_ok_PLB0202',
                'no_ok_PLB0203',
                'no_ok_PLB0204',
                'no_ok_jumlah',

                'denominator_ok',

                'lt2_PLB0301',
                'lt2_PLB0302',
                'lt2_PLB0303',
                'lt2_PLB0304',
                'lt2_PLB0201',
                'lt2_PLB0202',
                'lt2_PLB0203',
                'lt2_PLB0204',
                'lt2_jumlah',

                'no_lt2_PLB0301',
                'no_lt2_PLB0302',
                'no_lt2_PLB0303',
                'no_lt2_PLB0304',
                'no_lt2_PLB0201',
                'no_lt2_PLB0202',
                'no_lt2_PLB0203',
                'no_lt2_PLB0204',
                'no_lt2_jumlah',

                'denominator_lt2',

                'lt4_PLB0301',
                'lt4_PLB0302',
                'lt4_PLB0303',
                'lt4_PLB0304',
                'lt4_PLB0201',
                'lt4_PLB0202',
                'lt4_PLB0203',
                'lt4_PLB0204',
                'lt4_jumlah',

                'no_lt4_PLB0301',
                'no_lt4_PLB0302',
                'no_lt4_PLB0303',
                'no_lt4_PLB0304',
                'no_lt4_PLB0201',
                'no_lt4_PLB0202',
                'no_lt4_PLB0203',
                'no_lt4_PLB0204',
                'no_lt4_jumlah',

                'denominator_lt4',

                'lt5_PLB0301',
                'lt5_PLB0302',
                'lt5_PLB0303',
                'lt5_PLB0304',
                'lt5_PLB0201',
                'lt5_PLB0202',
                'lt5_PLB0203',
                'lt5_PLB0204',
                'lt5_jumlah',

                'no_lt5_PLB0301',
                'no_lt5_PLB0302',
                'no_lt5_PLB0303',
                'no_lt5_PLB0304',
                'no_lt5_PLB0201',
                'no_lt5_PLB0202',
                'no_lt5_PLB0203',
                'no_lt5_PLB0204',
                'no_lt5_jumlah',

                'denominator_lt5',

                'vk_PLB0301',
                'vk_PLB0302',
                'vk_PLB0303',
                'vk_PLB0304',
                'vk_PLB0201',
                'vk_PLB0202',
                'vk_PLB0203',
                'vk_PLB0204',
                'vk_jumlah',

                'no_vk_PLB0301',
                'no_vk_PLB0302',
                'no_vk_PLB0303',
                'no_vk_PLB0304',
                'no_vk_PLB0201',
                'no_vk_PLB0202',
                'no_vk_PLB0203',
                'no_vk_PLB0204',
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
            $tabel = BundlePlebitis::whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')->paginate(1000);
            // dd($tabel);

            $rekap = RekapBundlePlebitis::whereDate('dari', '=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('sampai', '=', $request->input('sampai') ?? $tgl_skg)
                ->get();

            $analisa = RekapBundlePlebitis::select('analisa')
                ->whereDate('dari', '=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('sampai', '=', $request->input('sampai') ?? $tgl_skg)
                ->get();

            $tindak_lanjut = RekapBundlePlebitis::select('tindak_lanjut')
                ->whereDate('dari', '=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('sampai', '=', $request->input('sampai') ?? $tgl_skg)
                ->get();

            $igd = BundlePlebitis::where('unit', 'IGD')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $int = BundlePlebitis::where('unit', 'Intensif')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $ok = BundlePlebitis::where('unit', 'OK')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt2 = BundlePlebitis::whereIn('unit', ['Perawatan Eksekutif lt.2', 'Perawatan Padma'])
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt4 = BundlePlebitis::where('unit', 'Perawatan Reguler lt.4')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt5 = BundlePlebitis::where('unit', 'Perawatan Reguler lt.5')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $vk = BundlePlebitis::where('unit', 'VK')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();

            $igd_PLB0301 = $igd->where('PLB0301', '1')->count();
            $igd_PLB0302 = $igd->where('PLB0302', '1')->count();
            $igd_PLB0303 = $igd->where('PLB0303', '1')->count();
            $igd_PLB0304 = $igd->where('PLB0304', '1')->count();
            $igd_PLB0201 = $igd->where('PLB0201', '1')->count();
            $igd_PLB0202 = $igd->where('PLB0202', '1')->count();
            $igd_PLB0203 = $igd->where('PLB0203', '1')->count();
            $igd_PLB0204 = $igd->where('PLB0204', '1')->count();
            $igd_jumlah = $igd_PLB0301 + $igd_PLB0302 + $igd_PLB0303 + $igd_PLB0304 + $igd_PLB0201 + $igd_PLB0202 + $igd_PLB0203 + $igd_PLB0204;

            $no_igd_PLB0301 = $igd->where('PLB0301', '0')->count();
            $no_igd_PLB0302 = $igd->where('PLB0302', '0')->count();
            $no_igd_PLB0303 = $igd->where('PLB0303', '0')->count();
            $no_igd_PLB0304 = $igd->where('PLB0304', '0')->count();
            $no_igd_PLB0201 = $igd->where('PLB0201', '0')->count();
            $no_igd_PLB0202 = $igd->where('PLB0202', '0')->count();
            $no_igd_PLB0203 = $igd->where('PLB0203', '0')->count();
            $no_igd_PLB0204 = $igd->where('PLB0204', '0')->count();
            $no_igd_jumlah = $no_igd_PLB0301 + $no_igd_PLB0302 + $no_igd_PLB0303 + $no_igd_PLB0304 + $no_igd_PLB0201 + $no_igd_PLB0202 + $no_igd_PLB0203 + $no_igd_PLB0204;

            $denominator_igd = $igd_jumlah + $no_igd_jumlah;

            $int_PLB0301 = $int->where('PLB0301', '1')->count();
            $int_PLB0302 = $int->where('PLB0302', '1')->count();
            $int_PLB0303 = $int->where('PLB0303', '1')->count();
            $int_PLB0304 = $int->where('PLB0304', '1')->count();
            $int_PLB0201 = $int->where('PLB0201', '1')->count();
            $int_PLB0202 = $int->where('PLB0202', '1')->count();
            $int_PLB0203 = $int->where('PLB0203', '1')->count();
            $int_PLB0204 = $int->where('PLB0204', '1')->count();
            $int_jumlah = $int_PLB0301 + $int_PLB0302 + $int_PLB0303 + $int_PLB0304 + $int_PLB0201 + $int_PLB0202 + $int_PLB0203 + $int_PLB0204;

            $no_int_PLB0301 = $int->where('PLB0301', '0')->count();
            $no_int_PLB0302 = $int->where('PLB0302', '0')->count();
            $no_int_PLB0303 = $int->where('PLB0303', '0')->count();
            $no_int_PLB0304 = $int->where('PLB0304', '0')->count();
            $no_int_PLB0201 = $int->where('PLB0201', '0')->count();
            $no_int_PLB0202 = $int->where('PLB0202', '0')->count();
            $no_int_PLB0203 = $int->where('PLB0203', '0')->count();
            $no_int_PLB0204 = $int->where('PLB0204', '0')->count();
            $no_int_jumlah = $no_int_PLB0301 + $no_int_PLB0302 + $no_int_PLB0303 + $no_int_PLB0304 + $no_int_PLB0201 + $no_int_PLB0202 + $no_int_PLB0203 + $no_int_PLB0204;

            $denominator_int = $int_jumlah + $no_int_jumlah;

            $ok_PLB0301 = $ok->where('PLB0301', '1')->count();
            $ok_PLB0302 = $ok->where('PLB0302', '1')->count();
            $ok_PLB0303 = $ok->where('PLB0303', '1')->count();
            $ok_PLB0304 = $ok->where('PLB0304', '1')->count();
            $ok_PLB0201 = $ok->where('PLB0201', '1')->count();
            $ok_PLB0202 = $ok->where('PLB0202', '1')->count();
            $ok_PLB0203 = $ok->where('PLB0203', '1')->count();
            $ok_PLB0204 = $ok->where('PLB0204', '1')->count();
            $ok_jumlah = $ok_PLB0301 + $ok_PLB0302 + $ok_PLB0303 + $ok_PLB0304 + $ok_PLB0201 + $ok_PLB0202 + $ok_PLB0203 + $ok_PLB0204;

            $no_ok_PLB0301 = $ok->where('PLB0301', '0')->count();
            $no_ok_PLB0302 = $ok->where('PLB0302', '0')->count();
            $no_ok_PLB0303 = $ok->where('PLB0303', '0')->count();
            $no_ok_PLB0304 = $ok->where('PLB0304', '0')->count();
            $no_ok_PLB0201 = $ok->where('PLB0201', '0')->count();
            $no_ok_PLB0202 = $ok->where('PLB0202', '0')->count();
            $no_ok_PLB0203 = $ok->where('PLB0203', '0')->count();
            $no_ok_PLB0204 = $ok->where('PLB0204', '0')->count();
            $no_ok_jumlah = $no_ok_PLB0301 + $no_ok_PLB0302 + $no_ok_PLB0303 + $no_ok_PLB0304 + $no_ok_PLB0201 + $no_ok_PLB0202 + $no_ok_PLB0203 + $no_ok_PLB0204;

            $denominator_ok = $ok_jumlah + $no_ok_jumlah;

            $lt2_PLB0301 = $lt2->where('PLB0301', '1')->count();
            $lt2_PLB0302 = $lt2->where('PLB0302', '1')->count();
            $lt2_PLB0303 = $lt2->where('PLB0303', '1')->count();
            $lt2_PLB0304 = $lt2->where('PLB0304', '1')->count();
            $lt2_PLB0201 = $lt2->where('PLB0201', '1')->count();
            $lt2_PLB0202 = $lt2->where('PLB0202', '1')->count();
            $lt2_PLB0203 = $lt2->where('PLB0203', '1')->count();
            $lt2_PLB0204 = $lt2->where('PLB0204', '1')->count();
            $lt2_jumlah = $lt2_PLB0301 + $lt2_PLB0302 + $lt2_PLB0303 + $lt2_PLB0304 + $lt2_PLB0201 + $lt2_PLB0202 + $lt2_PLB0203 + $lt2_PLB0204;

            $no_lt2_PLB0301 = $lt2->where('PLB0301', '0')->count();
            $no_lt2_PLB0302 = $lt2->where('PLB0302', '0')->count();
            $no_lt2_PLB0303 = $lt2->where('PLB0303', '0')->count();
            $no_lt2_PLB0304 = $lt2->where('PLB0304', '0')->count();
            $no_lt2_PLB0201 = $lt2->where('PLB0201', '0')->count();
            $no_lt2_PLB0202 = $lt2->where('PLB0202', '0')->count();
            $no_lt2_PLB0203 = $lt2->where('PLB0203', '0')->count();
            $no_lt2_PLB0204 = $lt2->where('PLB0204', '0')->count();
            $no_lt2_jumlah = $no_lt2_PLB0301 + $no_lt2_PLB0302 + $no_lt2_PLB0303 + $no_lt2_PLB0304 + $no_lt2_PLB0201 + $no_lt2_PLB0202 + $no_lt2_PLB0203 + $no_lt2_PLB0204;

            $denominator_lt2 = $lt2_jumlah + $no_lt2_jumlah;

            $lt4_PLB0301 = $lt4->where('PLB0301', '1')->count();
            $lt4_PLB0302 = $lt4->where('PLB0302', '1')->count();
            $lt4_PLB0303 = $lt4->where('PLB0303', '1')->count();
            $lt4_PLB0304 = $lt4->where('PLB0304', '1')->count();
            $lt4_PLB0201 = $lt4->where('PLB0201', '1')->count();
            $lt4_PLB0202 = $lt4->where('PLB0202', '1')->count();
            $lt4_PLB0203 = $lt4->where('PLB0203', '1')->count();
            $lt4_PLB0204 = $lt4->where('PLB0204', '1')->count();
            $lt4_jumlah = $lt4_PLB0301 + $lt4_PLB0302 + $lt4_PLB0303 + $lt4_PLB0304 + $lt4_PLB0201 + $lt4_PLB0202 + $lt4_PLB0203 + $lt4_PLB0204;

            $no_lt4_PLB0301 = $lt4->where('PLB0301', '0')->count();
            $no_lt4_PLB0302 = $lt4->where('PLB0302', '0')->count();
            $no_lt4_PLB0303 = $lt4->where('PLB0303', '0')->count();
            $no_lt4_PLB0304 = $lt4->where('PLB0304', '0')->count();
            $no_lt4_PLB0201 = $lt4->where('PLB0201', '0')->count();
            $no_lt4_PLB0202 = $lt4->where('PLB0202', '0')->count();
            $no_lt4_PLB0203 = $lt4->where('PLB0203', '0')->count();
            $no_lt4_PLB0204 = $lt4->where('PLB0204', '0')->count();
            $no_lt4_jumlah = $no_lt4_PLB0301 + $no_lt4_PLB0302 + $no_lt4_PLB0303 + $no_lt4_PLB0304 + $no_lt4_PLB0201 + $no_lt4_PLB0202 + $no_lt4_PLB0203 + $no_lt4_PLB0204;

            $denominator_lt4 = $lt4_jumlah + $no_lt4_jumlah;

            $lt5_PLB0301 = $lt5->where('PLB0301', '1')->count();
            $lt5_PLB0302 = $lt5->where('PLB0302', '1')->count();
            $lt5_PLB0303 = $lt5->where('PLB0303', '1')->count();
            $lt5_PLB0304 = $lt5->where('PLB0304', '1')->count();
            $lt5_PLB0201 = $lt5->where('PLB0201', '1')->count();
            $lt5_PLB0202 = $lt5->where('PLB0202', '1')->count();
            $lt5_PLB0203 = $lt5->where('PLB0203', '1')->count();
            $lt5_PLB0204 = $lt5->where('PLB0204', '1')->count();
            $lt5_jumlah = $lt5_PLB0301 + $lt5_PLB0302 + $lt5_PLB0303 + $lt5_PLB0304 + $lt5_PLB0201 + $lt5_PLB0202 + $lt5_PLB0203 + $lt5_PLB0204;

            $no_lt5_PLB0301 = $lt5->where('PLB0301', '0')->count();
            $no_lt5_PLB0302 = $lt5->where('PLB0302', '0')->count();
            $no_lt5_PLB0303 = $lt5->where('PLB0303', '0')->count();
            $no_lt5_PLB0304 = $lt5->where('PLB0304', '0')->count();
            $no_lt5_PLB0201 = $lt5->where('PLB0201', '0')->count();
            $no_lt5_PLB0202 = $lt5->where('PLB0202', '0')->count();
            $no_lt5_PLB0203 = $lt5->where('PLB0203', '0')->count();
            $no_lt5_PLB0204 = $lt5->where('PLB0204', '0')->count();
            $no_lt5_jumlah = $no_lt5_PLB0301 + $no_lt5_PLB0302 + $no_lt5_PLB0303 + $no_lt5_PLB0304 + $no_lt5_PLB0201 + $no_lt5_PLB0202 + $no_lt5_PLB0203 + $no_lt5_PLB0204;

            $denominator_lt5 = $lt5_jumlah + $no_lt5_jumlah;

            $vk_PLB0301 = $vk->where('PLB0301', '1')->count();
            $vk_PLB0302 = $vk->where('PLB0302', '1')->count();
            $vk_PLB0303 = $vk->where('PLB0303', '1')->count();
            $vk_PLB0304 = $vk->where('PLB0304', '1')->count();
            $vk_PLB0201 = $vk->where('PLB0201', '1')->count();
            $vk_PLB0202 = $vk->where('PLB0202', '1')->count();
            $vk_PLB0203 = $vk->where('PLB0203', '1')->count();
            $vk_PLB0204 = $vk->where('PLB0204', '1')->count();
            $vk_jumlah = $vk_PLB0301 + $vk_PLB0302 + $vk_PLB0303 + $vk_PLB0304 + $vk_PLB0201 + $vk_PLB0202 + $vk_PLB0203 + $vk_PLB0204;

            $no_vk_PLB0301 = $vk->where('PLB0301', '0')->count();
            $no_vk_PLB0302 = $vk->where('PLB0302', '0')->count();
            $no_vk_PLB0303 = $vk->where('PLB0303', '0')->count();
            $no_vk_PLB0304 = $vk->where('PLB0304', '0')->count();
            $no_vk_PLB0201 = $vk->where('PLB0201', '0')->count();
            $no_vk_PLB0202 = $vk->where('PLB0202', '0')->count();
            $no_vk_PLB0203 = $vk->where('PLB0203', '0')->count();
            $no_vk_PLB0204 = $vk->where('PLB0204', '0')->count();
            $no_vk_jumlah = $no_vk_PLB0301 + $no_vk_PLB0302 + $no_vk_PLB0303 + $no_vk_PLB0304 + $no_vk_PLB0201 + $no_vk_PLB0202 + $no_vk_PLB0203 + $no_vk_PLB0204;

            $denominator_vk = $vk_jumlah + $no_vk_jumlah;

            $tanggal = Carbon::parse($request->input('dari'))->isoFormat('DD MMMM YYYY') . ' - ' . Carbon::parse($request->input('sampai'))->isoFormat('DD MMMM YYYY');

            return Excel::download(new ExportBundlePlebitis(
                $igd_PLB0301,
                $igd_PLB0302,
                $igd_PLB0303,
                $igd_PLB0304,
                $igd_PLB0201,
                $igd_PLB0202,
                $igd_PLB0203,
                $igd_PLB0204,
                $igd_jumlah,

                $no_igd_PLB0301,
                $no_igd_PLB0302,
                $no_igd_PLB0303,
                $no_igd_PLB0304,
                $no_igd_PLB0201,
                $no_igd_PLB0202,
                $no_igd_PLB0203,
                $no_igd_PLB0204,
                $no_igd_jumlah,

                $denominator_igd,

                $int_PLB0301,
                $int_PLB0302,
                $int_PLB0303,
                $int_PLB0304,
                $int_PLB0201,
                $int_PLB0202,
                $int_PLB0203,
                $int_PLB0204,
                $int_jumlah,

                $no_int_PLB0301,
                $no_int_PLB0302,
                $no_int_PLB0303,
                $no_int_PLB0304,
                $no_int_PLB0201,
                $no_int_PLB0202,
                $no_int_PLB0203,
                $no_int_PLB0204,
                $no_int_jumlah,

                $denominator_int,

                $ok_PLB0301,
                $ok_PLB0302,
                $ok_PLB0303,
                $ok_PLB0304,
                $ok_PLB0201,
                $ok_PLB0202,
                $ok_PLB0203,
                $ok_PLB0204,
                $ok_jumlah,

                $no_ok_PLB0301,
                $no_ok_PLB0302,
                $no_ok_PLB0303,
                $no_ok_PLB0304,
                $no_ok_PLB0201,
                $no_ok_PLB0202,
                $no_ok_PLB0203,
                $no_ok_PLB0204,
                $no_ok_jumlah,

                $denominator_ok,

                $lt2_PLB0301,
                $lt2_PLB0302,
                $lt2_PLB0303,
                $lt2_PLB0304,
                $lt2_PLB0201,
                $lt2_PLB0202,
                $lt2_PLB0203,
                $lt2_PLB0204,
                $lt2_jumlah,

                $no_lt2_PLB0301,
                $no_lt2_PLB0302,
                $no_lt2_PLB0303,
                $no_lt2_PLB0304,
                $no_lt2_PLB0201,
                $no_lt2_PLB0202,
                $no_lt2_PLB0203,
                $no_lt2_PLB0204,
                $no_lt2_jumlah,

                $denominator_lt2,

                $lt4_PLB0301,
                $lt4_PLB0302,
                $lt4_PLB0303,
                $lt4_PLB0304,
                $lt4_PLB0201,
                $lt4_PLB0202,
                $lt4_PLB0203,
                $lt4_PLB0204,
                $lt4_jumlah,

                $no_lt4_PLB0301,
                $no_lt4_PLB0302,
                $no_lt4_PLB0303,
                $no_lt4_PLB0304,
                $no_lt4_PLB0201,
                $no_lt4_PLB0202,
                $no_lt4_PLB0203,
                $no_lt4_PLB0204,
                $no_lt4_jumlah,

                $denominator_lt4,

                $lt5_PLB0301,
                $lt5_PLB0302,
                $lt5_PLB0303,
                $lt5_PLB0304,
                $lt5_PLB0201,
                $lt5_PLB0202,
                $lt5_PLB0203,
                $lt5_PLB0204,
                $lt5_jumlah,

                $no_lt5_PLB0301,
                $no_lt5_PLB0302,
                $no_lt5_PLB0303,
                $no_lt5_PLB0304,
                $no_lt5_PLB0201,
                $no_lt5_PLB0202,
                $no_lt5_PLB0203,
                $no_lt5_PLB0204,
                $no_lt5_jumlah,

                $denominator_lt5,

                $vk_PLB0301,
                $vk_PLB0302,
                $vk_PLB0303,
                $vk_PLB0304,
                $vk_PLB0201,
                $vk_PLB0202,
                $vk_PLB0203,
                $vk_PLB0204,
                $vk_jumlah,

                $no_vk_PLB0301,
                $no_vk_PLB0302,
                $no_vk_PLB0303,
                $no_vk_PLB0304,
                $no_vk_PLB0201,
                $no_vk_PLB0202,
                $no_vk_PLB0203,
                $no_vk_PLB0204,
                $no_vk_jumlah,

                $denominator_vk,

                $tabel,
                $rekap,
                $tanggal
            ), 'Rekap Bundle Plebitis ' . $tanggal . '.xlsx');
        } else {
            return Redirect::back()->withErrors(['msg' => 'Tanggal tidak boleh Lebih kecil dari sebelumnya']);
        }
    }

    public function pdf(Request $request)
    {
        $tgl_skg = date('Y-m-d');

        if ($request->input('dari') <= $request->input('sampai')) {
            $tabel = BundlePlebitis::whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')->paginate(1000);
            // dd($tabel);

            $rekap = RekapBundlePlebitis::whereDate('dari', '=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('sampai', '=', $request->input('sampai') ?? $tgl_skg)
                ->get();

            $analisa = RekapBundlePlebitis::select('analisa')
                ->whereDate('dari', '=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('sampai', '=', $request->input('sampai') ?? $tgl_skg)
                ->get();

            $tindak_lanjut = RekapBundlePlebitis::select('tindak_lanjut')
                ->whereDate('dari', '=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('sampai', '=', $request->input('sampai') ?? $tgl_skg)
                ->get();

            $igd = BundlePlebitis::where('unit', 'IGD')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $int = BundlePlebitis::where('unit', 'Intensif')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $ok = BundlePlebitis::where('unit', 'OK')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt2 = BundlePlebitis::whereIn('unit', ['Perawatan Eksekutif lt.2', 'Perawatan Padma'])
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt4 = BundlePlebitis::where('unit', 'Perawatan Reguler lt.4')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt5 = BundlePlebitis::where('unit', 'Perawatan Reguler lt.5')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $vk = BundlePlebitis::where('unit', 'VK')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();

            $igd_PLB0301 = $igd->where('PLB0301', '1')->count();
            $igd_PLB0302 = $igd->where('PLB0302', '1')->count();
            $igd_PLB0303 = $igd->where('PLB0303', '1')->count();
            $igd_PLB0304 = $igd->where('PLB0304', '1')->count();
            $igd_PLB0201 = $igd->where('PLB0201', '1')->count();
            $igd_PLB0202 = $igd->where('PLB0202', '1')->count();
            $igd_PLB0203 = $igd->where('PLB0203', '1')->count();
            $igd_PLB0204 = $igd->where('PLB0204', '1')->count();
            $igd_jumlah = $igd_PLB0301 + $igd_PLB0302 + $igd_PLB0303 + $igd_PLB0304 + $igd_PLB0201 + $igd_PLB0202 + $igd_PLB0203 + $igd_PLB0204;

            $no_igd_PLB0301 = $igd->where('PLB0301', '0')->count();
            $no_igd_PLB0302 = $igd->where('PLB0302', '0')->count();
            $no_igd_PLB0303 = $igd->where('PLB0303', '0')->count();
            $no_igd_PLB0304 = $igd->where('PLB0304', '0')->count();
            $no_igd_PLB0201 = $igd->where('PLB0201', '0')->count();
            $no_igd_PLB0202 = $igd->where('PLB0202', '0')->count();
            $no_igd_PLB0203 = $igd->where('PLB0203', '0')->count();
            $no_igd_PLB0204 = $igd->where('PLB0204', '0')->count();
            $no_igd_jumlah = $no_igd_PLB0301 + $no_igd_PLB0302 + $no_igd_PLB0303 + $no_igd_PLB0304 + $no_igd_PLB0201 + $no_igd_PLB0202 + $no_igd_PLB0203 + $no_igd_PLB0204;

            $denominator_igd = $igd_jumlah + $no_igd_jumlah;

            $int_PLB0301 = $int->where('PLB0301', '1')->count();
            $int_PLB0302 = $int->where('PLB0302', '1')->count();
            $int_PLB0303 = $int->where('PLB0303', '1')->count();
            $int_PLB0304 = $int->where('PLB0304', '1')->count();
            $int_PLB0201 = $int->where('PLB0201', '1')->count();
            $int_PLB0202 = $int->where('PLB0202', '1')->count();
            $int_PLB0203 = $int->where('PLB0203', '1')->count();
            $int_PLB0204 = $int->where('PLB0204', '1')->count();
            $int_jumlah = $int_PLB0301 + $int_PLB0302 + $int_PLB0303 + $int_PLB0304 + $int_PLB0201 + $int_PLB0202 + $int_PLB0203 + $int_PLB0204;

            $no_int_PLB0301 = $int->where('PLB0301', '0')->count();
            $no_int_PLB0302 = $int->where('PLB0302', '0')->count();
            $no_int_PLB0303 = $int->where('PLB0303', '0')->count();
            $no_int_PLB0304 = $int->where('PLB0304', '0')->count();
            $no_int_PLB0201 = $int->where('PLB0201', '0')->count();
            $no_int_PLB0202 = $int->where('PLB0202', '0')->count();
            $no_int_PLB0203 = $int->where('PLB0203', '0')->count();
            $no_int_PLB0204 = $int->where('PLB0204', '0')->count();
            $no_int_jumlah = $no_int_PLB0301 + $no_int_PLB0302 + $no_int_PLB0303 + $no_int_PLB0304 + $no_int_PLB0201 + $no_int_PLB0202 + $no_int_PLB0203 + $no_int_PLB0204;

            $denominator_int = $int_jumlah + $no_int_jumlah;

            $ok_PLB0301 = $ok->where('PLB0301', '1')->count();
            $ok_PLB0302 = $ok->where('PLB0302', '1')->count();
            $ok_PLB0303 = $ok->where('PLB0303', '1')->count();
            $ok_PLB0304 = $ok->where('PLB0304', '1')->count();
            $ok_PLB0201 = $ok->where('PLB0201', '1')->count();
            $ok_PLB0202 = $ok->where('PLB0202', '1')->count();
            $ok_PLB0203 = $ok->where('PLB0203', '1')->count();
            $ok_PLB0204 = $ok->where('PLB0204', '1')->count();
            $ok_jumlah = $ok_PLB0301 + $ok_PLB0302 + $ok_PLB0303 + $ok_PLB0304 + $ok_PLB0201 + $ok_PLB0202 + $ok_PLB0203 + $ok_PLB0204;

            $no_ok_PLB0301 = $ok->where('PLB0301', '0')->count();
            $no_ok_PLB0302 = $ok->where('PLB0302', '0')->count();
            $no_ok_PLB0303 = $ok->where('PLB0303', '0')->count();
            $no_ok_PLB0304 = $ok->where('PLB0304', '0')->count();
            $no_ok_PLB0201 = $ok->where('PLB0201', '0')->count();
            $no_ok_PLB0202 = $ok->where('PLB0202', '0')->count();
            $no_ok_PLB0203 = $ok->where('PLB0203', '0')->count();
            $no_ok_PLB0204 = $ok->where('PLB0204', '0')->count();
            $no_ok_jumlah = $no_ok_PLB0301 + $no_ok_PLB0302 + $no_ok_PLB0303 + $no_ok_PLB0304 + $no_ok_PLB0201 + $no_ok_PLB0202 + $no_ok_PLB0203 + $no_ok_PLB0204;

            $denominator_ok = $ok_jumlah + $no_ok_jumlah;

            $lt2_PLB0301 = $lt2->where('PLB0301', '1')->count();
            $lt2_PLB0302 = $lt2->where('PLB0302', '1')->count();
            $lt2_PLB0303 = $lt2->where('PLB0303', '1')->count();
            $lt2_PLB0304 = $lt2->where('PLB0304', '1')->count();
            $lt2_PLB0201 = $lt2->where('PLB0201', '1')->count();
            $lt2_PLB0202 = $lt2->where('PLB0202', '1')->count();
            $lt2_PLB0203 = $lt2->where('PLB0203', '1')->count();
            $lt2_PLB0204 = $lt2->where('PLB0204', '1')->count();
            $lt2_jumlah = $lt2_PLB0301 + $lt2_PLB0302 + $lt2_PLB0303 + $lt2_PLB0304 + $lt2_PLB0201 + $lt2_PLB0202 + $lt2_PLB0203 + $lt2_PLB0204;

            $no_lt2_PLB0301 = $lt2->where('PLB0301', '0')->count();
            $no_lt2_PLB0302 = $lt2->where('PLB0302', '0')->count();
            $no_lt2_PLB0303 = $lt2->where('PLB0303', '0')->count();
            $no_lt2_PLB0304 = $lt2->where('PLB0304', '0')->count();
            $no_lt2_PLB0201 = $lt2->where('PLB0201', '0')->count();
            $no_lt2_PLB0202 = $lt2->where('PLB0202', '0')->count();
            $no_lt2_PLB0203 = $lt2->where('PLB0203', '0')->count();
            $no_lt2_PLB0204 = $lt2->where('PLB0204', '0')->count();
            $no_lt2_jumlah = $no_lt2_PLB0301 + $no_lt2_PLB0302 + $no_lt2_PLB0303 + $no_lt2_PLB0304 + $no_lt2_PLB0201 + $no_lt2_PLB0202 + $no_lt2_PLB0203 + $no_lt2_PLB0204;

            $denominator_lt2 = $lt2_jumlah + $no_lt2_jumlah;

            $lt4_PLB0301 = $lt4->where('PLB0301', '1')->count();
            $lt4_PLB0302 = $lt4->where('PLB0302', '1')->count();
            $lt4_PLB0303 = $lt4->where('PLB0303', '1')->count();
            $lt4_PLB0304 = $lt4->where('PLB0304', '1')->count();
            $lt4_PLB0201 = $lt4->where('PLB0201', '1')->count();
            $lt4_PLB0202 = $lt4->where('PLB0202', '1')->count();
            $lt4_PLB0203 = $lt4->where('PLB0203', '1')->count();
            $lt4_PLB0204 = $lt4->where('PLB0204', '1')->count();
            $lt4_jumlah = $lt4_PLB0301 + $lt4_PLB0302 + $lt4_PLB0303 + $lt4_PLB0304 + $lt4_PLB0201 + $lt4_PLB0202 + $lt4_PLB0203 + $lt4_PLB0204;

            $no_lt4_PLB0301 = $lt4->where('PLB0301', '0')->count();
            $no_lt4_PLB0302 = $lt4->where('PLB0302', '0')->count();
            $no_lt4_PLB0303 = $lt4->where('PLB0303', '0')->count();
            $no_lt4_PLB0304 = $lt4->where('PLB0304', '0')->count();
            $no_lt4_PLB0201 = $lt4->where('PLB0201', '0')->count();
            $no_lt4_PLB0202 = $lt4->where('PLB0202', '0')->count();
            $no_lt4_PLB0203 = $lt4->where('PLB0203', '0')->count();
            $no_lt4_PLB0204 = $lt4->where('PLB0204', '0')->count();
            $no_lt4_jumlah = $no_lt4_PLB0301 + $no_lt4_PLB0302 + $no_lt4_PLB0303 + $no_lt4_PLB0304 + $no_lt4_PLB0201 + $no_lt4_PLB0202 + $no_lt4_PLB0203 + $no_lt4_PLB0204;

            $denominator_lt4 = $lt4_jumlah + $no_lt4_jumlah;

            $lt5_PLB0301 = $lt5->where('PLB0301', '1')->count();
            $lt5_PLB0302 = $lt5->where('PLB0302', '1')->count();
            $lt5_PLB0303 = $lt5->where('PLB0303', '1')->count();
            $lt5_PLB0304 = $lt5->where('PLB0304', '1')->count();
            $lt5_PLB0201 = $lt5->where('PLB0201', '1')->count();
            $lt5_PLB0202 = $lt5->where('PLB0202', '1')->count();
            $lt5_PLB0203 = $lt5->where('PLB0203', '1')->count();
            $lt5_PLB0204 = $lt5->where('PLB0204', '1')->count();
            $lt5_jumlah = $lt5_PLB0301 + $lt5_PLB0302 + $lt5_PLB0303 + $lt5_PLB0304 + $lt5_PLB0201 + $lt5_PLB0202 + $lt5_PLB0203 + $lt5_PLB0204;

            $no_lt5_PLB0301 = $lt5->where('PLB0301', '0')->count();
            $no_lt5_PLB0302 = $lt5->where('PLB0302', '0')->count();
            $no_lt5_PLB0303 = $lt5->where('PLB0303', '0')->count();
            $no_lt5_PLB0304 = $lt5->where('PLB0304', '0')->count();
            $no_lt5_PLB0201 = $lt5->where('PLB0201', '0')->count();
            $no_lt5_PLB0202 = $lt5->where('PLB0202', '0')->count();
            $no_lt5_PLB0203 = $lt5->where('PLB0203', '0')->count();
            $no_lt5_PLB0204 = $lt5->where('PLB0204', '0')->count();
            $no_lt5_jumlah = $no_lt5_PLB0301 + $no_lt5_PLB0302 + $no_lt5_PLB0303 + $no_lt5_PLB0304 + $no_lt5_PLB0201 + $no_lt5_PLB0202 + $no_lt5_PLB0203 + $no_lt5_PLB0204;

            $denominator_lt5 = $lt5_jumlah + $no_lt5_jumlah;

            $vk_PLB0301 = $vk->where('PLB0301', '1')->count();
            $vk_PLB0302 = $vk->where('PLB0302', '1')->count();
            $vk_PLB0303 = $vk->where('PLB0303', '1')->count();
            $vk_PLB0304 = $vk->where('PLB0304', '1')->count();
            $vk_PLB0201 = $vk->where('PLB0201', '1')->count();
            $vk_PLB0202 = $vk->where('PLB0202', '1')->count();
            $vk_PLB0203 = $vk->where('PLB0203', '1')->count();
            $vk_PLB0204 = $vk->where('PLB0204', '1')->count();
            $vk_jumlah = $vk_PLB0301 + $vk_PLB0302 + $vk_PLB0303 + $vk_PLB0304 + $vk_PLB0201 + $vk_PLB0202 + $vk_PLB0203 + $vk_PLB0204;

            $no_vk_PLB0301 = $vk->where('PLB0301', '0')->count();
            $no_vk_PLB0302 = $vk->where('PLB0302', '0')->count();
            $no_vk_PLB0303 = $vk->where('PLB0303', '0')->count();
            $no_vk_PLB0304 = $vk->where('PLB0304', '0')->count();
            $no_vk_PLB0201 = $vk->where('PLB0201', '0')->count();
            $no_vk_PLB0202 = $vk->where('PLB0202', '0')->count();
            $no_vk_PLB0203 = $vk->where('PLB0203', '0')->count();
            $no_vk_PLB0204 = $vk->where('PLB0204', '0')->count();
            $no_vk_jumlah = $no_vk_PLB0301 + $no_vk_PLB0302 + $no_vk_PLB0303 + $no_vk_PLB0304 + $no_vk_PLB0201 + $no_vk_PLB0202 + $no_vk_PLB0203 + $no_vk_PLB0204;

            $denominator_vk = $vk_jumlah + $no_vk_jumlah;

            $tanggal = Carbon::parse($request->input('dari'))->isoFormat('DD MMMM YYYY') . ' - ' . Carbon::parse($request->input('sampai'))->isoFormat('DD MMMM YYYY');

            return Excel::download(new ExportBundlePlebitis(
                $igd_PLB0301,
                $igd_PLB0302,
                $igd_PLB0303,
                $igd_PLB0304,
                $igd_PLB0201,
                $igd_PLB0202,
                $igd_PLB0203,
                $igd_PLB0204,
                $igd_jumlah,

                $no_igd_PLB0301,
                $no_igd_PLB0302,
                $no_igd_PLB0303,
                $no_igd_PLB0304,
                $no_igd_PLB0201,
                $no_igd_PLB0202,
                $no_igd_PLB0203,
                $no_igd_PLB0204,
                $no_igd_jumlah,

                $denominator_igd,

                $int_PLB0301,
                $int_PLB0302,
                $int_PLB0303,
                $int_PLB0304,
                $int_PLB0201,
                $int_PLB0202,
                $int_PLB0203,
                $int_PLB0204,
                $int_jumlah,

                $no_int_PLB0301,
                $no_int_PLB0302,
                $no_int_PLB0303,
                $no_int_PLB0304,
                $no_int_PLB0201,
                $no_int_PLB0202,
                $no_int_PLB0203,
                $no_int_PLB0204,
                $no_int_jumlah,

                $denominator_int,

                $ok_PLB0301,
                $ok_PLB0302,
                $ok_PLB0303,
                $ok_PLB0304,
                $ok_PLB0201,
                $ok_PLB0202,
                $ok_PLB0203,
                $ok_PLB0204,
                $ok_jumlah,

                $no_ok_PLB0301,
                $no_ok_PLB0302,
                $no_ok_PLB0303,
                $no_ok_PLB0304,
                $no_ok_PLB0201,
                $no_ok_PLB0202,
                $no_ok_PLB0203,
                $no_ok_PLB0204,
                $no_ok_jumlah,

                $denominator_ok,

                $lt2_PLB0301,
                $lt2_PLB0302,
                $lt2_PLB0303,
                $lt2_PLB0304,
                $lt2_PLB0201,
                $lt2_PLB0202,
                $lt2_PLB0203,
                $lt2_PLB0204,
                $lt2_jumlah,

                $no_lt2_PLB0301,
                $no_lt2_PLB0302,
                $no_lt2_PLB0303,
                $no_lt2_PLB0304,
                $no_lt2_PLB0201,
                $no_lt2_PLB0202,
                $no_lt2_PLB0203,
                $no_lt2_PLB0204,
                $no_lt2_jumlah,

                $denominator_lt2,

                $lt4_PLB0301,
                $lt4_PLB0302,
                $lt4_PLB0303,
                $lt4_PLB0304,
                $lt4_PLB0201,
                $lt4_PLB0202,
                $lt4_PLB0203,
                $lt4_PLB0204,
                $lt4_jumlah,

                $no_lt4_PLB0301,
                $no_lt4_PLB0302,
                $no_lt4_PLB0303,
                $no_lt4_PLB0304,
                $no_lt4_PLB0201,
                $no_lt4_PLB0202,
                $no_lt4_PLB0203,
                $no_lt4_PLB0204,
                $no_lt4_jumlah,

                $denominator_lt4,

                $lt5_PLB0301,
                $lt5_PLB0302,
                $lt5_PLB0303,
                $lt5_PLB0304,
                $lt5_PLB0201,
                $lt5_PLB0202,
                $lt5_PLB0203,
                $lt5_PLB0204,
                $lt5_jumlah,

                $no_lt5_PLB0301,
                $no_lt5_PLB0302,
                $no_lt5_PLB0303,
                $no_lt5_PLB0304,
                $no_lt5_PLB0201,
                $no_lt5_PLB0202,
                $no_lt5_PLB0203,
                $no_lt5_PLB0204,
                $no_lt5_jumlah,

                $denominator_lt5,

                $vk_PLB0301,
                $vk_PLB0302,
                $vk_PLB0303,
                $vk_PLB0304,
                $vk_PLB0201,
                $vk_PLB0202,
                $vk_PLB0203,
                $vk_PLB0204,
                $vk_jumlah,

                $no_vk_PLB0301,
                $no_vk_PLB0302,
                $no_vk_PLB0303,
                $no_vk_PLB0304,
                $no_vk_PLB0201,
                $no_vk_PLB0202,
                $no_vk_PLB0203,
                $no_vk_PLB0204,
                $no_vk_jumlah,

                $denominator_vk,

                $tabel,
                $rekap,
                $tanggal
            ), 'Rekap Bundle Plebitis ' . $tanggal . '.pdf', \Maatwebsite\Excel\Excel::MPDF);
        } else {
            return Redirect::back()->withErrors(['msg' => 'Tanggal tidak boleh Lebih kecil dari sebelumnya']);
        }
    }
}
