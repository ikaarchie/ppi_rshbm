<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Rekap;
use App\Models\Surveilans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\ExportExcel;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Redirect;

class SurveilansController extends Controller
{
    public function index()
    {
        return view('surveilans.index');
    }

    public function getData(Request $request)
    {
        // dd(request('search'));
        $cari = $request->cari;

        // $surveilans = Surveilans::latest('id')->paginate(10);
        if ($request->has('cari')) {
            $surveilans = Surveilans::where('nama_pasien', 'LIKE', '%' . $cari . '%')
                ->orWhere('mrn', 'LIKE', '%' . $cari . '%')
                ->latest('id')
                ->paginate(10);
            $surveilans->withPath('surveilans');
            $surveilans->appends($request->all());
        } else {
            $surveilans = Surveilans::latest('id')->paginate(10);
        }

        return view('surveilans.index', compact('surveilans', 'cari'));
    }

    public function save(Request $request)
    {
        $data = new Surveilans();
        $data->mrn = $request->input('mrn');
        $data->nama_pasien = $request->input('nama_pasien');
        $data->usia = $request->input('usia');
        $data->jenis_kelamin = $request->input('jenis_kelamin');
        $data->unit = $request->input('unit');
        $data->pa_ivl = $request->input('pa_ivl');
        $data->pa_dc = $request->input('pa_dc');
        $data->pa_vent = $request->input('pa_vent');
        $data->pa_iad = $request->input('pa_iad');
        $data->tirah_baring = $request->input('tirah_baring');
        $data->hais_plebitis = $request->input('hais_plebitis');
        $data->hais_isk = $request->input('hais_isk');
        $data->hais_vap = $request->input('hais_vap');
        $data->hais_iad = $request->input('hais_iad');
        $data->hais_deku = $request->input('hais_deku');
        $data->hais_hap = $request->input('hais_hap');
        $data->hais_ido = $request->input('hais_ido');
        $data->terpajan = $request->input('terpajan');
        $data->tgl_input = $request->input('tgl_input');
        $data->save();

        return redirect('/surveilans')->with('success', 'Data berhasil disimpan!');
    }

    public function update(Request $request, $id)
    {
        $surveilans = Surveilans::find($id);
        $input = $request->all();
        $surveilans->fill($input)->save();

        return redirect('/surveilans');
    }

    public function destroy($id)
    {
        $surveilans = Surveilans::find($id);
        $surveilans->delete();

        return redirect('/surveilans');
    }

    public function inputRekap(Request $request)
    {
        $tgl_skg = date('Y-m-d');

        $data = new Rekap();
        $data->dari = $request->input('dari') ?? $tgl_skg;
        $data->sampai = $request->input('sampai') ?? $tgl_skg;
        $data->analisa = $request->input('analisa');
        $data->tindak_lanjut = $request->input('tindak_lanjut');
        $data->save();

        return redirect('/rekapSurveilans')->with('success', 'Data berhasil disimpan!');
    }

    public function updateRekap(Request $request, $id)
    {
        $rekap = Rekap::find($id);
        $input = $request->all();
        $rekap->fill($input)->save();

        return redirect('/rekapSurveilans');
    }

