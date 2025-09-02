<?php

namespace App\Http\Controllers;

use App\Exports\ExportBundleIAD;
use Carbon\Carbon;
use App\Models\BundleIAD;
use Illuminate\Http\Request;
use App\Models\RekapBundleIad;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Redirect;

class BundleIADController extends Controller
{
    public function index()
    {
        return view('bundleIAD.index');
    }

    public function getData()
    {
        $bundleIAD = BundleIAD::latest('id')->paginate(10);

        return view('bundleIAD.index')->with('bundleIAD', $bundleIAD);
    }

    public function save(Request $request)
    {
        $data = new BundleIAD();
        $data->mrn = $request->input('mrn');
        $data->nama_pasien = $request->input('nama_pasien');
        $data->diagnosa = $request->input('diagnosa');
        $data->unit = $request->input('unit');
        $data->tgl = $request->input('tgl');
        $data->IAD0301 = $request->input('IAD0301');
        $data->IAD0302 = $request->input('IAD0302');
        $data->IAD0303 = $request->input('IAD0303');
        $data->IAD0304 = $request->input('IAD0304');
        $data->IAD0201 = $request->input('IAD0201');
        $data->IAD0202 = $request->input('IAD0202');
        $data->IAD0203 = $request->input('IAD0203');
        $data->IAD0204 = $request->input('IAD0204');
        $data->save();

        return redirect('/bundle')->with('success', 'Data berhasil disimpan!');
    }

    public function update(Request $request, $id)
    {
        $bundleIAD = BundleIAD::find($id);
        $input = $request->all();
        $bundleIAD->fill($input)->save();

        return redirect('/bundle');
    }

    public function destroy($id)
    {
        $bundleIAD = BundleIAD::find($id);
        $bundleIAD->delete();

        return redirect('/bundle');
    }

    public function inputRekap(Request $request)
    {
        $tgl_skg = date('Y-m-d');

        $data = new RekapBundleIad();
        $data->dari = $request->input('dari') ?? $tgl_skg;
        $data->sampai = $request->input('sampai') ?? $tgl_skg;
        $data->analisa = $request->input('analisa');
        $data->tindak_lanjut = $request->input('tindak_lanjut');
        $data->save();

        return redirect('/rekapBundle')->with('success', 'Data berhasil disimpan!');
    }

    public function updateRekap(Request $request, $id)
    {
        $rekap = RekapBundleIad::find($id);
        $input = $request->all();
        $rekap->fill($input)->save();

        return redirect('/rekapBundle');
    }

