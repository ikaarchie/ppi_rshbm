<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Exports\ExportApd;
use App\Models\Apd;
use Illuminate\Http\Request;
use App\Models\RekapApd;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

class ApdController extends Controller
{
    public function index()
    {
        return view('apd.index');
    }

    public function getData()
    {
        $apd = Apd::latest('id')->paginate(1000);

        return view('apd.index')->with('apd', $apd);
    }

    public function save(Request $request)
    {
        $data = new Apd();
        $data->nama = $request->input('nama');
        $data->unit = $request->input('unit');
        $data->tgl_input = $request->input('tgl_input');
        $data->pntp_kpl = $request->input('pntp_kpl');
        $data->masker = $request->input('masker');
        $data->pntp_wjh = $request->input('pntp_wjh');
        $data->apron = $request->input('apron');
        $data->srg_tgn = $request->input('srg_tgn');
        $data->alas_kaki = $request->input('alas_kaki');
        $data->lps_apd = $request->input('lps_apd');
        $data->tdk_gtg_masker = $request->input('tdk_gtg_masker');
        $data->tdk_guna_srg_tgn = $request->input('tdk_guna_srg_tgn');
        $data->save();

        return redirect('/apd')->with('success', 'Data berhasil disimpan!');
    }

    public function update(Request $request, $id)
    {
        $apd = Apd::find($id);
        $input = $request->all();
        $apd->fill($input)->save();

        return redirect('/apd');
    }

    public function destroy($id)
    {
        $apd = Apd::find($id);
        $apd->delete();

        return redirect('/apd');
    }

    public function inputRekap(Request $request)
    {
        $tgl_skg = date('Y-m-d');

        $data = new RekapApd();
        $data->dari = $request->input('dari') ?? $tgl_skg;
        $data->sampai = $request->input('sampai') ?? $tgl_skg;
        $data->analisa = $request->input('analisa');
        $data->tindak_lanjut = $request->input('tindak_lanjut');
        $data->save();

        return redirect('/rekapAPD')->with('success', 'Data berhasil disimpan!');
    }

    public function updateRekap(Request $request, $id)
    {
        $rekap = RekapApd::find($id);
        $input = $request->all();
        $rekap->fill($input)->save();

        return redirect('/rekapAPD');
    }

