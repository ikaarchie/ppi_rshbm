<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Exports\ExportCuciTangan;
use App\Models\CuciTangan;
use Illuminate\Http\Request;
use App\Models\RekapCuciTangan;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

class CuciTanganController extends Controller
{
    public function index()
    {
        return view('cuciTangan.index');
    }

    public function getData()
    {
        $cuci_tangan = CuciTangan::latest('id')->paginate(1000);

        return view('cuciTangan.index')->with('cuci_tangan', $cuci_tangan);
    }

    public function save(Request $request)
    {
        $data = new CuciTangan();
        $data->nama = $request->input('nama');
        $data->unit = $request->input('unit');
        $data->tgl_input = $request->input('tgl_input');
        $data->sbl_kon_psn = $request->input('sbl_kon_psn');
        $data->sbl_tin_aseptik = $request->input('sbl_tin_aseptik');
        $data->stl_kon_cairan = $request->input('stl_kon_cairan');
        $data->stl_kon_psn = $request->input('stl_kon_psn');
        $data->stl_kon_ling_psn = $request->input('stl_kon_ling_psn');
        $data->hr = $request->input('hr');
        $data->hw = $request->input('hw');
        $data->gagal = $request->input('gagal');
        $data->st = $request->input('st');
        $data->save();

        return redirect('/cuciTangan')->with('success', 'Data berhasil disimpan!');
    }

    public function update(Request $request, $id)
    {
        $cuci_tangan = CuciTangan::find($id);
        $input = $request->all();
        $cuci_tangan->fill($input)->save();

        return redirect('/cuciTangan');
    }

    public function destroy($id)
    {
        $cuci_tangan = CuciTangan::find($id);
        $cuci_tangan->delete();

        return redirect('/cuciTangan');
    }

    public function inputRekap(Request $request)
    {
        $tgl_skg = date('Y-m-d');

        $data = new RekapCuciTangan();
        $data->dari = $request->input('dari') ?? $tgl_skg;
        $data->sampai = $request->input('sampai') ?? $tgl_skg;
        $data->analisa = $request->input('analisa');
        $data->tindak_lanjut = $request->input('tindak_lanjut');
        $data->save();

        return redirect('/rekapCuciTangan')->with('success', 'Data berhasil disimpan!');
    }

    public function updateRekap(Request $request, $id)
    {
        $rekap = RekapCuciTangan::find($id);
        $input = $request->all();
        $rekap->fill($input)->save();

        return redirect('/rekapCuciTangan');
    }

