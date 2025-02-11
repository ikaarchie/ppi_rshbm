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
        $cuci_tangan = CuciTangan::latest('id')->paginate(10);

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
        $dari = date_create($request->input('dari'));
        $sampai = date_create($request->input('sampai'));
        $diff  = date_diff($dari, $sampai);
        $range_tgl = $diff->d + 1;

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
            $cssu_jumlah = $cssu_sbl_kon_psn + $cssu_sbl_tin_aseptik + $cssu_stl_kon_cairan + $cssu_stl_kon_psn + $cssu_stl_kon_ling_psn;

            $no_cssu_sbl_kon_psn = $cssu->where('sbl_kon_psn', '0')->count();
            $no_cssu_sbl_tin_aseptik = $cssu->where('sbl_tin_aseptik', '0')->count();
            $no_cssu_stl_kon_cairan = $cssu->where('stl_kon_cairan', '0')->count();
            $no_cssu_stl_kon_psn = $cssu->where('stl_kon_psn', '0')->count();
            $no_cssu_stl_kon_ling_psn = $cssu->where('stl_kon_ling_psn', '0')->count();
            $no_cssu_hr = $cssu->where('hr', '0')->count();
            $no_cssu_hw = $cssu->where('hw', '0')->count();
            $no_cssu_gagal = $cssu->where('gagal', '0')->count();
            $no_cssu_st = $cssu->where('st', '0')->count();
            $no_cssu_jumlah = $no_cssu_sbl_kon_psn + $no_cssu_sbl_tin_aseptik + $no_cssu_stl_kon_cairan + $no_cssu_stl_kon_psn + $no_cssu_stl_kon_ling_psn;

            $denominator_cssu = $cssu_jumlah + $no_cssu_jumlah;

            $dapur_sbl_kon_psn = $dapur->where('sbl_kon_psn', '1')->count();
            $dapur_sbl_tin_aseptik = $dapur->where('sbl_tin_aseptik', '1')->count();
            $dapur_stl_kon_cairan = $dapur->where('stl_kon_cairan', '1')->count();
            $dapur_stl_kon_psn = $dapur->where('stl_kon_psn', '1')->count();
            $dapur_stl_kon_ling_psn = $dapur->where('stl_kon_ling_psn', '1')->count();
            $dapur_hr = $dapur->where('hr', '1')->count();
            $dapur_hw = $dapur->where('hw', '1')->count();
            $dapur_gagal = $dapur->where('gagal', '1')->count();
            $dapur_st = $dapur->where('st', '1')->count();
            $dapur_jumlah = $dapur_sbl_kon_psn + $dapur_sbl_tin_aseptik + $dapur_stl_kon_cairan + $dapur_stl_kon_psn + $dapur_stl_kon_ling_psn;

            $no_dapur_sbl_kon_psn = $dapur->where('sbl_kon_psn', '0')->count();
            $no_dapur_sbl_tin_aseptik = $dapur->where('sbl_tin_aseptik', '0')->count();
            $no_dapur_stl_kon_cairan = $dapur->where('stl_kon_cairan', '0')->count();
            $no_dapur_stl_kon_psn = $dapur->where('stl_kon_psn', '0')->count();
            $no_dapur_stl_kon_ling_psn = $dapur->where('stl_kon_ling_psn', '0')->count();
            $no_dapur_hr = $dapur->where('hr', '0')->count();
            $no_dapur_hw = $dapur->where('hw', '0')->count();
            $no_dapur_gagal = $dapur->where('gagal', '0')->count();
            $no_dapur_st = $dapur->where('st', '0')->count();
            $no_dapur_jumlah = $no_dapur_sbl_kon_psn + $no_dapur_sbl_tin_aseptik + $no_dapur_stl_kon_cairan + $no_dapur_stl_kon_psn + $no_dapur_stl_kon_ling_psn;

            $denominator_dapur = $dapur_jumlah + $no_dapur_jumlah;

            $dpjp_sbl_kon_psn = $dpjp->where('sbl_kon_psn', '1')->count();
            $dpjp_sbl_tin_aseptik = $dpjp->where('sbl_tin_aseptik', '1')->count();
            $dpjp_stl_kon_cairan = $dpjp->where('stl_kon_cairan', '1')->count();
            $dpjp_stl_kon_psn = $dpjp->where('stl_kon_psn', '1')->count();
            $dpjp_stl_kon_ling_psn = $dpjp->where('stl_kon_ling_psn', '1')->count();
            $dpjp_hr = $dpjp->where('hr', '1')->count();
            $dpjp_hw = $dpjp->where('hw', '1')->count();
            $dpjp_gagal = $dpjp->where('gagal', '1')->count();
            $dpjp_st = $dpjp->where('st', '1')->count();
            $dpjp_jumlah = $dpjp_sbl_kon_psn + $dpjp_sbl_tin_aseptik + $dpjp_stl_kon_cairan + $dpjp_stl_kon_psn + $dpjp_stl_kon_ling_psn;

            $no_dpjp_sbl_kon_psn = $dpjp->where('sbl_kon_psn', '0')->count();
            $no_dpjp_sbl_tin_aseptik = $dpjp->where('sbl_tin_aseptik', '0')->count();
            $no_dpjp_stl_kon_cairan = $dpjp->where('stl_kon_cairan', '0')->count();
            $no_dpjp_stl_kon_psn = $dpjp->where('stl_kon_psn', '0')->count();
            $no_dpjp_stl_kon_ling_psn = $dpjp->where('stl_kon_ling_psn', '0')->count();
            $no_dpjp_hr = $dpjp->where('hr', '0')->count();
            $no_dpjp_hw = $dpjp->where('hw', '0')->count();
            $no_dpjp_gagal = $dpjp->where('gagal', '0')->count();
            $no_dpjp_st = $dpjp->where('st', '0')->count();
            $no_dpjp_jumlah = $no_dpjp_sbl_kon_psn + $no_dpjp_sbl_tin_aseptik + $no_dpjp_stl_kon_cairan + $no_dpjp_stl_kon_psn + $no_dpjp_stl_kon_ling_psn;

            $denominator_dpjp = $dpjp_jumlah + $no_dpjp_jumlah;

            $farmasi_sbl_kon_psn = $farmasi->where('sbl_kon_psn', '1')->count();
            $farmasi_sbl_tin_aseptik = $farmasi->where('sbl_tin_aseptik', '1')->count();
            $farmasi_stl_kon_cairan = $farmasi->where('stl_kon_cairan', '1')->count();
            $farmasi_stl_kon_psn = $farmasi->where('stl_kon_psn', '1')->count();
            $farmasi_stl_kon_ling_psn = $farmasi->where('stl_kon_ling_psn', '1')->count();
            $farmasi_hr = $farmasi->where('hr', '1')->count();
            $farmasi_hw = $farmasi->where('hw', '1')->count();
            $farmasi_gagal = $farmasi->where('gagal', '1')->count();
            $farmasi_st = $farmasi->where('st', '1')->count();
            $farmasi_jumlah = $farmasi_sbl_kon_psn + $farmasi_sbl_tin_aseptik + $farmasi_stl_kon_cairan + $farmasi_stl_kon_psn + $farmasi_stl_kon_ling_psn;

            $no_farmasi_sbl_kon_psn = $farmasi->where('sbl_kon_psn', '0')->count();
            $no_farmasi_sbl_tin_aseptik = $farmasi->where('sbl_tin_aseptik', '0')->count();
            $no_farmasi_stl_kon_cairan = $farmasi->where('stl_kon_cairan', '0')->count();
            $no_farmasi_stl_kon_psn = $farmasi->where('stl_kon_psn', '0')->count();
            $no_farmasi_stl_kon_ling_psn = $farmasi->where('stl_kon_ling_psn', '0')->count();
            $no_farmasi_hr = $farmasi->where('hr', '0')->count();
            $no_farmasi_hw = $farmasi->where('hw', '0')->count();
            $no_farmasi_gagal = $farmasi->where('gagal', '0')->count();
            $no_farmasi_st = $farmasi->where('st', '0')->count();
            $no_farmasi_jumlah = $no_farmasi_sbl_kon_psn + $no_farmasi_sbl_tin_aseptik + $no_farmasi_stl_kon_cairan + $no_farmasi_stl_kon_psn + $no_farmasi_stl_kon_ling_psn;

            $denominator_farmasi = $farmasi_jumlah + $no_farmasi_jumlah;

            $igd_sbl_kon_psn = $igd->where('sbl_kon_psn', '1')->count();
            $igd_sbl_tin_aseptik = $igd->where('sbl_tin_aseptik', '1')->count();
            $igd_stl_kon_cairan = $igd->where('stl_kon_cairan', '1')->count();
            $igd_stl_kon_psn = $igd->where('stl_kon_psn', '1')->count();
            $igd_stl_kon_ling_psn = $igd->where('stl_kon_ling_psn', '1')->count();
            $igd_hr = $igd->where('hr', '1')->count();
            $igd_hw = $igd->where('hw', '1')->count();
            $igd_gagal = $igd->where('gagal', '1')->count();
            $igd_st = $igd->where('st', '1')->count();
            $igd_jumlah = $igd_sbl_kon_psn + $igd_sbl_tin_aseptik + $igd_stl_kon_cairan + $igd_stl_kon_psn + $igd_stl_kon_ling_psn;

            $no_igd_sbl_kon_psn = $igd->where('sbl_kon_psn', '0')->count();
            $no_igd_sbl_tin_aseptik = $igd->where('sbl_tin_aseptik', '0')->count();
            $no_igd_stl_kon_cairan = $igd->where('stl_kon_cairan', '0')->count();
            $no_igd_stl_kon_psn = $igd->where('stl_kon_psn', '0')->count();
            $no_igd_stl_kon_ling_psn = $igd->where('stl_kon_ling_psn', '0')->count();
            $no_igd_hr = $igd->where('hr', '0')->count();
            $no_igd_hw = $igd->where('hw', '0')->count();
            $no_igd_gagal = $igd->where('gagal', '0')->count();
            $no_igd_st = $igd->where('st', '0')->count();
            $no_igd_jumlah = $no_igd_sbl_kon_psn + $no_igd_sbl_tin_aseptik + $no_igd_stl_kon_cairan + $no_igd_stl_kon_psn + $no_igd_stl_kon_ling_psn;

            $denominator_igd = $igd_jumlah + $no_igd_jumlah;

            $int_sbl_kon_psn = $int->where('sbl_kon_psn', '1')->count();
            $int_sbl_tin_aseptik = $int->where('sbl_tin_aseptik', '1')->count();
            $int_stl_kon_cairan = $int->where('stl_kon_cairan', '1')->count();
            $int_stl_kon_psn = $int->where('stl_kon_psn', '1')->count();
            $int_stl_kon_ling_psn = $int->where('stl_kon_ling_psn', '1')->count();
            $int_hr = $int->where('hr', '1')->count();
            $int_hw = $int->where('hw', '1')->count();
            $int_gagal = $int->where('gagal', '1')->count();
            $int_st = $int->where('st', '1')->count();
            $int_jumlah = $int_sbl_kon_psn + $int_sbl_tin_aseptik + $int_stl_kon_cairan + $int_stl_kon_psn + $int_stl_kon_ling_psn;

            $no_int_sbl_kon_psn = $int->where('sbl_kon_psn', '0')->count();
            $no_int_sbl_tin_aseptik = $int->where('sbl_tin_aseptik', '0')->count();
            $no_int_stl_kon_cairan = $int->where('stl_kon_cairan', '0')->count();
            $no_int_stl_kon_psn = $int->where('stl_kon_psn', '0')->count();
            $no_int_stl_kon_ling_psn = $int->where('stl_kon_ling_psn', '0')->count();
            $no_int_hr = $int->where('hr', '0')->count();
            $no_int_hw = $int->where('hw', '0')->count();
            $no_int_gagal = $int->where('gagal', '0')->count();
            $no_int_st = $int->where('st', '0')->count();
            $no_int_jumlah = $no_int_sbl_kon_psn + $no_int_sbl_tin_aseptik + $no_int_stl_kon_cairan + $no_int_stl_kon_psn + $no_int_stl_kon_ling_psn;

            $denominator_int = $int_jumlah + $no_int_jumlah;

            $kebersihan_sbl_kon_psn = $kebersihan->where('sbl_kon_psn', '1')->count();
            $kebersihan_sbl_tin_aseptik = $kebersihan->where('sbl_tin_aseptik', '1')->count();
            $kebersihan_stl_kon_cairan = $kebersihan->where('stl_kon_cairan', '1')->count();
            $kebersihan_stl_kon_psn = $kebersihan->where('stl_kon_psn', '1')->count();
            $kebersihan_stl_kon_ling_psn = $kebersihan->where('stl_kon_ling_psn', '1')->count();
            $kebersihan_hr = $kebersihan->where('hr', '1')->count();
            $kebersihan_hw = $kebersihan->where('hw', '1')->count();
            $kebersihan_gagal = $kebersihan->where('gagal', '1')->count();
            $kebersihan_st = $kebersihan->where('st', '1')->count();
            $kebersihan_jumlah = $kebersihan_sbl_kon_psn + $kebersihan_sbl_tin_aseptik + $kebersihan_stl_kon_cairan + $kebersihan_stl_kon_psn + $kebersihan_stl_kon_ling_psn;

            $no_kebersihan_sbl_kon_psn = $kebersihan->where('sbl_kon_psn', '0')->count();
            $no_kebersihan_sbl_tin_aseptik = $kebersihan->where('sbl_tin_aseptik', '0')->count();
            $no_kebersihan_stl_kon_cairan = $kebersihan->where('stl_kon_cairan', '0')->count();
            $no_kebersihan_stl_kon_psn = $kebersihan->where('stl_kon_psn', '0')->count();
            $no_kebersihan_stl_kon_ling_psn = $kebersihan->where('stl_kon_ling_psn', '0')->count();
            $no_kebersihan_hr = $kebersihan->where('hr', '0')->count();
            $no_kebersihan_hw = $kebersihan->where('hw', '0')->count();
            $no_kebersihan_gagal = $kebersihan->where('gagal', '0')->count();
            $no_kebersihan_st = $kebersihan->where('st', '0')->count();
            $no_kebersihan_jumlah = $no_kebersihan_sbl_kon_psn + $no_kebersihan_sbl_tin_aseptik + $no_kebersihan_stl_kon_cairan + $no_kebersihan_stl_kon_psn + $no_kebersihan_stl_kon_ling_psn;

            $denominator_kebersihan = $kebersihan_jumlah + $no_kebersihan_jumlah;

            $kbbl_sbl_kon_psn = $kbbl->where('sbl_kon_psn', '1')->count();
            $kbbl_sbl_tin_aseptik = $kbbl->where('sbl_tin_aseptik', '1')->count();
            $kbbl_stl_kon_cairan = $kbbl->where('stl_kon_cairan', '1')->count();
            $kbbl_stl_kon_psn = $kbbl->where('stl_kon_psn', '1')->count();
            $kbbl_stl_kon_ling_psn = $kbbl->where('stl_kon_ling_psn', '1')->count();
            $kbbl_hr = $kbbl->where('hr', '1')->count();
            $kbbl_hw = $kbbl->where('hw', '1')->count();
            $kbbl_gagal = $kbbl->where('gagal', '1')->count();
            $kbbl_st = $kbbl->where('st', '1')->count();
            $kbbl_jumlah = $kbbl_sbl_kon_psn + $kbbl_sbl_tin_aseptik + $kbbl_stl_kon_cairan + $kbbl_stl_kon_psn + $kbbl_stl_kon_ling_psn;

            $no_kbbl_sbl_kon_psn = $kbbl->where('sbl_kon_psn', '0')->count();
            $no_kbbl_sbl_tin_aseptik = $kbbl->where('sbl_tin_aseptik', '0')->count();
            $no_kbbl_stl_kon_cairan = $kbbl->where('stl_kon_cairan', '0')->count();
            $no_kbbl_stl_kon_psn = $kbbl->where('stl_kon_psn', '0')->count();
            $no_kbbl_stl_kon_ling_psn = $kbbl->where('stl_kon_ling_psn', '0')->count();
            $no_kbbl_hr = $kbbl->where('hr', '0')->count();
            $no_kbbl_hw = $kbbl->where('hw', '0')->count();
            $no_kbbl_gagal = $kbbl->where('gagal', '0')->count();
            $no_kbbl_st = $kbbl->where('st', '0')->count();
            $no_kbbl_jumlah = $no_kbbl_sbl_kon_psn + $no_kbbl_sbl_tin_aseptik + $no_kbbl_stl_kon_cairan + $no_kbbl_stl_kon_psn + $no_kbbl_stl_kon_ling_psn;

            $denominator_kbbl = $kbbl_jumlah + $no_kbbl_jumlah;

            $lab_sbl_kon_psn = $lab->where('sbl_kon_psn', '1')->count();
            $lab_sbl_tin_aseptik = $lab->where('sbl_tin_aseptik', '1')->count();
            $lab_stl_kon_cairan = $lab->where('stl_kon_cairan', '1')->count();
            $lab_stl_kon_psn = $lab->where('stl_kon_psn', '1')->count();
            $lab_stl_kon_ling_psn = $lab->where('stl_kon_ling_psn', '1')->count();
            $lab_hr = $lab->where('hr', '1')->count();
            $lab_hw = $lab->where('hw', '1')->count();
            $lab_gagal = $lab->where('gagal', '1')->count();
            $lab_st = $lab->where('st', '1')->count();
            $lab_jumlah = $lab_sbl_kon_psn + $lab_sbl_tin_aseptik + $lab_stl_kon_cairan + $lab_stl_kon_psn + $lab_stl_kon_ling_psn;

            $no_lab_sbl_kon_psn = $lab->where('sbl_kon_psn', '0')->count();
            $no_lab_sbl_tin_aseptik = $lab->where('sbl_tin_aseptik', '0')->count();
            $no_lab_stl_kon_cairan = $lab->where('stl_kon_cairan', '0')->count();
            $no_lab_stl_kon_psn = $lab->where('stl_kon_psn', '0')->count();
            $no_lab_stl_kon_ling_psn = $lab->where('stl_kon_ling_psn', '0')->count();
            $no_lab_hr = $lab->where('hr', '0')->count();
            $no_lab_hw = $lab->where('hw', '0')->count();
            $no_lab_gagal = $lab->where('gagal', '0')->count();
            $no_lab_st = $lab->where('st', '0')->count();
            $no_lab_jumlah = $no_lab_sbl_kon_psn + $no_lab_sbl_tin_aseptik + $no_lab_stl_kon_cairan + $no_lab_stl_kon_psn + $no_lab_stl_kon_ling_psn;

            $denominator_lab = $lab_jumlah + $no_lab_jumlah;

            $laundry_sbl_kon_psn = $laundry->where('sbl_kon_psn', '1')->count();
            $laundry_sbl_tin_aseptik = $laundry->where('sbl_tin_aseptik', '1')->count();
            $laundry_stl_kon_cairan = $laundry->where('stl_kon_cairan', '1')->count();
            $laundry_stl_kon_psn = $laundry->where('stl_kon_psn', '1')->count();
            $laundry_stl_kon_ling_psn = $laundry->where('stl_kon_ling_psn', '1')->count();
            $laundry_hr = $laundry->where('hr', '1')->count();
            $laundry_hw = $laundry->where('hw', '1')->count();
            $laundry_gagal = $laundry->where('gagal', '1')->count();
            $laundry_st = $laundry->where('st', '1')->count();
            $laundry_jumlah = $laundry_sbl_kon_psn + $laundry_sbl_tin_aseptik + $laundry_stl_kon_cairan + $laundry_stl_kon_psn + $laundry_stl_kon_ling_psn;

            $no_laundry_sbl_kon_psn = $laundry->where('sbl_kon_psn', '0')->count();
            $no_laundry_sbl_tin_aseptik = $laundry->where('sbl_tin_aseptik', '0')->count();
            $no_laundry_stl_kon_cairan = $laundry->where('stl_kon_cairan', '0')->count();
            $no_laundry_stl_kon_psn = $laundry->where('stl_kon_psn', '0')->count();
            $no_laundry_stl_kon_ling_psn = $laundry->where('stl_kon_ling_psn', '0')->count();
            $no_laundry_hr = $laundry->where('hr', '0')->count();
            $no_laundry_hw = $laundry->where('hw', '0')->count();
            $no_laundry_gagal = $laundry->where('gagal', '0')->count();
            $no_laundry_st = $laundry->where('st', '0')->count();
            $no_laundry_jumlah = $no_laundry_sbl_kon_psn + $no_laundry_sbl_tin_aseptik + $no_laundry_stl_kon_cairan + $no_laundry_stl_kon_psn + $no_laundry_stl_kon_ling_psn;

            $denominator_laundry = $laundry_jumlah + $no_laundry_jumlah;

            $ok_sbl_kon_psn = $ok->where('sbl_kon_psn', '1')->count();
            $ok_sbl_tin_aseptik = $ok->where('sbl_tin_aseptik', '1')->count();
            $ok_stl_kon_cairan = $ok->where('stl_kon_cairan', '1')->count();
            $ok_stl_kon_psn = $ok->where('stl_kon_psn', '1')->count();
            $ok_stl_kon_ling_psn = $ok->where('stl_kon_ling_psn', '1')->count();
            $ok_hr = $ok->where('hr', '1')->count();
            $ok_hw = $ok->where('hw', '1')->count();
            $ok_gagal = $ok->where('gagal', '1')->count();
            $ok_st = $ok->where('st', '1')->count();
            $ok_jumlah = $ok_sbl_kon_psn + $ok_sbl_tin_aseptik + $ok_stl_kon_cairan + $ok_stl_kon_psn + $ok_stl_kon_ling_psn;

            $no_ok_sbl_kon_psn = $ok->where('sbl_kon_psn', '0')->count();
            $no_ok_sbl_tin_aseptik = $ok->where('sbl_tin_aseptik', '0')->count();
            $no_ok_stl_kon_cairan = $ok->where('stl_kon_cairan', '0')->count();
            $no_ok_stl_kon_psn = $ok->where('stl_kon_psn', '0')->count();
            $no_ok_stl_kon_ling_psn = $ok->where('stl_kon_ling_psn', '0')->count();
            $no_ok_hr = $ok->where('hr', '0')->count();
            $no_ok_hw = $ok->where('hw', '0')->count();
            $no_ok_gagal = $ok->where('gagal', '0')->count();
            $no_ok_st = $ok->where('st', '0')->count();
            $no_ok_jumlah = $no_ok_sbl_kon_psn + $no_ok_sbl_tin_aseptik + $no_ok_stl_kon_cairan + $no_ok_stl_kon_psn + $no_ok_stl_kon_ling_psn;

            $denominator_ok = $ok_jumlah + $no_ok_jumlah;

            $lt2_sbl_kon_psn = $lt2->where('sbl_kon_psn', '1')->count();
            $lt2_sbl_tin_aseptik = $lt2->where('sbl_tin_aseptik', '1')->count();
            $lt2_stl_kon_cairan = $lt2->where('stl_kon_cairan', '1')->count();
            $lt2_stl_kon_psn = $lt2->where('stl_kon_psn', '1')->count();
            $lt2_stl_kon_ling_psn = $lt2->where('stl_kon_ling_psn', '1')->count();
            $lt2_hr = $lt2->where('hr', '1')->count();
            $lt2_hw = $lt2->where('hw', '1')->count();
            $lt2_gagal = $lt2->where('gagal', '1')->count();
            $lt2_st = $lt2->where('st', '1')->count();
            $lt2_jumlah = $lt2_sbl_kon_psn + $lt2_sbl_tin_aseptik + $lt2_stl_kon_cairan + $lt2_stl_kon_psn + $lt2_stl_kon_ling_psn;

            $no_lt2_sbl_kon_psn = $lt2->where('sbl_kon_psn', '0')->count();
            $no_lt2_sbl_tin_aseptik = $lt2->where('sbl_tin_aseptik', '0')->count();
            $no_lt2_stl_kon_cairan = $lt2->where('stl_kon_cairan', '0')->count();
            $no_lt2_stl_kon_psn = $lt2->where('stl_kon_psn', '0')->count();
            $no_lt2_stl_kon_ling_psn = $lt2->where('stl_kon_ling_psn', '0')->count();
            $no_lt2_hr = $lt2->where('hr', '0')->count();
            $no_lt2_hw = $lt2->where('hw', '0')->count();
            $no_lt2_gagal = $lt2->where('gagal', '0')->count();
            $no_lt2_st = $lt2->where('st', '0')->count();
            $no_lt2_jumlah = $no_lt2_sbl_kon_psn + $no_lt2_sbl_tin_aseptik + $no_lt2_stl_kon_cairan + $no_lt2_stl_kon_psn + $no_lt2_stl_kon_ling_psn;

            $denominator_lt2 = $lt2_jumlah + $no_lt2_jumlah;

            $lt4_sbl_kon_psn = $lt4->where('sbl_kon_psn', '1')->count();
            $lt4_sbl_tin_aseptik = $lt4->where('sbl_tin_aseptik', '1')->count();
            $lt4_stl_kon_cairan = $lt4->where('stl_kon_cairan', '1')->count();
            $lt4_stl_kon_psn = $lt4->where('stl_kon_psn', '1')->count();
            $lt4_stl_kon_ling_psn = $lt4->where('stl_kon_ling_psn', '1')->count();
            $lt4_hr = $lt4->where('hr', '1')->count();
            $lt4_hw = $lt4->where('hw', '1')->count();
            $lt4_gagal = $lt4->where('gagal', '1')->count();
            $lt4_st = $lt4->where('st', '1')->count();
            $lt4_jumlah = $lt4_sbl_kon_psn + $lt4_sbl_tin_aseptik + $lt4_stl_kon_cairan + $lt4_stl_kon_psn + $lt4_stl_kon_ling_psn;

            $no_lt4_sbl_kon_psn = $lt4->where('sbl_kon_psn', '0')->count();
            $no_lt4_sbl_tin_aseptik = $lt4->where('sbl_tin_aseptik', '0')->count();
            $no_lt4_stl_kon_cairan = $lt4->where('stl_kon_cairan', '0')->count();
            $no_lt4_stl_kon_psn = $lt4->where('stl_kon_psn', '0')->count();
            $no_lt4_stl_kon_ling_psn = $lt4->where('stl_kon_ling_psn', '0')->count();
            $no_lt4_hr = $lt4->where('hr', '0')->count();
            $no_lt4_hw = $lt4->where('hw', '0')->count();
            $no_lt4_gagal = $lt4->where('gagal', '0')->count();
            $no_lt4_st = $lt4->where('st', '0')->count();
            $no_lt4_jumlah = $no_lt4_sbl_kon_psn + $no_lt4_sbl_tin_aseptik + $no_lt4_stl_kon_cairan + $no_lt4_stl_kon_psn + $no_lt4_stl_kon_ling_psn;

            $denominator_lt4 = $lt4_jumlah + $no_lt4_jumlah;

            $lt5_sbl_kon_psn = $lt5->where('sbl_kon_psn', '1')->count();
            $lt5_sbl_tin_aseptik = $lt5->where('sbl_tin_aseptik', '1')->count();
            $lt5_stl_kon_cairan = $lt5->where('stl_kon_cairan', '1')->count();
            $lt5_stl_kon_psn = $lt5->where('stl_kon_psn', '1')->count();
            $lt5_stl_kon_ling_psn = $lt5->where('stl_kon_ling_psn', '1')->count();
            $lt5_hr = $lt5->where('hr', '1')->count();
            $lt5_hw = $lt5->where('hw', '1')->count();
            $lt5_gagal = $lt5->where('gagal', '1')->count();
            $lt5_st = $lt5->where('st', '1')->count();
            $lt5_jumlah = $lt5_sbl_kon_psn + $lt5_sbl_tin_aseptik + $lt5_stl_kon_cairan + $lt5_stl_kon_psn + $lt5_stl_kon_ling_psn;

            $no_lt5_sbl_kon_psn = $lt5->where('sbl_kon_psn', '0')->count();
            $no_lt5_sbl_tin_aseptik = $lt5->where('sbl_tin_aseptik', '0')->count();
            $no_lt5_stl_kon_cairan = $lt5->where('stl_kon_cairan', '0')->count();
            $no_lt5_stl_kon_psn = $lt5->where('stl_kon_psn', '0')->count();
            $no_lt5_stl_kon_ling_psn = $lt5->where('stl_kon_ling_psn', '0')->count();
            $no_lt5_hr = $lt5->where('hr', '0')->count();
            $no_lt5_hw = $lt5->where('hw', '0')->count();
            $no_lt5_gagal = $lt5->where('gagal', '0')->count();
            $no_lt5_st = $lt5->where('st', '0')->count();
            $no_lt5_jumlah = $no_lt5_sbl_kon_psn + $no_lt5_sbl_tin_aseptik + $no_lt5_stl_kon_cairan + $no_lt5_stl_kon_psn + $no_lt5_stl_kon_ling_psn;

            $denominator_lt5 = $lt5_jumlah + $no_lt5_jumlah;

            $poli_sbl_kon_psn = $poli->where('sbl_kon_psn', '1')->count();
            $poli_sbl_tin_aseptik = $poli->where('sbl_tin_aseptik', '1')->count();
            $poli_stl_kon_cairan = $poli->where('stl_kon_cairan', '1')->count();
            $poli_stl_kon_psn = $poli->where('stl_kon_psn', '1')->count();
            $poli_stl_kon_ling_psn = $poli->where('stl_kon_ling_psn', '1')->count();
            $poli_hr = $poli->where('hr', '1')->count();
            $poli_hw = $poli->where('hw', '1')->count();
            $poli_gagal = $poli->where('gagal', '1')->count();
            $poli_st = $poli->where('st', '1')->count();
            $poli_jumlah = $poli_sbl_kon_psn + $poli_sbl_tin_aseptik + $poli_stl_kon_cairan + $poli_stl_kon_psn + $poli_stl_kon_ling_psn;

            $no_poli_sbl_kon_psn = $poli->where('sbl_kon_psn', '0')->count();
            $no_poli_sbl_tin_aseptik = $poli->where('sbl_tin_aseptik', '0')->count();
            $no_poli_stl_kon_cairan = $poli->where('stl_kon_cairan', '0')->count();
            $no_poli_stl_kon_psn = $poli->where('stl_kon_psn', '0')->count();
            $no_poli_stl_kon_ling_psn = $poli->where('stl_kon_ling_psn', '0')->count();
            $no_poli_hr = $poli->where('hr', '0')->count();
            $no_poli_hw = $poli->where('hw', '0')->count();
            $no_poli_gagal = $poli->where('gagal', '0')->count();
            $no_poli_st = $poli->where('st', '0')->count();
            $no_poli_jumlah = $no_poli_sbl_kon_psn + $no_poli_sbl_tin_aseptik + $no_poli_stl_kon_cairan + $no_poli_stl_kon_psn + $no_poli_stl_kon_ling_psn;

            $denominator_poli = $poli_jumlah + $no_poli_jumlah;

            $rad_sbl_kon_psn = $rad->where('sbl_kon_psn', '1')->count();
            $rad_sbl_tin_aseptik = $rad->where('sbl_tin_aseptik', '1')->count();
            $rad_stl_kon_cairan = $rad->where('stl_kon_cairan', '1')->count();
            $rad_stl_kon_psn = $rad->where('stl_kon_psn', '1')->count();
            $rad_stl_kon_ling_psn = $rad->where('stl_kon_ling_psn', '1')->count();
            $rad_hr = $rad->where('hr', '1')->count();
            $rad_hw = $rad->where('hw', '1')->count();
            $rad_gagal = $rad->where('gagal', '1')->count();
            $rad_st = $rad->where('st', '1')->count();
            $rad_jumlah = $rad_sbl_kon_psn + $rad_sbl_tin_aseptik + $rad_stl_kon_cairan + $rad_stl_kon_psn + $rad_stl_kon_ling_psn;

            $no_rad_sbl_kon_psn = $rad->where('sbl_kon_psn', '0')->count();
            $no_rad_sbl_tin_aseptik = $rad->where('sbl_tin_aseptik', '0')->count();
            $no_rad_stl_kon_cairan = $rad->where('stl_kon_cairan', '0')->count();
            $no_rad_stl_kon_psn = $rad->where('stl_kon_psn', '0')->count();
            $no_rad_stl_kon_ling_psn = $rad->where('stl_kon_ling_psn', '0')->count();
            $no_rad_hr = $rad->where('hr', '0')->count();
            $no_rad_hw = $rad->where('hw', '0')->count();
            $no_rad_gagal = $rad->where('gagal', '0')->count();
            $no_rad_st = $rad->where('st', '0')->count();
            $no_rad_jumlah = $no_rad_sbl_kon_psn + $no_rad_sbl_tin_aseptik + $no_rad_stl_kon_cairan + $no_rad_stl_kon_psn + $no_rad_stl_kon_ling_psn;

            $denominator_rad = $rad_jumlah + $no_rad_jumlah;

            $vk_sbl_kon_psn = $vk->where('sbl_kon_psn', '1')->count();
            $vk_sbl_tin_aseptik = $vk->where('sbl_tin_aseptik', '1')->count();
            $vk_stl_kon_cairan = $vk->where('stl_kon_cairan', '1')->count();
            $vk_stl_kon_psn = $vk->where('stl_kon_psn', '1')->count();
            $vk_stl_kon_ling_psn = $vk->where('stl_kon_ling_psn', '1')->count();
            $vk_hr = $vk->where('hr', '1')->count();
            $vk_hw = $vk->where('hw', '1')->count();
            $vk_gagal = $vk->where('gagal', '1')->count();
            $vk_st = $vk->where('st', '1')->count();
            $vk_jumlah = $vk_sbl_kon_psn + $vk_sbl_tin_aseptik + $vk_stl_kon_cairan + $vk_stl_kon_psn + $vk_stl_kon_ling_psn;

            $no_vk_sbl_kon_psn = $vk->where('sbl_kon_psn', '0')->count();
            $no_vk_sbl_tin_aseptik = $vk->where('sbl_tin_aseptik', '0')->count();
            $no_vk_stl_kon_cairan = $vk->where('stl_kon_cairan', '0')->count();
            $no_vk_stl_kon_psn = $vk->where('stl_kon_psn', '0')->count();
            $no_vk_stl_kon_ling_psn = $vk->where('stl_kon_ling_psn', '0')->count();
            $no_vk_hr = $vk->where('hr', '0')->count();
            $no_vk_hw = $vk->where('hw', '0')->count();
            $no_vk_gagal = $vk->where('gagal', '0')->count();
            $no_vk_st = $vk->where('st', '0')->count();
            $no_vk_jumlah = $no_vk_sbl_kon_psn + $no_vk_sbl_tin_aseptik + $no_vk_stl_kon_cairan + $no_vk_stl_kon_psn + $no_vk_stl_kon_ling_psn;

            $denominator_vk = $vk_jumlah + $no_vk_jumlah;

            $jangmed_sbl_kon_psn = $cssu_sbl_kon_psn + $farmasi_sbl_kon_psn + $lab_sbl_kon_psn + $rad_sbl_kon_psn;
            $jangmed_sbl_tin_aseptik = $cssu_sbl_tin_aseptik + $farmasi_sbl_tin_aseptik + $lab_sbl_tin_aseptik + $rad_sbl_tin_aseptik;
            $jangmed_stl_kon_cairan = $cssu_stl_kon_cairan + $farmasi_stl_kon_cairan + $lab_stl_kon_cairan + $rad_stl_kon_cairan;
            $jangmed_stl_kon_psn = $cssu_stl_kon_psn + $farmasi_stl_kon_psn + $lab_stl_kon_psn + $rad_stl_kon_psn;
            $jangmed_stl_kon_ling_psn = $cssu_stl_kon_ling_psn + $farmasi_stl_kon_ling_psn + $lab_stl_kon_ling_psn + $rad_stl_kon_ling_psn;
            $jangmed_hr = $cssu_hr + $farmasi_hr + $lab_hr + $rad_hr;
            $jangmed_hw = $cssu_hw + $farmasi_hw + $lab_hw + $rad_hw;
            $jangmed_gagal = $cssu_gagal + $farmasi_gagal + $lab_gagal + $rad_gagal;
            $jangmed_st = $cssu_st + $farmasi_st + $lab_st + $rad_st;
            $jangmed_jumlah = $jangmed_sbl_kon_psn + $jangmed_sbl_tin_aseptik + $jangmed_stl_kon_cairan + $jangmed_stl_kon_psn + $jangmed_stl_kon_ling_psn;

            $no_jangmed_sbl_kon_psn = $no_cssu_sbl_kon_psn + $no_farmasi_sbl_kon_psn + $no_lab_sbl_kon_psn + $no_rad_sbl_kon_psn;
            $no_jangmed_sbl_tin_aseptik = $no_cssu_sbl_tin_aseptik + $no_farmasi_sbl_tin_aseptik + $no_lab_sbl_tin_aseptik + $no_rad_sbl_tin_aseptik;
            $no_jangmed_stl_kon_cairan = $no_cssu_stl_kon_cairan + $no_farmasi_stl_kon_cairan + $no_lab_stl_kon_cairan + $no_rad_stl_kon_cairan;
            $no_jangmed_stl_kon_psn = $no_cssu_stl_kon_psn + $no_farmasi_stl_kon_psn + $no_lab_stl_kon_psn + $no_rad_stl_kon_psn;
            $no_jangmed_stl_kon_ling_psn = $no_cssu_stl_kon_ling_psn + $no_farmasi_stl_kon_ling_psn + $no_lab_stl_kon_ling_psn + $no_rad_stl_kon_ling_psn;
            $no_jangmed_hr = $no_cssu_hr + $no_farmasi_hr + $no_lab_hr + $no_rad_hr;
            $no_jangmed_hw = $no_cssu_hw + $no_farmasi_hw + $no_lab_hw + $no_rad_hw;
            $no_jangmed_gagal = $no_cssu_gagal + $no_farmasi_gagal + $no_lab_gagal + $no_rad_gagal;
            $no_jangmed_st = $no_cssu_st + $no_farmasi_st + $no_lab_st + $no_rad_st;
            $no_jangmed_jumlah = $no_jangmed_sbl_kon_psn + $no_jangmed_sbl_tin_aseptik + $no_jangmed_stl_kon_cairan + $no_jangmed_stl_kon_psn + $no_jangmed_stl_kon_ling_psn;

            $denominator_jangmed = $jangmed_jumlah + $no_jangmed_jumlah;

            $jangum_sbl_kon_psn = $dapur_sbl_kon_psn + $kebersihan_sbl_kon_psn + $laundry_sbl_kon_psn;
            $jangum_sbl_tin_aseptik = $dapur_sbl_tin_aseptik + $kebersihan_sbl_tin_aseptik + $laundry_sbl_tin_aseptik;
            $jangum_stl_kon_cairan = $dapur_stl_kon_cairan + $kebersihan_stl_kon_cairan + $laundry_stl_kon_cairan;
            $jangum_stl_kon_psn = $dapur_stl_kon_psn + $kebersihan_stl_kon_psn + $laundry_stl_kon_psn;
            $jangum_stl_kon_ling_psn = $dapur_stl_kon_ling_psn + $kebersihan_stl_kon_ling_psn + $laundry_stl_kon_ling_psn;
            $jangum_hr = $dapur_hr + $kebersihan_hr + $laundry_hr;
            $jangum_hw = $dapur_hw + $kebersihan_hw + $laundry_hw;
            $jangum_gagal = $dapur_gagal + $kebersihan_gagal + $laundry_gagal;
            $jangum_st = $dapur_st + $kebersihan_st + $laundry_st;
            $jangum_jumlah = $jangum_sbl_kon_psn + $jangum_sbl_tin_aseptik + $jangum_stl_kon_cairan + $jangum_stl_kon_psn + $jangum_stl_kon_ling_psn;

            $no_jangum_sbl_kon_psn = $no_dapur_sbl_kon_psn + $no_kebersihan_sbl_kon_psn + $no_laundry_sbl_kon_psn;
            $no_jangum_sbl_tin_aseptik = $no_dapur_sbl_tin_aseptik + $no_kebersihan_sbl_tin_aseptik + $no_laundry_sbl_tin_aseptik;
            $no_jangum_stl_kon_cairan = $no_dapur_stl_kon_cairan + $no_kebersihan_stl_kon_cairan + $no_laundry_stl_kon_cairan;
            $no_jangum_stl_kon_psn = $no_dapur_stl_kon_psn + $no_kebersihan_stl_kon_psn + $no_laundry_stl_kon_psn;
            $no_jangum_stl_kon_ling_psn = $no_dapur_stl_kon_ling_psn + $no_kebersihan_stl_kon_ling_psn + $no_laundry_stl_kon_ling_psn;
            $no_jangum_hr = $no_dapur_hr + $no_kebersihan_hr + $no_laundry_hr;
            $no_jangum_hw = $no_dapur_hw + $no_kebersihan_hw + $no_laundry_hw;
            $no_jangum_gagal = $no_dapur_gagal + $no_kebersihan_gagal + $no_laundry_gagal;
            $no_jangum_st = $no_dapur_st + $no_kebersihan_st + $no_laundry_st;
            $no_jangum_jumlah = $no_jangum_sbl_kon_psn + $no_jangum_sbl_tin_aseptik + $no_jangum_stl_kon_cairan + $no_jangum_stl_kon_psn + $no_jangum_stl_kon_ling_psn;

            $denominator_jangum = $jangum_jumlah + $no_jangum_jumlah;

            $keperawatan_sbl_kon_psn = $igd_sbl_kon_psn + $int_sbl_kon_psn + $kbbl_sbl_kon_psn + $ok_sbl_kon_psn + $lt2_sbl_kon_psn + $lt4_sbl_kon_psn + $lt5_sbl_kon_psn + $poli_sbl_kon_psn + $vk_sbl_kon_psn;
            $keperawatan_sbl_tin_aseptik = $igd_sbl_tin_aseptik + $int_sbl_tin_aseptik + $kbbl_sbl_tin_aseptik + $ok_sbl_tin_aseptik + $lt2_sbl_tin_aseptik + $lt4_sbl_tin_aseptik + $lt5_sbl_tin_aseptik + $poli_sbl_tin_aseptik + $vk_sbl_tin_aseptik;
            $keperawatan_stl_kon_cairan = $igd_stl_kon_cairan + $int_stl_kon_cairan + $kbbl_stl_kon_cairan + $ok_stl_kon_cairan + $lt2_stl_kon_cairan + $lt4_stl_kon_cairan + $lt5_stl_kon_cairan + $poli_stl_kon_cairan + $vk_stl_kon_cairan;
            $keperawatan_stl_kon_psn = $igd_stl_kon_psn + $int_stl_kon_psn + $kbbl_stl_kon_psn + $ok_stl_kon_psn + $lt2_stl_kon_psn + $lt4_stl_kon_psn + $lt5_stl_kon_psn + $poli_stl_kon_psn + $vk_stl_kon_psn;
            $keperawatan_stl_kon_ling_psn = $igd_stl_kon_ling_psn + $int_stl_kon_ling_psn + $kbbl_stl_kon_ling_psn + $ok_stl_kon_ling_psn + $lt2_stl_kon_ling_psn + $lt4_stl_kon_ling_psn + $lt5_stl_kon_ling_psn + $poli_stl_kon_ling_psn + $vk_stl_kon_ling_psn;
            $keperawatan_hr = $igd_hr + $int_hr + $kbbl_hr + $ok_hr + $lt2_hr + $lt4_hr + $lt5_hr + $poli_hr + $vk_hr;
            $keperawatan_hw = $igd_hw + $int_hw + $kbbl_hw + $ok_hw + $lt2_hw + $lt4_hw + $lt5_hw + $poli_hw + $vk_hw;
            $keperawatan_gagal = $igd_gagal + $int_gagal + $kbbl_gagal + $ok_gagal + $lt2_gagal + $lt4_gagal + $lt5_gagal + $poli_gagal + $vk_gagal;
            $keperawatan_st = $igd_st + $int_st + $kbbl_st + $ok_st + $lt2_st + $lt4_st + $lt5_st + $poli_st + $vk_st;
            $keperawatan_jumlah = $keperawatan_sbl_kon_psn + $keperawatan_sbl_tin_aseptik + $keperawatan_stl_kon_cairan + $keperawatan_stl_kon_psn + $keperawatan_stl_kon_ling_psn;

            $no_keperawatan_sbl_kon_psn = $no_igd_sbl_kon_psn + $no_int_sbl_kon_psn + $no_kbbl_sbl_kon_psn + $no_ok_sbl_kon_psn + $no_lt2_sbl_kon_psn + $no_lt4_sbl_kon_psn + $no_lt5_sbl_kon_psn + $no_poli_sbl_kon_psn + $no_vk_sbl_kon_psn;
            $no_keperawatan_sbl_tin_aseptik = $no_igd_sbl_tin_aseptik + $no_int_sbl_tin_aseptik + $no_kbbl_sbl_tin_aseptik + $no_ok_sbl_tin_aseptik + $no_lt2_sbl_tin_aseptik + $no_lt4_sbl_tin_aseptik + $no_lt5_sbl_tin_aseptik + $no_poli_sbl_tin_aseptik + $no_vk_sbl_tin_aseptik;
            $no_keperawatan_stl_kon_cairan = $no_igd_stl_kon_cairan + $no_int_stl_kon_cairan + $no_kbbl_stl_kon_cairan + $no_ok_stl_kon_cairan + $no_lt2_stl_kon_cairan + $no_lt4_stl_kon_cairan + $no_lt5_stl_kon_cairan + $no_poli_stl_kon_cairan + $no_vk_stl_kon_cairan;
            $no_keperawatan_stl_kon_psn = $no_igd_stl_kon_psn + $no_int_stl_kon_psn + $no_kbbl_stl_kon_psn + $no_ok_stl_kon_psn + $no_lt2_stl_kon_psn + $no_lt4_stl_kon_psn + $no_lt5_stl_kon_psn + $no_poli_stl_kon_psn + $no_vk_stl_kon_psn;
            $no_keperawatan_stl_kon_ling_psn = $no_igd_stl_kon_ling_psn + $no_int_stl_kon_ling_psn + $no_kbbl_stl_kon_ling_psn + $no_ok_stl_kon_ling_psn + $no_lt2_stl_kon_ling_psn + $no_lt4_stl_kon_ling_psn + $no_lt5_stl_kon_ling_psn + $no_poli_stl_kon_ling_psn + $no_vk_stl_kon_ling_psn;
            $no_keperawatan_hr = $no_igd_hr + $no_int_hr + $no_kbbl_hr + $no_ok_hr + $no_lt2_hr + $no_lt4_hr + $no_lt5_hr + $no_poli_hr + $no_vk_hr;
            $no_keperawatan_hw = $no_igd_hw + $no_int_hw + $no_kbbl_hw + $no_ok_hw + $no_lt2_hw + $no_lt4_hw + $no_lt5_hw + $no_poli_hw + $no_vk_hw;
            $no_keperawatan_gagal = $no_igd_gagal + $no_int_gagal + $no_kbbl_gagal + $no_ok_gagal + $no_lt2_gagal + $no_lt4_gagal + $no_lt5_gagal + $no_poli_gagal + $no_vk_gagal;
            $no_keperawatan_st = $no_igd_st + $no_int_st + $no_kbbl_st + $no_ok_st + $no_lt2_st + $no_lt4_st + $no_lt5_st + $no_poli_st + $no_vk_st;
            $no_keperawatan_jumlah = $no_keperawatan_sbl_kon_psn + $no_keperawatan_sbl_tin_aseptik + $no_keperawatan_stl_kon_cairan + $no_keperawatan_stl_kon_psn + $no_keperawatan_stl_kon_ling_psn;

            $denominator_keperawatan = $keperawatan_jumlah + $no_keperawatan_jumlah;

            $all_sbl_kon_psn = $cssu_sbl_kon_psn + $farmasi_sbl_kon_psn + $lab_sbl_kon_psn + $rad_sbl_kon_psn + $dapur_sbl_kon_psn + $kebersihan_sbl_kon_psn + $laundry_sbl_kon_psn + $igd_sbl_kon_psn + $int_sbl_kon_psn + $kbbl_sbl_kon_psn + $ok_sbl_kon_psn + $lt2_sbl_kon_psn + $lt4_sbl_kon_psn + $lt5_sbl_kon_psn + $poli_sbl_kon_psn + $vk_sbl_kon_psn + $dpjp_sbl_kon_psn;
            $all_sbl_tin_aseptik = $cssu_sbl_tin_aseptik + $farmasi_sbl_tin_aseptik + $lab_sbl_tin_aseptik + $rad_sbl_tin_aseptik + $dapur_sbl_tin_aseptik + $kebersihan_sbl_tin_aseptik + $laundry_sbl_tin_aseptik + $igd_sbl_tin_aseptik + $int_sbl_tin_aseptik + $kbbl_sbl_tin_aseptik + $ok_sbl_tin_aseptik + $lt2_sbl_tin_aseptik + $lt4_sbl_tin_aseptik + $lt5_sbl_tin_aseptik + $poli_sbl_tin_aseptik + $vk_sbl_tin_aseptik + $dpjp_sbl_tin_aseptik;
            $all_stl_kon_cairan = $cssu_stl_kon_cairan + $farmasi_stl_kon_cairan + $lab_stl_kon_cairan + $rad_stl_kon_cairan + $dapur_stl_kon_cairan + $kebersihan_stl_kon_cairan + $laundry_stl_kon_cairan + $igd_stl_kon_cairan + $int_stl_kon_cairan + $kbbl_stl_kon_cairan + $ok_stl_kon_cairan + $lt2_stl_kon_cairan + $lt4_stl_kon_cairan + $lt5_stl_kon_cairan + $poli_stl_kon_cairan + $vk_stl_kon_cairan + $dpjp_stl_kon_cairan;
            $all_stl_kon_psn = $cssu_stl_kon_psn + $farmasi_stl_kon_psn + $lab_stl_kon_psn + $rad_stl_kon_psn + $dapur_stl_kon_psn + $kebersihan_stl_kon_psn + $laundry_stl_kon_psn + $igd_stl_kon_psn + $int_stl_kon_psn + $kbbl_stl_kon_psn + $ok_stl_kon_psn + $lt2_stl_kon_psn + $lt4_stl_kon_psn + $lt5_stl_kon_psn + $poli_stl_kon_psn + $vk_stl_kon_psn + $dpjp_stl_kon_psn;
            $all_stl_kon_ling_psn = $cssu_stl_kon_ling_psn + $farmasi_stl_kon_ling_psn + $lab_stl_kon_ling_psn + $rad_stl_kon_ling_psn + $dapur_stl_kon_ling_psn + $kebersihan_stl_kon_ling_psn + $laundry_stl_kon_ling_psn + $igd_stl_kon_ling_psn + $int_stl_kon_ling_psn + $kbbl_stl_kon_ling_psn + $ok_stl_kon_ling_psn + $lt2_stl_kon_ling_psn + $lt4_stl_kon_ling_psn + $lt5_stl_kon_ling_psn + $poli_stl_kon_ling_psn + $vk_stl_kon_ling_psn + $dpjp_stl_kon_ling_psn;
            $all_hr = $cssu_hr + $farmasi_hr + $lab_hr + $rad_hr + $dapur_hr + $kebersihan_hr + $laundry_hr + $igd_hr + $int_hr + $kbbl_hr + $ok_hr + $lt2_hr + $lt4_hr + $lt5_hr + $poli_hr + $vk_hr + $dpjp_hr;
            $all_hw = $cssu_hw + $farmasi_hw + $lab_hw + $rad_hw + $dapur_hw + $kebersihan_hw + $laundry_hw + $igd_hw + $int_hw + $kbbl_hw + $ok_hw + $lt2_hw + $lt4_hw + $lt5_hw + $poli_hw + $vk_hw + $dpjp_hw;
            $all_gagal = $cssu_gagal + $farmasi_gagal + $lab_gagal + $rad_gagal + $dapur_gagal + $kebersihan_gagal + $laundry_gagal + $igd_gagal + $int_gagal + $kbbl_gagal + $ok_gagal + $lt2_gagal + $lt4_gagal + $lt5_gagal + $poli_gagal + $vk_gagal + $dpjp_gagal;
            $all_st = $cssu_st + $farmasi_st + $lab_st + $rad_st + $dapur_st + $kebersihan_st + $laundry_st + $igd_st + $int_st + $kbbl_st + $ok_st + $lt2_st + $lt4_st + $lt5_st + $poli_st + $vk_st + $dpjp_st;
            $all_jumlah = $all_sbl_kon_psn + $all_sbl_tin_aseptik + $all_stl_kon_cairan + $all_stl_kon_psn + $all_stl_kon_ling_psn;

            $no_all_sbl_kon_psn = $no_cssu_sbl_kon_psn + $no_farmasi_sbl_kon_psn + $no_lab_sbl_kon_psn + $no_rad_sbl_kon_psn + $no_dapur_sbl_kon_psn + $no_kebersihan_sbl_kon_psn + $no_laundry_sbl_kon_psn + $no_igd_sbl_kon_psn + $no_int_sbl_kon_psn + $no_kbbl_sbl_kon_psn + $no_ok_sbl_kon_psn + $no_lt2_sbl_kon_psn + $no_lt4_sbl_kon_psn + $no_lt5_sbl_kon_psn + $no_poli_sbl_kon_psn + $no_vk_sbl_kon_psn + $no_dpjp_sbl_kon_psn;
            $no_all_sbl_tin_aseptik = $no_cssu_sbl_tin_aseptik + $no_farmasi_sbl_tin_aseptik + $no_lab_sbl_tin_aseptik + $no_rad_sbl_tin_aseptik + $no_dapur_sbl_tin_aseptik + $no_kebersihan_sbl_tin_aseptik + $no_laundry_sbl_tin_aseptik + $no_igd_sbl_tin_aseptik + $no_int_sbl_tin_aseptik + $no_kbbl_sbl_tin_aseptik + $no_ok_sbl_tin_aseptik + $no_lt2_sbl_tin_aseptik + $no_lt4_sbl_tin_aseptik + $no_lt5_sbl_tin_aseptik + $no_poli_sbl_tin_aseptik + $no_vk_sbl_tin_aseptik + $no_dpjp_sbl_tin_aseptik;
            $no_all_stl_kon_cairan = $no_cssu_stl_kon_cairan + $no_farmasi_stl_kon_cairan + $no_lab_stl_kon_cairan + $no_rad_stl_kon_cairan + $no_dapur_stl_kon_cairan + $no_kebersihan_stl_kon_cairan + $no_laundry_stl_kon_cairan + $no_igd_stl_kon_cairan + $no_int_stl_kon_cairan + $no_kbbl_stl_kon_cairan + $no_ok_stl_kon_cairan + $no_lt2_stl_kon_cairan + $no_lt4_stl_kon_cairan + $no_lt5_stl_kon_cairan + $no_poli_stl_kon_cairan + $no_vk_stl_kon_cairan + $no_dpjp_stl_kon_cairan;
            $no_all_stl_kon_psn = $no_cssu_stl_kon_psn + $no_farmasi_stl_kon_psn + $no_lab_stl_kon_psn + $no_rad_stl_kon_psn + $no_dapur_stl_kon_psn + $no_kebersihan_stl_kon_psn + $no_laundry_stl_kon_psn + $no_igd_stl_kon_psn + $no_int_stl_kon_psn + $no_kbbl_stl_kon_psn + $no_ok_stl_kon_psn + $no_lt2_stl_kon_psn + $no_lt4_stl_kon_psn + $no_lt5_stl_kon_psn + $no_poli_stl_kon_psn + $no_vk_stl_kon_psn + $no_dpjp_stl_kon_psn;
            $no_all_stl_kon_ling_psn = $no_cssu_stl_kon_ling_psn + $no_farmasi_stl_kon_ling_psn + $no_lab_stl_kon_ling_psn + $no_rad_stl_kon_ling_psn + $no_dapur_stl_kon_ling_psn + $no_kebersihan_stl_kon_ling_psn + $no_laundry_stl_kon_ling_psn + $no_igd_stl_kon_ling_psn + $no_int_stl_kon_ling_psn + $no_kbbl_stl_kon_ling_psn + $no_ok_stl_kon_ling_psn + $no_lt2_stl_kon_ling_psn + $no_lt4_stl_kon_ling_psn + $no_lt5_stl_kon_ling_psn + $no_poli_stl_kon_ling_psn + $no_vk_stl_kon_ling_psn + $no_dpjp_stl_kon_ling_psn;
            $no_all_hr = $no_cssu_hr + $no_farmasi_hr + $no_lab_hr + $no_rad_hr + $no_dapur_hr + $no_kebersihan_hr + $no_laundry_hr + $no_igd_hr + $no_int_hr + $no_kbbl_hr + $no_ok_hr + $no_lt2_hr + $no_lt4_hr + $no_lt5_hr + $no_poli_hr + $no_vk_hr + $no_dpjp_hr;
            $no_all_hw = $no_cssu_hw + $no_farmasi_hw + $no_lab_hw + $no_rad_hw + $no_dapur_hw + $no_kebersihan_hw + $no_laundry_hw + $no_igd_hw + $no_int_hw + $no_kbbl_hw + $no_ok_hw + $no_lt2_hw + $no_lt4_hw + $no_lt5_hw + $no_poli_hw + $no_vk_hw + $no_dpjp_hw;
            $no_all_gagal = $no_cssu_gagal + $no_farmasi_gagal + $no_lab_gagal + $no_rad_gagal + $no_dapur_gagal + $no_kebersihan_gagal + $no_laundry_gagal + $no_igd_gagal + $no_int_gagal + $no_kbbl_gagal + $no_ok_gagal + $no_lt2_gagal + $no_lt4_gagal + $no_lt5_gagal + $no_poli_gagal + $no_vk_gagal + $no_dpjp_gagal;
            $no_all_st = $no_cssu_st + $no_farmasi_st + $no_lab_st + $no_rad_st + $no_dapur_st + $no_kebersihan_st + $no_laundry_st + $no_igd_st + $no_int_st + $no_kbbl_st + $no_ok_st + $no_lt2_st + $no_lt4_st + $no_lt5_st + $no_poli_st + $no_vk_st + $no_dpjp_st;
            $no_all_jumlah = $no_all_sbl_kon_psn + $no_all_sbl_tin_aseptik + $no_all_stl_kon_cairan + $no_all_stl_kon_psn + $no_all_stl_kon_ling_psn;

            $denominator_all = $all_jumlah + $no_all_jumlah;

            $denominator_sbl_kon_psn = $all_sbl_kon_psn + $no_all_sbl_kon_psn;
            $denominator_sbl_tin_aseptik = $all_sbl_tin_aseptik + $no_all_sbl_tin_aseptik;
            $denominator_stl_kon_cairan = $all_stl_kon_cairan + $no_all_stl_kon_cairan;
            $denominator_stl_kon_psn = $all_stl_kon_psn + $no_all_stl_kon_psn;
            $denominator_stl_kon_ling_psn = $all_stl_kon_ling_psn + $no_all_stl_kon_ling_psn;

            return view('rekapCuciTangan.index', compact(
                'range_tgl',
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

                'denominator_cssu',

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

                'denominator_dapur',

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

                'denominator_dpjp',

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

                'denominator_farmasi',

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

                'denominator_igd',

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

                'denominator_int',

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

                'denominator_kbbl',

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

                'denominator_lab',

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

                'denominator_laundry',

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

                'denominator_ok',

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

                'denominator_lt2',

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

                'denominator_lt4',

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

                'denominator_lt5',

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

                'denominator_poli',

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

                'denominator_rad',

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

                'denominator_vk',

                'jangmed_sbl_kon_psn',
                'jangmed_sbl_tin_aseptik',
                'jangmed_stl_kon_cairan',
                'jangmed_stl_kon_psn',
                'jangmed_stl_kon_ling_psn',
                'jangmed_hr',
                'jangmed_hw',
                'jangmed_gagal',
                'jangmed_st',
                'jangmed_jumlah',

                'no_jangmed_sbl_kon_psn',
                'no_jangmed_sbl_tin_aseptik',
                'no_jangmed_stl_kon_cairan',
                'no_jangmed_stl_kon_psn',
                'no_jangmed_stl_kon_ling_psn',
                'no_jangmed_hr',
                'no_jangmed_hw',
                'no_jangmed_gagal',
                'no_jangmed_st',
                'no_jangmed_jumlah',

                'denominator_jangmed',

                'jangum_sbl_kon_psn',
                'jangum_sbl_tin_aseptik',
                'jangum_stl_kon_cairan',
                'jangum_stl_kon_psn',
                'jangum_stl_kon_ling_psn',
                'jangum_hr',
                'jangum_hw',
                'jangum_gagal',
                'jangum_st',
                'jangum_jumlah',

                'no_jangum_sbl_kon_psn',
                'no_jangum_sbl_tin_aseptik',
                'no_jangum_stl_kon_cairan',
                'no_jangum_stl_kon_psn',
                'no_jangum_stl_kon_ling_psn',
                'no_jangum_hr',
                'no_jangum_hw',
                'no_jangum_gagal',
                'no_jangum_st',
                'no_jangum_jumlah',

                'denominator_jangum',

                'keperawatan_sbl_kon_psn',
                'keperawatan_sbl_tin_aseptik',
                'keperawatan_stl_kon_cairan',
                'keperawatan_stl_kon_psn',
                'keperawatan_stl_kon_ling_psn',
                'keperawatan_hr',
                'keperawatan_hw',
                'keperawatan_gagal',
                'keperawatan_st',
                'keperawatan_jumlah',

                'no_keperawatan_sbl_kon_psn',
                'no_keperawatan_sbl_tin_aseptik',
                'no_keperawatan_stl_kon_cairan',
                'no_keperawatan_stl_kon_psn',
                'no_keperawatan_stl_kon_ling_psn',
                'no_keperawatan_hr',
                'no_keperawatan_hw',
                'no_keperawatan_gagal',
                'no_keperawatan_st',
                'no_keperawatan_jumlah',

                'denominator_keperawatan',

                'all_sbl_kon_psn',
                'all_sbl_tin_aseptik',
                'all_stl_kon_cairan',
                'all_stl_kon_psn',
                'all_stl_kon_ling_psn',
                'all_hr',
                'all_hw',
                'all_gagal',
                'all_st',
                'all_jumlah',

                'no_all_sbl_kon_psn',
                'no_all_sbl_tin_aseptik',
                'no_all_stl_kon_cairan',
                'no_all_stl_kon_psn',
                'no_all_stl_kon_ling_psn',
                'no_all_hr',
                'no_all_hw',
                'no_all_gagal',
                'no_all_st',
                'no_all_jumlah',

                'denominator_all',
                'denominator_sbl_kon_psn',
                'denominator_sbl_tin_aseptik',
                'denominator_stl_kon_cairan',
                'denominator_stl_kon_psn',
                'denominator_stl_kon_ling_psn',
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

            $cssu_sbl_kon_psn = $cssu->where('sbl_kon_psn', '1')->count();
            $cssu_sbl_tin_aseptik = $cssu->where('sbl_tin_aseptik', '1')->count();
            $cssu_stl_kon_cairan = $cssu->where('stl_kon_cairan', '1')->count();
            $cssu_stl_kon_psn = $cssu->where('stl_kon_psn', '1')->count();
            $cssu_stl_kon_ling_psn = $cssu->where('stl_kon_ling_psn', '1')->count();
            $cssu_hr = $cssu->where('hr', '1')->count();
            $cssu_hw = $cssu->where('hw', '1')->count();
            $cssu_gagal = $cssu->where('gagal', '1')->count();
            $cssu_st = $cssu->where('st', '1')->count();
            $cssu_jumlah = $cssu_sbl_kon_psn + $cssu_sbl_tin_aseptik + $cssu_stl_kon_cairan + $cssu_stl_kon_psn + $cssu_stl_kon_ling_psn;

            $no_cssu_sbl_kon_psn = $cssu->where('sbl_kon_psn', '0')->count();
            $no_cssu_sbl_tin_aseptik = $cssu->where('sbl_tin_aseptik', '0')->count();
            $no_cssu_stl_kon_cairan = $cssu->where('stl_kon_cairan', '0')->count();
            $no_cssu_stl_kon_psn = $cssu->where('stl_kon_psn', '0')->count();
            $no_cssu_stl_kon_ling_psn = $cssu->where('stl_kon_ling_psn', '0')->count();
            $no_cssu_hr = $cssu->where('hr', '0')->count();
            $no_cssu_hw = $cssu->where('hw', '0')->count();
            $no_cssu_gagal = $cssu->where('gagal', '0')->count();
            $no_cssu_st = $cssu->where('st', '0')->count();
            $no_cssu_jumlah = $no_cssu_sbl_kon_psn + $no_cssu_sbl_tin_aseptik + $no_cssu_stl_kon_cairan + $no_cssu_stl_kon_psn + $no_cssu_stl_kon_ling_psn;

            $denominator_cssu = $cssu_jumlah + $no_cssu_jumlah;

            $dapur_sbl_kon_psn = $dapur->where('sbl_kon_psn', '1')->count();
            $dapur_sbl_tin_aseptik = $dapur->where('sbl_tin_aseptik', '1')->count();
            $dapur_stl_kon_cairan = $dapur->where('stl_kon_cairan', '1')->count();
            $dapur_stl_kon_psn = $dapur->where('stl_kon_psn', '1')->count();
            $dapur_stl_kon_ling_psn = $dapur->where('stl_kon_ling_psn', '1')->count();
            $dapur_hr = $dapur->where('hr', '1')->count();
            $dapur_hw = $dapur->where('hw', '1')->count();
            $dapur_gagal = $dapur->where('gagal', '1')->count();
            $dapur_st = $dapur->where('st', '1')->count();
            $dapur_jumlah = $dapur_sbl_kon_psn + $dapur_sbl_tin_aseptik + $dapur_stl_kon_cairan + $dapur_stl_kon_psn + $dapur_stl_kon_ling_psn;

            $no_dapur_sbl_kon_psn = $dapur->where('sbl_kon_psn', '0')->count();
            $no_dapur_sbl_tin_aseptik = $dapur->where('sbl_tin_aseptik', '0')->count();
            $no_dapur_stl_kon_cairan = $dapur->where('stl_kon_cairan', '0')->count();
            $no_dapur_stl_kon_psn = $dapur->where('stl_kon_psn', '0')->count();
            $no_dapur_stl_kon_ling_psn = $dapur->where('stl_kon_ling_psn', '0')->count();
            $no_dapur_hr = $dapur->where('hr', '0')->count();
            $no_dapur_hw = $dapur->where('hw', '0')->count();
            $no_dapur_gagal = $dapur->where('gagal', '0')->count();
            $no_dapur_st = $dapur->where('st', '0')->count();
            $no_dapur_jumlah = $no_dapur_sbl_kon_psn + $no_dapur_sbl_tin_aseptik + $no_dapur_stl_kon_cairan + $no_dapur_stl_kon_psn + $no_dapur_stl_kon_ling_psn;

            $denominator_dapur = $dapur_jumlah + $no_dapur_jumlah;

            $dpjp_sbl_kon_psn = $dpjp->where('sbl_kon_psn', '1')->count();
            $dpjp_sbl_tin_aseptik = $dpjp->where('sbl_tin_aseptik', '1')->count();
            $dpjp_stl_kon_cairan = $dpjp->where('stl_kon_cairan', '1')->count();
            $dpjp_stl_kon_psn = $dpjp->where('stl_kon_psn', '1')->count();
            $dpjp_stl_kon_ling_psn = $dpjp->where('stl_kon_ling_psn', '1')->count();
            $dpjp_hr = $dpjp->where('hr', '1')->count();
            $dpjp_hw = $dpjp->where('hw', '1')->count();
            $dpjp_gagal = $dpjp->where('gagal', '1')->count();
            $dpjp_st = $dpjp->where('st', '1')->count();
            $dpjp_jumlah = $dpjp_sbl_kon_psn + $dpjp_sbl_tin_aseptik + $dpjp_stl_kon_cairan + $dpjp_stl_kon_psn + $dpjp_stl_kon_ling_psn;

            $no_dpjp_sbl_kon_psn = $dpjp->where('sbl_kon_psn', '0')->count();
            $no_dpjp_sbl_tin_aseptik = $dpjp->where('sbl_tin_aseptik', '0')->count();
            $no_dpjp_stl_kon_cairan = $dpjp->where('stl_kon_cairan', '0')->count();
            $no_dpjp_stl_kon_psn = $dpjp->where('stl_kon_psn', '0')->count();
            $no_dpjp_stl_kon_ling_psn = $dpjp->where('stl_kon_ling_psn', '0')->count();
            $no_dpjp_hr = $dpjp->where('hr', '0')->count();
            $no_dpjp_hw = $dpjp->where('hw', '0')->count();
            $no_dpjp_gagal = $dpjp->where('gagal', '0')->count();
            $no_dpjp_st = $dpjp->where('st', '0')->count();
            $no_dpjp_jumlah = $no_dpjp_sbl_kon_psn + $no_dpjp_sbl_tin_aseptik + $no_dpjp_stl_kon_cairan + $no_dpjp_stl_kon_psn + $no_dpjp_stl_kon_ling_psn;

            $denominator_dpjp = $dpjp_jumlah + $no_dpjp_jumlah;

            $farmasi_sbl_kon_psn = $farmasi->where('sbl_kon_psn', '1')->count();
            $farmasi_sbl_tin_aseptik = $farmasi->where('sbl_tin_aseptik', '1')->count();
            $farmasi_stl_kon_cairan = $farmasi->where('stl_kon_cairan', '1')->count();
            $farmasi_stl_kon_psn = $farmasi->where('stl_kon_psn', '1')->count();
            $farmasi_stl_kon_ling_psn = $farmasi->where('stl_kon_ling_psn', '1')->count();
            $farmasi_hr = $farmasi->where('hr', '1')->count();
            $farmasi_hw = $farmasi->where('hw', '1')->count();
            $farmasi_gagal = $farmasi->where('gagal', '1')->count();
            $farmasi_st = $farmasi->where('st', '1')->count();
            $farmasi_jumlah = $farmasi_sbl_kon_psn + $farmasi_sbl_tin_aseptik + $farmasi_stl_kon_cairan + $farmasi_stl_kon_psn + $farmasi_stl_kon_ling_psn;

            $no_farmasi_sbl_kon_psn = $farmasi->where('sbl_kon_psn', '0')->count();
            $no_farmasi_sbl_tin_aseptik = $farmasi->where('sbl_tin_aseptik', '0')->count();
            $no_farmasi_stl_kon_cairan = $farmasi->where('stl_kon_cairan', '0')->count();
            $no_farmasi_stl_kon_psn = $farmasi->where('stl_kon_psn', '0')->count();
            $no_farmasi_stl_kon_ling_psn = $farmasi->where('stl_kon_ling_psn', '0')->count();
            $no_farmasi_hr = $farmasi->where('hr', '0')->count();
            $no_farmasi_hw = $farmasi->where('hw', '0')->count();
            $no_farmasi_gagal = $farmasi->where('gagal', '0')->count();
            $no_farmasi_st = $farmasi->where('st', '0')->count();
            $no_farmasi_jumlah = $no_farmasi_sbl_kon_psn + $no_farmasi_sbl_tin_aseptik + $no_farmasi_stl_kon_cairan + $no_farmasi_stl_kon_psn + $no_farmasi_stl_kon_ling_psn;

            $denominator_farmasi = $farmasi_jumlah + $no_farmasi_jumlah;

            $igd_sbl_kon_psn = $igd->where('sbl_kon_psn', '1')->count();
            $igd_sbl_tin_aseptik = $igd->where('sbl_tin_aseptik', '1')->count();
            $igd_stl_kon_cairan = $igd->where('stl_kon_cairan', '1')->count();
            $igd_stl_kon_psn = $igd->where('stl_kon_psn', '1')->count();
            $igd_stl_kon_ling_psn = $igd->where('stl_kon_ling_psn', '1')->count();
            $igd_hr = $igd->where('hr', '1')->count();
            $igd_hw = $igd->where('hw', '1')->count();
            $igd_gagal = $igd->where('gagal', '1')->count();
            $igd_st = $igd->where('st', '1')->count();
            $igd_jumlah = $igd_sbl_kon_psn + $igd_sbl_tin_aseptik + $igd_stl_kon_cairan + $igd_stl_kon_psn + $igd_stl_kon_ling_psn;

            $no_igd_sbl_kon_psn = $igd->where('sbl_kon_psn', '0')->count();
            $no_igd_sbl_tin_aseptik = $igd->where('sbl_tin_aseptik', '0')->count();
            $no_igd_stl_kon_cairan = $igd->where('stl_kon_cairan', '0')->count();
            $no_igd_stl_kon_psn = $igd->where('stl_kon_psn', '0')->count();
            $no_igd_stl_kon_ling_psn = $igd->where('stl_kon_ling_psn', '0')->count();
            $no_igd_hr = $igd->where('hr', '0')->count();
            $no_igd_hw = $igd->where('hw', '0')->count();
            $no_igd_gagal = $igd->where('gagal', '0')->count();
            $no_igd_st = $igd->where('st', '0')->count();
            $no_igd_jumlah = $no_igd_sbl_kon_psn + $no_igd_sbl_tin_aseptik + $no_igd_stl_kon_cairan + $no_igd_stl_kon_psn + $no_igd_stl_kon_ling_psn;

            $denominator_igd = $igd_jumlah + $no_igd_jumlah;

            $int_sbl_kon_psn = $int->where('sbl_kon_psn', '1')->count();
            $int_sbl_tin_aseptik = $int->where('sbl_tin_aseptik', '1')->count();
            $int_stl_kon_cairan = $int->where('stl_kon_cairan', '1')->count();
            $int_stl_kon_psn = $int->where('stl_kon_psn', '1')->count();
            $int_stl_kon_ling_psn = $int->where('stl_kon_ling_psn', '1')->count();
            $int_hr = $int->where('hr', '1')->count();
            $int_hw = $int->where('hw', '1')->count();
            $int_gagal = $int->where('gagal', '1')->count();
            $int_st = $int->where('st', '1')->count();
            $int_jumlah = $int_sbl_kon_psn + $int_sbl_tin_aseptik + $int_stl_kon_cairan + $int_stl_kon_psn + $int_stl_kon_ling_psn;

            $no_int_sbl_kon_psn = $int->where('sbl_kon_psn', '0')->count();
            $no_int_sbl_tin_aseptik = $int->where('sbl_tin_aseptik', '0')->count();
            $no_int_stl_kon_cairan = $int->where('stl_kon_cairan', '0')->count();
            $no_int_stl_kon_psn = $int->where('stl_kon_psn', '0')->count();
            $no_int_stl_kon_ling_psn = $int->where('stl_kon_ling_psn', '0')->count();
            $no_int_hr = $int->where('hr', '0')->count();
            $no_int_hw = $int->where('hw', '0')->count();
            $no_int_gagal = $int->where('gagal', '0')->count();
            $no_int_st = $int->where('st', '0')->count();
            $no_int_jumlah = $no_int_sbl_kon_psn + $no_int_sbl_tin_aseptik + $no_int_stl_kon_cairan + $no_int_stl_kon_psn + $no_int_stl_kon_ling_psn;

            $denominator_int = $int_jumlah + $no_int_jumlah;

            $kebersihan_sbl_kon_psn = $kebersihan->where('sbl_kon_psn', '1')->count();
            $kebersihan_sbl_tin_aseptik = $kebersihan->where('sbl_tin_aseptik', '1')->count();
            $kebersihan_stl_kon_cairan = $kebersihan->where('stl_kon_cairan', '1')->count();
            $kebersihan_stl_kon_psn = $kebersihan->where('stl_kon_psn', '1')->count();
            $kebersihan_stl_kon_ling_psn = $kebersihan->where('stl_kon_ling_psn', '1')->count();
            $kebersihan_hr = $kebersihan->where('hr', '1')->count();
            $kebersihan_hw = $kebersihan->where('hw', '1')->count();
            $kebersihan_gagal = $kebersihan->where('gagal', '1')->count();
            $kebersihan_st = $kebersihan->where('st', '1')->count();
            $kebersihan_jumlah = $kebersihan_sbl_kon_psn + $kebersihan_sbl_tin_aseptik + $kebersihan_stl_kon_cairan + $kebersihan_stl_kon_psn + $kebersihan_stl_kon_ling_psn;

            $no_kebersihan_sbl_kon_psn = $kebersihan->where('sbl_kon_psn', '0')->count();
            $no_kebersihan_sbl_tin_aseptik = $kebersihan->where('sbl_tin_aseptik', '0')->count();
            $no_kebersihan_stl_kon_cairan = $kebersihan->where('stl_kon_cairan', '0')->count();
            $no_kebersihan_stl_kon_psn = $kebersihan->where('stl_kon_psn', '0')->count();
            $no_kebersihan_stl_kon_ling_psn = $kebersihan->where('stl_kon_ling_psn', '0')->count();
            $no_kebersihan_hr = $kebersihan->where('hr', '0')->count();
            $no_kebersihan_hw = $kebersihan->where('hw', '0')->count();
            $no_kebersihan_gagal = $kebersihan->where('gagal', '0')->count();
            $no_kebersihan_st = $kebersihan->where('st', '0')->count();
            $no_kebersihan_jumlah = $no_kebersihan_sbl_kon_psn + $no_kebersihan_sbl_tin_aseptik + $no_kebersihan_stl_kon_cairan + $no_kebersihan_stl_kon_psn + $no_kebersihan_stl_kon_ling_psn;

            $denominator_kebersihan = $kebersihan_jumlah + $no_kebersihan_jumlah;

            $kbbl_sbl_kon_psn = $kbbl->where('sbl_kon_psn', '1')->count();
            $kbbl_sbl_tin_aseptik = $kbbl->where('sbl_tin_aseptik', '1')->count();
            $kbbl_stl_kon_cairan = $kbbl->where('stl_kon_cairan', '1')->count();
            $kbbl_stl_kon_psn = $kbbl->where('stl_kon_psn', '1')->count();
            $kbbl_stl_kon_ling_psn = $kbbl->where('stl_kon_ling_psn', '1')->count();
            $kbbl_hr = $kbbl->where('hr', '1')->count();
            $kbbl_hw = $kbbl->where('hw', '1')->count();
            $kbbl_gagal = $kbbl->where('gagal', '1')->count();
            $kbbl_st = $kbbl->where('st', '1')->count();
            $kbbl_jumlah = $kbbl_sbl_kon_psn + $kbbl_sbl_tin_aseptik + $kbbl_stl_kon_cairan + $kbbl_stl_kon_psn + $kbbl_stl_kon_ling_psn;

            $no_kbbl_sbl_kon_psn = $kbbl->where('sbl_kon_psn', '0')->count();
            $no_kbbl_sbl_tin_aseptik = $kbbl->where('sbl_tin_aseptik', '0')->count();
            $no_kbbl_stl_kon_cairan = $kbbl->where('stl_kon_cairan', '0')->count();
            $no_kbbl_stl_kon_psn = $kbbl->where('stl_kon_psn', '0')->count();
            $no_kbbl_stl_kon_ling_psn = $kbbl->where('stl_kon_ling_psn', '0')->count();
            $no_kbbl_hr = $kbbl->where('hr', '0')->count();
            $no_kbbl_hw = $kbbl->where('hw', '0')->count();
            $no_kbbl_gagal = $kbbl->where('gagal', '0')->count();
            $no_kbbl_st = $kbbl->where('st', '0')->count();
            $no_kbbl_jumlah = $no_kbbl_sbl_kon_psn + $no_kbbl_sbl_tin_aseptik + $no_kbbl_stl_kon_cairan + $no_kbbl_stl_kon_psn + $no_kbbl_stl_kon_ling_psn;

            $denominator_kbbl = $kbbl_jumlah + $no_kbbl_jumlah;

            $lab_sbl_kon_psn = $lab->where('sbl_kon_psn', '1')->count();
            $lab_sbl_tin_aseptik = $lab->where('sbl_tin_aseptik', '1')->count();
            $lab_stl_kon_cairan = $lab->where('stl_kon_cairan', '1')->count();
            $lab_stl_kon_psn = $lab->where('stl_kon_psn', '1')->count();
            $lab_stl_kon_ling_psn = $lab->where('stl_kon_ling_psn', '1')->count();
            $lab_hr = $lab->where('hr', '1')->count();
            $lab_hw = $lab->where('hw', '1')->count();
            $lab_gagal = $lab->where('gagal', '1')->count();
            $lab_st = $lab->where('st', '1')->count();
            $lab_jumlah = $lab_sbl_kon_psn + $lab_sbl_tin_aseptik + $lab_stl_kon_cairan + $lab_stl_kon_psn + $lab_stl_kon_ling_psn;

            $no_lab_sbl_kon_psn = $lab->where('sbl_kon_psn', '0')->count();
            $no_lab_sbl_tin_aseptik = $lab->where('sbl_tin_aseptik', '0')->count();
            $no_lab_stl_kon_cairan = $lab->where('stl_kon_cairan', '0')->count();
            $no_lab_stl_kon_psn = $lab->where('stl_kon_psn', '0')->count();
            $no_lab_stl_kon_ling_psn = $lab->where('stl_kon_ling_psn', '0')->count();
            $no_lab_hr = $lab->where('hr', '0')->count();
            $no_lab_hw = $lab->where('hw', '0')->count();
            $no_lab_gagal = $lab->where('gagal', '0')->count();
            $no_lab_st = $lab->where('st', '0')->count();
            $no_lab_jumlah = $no_lab_sbl_kon_psn + $no_lab_sbl_tin_aseptik + $no_lab_stl_kon_cairan + $no_lab_stl_kon_psn + $no_lab_stl_kon_ling_psn;

            $denominator_lab = $lab_jumlah + $no_lab_jumlah;

            $laundry_sbl_kon_psn = $laundry->where('sbl_kon_psn', '1')->count();
            $laundry_sbl_tin_aseptik = $laundry->where('sbl_tin_aseptik', '1')->count();
            $laundry_stl_kon_cairan = $laundry->where('stl_kon_cairan', '1')->count();
            $laundry_stl_kon_psn = $laundry->where('stl_kon_psn', '1')->count();
            $laundry_stl_kon_ling_psn = $laundry->where('stl_kon_ling_psn', '1')->count();
            $laundry_hr = $laundry->where('hr', '1')->count();
            $laundry_hw = $laundry->where('hw', '1')->count();
            $laundry_gagal = $laundry->where('gagal', '1')->count();
            $laundry_st = $laundry->where('st', '1')->count();
            $laundry_jumlah = $laundry_sbl_kon_psn + $laundry_sbl_tin_aseptik + $laundry_stl_kon_cairan + $laundry_stl_kon_psn + $laundry_stl_kon_ling_psn;

            $no_laundry_sbl_kon_psn = $laundry->where('sbl_kon_psn', '0')->count();
            $no_laundry_sbl_tin_aseptik = $laundry->where('sbl_tin_aseptik', '0')->count();
            $no_laundry_stl_kon_cairan = $laundry->where('stl_kon_cairan', '0')->count();
            $no_laundry_stl_kon_psn = $laundry->where('stl_kon_psn', '0')->count();
            $no_laundry_stl_kon_ling_psn = $laundry->where('stl_kon_ling_psn', '0')->count();
            $no_laundry_hr = $laundry->where('hr', '0')->count();
            $no_laundry_hw = $laundry->where('hw', '0')->count();
            $no_laundry_gagal = $laundry->where('gagal', '0')->count();
            $no_laundry_st = $laundry->where('st', '0')->count();
            $no_laundry_jumlah = $no_laundry_sbl_kon_psn + $no_laundry_sbl_tin_aseptik + $no_laundry_stl_kon_cairan + $no_laundry_stl_kon_psn + $no_laundry_stl_kon_ling_psn;

            $denominator_laundry = $laundry_jumlah + $no_laundry_jumlah;

            $ok_sbl_kon_psn = $ok->where('sbl_kon_psn', '1')->count();
            $ok_sbl_tin_aseptik = $ok->where('sbl_tin_aseptik', '1')->count();
            $ok_stl_kon_cairan = $ok->where('stl_kon_cairan', '1')->count();
            $ok_stl_kon_psn = $ok->where('stl_kon_psn', '1')->count();
            $ok_stl_kon_ling_psn = $ok->where('stl_kon_ling_psn', '1')->count();
            $ok_hr = $ok->where('hr', '1')->count();
            $ok_hw = $ok->where('hw', '1')->count();
            $ok_gagal = $ok->where('gagal', '1')->count();
            $ok_st = $ok->where('st', '1')->count();
            $ok_jumlah = $ok_sbl_kon_psn + $ok_sbl_tin_aseptik + $ok_stl_kon_cairan + $ok_stl_kon_psn + $ok_stl_kon_ling_psn;

            $no_ok_sbl_kon_psn = $ok->where('sbl_kon_psn', '0')->count();
            $no_ok_sbl_tin_aseptik = $ok->where('sbl_tin_aseptik', '0')->count();
            $no_ok_stl_kon_cairan = $ok->where('stl_kon_cairan', '0')->count();
            $no_ok_stl_kon_psn = $ok->where('stl_kon_psn', '0')->count();
            $no_ok_stl_kon_ling_psn = $ok->where('stl_kon_ling_psn', '0')->count();
            $no_ok_hr = $ok->where('hr', '0')->count();
            $no_ok_hw = $ok->where('hw', '0')->count();
            $no_ok_gagal = $ok->where('gagal', '0')->count();
            $no_ok_st = $ok->where('st', '0')->count();
            $no_ok_jumlah = $no_ok_sbl_kon_psn + $no_ok_sbl_tin_aseptik + $no_ok_stl_kon_cairan + $no_ok_stl_kon_psn + $no_ok_stl_kon_ling_psn;

            $denominator_ok = $ok_jumlah + $no_ok_jumlah;

            $lt2_sbl_kon_psn = $lt2->where('sbl_kon_psn', '1')->count();
            $lt2_sbl_tin_aseptik = $lt2->where('sbl_tin_aseptik', '1')->count();
            $lt2_stl_kon_cairan = $lt2->where('stl_kon_cairan', '1')->count();
            $lt2_stl_kon_psn = $lt2->where('stl_kon_psn', '1')->count();
            $lt2_stl_kon_ling_psn = $lt2->where('stl_kon_ling_psn', '1')->count();
            $lt2_hr = $lt2->where('hr', '1')->count();
            $lt2_hw = $lt2->where('hw', '1')->count();
            $lt2_gagal = $lt2->where('gagal', '1')->count();
            $lt2_st = $lt2->where('st', '1')->count();
            $lt2_jumlah = $lt2_sbl_kon_psn + $lt2_sbl_tin_aseptik + $lt2_stl_kon_cairan + $lt2_stl_kon_psn + $lt2_stl_kon_ling_psn;

            $no_lt2_sbl_kon_psn = $lt2->where('sbl_kon_psn', '0')->count();
            $no_lt2_sbl_tin_aseptik = $lt2->where('sbl_tin_aseptik', '0')->count();
            $no_lt2_stl_kon_cairan = $lt2->where('stl_kon_cairan', '0')->count();
            $no_lt2_stl_kon_psn = $lt2->where('stl_kon_psn', '0')->count();
            $no_lt2_stl_kon_ling_psn = $lt2->where('stl_kon_ling_psn', '0')->count();
            $no_lt2_hr = $lt2->where('hr', '0')->count();
            $no_lt2_hw = $lt2->where('hw', '0')->count();
            $no_lt2_gagal = $lt2->where('gagal', '0')->count();
            $no_lt2_st = $lt2->where('st', '0')->count();
            $no_lt2_jumlah = $no_lt2_sbl_kon_psn + $no_lt2_sbl_tin_aseptik + $no_lt2_stl_kon_cairan + $no_lt2_stl_kon_psn + $no_lt2_stl_kon_ling_psn;

            $denominator_lt2 = $lt2_jumlah + $no_lt2_jumlah;

            $lt4_sbl_kon_psn = $lt4->where('sbl_kon_psn', '1')->count();
            $lt4_sbl_tin_aseptik = $lt4->where('sbl_tin_aseptik', '1')->count();
            $lt4_stl_kon_cairan = $lt4->where('stl_kon_cairan', '1')->count();
            $lt4_stl_kon_psn = $lt4->where('stl_kon_psn', '1')->count();
            $lt4_stl_kon_ling_psn = $lt4->where('stl_kon_ling_psn', '1')->count();
            $lt4_hr = $lt4->where('hr', '1')->count();
            $lt4_hw = $lt4->where('hw', '1')->count();
            $lt4_gagal = $lt4->where('gagal', '1')->count();
            $lt4_st = $lt4->where('st', '1')->count();
            $lt4_jumlah = $lt4_sbl_kon_psn + $lt4_sbl_tin_aseptik + $lt4_stl_kon_cairan + $lt4_stl_kon_psn + $lt4_stl_kon_ling_psn;

            $no_lt4_sbl_kon_psn = $lt4->where('sbl_kon_psn', '0')->count();
            $no_lt4_sbl_tin_aseptik = $lt4->where('sbl_tin_aseptik', '0')->count();
            $no_lt4_stl_kon_cairan = $lt4->where('stl_kon_cairan', '0')->count();
            $no_lt4_stl_kon_psn = $lt4->where('stl_kon_psn', '0')->count();
            $no_lt4_stl_kon_ling_psn = $lt4->where('stl_kon_ling_psn', '0')->count();
            $no_lt4_hr = $lt4->where('hr', '0')->count();
            $no_lt4_hw = $lt4->where('hw', '0')->count();
            $no_lt4_gagal = $lt4->where('gagal', '0')->count();
            $no_lt4_st = $lt4->where('st', '0')->count();
            $no_lt4_jumlah = $no_lt4_sbl_kon_psn + $no_lt4_sbl_tin_aseptik + $no_lt4_stl_kon_cairan + $no_lt4_stl_kon_psn + $no_lt4_stl_kon_ling_psn;

            $denominator_lt4 = $lt4_jumlah + $no_lt4_jumlah;

            $lt5_sbl_kon_psn = $lt5->where('sbl_kon_psn', '1')->count();
            $lt5_sbl_tin_aseptik = $lt5->where('sbl_tin_aseptik', '1')->count();
            $lt5_stl_kon_cairan = $lt5->where('stl_kon_cairan', '1')->count();
            $lt5_stl_kon_psn = $lt5->where('stl_kon_psn', '1')->count();
            $lt5_stl_kon_ling_psn = $lt5->where('stl_kon_ling_psn', '1')->count();
            $lt5_hr = $lt5->where('hr', '1')->count();
            $lt5_hw = $lt5->where('hw', '1')->count();
            $lt5_gagal = $lt5->where('gagal', '1')->count();
            $lt5_st = $lt5->where('st', '1')->count();
            $lt5_jumlah = $lt5_sbl_kon_psn + $lt5_sbl_tin_aseptik + $lt5_stl_kon_cairan + $lt5_stl_kon_psn + $lt5_stl_kon_ling_psn;

            $no_lt5_sbl_kon_psn = $lt5->where('sbl_kon_psn', '0')->count();
            $no_lt5_sbl_tin_aseptik = $lt5->where('sbl_tin_aseptik', '0')->count();
            $no_lt5_stl_kon_cairan = $lt5->where('stl_kon_cairan', '0')->count();
            $no_lt5_stl_kon_psn = $lt5->where('stl_kon_psn', '0')->count();
            $no_lt5_stl_kon_ling_psn = $lt5->where('stl_kon_ling_psn', '0')->count();
            $no_lt5_hr = $lt5->where('hr', '0')->count();
            $no_lt5_hw = $lt5->where('hw', '0')->count();
            $no_lt5_gagal = $lt5->where('gagal', '0')->count();
            $no_lt5_st = $lt5->where('st', '0')->count();
            $no_lt5_jumlah = $no_lt5_sbl_kon_psn + $no_lt5_sbl_tin_aseptik + $no_lt5_stl_kon_cairan + $no_lt5_stl_kon_psn + $no_lt5_stl_kon_ling_psn;

            $denominator_lt5 = $lt5_jumlah + $no_lt5_jumlah;

            $poli_sbl_kon_psn = $poli->where('sbl_kon_psn', '1')->count();
            $poli_sbl_tin_aseptik = $poli->where('sbl_tin_aseptik', '1')->count();
            $poli_stl_kon_cairan = $poli->where('stl_kon_cairan', '1')->count();
            $poli_stl_kon_psn = $poli->where('stl_kon_psn', '1')->count();
            $poli_stl_kon_ling_psn = $poli->where('stl_kon_ling_psn', '1')->count();
            $poli_hr = $poli->where('hr', '1')->count();
            $poli_hw = $poli->where('hw', '1')->count();
            $poli_gagal = $poli->where('gagal', '1')->count();
            $poli_st = $poli->where('st', '1')->count();
            $poli_jumlah = $poli_sbl_kon_psn + $poli_sbl_tin_aseptik + $poli_stl_kon_cairan + $poli_stl_kon_psn + $poli_stl_kon_ling_psn;

            $no_poli_sbl_kon_psn = $poli->where('sbl_kon_psn', '0')->count();
            $no_poli_sbl_tin_aseptik = $poli->where('sbl_tin_aseptik', '0')->count();
            $no_poli_stl_kon_cairan = $poli->where('stl_kon_cairan', '0')->count();
            $no_poli_stl_kon_psn = $poli->where('stl_kon_psn', '0')->count();
            $no_poli_stl_kon_ling_psn = $poli->where('stl_kon_ling_psn', '0')->count();
            $no_poli_hr = $poli->where('hr', '0')->count();
            $no_poli_hw = $poli->where('hw', '0')->count();
            $no_poli_gagal = $poli->where('gagal', '0')->count();
            $no_poli_st = $poli->where('st', '0')->count();
            $no_poli_jumlah = $no_poli_sbl_kon_psn + $no_poli_sbl_tin_aseptik + $no_poli_stl_kon_cairan + $no_poli_stl_kon_psn + $no_poli_stl_kon_ling_psn;

            $denominator_poli = $poli_jumlah + $no_poli_jumlah;

            $rad_sbl_kon_psn = $rad->where('sbl_kon_psn', '1')->count();
            $rad_sbl_tin_aseptik = $rad->where('sbl_tin_aseptik', '1')->count();
            $rad_stl_kon_cairan = $rad->where('stl_kon_cairan', '1')->count();
            $rad_stl_kon_psn = $rad->where('stl_kon_psn', '1')->count();
            $rad_stl_kon_ling_psn = $rad->where('stl_kon_ling_psn', '1')->count();
            $rad_hr = $rad->where('hr', '1')->count();
            $rad_hw = $rad->where('hw', '1')->count();
            $rad_gagal = $rad->where('gagal', '1')->count();
            $rad_st = $rad->where('st', '1')->count();
            $rad_jumlah = $rad_sbl_kon_psn + $rad_sbl_tin_aseptik + $rad_stl_kon_cairan + $rad_stl_kon_psn + $rad_stl_kon_ling_psn;

            $no_rad_sbl_kon_psn = $rad->where('sbl_kon_psn', '0')->count();
            $no_rad_sbl_tin_aseptik = $rad->where('sbl_tin_aseptik', '0')->count();
            $no_rad_stl_kon_cairan = $rad->where('stl_kon_cairan', '0')->count();
            $no_rad_stl_kon_psn = $rad->where('stl_kon_psn', '0')->count();
            $no_rad_stl_kon_ling_psn = $rad->where('stl_kon_ling_psn', '0')->count();
            $no_rad_hr = $rad->where('hr', '0')->count();
            $no_rad_hw = $rad->where('hw', '0')->count();
            $no_rad_gagal = $rad->where('gagal', '0')->count();
            $no_rad_st = $rad->where('st', '0')->count();
            $no_rad_jumlah = $no_rad_sbl_kon_psn + $no_rad_sbl_tin_aseptik + $no_rad_stl_kon_cairan + $no_rad_stl_kon_psn + $no_rad_stl_kon_ling_psn;

            $denominator_rad = $rad_jumlah + $no_rad_jumlah;

            $vk_sbl_kon_psn = $vk->where('sbl_kon_psn', '1')->count();
            $vk_sbl_tin_aseptik = $vk->where('sbl_tin_aseptik', '1')->count();
            $vk_stl_kon_cairan = $vk->where('stl_kon_cairan', '1')->count();
            $vk_stl_kon_psn = $vk->where('stl_kon_psn', '1')->count();
            $vk_stl_kon_ling_psn = $vk->where('stl_kon_ling_psn', '1')->count();
            $vk_hr = $vk->where('hr', '1')->count();
            $vk_hw = $vk->where('hw', '1')->count();
            $vk_gagal = $vk->where('gagal', '1')->count();
            $vk_st = $vk->where('st', '1')->count();
            $vk_jumlah = $vk_sbl_kon_psn + $vk_sbl_tin_aseptik + $vk_stl_kon_cairan + $vk_stl_kon_psn + $vk_stl_kon_ling_psn;

            $no_vk_sbl_kon_psn = $vk->where('sbl_kon_psn', '0')->count();
            $no_vk_sbl_tin_aseptik = $vk->where('sbl_tin_aseptik', '0')->count();
            $no_vk_stl_kon_cairan = $vk->where('stl_kon_cairan', '0')->count();
            $no_vk_stl_kon_psn = $vk->where('stl_kon_psn', '0')->count();
            $no_vk_stl_kon_ling_psn = $vk->where('stl_kon_ling_psn', '0')->count();
            $no_vk_hr = $vk->where('hr', '0')->count();
            $no_vk_hw = $vk->where('hw', '0')->count();
            $no_vk_gagal = $vk->where('gagal', '0')->count();
            $no_vk_st = $vk->where('st', '0')->count();
            $no_vk_jumlah = $no_vk_sbl_kon_psn + $no_vk_sbl_tin_aseptik + $no_vk_stl_kon_cairan + $no_vk_stl_kon_psn + $no_vk_stl_kon_ling_psn;

            $denominator_vk = $vk_jumlah + $no_vk_jumlah;

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
                $cssu_jumlah,

                $no_cssu_sbl_kon_psn,
                $no_cssu_sbl_tin_aseptik,
                $no_cssu_stl_kon_cairan,
                $no_cssu_stl_kon_psn,
                $no_cssu_stl_kon_ling_psn,
                $no_cssu_hr,
                $no_cssu_hw,
                $no_cssu_gagal,
                $no_cssu_st,
                $no_cssu_jumlah,

                $denominator_cssu,

                $dapur_sbl_kon_psn,
                $dapur_sbl_tin_aseptik,
                $dapur_stl_kon_cairan,
                $dapur_stl_kon_psn,
                $dapur_stl_kon_ling_psn,
                $dapur_hr,
                $dapur_hw,
                $dapur_gagal,
                $dapur_st,
                $dapur_jumlah,

                $no_dapur_sbl_kon_psn,
                $no_dapur_sbl_tin_aseptik,
                $no_dapur_stl_kon_cairan,
                $no_dapur_stl_kon_psn,
                $no_dapur_stl_kon_ling_psn,
                $no_dapur_hr,
                $no_dapur_hw,
                $no_dapur_gagal,
                $no_dapur_st,
                $no_dapur_jumlah,

                $denominator_dapur,

                $dpjp_sbl_kon_psn,
                $dpjp_sbl_tin_aseptik,
                $dpjp_stl_kon_cairan,
                $dpjp_stl_kon_psn,
                $dpjp_stl_kon_ling_psn,
                $dpjp_hr,
                $dpjp_hw,
                $dpjp_gagal,
                $dpjp_st,
                $dpjp_jumlah,

                $no_dpjp_sbl_kon_psn,
                $no_dpjp_sbl_tin_aseptik,
                $no_dpjp_stl_kon_cairan,
                $no_dpjp_stl_kon_psn,
                $no_dpjp_stl_kon_ling_psn,
                $no_dpjp_hr,
                $no_dpjp_hw,
                $no_dpjp_gagal,
                $no_dpjp_st,
                $no_dpjp_jumlah,

                $denominator_dpjp,

                $farmasi_sbl_kon_psn,
                $farmasi_sbl_tin_aseptik,
                $farmasi_stl_kon_cairan,
                $farmasi_stl_kon_psn,
                $farmasi_stl_kon_ling_psn,
                $farmasi_hr,
                $farmasi_hw,
                $farmasi_gagal,
                $farmasi_st,
                $farmasi_jumlah,

                $no_farmasi_sbl_kon_psn,
                $no_farmasi_sbl_tin_aseptik,
                $no_farmasi_stl_kon_cairan,
                $no_farmasi_stl_kon_psn,
                $no_farmasi_stl_kon_ling_psn,
                $no_farmasi_hr,
                $no_farmasi_hw,
                $no_farmasi_gagal,
                $no_farmasi_st,
                $no_farmasi_jumlah,

                $denominator_farmasi,

                $igd_sbl_kon_psn,
                $igd_sbl_tin_aseptik,
                $igd_stl_kon_cairan,
                $igd_stl_kon_psn,
                $igd_stl_kon_ling_psn,
                $igd_hr,
                $igd_hw,
                $igd_gagal,
                $igd_st,
                $igd_jumlah,

                $no_igd_sbl_kon_psn,
                $no_igd_sbl_tin_aseptik,
                $no_igd_stl_kon_cairan,
                $no_igd_stl_kon_psn,
                $no_igd_stl_kon_ling_psn,
                $no_igd_hr,
                $no_igd_hw,
                $no_igd_gagal,
                $no_igd_st,
                $no_igd_jumlah,

                $denominator_igd,

                $int_sbl_kon_psn,
                $int_sbl_tin_aseptik,
                $int_stl_kon_cairan,
                $int_stl_kon_psn,
                $int_stl_kon_ling_psn,
                $int_hr,
                $int_hw,
                $int_gagal,
                $int_st,
                $int_jumlah,

                $no_int_sbl_kon_psn,
                $no_int_sbl_tin_aseptik,
                $no_int_stl_kon_cairan,
                $no_int_stl_kon_psn,
                $no_int_stl_kon_ling_psn,
                $no_int_hr,
                $no_int_hw,
                $no_int_gagal,
                $no_int_st,
                $no_int_jumlah,

                $denominator_int,

                $kebersihan_sbl_kon_psn,
                $kebersihan_sbl_tin_aseptik,
                $kebersihan_stl_kon_cairan,
                $kebersihan_stl_kon_psn,
                $kebersihan_stl_kon_ling_psn,
                $kebersihan_hr,
                $kebersihan_hw,
                $kebersihan_gagal,
                $kebersihan_st,
                $kebersihan_jumlah,

                $no_kebersihan_sbl_kon_psn,
                $no_kebersihan_sbl_tin_aseptik,
                $no_kebersihan_stl_kon_cairan,
                $no_kebersihan_stl_kon_psn,
                $no_kebersihan_stl_kon_ling_psn,
                $no_kebersihan_hr,
                $no_kebersihan_hw,
                $no_kebersihan_gagal,
                $no_kebersihan_st,
                $no_kebersihan_jumlah,

                $denominator_kebersihan,

                $kbbl_sbl_kon_psn,
                $kbbl_sbl_tin_aseptik,
                $kbbl_stl_kon_cairan,
                $kbbl_stl_kon_psn,
                $kbbl_stl_kon_ling_psn,
                $kbbl_hr,
                $kbbl_hw,
                $kbbl_gagal,
                $kbbl_st,
                $kbbl_jumlah,

                $no_kbbl_sbl_kon_psn,
                $no_kbbl_sbl_tin_aseptik,
                $no_kbbl_stl_kon_cairan,
                $no_kbbl_stl_kon_psn,
                $no_kbbl_stl_kon_ling_psn,
                $no_kbbl_hr,
                $no_kbbl_hw,
                $no_kbbl_gagal,
                $no_kbbl_st,
                $no_kbbl_jumlah,

                $denominator_kbbl,

                $lab_sbl_kon_psn,
                $lab_sbl_tin_aseptik,
                $lab_stl_kon_cairan,
                $lab_stl_kon_psn,
                $lab_stl_kon_ling_psn,
                $lab_hr,
                $lab_hw,
                $lab_gagal,
                $lab_st,
                $lab_jumlah,

                $no_lab_sbl_kon_psn,
                $no_lab_sbl_tin_aseptik,
                $no_lab_stl_kon_cairan,
                $no_lab_stl_kon_psn,
                $no_lab_stl_kon_ling_psn,
                $no_lab_hr,
                $no_lab_hw,
                $no_lab_gagal,
                $no_lab_st,
                $no_lab_jumlah,

                $denominator_lab,

                $laundry_sbl_kon_psn,
                $laundry_sbl_tin_aseptik,
                $laundry_stl_kon_cairan,
                $laundry_stl_kon_psn,
                $laundry_stl_kon_ling_psn,
                $laundry_hr,
                $laundry_hw,
                $laundry_gagal,
                $laundry_st,
                $laundry_jumlah,

                $no_laundry_sbl_kon_psn,
                $no_laundry_sbl_tin_aseptik,
                $no_laundry_stl_kon_cairan,
                $no_laundry_stl_kon_psn,
                $no_laundry_stl_kon_ling_psn,
                $no_laundry_hr,
                $no_laundry_hw,
                $no_laundry_gagal,
                $no_laundry_st,
                $no_laundry_jumlah,

                $denominator_laundry,

                $ok_sbl_kon_psn,
                $ok_sbl_tin_aseptik,
                $ok_stl_kon_cairan,
                $ok_stl_kon_psn,
                $ok_stl_kon_ling_psn,
                $ok_hr,
                $ok_hw,
                $ok_gagal,
                $ok_st,
                $ok_jumlah,

                $no_ok_sbl_kon_psn,
                $no_ok_sbl_tin_aseptik,
                $no_ok_stl_kon_cairan,
                $no_ok_stl_kon_psn,
                $no_ok_stl_kon_ling_psn,
                $no_ok_hr,
                $no_ok_hw,
                $no_ok_gagal,
                $no_ok_st,
                $no_ok_jumlah,

                $denominator_ok,

                $lt2_sbl_kon_psn,
                $lt2_sbl_tin_aseptik,
                $lt2_stl_kon_cairan,
                $lt2_stl_kon_psn,
                $lt2_stl_kon_ling_psn,
                $lt2_hr,
                $lt2_hw,
                $lt2_gagal,
                $lt2_st,
                $lt2_jumlah,

                $no_lt2_sbl_kon_psn,
                $no_lt2_sbl_tin_aseptik,
                $no_lt2_stl_kon_cairan,
                $no_lt2_stl_kon_psn,
                $no_lt2_stl_kon_ling_psn,
                $no_lt2_hr,
                $no_lt2_hw,
                $no_lt2_gagal,
                $no_lt2_st,
                $no_lt2_jumlah,

                $denominator_lt2,

                $lt4_sbl_kon_psn,
                $lt4_sbl_tin_aseptik,
                $lt4_stl_kon_cairan,
                $lt4_stl_kon_psn,
                $lt4_stl_kon_ling_psn,
                $lt4_hr,
                $lt4_hw,
                $lt4_gagal,
                $lt4_st,
                $lt4_jumlah,

                $no_lt4_sbl_kon_psn,
                $no_lt4_sbl_tin_aseptik,
                $no_lt4_stl_kon_cairan,
                $no_lt4_stl_kon_psn,
                $no_lt4_stl_kon_ling_psn,
                $no_lt4_hr,
                $no_lt4_hw,
                $no_lt4_gagal,
                $no_lt4_st,
                $no_lt4_jumlah,

                $denominator_lt4,

                $lt5_sbl_kon_psn,
                $lt5_sbl_tin_aseptik,
                $lt5_stl_kon_cairan,
                $lt5_stl_kon_psn,
                $lt5_stl_kon_ling_psn,
                $lt5_hr,
                $lt5_hw,
                $lt5_gagal,
                $lt5_st,
                $lt5_jumlah,

                $no_lt5_sbl_kon_psn,
                $no_lt5_sbl_tin_aseptik,
                $no_lt5_stl_kon_cairan,
                $no_lt5_stl_kon_psn,
                $no_lt5_stl_kon_ling_psn,
                $no_lt5_hr,
                $no_lt5_hw,
                $no_lt5_gagal,
                $no_lt5_st,
                $no_lt5_jumlah,

                $denominator_lt5,

                $poli_sbl_kon_psn,
                $poli_sbl_tin_aseptik,
                $poli_stl_kon_cairan,
                $poli_stl_kon_psn,
                $poli_stl_kon_ling_psn,
                $poli_hr,
                $poli_hw,
                $poli_gagal,
                $poli_st,
                $poli_jumlah,

                $no_poli_sbl_kon_psn,
                $no_poli_sbl_tin_aseptik,
                $no_poli_stl_kon_cairan,
                $no_poli_stl_kon_psn,
                $no_poli_stl_kon_ling_psn,
                $no_poli_hr,
                $no_poli_hw,
                $no_poli_gagal,
                $no_poli_st,
                $no_poli_jumlah,

                $denominator_poli,

                $rad_sbl_kon_psn,
                $rad_sbl_tin_aseptik,
                $rad_stl_kon_cairan,
                $rad_stl_kon_psn,
                $rad_stl_kon_ling_psn,
                $rad_hr,
                $rad_hw,
                $rad_gagal,
                $rad_st,
                $rad_jumlah,

                $no_rad_sbl_kon_psn,
                $no_rad_sbl_tin_aseptik,
                $no_rad_stl_kon_cairan,
                $no_rad_stl_kon_psn,
                $no_rad_stl_kon_ling_psn,
                $no_rad_hr,
                $no_rad_hw,
                $no_rad_gagal,
                $no_rad_st,
                $no_rad_jumlah,

                $denominator_rad,

                $vk_sbl_kon_psn,
                $vk_sbl_tin_aseptik,
                $vk_stl_kon_cairan,
                $vk_stl_kon_psn,
                $vk_stl_kon_ling_psn,
                $vk_hr,
                $vk_hw,
                $vk_gagal,
                $vk_st,
                $vk_jumlah,

                $no_vk_sbl_kon_psn,
                $no_vk_sbl_tin_aseptik,
                $no_vk_stl_kon_cairan,
                $no_vk_stl_kon_psn,
                $no_vk_stl_kon_ling_psn,
                $no_vk_hr,
                $no_vk_hw,
                $no_vk_gagal,
                $no_vk_st,
                $no_vk_jumlah,

                $denominator_vk,

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

            $denominator_cssu = $cssu_jumlah + $no_cssu_jumlah;

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

            $denominator_dapur = $dapur_jumlah + $no_dapur_jumlah;

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

            $denominator_dpjp = $dpjp_jumlah + $no_dpjp_jumlah;

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

            $denominator_farmasi = $farmasi_jumlah + $no_farmasi_jumlah;

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

            $denominator_igd = $igd_jumlah + $no_igd_jumlah;

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

            $denominator_int = $int_jumlah + $no_int_jumlah;

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

            $denominator_kebersihan = $kebersihan_jumlah + $no_kebersihan_jumlah;

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

            $denominator_kbbl = $kbbl_jumlah + $no_kbbl_jumlah;

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

            $denominator_lab = $lab_jumlah + $no_lab_jumlah;

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

            $denominator_laundry = $laundry_jumlah + $no_laundry_jumlah;

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

            $denominator_ok = $ok_jumlah + $no_ok_jumlah;

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

            $denominator_lt2 = $lt2_jumlah + $no_lt2_jumlah;

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

            $denominator_lt4 = $lt4_jumlah + $no_lt4_jumlah;

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

            $denominator_lt5 = $lt5_jumlah + $no_lt5_jumlah;

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

            $denominator_poli = $poli_jumlah + $no_poli_jumlah;

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

            $denominator_rad = $rad_jumlah + $no_rad_jumlah;

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

            $denominator_vk = $vk_jumlah + $no_vk_jumlah;

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
                $cssu_jumlah,

                $no_cssu_sbl_kon_psn,
                $no_cssu_sbl_tin_aseptik,
                $no_cssu_stl_kon_cairan,
                $no_cssu_stl_kon_psn,
                $no_cssu_stl_kon_ling_psn,
                $no_cssu_hr,
                $no_cssu_hw,
                $no_cssu_gagal,
                $no_cssu_st,
                $no_cssu_jumlah,

                $denominator_cssu,

                $dapur_sbl_kon_psn,
                $dapur_sbl_tin_aseptik,
                $dapur_stl_kon_cairan,
                $dapur_stl_kon_psn,
                $dapur_stl_kon_ling_psn,
                $dapur_hr,
                $dapur_hw,
                $dapur_gagal,
                $dapur_st,
                $dapur_jumlah,

                $no_dapur_sbl_kon_psn,
                $no_dapur_sbl_tin_aseptik,
                $no_dapur_stl_kon_cairan,
                $no_dapur_stl_kon_psn,
                $no_dapur_stl_kon_ling_psn,
                $no_dapur_hr,
                $no_dapur_hw,
                $no_dapur_gagal,
                $no_dapur_st,
                $no_dapur_jumlah,

                $denominator_dapur,

                $dpjp_sbl_kon_psn,
                $dpjp_sbl_tin_aseptik,
                $dpjp_stl_kon_cairan,
                $dpjp_stl_kon_psn,
                $dpjp_stl_kon_ling_psn,
                $dpjp_hr,
                $dpjp_hw,
                $dpjp_gagal,
                $dpjp_st,
                $dpjp_jumlah,

                $no_dpjp_sbl_kon_psn,
                $no_dpjp_sbl_tin_aseptik,
                $no_dpjp_stl_kon_cairan,
                $no_dpjp_stl_kon_psn,
                $no_dpjp_stl_kon_ling_psn,
                $no_dpjp_hr,
                $no_dpjp_hw,
                $no_dpjp_gagal,
                $no_dpjp_st,
                $no_dpjp_jumlah,

                $denominator_dpjp,

                $farmasi_sbl_kon_psn,
                $farmasi_sbl_tin_aseptik,
                $farmasi_stl_kon_cairan,
                $farmasi_stl_kon_psn,
                $farmasi_stl_kon_ling_psn,
                $farmasi_hr,
                $farmasi_hw,
                $farmasi_gagal,
                $farmasi_st,
                $farmasi_jumlah,

                $no_farmasi_sbl_kon_psn,
                $no_farmasi_sbl_tin_aseptik,
                $no_farmasi_stl_kon_cairan,
                $no_farmasi_stl_kon_psn,
                $no_farmasi_stl_kon_ling_psn,
                $no_farmasi_hr,
                $no_farmasi_hw,
                $no_farmasi_gagal,
                $no_farmasi_st,
                $no_farmasi_jumlah,

                $denominator_farmasi,

                $igd_sbl_kon_psn,
                $igd_sbl_tin_aseptik,
                $igd_stl_kon_cairan,
                $igd_stl_kon_psn,
                $igd_stl_kon_ling_psn,
                $igd_hr,
                $igd_hw,
                $igd_gagal,
                $igd_st,
                $igd_jumlah,

                $no_igd_sbl_kon_psn,
                $no_igd_sbl_tin_aseptik,
                $no_igd_stl_kon_cairan,
                $no_igd_stl_kon_psn,
                $no_igd_stl_kon_ling_psn,
                $no_igd_hr,
                $no_igd_hw,
                $no_igd_gagal,
                $no_igd_st,
                $no_igd_jumlah,

                $denominator_igd,

                $int_sbl_kon_psn,
                $int_sbl_tin_aseptik,
                $int_stl_kon_cairan,
                $int_stl_kon_psn,
                $int_stl_kon_ling_psn,
                $int_hr,
                $int_hw,
                $int_gagal,
                $int_st,
                $int_jumlah,

                $no_int_sbl_kon_psn,
                $no_int_sbl_tin_aseptik,
                $no_int_stl_kon_cairan,
                $no_int_stl_kon_psn,
                $no_int_stl_kon_ling_psn,
                $no_int_hr,
                $no_int_hw,
                $no_int_gagal,
                $no_int_st,
                $no_int_jumlah,

                $denominator_int,

                $kebersihan_sbl_kon_psn,
                $kebersihan_sbl_tin_aseptik,
                $kebersihan_stl_kon_cairan,
                $kebersihan_stl_kon_psn,
                $kebersihan_stl_kon_ling_psn,
                $kebersihan_hr,
                $kebersihan_hw,
                $kebersihan_gagal,
                $kebersihan_st,
                $kebersihan_jumlah,

                $no_kebersihan_sbl_kon_psn,
                $no_kebersihan_sbl_tin_aseptik,
                $no_kebersihan_stl_kon_cairan,
                $no_kebersihan_stl_kon_psn,
                $no_kebersihan_stl_kon_ling_psn,
                $no_kebersihan_hr,
                $no_kebersihan_hw,
                $no_kebersihan_gagal,
                $no_kebersihan_st,
                $no_kebersihan_jumlah,

                $denominator_kebersihan,

                $kbbl_sbl_kon_psn,
                $kbbl_sbl_tin_aseptik,
                $kbbl_stl_kon_cairan,
                $kbbl_stl_kon_psn,
                $kbbl_stl_kon_ling_psn,
                $kbbl_hr,
                $kbbl_hw,
                $kbbl_gagal,
                $kbbl_st,
                $kbbl_jumlah,

                $no_kbbl_sbl_kon_psn,
                $no_kbbl_sbl_tin_aseptik,
                $no_kbbl_stl_kon_cairan,
                $no_kbbl_stl_kon_psn,
                $no_kbbl_stl_kon_ling_psn,
                $no_kbbl_hr,
                $no_kbbl_hw,
                $no_kbbl_gagal,
                $no_kbbl_st,
                $no_kbbl_jumlah,

                $denominator_kbbl,

                $lab_sbl_kon_psn,
                $lab_sbl_tin_aseptik,
                $lab_stl_kon_cairan,
                $lab_stl_kon_psn,
                $lab_stl_kon_ling_psn,
                $lab_hr,
                $lab_hw,
                $lab_gagal,
                $lab_st,
                $lab_jumlah,

                $no_lab_sbl_kon_psn,
                $no_lab_sbl_tin_aseptik,
                $no_lab_stl_kon_cairan,
                $no_lab_stl_kon_psn,
                $no_lab_stl_kon_ling_psn,
                $no_lab_hr,
                $no_lab_hw,
                $no_lab_gagal,
                $no_lab_st,
                $no_lab_jumlah,

                $denominator_lab,

                $laundry_sbl_kon_psn,
                $laundry_sbl_tin_aseptik,
                $laundry_stl_kon_cairan,
                $laundry_stl_kon_psn,
                $laundry_stl_kon_ling_psn,
                $laundry_hr,
                $laundry_hw,
                $laundry_gagal,
                $laundry_st,
                $laundry_jumlah,

                $no_laundry_sbl_kon_psn,
                $no_laundry_sbl_tin_aseptik,
                $no_laundry_stl_kon_cairan,
                $no_laundry_stl_kon_psn,
                $no_laundry_stl_kon_ling_psn,
                $no_laundry_hr,
                $no_laundry_hw,
                $no_laundry_gagal,
                $no_laundry_st,
                $no_laundry_jumlah,

                $denominator_laundry,

                $ok_sbl_kon_psn,
                $ok_sbl_tin_aseptik,
                $ok_stl_kon_cairan,
                $ok_stl_kon_psn,
                $ok_stl_kon_ling_psn,
                $ok_hr,
                $ok_hw,
                $ok_gagal,
                $ok_st,
                $ok_jumlah,

                $no_ok_sbl_kon_psn,
                $no_ok_sbl_tin_aseptik,
                $no_ok_stl_kon_cairan,
                $no_ok_stl_kon_psn,
                $no_ok_stl_kon_ling_psn,
                $no_ok_hr,
                $no_ok_hw,
                $no_ok_gagal,
                $no_ok_st,
                $no_ok_jumlah,

                $denominator_ok,

                $lt2_sbl_kon_psn,
                $lt2_sbl_tin_aseptik,
                $lt2_stl_kon_cairan,
                $lt2_stl_kon_psn,
                $lt2_stl_kon_ling_psn,
                $lt2_hr,
                $lt2_hw,
                $lt2_gagal,
                $lt2_st,
                $lt2_jumlah,

                $no_lt2_sbl_kon_psn,
                $no_lt2_sbl_tin_aseptik,
                $no_lt2_stl_kon_cairan,
                $no_lt2_stl_kon_psn,
                $no_lt2_stl_kon_ling_psn,
                $no_lt2_hr,
                $no_lt2_hw,
                $no_lt2_gagal,
                $no_lt2_st,
                $no_lt2_jumlah,

                $denominator_lt2,

                $lt4_sbl_kon_psn,
                $lt4_sbl_tin_aseptik,
                $lt4_stl_kon_cairan,
                $lt4_stl_kon_psn,
                $lt4_stl_kon_ling_psn,
                $lt4_hr,
                $lt4_hw,
                $lt4_gagal,
                $lt4_st,
                $lt4_jumlah,

                $no_lt4_sbl_kon_psn,
                $no_lt4_sbl_tin_aseptik,
                $no_lt4_stl_kon_cairan,
                $no_lt4_stl_kon_psn,
                $no_lt4_stl_kon_ling_psn,
                $no_lt4_hr,
                $no_lt4_hw,
                $no_lt4_gagal,
                $no_lt4_st,
                $no_lt4_jumlah,

                $denominator_lt4,

                $lt5_sbl_kon_psn,
                $lt5_sbl_tin_aseptik,
                $lt5_stl_kon_cairan,
                $lt5_stl_kon_psn,
                $lt5_stl_kon_ling_psn,
                $lt5_hr,
                $lt5_hw,
                $lt5_gagal,
                $lt5_st,
                $lt5_jumlah,

                $no_lt5_sbl_kon_psn,
                $no_lt5_sbl_tin_aseptik,
                $no_lt5_stl_kon_cairan,
                $no_lt5_stl_kon_psn,
                $no_lt5_stl_kon_ling_psn,
                $no_lt5_hr,
                $no_lt5_hw,
                $no_lt5_gagal,
                $no_lt5_st,
                $no_lt5_jumlah,

                $denominator_lt5,

                $poli_sbl_kon_psn,
                $poli_sbl_tin_aseptik,
                $poli_stl_kon_cairan,
                $poli_stl_kon_psn,
                $poli_stl_kon_ling_psn,
                $poli_hr,
                $poli_hw,
                $poli_gagal,
                $poli_st,
                $poli_jumlah,

                $no_poli_sbl_kon_psn,
                $no_poli_sbl_tin_aseptik,
                $no_poli_stl_kon_cairan,
                $no_poli_stl_kon_psn,
                $no_poli_stl_kon_ling_psn,
                $no_poli_hr,
                $no_poli_hw,
                $no_poli_gagal,
                $no_poli_st,
                $no_poli_jumlah,

                $denominator_poli,

                $rad_sbl_kon_psn,
                $rad_sbl_tin_aseptik,
                $rad_stl_kon_cairan,
                $rad_stl_kon_psn,
                $rad_stl_kon_ling_psn,
                $rad_hr,
                $rad_hw,
                $rad_gagal,
                $rad_st,
                $rad_jumlah,

                $no_rad_sbl_kon_psn,
                $no_rad_sbl_tin_aseptik,
                $no_rad_stl_kon_cairan,
                $no_rad_stl_kon_psn,
                $no_rad_stl_kon_ling_psn,
                $no_rad_hr,
                $no_rad_hw,
                $no_rad_gagal,
                $no_rad_st,
                $no_rad_jumlah,

                $denominator_rad,

                $vk_sbl_kon_psn,
                $vk_sbl_tin_aseptik,
                $vk_stl_kon_cairan,
                $vk_stl_kon_psn,
                $vk_stl_kon_ling_psn,
                $vk_hr,
                $vk_hw,
                $vk_gagal,
                $vk_st,
                $vk_jumlah,

                $no_vk_sbl_kon_psn,
                $no_vk_sbl_tin_aseptik,
                $no_vk_stl_kon_cairan,
                $no_vk_stl_kon_psn,
                $no_vk_stl_kon_ling_psn,
                $no_vk_hr,
                $no_vk_hw,
                $no_vk_gagal,
                $no_vk_st,
                $no_vk_jumlah,

                $denominator_vk,

                $tabel,
                $rekap,
                $tanggal
            ), 'Rekap Cuci Tangan ' . $tanggal . '.pdf', \Maatwebsite\Excel\Excel::MPDF);
        } else {
            return Redirect::back()->withErrors(['msg' => 'Tanggal tidak boleh Lebih kecil dari sebelumnya']);
        }
    }
}