    public function rekap(Request $request)
    {
        $tgl_skg = date('Y-m-d');
        // dd($tgl_skg);

        if ($request->input('dari') <= $request->input('sampai')) {
            $tabel = Surveilans::whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')->paginate(1000);
            // dd($tabel);

            $rekap = Rekap::whereDate('dari', '=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('sampai', '=', $request->input('sampai') ?? $tgl_skg)
                ->get();

            $analisa = Rekap::select('analisa')
                ->whereDate('dari', '=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('sampai', '=', $request->input('sampai') ?? $tgl_skg)
                ->get();

            $tindak_lanjut = Rekap::select('tindak_lanjut')
                ->whereDate('dari', '=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('sampai', '=', $request->input('sampai') ?? $tgl_skg)
                ->get();

            $int = Surveilans::where('unit', 'Intensif')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $icu = Surveilans::where('unit', 'ICU')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $picu = Surveilans::where('unit', 'PICU')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $nicu = Surveilans::where('unit', 'NICU')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $hcu = Surveilans::where('unit', 'HCU')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt2 = Surveilans::where('unit', 'Perawatan Eksekutif lt.2')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt4 = Surveilans::where('unit', 'Perawatan Reguler lt.4')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt5 = Surveilans::where('unit', 'Perawatan Reguler lt.5')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $vk = Surveilans::where('unit', 'VK')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();

            $int_pa_ivl = $int->sum('pa_ivl');
            $int_pa_dc = $int->sum('pa_dc');
            $int_pa_vent = $int->sum('pa_vent');
            $int_pa_iad = $int->sum('pa_iad');
            $int_hais_plebitis = $int->sum('hais_plebitis');
            $int_hais_isk = $int->sum('hais_isk');
            $int_hais_vap = $int->sum('hais_vap');
            $int_hais_iad = $int->sum('hais_iad');
            $int_hais_deku = $int->sum('hais_deku');
            $int_hais_hap = $int->sum('hais_hap');
            $int_hais_ido = $int->sum('hais_ido');
            $int_terpajan = $int->sum('terpajan');
            $int_tirah_baring = $int->sum('tirah_baring');

            $icu_pa_ivl = $icu->sum('pa_ivl');
            $icu_pa_dc = $icu->sum('pa_dc');
            $icu_pa_vent = $icu->sum('pa_vent');
            $icu_pa_iad = $icu->sum('pa_iad');
            $icu_hais_plebitis = $icu->sum('hais_plebitis');
            $icu_hais_isk = $icu->sum('hais_isk');
            $icu_hais_vap = $icu->sum('hais_vap');
            $icu_hais_iad = $icu->sum('hais_iad');
            $icu_hais_deku = $icu->sum('hais_deku');
            $icu_hais_hap = $icu->sum('hais_hap');
            $icu_hais_ido = $icu->sum('hais_ido');
            $icu_terpajan = $icu->sum('terpajan');
            $icu_tirah_baring = $icu->sum('tirah_baring');

            $picu_pa_ivl = $picu->sum('pa_ivl');
            $picu_pa_dc = $picu->sum('pa_dc');
            $picu_pa_vent = $picu->sum('pa_vent');
            $picu_pa_iad = $picu->sum('pa_iad');
            $picu_hais_plebitis = $picu->sum('hais_plebitis');
            $picu_hais_isk = $picu->sum('hais_isk');
            $picu_hais_vap = $picu->sum('hais_vap');
            $picu_hais_iad = $picu->sum('hais_iad');
            $picu_hais_deku = $picu->sum('hais_deku');
            $picu_hais_hap = $picu->sum('hais_hap');
            $picu_hais_ido = $picu->sum('hais_ido');
            $picu_terpajan = $picu->sum('terpajan');
            $picu_tirah_baring = $picu->sum('tirah_baring');

            $nicu_pa_ivl = $nicu->sum('pa_ivl');
            $nicu_pa_dc = $nicu->sum('pa_dc');
            $nicu_pa_vent = $nicu->sum('pa_vent');
            $nicu_pa_iad = $nicu->sum('pa_iad');
            $nicu_hais_plebitis = $nicu->sum('hais_plebitis');
            $nicu_hais_isk = $nicu->sum('hais_isk');
            $nicu_hais_vap = $nicu->sum('hais_vap');
            $nicu_hais_iad = $nicu->sum('hais_iad');
            $nicu_hais_deku = $nicu->sum('hais_deku');
            $nicu_hais_hap = $nicu->sum('hais_hap');
            $nicu_hais_ido = $nicu->sum('hais_ido');
            $nicu_terpajan = $nicu->sum('terpajan');
            $nicu_tirah_baring = $nicu->sum('tirah_baring');

            $hcu_pa_ivl = $hcu->sum('pa_ivl');
            $hcu_pa_dc = $hcu->sum('pa_dc');
            $hcu_pa_vent = $hcu->sum('pa_vent');
            $hcu_pa_iad = $hcu->sum('pa_iad');
            $hcu_hais_plebitis = $hcu->sum('hais_plebitis');
            $hcu_hais_isk = $hcu->sum('hais_isk');
            $hcu_hais_vap = $hcu->sum('hais_vap');
            $hcu_hais_iad = $hcu->sum('hais_iad');
            $hcu_hais_deku = $hcu->sum('hais_deku');
            $hcu_hais_hap = $hcu->sum('hais_hap');
            $hcu_hais_ido = $hcu->sum('hais_ido');
            $hcu_terpajan = $hcu->sum('terpajan');
            $hcu_tirah_baring = $hcu->sum('tirah_baring');

            $lt2_pa_ivl = $lt2->sum('pa_ivl');
            $lt2_pa_dc = $lt2->sum('pa_dc');
            $lt2_pa_vent = $lt2->sum('pa_vent');
            $lt2_pa_iad = $lt2->sum('pa_iad');
            $lt2_hais_plebitis = $lt2->sum('hais_plebitis');
            $lt2_hais_isk = $lt2->sum('hais_isk');
            $lt2_hais_vap = $lt2->sum('hais_vap');
            $lt2_hais_iad = $lt2->sum('hais_iad');
            $lt2_hais_deku = $lt2->sum('hais_deku');
            $lt2_hais_hap = $lt2->sum('hais_hap');
            $lt2_hais_ido = $lt2->sum('hais_ido');
            $lt2_terpajan = $lt2->sum('terpajan');
            $lt2_tirah_baring = $lt2->sum('tirah_baring');

            $lt4_pa_ivl = $lt4->sum('pa_ivl');
            $lt4_pa_dc = $lt4->sum('pa_dc');
            $lt4_pa_vent = $lt4->sum('pa_vent');
            $lt4_pa_iad = $lt4->sum('pa_iad');
            $lt4_hais_plebitis = $lt4->sum('hais_plebitis');
            $lt4_hais_isk = $lt4->sum('hais_isk');
            $lt4_hais_vap = $lt4->sum('hais_vap');
            $lt4_hais_iad = $lt4->sum('hais_iad');
            $lt4_hais_deku = $lt4->sum('hais_deku');
            $lt4_hais_hap = $lt4->sum('hais_hap');
            $lt4_hais_ido = $lt4->sum('hais_ido');
            $lt4_terpajan = $lt4->sum('terpajan');
            $lt4_tirah_baring = $lt4->sum('tirah_baring');

            $lt5_pa_ivl = $lt5->sum('pa_ivl');
            $lt5_pa_dc = $lt5->sum('pa_dc');
            $lt5_pa_vent = $lt5->sum('pa_vent');
            $lt5_pa_iad = $lt5->sum('pa_iad');
            $lt5_hais_plebitis = $lt5->sum('hais_plebitis');
            $lt5_hais_isk = $lt5->sum('hais_isk');
            $lt5_hais_vap = $lt5->sum('hais_vap');
            $lt5_hais_iad = $lt5->sum('hais_iad');
            $lt5_hais_deku = $lt5->sum('hais_deku');
            $lt5_hais_hap = $lt5->sum('hais_hap');
            $lt5_hais_ido = $lt5->sum('hais_ido');
            $lt5_terpajan = $lt5->sum('terpajan');
            $lt5_tirah_baring = $lt5->sum('tirah_baring');

            $vk_pa_ivl = $vk->sum('pa_ivl');
            $vk_pa_dc = $vk->sum('pa_dc');
            $vk_pa_vent = $vk->sum('pa_vent');
            $vk_pa_iad = $vk->sum('pa_iad');
            $vk_hais_plebitis = $vk->sum('hais_plebitis');
            $vk_hais_isk = $vk->sum('hais_isk');
            $vk_hais_vap = $vk->sum('hais_vap');
            $vk_hais_iad = $vk->sum('hais_iad');
            $vk_hais_deku = $vk->sum('hais_deku');
            $vk_hais_hap = $vk->sum('hais_hap');
            $vk_hais_ido = $vk->sum('hais_ido');
            $vk_terpajan = $vk->sum('terpajan');
            $vk_tirah_baring = $vk->sum('tirah_baring');

            return view('rekapSurveilans.index', compact(
                'tabel',
                'rekap',
                'analisa',
                'tindak_lanjut',

                'int_pa_ivl',
                'int_pa_dc',
                'int_pa_vent',
                'int_pa_iad',
                'int_hais_plebitis',
                'int_hais_isk',
                'int_hais_vap',
                'int_hais_iad',
                'int_hais_deku',
                'int_hais_hap',
                'int_hais_ido',
                'int_terpajan',
                'int_tirah_baring',

                'icu_pa_ivl',
                'icu_pa_dc',
                'icu_pa_vent',
                'icu_pa_iad',
                'icu_hais_plebitis',
                'icu_hais_isk',
                'icu_hais_vap',
                'icu_hais_iad',
                'icu_hais_deku',
                'icu_hais_hap',
                'icu_hais_ido',
                'icu_terpajan',
                'icu_tirah_baring',

                'picu_pa_ivl',
                'picu_pa_dc',
                'picu_pa_vent',
                'picu_pa_iad',
                'picu_hais_plebitis',
                'picu_hais_isk',
                'picu_hais_vap',
                'picu_hais_iad',
                'picu_hais_deku',
                'picu_hais_hap',
                'picu_hais_ido',
                'picu_terpajan',
                'picu_tirah_baring',

                'nicu_pa_ivl',
                'nicu_pa_dc',
                'nicu_pa_vent',
                'nicu_pa_iad',
                'nicu_hais_plebitis',
                'nicu_hais_isk',
                'nicu_hais_vap',
                'nicu_hais_iad',
                'nicu_hais_deku',
                'nicu_hais_hap',
                'nicu_hais_ido',
                'nicu_terpajan',
                'nicu_tirah_baring',

                'hcu_pa_ivl',
                'hcu_pa_dc',
                'hcu_pa_vent',
                'hcu_pa_iad',
                'hcu_hais_plebitis',
                'hcu_hais_isk',
                'hcu_hais_vap',
                'hcu_hais_iad',
                'hcu_hais_deku',
                'hcu_hais_hap',
                'hcu_hais_ido',
                'hcu_terpajan',
                'hcu_tirah_baring',

                'lt2_pa_ivl',
                'lt2_pa_dc',
                'lt2_pa_vent',
                'lt2_pa_iad',
                'lt2_hais_plebitis',
                'lt2_hais_isk',
                'lt2_hais_vap',
                'lt2_hais_iad',
                'lt2_hais_deku',
                'lt2_hais_hap',
                'lt2_hais_ido',
                'lt2_terpajan',
                'lt2_tirah_baring',

                'lt4_pa_ivl',
                'lt4_pa_dc',
                'lt4_pa_vent',
                'lt4_pa_iad',
                'lt4_hais_plebitis',
                'lt4_hais_isk',
                'lt4_hais_vap',
                'lt4_hais_iad',
                'lt4_hais_deku',
                'lt4_hais_hap',
                'lt4_hais_ido',
                'lt4_terpajan',
                'lt4_tirah_baring',

                'lt5_pa_ivl',
                'lt5_pa_dc',
                'lt5_pa_vent',
                'lt5_pa_iad',
                'lt5_hais_plebitis',
                'lt5_hais_isk',
                'lt5_hais_vap',
                'lt5_hais_iad',
                'lt5_hais_deku',
                'lt5_hais_hap',
                'lt5_hais_ido',
                'lt5_terpajan',
                'lt5_tirah_baring',

                'vk_pa_ivl',
                'vk_pa_dc',
                'vk_pa_vent',
                'vk_pa_iad',
                'vk_hais_plebitis',
                'vk_hais_isk',
                'vk_hais_vap',
                'vk_hais_iad',
                'vk_hais_deku',
                'vk_hais_hap',
                'vk_hais_ido',
                'vk_terpajan',
                'vk_tirah_baring',
            ));
        } else {
            return Redirect::back()->withErrors(['msg' => 'Tanggal tidak boleh Lebih kecil dari sebelumnya']);
        }
    }

    public function excel(Request $request)
    {
        $tgl_skg = date('Y-m-d');
        // dd($tgl_skg);

        if ($request->input('dari') <= $request->input('sampai')) {
            $tabel = Surveilans::whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')->paginate(1000);
            // dd($tabel);

            $rekap = Rekap::whereDate('dari', '=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('sampai', '=', $request->input('sampai') ?? $tgl_skg)
                ->get();

            $int = Surveilans::where('unit', 'Intensif')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt2 = Surveilans::where('unit', 'Perawatan Eksekutif lt.2')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt4 = Surveilans::where('unit', 'Perawatan Reguler lt.4')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt5 = Surveilans::where('unit', 'Perawatan Reguler lt.5')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $vk = Surveilans::where('unit', 'VK')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();

            $int_pa_ivl = $int->sum('pa_ivl');
            $int_pa_dc = $int->sum('pa_dc');
            $int_pa_vent = $int->sum('pa_vent');
            $int_pa_iad = $int->sum('pa_iad');
            $int_hais_plebitis = $int->sum('hais_plebitis');
            $int_hais_isk = $int->sum('hais_isk');
            $int_hais_vap = $int->sum('hais_vap');
            $int_hais_iad = $int->sum('hais_iad');
            $int_hais_deku = $int->sum('hais_deku');
            $int_hais_hap = $int->sum('hais_hap');
            $int_hais_ido = $int->sum('hais_ido');
            $int_terpajan = $int->sum('terpajan');
            $int_tirah_baring = $int->sum('tirah_baring');

            $lt2_pa_ivl = $lt2->sum('pa_ivl');
            $lt2_pa_dc = $lt2->sum('pa_dc');
            $lt2_pa_vent = $lt2->sum('pa_vent');
            $lt2_pa_iad = $lt2->sum('pa_iad');
            $lt2_hais_plebitis = $lt2->sum('hais_plebitis');
            $lt2_hais_isk = $lt2->sum('hais_isk');
            $lt2_hais_vap = $lt2->sum('hais_vap');
            $lt2_hais_iad = $lt2->sum('hais_iad');
            $lt2_hais_deku = $lt2->sum('hais_deku');
            $lt2_hais_hap = $lt2->sum('hais_hap');
            $lt2_hais_ido = $lt2->sum('hais_ido');
            $lt2_terpajan = $lt2->sum('terpajan');
            $lt2_tirah_baring = $int->sum('tirah_baring');

            $lt4_pa_ivl = $lt4->sum('pa_ivl');
            $lt4_pa_dc = $lt4->sum('pa_dc');
            $lt4_pa_vent = $lt4->sum('pa_vent');
            $lt4_pa_iad = $lt4->sum('pa_iad');
            $lt4_hais_plebitis = $lt4->sum('hais_plebitis');
            $lt4_hais_isk = $lt4->sum('hais_isk');
            $lt4_hais_vap = $lt4->sum('hais_vap');
            $lt4_hais_iad = $lt4->sum('hais_iad');
            $lt4_hais_deku = $lt4->sum('hais_deku');
            $lt4_hais_hap = $lt4->sum('hais_hap');
            $lt4_hais_ido = $lt4->sum('hais_ido');
            $lt4_terpajan = $lt4->sum('terpajan');
            $lt4_tirah_baring = $int->sum('tirah_baring');

            $lt5_pa_ivl = $lt5->sum('pa_ivl');
            $lt5_pa_dc = $lt5->sum('pa_dc');
            $lt5_pa_vent = $lt5->sum('pa_vent');
            $lt5_pa_iad = $lt5->sum('pa_iad');
            $lt5_hais_plebitis = $lt5->sum('hais_plebitis');
            $lt5_hais_isk = $lt5->sum('hais_isk');
            $lt5_hais_vap = $lt5->sum('hais_vap');
            $lt5_hais_iad = $lt5->sum('hais_iad');
            $lt5_hais_deku = $lt5->sum('hais_deku');
            $lt5_hais_hap = $lt5->sum('hais_hap');
            $lt5_hais_ido = $lt5->sum('hais_ido');
            $lt5_terpajan = $lt5->sum('terpajan');
            $lt5_tirah_baring = $int->sum('tirah_baring');

            $vk_pa_ivl = $vk->sum('pa_ivl');
            $vk_pa_dc = $vk->sum('pa_dc');
            $vk_pa_vent = $vk->sum('pa_vent');
            $vk_pa_iad = $vk->sum('pa_iad');
            $vk_hais_plebitis = $vk->sum('hais_plebitis');
            $vk_hais_isk = $vk->sum('hais_isk');
            $vk_hais_vap = $vk->sum('hais_vap');
            $vk_hais_iad = $vk->sum('hais_iad');
            $vk_hais_deku = $vk->sum('hais_deku');
            $vk_hais_hap = $vk->sum('hais_hap');
            $vk_hais_ido = $vk->sum('hais_ido');
            $vk_terpajan = $vk->sum('terpajan');
            $vk_tirah_baring = $int->sum('tirah_baring');

            $tanggal = Carbon::parse($request->input('dari'))->isoFormat('DD MMMM YYYY') . ' - ' . Carbon::parse($request->input('sampai'))->isoFormat('DD MMMM YYYY');

            return Excel::download(new ExportExcel(
                $int_pa_ivl,
                $int_pa_dc,
                $int_pa_vent,
                $int_pa_iad,
                $int_hais_plebitis,
                $int_hais_isk,
                $int_hais_vap,
                $int_hais_iad,
                $int_hais_deku,
                $int_hais_hap,
                $int_hais_ido,
                $int_terpajan,
                $int_tirah_baring,

                $lt2_pa_ivl,
                $lt2_pa_dc,
                $lt2_pa_vent,
                $lt2_pa_iad,
                $lt2_hais_plebitis,
                $lt2_hais_isk,
                $lt2_hais_vap,
                $lt2_hais_iad,
                $lt2_hais_deku,
                $lt2_hais_hap,
                $lt2_hais_ido,
                $lt2_terpajan,
                $lt2_tirah_baring,

                $lt4_pa_ivl,
                $lt4_pa_dc,
                $lt4_pa_vent,
                $lt4_pa_iad,
                $lt4_hais_plebitis,
                $lt4_hais_isk,
                $lt4_hais_vap,
                $lt4_hais_iad,
                $lt4_hais_deku,
                $lt4_hais_hap,
                $lt4_hais_ido,
                $lt4_terpajan,
                $lt4_tirah_baring,

                $lt5_pa_ivl,
                $lt5_pa_dc,
                $lt5_pa_vent,
                $lt5_pa_iad,
                $lt5_hais_plebitis,
                $lt5_hais_isk,
                $lt5_hais_vap,
                $lt5_hais_iad,
                $lt5_hais_deku,
                $lt5_hais_hap,
                $lt5_hais_ido,
                $lt5_terpajan,
                $lt5_tirah_baring,

                $vk_pa_ivl,
                $vk_pa_dc,
                $vk_pa_vent,
                $vk_pa_iad,
                $vk_hais_plebitis,
                $vk_hais_isk,
                $vk_hais_vap,
                $vk_hais_iad,
                $vk_hais_deku,
                $vk_hais_hap,
                $vk_hais_ido,
                $vk_terpajan,
                $vk_tirah_baring,

                $tabel,
                $rekap,
                $tanggal
            ), 'Rekap Surveilans ' . $tanggal . '.xlsx');
        } else {
            return Redirect::back()->withErrors(['msg' => 'Tanggal tidak boleh Lebih kecil dari sebelumnya']);
        }
    }

    // public function excelDetail(Request $request)
    // { 
    //     $tgl_skg = date('Y-m-d');
    //     // dd($tgl_skg);

    //     if ($request->input('dari') <= $request->input('sampai')) {
    //         $tabel = Surveilans::whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
    //             ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
    //             ->latest('id')->paginate(1000);
    //         // dd($tabel);
    //         $tanggal = Carbon::parse($request->input('dari'))->isoFormat('DD MMMM YYYY') . ' - ' . Carbon::parse($request->input('sampai'))->isoFormat('DD MMMM YYYY');

    //         return Excel::download(new detailRekapExcel(
    //             $tabel,
    //             $tanggal
    //         ), 'Rekap Surveilans ' . $tanggal . '.xlsx');
    //     } else {
    //         return Redirect::back()->withErrors(['msg' => 'Tanggal tidak boleh Lebih kecil dari sebelumnya']);
    //     }
    // }

    public function pdf(Request $request)
    {
        $tgl_skg = date('Y-m-d');
        // dd($tgl_skg);

        if ($request->input('dari') <= $request->input('sampai')) {
            $tabel = Surveilans::whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')->paginate(1000);
            // dd($tabel);

            $rekap = Rekap::whereDate('dari', '=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('sampai', '=', $request->input('sampai') ?? $tgl_skg)
                ->get();

            $int = Surveilans::where('unit', 'Intensif')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt2 = Surveilans::where('unit', 'Perawatan Eksekutif lt.2')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt4 = Surveilans::where('unit', 'Perawatan Reguler lt.4')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt5 = Surveilans::where('unit', 'Perawatan Reguler lt.5')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $vk = Surveilans::where('unit', 'VK')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();

            $int_pa_ivl = $int->sum('pa_ivl');
            $int_pa_dc = $int->sum('pa_dc');
            $int_pa_vent = $int->sum('pa_vent');
            $int_pa_iad = $int->sum('pa_iad');
            $int_hais_plebitis = $int->sum('hais_plebitis');
            $int_hais_isk = $int->sum('hais_isk');
            $int_hais_vap = $int->sum('hais_vap');
            $int_hais_iad = $int->sum('hais_iad');
            $int_hais_deku = $int->sum('hais_deku');
            $int_hais_hap = $int->sum('hais_hap');
            $int_hais_ido = $int->sum('hais_ido');
            $int_terpajan = $int->sum('terpajan');
            $int_tirah_baring = $int->sum('tirah_baring');

            $lt2_pa_ivl = $lt2->sum('pa_ivl');
            $lt2_pa_dc = $lt2->sum('pa_dc');
            $lt2_pa_vent = $lt2->sum('pa_vent');
            $lt2_pa_iad = $lt2->sum('pa_iad');
            $lt2_hais_plebitis = $lt2->sum('hais_plebitis');
            $lt2_hais_isk = $lt2->sum('hais_isk');
            $lt2_hais_vap = $lt2->sum('hais_vap');
            $lt2_hais_iad = $lt2->sum('hais_iad');
            $lt2_hais_deku = $lt2->sum('hais_deku');
            $lt2_hais_hap = $lt2->sum('hais_hap');
            $lt2_hais_ido = $lt2->sum('hais_ido');
            $lt2_terpajan = $lt2->sum('terpajan');
            $lt2_tirah_baring = $int->sum('tirah_baring');

            $lt4_pa_ivl = $lt4->sum('pa_ivl');
            $lt4_pa_dc = $lt4->sum('pa_dc');
            $lt4_pa_vent = $lt4->sum('pa_vent');
            $lt4_pa_iad = $lt4->sum('pa_iad');
            $lt4_hais_plebitis = $lt4->sum('hais_plebitis');
            $lt4_hais_isk = $lt4->sum('hais_isk');
            $lt4_hais_vap = $lt4->sum('hais_vap');
            $lt4_hais_iad = $lt4->sum('hais_iad');
            $lt4_hais_deku = $lt4->sum('hais_deku');
            $lt4_hais_hap = $lt4->sum('hais_hap');
            $lt4_hais_ido = $lt4->sum('hais_ido');
            $lt4_terpajan = $lt4->sum('terpajan');
            $lt4_tirah_baring = $int->sum('tirah_baring');

            $lt5_pa_ivl = $lt5->sum('pa_ivl');
            $lt5_pa_dc = $lt5->sum('pa_dc');
            $lt5_pa_vent = $lt5->sum('pa_vent');
            $lt5_pa_iad = $lt5->sum('pa_iad');
            $lt5_hais_plebitis = $lt5->sum('hais_plebitis');
            $lt5_hais_isk = $lt5->sum('hais_isk');
            $lt5_hais_vap = $lt5->sum('hais_vap');
            $lt5_hais_iad = $lt5->sum('hais_iad');
            $lt5_hais_deku = $lt5->sum('hais_deku');
            $lt5_hais_hap = $lt5->sum('hais_hap');
            $lt5_hais_ido = $lt5->sum('hais_ido');
            $lt5_terpajan = $lt5->sum('terpajan');
            $lt5_tirah_baring = $int->sum('tirah_baring');

            $vk_pa_ivl = $vk->sum('pa_ivl');
            $vk_pa_dc = $vk->sum('pa_dc');
            $vk_pa_vent = $vk->sum('pa_vent');
            $vk_pa_iad = $vk->sum('pa_iad');
            $vk_hais_plebitis = $vk->sum('hais_plebitis');
            $vk_hais_isk = $vk->sum('hais_isk');
            $vk_hais_vap = $vk->sum('hais_vap');
            $vk_hais_iad = $vk->sum('hais_iad');
            $vk_hais_deku = $vk->sum('hais_deku');
            $vk_hais_hap = $vk->sum('hais_hap');
            $vk_hais_ido = $vk->sum('hais_ido');
            $vk_terpajan = $vk->sum('terpajan');
            $vk_tirah_baring = $int->sum('tirah_baring');

            $tanggal = Carbon::parse($request->input('dari'))->isoFormat('DD MMMM YYYY') . ' - ' . Carbon::parse($request->input('sampai'))->isoFormat('DD MMMM YYYY');

            return Excel::download(new ExportExcel(
                $int_pa_ivl,
                $int_pa_dc,
                $int_pa_vent,
                $int_pa_iad,
                $int_hais_plebitis,
                $int_hais_isk,
                $int_hais_vap,
                $int_hais_iad,
                $int_hais_deku,
                $int_hais_hap,
                $int_hais_ido,
                $int_terpajan,
                $int_tirah_baring,

                $lt2_pa_ivl,
                $lt2_pa_dc,
                $lt2_pa_vent,
                $lt2_pa_iad,
                $lt2_hais_plebitis,
                $lt2_hais_isk,
                $lt2_hais_vap,
                $lt2_hais_iad,
                $lt2_hais_deku,
                $lt2_hais_hap,
                $lt2_hais_ido,
                $lt2_terpajan,
                $lt2_tirah_baring,

                $lt4_pa_ivl,
                $lt4_pa_dc,
                $lt4_pa_vent,
                $lt4_pa_iad,
                $lt4_hais_plebitis,
                $lt4_hais_isk,
                $lt4_hais_vap,
                $lt4_hais_iad,
                $lt4_hais_deku,
                $lt4_hais_hap,
                $lt4_hais_ido,
                $lt4_terpajan,
                $lt4_tirah_baring,

                $lt5_pa_ivl,
                $lt5_pa_dc,
                $lt5_pa_vent,
                $lt5_pa_iad,
                $lt5_hais_plebitis,
                $lt5_hais_isk,
                $lt5_hais_vap,
                $lt5_hais_iad,
                $lt5_hais_deku,
                $lt5_hais_hap,
                $lt5_hais_ido,
                $lt5_terpajan,
                $lt5_tirah_baring,

                $vk_pa_ivl,
                $vk_pa_dc,
                $vk_pa_vent,
                $vk_pa_iad,
                $vk_hais_plebitis,
                $vk_hais_isk,
                $vk_hais_vap,
                $vk_hais_iad,
                $vk_hais_deku,
                $vk_hais_hap,
                $vk_hais_ido,
                $vk_terpajan,
                $vk_tirah_baring,

                $tabel,
                $rekap,
                $tanggal
            ), 'Rekap Surveilans ' . $tanggal . '.pdf', \Maatwebsite\Excel\Excel::MPDF);
        } else {
            return Redirect::back()->withErrors(['msg' => 'Tanggal tidak boleh Lebih kecil dari sebelumnya']);
        }
    }
}