    public function rekap(Request $request)
    {
        $tgl_skg = date('Y-m-d');
        $dari = date_create($request->input('dari'));
        $sampai = date_create($request->input('sampai'));
        $diff  = date_diff($dari, $sampai);
        $range_tgl = $diff->d + 1;

        if ($request->input('dari') <= $request->input('sampai')) {
            $tabel = Apd::whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')->paginate(1000);
            // dd($tabel);

            $rekap = RekapApd::whereDate('dari', '=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('sampai', '=', $request->input('sampai') ?? $tgl_skg)
                ->get();

            $analisa = RekapApd::select('analisa')
                ->whereDate('dari', '=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('sampai', '=', $request->input('sampai') ?? $tgl_skg)
                ->get();

            $tindak_lanjut = RekapApd::select('tindak_lanjut')
                ->whereDate('dari', '=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('sampai', '=', $request->input('sampai') ?? $tgl_skg)
                ->get();

            $cssu = Apd::where('unit', 'CSSU')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $dapur = Apd::where('unit', 'Dapur')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $dpjp = Apd::where('unit', 'DPJP')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $farmasi = Apd::where('unit', 'Farmasi')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $igd = Apd::where('unit', 'IGD')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $int = Apd::where('unit', 'Intensif')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $kbbl = Apd::where('unit', 'KBBL')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lab = Apd::where('unit', 'Laboratorium')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $laundry = Apd::where('unit', 'Laundry')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $ok = Apd::where('unit', 'OK')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt2 = Apd::where('unit', 'Perawatan Eksekutif lt.2')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt4 = Apd::where('unit', 'Perawatan Reguler lt.4')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt5 = Apd::where('unit', 'Perawatan Reguler lt.5')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $poli = Apd::where('unit', 'Poliklinik')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $rad = Apd::where('unit', 'Radiologi')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $vk = Apd::where('unit', 'VK')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();

            $cssu_pntp_kpl = $cssu->where('pntp_kpl', '1')->count();
            $cssu_masker = $cssu->where('masker', '1')->count();
            $cssu_pntp_wjh = $cssu->where('pntp_wjh', '1')->count();
            $cssu_apron = $cssu->where('apron', '1')->count();
            $cssu_srg_tgn = $cssu->where('srg_tgn', '1')->count();
            $cssu_alas_kaki = $cssu->where('alas_kaki', '1')->count();
            $cssu_lps_apd = $cssu->where('lps_apd', '1')->count();
            $cssu_tdk_gtg_masker = $cssu->where('tdk_gtg_masker', '1')->count();
            $cssu_tdk_guna_srg_tgn = $cssu->where('tdk_guna_srg_tgn', '1')->count();
            $cssu_jumlah = $cssu_pntp_kpl + $cssu_masker + $cssu_pntp_wjh + $cssu_apron + $cssu_srg_tgn + $cssu_alas_kaki + $cssu_lps_apd + $cssu_tdk_gtg_masker + $cssu_tdk_guna_srg_tgn;

            $no_cssu_pntp_kpl = $cssu->where('pntp_kpl', '0')->count();
            $no_cssu_masker = $cssu->where('masker', '0')->count();
            $no_cssu_pntp_wjh = $cssu->where('pntp_wjh', '0')->count();
            $no_cssu_apron = $cssu->where('apron', '0')->count();
            $no_cssu_srg_tgn = $cssu->where('srg_tgn', '0')->count();
            $no_cssu_alas_kaki = $cssu->where('alas_kaki', '0')->count();
            $no_cssu_lps_apd = $cssu->where('lps_apd', '0')->count();
            $no_cssu_tdk_gtg_masker = $cssu->where('tdk_gtg_masker', '0')->count();
            $no_cssu_tdk_guna_srg_tgn = $cssu->where('tdk_guna_srg_tgn', '0')->count();
            $no_cssu_jumlah = $no_cssu_pntp_kpl + $no_cssu_masker + $no_cssu_pntp_wjh + $no_cssu_apron + $no_cssu_srg_tgn + $no_cssu_alas_kaki + $no_cssu_lps_apd + $no_cssu_tdk_gtg_masker + $no_cssu_tdk_guna_srg_tgn;

            $denominator_cssu = $cssu_jumlah + $no_cssu_jumlah;

            $dapur_pntp_kpl = $dapur->where('pntp_kpl', '1')->count();
            $dapur_masker = $dapur->where('masker', '1')->count();
            $dapur_pntp_wjh = $dapur->where('pntp_wjh', '1')->count();
            $dapur_apron = $dapur->where('apron', '1')->count();
            $dapur_srg_tgn = $dapur->where('srg_tgn', '1')->count();
            $dapur_alas_kaki = $dapur->where('alas_kaki', '1')->count();
            $dapur_lps_apd = $dapur->where('lps_apd', '1')->count();
            $dapur_tdk_gtg_masker = $dapur->where('tdk_gtg_masker', '1')->count();
            $dapur_tdk_guna_srg_tgn = $dapur->where('tdk_guna_srg_tgn', '1')->count();
            $dapur_jumlah = $dapur_pntp_kpl + $dapur_masker + $dapur_pntp_wjh + $dapur_apron + $dapur_srg_tgn + $dapur_alas_kaki + $dapur_lps_apd + $dapur_tdk_gtg_masker + $dapur_tdk_guna_srg_tgn;

            $no_dapur_pntp_kpl = $dapur->where('pntp_kpl', '0')->count();
            $no_dapur_masker = $dapur->where('masker', '0')->count();
            $no_dapur_pntp_wjh = $dapur->where('pntp_wjh', '0')->count();
            $no_dapur_apron = $dapur->where('apron', '0')->count();
            $no_dapur_srg_tgn = $dapur->where('srg_tgn', '0')->count();
            $no_dapur_alas_kaki = $dapur->where('alas_kaki', '0')->count();
            $no_dapur_lps_apd = $dapur->where('lps_apd', '0')->count();
            $no_dapur_tdk_gtg_masker = $dapur->where('tdk_gtg_masker', '0')->count();
            $no_dapur_tdk_guna_srg_tgn = $dapur->where('tdk_guna_srg_tgn', '0')->count();
            $no_dapur_jumlah = $no_dapur_pntp_kpl + $no_dapur_masker + $no_dapur_pntp_wjh + $no_dapur_apron + $no_dapur_srg_tgn + $no_dapur_alas_kaki + $no_dapur_lps_apd + $no_dapur_tdk_gtg_masker + $no_dapur_tdk_guna_srg_tgn;

            $denominator_dapur = $dapur_jumlah + $no_dapur_jumlah;

            $dpjp_pntp_kpl = $dpjp->where('pntp_kpl', '1')->count();
            $dpjp_masker = $dpjp->where('masker', '1')->count();
            $dpjp_pntp_wjh = $dpjp->where('pntp_wjh', '1')->count();
            $dpjp_apron = $dpjp->where('apron', '1')->count();
            $dpjp_srg_tgn = $dpjp->where('srg_tgn', '1')->count();
            $dpjp_alas_kaki = $dpjp->where('alas_kaki', '1')->count();
            $dpjp_lps_apd = $dpjp->where('lps_apd', '1')->count();
            $dpjp_tdk_gtg_masker = $dpjp->where('tdk_gtg_masker', '1')->count();
            $dpjp_tdk_guna_srg_tgn = $dpjp->where('tdk_guna_srg_tgn', '1')->count();
            $dpjp_jumlah = $dpjp_pntp_kpl + $dpjp_masker + $dpjp_pntp_wjh + $dpjp_apron + $dpjp_srg_tgn + $dpjp_alas_kaki + $dpjp_lps_apd + $dpjp_tdk_gtg_masker + $dpjp_tdk_guna_srg_tgn;

            $no_dpjp_pntp_kpl = $dpjp->where('pntp_kpl', '0')->count();
            $no_dpjp_masker = $dpjp->where('masker', '0')->count();
            $no_dpjp_pntp_wjh = $dpjp->where('pntp_wjh', '0')->count();
            $no_dpjp_apron = $dpjp->where('apron', '0')->count();
            $no_dpjp_srg_tgn = $dpjp->where('srg_tgn', '0')->count();
            $no_dpjp_alas_kaki = $dpjp->where('alas_kaki', '0')->count();
            $no_dpjp_lps_apd = $dpjp->where('lps_apd', '0')->count();
            $no_dpjp_tdk_gtg_masker = $dpjp->where('tdk_gtg_masker', '0')->count();
            $no_dpjp_tdk_guna_srg_tgn = $dpjp->where('tdk_guna_srg_tgn', '0')->count();
            $no_dpjp_jumlah = $no_dpjp_pntp_kpl + $no_dpjp_masker + $no_dpjp_pntp_wjh + $no_dpjp_apron + $no_dpjp_srg_tgn + $no_dpjp_alas_kaki + $no_dpjp_lps_apd + $no_dpjp_tdk_gtg_masker + $no_dpjp_tdk_guna_srg_tgn;

            $denominator_dpjp = $dpjp_jumlah + $no_dpjp_jumlah;

            $farmasi_pntp_kpl = $farmasi->where('pntp_kpl', '1')->count();
            $farmasi_masker = $farmasi->where('masker', '1')->count();
            $farmasi_pntp_wjh = $farmasi->where('pntp_wjh', '1')->count();
            $farmasi_apron = $farmasi->where('apron', '1')->count();
            $farmasi_srg_tgn = $farmasi->where('srg_tgn', '1')->count();
            $farmasi_alas_kaki = $farmasi->where('alas_kaki', '1')->count();
            $farmasi_lps_apd = $farmasi->where('lps_apd', '1')->count();
            $farmasi_tdk_gtg_masker = $farmasi->where('tdk_gtg_masker', '1')->count();
            $farmasi_tdk_guna_srg_tgn = $farmasi->where('tdk_guna_srg_tgn', '1')->count();
            $farmasi_jumlah = $farmasi_pntp_kpl + $farmasi_masker + $farmasi_pntp_wjh + $farmasi_apron + $farmasi_srg_tgn + $farmasi_alas_kaki + $farmasi_lps_apd + $farmasi_tdk_gtg_masker + $farmasi_tdk_guna_srg_tgn;

            $no_farmasi_pntp_kpl = $farmasi->where('pntp_kpl', '0')->count();
            $no_farmasi_masker = $farmasi->where('masker', '0')->count();
            $no_farmasi_pntp_wjh = $farmasi->where('pntp_wjh', '0')->count();
            $no_farmasi_apron = $farmasi->where('apron', '0')->count();
            $no_farmasi_srg_tgn = $farmasi->where('srg_tgn', '0')->count();
            $no_farmasi_alas_kaki = $farmasi->where('alas_kaki', '0')->count();
            $no_farmasi_lps_apd = $farmasi->where('lps_apd', '0')->count();
            $no_farmasi_tdk_gtg_masker = $farmasi->where('tdk_gtg_masker', '0')->count();
            $no_farmasi_tdk_guna_srg_tgn = $farmasi->where('tdk_guna_srg_tgn', '0')->count();
            $no_farmasi_jumlah = $no_farmasi_pntp_kpl + $no_farmasi_masker + $no_farmasi_pntp_wjh + $no_farmasi_apron + $no_farmasi_srg_tgn + $no_farmasi_alas_kaki + $no_farmasi_lps_apd + $no_farmasi_tdk_gtg_masker + $no_farmasi_tdk_guna_srg_tgn;

            $denominator_farmasi = $farmasi_jumlah + $no_farmasi_jumlah;

            $igd_pntp_kpl = $igd->where('pntp_kpl', '1')->count();
            $igd_masker = $igd->where('masker', '1')->count();
            $igd_pntp_wjh = $igd->where('pntp_wjh', '1')->count();
            $igd_apron = $igd->where('apron', '1')->count();
            $igd_srg_tgn = $igd->where('srg_tgn', '1')->count();
            $igd_alas_kaki = $igd->where('alas_kaki', '1')->count();
            $igd_lps_apd = $igd->where('lps_apd', '1')->count();
            $igd_tdk_gtg_masker = $igd->where('tdk_gtg_masker', '1')->count();
            $igd_tdk_guna_srg_tgn = $igd->where('tdk_guna_srg_tgn', '1')->count();
            $igd_jumlah = $igd_pntp_kpl + $igd_masker + $igd_pntp_wjh + $igd_apron + $igd_srg_tgn + $igd_alas_kaki + $igd_lps_apd + $igd_tdk_gtg_masker + $igd_tdk_guna_srg_tgn;

            $no_igd_pntp_kpl = $igd->where('pntp_kpl', '0')->count();
            $no_igd_masker = $igd->where('masker', '0')->count();
            $no_igd_pntp_wjh = $igd->where('pntp_wjh', '0')->count();
            $no_igd_apron = $igd->where('apron', '0')->count();
            $no_igd_srg_tgn = $igd->where('srg_tgn', '0')->count();
            $no_igd_alas_kaki = $igd->where('alas_kaki', '0')->count();
            $no_igd_lps_apd = $igd->where('lps_apd', '0')->count();
            $no_igd_tdk_gtg_masker = $igd->where('tdk_gtg_masker', '0')->count();
            $no_igd_tdk_guna_srg_tgn = $igd->where('tdk_guna_srg_tgn', '0')->count();
            $no_igd_jumlah = $no_igd_pntp_kpl + $no_igd_masker + $no_igd_pntp_wjh + $no_igd_apron + $no_igd_srg_tgn + $no_igd_alas_kaki + $no_igd_lps_apd + $no_igd_tdk_gtg_masker + $no_igd_tdk_guna_srg_tgn;

            $denominator_igd = $igd_jumlah + $no_igd_jumlah;

            $int_pntp_kpl = $int->where('pntp_kpl', '1')->count();
            $int_masker = $int->where('masker', '1')->count();
            $int_pntp_wjh = $int->where('pntp_wjh', '1')->count();
            $int_apron = $int->where('apron', '1')->count();
            $int_srg_tgn = $int->where('srg_tgn', '1')->count();
            $int_alas_kaki = $int->where('alas_kaki', '1')->count();
            $int_lps_apd = $int->where('lps_apd', '1')->count();
            $int_tdk_gtg_masker = $int->where('tdk_gtg_masker', '1')->count();
            $int_tdk_guna_srg_tgn = $int->where('tdk_guna_srg_tgn', '1')->count();
            $int_jumlah = $int_pntp_kpl + $int_masker + $int_pntp_wjh + $int_apron + $int_srg_tgn + $int_alas_kaki + $int_lps_apd + $int_tdk_gtg_masker + $int_tdk_guna_srg_tgn;

            $no_int_pntp_kpl = $int->where('pntp_kpl', '0')->count();
            $no_int_masker = $int->where('masker', '0')->count();
            $no_int_pntp_wjh = $int->where('pntp_wjh', '0')->count();
            $no_int_apron = $int->where('apron', '0')->count();
            $no_int_srg_tgn = $int->where('srg_tgn', '0')->count();
            $no_int_alas_kaki = $int->where('alas_kaki', '0')->count();
            $no_int_lps_apd = $int->where('lps_apd', '0')->count();
            $no_int_tdk_gtg_masker = $int->where('tdk_gtg_masker', '0')->count();
            $no_int_tdk_guna_srg_tgn = $int->where('tdk_guna_srg_tgn', '0')->count();
            $no_int_jumlah = $no_int_pntp_kpl + $no_int_masker + $no_int_pntp_wjh + $no_int_apron + $no_int_srg_tgn + $no_int_alas_kaki + $no_int_lps_apd + $no_int_tdk_gtg_masker + $no_int_tdk_guna_srg_tgn;

            $denominator_int = $int_jumlah + $no_int_jumlah;

            $kbbl_pntp_kpl = $kbbl->where('pntp_kpl', '1')->count();
            $kbbl_masker = $kbbl->where('masker', '1')->count();
            $kbbl_pntp_wjh = $kbbl->where('pntp_wjh', '1')->count();
            $kbbl_apron = $kbbl->where('apron', '1')->count();
            $kbbl_srg_tgn = $kbbl->where('srg_tgn', '1')->count();
            $kbbl_alas_kaki = $kbbl->where('alas_kaki', '1')->count();
            $kbbl_lps_apd = $kbbl->where('lps_apd', '1')->count();
            $kbbl_tdk_gtg_masker = $kbbl->where('tdk_gtg_masker', '1')->count();
            $kbbl_tdk_guna_srg_tgn = $kbbl->where('tdk_guna_srg_tgn', '1')->count();
            $kbbl_jumlah = $kbbl_pntp_kpl + $kbbl_masker + $kbbl_pntp_wjh + $kbbl_apron + $kbbl_srg_tgn + $kbbl_alas_kaki + $kbbl_lps_apd + $kbbl_tdk_gtg_masker + $kbbl_tdk_guna_srg_tgn;

            $no_kbbl_pntp_kpl = $kbbl->where('pntp_kpl', '0')->count();
            $no_kbbl_masker = $kbbl->where('masker', '0')->count();
            $no_kbbl_pntp_wjh = $kbbl->where('pntp_wjh', '0')->count();
            $no_kbbl_apron = $kbbl->where('apron', '0')->count();
            $no_kbbl_srg_tgn = $kbbl->where('srg_tgn', '0')->count();
            $no_kbbl_alas_kaki = $kbbl->where('alas_kaki', '0')->count();
            $no_kbbl_lps_apd = $kbbl->where('lps_apd', '0')->count();
            $no_kbbl_tdk_gtg_masker = $kbbl->where('tdk_gtg_masker', '0')->count();
            $no_kbbl_tdk_guna_srg_tgn = $kbbl->where('tdk_guna_srg_tgn', '0')->count();
            $no_kbbl_jumlah = $no_kbbl_pntp_kpl + $no_kbbl_masker + $no_kbbl_pntp_wjh + $no_kbbl_apron + $no_kbbl_srg_tgn + $no_kbbl_alas_kaki + $no_kbbl_lps_apd + $no_kbbl_tdk_gtg_masker + $no_kbbl_tdk_guna_srg_tgn;

            $denominator_kbbl = $kbbl_jumlah + $no_kbbl_jumlah;

            $lab_pntp_kpl = $lab->where('pntp_kpl', '1')->count();
            $lab_masker = $lab->where('masker', '1')->count();
            $lab_pntp_wjh = $lab->where('pntp_wjh', '1')->count();
            $lab_apron = $lab->where('apron', '1')->count();
            $lab_srg_tgn = $lab->where('srg_tgn', '1')->count();
            $lab_alas_kaki = $lab->where('alas_kaki', '1')->count();
            $lab_lps_apd = $lab->where('lps_apd', '1')->count();
            $lab_tdk_gtg_masker = $lab->where('tdk_gtg_masker', '1')->count();
            $lab_tdk_guna_srg_tgn = $lab->where('tdk_guna_srg_tgn', '1')->count();
            $lab_jumlah = $lab_pntp_kpl + $lab_masker + $lab_pntp_wjh + $lab_apron + $lab_srg_tgn + $lab_alas_kaki + $lab_lps_apd + $lab_tdk_gtg_masker + $lab_tdk_guna_srg_tgn;

            $no_lab_pntp_kpl = $lab->where('pntp_kpl', '0')->count();
            $no_lab_masker = $lab->where('masker', '0')->count();
            $no_lab_pntp_wjh = $lab->where('pntp_wjh', '0')->count();
            $no_lab_apron = $lab->where('apron', '0')->count();
            $no_lab_srg_tgn = $lab->where('srg_tgn', '0')->count();
            $no_lab_alas_kaki = $lab->where('alas_kaki', '0')->count();
            $no_lab_lps_apd = $lab->where('lps_apd', '0')->count();
            $no_lab_tdk_gtg_masker = $lab->where('tdk_gtg_masker', '0')->count();
            $no_lab_tdk_guna_srg_tgn = $lab->where('tdk_guna_srg_tgn', '0')->count();
            $no_lab_jumlah = $no_lab_pntp_kpl + $no_lab_masker + $no_lab_pntp_wjh + $no_lab_apron + $no_lab_srg_tgn + $no_lab_alas_kaki + $no_lab_lps_apd + $no_lab_tdk_gtg_masker + $no_lab_tdk_guna_srg_tgn;

            $denominator_lab = $lab_jumlah + $no_lab_jumlah;

            $laundry_pntp_kpl = $laundry->where('pntp_kpl', '1')->count();
            $laundry_masker = $laundry->where('masker', '1')->count();
            $laundry_pntp_wjh = $laundry->where('pntp_wjh', '1')->count();
            $laundry_apron = $laundry->where('apron', '1')->count();
            $laundry_srg_tgn = $laundry->where('srg_tgn', '1')->count();
            $laundry_alas_kaki = $laundry->where('alas_kaki', '1')->count();
            $laundry_lps_apd = $laundry->where('lps_apd', '1')->count();
            $laundry_tdk_gtg_masker = $laundry->where('tdk_gtg_masker', '1')->count();
            $laundry_tdk_guna_srg_tgn = $laundry->where('tdk_guna_srg_tgn', '1')->count();
            $laundry_jumlah = $laundry_pntp_kpl + $laundry_masker + $laundry_pntp_wjh + $laundry_apron + $laundry_srg_tgn + $laundry_alas_kaki + $laundry_lps_apd + $laundry_tdk_gtg_masker + $laundry_tdk_guna_srg_tgn;

            $no_laundry_pntp_kpl = $laundry->where('pntp_kpl', '0')->count();
            $no_laundry_masker = $laundry->where('masker', '0')->count();
            $no_laundry_pntp_wjh = $laundry->where('pntp_wjh', '0')->count();
            $no_laundry_apron = $laundry->where('apron', '0')->count();
            $no_laundry_srg_tgn = $laundry->where('srg_tgn', '0')->count();
            $no_laundry_alas_kaki = $laundry->where('alas_kaki', '0')->count();
            $no_laundry_lps_apd = $laundry->where('lps_apd', '0')->count();
            $no_laundry_tdk_gtg_masker = $laundry->where('tdk_gtg_masker', '0')->count();
            $no_laundry_tdk_guna_srg_tgn = $laundry->where('tdk_guna_srg_tgn', '0')->count();
            $no_laundry_jumlah = $no_laundry_pntp_kpl + $no_laundry_masker + $no_laundry_pntp_wjh + $no_laundry_apron + $no_laundry_srg_tgn + $no_laundry_alas_kaki + $no_laundry_lps_apd + $no_laundry_tdk_gtg_masker + $no_laundry_tdk_guna_srg_tgn;

            $denominator_laundry = $laundry_jumlah + $no_laundry_jumlah;

            $ok_pntp_kpl = $ok->where('pntp_kpl', '1')->count();
            $ok_masker = $ok->where('masker', '1')->count();
            $ok_pntp_wjh = $ok->where('pntp_wjh', '1')->count();
            $ok_apron = $ok->where('apron', '1')->count();
            $ok_srg_tgn = $ok->where('srg_tgn', '1')->count();
            $ok_alas_kaki = $ok->where('alas_kaki', '1')->count();
            $ok_lps_apd = $ok->where('lps_apd', '1')->count();
            $ok_tdk_gtg_masker = $ok->where('tdk_gtg_masker', '1')->count();
            $ok_tdk_guna_srg_tgn = $ok->where('tdk_guna_srg_tgn', '1')->count();
            $ok_jumlah = $ok_pntp_kpl + $ok_masker + $ok_pntp_wjh + $ok_apron + $ok_srg_tgn + $ok_alas_kaki + $ok_lps_apd + $ok_tdk_gtg_masker + $ok_tdk_guna_srg_tgn;

            $no_ok_pntp_kpl = $ok->where('pntp_kpl', '0')->count();
            $no_ok_masker = $ok->where('masker', '0')->count();
            $no_ok_pntp_wjh = $ok->where('pntp_wjh', '0')->count();
            $no_ok_apron = $ok->where('apron', '0')->count();
            $no_ok_srg_tgn = $ok->where('srg_tgn', '0')->count();
            $no_ok_alas_kaki = $ok->where('alas_kaki', '0')->count();
            $no_ok_lps_apd = $ok->where('lps_apd', '0')->count();
            $no_ok_tdk_gtg_masker = $ok->where('tdk_gtg_masker', '0')->count();
            $no_ok_tdk_guna_srg_tgn = $ok->where('tdk_guna_srg_tgn', '0')->count();
            $no_ok_jumlah = $no_ok_pntp_kpl + $no_ok_masker + $no_ok_pntp_wjh + $no_ok_apron + $no_ok_srg_tgn + $no_ok_alas_kaki + $no_ok_lps_apd + $no_ok_tdk_gtg_masker + $no_ok_tdk_guna_srg_tgn;

            $denominator_ok = $ok_jumlah + $no_ok_jumlah;

            $lt2_pntp_kpl = $lt2->where('pntp_kpl', '1')->count();
            $lt2_masker = $lt2->where('masker', '1')->count();
            $lt2_pntp_wjh = $lt2->where('pntp_wjh', '1')->count();
            $lt2_apron = $lt2->where('apron', '1')->count();
            $lt2_srg_tgn = $lt2->where('srg_tgn', '1')->count();
            $lt2_alas_kaki = $lt2->where('alas_kaki', '1')->count();
            $lt2_lps_apd = $lt2->where('lps_apd', '1')->count();
            $lt2_tdk_gtg_masker = $lt2->where('tdk_gtg_masker', '1')->count();
            $lt2_tdk_guna_srg_tgn = $lt2->where('tdk_guna_srg_tgn', '1')->count();
            $lt2_jumlah = $lt2_pntp_kpl + $lt2_masker + $lt2_pntp_wjh + $lt2_apron + $lt2_srg_tgn + $lt2_alas_kaki + $lt2_lps_apd + $lt2_tdk_gtg_masker + $lt2_tdk_guna_srg_tgn;

            $no_lt2_pntp_kpl = $lt2->where('pntp_kpl', '0')->count();
            $no_lt2_masker = $lt2->where('masker', '0')->count();
            $no_lt2_pntp_wjh = $lt2->where('pntp_wjh', '0')->count();
            $no_lt2_apron = $lt2->where('apron', '0')->count();
            $no_lt2_srg_tgn = $lt2->where('srg_tgn', '0')->count();
            $no_lt2_alas_kaki = $lt2->where('alas_kaki', '0')->count();
            $no_lt2_lps_apd = $lt2->where('lps_apd', '0')->count();
            $no_lt2_tdk_gtg_masker = $lt2->where('tdk_gtg_masker', '0')->count();
            $no_lt2_tdk_guna_srg_tgn = $lt2->where('tdk_guna_srg_tgn', '0')->count();
            $no_lt2_jumlah = $no_lt2_pntp_kpl + $no_lt2_masker + $no_lt2_pntp_wjh + $no_lt2_apron + $no_lt2_srg_tgn + $no_lt2_alas_kaki + $no_lt2_lps_apd + $no_lt2_tdk_gtg_masker + $no_lt2_tdk_guna_srg_tgn;

            $denominator_lt2 = $lt2_jumlah + $no_lt2_jumlah;

            $lt4_pntp_kpl = $lt4->where('pntp_kpl', '1')->count();
            $lt4_masker = $lt4->where('masker', '1')->count();
            $lt4_pntp_wjh = $lt4->where('pntp_wjh', '1')->count();
            $lt4_apron = $lt4->where('apron', '1')->count();
            $lt4_srg_tgn = $lt4->where('srg_tgn', '1')->count();
            $lt4_alas_kaki = $lt4->where('alas_kaki', '1')->count();
            $lt4_lps_apd = $lt4->where('lps_apd', '1')->count();
            $lt4_tdk_gtg_masker = $lt4->where('tdk_gtg_masker', '1')->count();
            $lt4_tdk_guna_srg_tgn = $lt4->where('tdk_guna_srg_tgn', '1')->count();
            $lt4_jumlah = $lt4_pntp_kpl + $lt4_masker + $lt4_pntp_wjh + $lt4_apron + $lt4_srg_tgn + $lt4_alas_kaki + $lt4_lps_apd + $lt4_tdk_gtg_masker + $lt4_tdk_guna_srg_tgn;

            $no_lt4_pntp_kpl = $lt4->where('pntp_kpl', '0')->count();
            $no_lt4_masker = $lt4->where('masker', '0')->count();
            $no_lt4_pntp_wjh = $lt4->where('pntp_wjh', '0')->count();
            $no_lt4_apron = $lt4->where('apron', '0')->count();
            $no_lt4_srg_tgn = $lt4->where('srg_tgn', '0')->count();
            $no_lt4_alas_kaki = $lt4->where('alas_kaki', '0')->count();
            $no_lt4_lps_apd = $lt4->where('lps_apd', '0')->count();
            $no_lt4_tdk_gtg_masker = $lt4->where('tdk_gtg_masker', '0')->count();
            $no_lt4_tdk_guna_srg_tgn = $lt4->where('tdk_guna_srg_tgn', '0')->count();
            $no_lt4_jumlah = $no_lt4_pntp_kpl + $no_lt4_masker + $no_lt4_pntp_wjh + $no_lt4_apron + $no_lt4_srg_tgn + $no_lt4_alas_kaki + $no_lt4_lps_apd + $no_lt4_tdk_gtg_masker + $no_lt4_tdk_guna_srg_tgn;

            $denominator_lt4 = $lt4_jumlah + $no_lt4_jumlah;

            $lt5_pntp_kpl = $lt5->where('pntp_kpl', '1')->count();
            $lt5_masker = $lt5->where('masker', '1')->count();
            $lt5_pntp_wjh = $lt5->where('pntp_wjh', '1')->count();
            $lt5_apron = $lt5->where('apron', '1')->count();
            $lt5_srg_tgn = $lt5->where('srg_tgn', '1')->count();
            $lt5_alas_kaki = $lt5->where('alas_kaki', '1')->count();
            $lt5_lps_apd = $lt5->where('lps_apd', '1')->count();
            $lt5_tdk_gtg_masker = $lt5->where('tdk_gtg_masker', '1')->count();
            $lt5_tdk_guna_srg_tgn = $lt5->where('tdk_guna_srg_tgn', '1')->count();
            $lt5_jumlah = $lt5_pntp_kpl + $lt5_masker + $lt5_pntp_wjh + $lt5_apron + $lt5_srg_tgn + $lt5_alas_kaki + $lt5_lps_apd + $lt5_tdk_gtg_masker + $lt5_tdk_guna_srg_tgn;

            $no_lt5_pntp_kpl = $lt5->where('pntp_kpl', '0')->count();
            $no_lt5_masker = $lt5->where('masker', '0')->count();
            $no_lt5_pntp_wjh = $lt5->where('pntp_wjh', '0')->count();
            $no_lt5_apron = $lt5->where('apron', '0')->count();
            $no_lt5_srg_tgn = $lt5->where('srg_tgn', '0')->count();
            $no_lt5_alas_kaki = $lt5->where('alas_kaki', '0')->count();
            $no_lt5_lps_apd = $lt5->where('lps_apd', '0')->count();
            $no_lt5_tdk_gtg_masker = $lt5->where('tdk_gtg_masker', '0')->count();
            $no_lt5_tdk_guna_srg_tgn = $lt5->where('tdk_guna_srg_tgn', '0')->count();
            $no_lt5_jumlah = $no_lt5_pntp_kpl + $no_lt5_masker + $no_lt5_pntp_wjh + $no_lt5_apron + $no_lt5_srg_tgn + $no_lt5_alas_kaki + $no_lt5_lps_apd + $no_lt5_tdk_gtg_masker + $no_lt5_tdk_guna_srg_tgn;

            $denominator_lt5 = $lt5_jumlah + $no_lt5_jumlah;

            $poli_pntp_kpl = $poli->where('pntp_kpl', '1')->count();
            $poli_masker = $poli->where('masker', '1')->count();
            $poli_pntp_wjh = $poli->where('pntp_wjh', '1')->count();
            $poli_apron = $poli->where('apron', '1')->count();
            $poli_srg_tgn = $poli->where('srg_tgn', '1')->count();
            $poli_alas_kaki = $poli->where('alas_kaki', '1')->count();
            $poli_lps_apd = $poli->where('lps_apd', '1')->count();
            $poli_tdk_gtg_masker = $poli->where('tdk_gtg_masker', '1')->count();
            $poli_tdk_guna_srg_tgn = $poli->where('tdk_guna_srg_tgn', '1')->count();
            $poli_jumlah = $poli_pntp_kpl + $poli_masker + $poli_pntp_wjh + $poli_apron + $poli_srg_tgn + $poli_alas_kaki + $poli_lps_apd + $poli_tdk_gtg_masker + $poli_tdk_guna_srg_tgn;

            $no_poli_pntp_kpl = $poli->where('pntp_kpl', '0')->count();
            $no_poli_masker = $poli->where('masker', '0')->count();
            $no_poli_pntp_wjh = $poli->where('pntp_wjh', '0')->count();
            $no_poli_apron = $poli->where('apron', '0')->count();
            $no_poli_srg_tgn = $poli->where('srg_tgn', '0')->count();
            $no_poli_alas_kaki = $poli->where('alas_kaki', '0')->count();
            $no_poli_lps_apd = $poli->where('lps_apd', '0')->count();
            $no_poli_tdk_gtg_masker = $poli->where('tdk_gtg_masker', '0')->count();
            $no_poli_tdk_guna_srg_tgn = $poli->where('tdk_guna_srg_tgn', '0')->count();
            $no_poli_jumlah = $no_poli_pntp_kpl + $no_poli_masker + $no_poli_pntp_wjh + $no_poli_apron + $no_poli_srg_tgn + $no_poli_alas_kaki + $no_poli_lps_apd + $no_poli_tdk_gtg_masker + $no_poli_tdk_guna_srg_tgn;

            $denominator_poli = $poli_jumlah + $no_poli_jumlah;

            $rad_pntp_kpl = $rad->where('pntp_kpl', '1')->count();
            $rad_masker = $rad->where('masker', '1')->count();
            $rad_pntp_wjh = $rad->where('pntp_wjh', '1')->count();
            $rad_apron = $rad->where('apron', '1')->count();
            $rad_srg_tgn = $rad->where('srg_tgn', '1')->count();
            $rad_alas_kaki = $rad->where('alas_kaki', '1')->count();
            $rad_lps_apd = $rad->where('lps_apd', '1')->count();
            $rad_tdk_gtg_masker = $rad->where('tdk_gtg_masker', '1')->count();
            $rad_tdk_guna_srg_tgn = $rad->where('tdk_guna_srg_tgn', '1')->count();
            $rad_jumlah = $rad_pntp_kpl + $rad_masker + $rad_pntp_wjh + $rad_apron + $rad_srg_tgn + $rad_alas_kaki + $rad_lps_apd + $rad_tdk_gtg_masker + $rad_tdk_guna_srg_tgn;

            $no_rad_pntp_kpl = $rad->where('pntp_kpl', '0')->count();
            $no_rad_masker = $rad->where('masker', '0')->count();
            $no_rad_pntp_wjh = $rad->where('pntp_wjh', '0')->count();
            $no_rad_apron = $rad->where('apron', '0')->count();
            $no_rad_srg_tgn = $rad->where('srg_tgn', '0')->count();
            $no_rad_alas_kaki = $rad->where('alas_kaki', '0')->count();
            $no_rad_lps_apd = $rad->where('lps_apd', '0')->count();
            $no_rad_tdk_gtg_masker = $rad->where('tdk_gtg_masker', '0')->count();
            $no_rad_tdk_guna_srg_tgn = $rad->where('tdk_guna_srg_tgn', '0')->count();
            $no_rad_jumlah = $no_rad_pntp_kpl + $no_rad_masker + $no_rad_pntp_wjh + $no_rad_apron + $no_rad_srg_tgn + $no_rad_alas_kaki + $no_rad_lps_apd + $no_rad_tdk_gtg_masker + $no_rad_tdk_guna_srg_tgn;

            $denominator_rad = $rad_jumlah + $no_rad_jumlah;

            $vk_pntp_kpl = $vk->where('pntp_kpl', '1')->count();
            $vk_masker = $vk->where('masker', '1')->count();
            $vk_pntp_wjh = $vk->where('pntp_wjh', '1')->count();
            $vk_apron = $vk->where('apron', '1')->count();
            $vk_srg_tgn = $vk->where('srg_tgn', '1')->count();
            $vk_alas_kaki = $vk->where('alas_kaki', '1')->count();
            $vk_lps_apd = $vk->where('lps_apd', '1')->count();
            $vk_tdk_gtg_masker = $vk->where('tdk_gtg_masker', '1')->count();
            $vk_tdk_guna_srg_tgn = $vk->where('tdk_guna_srg_tgn', '1')->count();
            $vk_jumlah = $vk_pntp_kpl + $vk_masker + $vk_pntp_wjh + $vk_apron + $vk_srg_tgn + $vk_alas_kaki + $vk_lps_apd + $vk_tdk_gtg_masker + $vk_tdk_guna_srg_tgn;

            $no_vk_pntp_kpl = $vk->where('pntp_kpl', '0')->count();
            $no_vk_masker = $vk->where('masker', '0')->count();
            $no_vk_pntp_wjh = $vk->where('pntp_wjh', '0')->count();
            $no_vk_apron = $vk->where('apron', '0')->count();
            $no_vk_srg_tgn = $vk->where('srg_tgn', '0')->count();
            $no_vk_alas_kaki = $vk->where('alas_kaki', '0')->count();
            $no_vk_lps_apd = $vk->where('lps_apd', '0')->count();
            $no_vk_tdk_gtg_masker = $vk->where('tdk_gtg_masker', '0')->count();
            $no_vk_tdk_guna_srg_tgn = $vk->where('tdk_guna_srg_tgn', '0')->count();
            $no_vk_jumlah = $no_vk_pntp_kpl + $no_vk_masker + $no_vk_pntp_wjh + $no_vk_apron + $no_vk_srg_tgn + $no_vk_alas_kaki + $no_vk_lps_apd + $no_vk_tdk_gtg_masker + $no_vk_tdk_guna_srg_tgn;

            $denominator_vk = $vk_jumlah + $no_vk_jumlah;

            return view('rekapApd.index', compact(
                'range_tgl',
                'tabel',
                'rekap',
                'analisa',
                'tindak_lanjut',

                'cssu_pntp_kpl',
                'cssu_masker',
                'cssu_pntp_wjh',
                'cssu_apron',
                'cssu_srg_tgn',
                'cssu_alas_kaki',
                'cssu_lps_apd',
                'cssu_tdk_gtg_masker',
                'cssu_tdk_guna_srg_tgn',
                'cssu_jumlah',

                'no_cssu_pntp_kpl',
                'no_cssu_masker',
                'no_cssu_pntp_wjh',
                'no_cssu_apron',
                'no_cssu_srg_tgn',
                'no_cssu_alas_kaki',
                'no_cssu_lps_apd',
                'no_cssu_tdk_gtg_masker',
                'no_cssu_tdk_guna_srg_tgn',
                'no_cssu_jumlah',

                'denominator_cssu',

                'dapur_pntp_kpl',
                'dapur_masker',
                'dapur_pntp_wjh',
                'dapur_apron',
                'dapur_srg_tgn',
                'dapur_alas_kaki',
                'dapur_lps_apd',
                'dapur_tdk_gtg_masker',
                'dapur_tdk_guna_srg_tgn',
                'dapur_jumlah',

                'no_dapur_pntp_kpl',
                'no_dapur_masker',
                'no_dapur_pntp_wjh',
                'no_dapur_apron',
                'no_dapur_srg_tgn',
                'no_dapur_alas_kaki',
                'no_dapur_lps_apd',
                'no_dapur_tdk_gtg_masker',
                'no_dapur_tdk_guna_srg_tgn',
                'no_dapur_jumlah',

                'denominator_dapur',

                'dpjp_pntp_kpl',
                'dpjp_masker',
                'dpjp_pntp_wjh',
                'dpjp_apron',
                'dpjp_srg_tgn',
                'dpjp_alas_kaki',
                'dpjp_lps_apd',
                'dpjp_tdk_gtg_masker',
                'dpjp_tdk_guna_srg_tgn',
                'dpjp_jumlah',

                'no_dpjp_pntp_kpl',
                'no_dpjp_masker',
                'no_dpjp_pntp_wjh',
                'no_dpjp_apron',
                'no_dpjp_srg_tgn',
                'no_dpjp_alas_kaki',
                'no_dpjp_lps_apd',
                'no_dpjp_tdk_gtg_masker',
                'no_dpjp_tdk_guna_srg_tgn',
                'no_dpjp_jumlah',

                'denominator_dpjp',

                'farmasi_pntp_kpl',
                'farmasi_masker',
                'farmasi_pntp_wjh',
                'farmasi_apron',
                'farmasi_srg_tgn',
                'farmasi_alas_kaki',
                'farmasi_lps_apd',
                'farmasi_tdk_gtg_masker',
                'farmasi_tdk_guna_srg_tgn',
                'farmasi_jumlah',

                'no_farmasi_pntp_kpl',
                'no_farmasi_masker',
                'no_farmasi_pntp_wjh',
                'no_farmasi_apron',
                'no_farmasi_srg_tgn',
                'no_farmasi_alas_kaki',
                'no_farmasi_lps_apd',
                'no_farmasi_tdk_gtg_masker',
                'no_farmasi_tdk_guna_srg_tgn',
                'no_farmasi_jumlah',

                'denominator_farmasi',

                'igd_pntp_kpl',
                'igd_masker',
                'igd_pntp_wjh',
                'igd_apron',
                'igd_srg_tgn',
                'igd_alas_kaki',
                'igd_lps_apd',
                'igd_tdk_gtg_masker',
                'igd_tdk_guna_srg_tgn',
                'igd_jumlah',

                'no_igd_pntp_kpl',
                'no_igd_masker',
                'no_igd_pntp_wjh',
                'no_igd_apron',
                'no_igd_srg_tgn',
                'no_igd_alas_kaki',
                'no_igd_lps_apd',
                'no_igd_tdk_gtg_masker',
                'no_igd_tdk_guna_srg_tgn',
                'no_igd_jumlah',

                'denominator_igd',

                'int_pntp_kpl',
                'int_masker',
                'int_pntp_wjh',
                'int_apron',
                'int_srg_tgn',
                'int_alas_kaki',
                'int_lps_apd',
                'int_tdk_gtg_masker',
                'int_tdk_guna_srg_tgn',
                'int_jumlah',

                'no_int_pntp_kpl',
                'no_int_masker',
                'no_int_pntp_wjh',
                'no_int_apron',
                'no_int_srg_tgn',
                'no_int_alas_kaki',
                'no_int_lps_apd',
                'no_int_tdk_gtg_masker',
                'no_int_tdk_guna_srg_tgn',
                'no_int_jumlah',

                'denominator_int',

                'kbbl_pntp_kpl',
                'kbbl_masker',
                'kbbl_pntp_wjh',
                'kbbl_apron',
                'kbbl_srg_tgn',
                'kbbl_alas_kaki',
                'kbbl_lps_apd',
                'kbbl_tdk_gtg_masker',
                'kbbl_tdk_guna_srg_tgn',
                'kbbl_jumlah',

                'no_kbbl_pntp_kpl',
                'no_kbbl_masker',
                'no_kbbl_pntp_wjh',
                'no_kbbl_apron',
                'no_kbbl_srg_tgn',
                'no_kbbl_alas_kaki',
                'no_kbbl_lps_apd',
                'no_kbbl_tdk_gtg_masker',
                'no_kbbl_tdk_guna_srg_tgn',
                'no_kbbl_jumlah',

                'denominator_kbbl',

                'lab_pntp_kpl',
                'lab_masker',
                'lab_pntp_wjh',
                'lab_apron',
                'lab_srg_tgn',
                'lab_alas_kaki',
                'lab_lps_apd',
                'lab_tdk_gtg_masker',
                'lab_tdk_guna_srg_tgn',
                'lab_jumlah',

                'no_lab_pntp_kpl',
                'no_lab_masker',
                'no_lab_pntp_wjh',
                'no_lab_apron',
                'no_lab_srg_tgn',
                'no_lab_alas_kaki',
                'no_lab_lps_apd',
                'no_lab_tdk_gtg_masker',
                'no_lab_tdk_guna_srg_tgn',
                'no_lab_jumlah',

                'denominator_lab',

                'laundry_pntp_kpl',
                'laundry_masker',
                'laundry_pntp_wjh',
                'laundry_apron',
                'laundry_srg_tgn',
                'laundry_alas_kaki',
                'laundry_lps_apd',
                'laundry_tdk_gtg_masker',
                'laundry_tdk_guna_srg_tgn',
                'laundry_jumlah',

                'no_laundry_pntp_kpl',
                'no_laundry_masker',
                'no_laundry_pntp_wjh',
                'no_laundry_apron',
                'no_laundry_srg_tgn',
                'no_laundry_alas_kaki',
                'no_laundry_lps_apd',
                'no_laundry_tdk_gtg_masker',
                'no_laundry_tdk_guna_srg_tgn',
                'no_laundry_jumlah',

                'denominator_laundry',

                'ok_pntp_kpl',
                'ok_masker',
                'ok_pntp_wjh',
                'ok_apron',
                'ok_srg_tgn',
                'ok_alas_kaki',
                'ok_lps_apd',
                'ok_tdk_gtg_masker',
                'ok_tdk_guna_srg_tgn',
                'ok_jumlah',

                'no_ok_pntp_kpl',
                'no_ok_masker',
                'no_ok_pntp_wjh',
                'no_ok_apron',
                'no_ok_srg_tgn',
                'no_ok_alas_kaki',
                'no_ok_lps_apd',
                'no_ok_tdk_gtg_masker',
                'no_ok_tdk_guna_srg_tgn',
                'no_ok_jumlah',

                'denominator_ok',

                'lt2_pntp_kpl',
                'lt2_masker',
                'lt2_pntp_wjh',
                'lt2_apron',
                'lt2_srg_tgn',
                'lt2_alas_kaki',
                'lt2_lps_apd',
                'lt2_tdk_gtg_masker',
                'lt2_tdk_guna_srg_tgn',
                'lt2_jumlah',

                'no_lt2_pntp_kpl',
                'no_lt2_masker',
                'no_lt2_pntp_wjh',
                'no_lt2_apron',
                'no_lt2_srg_tgn',
                'no_lt2_alas_kaki',
                'no_lt2_lps_apd',
                'no_lt2_tdk_gtg_masker',
                'no_lt2_tdk_guna_srg_tgn',
                'no_lt2_jumlah',

                'denominator_lt2',

                'lt4_pntp_kpl',
                'lt4_masker',
                'lt4_pntp_wjh',
                'lt4_apron',
                'lt4_srg_tgn',
                'lt4_alas_kaki',
                'lt4_lps_apd',
                'lt4_tdk_gtg_masker',
                'lt4_tdk_guna_srg_tgn',
                'lt4_jumlah',

                'no_lt4_pntp_kpl',
                'no_lt4_masker',
                'no_lt4_pntp_wjh',
                'no_lt4_apron',
                'no_lt4_srg_tgn',
                'no_lt4_alas_kaki',
                'no_lt4_lps_apd',
                'no_lt4_tdk_gtg_masker',
                'no_lt4_tdk_guna_srg_tgn',
                'no_lt4_jumlah',

                'denominator_lt4',

                'lt5_pntp_kpl',
                'lt5_masker',
                'lt5_pntp_wjh',
                'lt5_apron',
                'lt5_srg_tgn',
                'lt5_alas_kaki',
                'lt5_lps_apd',
                'lt5_tdk_gtg_masker',
                'lt5_tdk_guna_srg_tgn',
                'lt5_jumlah',

                'no_lt5_pntp_kpl',
                'no_lt5_masker',
                'no_lt5_pntp_wjh',
                'no_lt5_apron',
                'no_lt5_srg_tgn',
                'no_lt5_alas_kaki',
                'no_lt5_lps_apd',
                'no_lt5_tdk_gtg_masker',
                'no_lt5_tdk_guna_srg_tgn',
                'no_lt5_jumlah',

                'denominator_lt5',

                'poli_pntp_kpl',
                'poli_masker',
                'poli_pntp_wjh',
                'poli_apron',
                'poli_srg_tgn',
                'poli_alas_kaki',
                'poli_lps_apd',
                'poli_tdk_gtg_masker',
                'poli_tdk_guna_srg_tgn',
                'poli_jumlah',

                'no_poli_pntp_kpl',
                'no_poli_masker',
                'no_poli_pntp_wjh',
                'no_poli_apron',
                'no_poli_srg_tgn',
                'no_poli_alas_kaki',
                'no_poli_lps_apd',
                'no_poli_tdk_gtg_masker',
                'no_poli_tdk_guna_srg_tgn',
                'no_poli_jumlah',

                'denominator_poli',

                'rad_pntp_kpl',
                'rad_masker',
                'rad_pntp_wjh',
                'rad_apron',
                'rad_srg_tgn',
                'rad_alas_kaki',
                'rad_lps_apd',
                'rad_tdk_gtg_masker',
                'rad_tdk_guna_srg_tgn',
                'rad_jumlah',

                'no_rad_pntp_kpl',
                'no_rad_masker',
                'no_rad_pntp_wjh',
                'no_rad_apron',
                'no_rad_srg_tgn',
                'no_rad_alas_kaki',
                'no_rad_lps_apd',
                'no_rad_tdk_gtg_masker',
                'no_rad_tdk_guna_srg_tgn',
                'no_rad_jumlah',

                'denominator_rad',

                'vk_pntp_kpl',
                'vk_masker',
                'vk_pntp_wjh',
                'vk_apron',
                'vk_srg_tgn',
                'vk_alas_kaki',
                'vk_lps_apd',
                'vk_tdk_gtg_masker',
                'vk_tdk_guna_srg_tgn',
                'vk_jumlah',

                'no_vk_pntp_kpl',
                'no_vk_masker',
                'no_vk_pntp_wjh',
                'no_vk_apron',
                'no_vk_srg_tgn',
                'no_vk_alas_kaki',
                'no_vk_lps_apd',
                'no_vk_tdk_gtg_masker',
                'no_vk_tdk_guna_srg_tgn',
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
            $tabel = Apd::whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')->paginate(1000);
            // dd($tabel);

            $rekap = RekapApd::whereDate('dari', '=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('sampai', '=', $request->input('sampai') ?? $tgl_skg)
                ->get();

            $analisa = RekapApd::select('analisa')
                ->whereDate('dari', '=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('sampai', '=', $request->input('sampai') ?? $tgl_skg)
                ->get();

            $tindak_lanjut = RekapApd::select('tindak_lanjut')
                ->whereDate('dari', '=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('sampai', '=', $request->input('sampai') ?? $tgl_skg)
                ->get();

            $cssu = Apd::where('unit', 'CSSU')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $dapur = Apd::where('unit', 'Dapur')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $dpjp = Apd::where('unit', 'DPJP')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $farmasi = Apd::where('unit', 'Farmasi')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $igd = Apd::where('unit', 'IGD')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $int = Apd::where('unit', 'Intensif')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $kbbl = Apd::where('unit', 'KBBL')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lab = Apd::where('unit', 'Laboratorium')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $laundry = Apd::where('unit', 'Laundry')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $ok = Apd::where('unit', 'OK')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt2 = Apd::where('unit', 'Perawatan Eksekutif lt.2')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt4 = Apd::where('unit', 'Perawatan Reguler lt.4')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt5 = Apd::where('unit', 'Perawatan Reguler lt.5')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $poli = Apd::where('unit', 'Poliklinik')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $rad = Apd::where('unit', 'Radiologi')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $vk = Apd::where('unit', 'VK')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();

            $cssu_pntp_kpl = $cssu->where('pntp_kpl', '1')->count();
            $cssu_masker = $cssu->where('masker', '1')->count();
            $cssu_pntp_wjh = $cssu->where('pntp_wjh', '1')->count();
            $cssu_apron = $cssu->where('apron', '1')->count();
            $cssu_srg_tgn = $cssu->where('srg_tgn', '1')->count();
            $cssu_alas_kaki = $cssu->where('alas_kaki', '1')->count();
            $cssu_lps_apd = $cssu->where('lps_apd', '1')->count();
            $cssu_tdk_gtg_masker = $cssu->where('tdk_gtg_masker', '1')->count();
            $cssu_tdk_guna_srg_tgn = $cssu->where('tdk_guna_srg_tgn', '1')->count();
            $cssu_jumlah = $cssu_pntp_kpl + $cssu_masker + $cssu_pntp_wjh + $cssu_apron + $cssu_srg_tgn + $cssu_alas_kaki + $cssu_lps_apd + $cssu_tdk_gtg_masker + $cssu_tdk_guna_srg_tgn;

            $no_cssu_pntp_kpl = $cssu->where('pntp_kpl', '0')->count();
            $no_cssu_masker = $cssu->where('masker', '0')->count();
            $no_cssu_pntp_wjh = $cssu->where('pntp_wjh', '0')->count();
            $no_cssu_apron = $cssu->where('apron', '0')->count();
            $no_cssu_srg_tgn = $cssu->where('srg_tgn', '0')->count();
            $no_cssu_alas_kaki = $cssu->where('alas_kaki', '0')->count();
            $no_cssu_lps_apd = $cssu->where('lps_apd', '0')->count();
            $no_cssu_tdk_gtg_masker = $cssu->where('tdk_gtg_masker', '0')->count();
            $no_cssu_tdk_guna_srg_tgn = $cssu->where('tdk_guna_srg_tgn', '0')->count();
            $no_cssu_jumlah = $no_cssu_pntp_kpl + $no_cssu_masker + $no_cssu_pntp_wjh + $no_cssu_apron + $no_cssu_srg_tgn + $no_cssu_alas_kaki + $no_cssu_lps_apd + $no_cssu_tdk_gtg_masker + $no_cssu_tdk_guna_srg_tgn;

            $denominator_cssu = $cssu_jumlah + $no_cssu_jumlah;

            $dapur_pntp_kpl = $dapur->where('pntp_kpl', '1')->count();
            $dapur_masker = $dapur->where('masker', '1')->count();
            $dapur_pntp_wjh = $dapur->where('pntp_wjh', '1')->count();
            $dapur_apron = $dapur->where('apron', '1')->count();
            $dapur_srg_tgn = $dapur->where('srg_tgn', '1')->count();
            $dapur_alas_kaki = $dapur->where('alas_kaki', '1')->count();
            $dapur_lps_apd = $dapur->where('lps_apd', '1')->count();
            $dapur_tdk_gtg_masker = $dapur->where('tdk_gtg_masker', '1')->count();
            $dapur_tdk_guna_srg_tgn = $dapur->where('tdk_guna_srg_tgn', '1')->count();
            $dapur_jumlah = $dapur_pntp_kpl + $dapur_masker + $dapur_pntp_wjh + $dapur_apron + $dapur_srg_tgn + $dapur_alas_kaki + $dapur_lps_apd + $dapur_tdk_gtg_masker + $dapur_tdk_guna_srg_tgn;

            $no_dapur_pntp_kpl = $dapur->where('pntp_kpl', '0')->count();
            $no_dapur_masker = $dapur->where('masker', '0')->count();
            $no_dapur_pntp_wjh = $dapur->where('pntp_wjh', '0')->count();
            $no_dapur_apron = $dapur->where('apron', '0')->count();
            $no_dapur_srg_tgn = $dapur->where('srg_tgn', '0')->count();
            $no_dapur_alas_kaki = $dapur->where('alas_kaki', '0')->count();
            $no_dapur_lps_apd = $dapur->where('lps_apd', '0')->count();
            $no_dapur_tdk_gtg_masker = $dapur->where('tdk_gtg_masker', '0')->count();
            $no_dapur_tdk_guna_srg_tgn = $dapur->where('tdk_guna_srg_tgn', '0')->count();
            $no_dapur_jumlah = $no_dapur_pntp_kpl + $no_dapur_masker + $no_dapur_pntp_wjh + $no_dapur_apron + $no_dapur_srg_tgn + $no_dapur_alas_kaki + $no_dapur_lps_apd + $no_dapur_tdk_gtg_masker + $no_dapur_tdk_guna_srg_tgn;

            $denominator_dapur = $dapur_jumlah + $no_dapur_jumlah;

            $dpjp_pntp_kpl = $dpjp->where('pntp_kpl', '1')->count();
            $dpjp_masker = $dpjp->where('masker', '1')->count();
            $dpjp_pntp_wjh = $dpjp->where('pntp_wjh', '1')->count();
            $dpjp_apron = $dpjp->where('apron', '1')->count();
            $dpjp_srg_tgn = $dpjp->where('srg_tgn', '1')->count();
            $dpjp_alas_kaki = $dpjp->where('alas_kaki', '1')->count();
            $dpjp_lps_apd = $dpjp->where('lps_apd', '1')->count();
            $dpjp_tdk_gtg_masker = $dpjp->where('tdk_gtg_masker', '1')->count();
            $dpjp_tdk_guna_srg_tgn = $dpjp->where('tdk_guna_srg_tgn', '1')->count();
            $dpjp_jumlah = $dpjp_pntp_kpl + $dpjp_masker + $dpjp_pntp_wjh + $dpjp_apron + $dpjp_srg_tgn + $dpjp_alas_kaki + $dpjp_lps_apd + $dpjp_tdk_gtg_masker + $dpjp_tdk_guna_srg_tgn;

            $no_dpjp_pntp_kpl = $dpjp->where('pntp_kpl', '0')->count();
            $no_dpjp_masker = $dpjp->where('masker', '0')->count();
            $no_dpjp_pntp_wjh = $dpjp->where('pntp_wjh', '0')->count();
            $no_dpjp_apron = $dpjp->where('apron', '0')->count();
            $no_dpjp_srg_tgn = $dpjp->where('srg_tgn', '0')->count();
            $no_dpjp_alas_kaki = $dpjp->where('alas_kaki', '0')->count();
            $no_dpjp_lps_apd = $dpjp->where('lps_apd', '0')->count();
            $no_dpjp_tdk_gtg_masker = $dpjp->where('tdk_gtg_masker', '0')->count();
            $no_dpjp_tdk_guna_srg_tgn = $dpjp->where('tdk_guna_srg_tgn', '0')->count();
            $no_dpjp_jumlah = $no_dpjp_pntp_kpl + $no_dpjp_masker + $no_dpjp_pntp_wjh + $no_dpjp_apron + $no_dpjp_srg_tgn + $no_dpjp_alas_kaki + $no_dpjp_lps_apd + $no_dpjp_tdk_gtg_masker + $no_dpjp_tdk_guna_srg_tgn;

            $denominator_dpjp = $dpjp_jumlah + $no_dpjp_jumlah;

            $farmasi_pntp_kpl = $farmasi->where('pntp_kpl', '1')->count();
            $farmasi_masker = $farmasi->where('masker', '1')->count();
            $farmasi_pntp_wjh = $farmasi->where('pntp_wjh', '1')->count();
            $farmasi_apron = $farmasi->where('apron', '1')->count();
            $farmasi_srg_tgn = $farmasi->where('srg_tgn', '1')->count();
            $farmasi_alas_kaki = $farmasi->where('alas_kaki', '1')->count();
            $farmasi_lps_apd = $farmasi->where('lps_apd', '1')->count();
            $farmasi_tdk_gtg_masker = $farmasi->where('tdk_gtg_masker', '1')->count();
            $farmasi_tdk_guna_srg_tgn = $farmasi->where('tdk_guna_srg_tgn', '1')->count();
            $farmasi_jumlah = $farmasi_pntp_kpl + $farmasi_masker + $farmasi_pntp_wjh + $farmasi_apron + $farmasi_srg_tgn + $farmasi_alas_kaki + $farmasi_lps_apd + $farmasi_tdk_gtg_masker + $farmasi_tdk_guna_srg_tgn;

            $no_farmasi_pntp_kpl = $farmasi->where('pntp_kpl', '0')->count();
            $no_farmasi_masker = $farmasi->where('masker', '0')->count();
            $no_farmasi_pntp_wjh = $farmasi->where('pntp_wjh', '0')->count();
            $no_farmasi_apron = $farmasi->where('apron', '0')->count();
            $no_farmasi_srg_tgn = $farmasi->where('srg_tgn', '0')->count();
            $no_farmasi_alas_kaki = $farmasi->where('alas_kaki', '0')->count();
            $no_farmasi_lps_apd = $farmasi->where('lps_apd', '0')->count();
            $no_farmasi_tdk_gtg_masker = $farmasi->where('tdk_gtg_masker', '0')->count();
            $no_farmasi_tdk_guna_srg_tgn = $farmasi->where('tdk_guna_srg_tgn', '0')->count();
            $no_farmasi_jumlah = $no_farmasi_pntp_kpl + $no_farmasi_masker + $no_farmasi_pntp_wjh + $no_farmasi_apron + $no_farmasi_srg_tgn + $no_farmasi_alas_kaki + $no_farmasi_lps_apd + $no_farmasi_tdk_gtg_masker + $no_farmasi_tdk_guna_srg_tgn;

            $denominator_farmasi = $farmasi_jumlah + $no_farmasi_jumlah;

            $igd_pntp_kpl = $igd->where('pntp_kpl', '1')->count();
            $igd_masker = $igd->where('masker', '1')->count();
            $igd_pntp_wjh = $igd->where('pntp_wjh', '1')->count();
            $igd_apron = $igd->where('apron', '1')->count();
            $igd_srg_tgn = $igd->where('srg_tgn', '1')->count();
            $igd_alas_kaki = $igd->where('alas_kaki', '1')->count();
            $igd_lps_apd = $igd->where('lps_apd', '1')->count();
            $igd_tdk_gtg_masker = $igd->where('tdk_gtg_masker', '1')->count();
            $igd_tdk_guna_srg_tgn = $igd->where('tdk_guna_srg_tgn', '1')->count();
            $igd_jumlah = $igd_pntp_kpl + $igd_masker + $igd_pntp_wjh + $igd_apron + $igd_srg_tgn + $igd_alas_kaki + $igd_lps_apd + $igd_tdk_gtg_masker + $igd_tdk_guna_srg_tgn;

            $no_igd_pntp_kpl = $igd->where('pntp_kpl', '0')->count();
            $no_igd_masker = $igd->where('masker', '0')->count();
            $no_igd_pntp_wjh = $igd->where('pntp_wjh', '0')->count();
            $no_igd_apron = $igd->where('apron', '0')->count();
            $no_igd_srg_tgn = $igd->where('srg_tgn', '0')->count();
            $no_igd_alas_kaki = $igd->where('alas_kaki', '0')->count();
            $no_igd_lps_apd = $igd->where('lps_apd', '0')->count();
            $no_igd_tdk_gtg_masker = $igd->where('tdk_gtg_masker', '0')->count();
            $no_igd_tdk_guna_srg_tgn = $igd->where('tdk_guna_srg_tgn', '0')->count();
            $no_igd_jumlah = $no_igd_pntp_kpl + $no_igd_masker + $no_igd_pntp_wjh + $no_igd_apron + $no_igd_srg_tgn + $no_igd_alas_kaki + $no_igd_lps_apd + $no_igd_tdk_gtg_masker + $no_igd_tdk_guna_srg_tgn;

            $denominator_igd = $igd_jumlah + $no_igd_jumlah;

            $int_pntp_kpl = $int->where('pntp_kpl', '1')->count();
            $int_masker = $int->where('masker', '1')->count();
            $int_pntp_wjh = $int->where('pntp_wjh', '1')->count();
            $int_apron = $int->where('apron', '1')->count();
            $int_srg_tgn = $int->where('srg_tgn', '1')->count();
            $int_alas_kaki = $int->where('alas_kaki', '1')->count();
            $int_lps_apd = $int->where('lps_apd', '1')->count();
            $int_tdk_gtg_masker = $int->where('tdk_gtg_masker', '1')->count();
            $int_tdk_guna_srg_tgn = $int->where('tdk_guna_srg_tgn', '1')->count();
            $int_jumlah = $int_pntp_kpl + $int_masker + $int_pntp_wjh + $int_apron + $int_srg_tgn + $int_alas_kaki + $int_lps_apd + $int_tdk_gtg_masker + $int_tdk_guna_srg_tgn;

            $no_int_pntp_kpl = $int->where('pntp_kpl', '0')->count();
            $no_int_masker = $int->where('masker', '0')->count();
            $no_int_pntp_wjh = $int->where('pntp_wjh', '0')->count();
            $no_int_apron = $int->where('apron', '0')->count();
            $no_int_srg_tgn = $int->where('srg_tgn', '0')->count();
            $no_int_alas_kaki = $int->where('alas_kaki', '0')->count();
            $no_int_lps_apd = $int->where('lps_apd', '0')->count();
            $no_int_tdk_gtg_masker = $int->where('tdk_gtg_masker', '0')->count();
            $no_int_tdk_guna_srg_tgn = $int->where('tdk_guna_srg_tgn', '0')->count();
            $no_int_jumlah = $no_int_pntp_kpl + $no_int_masker + $no_int_pntp_wjh + $no_int_apron + $no_int_srg_tgn + $no_int_alas_kaki + $no_int_lps_apd + $no_int_tdk_gtg_masker + $no_int_tdk_guna_srg_tgn;

            $denominator_int = $int_jumlah + $no_int_jumlah;

            $kbbl_pntp_kpl = $kbbl->where('pntp_kpl', '1')->count();
            $kbbl_masker = $kbbl->where('masker', '1')->count();
            $kbbl_pntp_wjh = $kbbl->where('pntp_wjh', '1')->count();
            $kbbl_apron = $kbbl->where('apron', '1')->count();
            $kbbl_srg_tgn = $kbbl->where('srg_tgn', '1')->count();
            $kbbl_alas_kaki = $kbbl->where('alas_kaki', '1')->count();
            $kbbl_lps_apd = $kbbl->where('lps_apd', '1')->count();
            $kbbl_tdk_gtg_masker = $kbbl->where('tdk_gtg_masker', '1')->count();
            $kbbl_tdk_guna_srg_tgn = $kbbl->where('tdk_guna_srg_tgn', '1')->count();
            $kbbl_jumlah = $kbbl_pntp_kpl + $kbbl_masker + $kbbl_pntp_wjh + $kbbl_apron + $kbbl_srg_tgn + $kbbl_alas_kaki + $kbbl_lps_apd + $kbbl_tdk_gtg_masker + $kbbl_tdk_guna_srg_tgn;

            $no_kbbl_pntp_kpl = $kbbl->where('pntp_kpl', '0')->count();
            $no_kbbl_masker = $kbbl->where('masker', '0')->count();
            $no_kbbl_pntp_wjh = $kbbl->where('pntp_wjh', '0')->count();
            $no_kbbl_apron = $kbbl->where('apron', '0')->count();
            $no_kbbl_srg_tgn = $kbbl->where('srg_tgn', '0')->count();
            $no_kbbl_alas_kaki = $kbbl->where('alas_kaki', '0')->count();
            $no_kbbl_lps_apd = $kbbl->where('lps_apd', '0')->count();
            $no_kbbl_tdk_gtg_masker = $kbbl->where('tdk_gtg_masker', '0')->count();
            $no_kbbl_tdk_guna_srg_tgn = $kbbl->where('tdk_guna_srg_tgn', '0')->count();
            $no_kbbl_jumlah = $no_kbbl_pntp_kpl + $no_kbbl_masker + $no_kbbl_pntp_wjh + $no_kbbl_apron + $no_kbbl_srg_tgn + $no_kbbl_alas_kaki + $no_kbbl_lps_apd + $no_kbbl_tdk_gtg_masker + $no_kbbl_tdk_guna_srg_tgn;

            $denominator_kbbl = $kbbl_jumlah + $no_kbbl_jumlah;

            $lab_pntp_kpl = $lab->where('pntp_kpl', '1')->count();
            $lab_masker = $lab->where('masker', '1')->count();
            $lab_pntp_wjh = $lab->where('pntp_wjh', '1')->count();
            $lab_apron = $lab->where('apron', '1')->count();
            $lab_srg_tgn = $lab->where('srg_tgn', '1')->count();
            $lab_alas_kaki = $lab->where('alas_kaki', '1')->count();
            $lab_lps_apd = $lab->where('lps_apd', '1')->count();
            $lab_tdk_gtg_masker = $lab->where('tdk_gtg_masker', '1')->count();
            $lab_tdk_guna_srg_tgn = $lab->where('tdk_guna_srg_tgn', '1')->count();
            $lab_jumlah = $lab_pntp_kpl + $lab_masker + $lab_pntp_wjh + $lab_apron + $lab_srg_tgn + $lab_alas_kaki + $lab_lps_apd + $lab_tdk_gtg_masker + $lab_tdk_guna_srg_tgn;

            $no_lab_pntp_kpl = $lab->where('pntp_kpl', '0')->count();
            $no_lab_masker = $lab->where('masker', '0')->count();
            $no_lab_pntp_wjh = $lab->where('pntp_wjh', '0')->count();
            $no_lab_apron = $lab->where('apron', '0')->count();
            $no_lab_srg_tgn = $lab->where('srg_tgn', '0')->count();
            $no_lab_alas_kaki = $lab->where('alas_kaki', '0')->count();
            $no_lab_lps_apd = $lab->where('lps_apd', '0')->count();
            $no_lab_tdk_gtg_masker = $lab->where('tdk_gtg_masker', '0')->count();
            $no_lab_tdk_guna_srg_tgn = $lab->where('tdk_guna_srg_tgn', '0')->count();
            $no_lab_jumlah = $no_lab_pntp_kpl + $no_lab_masker + $no_lab_pntp_wjh + $no_lab_apron + $no_lab_srg_tgn + $no_lab_alas_kaki + $no_lab_lps_apd + $no_lab_tdk_gtg_masker + $no_lab_tdk_guna_srg_tgn;

            $denominator_lab = $lab_jumlah + $no_lab_jumlah;

            $laundry_pntp_kpl = $laundry->where('pntp_kpl', '1')->count();
            $laundry_masker = $laundry->where('masker', '1')->count();
            $laundry_pntp_wjh = $laundry->where('pntp_wjh', '1')->count();
            $laundry_apron = $laundry->where('apron', '1')->count();
            $laundry_srg_tgn = $laundry->where('srg_tgn', '1')->count();
            $laundry_alas_kaki = $laundry->where('alas_kaki', '1')->count();
            $laundry_lps_apd = $laundry->where('lps_apd', '1')->count();
            $laundry_tdk_gtg_masker = $laundry->where('tdk_gtg_masker', '1')->count();
            $laundry_tdk_guna_srg_tgn = $laundry->where('tdk_guna_srg_tgn', '1')->count();
            $laundry_jumlah = $laundry_pntp_kpl + $laundry_masker + $laundry_pntp_wjh + $laundry_apron + $laundry_srg_tgn + $laundry_alas_kaki + $laundry_lps_apd + $laundry_tdk_gtg_masker + $laundry_tdk_guna_srg_tgn;

            $no_laundry_pntp_kpl = $laundry->where('pntp_kpl', '0')->count();
            $no_laundry_masker = $laundry->where('masker', '0')->count();
            $no_laundry_pntp_wjh = $laundry->where('pntp_wjh', '0')->count();
            $no_laundry_apron = $laundry->where('apron', '0')->count();
            $no_laundry_srg_tgn = $laundry->where('srg_tgn', '0')->count();
            $no_laundry_alas_kaki = $laundry->where('alas_kaki', '0')->count();
            $no_laundry_lps_apd = $laundry->where('lps_apd', '0')->count();
            $no_laundry_tdk_gtg_masker = $laundry->where('tdk_gtg_masker', '0')->count();
            $no_laundry_tdk_guna_srg_tgn = $laundry->where('tdk_guna_srg_tgn', '0')->count();
            $no_laundry_jumlah = $no_laundry_pntp_kpl + $no_laundry_masker + $no_laundry_pntp_wjh + $no_laundry_apron + $no_laundry_srg_tgn + $no_laundry_alas_kaki + $no_laundry_lps_apd + $no_laundry_tdk_gtg_masker + $no_laundry_tdk_guna_srg_tgn;

            $denominator_laundry = $laundry_jumlah + $no_laundry_jumlah;

            $ok_pntp_kpl = $ok->where('pntp_kpl', '1')->count();
            $ok_masker = $ok->where('masker', '1')->count();
            $ok_pntp_wjh = $ok->where('pntp_wjh', '1')->count();
            $ok_apron = $ok->where('apron', '1')->count();
            $ok_srg_tgn = $ok->where('srg_tgn', '1')->count();
            $ok_alas_kaki = $ok->where('alas_kaki', '1')->count();
            $ok_lps_apd = $ok->where('lps_apd', '1')->count();
            $ok_tdk_gtg_masker = $ok->where('tdk_gtg_masker', '1')->count();
            $ok_tdk_guna_srg_tgn = $ok->where('tdk_guna_srg_tgn', '1')->count();
            $ok_jumlah = $ok_pntp_kpl + $ok_masker + $ok_pntp_wjh + $ok_apron + $ok_srg_tgn + $ok_alas_kaki + $ok_lps_apd + $ok_tdk_gtg_masker + $ok_tdk_guna_srg_tgn;

            $no_ok_pntp_kpl = $ok->where('pntp_kpl', '0')->count();
            $no_ok_masker = $ok->where('masker', '0')->count();
            $no_ok_pntp_wjh = $ok->where('pntp_wjh', '0')->count();
            $no_ok_apron = $ok->where('apron', '0')->count();
            $no_ok_srg_tgn = $ok->where('srg_tgn', '0')->count();
            $no_ok_alas_kaki = $ok->where('alas_kaki', '0')->count();
            $no_ok_lps_apd = $ok->where('lps_apd', '0')->count();
            $no_ok_tdk_gtg_masker = $ok->where('tdk_gtg_masker', '0')->count();
            $no_ok_tdk_guna_srg_tgn = $ok->where('tdk_guna_srg_tgn', '0')->count();
            $no_ok_jumlah = $no_ok_pntp_kpl + $no_ok_masker + $no_ok_pntp_wjh + $no_ok_apron + $no_ok_srg_tgn + $no_ok_alas_kaki + $no_ok_lps_apd + $no_ok_tdk_gtg_masker + $no_ok_tdk_guna_srg_tgn;

            $denominator_ok = $ok_jumlah + $no_ok_jumlah;

            $lt2_pntp_kpl = $lt2->where('pntp_kpl', '1')->count();
            $lt2_masker = $lt2->where('masker', '1')->count();
            $lt2_pntp_wjh = $lt2->where('pntp_wjh', '1')->count();
            $lt2_apron = $lt2->where('apron', '1')->count();
            $lt2_srg_tgn = $lt2->where('srg_tgn', '1')->count();
            $lt2_alas_kaki = $lt2->where('alas_kaki', '1')->count();
            $lt2_lps_apd = $lt2->where('lps_apd', '1')->count();
            $lt2_tdk_gtg_masker = $lt2->where('tdk_gtg_masker', '1')->count();
            $lt2_tdk_guna_srg_tgn = $lt2->where('tdk_guna_srg_tgn', '1')->count();
            $lt2_jumlah = $lt2_pntp_kpl + $lt2_masker + $lt2_pntp_wjh + $lt2_apron + $lt2_srg_tgn + $lt2_alas_kaki + $lt2_lps_apd + $lt2_tdk_gtg_masker + $lt2_tdk_guna_srg_tgn;

            $no_lt2_pntp_kpl = $lt2->where('pntp_kpl', '0')->count();
            $no_lt2_masker = $lt2->where('masker', '0')->count();
            $no_lt2_pntp_wjh = $lt2->where('pntp_wjh', '0')->count();
            $no_lt2_apron = $lt2->where('apron', '0')->count();
            $no_lt2_srg_tgn = $lt2->where('srg_tgn', '0')->count();
            $no_lt2_alas_kaki = $lt2->where('alas_kaki', '0')->count();
            $no_lt2_lps_apd = $lt2->where('lps_apd', '0')->count();
            $no_lt2_tdk_gtg_masker = $lt2->where('tdk_gtg_masker', '0')->count();
            $no_lt2_tdk_guna_srg_tgn = $lt2->where('tdk_guna_srg_tgn', '0')->count();
            $no_lt2_jumlah = $no_lt2_pntp_kpl + $no_lt2_masker + $no_lt2_pntp_wjh + $no_lt2_apron + $no_lt2_srg_tgn + $no_lt2_alas_kaki + $no_lt2_lps_apd + $no_lt2_tdk_gtg_masker + $no_lt2_tdk_guna_srg_tgn;

            $denominator_lt2 = $lt2_jumlah + $no_lt2_jumlah;

            $lt4_pntp_kpl = $lt4->where('pntp_kpl', '1')->count();
            $lt4_masker = $lt4->where('masker', '1')->count();
            $lt4_pntp_wjh = $lt4->where('pntp_wjh', '1')->count();
            $lt4_apron = $lt4->where('apron', '1')->count();
            $lt4_srg_tgn = $lt4->where('srg_tgn', '1')->count();
            $lt4_alas_kaki = $lt4->where('alas_kaki', '1')->count();
            $lt4_lps_apd = $lt4->where('lps_apd', '1')->count();
            $lt4_tdk_gtg_masker = $lt4->where('tdk_gtg_masker', '1')->count();
            $lt4_tdk_guna_srg_tgn = $lt4->where('tdk_guna_srg_tgn', '1')->count();
            $lt4_jumlah = $lt4_pntp_kpl + $lt4_masker + $lt4_pntp_wjh + $lt4_apron + $lt4_srg_tgn + $lt4_alas_kaki + $lt4_lps_apd + $lt4_tdk_gtg_masker + $lt4_tdk_guna_srg_tgn;

            $no_lt4_pntp_kpl = $lt4->where('pntp_kpl', '0')->count();
            $no_lt4_masker = $lt4->where('masker', '0')->count();
            $no_lt4_pntp_wjh = $lt4->where('pntp_wjh', '0')->count();
            $no_lt4_apron = $lt4->where('apron', '0')->count();
            $no_lt4_srg_tgn = $lt4->where('srg_tgn', '0')->count();
            $no_lt4_alas_kaki = $lt4->where('alas_kaki', '0')->count();
            $no_lt4_lps_apd = $lt4->where('lps_apd', '0')->count();
            $no_lt4_tdk_gtg_masker = $lt4->where('tdk_gtg_masker', '0')->count();
            $no_lt4_tdk_guna_srg_tgn = $lt4->where('tdk_guna_srg_tgn', '0')->count();
            $no_lt4_jumlah = $no_lt4_pntp_kpl + $no_lt4_masker + $no_lt4_pntp_wjh + $no_lt4_apron + $no_lt4_srg_tgn + $no_lt4_alas_kaki + $no_lt4_lps_apd + $no_lt4_tdk_gtg_masker + $no_lt4_tdk_guna_srg_tgn;

            $denominator_lt4 = $lt4_jumlah + $no_lt4_jumlah;

            $lt5_pntp_kpl = $lt5->where('pntp_kpl', '1')->count();
            $lt5_masker = $lt5->where('masker', '1')->count();
            $lt5_pntp_wjh = $lt5->where('pntp_wjh', '1')->count();
            $lt5_apron = $lt5->where('apron', '1')->count();
            $lt5_srg_tgn = $lt5->where('srg_tgn', '1')->count();
            $lt5_alas_kaki = $lt5->where('alas_kaki', '1')->count();
            $lt5_lps_apd = $lt5->where('lps_apd', '1')->count();
            $lt5_tdk_gtg_masker = $lt5->where('tdk_gtg_masker', '1')->count();
            $lt5_tdk_guna_srg_tgn = $lt5->where('tdk_guna_srg_tgn', '1')->count();
            $lt5_jumlah = $lt5_pntp_kpl + $lt5_masker + $lt5_pntp_wjh + $lt5_apron + $lt5_srg_tgn + $lt5_alas_kaki + $lt5_lps_apd + $lt5_tdk_gtg_masker + $lt5_tdk_guna_srg_tgn;

            $no_lt5_pntp_kpl = $lt5->where('pntp_kpl', '0')->count();
            $no_lt5_masker = $lt5->where('masker', '0')->count();
            $no_lt5_pntp_wjh = $lt5->where('pntp_wjh', '0')->count();
            $no_lt5_apron = $lt5->where('apron', '0')->count();
            $no_lt5_srg_tgn = $lt5->where('srg_tgn', '0')->count();
            $no_lt5_alas_kaki = $lt5->where('alas_kaki', '0')->count();
            $no_lt5_lps_apd = $lt5->where('lps_apd', '0')->count();
            $no_lt5_tdk_gtg_masker = $lt5->where('tdk_gtg_masker', '0')->count();
            $no_lt5_tdk_guna_srg_tgn = $lt5->where('tdk_guna_srg_tgn', '0')->count();
            $no_lt5_jumlah = $no_lt5_pntp_kpl + $no_lt5_masker + $no_lt5_pntp_wjh + $no_lt5_apron + $no_lt5_srg_tgn + $no_lt5_alas_kaki + $no_lt5_lps_apd + $no_lt5_tdk_gtg_masker + $no_lt5_tdk_guna_srg_tgn;

            $denominator_lt5 = $lt5_jumlah + $no_lt5_jumlah;

            $poli_pntp_kpl = $poli->where('pntp_kpl', '1')->count();
            $poli_masker = $poli->where('masker', '1')->count();
            $poli_pntp_wjh = $poli->where('pntp_wjh', '1')->count();
            $poli_apron = $poli->where('apron', '1')->count();
            $poli_srg_tgn = $poli->where('srg_tgn', '1')->count();
            $poli_alas_kaki = $poli->where('alas_kaki', '1')->count();
            $poli_lps_apd = $poli->where('lps_apd', '1')->count();
            $poli_tdk_gtg_masker = $poli->where('tdk_gtg_masker', '1')->count();
            $poli_tdk_guna_srg_tgn = $poli->where('tdk_guna_srg_tgn', '1')->count();
            $poli_jumlah = $poli_pntp_kpl + $poli_masker + $poli_pntp_wjh + $poli_apron + $poli_srg_tgn + $poli_alas_kaki + $poli_lps_apd + $poli_tdk_gtg_masker + $poli_tdk_guna_srg_tgn;

            $no_poli_pntp_kpl = $poli->where('pntp_kpl', '0')->count();
            $no_poli_masker = $poli->where('masker', '0')->count();
            $no_poli_pntp_wjh = $poli->where('pntp_wjh', '0')->count();
            $no_poli_apron = $poli->where('apron', '0')->count();
            $no_poli_srg_tgn = $poli->where('srg_tgn', '0')->count();
            $no_poli_alas_kaki = $poli->where('alas_kaki', '0')->count();
            $no_poli_lps_apd = $poli->where('lps_apd', '0')->count();
            $no_poli_tdk_gtg_masker = $poli->where('tdk_gtg_masker', '0')->count();
            $no_poli_tdk_guna_srg_tgn = $poli->where('tdk_guna_srg_tgn', '0')->count();
            $no_poli_jumlah = $no_poli_pntp_kpl + $no_poli_masker + $no_poli_pntp_wjh + $no_poli_apron + $no_poli_srg_tgn + $no_poli_alas_kaki + $no_poli_lps_apd + $no_poli_tdk_gtg_masker + $no_poli_tdk_guna_srg_tgn;

            $denominator_poli = $poli_jumlah + $no_poli_jumlah;

            $rad_pntp_kpl = $rad->where('pntp_kpl', '1')->count();
            $rad_masker = $rad->where('masker', '1')->count();
            $rad_pntp_wjh = $rad->where('pntp_wjh', '1')->count();
            $rad_apron = $rad->where('apron', '1')->count();
            $rad_srg_tgn = $rad->where('srg_tgn', '1')->count();
            $rad_alas_kaki = $rad->where('alas_kaki', '1')->count();
            $rad_lps_apd = $rad->where('lps_apd', '1')->count();
            $rad_tdk_gtg_masker = $rad->where('tdk_gtg_masker', '1')->count();
            $rad_tdk_guna_srg_tgn = $rad->where('tdk_guna_srg_tgn', '1')->count();
            $rad_jumlah = $rad_pntp_kpl + $rad_masker + $rad_pntp_wjh + $rad_apron + $rad_srg_tgn + $rad_alas_kaki + $rad_lps_apd + $rad_tdk_gtg_masker + $rad_tdk_guna_srg_tgn;

            $no_rad_pntp_kpl = $rad->where('pntp_kpl', '0')->count();
            $no_rad_masker = $rad->where('masker', '0')->count();
            $no_rad_pntp_wjh = $rad->where('pntp_wjh', '0')->count();
            $no_rad_apron = $rad->where('apron', '0')->count();
            $no_rad_srg_tgn = $rad->where('srg_tgn', '0')->count();
            $no_rad_alas_kaki = $rad->where('alas_kaki', '0')->count();
            $no_rad_lps_apd = $rad->where('lps_apd', '0')->count();
            $no_rad_tdk_gtg_masker = $rad->where('tdk_gtg_masker', '0')->count();
            $no_rad_tdk_guna_srg_tgn = $rad->where('tdk_guna_srg_tgn', '0')->count();
            $no_rad_jumlah = $no_rad_pntp_kpl + $no_rad_masker + $no_rad_pntp_wjh + $no_rad_apron + $no_rad_srg_tgn + $no_rad_alas_kaki + $no_rad_lps_apd + $no_rad_tdk_gtg_masker + $no_rad_tdk_guna_srg_tgn;

            $denominator_rad = $rad_jumlah + $no_rad_jumlah;

            $vk_pntp_kpl = $vk->where('pntp_kpl', '1')->count();
            $vk_masker = $vk->where('masker', '1')->count();
            $vk_pntp_wjh = $vk->where('pntp_wjh', '1')->count();
            $vk_apron = $vk->where('apron', '1')->count();
            $vk_srg_tgn = $vk->where('srg_tgn', '1')->count();
            $vk_alas_kaki = $vk->where('alas_kaki', '1')->count();
            $vk_lps_apd = $vk->where('lps_apd', '1')->count();
            $vk_tdk_gtg_masker = $vk->where('tdk_gtg_masker', '1')->count();
            $vk_tdk_guna_srg_tgn = $vk->where('tdk_guna_srg_tgn', '1')->count();
            $vk_jumlah = $vk_pntp_kpl + $vk_masker + $vk_pntp_wjh + $vk_apron + $vk_srg_tgn + $vk_alas_kaki + $vk_lps_apd + $vk_tdk_gtg_masker + $vk_tdk_guna_srg_tgn;

            $no_vk_pntp_kpl = $vk->where('pntp_kpl', '0')->count();
            $no_vk_masker = $vk->where('masker', '0')->count();
            $no_vk_pntp_wjh = $vk->where('pntp_wjh', '0')->count();
            $no_vk_apron = $vk->where('apron', '0')->count();
            $no_vk_srg_tgn = $vk->where('srg_tgn', '0')->count();
            $no_vk_alas_kaki = $vk->where('alas_kaki', '0')->count();
            $no_vk_lps_apd = $vk->where('lps_apd', '0')->count();
            $no_vk_tdk_gtg_masker = $vk->where('tdk_gtg_masker', '0')->count();
            $no_vk_tdk_guna_srg_tgn = $vk->where('tdk_guna_srg_tgn', '0')->count();
            $no_vk_jumlah = $no_vk_pntp_kpl + $no_vk_masker + $no_vk_pntp_wjh + $no_vk_apron + $no_vk_srg_tgn + $no_vk_alas_kaki + $no_vk_lps_apd + $no_vk_tdk_gtg_masker + $no_vk_tdk_guna_srg_tgn;

            $denominator_vk = $vk_jumlah + $no_vk_jumlah;

            $tanggal = Carbon::parse($request->input('dari'))->isoFormat('DD MMMM YYYY') . ' - ' . Carbon::parse($request->input('sampai'))->isoFormat('DD MMMM YYYY');

            return Excel::download(new ExportApd(
                $cssu_pntp_kpl,
                $cssu_masker,
                $cssu_pntp_wjh,
                $cssu_apron,
                $cssu_srg_tgn,
                $cssu_alas_kaki,
                $cssu_lps_apd,
                $cssu_tdk_gtg_masker,
                $cssu_tdk_guna_srg_tgn,
                $cssu_jumlah,

                $no_cssu_pntp_kpl,
                $no_cssu_masker,
                $no_cssu_pntp_wjh,
                $no_cssu_apron,
                $no_cssu_srg_tgn,
                $no_cssu_alas_kaki,
                $no_cssu_lps_apd,
                $no_cssu_tdk_gtg_masker,
                $no_cssu_tdk_guna_srg_tgn,
                $no_cssu_jumlah,

                $denominator_cssu,

                $dapur_pntp_kpl,
                $dapur_masker,
                $dapur_pntp_wjh,
                $dapur_apron,
                $dapur_srg_tgn,
                $dapur_alas_kaki,
                $dapur_lps_apd,
                $dapur_tdk_gtg_masker,
                $dapur_tdk_guna_srg_tgn,
                $dapur_jumlah,

                $no_dapur_pntp_kpl,
                $no_dapur_masker,
                $no_dapur_pntp_wjh,
                $no_dapur_apron,
                $no_dapur_srg_tgn,
                $no_dapur_alas_kaki,
                $no_dapur_lps_apd,
                $no_dapur_tdk_gtg_masker,
                $no_dapur_tdk_guna_srg_tgn,
                $no_dapur_jumlah,

                $denominator_dapur,

                $dpjp_pntp_kpl,
                $dpjp_masker,
                $dpjp_pntp_wjh,
                $dpjp_apron,
                $dpjp_srg_tgn,
                $dpjp_alas_kaki,
                $dpjp_lps_apd,
                $dpjp_tdk_gtg_masker,
                $dpjp_tdk_guna_srg_tgn,
                $dpjp_jumlah,

                $no_dpjp_pntp_kpl,
                $no_dpjp_masker,
                $no_dpjp_pntp_wjh,
                $no_dpjp_apron,
                $no_dpjp_srg_tgn,
                $no_dpjp_alas_kaki,
                $no_dpjp_lps_apd,
                $no_dpjp_tdk_gtg_masker,
                $no_dpjp_tdk_guna_srg_tgn,
                $no_dpjp_jumlah,

                $denominator_dpjp,

                $farmasi_pntp_kpl,
                $farmasi_masker,
                $farmasi_pntp_wjh,
                $farmasi_apron,
                $farmasi_srg_tgn,
                $farmasi_alas_kaki,
                $farmasi_lps_apd,
                $farmasi_tdk_gtg_masker,
                $farmasi_tdk_guna_srg_tgn,
                $farmasi_jumlah,

                $no_farmasi_pntp_kpl,
                $no_farmasi_masker,
                $no_farmasi_pntp_wjh,
                $no_farmasi_apron,
                $no_farmasi_srg_tgn,
                $no_farmasi_alas_kaki,
                $no_farmasi_lps_apd,
                $no_farmasi_tdk_gtg_masker,
                $no_farmasi_tdk_guna_srg_tgn,
                $no_farmasi_jumlah,

                $denominator_farmasi,

                $igd_pntp_kpl,
                $igd_masker,
                $igd_pntp_wjh,
                $igd_apron,
                $igd_srg_tgn,
                $igd_alas_kaki,
                $igd_lps_apd,
                $igd_tdk_gtg_masker,
                $igd_tdk_guna_srg_tgn,
                $igd_jumlah,

                $no_igd_pntp_kpl,
                $no_igd_masker,
                $no_igd_pntp_wjh,
                $no_igd_apron,
                $no_igd_srg_tgn,
                $no_igd_alas_kaki,
                $no_igd_lps_apd,
                $no_igd_tdk_gtg_masker,
                $no_igd_tdk_guna_srg_tgn,
                $no_igd_jumlah,

                $denominator_igd,

                $int_pntp_kpl,
                $int_masker,
                $int_pntp_wjh,
                $int_apron,
                $int_srg_tgn,
                $int_alas_kaki,
                $int_lps_apd,
                $int_tdk_gtg_masker,
                $int_tdk_guna_srg_tgn,
                $int_jumlah,

                $no_int_pntp_kpl,
                $no_int_masker,
                $no_int_pntp_wjh,
                $no_int_apron,
                $no_int_srg_tgn,
                $no_int_alas_kaki,
                $no_int_lps_apd,
                $no_int_tdk_gtg_masker,
                $no_int_tdk_guna_srg_tgn,
                $no_int_jumlah,

                $denominator_int,

                $kbbl_pntp_kpl,
                $kbbl_masker,
                $kbbl_pntp_wjh,
                $kbbl_apron,
                $kbbl_srg_tgn,
                $kbbl_alas_kaki,
                $kbbl_lps_apd,
                $kbbl_tdk_gtg_masker,
                $kbbl_tdk_guna_srg_tgn,
                $kbbl_jumlah,

                $no_kbbl_pntp_kpl,
                $no_kbbl_masker,
                $no_kbbl_pntp_wjh,
                $no_kbbl_apron,
                $no_kbbl_srg_tgn,
                $no_kbbl_alas_kaki,
                $no_kbbl_lps_apd,
                $no_kbbl_tdk_gtg_masker,
                $no_kbbl_tdk_guna_srg_tgn,
                $no_kbbl_jumlah,

                $denominator_kbbl,

                $lab_pntp_kpl,
                $lab_masker,
                $lab_pntp_wjh,
                $lab_apron,
                $lab_srg_tgn,
                $lab_alas_kaki,
                $lab_lps_apd,
                $lab_tdk_gtg_masker,
                $lab_tdk_guna_srg_tgn,
                $lab_jumlah,

                $no_lab_pntp_kpl,
                $no_lab_masker,
                $no_lab_pntp_wjh,
                $no_lab_apron,
                $no_lab_srg_tgn,
                $no_lab_alas_kaki,
                $no_lab_lps_apd,
                $no_lab_tdk_gtg_masker,
                $no_lab_tdk_guna_srg_tgn,
                $no_lab_jumlah,

                $denominator_lab,

                $laundry_pntp_kpl,
                $laundry_masker,
                $laundry_pntp_wjh,
                $laundry_apron,
                $laundry_srg_tgn,
                $laundry_alas_kaki,
                $laundry_lps_apd,
                $laundry_tdk_gtg_masker,
                $laundry_tdk_guna_srg_tgn,
                $laundry_jumlah,

                $no_laundry_pntp_kpl,
                $no_laundry_masker,
                $no_laundry_pntp_wjh,
                $no_laundry_apron,
                $no_laundry_srg_tgn,
                $no_laundry_alas_kaki,
                $no_laundry_lps_apd,
                $no_laundry_tdk_gtg_masker,
                $no_laundry_tdk_guna_srg_tgn,
                $no_laundry_jumlah,

                $denominator_laundry,

                $ok_pntp_kpl,
                $ok_masker,
                $ok_pntp_wjh,
                $ok_apron,
                $ok_srg_tgn,
                $ok_alas_kaki,
                $ok_lps_apd,
                $ok_tdk_gtg_masker,
                $ok_tdk_guna_srg_tgn,
                $ok_jumlah,

                $no_ok_pntp_kpl,
                $no_ok_masker,
                $no_ok_pntp_wjh,
                $no_ok_apron,
                $no_ok_srg_tgn,
                $no_ok_alas_kaki,
                $no_ok_lps_apd,
                $no_ok_tdk_gtg_masker,
                $no_ok_tdk_guna_srg_tgn,
                $no_ok_jumlah,

                $denominator_ok,

                $lt2_pntp_kpl,
                $lt2_masker,
                $lt2_pntp_wjh,
                $lt2_apron,
                $lt2_srg_tgn,
                $lt2_alas_kaki,
                $lt2_lps_apd,
                $lt2_tdk_gtg_masker,
                $lt2_tdk_guna_srg_tgn,
                $lt2_jumlah,

                $no_lt2_pntp_kpl,
                $no_lt2_masker,
                $no_lt2_pntp_wjh,
                $no_lt2_apron,
                $no_lt2_srg_tgn,
                $no_lt2_alas_kaki,
                $no_lt2_lps_apd,
                $no_lt2_tdk_gtg_masker,
                $no_lt2_tdk_guna_srg_tgn,
                $no_lt2_jumlah,

                $denominator_lt2,

                $lt4_pntp_kpl,
                $lt4_masker,
                $lt4_pntp_wjh,
                $lt4_apron,
                $lt4_srg_tgn,
                $lt4_alas_kaki,
                $lt4_lps_apd,
                $lt4_tdk_gtg_masker,
                $lt4_tdk_guna_srg_tgn,
                $lt4_jumlah,

                $no_lt4_pntp_kpl,
                $no_lt4_masker,
                $no_lt4_pntp_wjh,
                $no_lt4_apron,
                $no_lt4_srg_tgn,
                $no_lt4_alas_kaki,
                $no_lt4_lps_apd,
                $no_lt4_tdk_gtg_masker,
                $no_lt4_tdk_guna_srg_tgn,
                $no_lt4_jumlah,

                $denominator_lt4,

                $lt5_pntp_kpl,
                $lt5_masker,
                $lt5_pntp_wjh,
                $lt5_apron,
                $lt5_srg_tgn,
                $lt5_alas_kaki,
                $lt5_lps_apd,
                $lt5_tdk_gtg_masker,
                $lt5_tdk_guna_srg_tgn,
                $lt5_jumlah,

                $no_lt5_pntp_kpl,
                $no_lt5_masker,
                $no_lt5_pntp_wjh,
                $no_lt5_apron,
                $no_lt5_srg_tgn,
                $no_lt5_alas_kaki,
                $no_lt5_lps_apd,
                $no_lt5_tdk_gtg_masker,
                $no_lt5_tdk_guna_srg_tgn,
                $no_lt5_jumlah,

                $denominator_lt5,

                $poli_pntp_kpl,
                $poli_masker,
                $poli_pntp_wjh,
                $poli_apron,
                $poli_srg_tgn,
                $poli_alas_kaki,
                $poli_lps_apd,
                $poli_tdk_gtg_masker,
                $poli_tdk_guna_srg_tgn,
                $poli_jumlah,

                $no_poli_pntp_kpl,
                $no_poli_masker,
                $no_poli_pntp_wjh,
                $no_poli_apron,
                $no_poli_srg_tgn,
                $no_poli_alas_kaki,
                $no_poli_lps_apd,
                $no_poli_tdk_gtg_masker,
                $no_poli_tdk_guna_srg_tgn,
                $no_poli_jumlah,

                $denominator_poli,

                $rad_pntp_kpl,
                $rad_masker,
                $rad_pntp_wjh,
                $rad_apron,
                $rad_srg_tgn,
                $rad_alas_kaki,
                $rad_lps_apd,
                $rad_tdk_gtg_masker,
                $rad_tdk_guna_srg_tgn,
                $rad_jumlah,

                $no_rad_pntp_kpl,
                $no_rad_masker,
                $no_rad_pntp_wjh,
                $no_rad_apron,
                $no_rad_srg_tgn,
                $no_rad_alas_kaki,
                $no_rad_lps_apd,
                $no_rad_tdk_gtg_masker,
                $no_rad_tdk_guna_srg_tgn,
                $no_rad_jumlah,

                $denominator_rad,

                $vk_pntp_kpl,
                $vk_masker,
                $vk_pntp_wjh,
                $vk_apron,
                $vk_srg_tgn,
                $vk_alas_kaki,
                $vk_lps_apd,
                $vk_tdk_gtg_masker,
                $vk_tdk_guna_srg_tgn,
                $vk_jumlah,

                $no_vk_pntp_kpl,
                $no_vk_masker,
                $no_vk_pntp_wjh,
                $no_vk_apron,
                $no_vk_srg_tgn,
                $no_vk_alas_kaki,
                $no_vk_lps_apd,
                $no_vk_tdk_gtg_masker,
                $no_vk_tdk_guna_srg_tgn,
                $no_vk_jumlah,

                $denominator_vk,

                $tabel,
                $rekap,
                $tanggal
            ), 'Rekap APD ' . $tanggal . '.xlsx');
        } else {
            return Redirect::back()->withErrors(['msg' => 'Tanggal tidak boleh Lebih kecil dari sebelumnya']);
        }
    }

    // // public function excelDetail(Request $request)
    // // { 
    // //     $tgl_skg = date('Y-m-d');
    // //     // dd($tgl_skg);

    // //     if ($request->input('dari') <= $request->input('sampai')) {
    // //         $tabel = Surveilans::whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
    // //             ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
    // //             ->latest('id')->paginate(1000);
    // //         // dd($tabel);
    // //         $tanggal = Carbon::parse($request->input('dari'))->isoFormat('DD MMMM YYYY') . ' - ' . Carbon::parse($request->input('sampai'))->isoFormat('DD MMMM YYYY');

    // //         return Excel::download(new detailRekapExcel(
    // //             $tabel,
    // //             $tanggal
    // //         ), 'Rekap Surveilans ' . $tanggal . '.xlsx');
    // //     } else {
    // //         return Redirect::back()->withErrors(['msg' => 'Tanggal tidak boleh Lebih kecil dari sebelumnya']);
    // //     }
    // // }

    public function pdf(Request $request)
    {
        $tgl_skg = date('Y-m-d');

        if ($request->input('dari') <= $request->input('sampai')) {
            $tabel = Apd::whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')->paginate(1000);
            // dd($tabel);

            $rekap = RekapApd::whereDate('dari', '=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('sampai', '=', $request->input('sampai') ?? $tgl_skg)
                ->get();

            $analisa = RekapApd::select('analisa')
                ->whereDate('dari', '=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('sampai', '=', $request->input('sampai') ?? $tgl_skg)
                ->get();

            $tindak_lanjut = RekapApd::select('tindak_lanjut')
                ->whereDate('dari', '=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('sampai', '=', $request->input('sampai') ?? $tgl_skg)
                ->get();

            $cssu = Apd::where('unit', 'CSSU')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $dapur = Apd::where('unit', 'Dapur')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $dpjp = Apd::where('unit', 'DPJP')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $farmasi = Apd::where('unit', 'Farmasi')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $igd = Apd::where('unit', 'IGD')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $int = Apd::where('unit', 'Intensif')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $kbbl = Apd::where('unit', 'KBBL')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lab = Apd::where('unit', 'Laboratorium')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $laundry = Apd::where('unit', 'Laundry')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $ok = Apd::where('unit', 'OK')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt2 = Apd::where('unit', 'Perawatan Eksekutif lt.2')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt4 = Apd::where('unit', 'Perawatan Reguler lt.4')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt5 = Apd::where('unit', 'Perawatan Reguler lt.5')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $poli = Apd::where('unit', 'Poliklinik')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $rad = Apd::where('unit', 'Radiologi')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $vk = Apd::where('unit', 'VK')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();

            $cssu_pntp_kpl = $cssu->where('pntp_kpl', '1')->count();
            $cssu_masker = $cssu->where('masker', '1')->count();
            $cssu_pntp_wjh = $cssu->where('pntp_wjh', '1')->count();
            $cssu_apron = $cssu->where('apron', '1')->count();
            $cssu_srg_tgn = $cssu->where('srg_tgn', '1')->count();
            $cssu_alas_kaki = $cssu->where('alas_kaki', '1')->count();
            $cssu_lps_apd = $cssu->where('lps_apd', '1')->count();
            $cssu_tdk_gtg_masker = $cssu->where('tdk_gtg_masker', '1')->count();
            $cssu_tdk_guna_srg_tgn = $cssu->where('tdk_guna_srg_tgn', '1')->count();
            $cssu_jumlah = $cssu_pntp_kpl + $cssu_masker + $cssu_pntp_wjh + $cssu_apron + $cssu_srg_tgn + $cssu_alas_kaki + $cssu_lps_apd + $cssu_tdk_gtg_masker + $cssu_tdk_guna_srg_tgn;

            $no_cssu_pntp_kpl = $cssu->where('pntp_kpl', '0')->count();
            $no_cssu_masker = $cssu->where('masker', '0')->count();
            $no_cssu_pntp_wjh = $cssu->where('pntp_wjh', '0')->count();
            $no_cssu_apron = $cssu->where('apron', '0')->count();
            $no_cssu_srg_tgn = $cssu->where('srg_tgn', '0')->count();
            $no_cssu_alas_kaki = $cssu->where('alas_kaki', '0')->count();
            $no_cssu_lps_apd = $cssu->where('lps_apd', '0')->count();
            $no_cssu_tdk_gtg_masker = $cssu->where('tdk_gtg_masker', '0')->count();
            $no_cssu_tdk_guna_srg_tgn = $cssu->where('tdk_guna_srg_tgn', '0')->count();
            $no_cssu_jumlah = $no_cssu_pntp_kpl + $no_cssu_masker + $no_cssu_pntp_wjh + $no_cssu_apron + $no_cssu_srg_tgn + $no_cssu_alas_kaki + $no_cssu_lps_apd + $no_cssu_tdk_gtg_masker + $no_cssu_tdk_guna_srg_tgn;

            $denominator_cssu = $cssu_jumlah + $no_cssu_jumlah;

            $dapur_pntp_kpl = $dapur->where('pntp_kpl', '1')->count();
            $dapur_masker = $dapur->where('masker', '1')->count();
            $dapur_pntp_wjh = $dapur->where('pntp_wjh', '1')->count();
            $dapur_apron = $dapur->where('apron', '1')->count();
            $dapur_srg_tgn = $dapur->where('srg_tgn', '1')->count();
            $dapur_alas_kaki = $dapur->where('alas_kaki', '1')->count();
            $dapur_lps_apd = $dapur->where('lps_apd', '1')->count();
            $dapur_tdk_gtg_masker = $dapur->where('tdk_gtg_masker', '1')->count();
            $dapur_tdk_guna_srg_tgn = $dapur->where('tdk_guna_srg_tgn', '1')->count();
            $dapur_jumlah = $dapur_pntp_kpl + $dapur_masker + $dapur_pntp_wjh + $dapur_apron + $dapur_srg_tgn + $dapur_alas_kaki + $dapur_lps_apd + $dapur_tdk_gtg_masker + $dapur_tdk_guna_srg_tgn;

            $no_dapur_pntp_kpl = $dapur->where('pntp_kpl', '0')->count();
            $no_dapur_masker = $dapur->where('masker', '0')->count();
            $no_dapur_pntp_wjh = $dapur->where('pntp_wjh', '0')->count();
            $no_dapur_apron = $dapur->where('apron', '0')->count();
            $no_dapur_srg_tgn = $dapur->where('srg_tgn', '0')->count();
            $no_dapur_alas_kaki = $dapur->where('alas_kaki', '0')->count();
            $no_dapur_lps_apd = $dapur->where('lps_apd', '0')->count();
            $no_dapur_tdk_gtg_masker = $dapur->where('tdk_gtg_masker', '0')->count();
            $no_dapur_tdk_guna_srg_tgn = $dapur->where('tdk_guna_srg_tgn', '0')->count();
            $no_dapur_jumlah = $no_dapur_pntp_kpl + $no_dapur_masker + $no_dapur_pntp_wjh + $no_dapur_apron + $no_dapur_srg_tgn + $no_dapur_alas_kaki + $no_dapur_lps_apd + $no_dapur_tdk_gtg_masker + $no_dapur_tdk_guna_srg_tgn;

            $denominator_dapur = $dapur_jumlah + $no_dapur_jumlah;

            $dpjp_pntp_kpl = $dpjp->where('pntp_kpl', '1')->count();
            $dpjp_masker = $dpjp->where('masker', '1')->count();
            $dpjp_pntp_wjh = $dpjp->where('pntp_wjh', '1')->count();
            $dpjp_apron = $dpjp->where('apron', '1')->count();
            $dpjp_srg_tgn = $dpjp->where('srg_tgn', '1')->count();
            $dpjp_alas_kaki = $dpjp->where('alas_kaki', '1')->count();
            $dpjp_lps_apd = $dpjp->where('lps_apd', '1')->count();
            $dpjp_tdk_gtg_masker = $dpjp->where('tdk_gtg_masker', '1')->count();
            $dpjp_tdk_guna_srg_tgn = $dpjp->where('tdk_guna_srg_tgn', '1')->count();
            $dpjp_jumlah = $dpjp_pntp_kpl + $dpjp_masker + $dpjp_pntp_wjh + $dpjp_apron + $dpjp_srg_tgn + $dpjp_alas_kaki + $dpjp_lps_apd + $dpjp_tdk_gtg_masker + $dpjp_tdk_guna_srg_tgn;

            $no_dpjp_pntp_kpl = $dpjp->where('pntp_kpl', '0')->count();
            $no_dpjp_masker = $dpjp->where('masker', '0')->count();
            $no_dpjp_pntp_wjh = $dpjp->where('pntp_wjh', '0')->count();
            $no_dpjp_apron = $dpjp->where('apron', '0')->count();
            $no_dpjp_srg_tgn = $dpjp->where('srg_tgn', '0')->count();
            $no_dpjp_alas_kaki = $dpjp->where('alas_kaki', '0')->count();
            $no_dpjp_lps_apd = $dpjp->where('lps_apd', '0')->count();
            $no_dpjp_tdk_gtg_masker = $dpjp->where('tdk_gtg_masker', '0')->count();
            $no_dpjp_tdk_guna_srg_tgn = $dpjp->where('tdk_guna_srg_tgn', '0')->count();
            $no_dpjp_jumlah = $no_dpjp_pntp_kpl + $no_dpjp_masker + $no_dpjp_pntp_wjh + $no_dpjp_apron + $no_dpjp_srg_tgn + $no_dpjp_alas_kaki + $no_dpjp_lps_apd + $no_dpjp_tdk_gtg_masker + $no_dpjp_tdk_guna_srg_tgn;

            $denominator_dpjp = $dpjp_jumlah + $no_dpjp_jumlah;

            $farmasi_pntp_kpl = $farmasi->where('pntp_kpl', '1')->count();
            $farmasi_masker = $farmasi->where('masker', '1')->count();
            $farmasi_pntp_wjh = $farmasi->where('pntp_wjh', '1')->count();
            $farmasi_apron = $farmasi->where('apron', '1')->count();
            $farmasi_srg_tgn = $farmasi->where('srg_tgn', '1')->count();
            $farmasi_alas_kaki = $farmasi->where('alas_kaki', '1')->count();
            $farmasi_lps_apd = $farmasi->where('lps_apd', '1')->count();
            $farmasi_tdk_gtg_masker = $farmasi->where('tdk_gtg_masker', '1')->count();
            $farmasi_tdk_guna_srg_tgn = $farmasi->where('tdk_guna_srg_tgn', '1')->count();
            $farmasi_jumlah = $farmasi_pntp_kpl + $farmasi_masker + $farmasi_pntp_wjh + $farmasi_apron + $farmasi_srg_tgn + $farmasi_alas_kaki + $farmasi_lps_apd + $farmasi_tdk_gtg_masker + $farmasi_tdk_guna_srg_tgn;

            $no_farmasi_pntp_kpl = $farmasi->where('pntp_kpl', '0')->count();
            $no_farmasi_masker = $farmasi->where('masker', '0')->count();
            $no_farmasi_pntp_wjh = $farmasi->where('pntp_wjh', '0')->count();
            $no_farmasi_apron = $farmasi->where('apron', '0')->count();
            $no_farmasi_srg_tgn = $farmasi->where('srg_tgn', '0')->count();
            $no_farmasi_alas_kaki = $farmasi->where('alas_kaki', '0')->count();
            $no_farmasi_lps_apd = $farmasi->where('lps_apd', '0')->count();
            $no_farmasi_tdk_gtg_masker = $farmasi->where('tdk_gtg_masker', '0')->count();
            $no_farmasi_tdk_guna_srg_tgn = $farmasi->where('tdk_guna_srg_tgn', '0')->count();
            $no_farmasi_jumlah = $no_farmasi_pntp_kpl + $no_farmasi_masker + $no_farmasi_pntp_wjh + $no_farmasi_apron + $no_farmasi_srg_tgn + $no_farmasi_alas_kaki + $no_farmasi_lps_apd + $no_farmasi_tdk_gtg_masker + $no_farmasi_tdk_guna_srg_tgn;

            $denominator_farmasi = $farmasi_jumlah + $no_farmasi_jumlah;

            $igd_pntp_kpl = $igd->where('pntp_kpl', '1')->count();
            $igd_masker = $igd->where('masker', '1')->count();
            $igd_pntp_wjh = $igd->where('pntp_wjh', '1')->count();
            $igd_apron = $igd->where('apron', '1')->count();
            $igd_srg_tgn = $igd->where('srg_tgn', '1')->count();
            $igd_alas_kaki = $igd->where('alas_kaki', '1')->count();
            $igd_lps_apd = $igd->where('lps_apd', '1')->count();
            $igd_tdk_gtg_masker = $igd->where('tdk_gtg_masker', '1')->count();
            $igd_tdk_guna_srg_tgn = $igd->where('tdk_guna_srg_tgn', '1')->count();
            $igd_jumlah = $igd_pntp_kpl + $igd_masker + $igd_pntp_wjh + $igd_apron + $igd_srg_tgn + $igd_alas_kaki + $igd_lps_apd + $igd_tdk_gtg_masker + $igd_tdk_guna_srg_tgn;

            $no_igd_pntp_kpl = $igd->where('pntp_kpl', '0')->count();
            $no_igd_masker = $igd->where('masker', '0')->count();
            $no_igd_pntp_wjh = $igd->where('pntp_wjh', '0')->count();
            $no_igd_apron = $igd->where('apron', '0')->count();
            $no_igd_srg_tgn = $igd->where('srg_tgn', '0')->count();
            $no_igd_alas_kaki = $igd->where('alas_kaki', '0')->count();
            $no_igd_lps_apd = $igd->where('lps_apd', '0')->count();
            $no_igd_tdk_gtg_masker = $igd->where('tdk_gtg_masker', '0')->count();
            $no_igd_tdk_guna_srg_tgn = $igd->where('tdk_guna_srg_tgn', '0')->count();
            $no_igd_jumlah = $no_igd_pntp_kpl + $no_igd_masker + $no_igd_pntp_wjh + $no_igd_apron + $no_igd_srg_tgn + $no_igd_alas_kaki + $no_igd_lps_apd + $no_igd_tdk_gtg_masker + $no_igd_tdk_guna_srg_tgn;

            $denominator_igd = $igd_jumlah + $no_igd_jumlah;

            $int_pntp_kpl = $int->where('pntp_kpl', '1')->count();
            $int_masker = $int->where('masker', '1')->count();
            $int_pntp_wjh = $int->where('pntp_wjh', '1')->count();
            $int_apron = $int->where('apron', '1')->count();
            $int_srg_tgn = $int->where('srg_tgn', '1')->count();
            $int_alas_kaki = $int->where('alas_kaki', '1')->count();
            $int_lps_apd = $int->where('lps_apd', '1')->count();
            $int_tdk_gtg_masker = $int->where('tdk_gtg_masker', '1')->count();
            $int_tdk_guna_srg_tgn = $int->where('tdk_guna_srg_tgn', '1')->count();
            $int_jumlah = $int_pntp_kpl + $int_masker + $int_pntp_wjh + $int_apron + $int_srg_tgn + $int_alas_kaki + $int_lps_apd + $int_tdk_gtg_masker + $int_tdk_guna_srg_tgn;

            $no_int_pntp_kpl = $int->where('pntp_kpl', '0')->count();
            $no_int_masker = $int->where('masker', '0')->count();
            $no_int_pntp_wjh = $int->where('pntp_wjh', '0')->count();
            $no_int_apron = $int->where('apron', '0')->count();
            $no_int_srg_tgn = $int->where('srg_tgn', '0')->count();
            $no_int_alas_kaki = $int->where('alas_kaki', '0')->count();
            $no_int_lps_apd = $int->where('lps_apd', '0')->count();
            $no_int_tdk_gtg_masker = $int->where('tdk_gtg_masker', '0')->count();
            $no_int_tdk_guna_srg_tgn = $int->where('tdk_guna_srg_tgn', '0')->count();
            $no_int_jumlah = $no_int_pntp_kpl + $no_int_masker + $no_int_pntp_wjh + $no_int_apron + $no_int_srg_tgn + $no_int_alas_kaki + $no_int_lps_apd + $no_int_tdk_gtg_masker + $no_int_tdk_guna_srg_tgn;

            $denominator_int = $int_jumlah + $no_int_jumlah;

            $kbbl_pntp_kpl = $kbbl->where('pntp_kpl', '1')->count();
            $kbbl_masker = $kbbl->where('masker', '1')->count();
            $kbbl_pntp_wjh = $kbbl->where('pntp_wjh', '1')->count();
            $kbbl_apron = $kbbl->where('apron', '1')->count();
            $kbbl_srg_tgn = $kbbl->where('srg_tgn', '1')->count();
            $kbbl_alas_kaki = $kbbl->where('alas_kaki', '1')->count();
            $kbbl_lps_apd = $kbbl->where('lps_apd', '1')->count();
            $kbbl_tdk_gtg_masker = $kbbl->where('tdk_gtg_masker', '1')->count();
            $kbbl_tdk_guna_srg_tgn = $kbbl->where('tdk_guna_srg_tgn', '1')->count();
            $kbbl_jumlah = $kbbl_pntp_kpl + $kbbl_masker + $kbbl_pntp_wjh + $kbbl_apron + $kbbl_srg_tgn + $kbbl_alas_kaki + $kbbl_lps_apd + $kbbl_tdk_gtg_masker + $kbbl_tdk_guna_srg_tgn;

            $no_kbbl_pntp_kpl = $kbbl->where('pntp_kpl', '0')->count();
            $no_kbbl_masker = $kbbl->where('masker', '0')->count();
            $no_kbbl_pntp_wjh = $kbbl->where('pntp_wjh', '0')->count();
            $no_kbbl_apron = $kbbl->where('apron', '0')->count();
            $no_kbbl_srg_tgn = $kbbl->where('srg_tgn', '0')->count();
            $no_kbbl_alas_kaki = $kbbl->where('alas_kaki', '0')->count();
            $no_kbbl_lps_apd = $kbbl->where('lps_apd', '0')->count();
            $no_kbbl_tdk_gtg_masker = $kbbl->where('tdk_gtg_masker', '0')->count();
            $no_kbbl_tdk_guna_srg_tgn = $kbbl->where('tdk_guna_srg_tgn', '0')->count();
            $no_kbbl_jumlah = $no_kbbl_pntp_kpl + $no_kbbl_masker + $no_kbbl_pntp_wjh + $no_kbbl_apron + $no_kbbl_srg_tgn + $no_kbbl_alas_kaki + $no_kbbl_lps_apd + $no_kbbl_tdk_gtg_masker + $no_kbbl_tdk_guna_srg_tgn;

            $denominator_kbbl = $kbbl_jumlah + $no_kbbl_jumlah;

            $lab_pntp_kpl = $lab->where('pntp_kpl', '1')->count();
            $lab_masker = $lab->where('masker', '1')->count();
            $lab_pntp_wjh = $lab->where('pntp_wjh', '1')->count();
            $lab_apron = $lab->where('apron', '1')->count();
            $lab_srg_tgn = $lab->where('srg_tgn', '1')->count();
            $lab_alas_kaki = $lab->where('alas_kaki', '1')->count();
            $lab_lps_apd = $lab->where('lps_apd', '1')->count();
            $lab_tdk_gtg_masker = $lab->where('tdk_gtg_masker', '1')->count();
            $lab_tdk_guna_srg_tgn = $lab->where('tdk_guna_srg_tgn', '1')->count();
            $lab_jumlah = $lab_pntp_kpl + $lab_masker + $lab_pntp_wjh + $lab_apron + $lab_srg_tgn + $lab_alas_kaki + $lab_lps_apd + $lab_tdk_gtg_masker + $lab_tdk_guna_srg_tgn;

            $no_lab_pntp_kpl = $lab->where('pntp_kpl', '0')->count();
            $no_lab_masker = $lab->where('masker', '0')->count();
            $no_lab_pntp_wjh = $lab->where('pntp_wjh', '0')->count();
            $no_lab_apron = $lab->where('apron', '0')->count();
            $no_lab_srg_tgn = $lab->where('srg_tgn', '0')->count();
            $no_lab_alas_kaki = $lab->where('alas_kaki', '0')->count();
            $no_lab_lps_apd = $lab->where('lps_apd', '0')->count();
            $no_lab_tdk_gtg_masker = $lab->where('tdk_gtg_masker', '0')->count();
            $no_lab_tdk_guna_srg_tgn = $lab->where('tdk_guna_srg_tgn', '0')->count();
            $no_lab_jumlah = $no_lab_pntp_kpl + $no_lab_masker + $no_lab_pntp_wjh + $no_lab_apron + $no_lab_srg_tgn + $no_lab_alas_kaki + $no_lab_lps_apd + $no_lab_tdk_gtg_masker + $no_lab_tdk_guna_srg_tgn;

            $denominator_lab = $lab_jumlah + $no_lab_jumlah;

            $laundry_pntp_kpl = $laundry->where('pntp_kpl', '1')->count();
            $laundry_masker = $laundry->where('masker', '1')->count();
            $laundry_pntp_wjh = $laundry->where('pntp_wjh', '1')->count();
            $laundry_apron = $laundry->where('apron', '1')->count();
            $laundry_srg_tgn = $laundry->where('srg_tgn', '1')->count();
            $laundry_alas_kaki = $laundry->where('alas_kaki', '1')->count();
            $laundry_lps_apd = $laundry->where('lps_apd', '1')->count();
            $laundry_tdk_gtg_masker = $laundry->where('tdk_gtg_masker', '1')->count();
            $laundry_tdk_guna_srg_tgn = $laundry->where('tdk_guna_srg_tgn', '1')->count();
            $laundry_jumlah = $laundry_pntp_kpl + $laundry_masker + $laundry_pntp_wjh + $laundry_apron + $laundry_srg_tgn + $laundry_alas_kaki + $laundry_lps_apd + $laundry_tdk_gtg_masker + $laundry_tdk_guna_srg_tgn;

            $no_laundry_pntp_kpl = $laundry->where('pntp_kpl', '0')->count();
            $no_laundry_masker = $laundry->where('masker', '0')->count();
            $no_laundry_pntp_wjh = $laundry->where('pntp_wjh', '0')->count();
            $no_laundry_apron = $laundry->where('apron', '0')->count();
            $no_laundry_srg_tgn = $laundry->where('srg_tgn', '0')->count();
            $no_laundry_alas_kaki = $laundry->where('alas_kaki', '0')->count();
            $no_laundry_lps_apd = $laundry->where('lps_apd', '0')->count();
            $no_laundry_tdk_gtg_masker = $laundry->where('tdk_gtg_masker', '0')->count();
            $no_laundry_tdk_guna_srg_tgn = $laundry->where('tdk_guna_srg_tgn', '0')->count();
            $no_laundry_jumlah = $no_laundry_pntp_kpl + $no_laundry_masker + $no_laundry_pntp_wjh + $no_laundry_apron + $no_laundry_srg_tgn + $no_laundry_alas_kaki + $no_laundry_lps_apd + $no_laundry_tdk_gtg_masker + $no_laundry_tdk_guna_srg_tgn;

            $denominator_laundry = $laundry_jumlah + $no_laundry_jumlah;

            $ok_pntp_kpl = $ok->where('pntp_kpl', '1')->count();
            $ok_masker = $ok->where('masker', '1')->count();
            $ok_pntp_wjh = $ok->where('pntp_wjh', '1')->count();
            $ok_apron = $ok->where('apron', '1')->count();
            $ok_srg_tgn = $ok->where('srg_tgn', '1')->count();
            $ok_alas_kaki = $ok->where('alas_kaki', '1')->count();
            $ok_lps_apd = $ok->where('lps_apd', '1')->count();
            $ok_tdk_gtg_masker = $ok->where('tdk_gtg_masker', '1')->count();
            $ok_tdk_guna_srg_tgn = $ok->where('tdk_guna_srg_tgn', '1')->count();
            $ok_jumlah = $ok_pntp_kpl + $ok_masker + $ok_pntp_wjh + $ok_apron + $ok_srg_tgn + $ok_alas_kaki + $ok_lps_apd + $ok_tdk_gtg_masker + $ok_tdk_guna_srg_tgn;

            $no_ok_pntp_kpl = $ok->where('pntp_kpl', '0')->count();
            $no_ok_masker = $ok->where('masker', '0')->count();
            $no_ok_pntp_wjh = $ok->where('pntp_wjh', '0')->count();
            $no_ok_apron = $ok->where('apron', '0')->count();
            $no_ok_srg_tgn = $ok->where('srg_tgn', '0')->count();
            $no_ok_alas_kaki = $ok->where('alas_kaki', '0')->count();
            $no_ok_lps_apd = $ok->where('lps_apd', '0')->count();
            $no_ok_tdk_gtg_masker = $ok->where('tdk_gtg_masker', '0')->count();
            $no_ok_tdk_guna_srg_tgn = $ok->where('tdk_guna_srg_tgn', '0')->count();
            $no_ok_jumlah = $no_ok_pntp_kpl + $no_ok_masker + $no_ok_pntp_wjh + $no_ok_apron + $no_ok_srg_tgn + $no_ok_alas_kaki + $no_ok_lps_apd + $no_ok_tdk_gtg_masker + $no_ok_tdk_guna_srg_tgn;

            $denominator_ok = $ok_jumlah + $no_ok_jumlah;

            $lt2_pntp_kpl = $lt2->where('pntp_kpl', '1')->count();
            $lt2_masker = $lt2->where('masker', '1')->count();
            $lt2_pntp_wjh = $lt2->where('pntp_wjh', '1')->count();
            $lt2_apron = $lt2->where('apron', '1')->count();
            $lt2_srg_tgn = $lt2->where('srg_tgn', '1')->count();
            $lt2_alas_kaki = $lt2->where('alas_kaki', '1')->count();
            $lt2_lps_apd = $lt2->where('lps_apd', '1')->count();
            $lt2_tdk_gtg_masker = $lt2->where('tdk_gtg_masker', '1')->count();
            $lt2_tdk_guna_srg_tgn = $lt2->where('tdk_guna_srg_tgn', '1')->count();
            $lt2_jumlah = $lt2_pntp_kpl + $lt2_masker + $lt2_pntp_wjh + $lt2_apron + $lt2_srg_tgn + $lt2_alas_kaki + $lt2_lps_apd + $lt2_tdk_gtg_masker + $lt2_tdk_guna_srg_tgn;

            $no_lt2_pntp_kpl = $lt2->where('pntp_kpl', '0')->count();
            $no_lt2_masker = $lt2->where('masker', '0')->count();
            $no_lt2_pntp_wjh = $lt2->where('pntp_wjh', '0')->count();
            $no_lt2_apron = $lt2->where('apron', '0')->count();
            $no_lt2_srg_tgn = $lt2->where('srg_tgn', '0')->count();
            $no_lt2_alas_kaki = $lt2->where('alas_kaki', '0')->count();
            $no_lt2_lps_apd = $lt2->where('lps_apd', '0')->count();
            $no_lt2_tdk_gtg_masker = $lt2->where('tdk_gtg_masker', '0')->count();
            $no_lt2_tdk_guna_srg_tgn = $lt2->where('tdk_guna_srg_tgn', '0')->count();
            $no_lt2_jumlah = $no_lt2_pntp_kpl + $no_lt2_masker + $no_lt2_pntp_wjh + $no_lt2_apron + $no_lt2_srg_tgn + $no_lt2_alas_kaki + $no_lt2_lps_apd + $no_lt2_tdk_gtg_masker + $no_lt2_tdk_guna_srg_tgn;

            $denominator_lt2 = $lt2_jumlah + $no_lt2_jumlah;

            $lt4_pntp_kpl = $lt4->where('pntp_kpl', '1')->count();
            $lt4_masker = $lt4->where('masker', '1')->count();
            $lt4_pntp_wjh = $lt4->where('pntp_wjh', '1')->count();
            $lt4_apron = $lt4->where('apron', '1')->count();
            $lt4_srg_tgn = $lt4->where('srg_tgn', '1')->count();
            $lt4_alas_kaki = $lt4->where('alas_kaki', '1')->count();
            $lt4_lps_apd = $lt4->where('lps_apd', '1')->count();
            $lt4_tdk_gtg_masker = $lt4->where('tdk_gtg_masker', '1')->count();
            $lt4_tdk_guna_srg_tgn = $lt4->where('tdk_guna_srg_tgn', '1')->count();
            $lt4_jumlah = $lt4_pntp_kpl + $lt4_masker + $lt4_pntp_wjh + $lt4_apron + $lt4_srg_tgn + $lt4_alas_kaki + $lt4_lps_apd + $lt4_tdk_gtg_masker + $lt4_tdk_guna_srg_tgn;

            $no_lt4_pntp_kpl = $lt4->where('pntp_kpl', '0')->count();
            $no_lt4_masker = $lt4->where('masker', '0')->count();
            $no_lt4_pntp_wjh = $lt4->where('pntp_wjh', '0')->count();
            $no_lt4_apron = $lt4->where('apron', '0')->count();
            $no_lt4_srg_tgn = $lt4->where('srg_tgn', '0')->count();
            $no_lt4_alas_kaki = $lt4->where('alas_kaki', '0')->count();
            $no_lt4_lps_apd = $lt4->where('lps_apd', '0')->count();
            $no_lt4_tdk_gtg_masker = $lt4->where('tdk_gtg_masker', '0')->count();
            $no_lt4_tdk_guna_srg_tgn = $lt4->where('tdk_guna_srg_tgn', '0')->count();
            $no_lt4_jumlah = $no_lt4_pntp_kpl + $no_lt4_masker + $no_lt4_pntp_wjh + $no_lt4_apron + $no_lt4_srg_tgn + $no_lt4_alas_kaki + $no_lt4_lps_apd + $no_lt4_tdk_gtg_masker + $no_lt4_tdk_guna_srg_tgn;

            $denominator_lt4 = $lt4_jumlah + $no_lt4_jumlah;

            $lt5_pntp_kpl = $lt5->where('pntp_kpl', '1')->count();
            $lt5_masker = $lt5->where('masker', '1')->count();
            $lt5_pntp_wjh = $lt5->where('pntp_wjh', '1')->count();
            $lt5_apron = $lt5->where('apron', '1')->count();
            $lt5_srg_tgn = $lt5->where('srg_tgn', '1')->count();
            $lt5_alas_kaki = $lt5->where('alas_kaki', '1')->count();
            $lt5_lps_apd = $lt5->where('lps_apd', '1')->count();
            $lt5_tdk_gtg_masker = $lt5->where('tdk_gtg_masker', '1')->count();
            $lt5_tdk_guna_srg_tgn = $lt5->where('tdk_guna_srg_tgn', '1')->count();
            $lt5_jumlah = $lt5_pntp_kpl + $lt5_masker + $lt5_pntp_wjh + $lt5_apron + $lt5_srg_tgn + $lt5_alas_kaki + $lt5_lps_apd + $lt5_tdk_gtg_masker + $lt5_tdk_guna_srg_tgn;

            $no_lt5_pntp_kpl = $lt5->where('pntp_kpl', '0')->count();
            $no_lt5_masker = $lt5->where('masker', '0')->count();
            $no_lt5_pntp_wjh = $lt5->where('pntp_wjh', '0')->count();
            $no_lt5_apron = $lt5->where('apron', '0')->count();
            $no_lt5_srg_tgn = $lt5->where('srg_tgn', '0')->count();
            $no_lt5_alas_kaki = $lt5->where('alas_kaki', '0')->count();
            $no_lt5_lps_apd = $lt5->where('lps_apd', '0')->count();
            $no_lt5_tdk_gtg_masker = $lt5->where('tdk_gtg_masker', '0')->count();
            $no_lt5_tdk_guna_srg_tgn = $lt5->where('tdk_guna_srg_tgn', '0')->count();
            $no_lt5_jumlah = $no_lt5_pntp_kpl + $no_lt5_masker + $no_lt5_pntp_wjh + $no_lt5_apron + $no_lt5_srg_tgn + $no_lt5_alas_kaki + $no_lt5_lps_apd + $no_lt5_tdk_gtg_masker + $no_lt5_tdk_guna_srg_tgn;

            $denominator_lt5 = $lt5_jumlah + $no_lt5_jumlah;

            $poli_pntp_kpl = $poli->where('pntp_kpl', '1')->count();
            $poli_masker = $poli->where('masker', '1')->count();
            $poli_pntp_wjh = $poli->where('pntp_wjh', '1')->count();
            $poli_apron = $poli->where('apron', '1')->count();
            $poli_srg_tgn = $poli->where('srg_tgn', '1')->count();
            $poli_alas_kaki = $poli->where('alas_kaki', '1')->count();
            $poli_lps_apd = $poli->where('lps_apd', '1')->count();
            $poli_tdk_gtg_masker = $poli->where('tdk_gtg_masker', '1')->count();
            $poli_tdk_guna_srg_tgn = $poli->where('tdk_guna_srg_tgn', '1')->count();
            $poli_jumlah = $poli_pntp_kpl + $poli_masker + $poli_pntp_wjh + $poli_apron + $poli_srg_tgn + $poli_alas_kaki + $poli_lps_apd + $poli_tdk_gtg_masker + $poli_tdk_guna_srg_tgn;

            $no_poli_pntp_kpl = $poli->where('pntp_kpl', '0')->count();
            $no_poli_masker = $poli->where('masker', '0')->count();
            $no_poli_pntp_wjh = $poli->where('pntp_wjh', '0')->count();
            $no_poli_apron = $poli->where('apron', '0')->count();
            $no_poli_srg_tgn = $poli->where('srg_tgn', '0')->count();
            $no_poli_alas_kaki = $poli->where('alas_kaki', '0')->count();
            $no_poli_lps_apd = $poli->where('lps_apd', '0')->count();
            $no_poli_tdk_gtg_masker = $poli->where('tdk_gtg_masker', '0')->count();
            $no_poli_tdk_guna_srg_tgn = $poli->where('tdk_guna_srg_tgn', '0')->count();
            $no_poli_jumlah = $no_poli_pntp_kpl + $no_poli_masker + $no_poli_pntp_wjh + $no_poli_apron + $no_poli_srg_tgn + $no_poli_alas_kaki + $no_poli_lps_apd + $no_poli_tdk_gtg_masker + $no_poli_tdk_guna_srg_tgn;

            $denominator_poli = $poli_jumlah + $no_poli_jumlah;

            $rad_pntp_kpl = $rad->where('pntp_kpl', '1')->count();
            $rad_masker = $rad->where('masker', '1')->count();
            $rad_pntp_wjh = $rad->where('pntp_wjh', '1')->count();
            $rad_apron = $rad->where('apron', '1')->count();
            $rad_srg_tgn = $rad->where('srg_tgn', '1')->count();
            $rad_alas_kaki = $rad->where('alas_kaki', '1')->count();
            $rad_lps_apd = $rad->where('lps_apd', '1')->count();
            $rad_tdk_gtg_masker = $rad->where('tdk_gtg_masker', '1')->count();
            $rad_tdk_guna_srg_tgn = $rad->where('tdk_guna_srg_tgn', '1')->count();
            $rad_jumlah = $rad_pntp_kpl + $rad_masker + $rad_pntp_wjh + $rad_apron + $rad_srg_tgn + $rad_alas_kaki + $rad_lps_apd + $rad_tdk_gtg_masker + $rad_tdk_guna_srg_tgn;

            $no_rad_pntp_kpl = $rad->where('pntp_kpl', '0')->count();
            $no_rad_masker = $rad->where('masker', '0')->count();
            $no_rad_pntp_wjh = $rad->where('pntp_wjh', '0')->count();
            $no_rad_apron = $rad->where('apron', '0')->count();
            $no_rad_srg_tgn = $rad->where('srg_tgn', '0')->count();
            $no_rad_alas_kaki = $rad->where('alas_kaki', '0')->count();
            $no_rad_lps_apd = $rad->where('lps_apd', '0')->count();
            $no_rad_tdk_gtg_masker = $rad->where('tdk_gtg_masker', '0')->count();
            $no_rad_tdk_guna_srg_tgn = $rad->where('tdk_guna_srg_tgn', '0')->count();
            $no_rad_jumlah = $no_rad_pntp_kpl + $no_rad_masker + $no_rad_pntp_wjh + $no_rad_apron + $no_rad_srg_tgn + $no_rad_alas_kaki + $no_rad_lps_apd + $no_rad_tdk_gtg_masker + $no_rad_tdk_guna_srg_tgn;

            $denominator_rad = $rad_jumlah + $no_rad_jumlah;

            $vk_pntp_kpl = $vk->where('pntp_kpl', '1')->count();
            $vk_masker = $vk->where('masker', '1')->count();
            $vk_pntp_wjh = $vk->where('pntp_wjh', '1')->count();
            $vk_apron = $vk->where('apron', '1')->count();
            $vk_srg_tgn = $vk->where('srg_tgn', '1')->count();
            $vk_alas_kaki = $vk->where('alas_kaki', '1')->count();
            $vk_lps_apd = $vk->where('lps_apd', '1')->count();
            $vk_tdk_gtg_masker = $vk->where('tdk_gtg_masker', '1')->count();
            $vk_tdk_guna_srg_tgn = $vk->where('tdk_guna_srg_tgn', '1')->count();
            $vk_jumlah = $vk_pntp_kpl + $vk_masker + $vk_pntp_wjh + $vk_apron + $vk_srg_tgn + $vk_alas_kaki + $vk_lps_apd + $vk_tdk_gtg_masker + $vk_tdk_guna_srg_tgn;

            $no_vk_pntp_kpl = $vk->where('pntp_kpl', '0')->count();
            $no_vk_masker = $vk->where('masker', '0')->count();
            $no_vk_pntp_wjh = $vk->where('pntp_wjh', '0')->count();
            $no_vk_apron = $vk->where('apron', '0')->count();
            $no_vk_srg_tgn = $vk->where('srg_tgn', '0')->count();
            $no_vk_alas_kaki = $vk->where('alas_kaki', '0')->count();
            $no_vk_lps_apd = $vk->where('lps_apd', '0')->count();
            $no_vk_tdk_gtg_masker = $vk->where('tdk_gtg_masker', '0')->count();
            $no_vk_tdk_guna_srg_tgn = $vk->where('tdk_guna_srg_tgn', '0')->count();
            $no_vk_jumlah = $no_vk_pntp_kpl + $no_vk_masker + $no_vk_pntp_wjh + $no_vk_apron + $no_vk_srg_tgn + $no_vk_alas_kaki + $no_vk_lps_apd + $no_vk_tdk_gtg_masker + $no_vk_tdk_guna_srg_tgn;

            $denominator_vk = $vk_jumlah + $no_vk_jumlah;

            $tanggal = Carbon::parse($request->input('dari'))->isoFormat('DD MMMM YYYY') . ' - ' . Carbon::parse($request->input('sampai'))->isoFormat('DD MMMM YYYY');

            return Excel::download(new ExportApd(
                $cssu_pntp_kpl,
                $cssu_masker,
                $cssu_pntp_wjh,
                $cssu_apron,
                $cssu_srg_tgn,
                $cssu_alas_kaki,
                $cssu_lps_apd,
                $cssu_tdk_gtg_masker,
                $cssu_tdk_guna_srg_tgn,
                $cssu_jumlah,

                $no_cssu_pntp_kpl,
                $no_cssu_masker,
                $no_cssu_pntp_wjh,
                $no_cssu_apron,
                $no_cssu_srg_tgn,
                $no_cssu_alas_kaki,
                $no_cssu_lps_apd,
                $no_cssu_tdk_gtg_masker,
                $no_cssu_tdk_guna_srg_tgn,
                $no_cssu_jumlah,

                $denominator_cssu,

                $dapur_pntp_kpl,
                $dapur_masker,
                $dapur_pntp_wjh,
                $dapur_apron,
                $dapur_srg_tgn,
                $dapur_alas_kaki,
                $dapur_lps_apd,
                $dapur_tdk_gtg_masker,
                $dapur_tdk_guna_srg_tgn,
                $dapur_jumlah,

                $no_dapur_pntp_kpl,
                $no_dapur_masker,
                $no_dapur_pntp_wjh,
                $no_dapur_apron,
                $no_dapur_srg_tgn,
                $no_dapur_alas_kaki,
                $no_dapur_lps_apd,
                $no_dapur_tdk_gtg_masker,
                $no_dapur_tdk_guna_srg_tgn,
                $no_dapur_jumlah,

                $denominator_dapur,

                $dpjp_pntp_kpl,
                $dpjp_masker,
                $dpjp_pntp_wjh,
                $dpjp_apron,
                $dpjp_srg_tgn,
                $dpjp_alas_kaki,
                $dpjp_lps_apd,
                $dpjp_tdk_gtg_masker,
                $dpjp_tdk_guna_srg_tgn,
                $dpjp_jumlah,

                $no_dpjp_pntp_kpl,
                $no_dpjp_masker,
                $no_dpjp_pntp_wjh,
                $no_dpjp_apron,
                $no_dpjp_srg_tgn,
                $no_dpjp_alas_kaki,
                $no_dpjp_lps_apd,
                $no_dpjp_tdk_gtg_masker,
                $no_dpjp_tdk_guna_srg_tgn,
                $no_dpjp_jumlah,

                $denominator_dpjp,

                $farmasi_pntp_kpl,
                $farmasi_masker,
                $farmasi_pntp_wjh,
                $farmasi_apron,
                $farmasi_srg_tgn,
                $farmasi_alas_kaki,
                $farmasi_lps_apd,
                $farmasi_tdk_gtg_masker,
                $farmasi_tdk_guna_srg_tgn,
                $farmasi_jumlah,

                $no_farmasi_pntp_kpl,
                $no_farmasi_masker,
                $no_farmasi_pntp_wjh,
                $no_farmasi_apron,
                $no_farmasi_srg_tgn,
                $no_farmasi_alas_kaki,
                $no_farmasi_lps_apd,
                $no_farmasi_tdk_gtg_masker,
                $no_farmasi_tdk_guna_srg_tgn,
                $no_farmasi_jumlah,

                $denominator_farmasi,

                $igd_pntp_kpl,
                $igd_masker,
                $igd_pntp_wjh,
                $igd_apron,
                $igd_srg_tgn,
                $igd_alas_kaki,
                $igd_lps_apd,
                $igd_tdk_gtg_masker,
                $igd_tdk_guna_srg_tgn,
                $igd_jumlah,

                $no_igd_pntp_kpl,
                $no_igd_masker,
                $no_igd_pntp_wjh,
                $no_igd_apron,
                $no_igd_srg_tgn,
                $no_igd_alas_kaki,
                $no_igd_lps_apd,
                $no_igd_tdk_gtg_masker,
                $no_igd_tdk_guna_srg_tgn,
                $no_igd_jumlah,

                $denominator_igd,

                $int_pntp_kpl,
                $int_masker,
                $int_pntp_wjh,
                $int_apron,
                $int_srg_tgn,
                $int_alas_kaki,
                $int_lps_apd,
                $int_tdk_gtg_masker,
                $int_tdk_guna_srg_tgn,
                $int_jumlah,

                $no_int_pntp_kpl,
                $no_int_masker,
                $no_int_pntp_wjh,
                $no_int_apron,
                $no_int_srg_tgn,
                $no_int_alas_kaki,
                $no_int_lps_apd,
                $no_int_tdk_gtg_masker,
                $no_int_tdk_guna_srg_tgn,
                $no_int_jumlah,

                $denominator_int,

                $kbbl_pntp_kpl,
                $kbbl_masker,
                $kbbl_pntp_wjh,
                $kbbl_apron,
                $kbbl_srg_tgn,
                $kbbl_alas_kaki,
                $kbbl_lps_apd,
                $kbbl_tdk_gtg_masker,
                $kbbl_tdk_guna_srg_tgn,
                $kbbl_jumlah,

                $no_kbbl_pntp_kpl,
                $no_kbbl_masker,
                $no_kbbl_pntp_wjh,
                $no_kbbl_apron,
                $no_kbbl_srg_tgn,
                $no_kbbl_alas_kaki,
                $no_kbbl_lps_apd,
                $no_kbbl_tdk_gtg_masker,
                $no_kbbl_tdk_guna_srg_tgn,
                $no_kbbl_jumlah,

                $denominator_kbbl,

                $lab_pntp_kpl,
                $lab_masker,
                $lab_pntp_wjh,
                $lab_apron,
                $lab_srg_tgn,
                $lab_alas_kaki,
                $lab_lps_apd,
                $lab_tdk_gtg_masker,
                $lab_tdk_guna_srg_tgn,
                $lab_jumlah,

                $no_lab_pntp_kpl,
                $no_lab_masker,
                $no_lab_pntp_wjh,
                $no_lab_apron,
                $no_lab_srg_tgn,
                $no_lab_alas_kaki,
                $no_lab_lps_apd,
                $no_lab_tdk_gtg_masker,
                $no_lab_tdk_guna_srg_tgn,
                $no_lab_jumlah,

                $denominator_lab,

                $laundry_pntp_kpl,
                $laundry_masker,
                $laundry_pntp_wjh,
                $laundry_apron,
                $laundry_srg_tgn,
                $laundry_alas_kaki,
                $laundry_lps_apd,
                $laundry_tdk_gtg_masker,
                $laundry_tdk_guna_srg_tgn,
                $laundry_jumlah,

                $no_laundry_pntp_kpl,
                $no_laundry_masker,
                $no_laundry_pntp_wjh,
                $no_laundry_apron,
                $no_laundry_srg_tgn,
                $no_laundry_alas_kaki,
                $no_laundry_lps_apd,
                $no_laundry_tdk_gtg_masker,
                $no_laundry_tdk_guna_srg_tgn,
                $no_laundry_jumlah,

                $denominator_laundry,

                $ok_pntp_kpl,
                $ok_masker,
                $ok_pntp_wjh,
                $ok_apron,
                $ok_srg_tgn,
                $ok_alas_kaki,
                $ok_lps_apd,
                $ok_tdk_gtg_masker,
                $ok_tdk_guna_srg_tgn,
                $ok_jumlah,

                $no_ok_pntp_kpl,
                $no_ok_masker,
                $no_ok_pntp_wjh,
                $no_ok_apron,
                $no_ok_srg_tgn,
                $no_ok_alas_kaki,
                $no_ok_lps_apd,
                $no_ok_tdk_gtg_masker,
                $no_ok_tdk_guna_srg_tgn,
                $no_ok_jumlah,

                $denominator_ok,

                $lt2_pntp_kpl,
                $lt2_masker,
                $lt2_pntp_wjh,
                $lt2_apron,
                $lt2_srg_tgn,
                $lt2_alas_kaki,
                $lt2_lps_apd,
                $lt2_tdk_gtg_masker,
                $lt2_tdk_guna_srg_tgn,
                $lt2_jumlah,

                $no_lt2_pntp_kpl,
                $no_lt2_masker,
                $no_lt2_pntp_wjh,
                $no_lt2_apron,
                $no_lt2_srg_tgn,
                $no_lt2_alas_kaki,
                $no_lt2_lps_apd,
                $no_lt2_tdk_gtg_masker,
                $no_lt2_tdk_guna_srg_tgn,
                $no_lt2_jumlah,

                $denominator_lt2,

                $lt4_pntp_kpl,
                $lt4_masker,
                $lt4_pntp_wjh,
                $lt4_apron,
                $lt4_srg_tgn,
                $lt4_alas_kaki,
                $lt4_lps_apd,
                $lt4_tdk_gtg_masker,
                $lt4_tdk_guna_srg_tgn,
                $lt4_jumlah,

                $no_lt4_pntp_kpl,
                $no_lt4_masker,
                $no_lt4_pntp_wjh,
                $no_lt4_apron,
                $no_lt4_srg_tgn,
                $no_lt4_alas_kaki,
                $no_lt4_lps_apd,
                $no_lt4_tdk_gtg_masker,
                $no_lt4_tdk_guna_srg_tgn,
                $no_lt4_jumlah,

                $denominator_lt4,

                $lt5_pntp_kpl,
                $lt5_masker,
                $lt5_pntp_wjh,
                $lt5_apron,
                $lt5_srg_tgn,
                $lt5_alas_kaki,
                $lt5_lps_apd,
                $lt5_tdk_gtg_masker,
                $lt5_tdk_guna_srg_tgn,
                $lt5_jumlah,

                $no_lt5_pntp_kpl,
                $no_lt5_masker,
                $no_lt5_pntp_wjh,
                $no_lt5_apron,
                $no_lt5_srg_tgn,
                $no_lt5_alas_kaki,
                $no_lt5_lps_apd,
                $no_lt5_tdk_gtg_masker,
                $no_lt5_tdk_guna_srg_tgn,
                $no_lt5_jumlah,

                $denominator_lt5,

                $poli_pntp_kpl,
                $poli_masker,
                $poli_pntp_wjh,
                $poli_apron,
                $poli_srg_tgn,
                $poli_alas_kaki,
                $poli_lps_apd,
                $poli_tdk_gtg_masker,
                $poli_tdk_guna_srg_tgn,
                $poli_jumlah,

                $no_poli_pntp_kpl,
                $no_poli_masker,
                $no_poli_pntp_wjh,
                $no_poli_apron,
                $no_poli_srg_tgn,
                $no_poli_alas_kaki,
                $no_poli_lps_apd,
                $no_poli_tdk_gtg_masker,
                $no_poli_tdk_guna_srg_tgn,
                $no_poli_jumlah,

                $denominator_poli,

                $rad_pntp_kpl,
                $rad_masker,
                $rad_pntp_wjh,
                $rad_apron,
                $rad_srg_tgn,
                $rad_alas_kaki,
                $rad_lps_apd,
                $rad_tdk_gtg_masker,
                $rad_tdk_guna_srg_tgn,
                $rad_jumlah,

                $no_rad_pntp_kpl,
                $no_rad_masker,
                $no_rad_pntp_wjh,
                $no_rad_apron,
                $no_rad_srg_tgn,
                $no_rad_alas_kaki,
                $no_rad_lps_apd,
                $no_rad_tdk_gtg_masker,
                $no_rad_tdk_guna_srg_tgn,
                $no_rad_jumlah,

                $denominator_rad,

                $vk_pntp_kpl,
                $vk_masker,
                $vk_pntp_wjh,
                $vk_apron,
                $vk_srg_tgn,
                $vk_alas_kaki,
                $vk_lps_apd,
                $vk_tdk_gtg_masker,
                $vk_tdk_guna_srg_tgn,
                $vk_jumlah,

                $no_vk_pntp_kpl,
                $no_vk_masker,
                $no_vk_pntp_wjh,
                $no_vk_apron,
                $no_vk_srg_tgn,
                $no_vk_alas_kaki,
                $no_vk_lps_apd,
                $no_vk_tdk_gtg_masker,
                $no_vk_tdk_guna_srg_tgn,
                $no_vk_jumlah,

                $denominator_vk,

                $tabel,
                $rekap,
                $tanggal
            ), 'Rekap APD ' . $tanggal . '.pdf', \Maatwebsite\Excel\Excel::MPDF);
        } else {
            return Redirect::back()->withErrors(['msg' => 'Tanggal tidak boleh Lebih kecil dari sebelumnya']);
        }
    }
}