    public function rekap(Request $request)
    {
        $tgl_skg = date('Y-m-d');
        $dari = date_create($request->input('dari'));
        $sampai = date_create($request->input('sampai'));
        $diff  = date_diff($dari, $sampai);
        $range_tgl = $diff->d + 1;

        if ($request->input('dari') <= $request->input('sampai')) {
            $tabel = BundleIAD::whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')->paginate(1000);
            // dd($tabel);

            $rekap = RekapBundleIad::whereDate('dari', '=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('sampai', '=', $request->input('sampai') ?? $tgl_skg)
                ->get();

            $analisa = RekapBundleIad::select('analisa')
                ->whereDate('dari', '=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('sampai', '=', $request->input('sampai') ?? $tgl_skg)
                ->get();

            $tindak_lanjut = RekapBundleIad::select('tindak_lanjut')
                ->whereDate('dari', '=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('sampai', '=', $request->input('sampai') ?? $tgl_skg)
                ->get();

            $igd = BundleIAD::where('unit', 'IGD')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $int = BundleIAD::where('unit', 'Intensif')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $ok = BundleIAD::where('unit', 'OK')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt2 = BundleIAD::whereIn('unit', ['Perawatan Eksekutif lt.2', 'Perawatan Padma'])
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt4 = BundleIAD::where('unit', 'Perawatan Reguler lt.4')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt5 = BundleIAD::where('unit', 'Perawatan Reguler lt.5')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $vk = BundleIAD::where('unit', 'VK')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();

            $igd_IAD0301 = $igd->where('IAD0301', '1')->count();
            $igd_IAD0302 = $igd->where('IAD0302', '1')->count();
            $igd_IAD0303 = $igd->where('IAD0303', '1')->count();
            $igd_IAD0304 = $igd->where('IAD0304', '1')->count();
            $igd_IAD0201 = $igd->where('IAD0201', '1')->count();
            $igd_IAD0202 = $igd->where('IAD0202', '1')->count();
            $igd_IAD0203 = $igd->where('IAD0203', '1')->count();
            $igd_IAD0204 = $igd->where('IAD0204', '1')->count();
            $igd_jumlah = $igd_IAD0301 + $igd_IAD0302 + $igd_IAD0303 + $igd_IAD0304 + $igd_IAD0201 + $igd_IAD0202 + $igd_IAD0203 + $igd_IAD0204;

            $no_igd_IAD0301 = $igd->where('IAD0301', '0')->count();
            $no_igd_IAD0302 = $igd->where('IAD0302', '0')->count();
            $no_igd_IAD0303 = $igd->where('IAD0303', '0')->count();
            $no_igd_IAD0304 = $igd->where('IAD0304', '0')->count();
            $no_igd_IAD0201 = $igd->where('IAD0201', '0')->count();
            $no_igd_IAD0202 = $igd->where('IAD0202', '0')->count();
            $no_igd_IAD0203 = $igd->where('IAD0203', '0')->count();
            $no_igd_IAD0204 = $igd->where('IAD0204', '0')->count();
            $no_igd_jumlah = $no_igd_IAD0301 + $no_igd_IAD0302 + $no_igd_IAD0303 + $no_igd_IAD0304 + $no_igd_IAD0201 + $no_igd_IAD0202 + $no_igd_IAD0203 + $no_igd_IAD0204;

            $denominator_igd = $igd_jumlah + $no_igd_jumlah;

            $int_IAD0301 = $int->where('IAD0301', '1')->count();
            $int_IAD0302 = $int->where('IAD0302', '1')->count();
            $int_IAD0303 = $int->where('IAD0303', '1')->count();
            $int_IAD0304 = $int->where('IAD0304', '1')->count();
            $int_IAD0201 = $int->where('IAD0201', '1')->count();
            $int_IAD0202 = $int->where('IAD0202', '1')->count();
            $int_IAD0203 = $int->where('IAD0203', '1')->count();
            $int_IAD0204 = $int->where('IAD0204', '1')->count();
            $int_jumlah = $int_IAD0301 + $int_IAD0302 + $int_IAD0303 + $int_IAD0304 + $int_IAD0201 + $int_IAD0202 + $int_IAD0203 + $int_IAD0204;

            $no_int_IAD0301 = $int->where('IAD0301', '0')->count();
            $no_int_IAD0302 = $int->where('IAD0302', '0')->count();
            $no_int_IAD0303 = $int->where('IAD0303', '0')->count();
            $no_int_IAD0304 = $int->where('IAD0304', '0')->count();
            $no_int_IAD0201 = $int->where('IAD0201', '0')->count();
            $no_int_IAD0202 = $int->where('IAD0202', '0')->count();
            $no_int_IAD0203 = $int->where('IAD0203', '0')->count();
            $no_int_IAD0204 = $int->where('IAD0204', '0')->count();
            $no_int_jumlah = $no_int_IAD0301 + $no_int_IAD0302 + $no_int_IAD0303 + $no_int_IAD0304 + $no_int_IAD0201 + $no_int_IAD0202 + $no_int_IAD0203 + $no_int_IAD0204;

            $denominator_int = $int_jumlah + $no_int_jumlah;

            $ok_IAD0301 = $ok->where('IAD0301', '1')->count();
            $ok_IAD0302 = $ok->where('IAD0302', '1')->count();
            $ok_IAD0303 = $ok->where('IAD0303', '1')->count();
            $ok_IAD0304 = $ok->where('IAD0304', '1')->count();
            $ok_IAD0201 = $ok->where('IAD0201', '1')->count();
            $ok_IAD0202 = $ok->where('IAD0202', '1')->count();
            $ok_IAD0203 = $ok->where('IAD0203', '1')->count();
            $ok_IAD0204 = $ok->where('IAD0204', '1')->count();
            $ok_jumlah = $ok_IAD0301 + $ok_IAD0302 + $ok_IAD0303 + $ok_IAD0304 + $ok_IAD0201 + $ok_IAD0202 + $ok_IAD0203 + $ok_IAD0204;

            $no_ok_IAD0301 = $ok->where('IAD0301', '0')->count();
            $no_ok_IAD0302 = $ok->where('IAD0302', '0')->count();
            $no_ok_IAD0303 = $ok->where('IAD0303', '0')->count();
            $no_ok_IAD0304 = $ok->where('IAD0304', '0')->count();
            $no_ok_IAD0201 = $ok->where('IAD0201', '0')->count();
            $no_ok_IAD0202 = $ok->where('IAD0202', '0')->count();
            $no_ok_IAD0203 = $ok->where('IAD0203', '0')->count();
            $no_ok_IAD0204 = $ok->where('IAD0204', '0')->count();
            $no_ok_jumlah = $no_ok_IAD0301 + $no_ok_IAD0302 + $no_ok_IAD0303 + $no_ok_IAD0304 + $no_ok_IAD0201 + $no_ok_IAD0202 + $no_ok_IAD0203 + $no_ok_IAD0204;

            $denominator_ok = $ok_jumlah + $no_ok_jumlah;

            $lt2_IAD0301 = $lt2->where('IAD0301', '1')->count();
            $lt2_IAD0302 = $lt2->where('IAD0302', '1')->count();
            $lt2_IAD0303 = $lt2->where('IAD0303', '1')->count();
            $lt2_IAD0304 = $lt2->where('IAD0304', '1')->count();
            $lt2_IAD0201 = $lt2->where('IAD0201', '1')->count();
            $lt2_IAD0202 = $lt2->where('IAD0202', '1')->count();
            $lt2_IAD0203 = $lt2->where('IAD0203', '1')->count();
            $lt2_IAD0204 = $lt2->where('IAD0204', '1')->count();
            $lt2_jumlah = $lt2_IAD0301 + $lt2_IAD0302 + $lt2_IAD0303 + $lt2_IAD0304 + $lt2_IAD0201 + $lt2_IAD0202 + $lt2_IAD0203 + $lt2_IAD0204;

            $no_lt2_IAD0301 = $lt2->where('IAD0301', '0')->count();
            $no_lt2_IAD0302 = $lt2->where('IAD0302', '0')->count();
            $no_lt2_IAD0303 = $lt2->where('IAD0303', '0')->count();
            $no_lt2_IAD0304 = $lt2->where('IAD0304', '0')->count();
            $no_lt2_IAD0201 = $lt2->where('IAD0201', '0')->count();
            $no_lt2_IAD0202 = $lt2->where('IAD0202', '0')->count();
            $no_lt2_IAD0203 = $lt2->where('IAD0203', '0')->count();
            $no_lt2_IAD0204 = $lt2->where('IAD0204', '0')->count();
            $no_lt2_jumlah = $no_lt2_IAD0301 + $no_lt2_IAD0302 + $no_lt2_IAD0303 + $no_lt2_IAD0304 + $no_lt2_IAD0201 + $no_lt2_IAD0202 + $no_lt2_IAD0203 + $no_lt2_IAD0204;

            $denominator_lt2 = $lt2_jumlah + $no_lt2_jumlah;

            $lt4_IAD0301 = $lt4->where('IAD0301', '1')->count();
            $lt4_IAD0302 = $lt4->where('IAD0302', '1')->count();
            $lt4_IAD0303 = $lt4->where('IAD0303', '1')->count();
            $lt4_IAD0304 = $lt4->where('IAD0304', '1')->count();
            $lt4_IAD0201 = $lt4->where('IAD0201', '1')->count();
            $lt4_IAD0202 = $lt4->where('IAD0202', '1')->count();
            $lt4_IAD0203 = $lt4->where('IAD0203', '1')->count();
            $lt4_IAD0204 = $lt4->where('IAD0204', '1')->count();
            $lt4_jumlah = $lt4_IAD0301 + $lt4_IAD0302 + $lt4_IAD0303 + $lt4_IAD0304 + $lt4_IAD0201 + $lt4_IAD0202 + $lt4_IAD0203 + $lt4_IAD0204;

            $no_lt4_IAD0301 = $lt4->where('IAD0301', '0')->count();
            $no_lt4_IAD0302 = $lt4->where('IAD0302', '0')->count();
            $no_lt4_IAD0303 = $lt4->where('IAD0303', '0')->count();
            $no_lt4_IAD0304 = $lt4->where('IAD0304', '0')->count();
            $no_lt4_IAD0201 = $lt4->where('IAD0201', '0')->count();
            $no_lt4_IAD0202 = $lt4->where('IAD0202', '0')->count();
            $no_lt4_IAD0203 = $lt4->where('IAD0203', '0')->count();
            $no_lt4_IAD0204 = $lt4->where('IAD0204', '0')->count();
            $no_lt4_jumlah = $no_lt4_IAD0301 + $no_lt4_IAD0302 + $no_lt4_IAD0303 + $no_lt4_IAD0304 + $no_lt4_IAD0201 + $no_lt4_IAD0202 + $no_lt4_IAD0203 + $no_lt4_IAD0204;

            $denominator_lt4 = $lt4_jumlah + $no_lt4_jumlah;

            $lt5_IAD0301 = $lt5->where('IAD0301', '1')->count();
            $lt5_IAD0302 = $lt5->where('IAD0302', '1')->count();
            $lt5_IAD0303 = $lt5->where('IAD0303', '1')->count();
            $lt5_IAD0304 = $lt5->where('IAD0304', '1')->count();
            $lt5_IAD0201 = $lt5->where('IAD0201', '1')->count();
            $lt5_IAD0202 = $lt5->where('IAD0202', '1')->count();
            $lt5_IAD0203 = $lt5->where('IAD0203', '1')->count();
            $lt5_IAD0204 = $lt5->where('IAD0204', '1')->count();
            $lt5_jumlah = $lt5_IAD0301 + $lt5_IAD0302 + $lt5_IAD0303 + $lt5_IAD0304 + $lt5_IAD0201 + $lt5_IAD0202 + $lt5_IAD0203 + $lt5_IAD0204;

            $no_lt5_IAD0301 = $lt5->where('IAD0301', '0')->count();
            $no_lt5_IAD0302 = $lt5->where('IAD0302', '0')->count();
            $no_lt5_IAD0303 = $lt5->where('IAD0303', '0')->count();
            $no_lt5_IAD0304 = $lt5->where('IAD0304', '0')->count();
            $no_lt5_IAD0201 = $lt5->where('IAD0201', '0')->count();
            $no_lt5_IAD0202 = $lt5->where('IAD0202', '0')->count();
            $no_lt5_IAD0203 = $lt5->where('IAD0203', '0')->count();
            $no_lt5_IAD0204 = $lt5->where('IAD0204', '0')->count();
            $no_lt5_jumlah = $no_lt5_IAD0301 + $no_lt5_IAD0302 + $no_lt5_IAD0303 + $no_lt5_IAD0304 + $no_lt5_IAD0201 + $no_lt5_IAD0202 + $no_lt5_IAD0203 + $no_lt5_IAD0204;

            $denominator_lt5 = $lt5_jumlah + $no_lt5_jumlah;

            $vk_IAD0301 = $vk->where('IAD0301', '1')->count();
            $vk_IAD0302 = $vk->where('IAD0302', '1')->count();
            $vk_IAD0303 = $vk->where('IAD0303', '1')->count();
            $vk_IAD0304 = $vk->where('IAD0304', '1')->count();
            $vk_IAD0201 = $vk->where('IAD0201', '1')->count();
            $vk_IAD0202 = $vk->where('IAD0202', '1')->count();
            $vk_IAD0203 = $vk->where('IAD0203', '1')->count();
            $vk_IAD0204 = $vk->where('IAD0204', '1')->count();
            $vk_jumlah = $vk_IAD0301 + $vk_IAD0302 + $vk_IAD0303 + $vk_IAD0304 + $vk_IAD0201 + $vk_IAD0202 + $vk_IAD0203 + $vk_IAD0204;

            $no_vk_IAD0301 = $vk->where('IAD0301', '0')->count();
            $no_vk_IAD0302 = $vk->where('IAD0302', '0')->count();
            $no_vk_IAD0303 = $vk->where('IAD0303', '0')->count();
            $no_vk_IAD0304 = $vk->where('IAD0304', '0')->count();
            $no_vk_IAD0201 = $vk->where('IAD0201', '0')->count();
            $no_vk_IAD0202 = $vk->where('IAD0202', '0')->count();
            $no_vk_IAD0203 = $vk->where('IAD0203', '0')->count();
            $no_vk_IAD0204 = $vk->where('IAD0204', '0')->count();
            $no_vk_jumlah = $no_vk_IAD0301 + $no_vk_IAD0302 + $no_vk_IAD0303 + $no_vk_IAD0304 + $no_vk_IAD0201 + $no_vk_IAD0202 + $no_vk_IAD0203 + $no_vk_IAD0204;

            $denominator_vk = $vk_jumlah + $no_vk_jumlah;

            return view('rekapBundleIAD.index', compact(
                'range_tgl',
                'tabel',
                'rekap',
                'analisa',
                'tindak_lanjut',

                'igd_IAD0301',
                'igd_IAD0302',
                'igd_IAD0303',
                'igd_IAD0304',
                'igd_IAD0201',
                'igd_IAD0202',
                'igd_IAD0203',
                'igd_IAD0204',
                'igd_jumlah',

                'no_igd_IAD0301',
                'no_igd_IAD0302',
                'no_igd_IAD0303',
                'no_igd_IAD0304',
                'no_igd_IAD0201',
                'no_igd_IAD0202',
                'no_igd_IAD0203',
                'no_igd_IAD0204',
                'no_igd_jumlah',

                'denominator_igd',

                'int_IAD0301',
                'int_IAD0302',
                'int_IAD0303',
                'int_IAD0304',
                'int_IAD0201',
                'int_IAD0202',
                'int_IAD0203',
                'int_IAD0204',
                'int_jumlah',

                'no_int_IAD0301',
                'no_int_IAD0302',
                'no_int_IAD0303',
                'no_int_IAD0304',
                'no_int_IAD0201',
                'no_int_IAD0202',
                'no_int_IAD0203',
                'no_int_IAD0204',
                'no_int_jumlah',

                'denominator_int',

                'ok_IAD0301',
                'ok_IAD0302',
                'ok_IAD0303',
                'ok_IAD0304',
                'ok_IAD0201',
                'ok_IAD0202',
                'ok_IAD0203',
                'ok_IAD0204',
                'ok_jumlah',

                'no_ok_IAD0301',
                'no_ok_IAD0302',
                'no_ok_IAD0303',
                'no_ok_IAD0304',
                'no_ok_IAD0201',
                'no_ok_IAD0202',
                'no_ok_IAD0203',
                'no_ok_IAD0204',
                'no_ok_jumlah',

                'denominator_ok',

                'lt2_IAD0301',
                'lt2_IAD0302',
                'lt2_IAD0303',
                'lt2_IAD0304',
                'lt2_IAD0201',
                'lt2_IAD0202',
                'lt2_IAD0203',
                'lt2_IAD0204',
                'lt2_jumlah',

                'no_lt2_IAD0301',
                'no_lt2_IAD0302',
                'no_lt2_IAD0303',
                'no_lt2_IAD0304',
                'no_lt2_IAD0201',
                'no_lt2_IAD0202',
                'no_lt2_IAD0203',
                'no_lt2_IAD0204',
                'no_lt2_jumlah',

                'denominator_lt2',

                'lt4_IAD0301',
                'lt4_IAD0302',
                'lt4_IAD0303',
                'lt4_IAD0304',
                'lt4_IAD0201',
                'lt4_IAD0202',
                'lt4_IAD0203',
                'lt4_IAD0204',
                'lt4_jumlah',

                'no_lt4_IAD0301',
                'no_lt4_IAD0302',
                'no_lt4_IAD0303',
                'no_lt4_IAD0304',
                'no_lt4_IAD0201',
                'no_lt4_IAD0202',
                'no_lt4_IAD0203',
                'no_lt4_IAD0204',
                'no_lt4_jumlah',

                'denominator_lt4',

                'lt5_IAD0301',
                'lt5_IAD0302',
                'lt5_IAD0303',
                'lt5_IAD0304',
                'lt5_IAD0201',
                'lt5_IAD0202',
                'lt5_IAD0203',
                'lt5_IAD0204',
                'lt5_jumlah',

                'no_lt5_IAD0301',
                'no_lt5_IAD0302',
                'no_lt5_IAD0303',
                'no_lt5_IAD0304',
                'no_lt5_IAD0201',
                'no_lt5_IAD0202',
                'no_lt5_IAD0203',
                'no_lt5_IAD0204',
                'no_lt5_jumlah',

                'denominator_lt5',

                'vk_IAD0301',
                'vk_IAD0302',
                'vk_IAD0303',
                'vk_IAD0304',
                'vk_IAD0201',
                'vk_IAD0202',
                'vk_IAD0203',
                'vk_IAD0204',
                'vk_jumlah',

                'no_vk_IAD0301',
                'no_vk_IAD0302',
                'no_vk_IAD0303',
                'no_vk_IAD0304',
                'no_vk_IAD0201',
                'no_vk_IAD0202',
                'no_vk_IAD0203',
                'no_vk_IAD0204',
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
            $tabel = BundleIAD::whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')->paginate(1000);
            // dd($tabel);

            $rekap = RekapBundleIad::whereDate('dari', '=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('sampai', '=', $request->input('sampai') ?? $tgl_skg)
                ->get();

            $analisa = RekapBundleIad::select('analisa')
                ->whereDate('dari', '=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('sampai', '=', $request->input('sampai') ?? $tgl_skg)
                ->get();

            $tindak_lanjut = RekapBundleIad::select('tindak_lanjut')
                ->whereDate('dari', '=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('sampai', '=', $request->input('sampai') ?? $tgl_skg)
                ->get();

            $igd = BundleIAD::where('unit', 'IGD')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $int = BundleIAD::where('unit', 'Intensif')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $ok = BundleIAD::where('unit', 'OK')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt2 = BundleIAD::whereIn('unit', ['Perawatan Eksekutif lt.2', 'Perawatan Padma'])
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt4 = BundleIAD::where('unit', 'Perawatan Reguler lt.4')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt5 = BundleIAD::where('unit', 'Perawatan Reguler lt.5')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $vk = BundleIAD::where('unit', 'VK')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();

            $igd_IAD0301 = $igd->where('IAD0301', '1')->count();
            $igd_IAD0302 = $igd->where('IAD0302', '1')->count();
            $igd_IAD0303 = $igd->where('IAD0303', '1')->count();
            $igd_IAD0304 = $igd->where('IAD0304', '1')->count();
            $igd_IAD0201 = $igd->where('IAD0201', '1')->count();
            $igd_IAD0202 = $igd->where('IAD0202', '1')->count();
            $igd_IAD0203 = $igd->where('IAD0203', '1')->count();
            $igd_IAD0204 = $igd->where('IAD0204', '1')->count();
            $igd_jumlah = $igd_IAD0301 + $igd_IAD0302 + $igd_IAD0303 + $igd_IAD0304 + $igd_IAD0201 + $igd_IAD0202 + $igd_IAD0203 + $igd_IAD0204;

            $no_igd_IAD0301 = $igd->where('IAD0301', '0')->count();
            $no_igd_IAD0302 = $igd->where('IAD0302', '0')->count();
            $no_igd_IAD0303 = $igd->where('IAD0303', '0')->count();
            $no_igd_IAD0304 = $igd->where('IAD0304', '0')->count();
            $no_igd_IAD0201 = $igd->where('IAD0201', '0')->count();
            $no_igd_IAD0202 = $igd->where('IAD0202', '0')->count();
            $no_igd_IAD0203 = $igd->where('IAD0203', '0')->count();
            $no_igd_IAD0204 = $igd->where('IAD0204', '0')->count();
            $no_igd_jumlah = $no_igd_IAD0301 + $no_igd_IAD0302 + $no_igd_IAD0303 + $no_igd_IAD0304 + $no_igd_IAD0201 + $no_igd_IAD0202 + $no_igd_IAD0203 + $no_igd_IAD0204;

            $denominator_igd = $igd_jumlah + $no_igd_jumlah;

            $int_IAD0301 = $int->where('IAD0301', '1')->count();
            $int_IAD0302 = $int->where('IAD0302', '1')->count();
            $int_IAD0303 = $int->where('IAD0303', '1')->count();
            $int_IAD0304 = $int->where('IAD0304', '1')->count();
            $int_IAD0201 = $int->where('IAD0201', '1')->count();
            $int_IAD0202 = $int->where('IAD0202', '1')->count();
            $int_IAD0203 = $int->where('IAD0203', '1')->count();
            $int_IAD0204 = $int->where('IAD0204', '1')->count();
            $int_jumlah = $int_IAD0301 + $int_IAD0302 + $int_IAD0303 + $int_IAD0304 + $int_IAD0201 + $int_IAD0202 + $int_IAD0203 + $int_IAD0204;

            $no_int_IAD0301 = $int->where('IAD0301', '0')->count();
            $no_int_IAD0302 = $int->where('IAD0302', '0')->count();
            $no_int_IAD0303 = $int->where('IAD0303', '0')->count();
            $no_int_IAD0304 = $int->where('IAD0304', '0')->count();
            $no_int_IAD0201 = $int->where('IAD0201', '0')->count();
            $no_int_IAD0202 = $int->where('IAD0202', '0')->count();
            $no_int_IAD0203 = $int->where('IAD0203', '0')->count();
            $no_int_IAD0204 = $int->where('IAD0204', '0')->count();
            $no_int_jumlah = $no_int_IAD0301 + $no_int_IAD0302 + $no_int_IAD0303 + $no_int_IAD0304 + $no_int_IAD0201 + $no_int_IAD0202 + $no_int_IAD0203 + $no_int_IAD0204;

            $denominator_int = $int_jumlah + $no_int_jumlah;

            $ok_IAD0301 = $ok->where('IAD0301', '1')->count();
            $ok_IAD0302 = $ok->where('IAD0302', '1')->count();
            $ok_IAD0303 = $ok->where('IAD0303', '1')->count();
            $ok_IAD0304 = $ok->where('IAD0304', '1')->count();
            $ok_IAD0201 = $ok->where('IAD0201', '1')->count();
            $ok_IAD0202 = $ok->where('IAD0202', '1')->count();
            $ok_IAD0203 = $ok->where('IAD0203', '1')->count();
            $ok_IAD0204 = $ok->where('IAD0204', '1')->count();
            $ok_jumlah = $ok_IAD0301 + $ok_IAD0302 + $ok_IAD0303 + $ok_IAD0304 + $ok_IAD0201 + $ok_IAD0202 + $ok_IAD0203 + $ok_IAD0204;

            $no_ok_IAD0301 = $ok->where('IAD0301', '0')->count();
            $no_ok_IAD0302 = $ok->where('IAD0302', '0')->count();
            $no_ok_IAD0303 = $ok->where('IAD0303', '0')->count();
            $no_ok_IAD0304 = $ok->where('IAD0304', '0')->count();
            $no_ok_IAD0201 = $ok->where('IAD0201', '0')->count();
            $no_ok_IAD0202 = $ok->where('IAD0202', '0')->count();
            $no_ok_IAD0203 = $ok->where('IAD0203', '0')->count();
            $no_ok_IAD0204 = $ok->where('IAD0204', '0')->count();
            $no_ok_jumlah = $no_ok_IAD0301 + $no_ok_IAD0302 + $no_ok_IAD0303 + $no_ok_IAD0304 + $no_ok_IAD0201 + $no_ok_IAD0202 + $no_ok_IAD0203 + $no_ok_IAD0204;

            $denominator_ok = $ok_jumlah + $no_ok_jumlah;

            $lt2_IAD0301 = $lt2->where('IAD0301', '1')->count();
            $lt2_IAD0302 = $lt2->where('IAD0302', '1')->count();
            $lt2_IAD0303 = $lt2->where('IAD0303', '1')->count();
            $lt2_IAD0304 = $lt2->where('IAD0304', '1')->count();
            $lt2_IAD0201 = $lt2->where('IAD0201', '1')->count();
            $lt2_IAD0202 = $lt2->where('IAD0202', '1')->count();
            $lt2_IAD0203 = $lt2->where('IAD0203', '1')->count();
            $lt2_IAD0204 = $lt2->where('IAD0204', '1')->count();
            $lt2_jumlah = $lt2_IAD0301 + $lt2_IAD0302 + $lt2_IAD0303 + $lt2_IAD0304 + $lt2_IAD0201 + $lt2_IAD0202 + $lt2_IAD0203 + $lt2_IAD0204;

            $no_lt2_IAD0301 = $lt2->where('IAD0301', '0')->count();
            $no_lt2_IAD0302 = $lt2->where('IAD0302', '0')->count();
            $no_lt2_IAD0303 = $lt2->where('IAD0303', '0')->count();
            $no_lt2_IAD0304 = $lt2->where('IAD0304', '0')->count();
            $no_lt2_IAD0201 = $lt2->where('IAD0201', '0')->count();
            $no_lt2_IAD0202 = $lt2->where('IAD0202', '0')->count();
            $no_lt2_IAD0203 = $lt2->where('IAD0203', '0')->count();
            $no_lt2_IAD0204 = $lt2->where('IAD0204', '0')->count();
            $no_lt2_jumlah = $no_lt2_IAD0301 + $no_lt2_IAD0302 + $no_lt2_IAD0303 + $no_lt2_IAD0304 + $no_lt2_IAD0201 + $no_lt2_IAD0202 + $no_lt2_IAD0203 + $no_lt2_IAD0204;

            $denominator_lt2 = $lt2_jumlah + $no_lt2_jumlah;

            $lt4_IAD0301 = $lt4->where('IAD0301', '1')->count();
            $lt4_IAD0302 = $lt4->where('IAD0302', '1')->count();
            $lt4_IAD0303 = $lt4->where('IAD0303', '1')->count();
            $lt4_IAD0304 = $lt4->where('IAD0304', '1')->count();
            $lt4_IAD0201 = $lt4->where('IAD0201', '1')->count();
            $lt4_IAD0202 = $lt4->where('IAD0202', '1')->count();
            $lt4_IAD0203 = $lt4->where('IAD0203', '1')->count();
            $lt4_IAD0204 = $lt4->where('IAD0204', '1')->count();
            $lt4_jumlah = $lt4_IAD0301 + $lt4_IAD0302 + $lt4_IAD0303 + $lt4_IAD0304 + $lt4_IAD0201 + $lt4_IAD0202 + $lt4_IAD0203 + $lt4_IAD0204;

            $no_lt4_IAD0301 = $lt4->where('IAD0301', '0')->count();
            $no_lt4_IAD0302 = $lt4->where('IAD0302', '0')->count();
            $no_lt4_IAD0303 = $lt4->where('IAD0303', '0')->count();
            $no_lt4_IAD0304 = $lt4->where('IAD0304', '0')->count();
            $no_lt4_IAD0201 = $lt4->where('IAD0201', '0')->count();
            $no_lt4_IAD0202 = $lt4->where('IAD0202', '0')->count();
            $no_lt4_IAD0203 = $lt4->where('IAD0203', '0')->count();
            $no_lt4_IAD0204 = $lt4->where('IAD0204', '0')->count();
            $no_lt4_jumlah = $no_lt4_IAD0301 + $no_lt4_IAD0302 + $no_lt4_IAD0303 + $no_lt4_IAD0304 + $no_lt4_IAD0201 + $no_lt4_IAD0202 + $no_lt4_IAD0203 + $no_lt4_IAD0204;

            $denominator_lt4 = $lt4_jumlah + $no_lt4_jumlah;

            $lt5_IAD0301 = $lt5->where('IAD0301', '1')->count();
            $lt5_IAD0302 = $lt5->where('IAD0302', '1')->count();
            $lt5_IAD0303 = $lt5->where('IAD0303', '1')->count();
            $lt5_IAD0304 = $lt5->where('IAD0304', '1')->count();
            $lt5_IAD0201 = $lt5->where('IAD0201', '1')->count();
            $lt5_IAD0202 = $lt5->where('IAD0202', '1')->count();
            $lt5_IAD0203 = $lt5->where('IAD0203', '1')->count();
            $lt5_IAD0204 = $lt5->where('IAD0204', '1')->count();
            $lt5_jumlah = $lt5_IAD0301 + $lt5_IAD0302 + $lt5_IAD0303 + $lt5_IAD0304 + $lt5_IAD0201 + $lt5_IAD0202 + $lt5_IAD0203 + $lt5_IAD0204;

            $no_lt5_IAD0301 = $lt5->where('IAD0301', '0')->count();
            $no_lt5_IAD0302 = $lt5->where('IAD0302', '0')->count();
            $no_lt5_IAD0303 = $lt5->where('IAD0303', '0')->count();
            $no_lt5_IAD0304 = $lt5->where('IAD0304', '0')->count();
            $no_lt5_IAD0201 = $lt5->where('IAD0201', '0')->count();
            $no_lt5_IAD0202 = $lt5->where('IAD0202', '0')->count();
            $no_lt5_IAD0203 = $lt5->where('IAD0203', '0')->count();
            $no_lt5_IAD0204 = $lt5->where('IAD0204', '0')->count();
            $no_lt5_jumlah = $no_lt5_IAD0301 + $no_lt5_IAD0302 + $no_lt5_IAD0303 + $no_lt5_IAD0304 + $no_lt5_IAD0201 + $no_lt5_IAD0202 + $no_lt5_IAD0203 + $no_lt5_IAD0204;

            $denominator_lt5 = $lt5_jumlah + $no_lt5_jumlah;

            $vk_IAD0301 = $vk->where('IAD0301', '1')->count();
            $vk_IAD0302 = $vk->where('IAD0302', '1')->count();
            $vk_IAD0303 = $vk->where('IAD0303', '1')->count();
            $vk_IAD0304 = $vk->where('IAD0304', '1')->count();
            $vk_IAD0201 = $vk->where('IAD0201', '1')->count();
            $vk_IAD0202 = $vk->where('IAD0202', '1')->count();
            $vk_IAD0203 = $vk->where('IAD0203', '1')->count();
            $vk_IAD0204 = $vk->where('IAD0204', '1')->count();
            $vk_jumlah = $vk_IAD0301 + $vk_IAD0302 + $vk_IAD0303 + $vk_IAD0304 + $vk_IAD0201 + $vk_IAD0202 + $vk_IAD0203 + $vk_IAD0204;

            $no_vk_IAD0301 = $vk->where('IAD0301', '0')->count();
            $no_vk_IAD0302 = $vk->where('IAD0302', '0')->count();
            $no_vk_IAD0303 = $vk->where('IAD0303', '0')->count();
            $no_vk_IAD0304 = $vk->where('IAD0304', '0')->count();
            $no_vk_IAD0201 = $vk->where('IAD0201', '0')->count();
            $no_vk_IAD0202 = $vk->where('IAD0202', '0')->count();
            $no_vk_IAD0203 = $vk->where('IAD0203', '0')->count();
            $no_vk_IAD0204 = $vk->where('IAD0204', '0')->count();
            $no_vk_jumlah = $no_vk_IAD0301 + $no_vk_IAD0302 + $no_vk_IAD0303 + $no_vk_IAD0304 + $no_vk_IAD0201 + $no_vk_IAD0202 + $no_vk_IAD0203 + $no_vk_IAD0204;

            $denominator_vk = $vk_jumlah + $no_vk_jumlah;

            $tanggal = Carbon::parse($request->input('dari'))->isoFormat('DD MMMM YYYY') . ' - ' . Carbon::parse($request->input('sampai'))->isoFormat('DD MMMM YYYY');

            return Excel::download(new ExportBundleIAD(
                $igd_IAD0301,
                $igd_IAD0302,
                $igd_IAD0303,
                $igd_IAD0304,
                $igd_IAD0201,
                $igd_IAD0202,
                $igd_IAD0203,
                $igd_IAD0204,
                $igd_jumlah,

                $no_igd_IAD0301,
                $no_igd_IAD0302,
                $no_igd_IAD0303,
                $no_igd_IAD0304,
                $no_igd_IAD0201,
                $no_igd_IAD0202,
                $no_igd_IAD0203,
                $no_igd_IAD0204,
                $no_igd_jumlah,

                $denominator_igd,

                $int_IAD0301,
                $int_IAD0302,
                $int_IAD0303,
                $int_IAD0304,
                $int_IAD0201,
                $int_IAD0202,
                $int_IAD0203,
                $int_IAD0204,
                $int_jumlah,

                $no_int_IAD0301,
                $no_int_IAD0302,
                $no_int_IAD0303,
                $no_int_IAD0304,
                $no_int_IAD0201,
                $no_int_IAD0202,
                $no_int_IAD0203,
                $no_int_IAD0204,
                $no_int_jumlah,

                $denominator_int,

                $ok_IAD0301,
                $ok_IAD0302,
                $ok_IAD0303,
                $ok_IAD0304,
                $ok_IAD0201,
                $ok_IAD0202,
                $ok_IAD0203,
                $ok_IAD0204,
                $ok_jumlah,

                $no_ok_IAD0301,
                $no_ok_IAD0302,
                $no_ok_IAD0303,
                $no_ok_IAD0304,
                $no_ok_IAD0201,
                $no_ok_IAD0202,
                $no_ok_IAD0203,
                $no_ok_IAD0204,
                $no_ok_jumlah,

                $denominator_ok,

                $lt2_IAD0301,
                $lt2_IAD0302,
                $lt2_IAD0303,
                $lt2_IAD0304,
                $lt2_IAD0201,
                $lt2_IAD0202,
                $lt2_IAD0203,
                $lt2_IAD0204,
                $lt2_jumlah,

                $no_lt2_IAD0301,
                $no_lt2_IAD0302,
                $no_lt2_IAD0303,
                $no_lt2_IAD0304,
                $no_lt2_IAD0201,
                $no_lt2_IAD0202,
                $no_lt2_IAD0203,
                $no_lt2_IAD0204,
                $no_lt2_jumlah,

                $denominator_lt2,

                $lt4_IAD0301,
                $lt4_IAD0302,
                $lt4_IAD0303,
                $lt4_IAD0304,
                $lt4_IAD0201,
                $lt4_IAD0202,
                $lt4_IAD0203,
                $lt4_IAD0204,
                $lt4_jumlah,

                $no_lt4_IAD0301,
                $no_lt4_IAD0302,
                $no_lt4_IAD0303,
                $no_lt4_IAD0304,
                $no_lt4_IAD0201,
                $no_lt4_IAD0202,
                $no_lt4_IAD0203,
                $no_lt4_IAD0204,
                $no_lt4_jumlah,

                $denominator_lt4,

                $lt5_IAD0301,
                $lt5_IAD0302,
                $lt5_IAD0303,
                $lt5_IAD0304,
                $lt5_IAD0201,
                $lt5_IAD0202,
                $lt5_IAD0203,
                $lt5_IAD0204,
                $lt5_jumlah,

                $no_lt5_IAD0301,
                $no_lt5_IAD0302,
                $no_lt5_IAD0303,
                $no_lt5_IAD0304,
                $no_lt5_IAD0201,
                $no_lt5_IAD0202,
                $no_lt5_IAD0203,
                $no_lt5_IAD0204,
                $no_lt5_jumlah,

                $denominator_lt5,

                $vk_IAD0301,
                $vk_IAD0302,
                $vk_IAD0303,
                $vk_IAD0304,
                $vk_IAD0201,
                $vk_IAD0202,
                $vk_IAD0203,
                $vk_IAD0204,
                $vk_jumlah,

                $no_vk_IAD0301,
                $no_vk_IAD0302,
                $no_vk_IAD0303,
                $no_vk_IAD0304,
                $no_vk_IAD0201,
                $no_vk_IAD0202,
                $no_vk_IAD0203,
                $no_vk_IAD0204,
                $no_vk_jumlah,

                $denominator_vk,

                $tabel,
                $rekap,
                $tanggal
            ), 'Rekap Bundle IAD ' . $tanggal . '.xlsx');
        } else {
            return Redirect::back()->withErrors(['msg' => 'Tanggal tidak boleh Lebih kecil dari sebelumnya']);
        }
    }

    public function pdf(Request $request)
    {
        $tgl_skg = date('Y-m-d');

        if ($request->input('dari') <= $request->input('sampai')) {
            $tabel = BundleIAD::whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')->paginate(1000);
            // dd($tabel);

            $rekap = RekapBundleIad::whereDate('dari', '=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('sampai', '=', $request->input('sampai') ?? $tgl_skg)
                ->get();

            $analisa = RekapBundleIad::select('analisa')
                ->whereDate('dari', '=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('sampai', '=', $request->input('sampai') ?? $tgl_skg)
                ->get();

            $tindak_lanjut = RekapBundleIad::select('tindak_lanjut')
                ->whereDate('dari', '=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('sampai', '=', $request->input('sampai') ?? $tgl_skg)
                ->get();

            $igd = BundleIAD::where('unit', 'IGD')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $int = BundleIAD::where('unit', 'Intensif')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $ok = BundleIAD::where('unit', 'OK')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt2 = BundleIAD::whereIn('unit', ['Perawatan Eksekutif lt.2', 'Perawatan Padma'])
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt4 = BundleIAD::where('unit', 'Perawatan Reguler lt.4')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt5 = BundleIAD::where('unit', 'Perawatan Reguler lt.5')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $vk = BundleIAD::where('unit', 'VK')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();

            $igd_IAD0301 = $igd->where('IAD0301', '1')->count();
            $igd_IAD0302 = $igd->where('IAD0302', '1')->count();
            $igd_IAD0303 = $igd->where('IAD0303', '1')->count();
            $igd_IAD0304 = $igd->where('IAD0304', '1')->count();
            $igd_IAD0201 = $igd->where('IAD0201', '1')->count();
            $igd_IAD0202 = $igd->where('IAD0202', '1')->count();
            $igd_IAD0203 = $igd->where('IAD0203', '1')->count();
            $igd_IAD0204 = $igd->where('IAD0204', '1')->count();
            $igd_jumlah = $igd_IAD0301 + $igd_IAD0302 + $igd_IAD0303 + $igd_IAD0304 + $igd_IAD0201 + $igd_IAD0202 + $igd_IAD0203 + $igd_IAD0204;

            $no_igd_IAD0301 = $igd->where('IAD0301', '0')->count();
            $no_igd_IAD0302 = $igd->where('IAD0302', '0')->count();
            $no_igd_IAD0303 = $igd->where('IAD0303', '0')->count();
            $no_igd_IAD0304 = $igd->where('IAD0304', '0')->count();
            $no_igd_IAD0201 = $igd->where('IAD0201', '0')->count();
            $no_igd_IAD0202 = $igd->where('IAD0202', '0')->count();
            $no_igd_IAD0203 = $igd->where('IAD0203', '0')->count();
            $no_igd_IAD0204 = $igd->where('IAD0204', '0')->count();
            $no_igd_jumlah = $no_igd_IAD0301 + $no_igd_IAD0302 + $no_igd_IAD0303 + $no_igd_IAD0304 + $no_igd_IAD0201 + $no_igd_IAD0202 + $no_igd_IAD0203 + $no_igd_IAD0204;

            $denominator_igd = $igd_jumlah + $no_igd_jumlah;

            $int_IAD0301 = $int->where('IAD0301', '1')->count();
            $int_IAD0302 = $int->where('IAD0302', '1')->count();
            $int_IAD0303 = $int->where('IAD0303', '1')->count();
            $int_IAD0304 = $int->where('IAD0304', '1')->count();
            $int_IAD0201 = $int->where('IAD0201', '1')->count();
            $int_IAD0202 = $int->where('IAD0202', '1')->count();
            $int_IAD0203 = $int->where('IAD0203', '1')->count();
            $int_IAD0204 = $int->where('IAD0204', '1')->count();
            $int_jumlah = $int_IAD0301 + $int_IAD0302 + $int_IAD0303 + $int_IAD0304 + $int_IAD0201 + $int_IAD0202 + $int_IAD0203 + $int_IAD0204;

            $no_int_IAD0301 = $int->where('IAD0301', '0')->count();
            $no_int_IAD0302 = $int->where('IAD0302', '0')->count();
            $no_int_IAD0303 = $int->where('IAD0303', '0')->count();
            $no_int_IAD0304 = $int->where('IAD0304', '0')->count();
            $no_int_IAD0201 = $int->where('IAD0201', '0')->count();
            $no_int_IAD0202 = $int->where('IAD0202', '0')->count();
            $no_int_IAD0203 = $int->where('IAD0203', '0')->count();
            $no_int_IAD0204 = $int->where('IAD0204', '0')->count();
            $no_int_jumlah = $no_int_IAD0301 + $no_int_IAD0302 + $no_int_IAD0303 + $no_int_IAD0304 + $no_int_IAD0201 + $no_int_IAD0202 + $no_int_IAD0203 + $no_int_IAD0204;

            $denominator_int = $int_jumlah + $no_int_jumlah;

            $ok_IAD0301 = $ok->where('IAD0301', '1')->count();
            $ok_IAD0302 = $ok->where('IAD0302', '1')->count();
            $ok_IAD0303 = $ok->where('IAD0303', '1')->count();
            $ok_IAD0304 = $ok->where('IAD0304', '1')->count();
            $ok_IAD0201 = $ok->where('IAD0201', '1')->count();
            $ok_IAD0202 = $ok->where('IAD0202', '1')->count();
            $ok_IAD0203 = $ok->where('IAD0203', '1')->count();
            $ok_IAD0204 = $ok->where('IAD0204', '1')->count();
            $ok_jumlah = $ok_IAD0301 + $ok_IAD0302 + $ok_IAD0303 + $ok_IAD0304 + $ok_IAD0201 + $ok_IAD0202 + $ok_IAD0203 + $ok_IAD0204;

            $no_ok_IAD0301 = $ok->where('IAD0301', '0')->count();
            $no_ok_IAD0302 = $ok->where('IAD0302', '0')->count();
            $no_ok_IAD0303 = $ok->where('IAD0303', '0')->count();
            $no_ok_IAD0304 = $ok->where('IAD0304', '0')->count();
            $no_ok_IAD0201 = $ok->where('IAD0201', '0')->count();
            $no_ok_IAD0202 = $ok->where('IAD0202', '0')->count();
            $no_ok_IAD0203 = $ok->where('IAD0203', '0')->count();
            $no_ok_IAD0204 = $ok->where('IAD0204', '0')->count();
            $no_ok_jumlah = $no_ok_IAD0301 + $no_ok_IAD0302 + $no_ok_IAD0303 + $no_ok_IAD0304 + $no_ok_IAD0201 + $no_ok_IAD0202 + $no_ok_IAD0203 + $no_ok_IAD0204;

            $denominator_ok = $ok_jumlah + $no_ok_jumlah;

            $lt2_IAD0301 = $lt2->where('IAD0301', '1')->count();
            $lt2_IAD0302 = $lt2->where('IAD0302', '1')->count();
            $lt2_IAD0303 = $lt2->where('IAD0303', '1')->count();
            $lt2_IAD0304 = $lt2->where('IAD0304', '1')->count();
            $lt2_IAD0201 = $lt2->where('IAD0201', '1')->count();
            $lt2_IAD0202 = $lt2->where('IAD0202', '1')->count();
            $lt2_IAD0203 = $lt2->where('IAD0203', '1')->count();
            $lt2_IAD0204 = $lt2->where('IAD0204', '1')->count();
            $lt2_jumlah = $lt2_IAD0301 + $lt2_IAD0302 + $lt2_IAD0303 + $lt2_IAD0304 + $lt2_IAD0201 + $lt2_IAD0202 + $lt2_IAD0203 + $lt2_IAD0204;

            $no_lt2_IAD0301 = $lt2->where('IAD0301', '0')->count();
            $no_lt2_IAD0302 = $lt2->where('IAD0302', '0')->count();
            $no_lt2_IAD0303 = $lt2->where('IAD0303', '0')->count();
            $no_lt2_IAD0304 = $lt2->where('IAD0304', '0')->count();
            $no_lt2_IAD0201 = $lt2->where('IAD0201', '0')->count();
            $no_lt2_IAD0202 = $lt2->where('IAD0202', '0')->count();
            $no_lt2_IAD0203 = $lt2->where('IAD0203', '0')->count();
            $no_lt2_IAD0204 = $lt2->where('IAD0204', '0')->count();
            $no_lt2_jumlah = $no_lt2_IAD0301 + $no_lt2_IAD0302 + $no_lt2_IAD0303 + $no_lt2_IAD0304 + $no_lt2_IAD0201 + $no_lt2_IAD0202 + $no_lt2_IAD0203 + $no_lt2_IAD0204;

            $denominator_lt2 = $lt2_jumlah + $no_lt2_jumlah;

            $lt4_IAD0301 = $lt4->where('IAD0301', '1')->count();
            $lt4_IAD0302 = $lt4->where('IAD0302', '1')->count();
            $lt4_IAD0303 = $lt4->where('IAD0303', '1')->count();
            $lt4_IAD0304 = $lt4->where('IAD0304', '1')->count();
            $lt4_IAD0201 = $lt4->where('IAD0201', '1')->count();
            $lt4_IAD0202 = $lt4->where('IAD0202', '1')->count();
            $lt4_IAD0203 = $lt4->where('IAD0203', '1')->count();
            $lt4_IAD0204 = $lt4->where('IAD0204', '1')->count();
            $lt4_jumlah = $lt4_IAD0301 + $lt4_IAD0302 + $lt4_IAD0303 + $lt4_IAD0304 + $lt4_IAD0201 + $lt4_IAD0202 + $lt4_IAD0203 + $lt4_IAD0204;

            $no_lt4_IAD0301 = $lt4->where('IAD0301', '0')->count();
            $no_lt4_IAD0302 = $lt4->where('IAD0302', '0')->count();
            $no_lt4_IAD0303 = $lt4->where('IAD0303', '0')->count();
            $no_lt4_IAD0304 = $lt4->where('IAD0304', '0')->count();
            $no_lt4_IAD0201 = $lt4->where('IAD0201', '0')->count();
            $no_lt4_IAD0202 = $lt4->where('IAD0202', '0')->count();
            $no_lt4_IAD0203 = $lt4->where('IAD0203', '0')->count();
            $no_lt4_IAD0204 = $lt4->where('IAD0204', '0')->count();
            $no_lt4_jumlah = $no_lt4_IAD0301 + $no_lt4_IAD0302 + $no_lt4_IAD0303 + $no_lt4_IAD0304 + $no_lt4_IAD0201 + $no_lt4_IAD0202 + $no_lt4_IAD0203 + $no_lt4_IAD0204;

            $denominator_lt4 = $lt4_jumlah + $no_lt4_jumlah;

            $lt5_IAD0301 = $lt5->where('IAD0301', '1')->count();
            $lt5_IAD0302 = $lt5->where('IAD0302', '1')->count();
            $lt5_IAD0303 = $lt5->where('IAD0303', '1')->count();
            $lt5_IAD0304 = $lt5->where('IAD0304', '1')->count();
            $lt5_IAD0201 = $lt5->where('IAD0201', '1')->count();
            $lt5_IAD0202 = $lt5->where('IAD0202', '1')->count();
            $lt5_IAD0203 = $lt5->where('IAD0203', '1')->count();
            $lt5_IAD0204 = $lt5->where('IAD0204', '1')->count();
            $lt5_jumlah = $lt5_IAD0301 + $lt5_IAD0302 + $lt5_IAD0303 + $lt5_IAD0304 + $lt5_IAD0201 + $lt5_IAD0202 + $lt5_IAD0203 + $lt5_IAD0204;

            $no_lt5_IAD0301 = $lt5->where('IAD0301', '0')->count();
            $no_lt5_IAD0302 = $lt5->where('IAD0302', '0')->count();
            $no_lt5_IAD0303 = $lt5->where('IAD0303', '0')->count();
            $no_lt5_IAD0304 = $lt5->where('IAD0304', '0')->count();
            $no_lt5_IAD0201 = $lt5->where('IAD0201', '0')->count();
            $no_lt5_IAD0202 = $lt5->where('IAD0202', '0')->count();
            $no_lt5_IAD0203 = $lt5->where('IAD0203', '0')->count();
            $no_lt5_IAD0204 = $lt5->where('IAD0204', '0')->count();
            $no_lt5_jumlah = $no_lt5_IAD0301 + $no_lt5_IAD0302 + $no_lt5_IAD0303 + $no_lt5_IAD0304 + $no_lt5_IAD0201 + $no_lt5_IAD0202 + $no_lt5_IAD0203 + $no_lt5_IAD0204;

            $denominator_lt5 = $lt5_jumlah + $no_lt5_jumlah;

            $vk_IAD0301 = $vk->where('IAD0301', '1')->count();
            $vk_IAD0302 = $vk->where('IAD0302', '1')->count();
            $vk_IAD0303 = $vk->where('IAD0303', '1')->count();
            $vk_IAD0304 = $vk->where('IAD0304', '1')->count();
            $vk_IAD0201 = $vk->where('IAD0201', '1')->count();
            $vk_IAD0202 = $vk->where('IAD0202', '1')->count();
            $vk_IAD0203 = $vk->where('IAD0203', '1')->count();
            $vk_IAD0204 = $vk->where('IAD0204', '1')->count();
            $vk_jumlah = $vk_IAD0301 + $vk_IAD0302 + $vk_IAD0303 + $vk_IAD0304 + $vk_IAD0201 + $vk_IAD0202 + $vk_IAD0203 + $vk_IAD0204;

            $no_vk_IAD0301 = $vk->where('IAD0301', '0')->count();
            $no_vk_IAD0302 = $vk->where('IAD0302', '0')->count();
            $no_vk_IAD0303 = $vk->where('IAD0303', '0')->count();
            $no_vk_IAD0304 = $vk->where('IAD0304', '0')->count();
            $no_vk_IAD0201 = $vk->where('IAD0201', '0')->count();
            $no_vk_IAD0202 = $vk->where('IAD0202', '0')->count();
            $no_vk_IAD0203 = $vk->where('IAD0203', '0')->count();
            $no_vk_IAD0204 = $vk->where('IAD0204', '0')->count();
            $no_vk_jumlah = $no_vk_IAD0301 + $no_vk_IAD0302 + $no_vk_IAD0303 + $no_vk_IAD0304 + $no_vk_IAD0201 + $no_vk_IAD0202 + $no_vk_IAD0203 + $no_vk_IAD0204;

            $denominator_vk = $vk_jumlah + $no_vk_jumlah;

            $tanggal = Carbon::parse($request->input('dari'))->isoFormat('DD MMMM YYYY') . ' - ' . Carbon::parse($request->input('sampai'))->isoFormat('DD MMMM YYYY');

            return Excel::download(new ExportBundleIAD(
                $igd_IAD0301,
                $igd_IAD0302,
                $igd_IAD0303,
                $igd_IAD0304,
                $igd_IAD0201,
                $igd_IAD0202,
                $igd_IAD0203,
                $igd_IAD0204,
                $igd_jumlah,

                $no_igd_IAD0301,
                $no_igd_IAD0302,
                $no_igd_IAD0303,
                $no_igd_IAD0304,
                $no_igd_IAD0201,
                $no_igd_IAD0202,
                $no_igd_IAD0203,
                $no_igd_IAD0204,
                $no_igd_jumlah,

                $denominator_igd,

                $int_IAD0301,
                $int_IAD0302,
                $int_IAD0303,
                $int_IAD0304,
                $int_IAD0201,
                $int_IAD0202,
                $int_IAD0203,
                $int_IAD0204,
                $int_jumlah,

                $no_int_IAD0301,
                $no_int_IAD0302,
                $no_int_IAD0303,
                $no_int_IAD0304,
                $no_int_IAD0201,
                $no_int_IAD0202,
                $no_int_IAD0203,
                $no_int_IAD0204,
                $no_int_jumlah,

                $denominator_int,

                $ok_IAD0301,
                $ok_IAD0302,
                $ok_IAD0303,
                $ok_IAD0304,
                $ok_IAD0201,
                $ok_IAD0202,
                $ok_IAD0203,
                $ok_IAD0204,
                $ok_jumlah,

                $no_ok_IAD0301,
                $no_ok_IAD0302,
                $no_ok_IAD0303,
                $no_ok_IAD0304,
                $no_ok_IAD0201,
                $no_ok_IAD0202,
                $no_ok_IAD0203,
                $no_ok_IAD0204,
                $no_ok_jumlah,

                $denominator_ok,

                $lt2_IAD0301,
                $lt2_IAD0302,
                $lt2_IAD0303,
                $lt2_IAD0304,
                $lt2_IAD0201,
                $lt2_IAD0202,
                $lt2_IAD0203,
                $lt2_IAD0204,
                $lt2_jumlah,

                $no_lt2_IAD0301,
                $no_lt2_IAD0302,
                $no_lt2_IAD0303,
                $no_lt2_IAD0304,
                $no_lt2_IAD0201,
                $no_lt2_IAD0202,
                $no_lt2_IAD0203,
                $no_lt2_IAD0204,
                $no_lt2_jumlah,

                $denominator_lt2,

                $lt4_IAD0301,
                $lt4_IAD0302,
                $lt4_IAD0303,
                $lt4_IAD0304,
                $lt4_IAD0201,
                $lt4_IAD0202,
                $lt4_IAD0203,
                $lt4_IAD0204,
                $lt4_jumlah,

                $no_lt4_IAD0301,
                $no_lt4_IAD0302,
                $no_lt4_IAD0303,
                $no_lt4_IAD0304,
                $no_lt4_IAD0201,
                $no_lt4_IAD0202,
                $no_lt4_IAD0203,
                $no_lt4_IAD0204,
                $no_lt4_jumlah,

                $denominator_lt4,

                $lt5_IAD0301,
                $lt5_IAD0302,
                $lt5_IAD0303,
                $lt5_IAD0304,
                $lt5_IAD0201,
                $lt5_IAD0202,
                $lt5_IAD0203,
                $lt5_IAD0204,
                $lt5_jumlah,

                $no_lt5_IAD0301,
                $no_lt5_IAD0302,
                $no_lt5_IAD0303,
                $no_lt5_IAD0304,
                $no_lt5_IAD0201,
                $no_lt5_IAD0202,
                $no_lt5_IAD0203,
                $no_lt5_IAD0204,
                $no_lt5_jumlah,

                $denominator_lt5,

                $vk_IAD0301,
                $vk_IAD0302,
                $vk_IAD0303,
                $vk_IAD0304,
                $vk_IAD0201,
                $vk_IAD0202,
                $vk_IAD0203,
                $vk_IAD0204,
                $vk_jumlah,

                $no_vk_IAD0301,
                $no_vk_IAD0302,
                $no_vk_IAD0303,
                $no_vk_IAD0304,
                $no_vk_IAD0201,
                $no_vk_IAD0202,
                $no_vk_IAD0203,
                $no_vk_IAD0204,
                $no_vk_jumlah,

                $denominator_vk,

                $tabel,
                $rekap,
                $tanggal
            ), 'Rekap Bundle IAD ' . $tanggal . '.pdf', \Maatwebsite\Excel\Excel::MPDF);
        } else {
            return Redirect::back()->withErrors(['msg' => 'Tanggal tidak boleh Lebih kecil dari sebelumnya']);
        }
    }
}