    public function rekap(Request $request)
    {
        $tgl_skg = date('Y-m-d');
        // dd($tgl_skg);

        if ($request->input('dari') <= $request->input('sampai')) {
            $tabel = CuciTangan::whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')->paginate(1000);
            // dd($tabel);

            $rekap = RekapCuciTangan::whereDate('dari', '=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('sampai', '=', $request->input('sampai') ?? $tgl_skg)
                ->get();

            $analisa = RekapCuciTangan::select('analisa')
                ->whereDate('dari', '=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('sampai', '=', $request->input('sampai') ?? $tgl_skg)
                ->get();

            $tindak_lanjut = RekapCuciTangan::select('tindak_lanjut')
                ->whereDate('dari', '=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('sampai', '=', $request->input('sampai') ?? $tgl_skg)
                ->get();

            $cssu = CuciTangan::where('unit', 'CSSU')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $dapur = CuciTangan::where('unit', 'Dapur')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $dpjp = CuciTangan::where('unit', 'DPJP')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $farmasi = CuciTangan::where('unit', 'Farmasi')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $igd = CuciTangan::where('unit', 'IGD')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $int = CuciTangan::where('unit', 'Intensif')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $kebersihan = CuciTangan::where('unit', 'Kebersihan')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $kbbl = CuciTangan::where('unit', 'KBBL')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lab = CuciTangan::where('unit', 'Laboratorium')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $laundry = CuciTangan::where('unit', 'Laundry')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $ok = CuciTangan::where('unit', 'OK')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt2 = CuciTangan::where('unit', 'Perawatan Eksekutif lt.2')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt4 = CuciTangan::where('unit', 'Perawatan Reguler lt.4')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt5 = CuciTangan::where('unit', 'Perawatan Reguler lt.5')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $poli = CuciTangan::where('unit', 'Poliklinik')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $rad = CuciTangan::where('unit', 'Radiologi')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $vk = CuciTangan::where('unit', 'VK')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();

            $cssu_sbl_kon_psn = $cssu->where('sbl_kon_psn', '1')->count();
            $cssu_sbl_tin_aseptik = $cssu->where('sbl_tin_aseptik', '1')->count();
            $cssu_stl_kon_cairan = $cssu->where('stl_kon_cairan', '1')->count();
            $cssu_stl_kon_psn = $cssu->where('stl_kon_psn', '1')->count();
            $cssu_stl_kon_ling_psn = $cssu->where('stl_kon_ling_psn', '1')->count();
            $cssu_hr = $cssu->where('hr', '1')->count();
            $cssu_hw = $cssu->where('hw', '1')->count();
            $cssu_gagal = $cssu->where('gagal', '1')->count();
            $cssu_st = $cssu->where('st', '1')->count();
            $cssu_jumlah = $cssu_sbl_kon_psn + $cssu_sbl_tin_aseptik + $cssu_stl_kon_cairan + $cssu_stl_kon_psn + $cssu_stl_kon_ling_psn + $cssu_hr + $cssu_hw + $cssu_gagal + $cssu_st;

            $no_cssu_sbl_kon_psn = $cssu->where('sbl_kon_psn', '0')->count();
            $no_cssu_sbl_tin_aseptik = $cssu->where('sbl_tin_aseptik', '0')->count();
            $no_cssu_stl_kon_cairan = $cssu->where('stl_kon_cairan', '0')->count();
            $no_cssu_stl_kon_psn = $cssu->where('stl_kon_psn', '0')->count();
            $no_cssu_stl_kon_ling_psn = $cssu->where('stl_kon_ling_psn', '0')->count();
            $no_cssu_hr = $cssu->where('hr', '0')->count();
            $no_cssu_hw = $cssu->where('hw', '0')->count();
            $no_cssu_gagal = $cssu->where('gagal', '0')->count();
            $no_cssu_st = $cssu->where('st', '0')->count();
            $no_cssu_jumlah = $no_cssu_sbl_kon_psn + $no_cssu_sbl_tin_aseptik + $no_cssu_stl_kon_cairan + $no_cssu_stl_kon_psn + $no_cssu_stl_kon_ling_psn + $no_cssu_hr + $no_cssu_hw + $no_cssu_gagal + $no_cssu_st;

            $dapur_sbl_kon_psn = $dapur->where('sbl_kon_psn', '1')->count();
            $dapur_sbl_tin_aseptik = $dapur->where('sbl_tin_aseptik', '1')->count();
            $dapur_stl_kon_cairan = $dapur->where('stl_kon_cairan', '1')->count();
            $dapur_stl_kon_psn = $dapur->where('stl_kon_psn', '1')->count();
            $dapur_stl_kon_ling_psn = $dapur->where('stl_kon_ling_psn', '1')->count();
            $dapur_hr = $dapur->where('hr', '1')->count();
            $dapur_hw = $dapur->where('hw', '1')->count();
            $dapur_gagal = $dapur->where('gagal', '1')->count();
            $dapur_st = $dapur->where('st', '1')->count();
            $dapur_jumlah = $dapur_sbl_kon_psn + $dapur_sbl_tin_aseptik + $dapur_stl_kon_cairan + $dapur_stl_kon_psn + $dapur_stl_kon_ling_psn + $dapur_hr + $dapur_hw + $dapur_gagal + $dapur_st;

            $no_dapur_sbl_kon_psn = $dapur->where('sbl_kon_psn', '0')->count();
            $no_dapur_sbl_tin_aseptik = $dapur->where('sbl_tin_aseptik', '0')->count();
            $no_dapur_stl_kon_cairan = $dapur->where('stl_kon_cairan', '0')->count();
            $no_dapur_stl_kon_psn = $dapur->where('stl_kon_psn', '0')->count();
            $no_dapur_stl_kon_ling_psn = $dapur->where('stl_kon_ling_psn', '0')->count();
            $no_dapur_hr = $dapur->where('hr', '0')->count();
            $no_dapur_hw = $dapur->where('hw', '0')->count();
            $no_dapur_gagal = $dapur->where('gagal', '0')->count();
            $no_dapur_st = $dapur->where('st', '0')->count();
            $no_dapur_jumlah = $no_dapur_sbl_kon_psn + $no_dapur_sbl_tin_aseptik + $no_dapur_stl_kon_cairan + $no_dapur_stl_kon_psn + $no_dapur_stl_kon_ling_psn + $no_dapur_hr + $no_dapur_hw + $no_dapur_gagal + $no_dapur_st;

            $dpjp_sbl_kon_psn = $dpjp->where('sbl_kon_psn', '1')->count();
            $dpjp_sbl_tin_aseptik = $dpjp->where('sbl_tin_aseptik', '1')->count();
            $dpjp_stl_kon_cairan = $dpjp->where('stl_kon_cairan', '1')->count();
            $dpjp_stl_kon_psn = $dpjp->where('stl_kon_psn', '1')->count();
            $dpjp_stl_kon_ling_psn = $dpjp->where('stl_kon_ling_psn', '1')->count();
            $dpjp_hr = $dpjp->where('hr', '1')->count();
            $dpjp_hw = $dpjp->where('hw', '1')->count();
            $dpjp_gagal = $dpjp->where('gagal', '1')->count();
            $dpjp_st = $dpjp->where('st', '1')->count();
            $dpjp_jumlah = $dpjp_sbl_kon_psn + $dpjp_sbl_tin_aseptik + $dpjp_stl_kon_cairan + $dpjp_stl_kon_psn + $dpjp_stl_kon_ling_psn + $dpjp_hr + $dpjp_hw + $dpjp_gagal + $dpjp_st;

            $no_dpjp_sbl_kon_psn = $dpjp->where('sbl_kon_psn', '0')->count();
            $no_dpjp_sbl_tin_aseptik = $dpjp->where('sbl_tin_aseptik', '0')->count();
            $no_dpjp_stl_kon_cairan = $dpjp->where('stl_kon_cairan', '0')->count();
            $no_dpjp_stl_kon_psn = $dpjp->where('stl_kon_psn', '0')->count();
            $no_dpjp_stl_kon_ling_psn = $dpjp->where('stl_kon_ling_psn', '0')->count();
            $no_dpjp_hr = $dpjp->where('hr', '0')->count();
            $no_dpjp_hw = $dpjp->where('hw', '0')->count();
            $no_dpjp_gagal = $dpjp->where('gagal', '0')->count();
            $no_dpjp_st = $dpjp->where('st', '0')->count();
            $no_dpjp_jumlah = $no_dpjp_sbl_kon_psn + $no_dpjp_sbl_tin_aseptik + $no_dpjp_stl_kon_cairan + $no_dpjp_stl_kon_psn + $no_dpjp_stl_kon_ling_psn + $no_dpjp_hr + $no_dpjp_hw + $no_dpjp_gagal + $no_dpjp_st;

            $farmasi_sbl_kon_psn = $farmasi->where('sbl_kon_psn', '1')->count();
            $farmasi_sbl_tin_aseptik = $farmasi->where('sbl_tin_aseptik', '1')->count();
            $farmasi_stl_kon_cairan = $farmasi->where('stl_kon_cairan', '1')->count();
            $farmasi_stl_kon_psn = $farmasi->where('stl_kon_psn', '1')->count();
            $farmasi_stl_kon_ling_psn = $farmasi->where('stl_kon_ling_psn', '1')->count();
            $farmasi_hr = $farmasi->where('hr', '1')->count();
            $farmasi_hw = $farmasi->where('hw', '1')->count();
            $farmasi_gagal = $farmasi->where('gagal', '1')->count();
            $farmasi_st = $farmasi->where('st', '1')->count();
            $farmasi_jumlah = $farmasi_sbl_kon_psn + $farmasi_sbl_tin_aseptik + $farmasi_stl_kon_cairan + $farmasi_stl_kon_psn + $farmasi_stl_kon_ling_psn + $farmasi_hr + $farmasi_hw + $farmasi_gagal + $farmasi_st;

            $no_farmasi_sbl_kon_psn = $farmasi->where('sbl_kon_psn', '0')->count();
            $no_farmasi_sbl_tin_aseptik = $farmasi->where('sbl_tin_aseptik', '0')->count();
            $no_farmasi_stl_kon_cairan = $farmasi->where('stl_kon_cairan', '0')->count();
            $no_farmasi_stl_kon_psn = $farmasi->where('stl_kon_psn', '0')->count();
            $no_farmasi_stl_kon_ling_psn = $farmasi->where('stl_kon_ling_psn', '0')->count();
            $no_farmasi_hr = $farmasi->where('hr', '0')->count();
            $no_farmasi_hw = $farmasi->where('hw', '0')->count();
            $no_farmasi_gagal = $farmasi->where('gagal', '0')->count();
            $no_farmasi_st = $farmasi->where('st', '0')->count();
            $no_farmasi_jumlah = $no_farmasi_sbl_kon_psn + $no_farmasi_sbl_tin_aseptik + $no_farmasi_stl_kon_cairan + $no_farmasi_stl_kon_psn + $no_farmasi_stl_kon_ling_psn + $no_farmasi_hr + $no_farmasi_hw + $no_farmasi_gagal + $no_farmasi_st;

            $igd_sbl_kon_psn = $igd->where('sbl_kon_psn', '1')->count();
            $igd_sbl_tin_aseptik = $igd->where('sbl_tin_aseptik', '1')->count();
            $igd_stl_kon_cairan = $igd->where('stl_kon_cairan', '1')->count();
            $igd_stl_kon_psn = $igd->where('stl_kon_psn', '1')->count();
            $igd_stl_kon_ling_psn = $igd->where('stl_kon_ling_psn', '1')->count();
            $igd_hr = $igd->where('hr', '1')->count();
            $igd_hw = $igd->where('hw', '1')->count();
            $igd_gagal = $igd->where('gagal', '1')->count();
            $igd_st = $igd->where('st', '1')->count();
            $igd_jumlah = $igd_sbl_kon_psn + $igd_sbl_tin_aseptik + $igd_stl_kon_cairan + $igd_stl_kon_psn + $igd_stl_kon_ling_psn + $igd_hr + $igd_hw + $igd_gagal + $igd_st;

            $no_igd_sbl_kon_psn = $igd->where('sbl_kon_psn', '0')->count();
            $no_igd_sbl_tin_aseptik = $igd->where('sbl_tin_aseptik', '0')->count();
            $no_igd_stl_kon_cairan = $igd->where('stl_kon_cairan', '0')->count();
            $no_igd_stl_kon_psn = $igd->where('stl_kon_psn', '0')->count();
            $no_igd_stl_kon_ling_psn = $igd->where('stl_kon_ling_psn', '0')->count();
            $no_igd_hr = $igd->where('hr', '0')->count();
            $no_igd_hw = $igd->where('hw', '0')->count();
            $no_igd_gagal = $igd->where('gagal', '0')->count();
            $no_igd_st = $igd->where('st', '0')->count();
            $no_igd_jumlah = $no_igd_sbl_kon_psn + $no_igd_sbl_tin_aseptik + $no_igd_stl_kon_cairan + $no_igd_stl_kon_psn + $no_igd_stl_kon_ling_psn + $no_igd_hr + $no_igd_hw + $no_igd_gagal + $no_igd_st;

            $int_sbl_kon_psn = $int->where('sbl_kon_psn', '1')->count();
            $int_sbl_tin_aseptik = $int->where('sbl_tin_aseptik', '1')->count();
            $int_stl_kon_cairan = $int->where('stl_kon_cairan', '1')->count();
            $int_stl_kon_psn = $int->where('stl_kon_psn', '1')->count();
            $int_stl_kon_ling_psn = $int->where('stl_kon_ling_psn', '1')->count();
            $int_hr = $int->where('hr', '1')->count();
            $int_hw = $int->where('hw', '1')->count();
            $int_gagal = $int->where('gagal', '1')->count();
            $int_st = $int->where('st', '1')->count();
            $int_jumlah = $int_sbl_kon_psn + $int_sbl_tin_aseptik + $int_stl_kon_cairan + $int_stl_kon_psn + $int_stl_kon_ling_psn + $int_hr + $int_hw + $int_gagal + $int_st;

            $no_int_sbl_kon_psn = $int->where('sbl_kon_psn', '0')->count();
            $no_int_sbl_tin_aseptik = $int->where('sbl_tin_aseptik', '0')->count();
            $no_int_stl_kon_cairan = $int->where('stl_kon_cairan', '0')->count();
            $no_int_stl_kon_psn = $int->where('stl_kon_psn', '0')->count();
            $no_int_stl_kon_ling_psn = $int->where('stl_kon_ling_psn', '0')->count();
            $no_int_hr = $int->where('hr', '0')->count();
            $no_int_hw = $int->where('hw', '0')->count();
            $no_int_gagal = $int->where('gagal', '0')->count();
            $no_int_st = $int->where('st', '0')->count();
            $no_int_jumlah = $no_int_sbl_kon_psn + $no_int_sbl_tin_aseptik + $no_int_stl_kon_cairan + $no_int_stl_kon_psn + $no_int_stl_kon_ling_psn + $no_int_hr + $no_int_hw + $no_int_gagal + $no_int_st;

            $kebersihan_sbl_kon_psn = $kebersihan->where('sbl_kon_psn', '1')->count();
            $kebersihan_sbl_tin_aseptik = $kebersihan->where('sbl_tin_aseptik', '1')->count();
            $kebersihan_stl_kon_cairan = $kebersihan->where('stl_kon_cairan', '1')->count();
            $kebersihan_stl_kon_psn = $kebersihan->where('stl_kon_psn', '1')->count();
            $kebersihan_stl_kon_ling_psn = $kebersihan->where('stl_kon_ling_psn', '1')->count();
            $kebersihan_hr = $kebersihan->where('hr', '1')->count();
            $kebersihan_hw = $kebersihan->where('hw', '1')->count();
            $kebersihan_gagal = $kebersihan->where('gagal', '1')->count();
            $kebersihan_st = $kebersihan->where('st', '1')->count();
            $kebersihan_jumlah = $kebersihan_sbl_kon_psn + $kebersihan_sbl_tin_aseptik + $kebersihan_stl_kon_cairan + $kebersihan_stl_kon_psn + $kebersihan_stl_kon_ling_psn + $kebersihan_hr + $kebersihan_hw + $kebersihan_gagal + $kebersihan_st;

            $no_kebersihan_sbl_kon_psn = $kebersihan->where('sbl_kon_psn', '0')->count();
            $no_kebersihan_sbl_tin_aseptik = $kebersihan->where('sbl_tin_aseptik', '0')->count();
            $no_kebersihan_stl_kon_cairan = $kebersihan->where('stl_kon_cairan', '0')->count();
            $no_kebersihan_stl_kon_psn = $kebersihan->where('stl_kon_psn', '0')->count();
            $no_kebersihan_stl_kon_ling_psn = $kebersihan->where('stl_kon_ling_psn', '0')->count();
            $no_kebersihan_hr = $kebersihan->where('hr', '0')->count();
            $no_kebersihan_hw = $kebersihan->where('hw', '0')->count();
            $no_kebersihan_gagal = $kebersihan->where('gagal', '0')->count();
            $no_kebersihan_st = $kebersihan->where('st', '0')->count();
            $no_kebersihan_jumlah = $no_kebersihan_sbl_kon_psn + $no_kebersihan_sbl_tin_aseptik + $no_kebersihan_stl_kon_cairan + $no_kebersihan_stl_kon_psn + $no_kebersihan_stl_kon_ling_psn + $no_kebersihan_hr + $no_kebersihan_hw + $no_kebersihan_gagal + $no_kebersihan_st;

            $kbbl_sbl_kon_psn = $kbbl->where('sbl_kon_psn', '1')->count();
            $kbbl_sbl_tin_aseptik = $kbbl->where('sbl_tin_aseptik', '1')->count();
            $kbbl_stl_kon_cairan = $kbbl->where('stl_kon_cairan', '1')->count();
            $kbbl_stl_kon_psn = $kbbl->where('stl_kon_psn', '1')->count();
            $kbbl_stl_kon_ling_psn = $kbbl->where('stl_kon_ling_psn', '1')->count();
            $kbbl_hr = $kbbl->where('hr', '1')->count();
            $kbbl_hw = $kbbl->where('hw', '1')->count();
            $kbbl_gagal = $kbbl->where('gagal', '1')->count();
            $kbbl_st = $kbbl->where('st', '1')->count();
            $kbbl_jumlah = $kbbl_sbl_kon_psn + $kbbl_sbl_tin_aseptik + $kbbl_stl_kon_cairan + $kbbl_stl_kon_psn + $kbbl_stl_kon_ling_psn + $kbbl_hr + $kbbl_hw + $kbbl_gagal + $kbbl_st;

            $no_kbbl_sbl_kon_psn = $kbbl->where('sbl_kon_psn', '0')->count();
            $no_kbbl_sbl_tin_aseptik = $kbbl->where('sbl_tin_aseptik', '0')->count();
            $no_kbbl_stl_kon_cairan = $kbbl->where('stl_kon_cairan', '0')->count();
            $no_kbbl_stl_kon_psn = $kbbl->where('stl_kon_psn', '0')->count();
            $no_kbbl_stl_kon_ling_psn = $kbbl->where('stl_kon_ling_psn', '0')->count();
            $no_kbbl_hr = $kbbl->where('hr', '0')->count();
            $no_kbbl_hw = $kbbl->where('hw', '0')->count();
            $no_kbbl_gagal = $kbbl->where('gagal', '0')->count();
            $no_kbbl_st = $kbbl->where('st', '0')->count();
            $no_kbbl_jumlah = $no_kbbl_sbl_kon_psn + $no_kbbl_sbl_tin_aseptik + $no_kbbl_stl_kon_cairan + $no_kbbl_stl_kon_psn + $no_kbbl_stl_kon_ling_psn + $no_kbbl_hr + $no_kbbl_hw + $no_kbbl_gagal + $no_kbbl_st;

            $lab_sbl_kon_psn = $lab->where('sbl_kon_psn', '1')->count();
            $lab_sbl_tin_aseptik = $lab->where('sbl_tin_aseptik', '1')->count();
            $lab_stl_kon_cairan = $lab->where('stl_kon_cairan', '1')->count();
            $lab_stl_kon_psn = $lab->where('stl_kon_psn', '1')->count();
            $lab_stl_kon_ling_psn = $lab->where('stl_kon_ling_psn', '1')->count();
            $lab_hr = $lab->where('hr', '1')->count();
            $lab_hw = $lab->where('hw', '1')->count();
            $lab_gagal = $lab->where('gagal', '1')->count();
            $lab_st = $lab->where('st', '1')->count();
            $lab_jumlah = $lab_sbl_kon_psn + $lab_sbl_tin_aseptik + $lab_stl_kon_cairan + $lab_stl_kon_psn + $lab_stl_kon_ling_psn + $lab_hr + $lab_hw + $lab_gagal + $lab_st;

            $no_lab_sbl_kon_psn = $lab->where('sbl_kon_psn', '0')->count();
            $no_lab_sbl_tin_aseptik = $lab->where('sbl_tin_aseptik', '0')->count();
            $no_lab_stl_kon_cairan = $lab->where('stl_kon_cairan', '0')->count();
            $no_lab_stl_kon_psn = $lab->where('stl_kon_psn', '0')->count();
            $no_lab_stl_kon_ling_psn = $lab->where('stl_kon_ling_psn', '0')->count();
            $no_lab_hr = $lab->where('hr', '0')->count();
            $no_lab_hw = $lab->where('hw', '0')->count();
            $no_lab_gagal = $lab->where('gagal', '0')->count();
            $no_lab_st = $lab->where('st', '0')->count();
            $no_lab_jumlah = $no_lab_sbl_kon_psn + $no_lab_sbl_tin_aseptik + $no_lab_stl_kon_cairan + $no_lab_stl_kon_psn + $no_lab_stl_kon_ling_psn + $no_lab_hr + $no_lab_hw + $no_lab_gagal + $no_lab_st;

            $laundry_sbl_kon_psn = $laundry->where('sbl_kon_psn', '1')->count();
            $laundry_sbl_tin_aseptik = $laundry->where('sbl_tin_aseptik', '1')->count();
            $laundry_stl_kon_cairan = $laundry->where('stl_kon_cairan', '1')->count();
            $laundry_stl_kon_psn = $laundry->where('stl_kon_psn', '1')->count();
            $laundry_stl_kon_ling_psn = $laundry->where('stl_kon_ling_psn', '1')->count();
            $laundry_hr = $laundry->where('hr', '1')->count();
            $laundry_hw = $laundry->where('hw', '1')->count();
            $laundry_gagal = $laundry->where('gagal', '1')->count();
            $laundry_st = $laundry->where('st', '1')->count();
            $laundry_jumlah = $laundry_sbl_kon_psn + $laundry_sbl_tin_aseptik + $laundry_stl_kon_cairan + $laundry_stl_kon_psn + $laundry_stl_kon_ling_psn + $laundry_hr + $laundry_hw + $laundry_gagal + $laundry_st;

            $no_laundry_sbl_kon_psn = $laundry->where('sbl_kon_psn', '0')->count();
            $no_laundry_sbl_tin_aseptik = $laundry->where('sbl_tin_aseptik', '0')->count();
            $no_laundry_stl_kon_cairan = $laundry->where('stl_kon_cairan', '0')->count();
            $no_laundry_stl_kon_psn = $laundry->where('stl_kon_psn', '0')->count();
            $no_laundry_stl_kon_ling_psn = $laundry->where('stl_kon_ling_psn', '0')->count();
            $no_laundry_hr = $laundry->where('hr', '0')->count();
            $no_laundry_hw = $laundry->where('hw', '0')->count();
            $no_laundry_gagal = $laundry->where('gagal', '0')->count();
            $no_laundry_st = $laundry->where('st', '0')->count();
            $no_laundry_jumlah = $no_laundry_sbl_kon_psn + $no_laundry_sbl_tin_aseptik + $no_laundry_stl_kon_cairan + $no_laundry_stl_kon_psn + $no_laundry_stl_kon_ling_psn + $no_laundry_hr + $no_laundry_hw + $no_laundry_gagal + $no_laundry_st;

            $ok_sbl_kon_psn = $ok->where('sbl_kon_psn', '1')->count();
            $ok_sbl_tin_aseptik = $ok->where('sbl_tin_aseptik', '1')->count();
            $ok_stl_kon_cairan = $ok->where('stl_kon_cairan', '1')->count();
            $ok_stl_kon_psn = $ok->where('stl_kon_psn', '1')->count();
            $ok_stl_kon_ling_psn = $ok->where('stl_kon_ling_psn', '1')->count();
            $ok_hr = $ok->where('hr', '1')->count();
            $ok_hw = $ok->where('hw', '1')->count();
            $ok_gagal = $ok->where('gagal', '1')->count();
            $ok_st = $ok->where('st', '1')->count();
            $ok_jumlah = $ok_sbl_kon_psn + $ok_sbl_tin_aseptik + $ok_stl_kon_cairan + $ok_stl_kon_psn + $ok_stl_kon_ling_psn + $ok_hr + $ok_hw + $ok_gagal + $ok_st;

            $no_ok_sbl_kon_psn = $ok->where('sbl_kon_psn', '0')->count();
            $no_ok_sbl_tin_aseptik = $ok->where('sbl_tin_aseptik', '0')->count();
            $no_ok_stl_kon_cairan = $ok->where('stl_kon_cairan', '0')->count();
            $no_ok_stl_kon_psn = $ok->where('stl_kon_psn', '0')->count();
            $no_ok_stl_kon_ling_psn = $ok->where('stl_kon_ling_psn', '0')->count();
            $no_ok_hr = $ok->where('hr', '0')->count();
            $no_ok_hw = $ok->where('hw', '0')->count();
            $no_ok_gagal = $ok->where('gagal', '0')->count();
            $no_ok_st = $ok->where('st', '0')->count();
            $no_ok_jumlah = $no_ok_sbl_kon_psn + $no_ok_sbl_tin_aseptik + $no_ok_stl_kon_cairan + $no_ok_stl_kon_psn + $no_ok_stl_kon_ling_psn + $no_ok_hr + $no_ok_hw + $no_ok_gagal + $no_ok_st;

            $lt2_sbl_kon_psn = $lt2->where('sbl_kon_psn', '1')->count();
            $lt2_sbl_tin_aseptik = $lt2->where('sbl_tin_aseptik', '1')->count();
            $lt2_stl_kon_cairan = $lt2->where('stl_kon_cairan', '1')->count();
            $lt2_stl_kon_psn = $lt2->where('stl_kon_psn', '1')->count();
            $lt2_stl_kon_ling_psn = $lt2->where('stl_kon_ling_psn', '1')->count();
            $lt2_hr = $lt2->where('hr', '1')->count();
            $lt2_hw = $lt2->where('hw', '1')->count();
            $lt2_gagal = $lt2->where('gagal', '1')->count();
            $lt2_st = $lt2->where('st', '1')->count();
            $lt2_jumlah = $lt2_sbl_kon_psn + $lt2_sbl_tin_aseptik + $lt2_stl_kon_cairan + $lt2_stl_kon_psn + $lt2_stl_kon_ling_psn + $lt2_hr + $lt2_hw + $lt2_gagal + $lt2_st;

            $no_lt2_sbl_kon_psn = $lt2->where('sbl_kon_psn', '0')->count();
            $no_lt2_sbl_tin_aseptik = $lt2->where('sbl_tin_aseptik', '0')->count();
            $no_lt2_stl_kon_cairan = $lt2->where('stl_kon_cairan', '0')->count();
            $no_lt2_stl_kon_psn = $lt2->where('stl_kon_psn', '0')->count();
            $no_lt2_stl_kon_ling_psn = $lt2->where('stl_kon_ling_psn', '0')->count();
            $no_lt2_hr = $lt2->where('hr', '0')->count();
            $no_lt2_hw = $lt2->where('hw', '0')->count();
            $no_lt2_gagal = $lt2->where('gagal', '0')->count();
            $no_lt2_st = $lt2->where('st', '0')->count();
            $no_lt2_jumlah = $no_lt2_sbl_kon_psn + $no_lt2_sbl_tin_aseptik + $no_lt2_stl_kon_cairan + $no_lt2_stl_kon_psn + $no_lt2_stl_kon_ling_psn + $no_lt2_hr + $no_lt2_hw + $no_lt2_gagal + $no_lt2_st;

            $lt4_sbl_kon_psn = $lt4->where('sbl_kon_psn', '1')->count();
            $lt4_sbl_tin_aseptik = $lt4->where('sbl_tin_aseptik', '1')->count();
            $lt4_stl_kon_cairan = $lt4->where('stl_kon_cairan', '1')->count();
            $lt4_stl_kon_psn = $lt4->where('stl_kon_psn', '1')->count();
            $lt4_stl_kon_ling_psn = $lt4->where('stl_kon_ling_psn', '1')->count();
            $lt4_hr = $lt4->where('hr', '1')->count();
            $lt4_hw = $lt4->where('hw', '1')->count();
            $lt4_gagal = $lt4->where('gagal', '1')->count();
            $lt4_st = $lt4->where('st', '1')->count();
            $lt4_jumlah = $lt4_sbl_kon_psn + $lt4_sbl_tin_aseptik + $lt4_stl_kon_cairan + $lt4_stl_kon_psn + $lt4_stl_kon_ling_psn + $lt4_hr + $lt4_hw + $lt4_gagal + $lt4_st;

            $no_lt4_sbl_kon_psn = $lt4->where('sbl_kon_psn', '0')->count();
            $no_lt4_sbl_tin_aseptik = $lt4->where('sbl_tin_aseptik', '0')->count();
            $no_lt4_stl_kon_cairan = $lt4->where('stl_kon_cairan', '0')->count();
            $no_lt4_stl_kon_psn = $lt4->where('stl_kon_psn', '0')->count();
            $no_lt4_stl_kon_ling_psn = $lt4->where('stl_kon_ling_psn', '0')->count();
            $no_lt4_hr = $lt4->where('hr', '0')->count();
            $no_lt4_hw = $lt4->where('hw', '0')->count();
            $no_lt4_gagal = $lt4->where('gagal', '0')->count();
            $no_lt4_st = $lt4->where('st', '0')->count();
            $no_lt4_jumlah = $no_lt4_sbl_kon_psn + $no_lt4_sbl_tin_aseptik + $no_lt4_stl_kon_cairan + $no_lt4_stl_kon_psn + $no_lt4_stl_kon_ling_psn + $no_lt4_hr + $no_lt4_hw + $no_lt4_gagal + $no_lt4_st;

            $lt5_sbl_kon_psn = $lt5->where('sbl_kon_psn', '1')->count();
            $lt5_sbl_tin_aseptik = $lt5->where('sbl_tin_aseptik', '1')->count();
            $lt5_stl_kon_cairan = $lt5->where('stl_kon_cairan', '1')->count();
            $lt5_stl_kon_psn = $lt5->where('stl_kon_psn', '1')->count();
            $lt5_stl_kon_ling_psn = $lt5->where('stl_kon_ling_psn', '1')->count();
            $lt5_hr = $lt5->where('hr', '1')->count();
            $lt5_hw = $lt5->where('hw', '1')->count();
            $lt5_gagal = $lt5->where('gagal', '1')->count();
            $lt5_st = $lt5->where('st', '1')->count();
            $lt5_jumlah = $lt5_sbl_kon_psn + $lt5_sbl_tin_aseptik + $lt5_stl_kon_cairan + $lt5_stl_kon_psn + $lt5_stl_kon_ling_psn + $lt5_hr + $lt5_hw + $lt5_gagal + $lt5_st;

            $no_lt5_sbl_kon_psn = $lt5->where('sbl_kon_psn', '0')->count();
            $no_lt5_sbl_tin_aseptik = $lt5->where('sbl_tin_aseptik', '0')->count();
            $no_lt5_stl_kon_cairan = $lt5->where('stl_kon_cairan', '0')->count();
            $no_lt5_stl_kon_psn = $lt5->where('stl_kon_psn', '0')->count();
            $no_lt5_stl_kon_ling_psn = $lt5->where('stl_kon_ling_psn', '0')->count();
            $no_lt5_hr = $lt5->where('hr', '0')->count();
            $no_lt5_hw = $lt5->where('hw', '0')->count();
            $no_lt5_gagal = $lt5->where('gagal', '0')->count();
            $no_lt5_st = $lt5->where('st', '0')->count();
            $no_lt5_jumlah = $no_lt5_sbl_kon_psn + $no_lt5_sbl_tin_aseptik + $no_lt5_stl_kon_cairan + $no_lt5_stl_kon_psn + $no_lt5_stl_kon_ling_psn + $no_lt5_hr + $no_lt5_hw + $no_lt5_gagal + $no_lt5_st;

            $poli_sbl_kon_psn = $poli->where('sbl_kon_psn', '1')->count();
            $poli_sbl_tin_aseptik = $poli->where('sbl_tin_aseptik', '1')->count();
            $poli_stl_kon_cairan = $poli->where('stl_kon_cairan', '1')->count();
            $poli_stl_kon_psn = $poli->where('stl_kon_psn', '1')->count();
            $poli_stl_kon_ling_psn = $poli->where('stl_kon_ling_psn', '1')->count();
            $poli_hr = $poli->where('hr', '1')->count();
            $poli_hw = $poli->where('hw', '1')->count();
            $poli_gagal = $poli->where('gagal', '1')->count();
            $poli_st = $poli->where('st', '1')->count();
            $poli_jumlah = $poli_sbl_kon_psn + $poli_sbl_tin_aseptik + $poli_stl_kon_cairan + $poli_stl_kon_psn + $poli_stl_kon_ling_psn + $poli_hr + $poli_hw + $poli_gagal + $poli_st;

            $no_poli_sbl_kon_psn = $poli->where('sbl_kon_psn', '0')->count();
            $no_poli_sbl_tin_aseptik = $poli->where('sbl_tin_aseptik', '0')->count();
            $no_poli_stl_kon_cairan = $poli->where('stl_kon_cairan', '0')->count();
            $no_poli_stl_kon_psn = $poli->where('stl_kon_psn', '0')->count();
            $no_poli_stl_kon_ling_psn = $poli->where('stl_kon_ling_psn', '0')->count();
            $no_poli_hr = $poli->where('hr', '0')->count();
            $no_poli_hw = $poli->where('hw', '0')->count();
            $no_poli_gagal = $poli->where('gagal', '0')->count();
            $no_poli_st = $poli->where('st', '0')->count();
            $no_poli_jumlah = $no_poli_sbl_kon_psn + $no_poli_sbl_tin_aseptik + $no_poli_stl_kon_cairan + $no_poli_stl_kon_psn + $no_poli_stl_kon_ling_psn + $no_poli_hr + $no_poli_hw + $no_poli_gagal + $no_poli_st;

            $rad_sbl_kon_psn = $rad->where('sbl_kon_psn', '1')->count();
            $rad_sbl_tin_aseptik = $rad->where('sbl_tin_aseptik', '1')->count();
            $rad_stl_kon_cairan = $rad->where('stl_kon_cairan', '1')->count();
            $rad_stl_kon_psn = $rad->where('stl_kon_psn', '1')->count();
            $rad_stl_kon_ling_psn = $rad->where('stl_kon_ling_psn', '1')->count();
            $rad_hr = $rad->where('hr', '1')->count();
            $rad_hw = $rad->where('hw', '1')->count();
            $rad_gagal = $rad->where('gagal', '1')->count();
            $rad_st = $rad->where('st', '1')->count();
            $rad_jumlah = $rad_sbl_kon_psn + $rad_sbl_tin_aseptik + $rad_stl_kon_cairan + $rad_stl_kon_psn + $rad_stl_kon_ling_psn + $rad_hr + $rad_hw + $rad_gagal + $rad_st;

            $no_rad_sbl_kon_psn = $rad->where('sbl_kon_psn', '0')->count();
            $no_rad_sbl_tin_aseptik = $rad->where('sbl_tin_aseptik', '0')->count();
            $no_rad_stl_kon_cairan = $rad->where('stl_kon_cairan', '0')->count();
            $no_rad_stl_kon_psn = $rad->where('stl_kon_psn', '0')->count();
            $no_rad_stl_kon_ling_psn = $rad->where('stl_kon_ling_psn', '0')->count();
            $no_rad_hr = $rad->where('hr', '0')->count();
            $no_rad_hw = $rad->where('hw', '0')->count();
            $no_rad_gagal = $rad->where('gagal', '0')->count();
            $no_rad_st = $rad->where('st', '0')->count();
            $no_rad_jumlah = $no_rad_sbl_kon_psn + $no_rad_sbl_tin_aseptik + $no_rad_stl_kon_cairan + $no_rad_stl_kon_psn + $no_rad_stl_kon_ling_psn + $no_rad_hr + $no_rad_hw + $no_rad_gagal + $no_rad_st;

            $vk_sbl_kon_psn = $vk->where('sbl_kon_psn', '1')->count();
            $vk_sbl_tin_aseptik = $vk->where('sbl_tin_aseptik', '1')->count();
            $vk_stl_kon_cairan = $vk->where('stl_kon_cairan', '1')->count();
            $vk_stl_kon_psn = $vk->where('stl_kon_psn', '1')->count();
            $vk_stl_kon_ling_psn = $vk->where('stl_kon_ling_psn', '1')->count();
            $vk_hr = $vk->where('hr', '1')->count();
            $vk_hw = $vk->where('hw', '1')->count();
            $vk_gagal = $vk->where('gagal', '1')->count();
            $vk_st = $vk->where('st', '1')->count();
            $vk_jumlah = $vk_sbl_kon_psn + $vk_sbl_tin_aseptik + $vk_stl_kon_cairan + $vk_stl_kon_psn + $vk_stl_kon_ling_psn + $vk_hr + $vk_hw + $vk_gagal + $vk_st;

            $no_vk_sbl_kon_psn = $vk->where('sbl_kon_psn', '0')->count();
            $no_vk_sbl_tin_aseptik = $vk->where('sbl_tin_aseptik', '0')->count();
            $no_vk_stl_kon_cairan = $vk->where('stl_kon_cairan', '0')->count();
            $no_vk_stl_kon_psn = $vk->where('stl_kon_psn', '0')->count();
            $no_vk_stl_kon_ling_psn = $vk->where('stl_kon_ling_psn', '0')->count();
            $no_vk_hr = $vk->where('hr', '0')->count();
            $no_vk_hw = $vk->where('hw', '0')->count();
            $no_vk_gagal = $vk->where('gagal', '0')->count();
            $no_vk_st = $vk->where('st', '0')->count();
            $no_vk_jumlah = $no_vk_sbl_kon_psn + $no_vk_sbl_tin_aseptik + $no_vk_stl_kon_cairan + $no_vk_stl_kon_psn + $no_vk_stl_kon_ling_psn + $no_vk_hr + $no_vk_hw + $no_vk_gagal + $no_vk_st;

            return view('rekapCuciTangan.index', compact(
                'tabel',
                'rekap',
                'analisa',
                'tindak_lanjut',

                'cssu_sbl_kon_psn',
                'cssu_sbl_tin_aseptik',
                'cssu_stl_kon_cairan',
                'cssu_stl_kon_psn',
                'cssu_stl_kon_ling_psn',
                'cssu_hr',
                'cssu_hw',
                'cssu_gagal',
                'cssu_st',
                'cssu_jumlah',

                'no_cssu_sbl_kon_psn',
                'no_cssu_sbl_tin_aseptik',
                'no_cssu_stl_kon_cairan',
                'no_cssu_stl_kon_psn',
                'no_cssu_stl_kon_ling_psn',
                'no_cssu_hr',
                'no_cssu_hw',
                'no_cssu_gagal',
                'no_cssu_st',
                'no_cssu_jumlah',

                'dapur_sbl_kon_psn',
                'dapur_sbl_tin_aseptik',
                'dapur_stl_kon_cairan',
                'dapur_stl_kon_psn',
                'dapur_stl_kon_ling_psn',
                'dapur_hr',
                'dapur_hw',
                'dapur_gagal',
                'dapur_st',
                'dapur_jumlah',

                'no_dapur_sbl_kon_psn',
                'no_dapur_sbl_tin_aseptik',
                'no_dapur_stl_kon_cairan',
                'no_dapur_stl_kon_psn',
                'no_dapur_stl_kon_ling_psn',
                'no_dapur_hr',
                'no_dapur_hw',
                'no_dapur_gagal',
                'no_dapur_st',
                'no_dapur_jumlah',

                'dpjp_sbl_kon_psn',
                'dpjp_sbl_tin_aseptik',
                'dpjp_stl_kon_cairan',
                'dpjp_stl_kon_psn',
                'dpjp_stl_kon_ling_psn',
                'dpjp_hr',
                'dpjp_hw',
                'dpjp_gagal',
                'dpjp_st',
                'dpjp_jumlah',

                'no_dpjp_sbl_kon_psn',
                'no_dpjp_sbl_tin_aseptik',
                'no_dpjp_stl_kon_cairan',
                'no_dpjp_stl_kon_psn',
                'no_dpjp_stl_kon_ling_psn',
                'no_dpjp_hr',
                'no_dpjp_hw',
                'no_dpjp_gagal',
                'no_dpjp_st',
                'no_dpjp_jumlah',

                'farmasi_sbl_kon_psn',
                'farmasi_sbl_tin_aseptik',
                'farmasi_stl_kon_cairan',
                'farmasi_stl_kon_psn',
                'farmasi_stl_kon_ling_psn',
                'farmasi_hr',
                'farmasi_hw',
                'farmasi_gagal',
                'farmasi_st',
                'farmasi_jumlah',

                'no_farmasi_sbl_kon_psn',
                'no_farmasi_sbl_tin_aseptik',
                'no_farmasi_stl_kon_cairan',
                'no_farmasi_stl_kon_psn',
                'no_farmasi_stl_kon_ling_psn',
                'no_farmasi_hr',
                'no_farmasi_hw',
                'no_farmasi_gagal',
                'no_farmasi_st',
                'no_farmasi_jumlah',

                'igd_sbl_kon_psn',
                'igd_sbl_tin_aseptik',
                'igd_stl_kon_cairan',
                'igd_stl_kon_psn',
                'igd_stl_kon_ling_psn',
                'igd_hr',
                'igd_hw',
                'igd_gagal',
                'igd_st',
                'igd_jumlah',

                'no_igd_sbl_kon_psn',
                'no_igd_sbl_tin_aseptik',
                'no_igd_stl_kon_cairan',
                'no_igd_stl_kon_psn',
                'no_igd_stl_kon_ling_psn',
                'no_igd_hr',
                'no_igd_hw',
                'no_igd_gagal',
                'no_igd_st',
                'no_igd_jumlah',

                'int_sbl_kon_psn',
                'int_sbl_tin_aseptik',
                'int_stl_kon_cairan',
                'int_stl_kon_psn',
                'int_stl_kon_ling_psn',
                'int_hr',
                'int_hw',
                'int_gagal',
                'int_st',
                'int_jumlah',

                'no_int_sbl_kon_psn',
                'no_int_sbl_tin_aseptik',
                'no_int_stl_kon_cairan',
                'no_int_stl_kon_psn',
                'no_int_stl_kon_ling_psn',
                'no_int_hr',
                'no_int_hw',
                'no_int_gagal',
                'no_int_st',
                'no_int_jumlah',

                'kebersihan_sbl_kon_psn',
                'kebersihan_sbl_tin_aseptik',
                'kebersihan_stl_kon_cairan',
                'kebersihan_stl_kon_psn',
                'kebersihan_stl_kon_ling_psn',
                'kebersihan_hr',
                'kebersihan_hw',
                'kebersihan_gagal',
                'kebersihan_st',
                'kebersihan_jumlah',

                'no_kebersihan_sbl_kon_psn',
                'no_kebersihan_sbl_tin_aseptik',
                'no_kebersihan_stl_kon_cairan',
                'no_kebersihan_stl_kon_psn',
                'no_kebersihan_stl_kon_ling_psn',
                'no_kebersihan_hr',
                'no_kebersihan_hw',
                'no_kebersihan_gagal',
                'no_kebersihan_st',
                'no_kebersihan_jumlah',

                'denominator_kebersihan',

                'kbbl_sbl_kon_psn',
                'kbbl_sbl_tin_aseptik',
                'kbbl_stl_kon_cairan',
                'kbbl_stl_kon_psn',
                'kbbl_stl_kon_ling_psn',
                'kbbl_hr',
                'kbbl_hw',
                'kbbl_gagal',
                'kbbl_st',
                'kbbl_jumlah',

                'no_kbbl_sbl_kon_psn',
                'no_kbbl_sbl_tin_aseptik',
                'no_kbbl_stl_kon_cairan',
                'no_kbbl_stl_kon_psn',
                'no_kbbl_stl_kon_ling_psn',
                'no_kbbl_hr',
                'no_kbbl_hw',
                'no_kbbl_gagal',
                'no_kbbl_st',
                'no_kbbl_jumlah',

                'lab_sbl_kon_psn',
                'lab_sbl_tin_aseptik',
                'lab_stl_kon_cairan',
                'lab_stl_kon_psn',
                'lab_stl_kon_ling_psn',
                'lab_hr',
                'lab_hw',
                'lab_gagal',
                'lab_st',
                'lab_jumlah',

                'no_lab_sbl_kon_psn',
                'no_lab_sbl_tin_aseptik',
                'no_lab_stl_kon_cairan',
                'no_lab_stl_kon_psn',
                'no_lab_stl_kon_ling_psn',
                'no_lab_hr',
                'no_lab_hw',
                'no_lab_gagal',
                'no_lab_st',
                'no_lab_jumlah',

                'laundry_sbl_kon_psn',
                'laundry_sbl_tin_aseptik',
                'laundry_stl_kon_cairan',
                'laundry_stl_kon_psn',
                'laundry_stl_kon_ling_psn',
                'laundry_hr',
                'laundry_hw',
                'laundry_gagal',
                'laundry_st',
                'laundry_jumlah',

                'no_laundry_sbl_kon_psn',
                'no_laundry_sbl_tin_aseptik',
                'no_laundry_stl_kon_cairan',
                'no_laundry_stl_kon_psn',
                'no_laundry_stl_kon_ling_psn',
                'no_laundry_hr',
                'no_laundry_hw',
                'no_laundry_gagal',
                'no_laundry_st',
                'no_laundry_jumlah',

                'ok_sbl_kon_psn',
                'ok_sbl_tin_aseptik',
                'ok_stl_kon_cairan',
                'ok_stl_kon_psn',
                'ok_stl_kon_ling_psn',
                'ok_hr',
                'ok_hw',
                'ok_gagal',
                'ok_st',
                'ok_jumlah',

                'no_ok_sbl_kon_psn',
                'no_ok_sbl_tin_aseptik',
                'no_ok_stl_kon_cairan',
                'no_ok_stl_kon_psn',
                'no_ok_stl_kon_ling_psn',
                'no_ok_hr',
                'no_ok_hw',
                'no_ok_gagal',
                'no_ok_st',
                'no_ok_jumlah',

                'lt2_sbl_kon_psn',
                'lt2_sbl_tin_aseptik',
                'lt2_stl_kon_cairan',
                'lt2_stl_kon_psn',
                'lt2_stl_kon_ling_psn',
                'lt2_hr',
                'lt2_hw',
                'lt2_gagal',
                'lt2_st',
                'lt2_jumlah',

                'no_lt2_sbl_kon_psn',
                'no_lt2_sbl_tin_aseptik',
                'no_lt2_stl_kon_cairan',
                'no_lt2_stl_kon_psn',
                'no_lt2_stl_kon_ling_psn',
                'no_lt2_hr',
                'no_lt2_hw',
                'no_lt2_gagal',
                'no_lt2_st',
                'no_lt2_jumlah',

                'lt4_sbl_kon_psn',
                'lt4_sbl_tin_aseptik',
                'lt4_stl_kon_cairan',
                'lt4_stl_kon_psn',
                'lt4_stl_kon_ling_psn',
                'lt4_hr',
                'lt4_hw',
                'lt4_gagal',
                'lt4_st',
                'lt4_jumlah',

                'no_lt4_sbl_kon_psn',
                'no_lt4_sbl_tin_aseptik',
                'no_lt4_stl_kon_cairan',
                'no_lt4_stl_kon_psn',
                'no_lt4_stl_kon_ling_psn',
                'no_lt4_hr',
                'no_lt4_hw',
                'no_lt4_gagal',
                'no_lt4_st',
                'no_lt4_jumlah',

                'lt5_sbl_kon_psn',
                'lt5_sbl_tin_aseptik',
                'lt5_stl_kon_cairan',
                'lt5_stl_kon_psn',
                'lt5_stl_kon_ling_psn',
                'lt5_hr',
                'lt5_hw',
                'lt5_gagal',
                'lt5_st',
                'lt5_jumlah',

                'no_lt5_sbl_kon_psn',
                'no_lt5_sbl_tin_aseptik',
                'no_lt5_stl_kon_cairan',
                'no_lt5_stl_kon_psn',
                'no_lt5_stl_kon_ling_psn',
                'no_lt5_hr',
                'no_lt5_hw',
                'no_lt5_gagal',
                'no_lt5_st',
                'no_lt5_jumlah',

                'poli_sbl_kon_psn',
                'poli_sbl_tin_aseptik',
                'poli_stl_kon_cairan',
                'poli_stl_kon_psn',
                'poli_stl_kon_ling_psn',
                'poli_hr',
                'poli_hw',
                'poli_gagal',
                'poli_st',
                'poli_jumlah',

                'no_poli_sbl_kon_psn',
                'no_poli_sbl_tin_aseptik',
                'no_poli_stl_kon_cairan',
                'no_poli_stl_kon_psn',
                'no_poli_stl_kon_ling_psn',
                'no_poli_hr',
                'no_poli_hw',
                'no_poli_gagal',
                'no_poli_st',
                'no_poli_jumlah',

                'rad_sbl_kon_psn',
                'rad_sbl_tin_aseptik',
                'rad_stl_kon_cairan',
                'rad_stl_kon_psn',
                'rad_stl_kon_ling_psn',
                'rad_hr',
                'rad_hw',
                'rad_gagal',
                'rad_st',
                'rad_jumlah',

                'no_rad_sbl_kon_psn',
                'no_rad_sbl_tin_aseptik',
                'no_rad_stl_kon_cairan',
                'no_rad_stl_kon_psn',
                'no_rad_stl_kon_ling_psn',
                'no_rad_hr',
                'no_rad_hw',
                'no_rad_gagal',
                'no_rad_st',
                'no_rad_jumlah',

                'vk_sbl_kon_psn',
                'vk_sbl_tin_aseptik',
                'vk_stl_kon_cairan',
                'vk_stl_kon_psn',
                'vk_stl_kon_ling_psn',
                'vk_hr',
                'vk_hw',
                'vk_gagal',
                'vk_st',
                'vk_jumlah',

                'no_vk_sbl_kon_psn',
                'no_vk_sbl_tin_aseptik',
                'no_vk_stl_kon_cairan',
                'no_vk_stl_kon_psn',
                'no_vk_stl_kon_ling_psn',
                'no_vk_hr',
                'no_vk_hw',
                'no_vk_gagal',
                'no_vk_st',
                'no_vk_jumlah',
            ));
        } else {
            return Redirect::back()->withErrors(['msg' => 'Tanggal tidak boleh Lebih kecil dari sebelumnya']);
        }
    }

    public function excel(Request $request)
    {
        $tgl_skg = date('Y-m-d');

        if ($request->input('dari') <= $request->input('sampai')) {
            $tabel = CuciTangan::whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')->paginate(1000);
            // dd($tabel);

            $rekap = RekapCuciTangan::whereDate('dari', '=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('sampai', '=', $request->input('sampai') ?? $tgl_skg)
                ->get();

            $analisa = RekapCuciTangan::select('analisa')
                ->whereDate('dari', '=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('sampai', '=', $request->input('sampai') ?? $tgl_skg)
                ->get();

            $tindak_lanjut = RekapCuciTangan::select('tindak_lanjut')
                ->whereDate('dari', '=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('sampai', '=', $request->input('sampai') ?? $tgl_skg)
                ->get();

            $cssu = CuciTangan::where('unit', 'CSSU')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $dapur = CuciTangan::where('unit', 'Dapur')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $dpjp = CuciTangan::where('unit', 'DPJP')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $farmasi = CuciTangan::where('unit', 'Farmasi')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $igd = CuciTangan::where('unit', 'IGD')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $int = CuciTangan::where('unit', 'Intensif')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $kebersihan = CuciTangan::where('unit', 'Kebersihan')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $kbbl = CuciTangan::where('unit', 'KBBL')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lab = CuciTangan::where('unit', 'Laboratorium')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $laundry = CuciTangan::where('unit', 'Laundry')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $ok = CuciTangan::where('unit', 'OK')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt2 = CuciTangan::where('unit', 'Perawatan Eksekutif lt.2')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt4 = CuciTangan::where('unit', 'Perawatan Reguler lt.4')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt5 = CuciTangan::where('unit', 'Perawatan Reguler lt.5')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $poli = CuciTangan::where('unit', 'Poliklinik')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $rad = CuciTangan::where('unit', 'Radiologi')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $vk = CuciTangan::where('unit', 'VK')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();

            $cssu_sbl_kon_psn = $cssu->sum('sbl_kon_psn');
            $cssu_sbl_tin_aseptik = $cssu->sum('sbl_tin_aseptik');
            $cssu_stl_kon_cairan = $cssu->sum('stl_kon_cairan');
            $cssu_stl_kon_psn = $cssu->sum('stl_kon_psn');
            $cssu_stl_kon_ling_psn = $cssu->sum('stl_kon_ling_psn');
            $cssu_hr = $cssu->sum('hr');
            $cssu_hw = $cssu->sum('hw');
            $cssu_gagal = $cssu->sum('gagal');
            $cssu_st = $cssu->sum('st');

            $dapur_sbl_kon_psn = $dapur->sum('sbl_kon_psn');
            $dapur_sbl_tin_aseptik = $dapur->sum('sbl_tin_aseptik');
            $dapur_stl_kon_cairan = $dapur->sum('stl_kon_cairan');
            $dapur_stl_kon_psn = $dapur->sum('stl_kon_psn');
            $dapur_stl_kon_ling_psn = $dapur->sum('stl_kon_ling_psn');
            $dapur_hr = $dapur->sum('hr');
            $dapur_hw = $dapur->sum('hw');
            $dapur_gagal = $dapur->sum('gagal');
            $dapur_st = $dapur->sum('st');

            $dpjp_sbl_kon_psn = $dpjp->sum('sbl_kon_psn');
            $dpjp_sbl_tin_aseptik = $dpjp->sum('sbl_tin_aseptik');
            $dpjp_stl_kon_cairan = $dpjp->sum('stl_kon_cairan');
            $dpjp_stl_kon_psn = $dpjp->sum('stl_kon_psn');
            $dpjp_stl_kon_ling_psn = $dpjp->sum('stl_kon_ling_psn');
            $dpjp_hr = $dpjp->sum('hr');
            $dpjp_hw = $dpjp->sum('hw');
            $dpjp_gagal = $dpjp->sum('gagal');
            $dpjp_st = $dpjp->sum('st');

            $farmasi_sbl_kon_psn = $farmasi->sum('sbl_kon_psn');
            $farmasi_sbl_tin_aseptik = $farmasi->sum('sbl_tin_aseptik');
            $farmasi_stl_kon_cairan = $farmasi->sum('stl_kon_cairan');
            $farmasi_stl_kon_psn = $farmasi->sum('stl_kon_psn');
            $farmasi_stl_kon_ling_psn = $farmasi->sum('stl_kon_ling_psn');
            $farmasi_hr = $farmasi->sum('hr');
            $farmasi_hw = $farmasi->sum('hw');
            $farmasi_gagal = $farmasi->sum('gagal');
            $farmasi_st = $farmasi->sum('st');

            $igd_sbl_kon_psn = $igd->sum('sbl_kon_psn');
            $igd_sbl_tin_aseptik = $igd->sum('sbl_tin_aseptik');
            $igd_stl_kon_cairan = $igd->sum('stl_kon_cairan');
            $igd_stl_kon_psn = $igd->sum('stl_kon_psn');
            $igd_stl_kon_ling_psn = $igd->sum('stl_kon_ling_psn');
            $igd_hr = $igd->sum('hr');
            $igd_hw = $igd->sum('hw');
            $igd_gagal = $igd->sum('gagal');
            $igd_st = $igd->sum('st');

            $int_sbl_kon_psn = $int->sum('sbl_kon_psn');
            $int_sbl_tin_aseptik = $int->sum('sbl_tin_aseptik');
            $int_stl_kon_cairan = $int->sum('stl_kon_cairan');
            $int_stl_kon_psn = $int->sum('stl_kon_psn');
            $int_stl_kon_ling_psn = $int->sum('stl_kon_ling_psn');
            $int_hr = $int->sum('hr');
            $int_hw = $int->sum('hw');
            $int_gagal = $int->sum('gagal');
            $int_st = $int->sum('st');

            $kebersihan_sbl_kon_psn = $kebersihan->sum('sbl_kon_psn');
            $kebersihan_sbl_tin_aseptik = $kebersihan->sum('sbl_tin_aseptik');
            $kebersihan_stl_kon_cairan = $kebersihan->sum('stl_kon_cairan');
            $kebersihan_stl_kon_psn = $kebersihan->sum('stl_kon_psn');
            $kebersihan_stl_kon_ling_psn = $kebersihan->sum('stl_kon_ling_psn');
            $kebersihan_hr = $kebersihan->sum('hr');
            $kebersihan_hw = $kebersihan->sum('hw');
            $kebersihan_gagal = $kebersihan->sum('gagal');
            $kebersihan_st = $kebersihan->sum('st');

            $kbbl_sbl_kon_psn = $kbbl->sum('sbl_kon_psn');
            $kbbl_sbl_tin_aseptik = $kbbl->sum('sbl_tin_aseptik');
            $kbbl_stl_kon_cairan = $kbbl->sum('stl_kon_cairan');
            $kbbl_stl_kon_psn = $kbbl->sum('stl_kon_psn');
            $kbbl_stl_kon_ling_psn = $kbbl->sum('stl_kon_ling_psn');
            $kbbl_hr = $kbbl->sum('hr');
            $kbbl_hw = $kbbl->sum('hw');
            $kbbl_gagal = $kbbl->sum('gagal');
            $kbbl_st = $kbbl->sum('st');

            $lab_sbl_kon_psn = $lab->sum('sbl_kon_psn');
            $lab_sbl_tin_aseptik = $lab->sum('sbl_tin_aseptik');
            $lab_stl_kon_cairan = $lab->sum('stl_kon_cairan');
            $lab_stl_kon_psn = $lab->sum('stl_kon_psn');
            $lab_stl_kon_ling_psn = $lab->sum('stl_kon_ling_psn');
            $lab_hr = $lab->sum('hr');
            $lab_hw = $lab->sum('hw');
            $lab_gagal = $lab->sum('gagal');
            $lab_st = $lab->sum('st');

            $laundry_sbl_kon_psn = $laundry->sum('sbl_kon_psn');
            $laundry_sbl_tin_aseptik = $laundry->sum('sbl_tin_aseptik');
            $laundry_stl_kon_cairan = $laundry->sum('stl_kon_cairan');
            $laundry_stl_kon_psn = $laundry->sum('stl_kon_psn');
            $laundry_stl_kon_ling_psn = $laundry->sum('stl_kon_ling_psn');
            $laundry_hr = $laundry->sum('hr');
            $laundry_hw = $laundry->sum('hw');
            $laundry_gagal = $laundry->sum('gagal');
            $laundry_st = $laundry->sum('st');

            $ok_sbl_kon_psn = $ok->sum('sbl_kon_psn');
            $ok_sbl_tin_aseptik = $ok->sum('sbl_tin_aseptik');
            $ok_stl_kon_cairan = $ok->sum('stl_kon_cairan');
            $ok_stl_kon_psn = $ok->sum('stl_kon_psn');
            $ok_stl_kon_ling_psn = $ok->sum('stl_kon_ling_psn');
            $ok_hr = $ok->sum('hr');
            $ok_hw = $ok->sum('hw');
            $ok_gagal = $ok->sum('gagal');
            $ok_st = $ok->sum('st');

            $lt2_sbl_kon_psn = $lt2->sum('sbl_kon_psn');
            $lt2_sbl_tin_aseptik = $lt2->sum('sbl_tin_aseptik');
            $lt2_stl_kon_cairan = $lt2->sum('stl_kon_cairan');
            $lt2_stl_kon_psn = $lt2->sum('stl_kon_psn');
            $lt2_stl_kon_ling_psn = $lt2->sum('stl_kon_ling_psn');
            $lt2_hr = $lt2->sum('hr');
            $lt2_hw = $lt2->sum('hw');
            $lt2_gagal = $lt2->sum('gagal');
            $lt2_st = $lt2->sum('st');

            $lt4_sbl_kon_psn = $lt4->sum('sbl_kon_psn');
            $lt4_sbl_tin_aseptik = $lt4->sum('sbl_tin_aseptik');
            $lt4_stl_kon_cairan = $lt4->sum('stl_kon_cairan');
            $lt4_stl_kon_psn = $lt4->sum('stl_kon_psn');
            $lt4_stl_kon_ling_psn = $lt4->sum('stl_kon_ling_psn');
            $lt4_hr = $lt4->sum('hr');
            $lt4_hw = $lt4->sum('hw');
            $lt4_gagal = $lt4->sum('gagal');
            $lt4_st = $lt4->sum('st');

            $lt5_sbl_kon_psn = $lt5->sum('sbl_kon_psn');
            $lt5_sbl_tin_aseptik = $lt5->sum('sbl_tin_aseptik');
            $lt5_stl_kon_cairan = $lt5->sum('stl_kon_cairan');
            $lt5_stl_kon_psn = $lt5->sum('stl_kon_psn');
            $lt5_stl_kon_ling_psn = $lt5->sum('stl_kon_ling_psn');
            $lt5_hr = $lt5->sum('hr');
            $lt5_hw = $lt5->sum('hw');
            $lt5_gagal = $lt5->sum('gagal');
            $lt5_st = $lt5->sum('st');

            $poli_sbl_kon_psn = $poli->sum('sbl_kon_psn');
            $poli_sbl_tin_aseptik = $poli->sum('sbl_tin_aseptik');
            $poli_stl_kon_cairan = $poli->sum('stl_kon_cairan');
            $poli_stl_kon_psn = $poli->sum('stl_kon_psn');
            $poli_stl_kon_ling_psn = $poli->sum('stl_kon_ling_psn');
            $poli_hr = $poli->sum('hr');
            $poli_hw = $poli->sum('hw');
            $poli_gagal = $poli->sum('gagal');
            $poli_st = $poli->sum('st');

            $rad_sbl_kon_psn = $rad->sum('sbl_kon_psn');
            $rad_sbl_tin_aseptik = $rad->sum('sbl_tin_aseptik');
            $rad_stl_kon_cairan = $rad->sum('stl_kon_cairan');
            $rad_stl_kon_psn = $rad->sum('stl_kon_psn');
            $rad_stl_kon_ling_psn = $rad->sum('stl_kon_ling_psn');
            $rad_hr = $rad->sum('hr');
            $rad_hw = $rad->sum('hw');
            $rad_gagal = $rad->sum('gagal');
            $rad_st = $rad->sum('st');

            $vk_sbl_kon_psn = $vk->sum('sbl_kon_psn');
            $vk_sbl_tin_aseptik = $vk->sum('sbl_tin_aseptik');
            $vk_stl_kon_cairan = $vk->sum('stl_kon_cairan');
            $vk_stl_kon_psn = $vk->sum('stl_kon_psn');
            $vk_stl_kon_ling_psn = $vk->sum('stl_kon_ling_psn');
            $vk_hr = $vk->sum('hr');
            $vk_hw = $vk->sum('hw');
            $vk_gagal = $vk->sum('gagal');
            $vk_st = $vk->sum('st');

            $tanggal = Carbon::parse($request->input('dari'))->isoFormat('DD MMMM YYYY') . ' - ' . Carbon::parse($request->input('sampai'))->isoFormat('DD MMMM YYYY');

            return Excel::download(new ExportCuciTangan(
                $cssu_sbl_kon_psn,
                $cssu_sbl_tin_aseptik,
                $cssu_stl_kon_cairan,
                $cssu_stl_kon_psn,
                $cssu_stl_kon_ling_psn,
                $cssu_hr,
                $cssu_hw,
                $cssu_gagal,
                $cssu_st,

                $dapur_sbl_kon_psn,
                $dapur_sbl_tin_aseptik,
                $dapur_stl_kon_cairan,
                $dapur_stl_kon_psn,
                $dapur_stl_kon_ling_psn,
                $dapur_hr,
                $dapur_hw,
                $dapur_gagal,
                $dapur_st,

                $dpjp_sbl_kon_psn,
                $dpjp_sbl_tin_aseptik,
                $dpjp_stl_kon_cairan,
                $dpjp_stl_kon_psn,
                $dpjp_stl_kon_ling_psn,
                $dpjp_hr,
                $dpjp_hw,
                $dpjp_gagal,
                $dpjp_st,

                $farmasi_sbl_kon_psn,
                $farmasi_sbl_tin_aseptik,
                $farmasi_stl_kon_cairan,
                $farmasi_stl_kon_psn,
                $farmasi_stl_kon_ling_psn,
                $farmasi_hr,
                $farmasi_hw,
                $farmasi_gagal,
                $farmasi_st,

                $igd_sbl_kon_psn,
                $igd_sbl_tin_aseptik,
                $igd_stl_kon_cairan,
                $igd_stl_kon_psn,
                $igd_stl_kon_ling_psn,
                $igd_hr,
                $igd_hw,
                $igd_gagal,
                $igd_st,

                $int_sbl_kon_psn,
                $int_sbl_tin_aseptik,
                $int_stl_kon_cairan,
                $int_stl_kon_psn,
                $int_stl_kon_ling_psn,
                $int_hr,
                $int_hw,
                $int_gagal,
                $int_st,

                $kebersihan_sbl_kon_psn,
                $kebersihan_sbl_tin_aseptik,
                $kebersihan_stl_kon_cairan,
                $kebersihan_stl_kon_psn,
                $kebersihan_stl_kon_ling_psn,
                $kebersihan_hr,
                $kebersihan_hw,
                $kebersihan_gagal,
                $kebersihan_st,

                $kbbl_sbl_kon_psn,
                $kbbl_sbl_tin_aseptik,
                $kbbl_stl_kon_cairan,
                $kbbl_stl_kon_psn,
                $kbbl_stl_kon_ling_psn,
                $kbbl_hr,
                $kbbl_hw,
                $kbbl_gagal,
                $kbbl_st,

                $lab_sbl_kon_psn,
                $lab_sbl_tin_aseptik,
                $lab_stl_kon_cairan,
                $lab_stl_kon_psn,
                $lab_stl_kon_ling_psn,
                $lab_hr,
                $lab_hw,
                $lab_gagal,
                $lab_st,

                $laundry_sbl_kon_psn,
                $laundry_sbl_tin_aseptik,
                $laundry_stl_kon_cairan,
                $laundry_stl_kon_psn,
                $laundry_stl_kon_ling_psn,
                $laundry_hr,
                $laundry_hw,
                $laundry_gagal,
                $laundry_st,

                $ok_sbl_kon_psn,
                $ok_sbl_tin_aseptik,
                $ok_stl_kon_cairan,
                $ok_stl_kon_psn,
                $ok_stl_kon_ling_psn,
                $ok_hr,
                $ok_hw,
                $ok_gagal,
                $ok_st,

                $lt2_sbl_kon_psn,
                $lt2_sbl_tin_aseptik,
                $lt2_stl_kon_cairan,
                $lt2_stl_kon_psn,
                $lt2_stl_kon_ling_psn,
                $lt2_hr,
                $lt2_hw,
                $lt2_gagal,
                $lt2_st,

                $lt4_sbl_kon_psn,
                $lt4_sbl_tin_aseptik,
                $lt4_stl_kon_cairan,
                $lt4_stl_kon_psn,
                $lt4_stl_kon_ling_psn,
                $lt4_hr,
                $lt4_hw,
                $lt4_gagal,
                $lt4_st,

                $lt5_sbl_kon_psn,
                $lt5_sbl_tin_aseptik,
                $lt5_stl_kon_cairan,
                $lt5_stl_kon_psn,
                $lt5_stl_kon_ling_psn,
                $lt5_hr,
                $lt5_hw,
                $lt5_gagal,
                $lt5_st,

                $poli_sbl_kon_psn,
                $poli_sbl_tin_aseptik,
                $poli_stl_kon_cairan,
                $poli_stl_kon_psn,
                $poli_stl_kon_ling_psn,
                $poli_hr,
                $poli_hw,
                $poli_gagal,
                $poli_st,

                $rad_sbl_kon_psn,
                $rad_sbl_tin_aseptik,
                $rad_stl_kon_cairan,
                $rad_stl_kon_psn,
                $rad_stl_kon_ling_psn,
                $rad_hr,
                $rad_hw,
                $rad_gagal,
                $rad_st,

                $vk_sbl_kon_psn,
                $vk_sbl_tin_aseptik,
                $vk_stl_kon_cairan,
                $vk_stl_kon_psn,
                $vk_stl_kon_ling_psn,
                $vk_hr,
                $vk_hw,
                $vk_gagal,
                $vk_st,

                $tabel,
                $rekap,
                $tanggal
            ), 'Rekap Cuci Tangan ' . $tanggal . '.xlsx');
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
            $tabel = CuciTangan::whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')->paginate(1000);
            // dd($tabel);

            $rekap = RekapCuciTangan::whereDate('dari', '=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('sampai', '=', $request->input('sampai') ?? $tgl_skg)
                ->get();

            $analisa = RekapCuciTangan::select('analisa')
                ->whereDate('dari', '=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('sampai', '=', $request->input('sampai') ?? $tgl_skg)
                ->get();

            $tindak_lanjut = RekapCuciTangan::select('tindak_lanjut')
                ->whereDate('dari', '=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('sampai', '=', $request->input('sampai') ?? $tgl_skg)
                ->get();

            $cssu = CuciTangan::where('unit', 'CSSU')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $dapur = CuciTangan::where('unit', 'Dapur')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $dpjp = CuciTangan::where('unit', 'DPJP')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $farmasi = CuciTangan::where('unit', 'Farmasi')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $igd = CuciTangan::where('unit', 'IGD')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $int = CuciTangan::where('unit', 'Intensif')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $kebersihan = CuciTangan::where('unit', 'Kebersihan')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $kbbl = CuciTangan::where('unit', 'KBBL')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lab = CuciTangan::where('unit', 'Laboratorium')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $laundry = CuciTangan::where('unit', 'Laundry')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $ok = CuciTangan::where('unit', 'OK')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt2 = CuciTangan::where('unit', 'Perawatan Eksekutif lt.2')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt4 = CuciTangan::where('unit', 'Perawatan Reguler lt.4')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt5 = CuciTangan::where('unit', 'Perawatan Reguler lt.5')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $poli = CuciTangan::where('unit', 'Poliklinik')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $rad = CuciTangan::where('unit', 'Radiologi')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $vk = CuciTangan::where('unit', 'VK')
                ->whereDate('tgl_input', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl_input', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();

            $cssu_sbl_kon_psn = $cssu->sum('sbl_kon_psn');
            $cssu_sbl_tin_aseptik = $cssu->sum('sbl_tin_aseptik');
            $cssu_stl_kon_cairan = $cssu->sum('stl_kon_cairan');
            $cssu_stl_kon_psn = $cssu->sum('stl_kon_psn');
            $cssu_stl_kon_ling_psn = $cssu->sum('stl_kon_ling_psn');
            $cssu_hr = $cssu->sum('hr');
            $cssu_hw = $cssu->sum('hw');
            $cssu_gagal = $cssu->sum('gagal');
            $cssu_st = $cssu->sum('st');

            $dapur_sbl_kon_psn = $dapur->sum('sbl_kon_psn');
            $dapur_sbl_tin_aseptik = $dapur->sum('sbl_tin_aseptik');
            $dapur_stl_kon_cairan = $dapur->sum('stl_kon_cairan');
            $dapur_stl_kon_psn = $dapur->sum('stl_kon_psn');
            $dapur_stl_kon_ling_psn = $dapur->sum('stl_kon_ling_psn');
            $dapur_hr = $dapur->sum('hr');
            $dapur_hw = $dapur->sum('hw');
            $dapur_gagal = $dapur->sum('gagal');
            $dapur_st = $dapur->sum('st');

            $dpjp_sbl_kon_psn = $dpjp->sum('sbl_kon_psn');
            $dpjp_sbl_tin_aseptik = $dpjp->sum('sbl_tin_aseptik');
            $dpjp_stl_kon_cairan = $dpjp->sum('stl_kon_cairan');
            $dpjp_stl_kon_psn = $dpjp->sum('stl_kon_psn');
            $dpjp_stl_kon_ling_psn = $dpjp->sum('stl_kon_ling_psn');
            $dpjp_hr = $dpjp->sum('hr');
            $dpjp_hw = $dpjp->sum('hw');
            $dpjp_gagal = $dpjp->sum('gagal');
            $dpjp_st = $dpjp->sum('st');

            $farmasi_sbl_kon_psn = $farmasi->sum('sbl_kon_psn');
            $farmasi_sbl_tin_aseptik = $farmasi->sum('sbl_tin_aseptik');
            $farmasi_stl_kon_cairan = $farmasi->sum('stl_kon_cairan');
            $farmasi_stl_kon_psn = $farmasi->sum('stl_kon_psn');
            $farmasi_stl_kon_ling_psn = $farmasi->sum('stl_kon_ling_psn');
            $farmasi_hr = $farmasi->sum('hr');
            $farmasi_hw = $farmasi->sum('hw');
            $farmasi_gagal = $farmasi->sum('gagal');
            $farmasi_st = $farmasi->sum('st');

            $igd_sbl_kon_psn = $igd->sum('sbl_kon_psn');
            $igd_sbl_tin_aseptik = $igd->sum('sbl_tin_aseptik');
            $igd_stl_kon_cairan = $igd->sum('stl_kon_cairan');
            $igd_stl_kon_psn = $igd->sum('stl_kon_psn');
            $igd_stl_kon_ling_psn = $igd->sum('stl_kon_ling_psn');
            $igd_hr = $igd->sum('hr');
            $igd_hw = $igd->sum('hw');
            $igd_gagal = $igd->sum('gagal');
            $igd_st = $igd->sum('st');

            $int_sbl_kon_psn = $int->sum('sbl_kon_psn');
            $int_sbl_tin_aseptik = $int->sum('sbl_tin_aseptik');
            $int_stl_kon_cairan = $int->sum('stl_kon_cairan');
            $int_stl_kon_psn = $int->sum('stl_kon_psn');
            $int_stl_kon_ling_psn = $int->sum('stl_kon_ling_psn');
            $int_hr = $int->sum('hr');
            $int_hw = $int->sum('hw');
            $int_gagal = $int->sum('gagal');
            $int_st = $int->sum('st');

            $kebersihan_sbl_kon_psn = $kebersihan->sum('sbl_kon_psn');
            $kebersihan_sbl_tin_aseptik = $kebersihan->sum('sbl_tin_aseptik');
            $kebersihan_stl_kon_cairan = $kebersihan->sum('stl_kon_cairan');
            $kebersihan_stl_kon_psn = $kebersihan->sum('stl_kon_psn');
            $kebersihan_stl_kon_ling_psn = $kebersihan->sum('stl_kon_ling_psn');
            $kebersihan_hr = $kebersihan->sum('hr');
            $kebersihan_hw = $kebersihan->sum('hw');
            $kebersihan_gagal = $kebersihan->sum('gagal');
            $kebersihan_st = $kebersihan->sum('st');

            $kbbl_sbl_kon_psn = $kbbl->sum('sbl_kon_psn');
            $kbbl_sbl_tin_aseptik = $kbbl->sum('sbl_tin_aseptik');
            $kbbl_stl_kon_cairan = $kbbl->sum('stl_kon_cairan');
            $kbbl_stl_kon_psn = $kbbl->sum('stl_kon_psn');
            $kbbl_stl_kon_ling_psn = $kbbl->sum('stl_kon_ling_psn');
            $kbbl_hr = $kbbl->sum('hr');
            $kbbl_hw = $kbbl->sum('hw');
            $kbbl_gagal = $kbbl->sum('gagal');
            $kbbl_st = $kbbl->sum('st');

            $lab_sbl_kon_psn = $lab->sum('sbl_kon_psn');
            $lab_sbl_tin_aseptik = $lab->sum('sbl_tin_aseptik');
            $lab_stl_kon_cairan = $lab->sum('stl_kon_cairan');
            $lab_stl_kon_psn = $lab->sum('stl_kon_psn');
            $lab_stl_kon_ling_psn = $lab->sum('stl_kon_ling_psn');
            $lab_hr = $lab->sum('hr');
            $lab_hw = $lab->sum('hw');
            $lab_gagal = $lab->sum('gagal');
            $lab_st = $lab->sum('st');

            $laundry_sbl_kon_psn = $laundry->sum('sbl_kon_psn');
            $laundry_sbl_tin_aseptik = $laundry->sum('sbl_tin_aseptik');
            $laundry_stl_kon_cairan = $laundry->sum('stl_kon_cairan');
            $laundry_stl_kon_psn = $laundry->sum('stl_kon_psn');
            $laundry_stl_kon_ling_psn = $laundry->sum('stl_kon_ling_psn');
            $laundry_hr = $laundry->sum('hr');
            $laundry_hw = $laundry->sum('hw');
            $laundry_gagal = $laundry->sum('gagal');
            $laundry_st = $laundry->sum('st');

            $ok_sbl_kon_psn = $ok->sum('sbl_kon_psn');
            $ok_sbl_tin_aseptik = $ok->sum('sbl_tin_aseptik');
            $ok_stl_kon_cairan = $ok->sum('stl_kon_cairan');
            $ok_stl_kon_psn = $ok->sum('stl_kon_psn');
            $ok_stl_kon_ling_psn = $ok->sum('stl_kon_ling_psn');
            $ok_hr = $ok->sum('hr');
            $ok_hw = $ok->sum('hw');
            $ok_gagal = $ok->sum('gagal');
            $ok_st = $ok->sum('st');

            $lt2_sbl_kon_psn = $lt2->sum('sbl_kon_psn');
            $lt2_sbl_tin_aseptik = $lt2->sum('sbl_tin_aseptik');
            $lt2_stl_kon_cairan = $lt2->sum('stl_kon_cairan');
            $lt2_stl_kon_psn = $lt2->sum('stl_kon_psn');
            $lt2_stl_kon_ling_psn = $lt2->sum('stl_kon_ling_psn');
            $lt2_hr = $lt2->sum('hr');
            $lt2_hw = $lt2->sum('hw');
            $lt2_gagal = $lt2->sum('gagal');
            $lt2_st = $lt2->sum('st');

            $lt4_sbl_kon_psn = $lt4->sum('sbl_kon_psn');
            $lt4_sbl_tin_aseptik = $lt4->sum('sbl_tin_aseptik');
            $lt4_stl_kon_cairan = $lt4->sum('stl_kon_cairan');
            $lt4_stl_kon_psn = $lt4->sum('stl_kon_psn');
            $lt4_stl_kon_ling_psn = $lt4->sum('stl_kon_ling_psn');
            $lt4_hr = $lt4->sum('hr');
            $lt4_hw = $lt4->sum('hw');
            $lt4_gagal = $lt4->sum('gagal');
            $lt4_st = $lt4->sum('st');

            $lt5_sbl_kon_psn = $lt5->sum('sbl_kon_psn');
            $lt5_sbl_tin_aseptik = $lt5->sum('sbl_tin_aseptik');
            $lt5_stl_kon_cairan = $lt5->sum('stl_kon_cairan');
            $lt5_stl_kon_psn = $lt5->sum('stl_kon_psn');
            $lt5_stl_kon_ling_psn = $lt5->sum('stl_kon_ling_psn');
            $lt5_hr = $lt5->sum('hr');
            $lt5_hw = $lt5->sum('hw');
            $lt5_gagal = $lt5->sum('gagal');
            $lt5_st = $lt5->sum('st');

            $poli_sbl_kon_psn = $poli->sum('sbl_kon_psn');
            $poli_sbl_tin_aseptik = $poli->sum('sbl_tin_aseptik');
            $poli_stl_kon_cairan = $poli->sum('stl_kon_cairan');
            $poli_stl_kon_psn = $poli->sum('stl_kon_psn');
            $poli_stl_kon_ling_psn = $poli->sum('stl_kon_ling_psn');
            $poli_hr = $poli->sum('hr');
            $poli_hw = $poli->sum('hw');
            $poli_gagal = $poli->sum('gagal');
            $poli_st = $poli->sum('st');

            $rad_sbl_kon_psn = $rad->sum('sbl_kon_psn');
            $rad_sbl_tin_aseptik = $rad->sum('sbl_tin_aseptik');
            $rad_stl_kon_cairan = $rad->sum('stl_kon_cairan');
            $rad_stl_kon_psn = $rad->sum('stl_kon_psn');
            $rad_stl_kon_ling_psn = $rad->sum('stl_kon_ling_psn');
            $rad_hr = $rad->sum('hr');
            $rad_hw = $rad->sum('hw');
            $rad_gagal = $rad->sum('gagal');
            $rad_st = $rad->sum('st');

            $vk_sbl_kon_psn = $vk->sum('sbl_kon_psn');
            $vk_sbl_tin_aseptik = $vk->sum('sbl_tin_aseptik');
            $vk_stl_kon_cairan = $vk->sum('stl_kon_cairan');
            $vk_stl_kon_psn = $vk->sum('stl_kon_psn');
            $vk_stl_kon_ling_psn = $vk->sum('stl_kon_ling_psn');
            $vk_hr = $vk->sum('hr');
            $vk_hw = $vk->sum('hw');
            $vk_gagal = $vk->sum('gagal');
            $vk_st = $vk->sum('st');

            $tanggal = Carbon::parse($request->input('dari'))->isoFormat('DD MMMM YYYY') . ' - ' . Carbon::parse($request->input('sampai'))->isoFormat('DD MMMM YYYY');

            return Excel::download(new ExportCuciTangan(
                $cssu_sbl_kon_psn,
                $cssu_sbl_tin_aseptik,
                $cssu_stl_kon_cairan,
                $cssu_stl_kon_psn,
                $cssu_stl_kon_ling_psn,
                $cssu_hr,
                $cssu_hw,
                $cssu_gagal,
                $cssu_st,

                $dapur_sbl_kon_psn,
                $dapur_sbl_tin_aseptik,
                $dapur_stl_kon_cairan,
                $dapur_stl_kon_psn,
                $dapur_stl_kon_ling_psn,
                $dapur_hr,
                $dapur_hw,
                $dapur_gagal,
                $dapur_st,

                $dpjp_sbl_kon_psn,
                $dpjp_sbl_tin_aseptik,
                $dpjp_stl_kon_cairan,
                $dpjp_stl_kon_psn,
                $dpjp_stl_kon_ling_psn,
                $dpjp_hr,
                $dpjp_hw,
                $dpjp_gagal,
                $dpjp_st,

                $farmasi_sbl_kon_psn,
                $farmasi_sbl_tin_aseptik,
                $farmasi_stl_kon_cairan,
                $farmasi_stl_kon_psn,
                $farmasi_stl_kon_ling_psn,
                $farmasi_hr,
                $farmasi_hw,
                $farmasi_gagal,
                $farmasi_st,

                $igd_sbl_kon_psn,
                $igd_sbl_tin_aseptik,
                $igd_stl_kon_cairan,
                $igd_stl_kon_psn,
                $igd_stl_kon_ling_psn,
                $igd_hr,
                $igd_hw,
                $igd_gagal,
                $igd_st,

                $int_sbl_kon_psn,
                $int_sbl_tin_aseptik,
                $int_stl_kon_cairan,
                $int_stl_kon_psn,
                $int_stl_kon_ling_psn,
                $int_hr,
                $int_hw,
                $int_gagal,
                $int_st,

                $kebersihan_sbl_kon_psn,
                $kebersihan_sbl_tin_aseptik,
                $kebersihan_stl_kon_cairan,
                $kebersihan_stl_kon_psn,
                $kebersihan_stl_kon_ling_psn,
                $kebersihan_hr,
                $kebersihan_hw,
                $kebersihan_gagal,
                $kebersihan_st,

                $kbbl_sbl_kon_psn,
                $kbbl_sbl_tin_aseptik,
                $kbbl_stl_kon_cairan,
                $kbbl_stl_kon_psn,
                $kbbl_stl_kon_ling_psn,
                $kbbl_hr,
                $kbbl_hw,
                $kbbl_gagal,
                $kbbl_st,

                $lab_sbl_kon_psn,
                $lab_sbl_tin_aseptik,
                $lab_stl_kon_cairan,
                $lab_stl_kon_psn,
                $lab_stl_kon_ling_psn,
                $lab_hr,
                $lab_hw,
                $lab_gagal,
                $lab_st,

                $laundry_sbl_kon_psn,
                $laundry_sbl_tin_aseptik,
                $laundry_stl_kon_cairan,
                $laundry_stl_kon_psn,
                $laundry_stl_kon_ling_psn,
                $laundry_hr,
                $laundry_hw,
                $laundry_gagal,
                $laundry_st,

                $ok_sbl_kon_psn,
                $ok_sbl_tin_aseptik,
                $ok_stl_kon_cairan,
                $ok_stl_kon_psn,
                $ok_stl_kon_ling_psn,
                $ok_hr,
                $ok_hw,
                $ok_gagal,
                $ok_st,

                $lt2_sbl_kon_psn,
                $lt2_sbl_tin_aseptik,
                $lt2_stl_kon_cairan,
                $lt2_stl_kon_psn,
                $lt2_stl_kon_ling_psn,
                $lt2_hr,
                $lt2_hw,
                $lt2_gagal,
                $lt2_st,

                $lt4_sbl_kon_psn,
                $lt4_sbl_tin_aseptik,
                $lt4_stl_kon_cairan,
                $lt4_stl_kon_psn,
                $lt4_stl_kon_ling_psn,
                $lt4_hr,
                $lt4_hw,
                $lt4_gagal,
                $lt4_st,

                $lt5_sbl_kon_psn,
                $lt5_sbl_tin_aseptik,
                $lt5_stl_kon_cairan,
                $lt5_stl_kon_psn,
                $lt5_stl_kon_ling_psn,
                $lt5_hr,
                $lt5_hw,
                $lt5_gagal,
                $lt5_st,

                $poli_sbl_kon_psn,
                $poli_sbl_tin_aseptik,
                $poli_stl_kon_cairan,
                $poli_stl_kon_psn,
                $poli_stl_kon_ling_psn,
                $poli_hr,
                $poli_hw,
                $poli_gagal,
                $poli_st,

                $rad_sbl_kon_psn,
                $rad_sbl_tin_aseptik,
                $rad_stl_kon_cairan,
                $rad_stl_kon_psn,
                $rad_stl_kon_ling_psn,
                $rad_hr,
                $rad_hw,
                $rad_gagal,
                $rad_st,

                $vk_sbl_kon_psn,
                $vk_sbl_tin_aseptik,
                $vk_stl_kon_cairan,
                $vk_stl_kon_psn,
                $vk_stl_kon_ling_psn,
                $vk_hr,
                $vk_hw,
                $vk_gagal,
                $vk_st,

                $tabel,
                $rekap,
                $tanggal
            ), 'Rekap Cuci Tangan ' . $tanggal . '.pdf', \Maatwebsite\Excel\Excel::MPDF);
        } else {
            return Redirect::back()->withErrors(['msg' => 'Tanggal tidak boleh Lebih kecil dari sebelumnya']);
        }
    }
}
