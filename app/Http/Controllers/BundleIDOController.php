<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\BundleIDO;
use Illuminate\Http\Request;
use App\Models\RekapBundleIdo;
use App\Exports\ExportBundleIDO;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Redirect;

class BundleIDOController extends Controller
{
    public function index()
    {
        return view('bundleIDO.index');
    }

    public function getData()
    {
        $bundleIDO = BundleIDO::latest('id')->paginate(10);

        return view('bundleIDO.index')->with('bundleIDO', $bundleIDO);
    }

    public function save(Request $request)
    {
        $data = new BundleIDO();
        $data->mrn = $request->input('mrn');
        $data->nama_pasien = $request->input('nama_pasien');
        $data->diagnosa = $request->input('diagnosa');
        $data->tindakan = $request->input('tindakan');
        $data->unit = $request->input('unit');
        $data->tgl = $request->input('tgl');
        $data->IDO04A01 = $request->input('IDO04A01');
        $data->IDO04A02 = $request->input('IDO04A02');
        $data->IDO04A03 = $request->input('IDO04A03');
        $data->IDO04A04 = $request->input('IDO04A04');
        $data->IDO04A05 = $request->input('IDO04A05');
        $data->IDO04A06 = $request->input('IDO04A06');
        $data->IDO04A07 = $request->input('IDO04A07');
        $data->IDO04A08 = $request->input('IDO04A08');
        $data->IDO04B01 = $request->input('IDO04B01');
        $data->IDO04B02 = $request->input('IDO04B02');
        $data->IDO04B03 = $request->input('IDO04B03');
        $data->IDO05A01 = $request->input('IDO05A01');
        $data->IDO05A02 = $request->input('IDO05A02');
        $data->IDO05A03 = $request->input('IDO05A03');
        $data->IDO05A04 = $request->input('IDO05A04');
        $data->IDO05B01 = $request->input('IDO05B01');
        $data->IDO05B02 = $request->input('IDO05B02');
        $data->IDO05B03 = $request->input('IDO05B03');
        $data->IDO05B04 = $request->input('IDO05B04');
        $data->IDO0601 = $request->input('IDO0601');
        $data->IDO0602 = $request->input('IDO0602');
        $data->IDO0603 = $request->input('IDO0603');
        $data->IDO0604 = $request->input('IDO0604');
        $data->save();

        return redirect('/bundleIdo')->with('success', 'Data berhasil disimpan!');
    }

    public function update(Request $request, $id)
    {
        $bundleIDO = BundleIDO::find($id);
        $input = $request->all();
        $bundleIDO->fill($input)->save();

        return redirect('/bundleIdo');
    }

    public function destroy($id)
    {
        $bundleIDO = BundleIDO::find($id);
        $bundleIDO->delete();

        return redirect('/bundleIdo');
    }

    public function inputRekap(Request $request)
    {
        $tgl_skg = date('Y-m-d');

        $data = new RekapBundleIdo();
        $data->dari = $request->input('dari') ?? $tgl_skg;
        $data->sampai = $request->input('sampai') ?? $tgl_skg;
        $data->analisa = $request->input('analisa');
        $data->tindak_lanjut = $request->input('tindak_lanjut');
        $data->save();

        return redirect('/rekapBundleIdo')->with('success', 'Data berhasil disimpan!');
    }

    public function updateRekap(Request $request, $id)
    {
        $rekap = RekapBundleIdo::find($id);
        $input = $request->all();
        $rekap->fill($input)->save();

        return redirect('/rekapBundleIdo');
    }

    public function rekap(Request $request)
    {
        $tgl_skg = date('Y-m-d');
        $dari = date_create($request->input('dari'));
        $sampai = date_create($request->input('sampai'));
        $diff  = date_diff($dari, $sampai);
        $range_tgl = $diff->d + 1;

        if ($request->input('dari') <= $request->input('sampai')) {
            $tabel = BundleIDO::whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')->paginate(1000);
            // dd($tabel);

            $rekap = RekapBundleIdo::whereDate('dari', '=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('sampai', '=', $request->input('sampai') ?? $tgl_skg)
                ->get();

            $analisa = RekapBundleIdo::select('analisa')
                ->whereDate('dari', '=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('sampai', '=', $request->input('sampai') ?? $tgl_skg)
                ->get();

            $tindak_lanjut = RekapBundleIdo::select('tindak_lanjut')
                ->whereDate('dari', '=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('sampai', '=', $request->input('sampai') ?? $tgl_skg)
                ->get();

            $igd = BundleIDO::where('unit', 'IGD')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $int = BundleIDO::where('unit', 'Intensif')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $ok = BundleIDO::where('unit', 'OK')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt2 = BundleIDO::whereIn('unit', ['Perawatan Eksekutif lt.2', 'Perawatan Padma'])
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt4 = BundleIDO::where('unit', 'Perawatan Reguler lt.4')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt5 = BundleIDO::where('unit', 'Perawatan Reguler lt.5')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $vk = BundleIDO::where('unit', 'VK')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();

            $igd_IDO04A01 = $igd->where('IDO04A01', '1')->count();
            $igd_IDO04A02 = $igd->where('IDO04A02', '1')->count();
            $igd_IDO04A03 = $igd->where('IDO04A03', '1')->count();
            $igd_IDO04A04 = $igd->where('IDO04A04', '1')->count();
            $igd_IDO04A05 = $igd->where('IDO04A05', '1')->count();
            $igd_IDO04A06 = $igd->where('IDO04A06', '1')->count();
            $igd_IDO04A07 = $igd->where('IDO04A07', '1')->count();
            $igd_IDO04A08 = $igd->where('IDO04A08', '1')->count();
            $igd_IDO04B01 = $igd->where('IDO04B01', '1')->count();
            $igd_IDO04B02 = $igd->where('IDO04B01', '1')->count();
            $igd_IDO04B03 = $igd->where('IDO04B01', '1')->count();
            $igd_IDO05A01 = $igd->where('IDO05A01', '1')->count();
            $igd_IDO05A02 = $igd->where('IDO05A02', '1')->count();
            $igd_IDO05A03 = $igd->where('IDO05A03', '1')->count();
            $igd_IDO05A04 = $igd->where('IDO05A04', '1')->count();
            $igd_IDO05B01 = $igd->where('IDO05B01', '1')->count();
            $igd_IDO05B02 = $igd->where('IDO05B02', '1')->count();
            $igd_IDO05B03 = $igd->where('IDO05B03', '1')->count();
            $igd_IDO05B04 = $igd->where('IDO05B04', '1')->count();
            $igd_IDO0601 = $igd->where('IDO0601', '1')->count();
            $igd_IDO0602 = $igd->where('IDO0602', '1')->count();
            $igd_IDO0603 = $igd->where('IDO0603', '1')->count();
            $igd_IDO0604 = $igd->where('IDO0604', '1')->count();
            $igd_jumlah = $igd_IDO04A01 + $igd_IDO04A02 + $igd_IDO04A03 + $igd_IDO04A04 + $igd_IDO04A05 + $igd_IDO04A06 + $igd_IDO04A07 + $igd_IDO04A08 + $igd_IDO04B01 + $igd_IDO04B02 + $igd_IDO04B03 + $igd_IDO05A01 + $igd_IDO05A02 + $igd_IDO05A03 + $igd_IDO05A04 + $igd_IDO05B01 + $igd_IDO05B02 + $igd_IDO05B03 + $igd_IDO05B04 + $igd_IDO0601 + $igd_IDO0602 + $igd_IDO0603 + $igd_IDO0604;

            $no_igd_IDO04A01 = $igd->where('IDO04A01', '0')->count();
            $no_igd_IDO04A02 = $igd->where('IDO04A02', '0')->count();
            $no_igd_IDO04A03 = $igd->where('IDO04A03', '0')->count();
            $no_igd_IDO04A04 = $igd->where('IDO04A04', '0')->count();
            $no_igd_IDO04A05 = $igd->where('IDO04A05', '0')->count();
            $no_igd_IDO04A06 = $igd->where('IDO04A06', '0')->count();
            $no_igd_IDO04A07 = $igd->where('IDO04A07', '0')->count();
            $no_igd_IDO04A08 = $igd->where('IDO04A08', '0')->count();
            $no_igd_IDO04B01 = $igd->where('IDO04B01', '0')->count();
            $no_igd_IDO04B02 = $igd->where('IDO04B01', '0')->count();
            $no_igd_IDO04B03 = $igd->where('IDO04B01', '0')->count();
            $no_igd_IDO05A01 = $igd->where('IDO05A01', '0')->count();
            $no_igd_IDO05A02 = $igd->where('IDO05A02', '0')->count();
            $no_igd_IDO05A03 = $igd->where('IDO05A03', '0')->count();
            $no_igd_IDO05A04 = $igd->where('IDO05A04', '0')->count();
            $no_igd_IDO05B01 = $igd->where('IDO05B01', '0')->count();
            $no_igd_IDO05B02 = $igd->where('IDO05B02', '0')->count();
            $no_igd_IDO05B03 = $igd->where('IDO05B03', '0')->count();
            $no_igd_IDO05B04 = $igd->where('IDO05B04', '0')->count();
            $no_igd_IDO0601 = $igd->where('IDO0601', '0')->count();
            $no_igd_IDO0602 = $igd->where('IDO0602', '0')->count();
            $no_igd_IDO0603 = $igd->where('IDO0603', '0')->count();
            $no_igd_IDO0604 = $igd->where('IDO0604', '0')->count();
            $no_igd_jumlah = $no_igd_IDO04A01 + $no_igd_IDO04A02 + $no_igd_IDO04A03 + $no_igd_IDO04A04 + $no_igd_IDO04A05 + $no_igd_IDO04A06 + $no_igd_IDO04A07 + $no_igd_IDO04A08 + $no_igd_IDO04B01 + $no_igd_IDO04B02 + $no_igd_IDO04B03 + $no_igd_IDO05A01 + $no_igd_IDO05A02 + $no_igd_IDO05A03 + $no_igd_IDO05A04 + $no_igd_IDO05B01 + $no_igd_IDO05B02 + $no_igd_IDO05B03 + $no_igd_IDO05B04 + $no_igd_IDO0601 + $no_igd_IDO0602 + $no_igd_IDO0603 + $no_igd_IDO0604;

            $denominator_igd = $igd_jumlah + $no_igd_jumlah;

            $int_IDO04A01 = $int->where('IDO04A01', '1')->count();
            $int_IDO04A02 = $int->where('IDO04A02', '1')->count();
            $int_IDO04A03 = $int->where('IDO04A03', '1')->count();
            $int_IDO04A04 = $int->where('IDO04A04', '1')->count();
            $int_IDO04A05 = $int->where('IDO04A05', '1')->count();
            $int_IDO04A06 = $int->where('IDO04A06', '1')->count();
            $int_IDO04A07 = $int->where('IDO04A07', '1')->count();
            $int_IDO04A08 = $int->where('IDO04A08', '1')->count();
            $int_IDO04B01 = $int->where('IDO04B01', '1')->count();
            $int_IDO04B02 = $int->where('IDO04B01', '1')->count();
            $int_IDO04B03 = $int->where('IDO04B01', '1')->count();
            $int_IDO05A01 = $int->where('IDO05A01', '1')->count();
            $int_IDO05A02 = $int->where('IDO05A02', '1')->count();
            $int_IDO05A03 = $int->where('IDO05A03', '1')->count();
            $int_IDO05A04 = $int->where('IDO05A04', '1')->count();
            $int_IDO05B01 = $int->where('IDO05B01', '1')->count();
            $int_IDO05B02 = $int->where('IDO05B02', '1')->count();
            $int_IDO05B03 = $int->where('IDO05B03', '1')->count();
            $int_IDO05B04 = $int->where('IDO05B04', '1')->count();
            $int_IDO0601 = $int->where('IDO0601', '1')->count();
            $int_IDO0602 = $int->where('IDO0602', '1')->count();
            $int_IDO0603 = $int->where('IDO0603', '1')->count();
            $int_IDO0604 = $int->where('IDO0604', '1')->count();
            $int_jumlah = $int_IDO04A01 + $int_IDO04A02 + $int_IDO04A03 + $int_IDO04A04 + $int_IDO04A05 + $int_IDO04A06 + $int_IDO04A07 + $int_IDO04A08 + $int_IDO04B01 + $int_IDO04B02 + $int_IDO04B03 + $int_IDO05A01 + $int_IDO05A02 + $int_IDO05A03 + $int_IDO05A04 + $int_IDO05B01 + $int_IDO05B02 + $int_IDO05B03 + $int_IDO05B04 + $int_IDO0601 + $int_IDO0602 + $int_IDO0603 + $int_IDO0604;

            $no_int_IDO04A01 = $int->where('IDO04A01', '0')->count();
            $no_int_IDO04A02 = $int->where('IDO04A02', '0')->count();
            $no_int_IDO04A03 = $int->where('IDO04A03', '0')->count();
            $no_int_IDO04A04 = $int->where('IDO04A04', '0')->count();
            $no_int_IDO04A05 = $int->where('IDO04A05', '0')->count();
            $no_int_IDO04A06 = $int->where('IDO04A06', '0')->count();
            $no_int_IDO04A07 = $int->where('IDO04A07', '0')->count();
            $no_int_IDO04A08 = $int->where('IDO04A08', '0')->count();
            $no_int_IDO04B01 = $int->where('IDO04B01', '0')->count();
            $no_int_IDO04B02 = $int->where('IDO04B01', '0')->count();
            $no_int_IDO04B03 = $int->where('IDO04B01', '0')->count();
            $no_int_IDO05A01 = $int->where('IDO05A01', '0')->count();
            $no_int_IDO05A02 = $int->where('IDO05A02', '0')->count();
            $no_int_IDO05A03 = $int->where('IDO05A03', '0')->count();
            $no_int_IDO05A04 = $int->where('IDO05A04', '0')->count();
            $no_int_IDO05B01 = $int->where('IDO05B01', '0')->count();
            $no_int_IDO05B02 = $int->where('IDO05B02', '0')->count();
            $no_int_IDO05B03 = $int->where('IDO05B03', '0')->count();
            $no_int_IDO05B04 = $int->where('IDO05B04', '0')->count();
            $no_int_IDO0601 = $int->where('IDO0601', '0')->count();
            $no_int_IDO0602 = $int->where('IDO0602', '0')->count();
            $no_int_IDO0603 = $int->where('IDO0603', '0')->count();
            $no_int_IDO0604 = $int->where('IDO0604', '0')->count();
            $no_int_jumlah = $no_int_IDO04A01 + $no_int_IDO04A02 + $no_int_IDO04A03 + $no_int_IDO04A04 + $no_int_IDO04A05 + $no_int_IDO04A06 + $no_int_IDO04A07 + $no_int_IDO04A08 + $no_int_IDO04B01 + $no_int_IDO04B02 + $no_int_IDO04B03 + $no_int_IDO05A01 + $no_int_IDO05A02 + $no_int_IDO05A03 + $no_int_IDO05A04 + $no_int_IDO05B01 + $no_int_IDO05B02 + $no_int_IDO05B03 + $no_int_IDO05B04 + $no_int_IDO0601 + $no_int_IDO0602 + $no_int_IDO0603 + $no_int_IDO0604;

            $denominator_int = $int_jumlah + $no_int_jumlah;

            $ok_IDO04A01 = $ok->where('IDO04A01', '1')->count();
            $ok_IDO04A02 = $ok->where('IDO04A02', '1')->count();
            $ok_IDO04A03 = $ok->where('IDO04A03', '1')->count();
            $ok_IDO04A04 = $ok->where('IDO04A04', '1')->count();
            $ok_IDO04A05 = $ok->where('IDO04A05', '1')->count();
            $ok_IDO04A06 = $ok->where('IDO04A06', '1')->count();
            $ok_IDO04A07 = $ok->where('IDO04A07', '1')->count();
            $ok_IDO04A08 = $ok->where('IDO04A08', '1')->count();
            $ok_IDO04B01 = $ok->where('IDO04B01', '1')->count();
            $ok_IDO04B02 = $ok->where('IDO04B01', '1')->count();
            $ok_IDO04B03 = $ok->where('IDO04B01', '1')->count();
            $ok_IDO05A01 = $ok->where('IDO05A01', '1')->count();
            $ok_IDO05A02 = $ok->where('IDO05A02', '1')->count();
            $ok_IDO05A03 = $ok->where('IDO05A03', '1')->count();
            $ok_IDO05A04 = $ok->where('IDO05A04', '1')->count();
            $ok_IDO05B01 = $ok->where('IDO05B01', '1')->count();
            $ok_IDO05B02 = $ok->where('IDO05B02', '1')->count();
            $ok_IDO05B03 = $ok->where('IDO05B03', '1')->count();
            $ok_IDO05B04 = $ok->where('IDO05B04', '1')->count();
            $ok_IDO0601 = $ok->where('IDO0601', '1')->count();
            $ok_IDO0602 = $ok->where('IDO0602', '1')->count();
            $ok_IDO0603 = $ok->where('IDO0603', '1')->count();
            $ok_IDO0604 = $ok->where('IDO0604', '1')->count();
            $ok_jumlah = $ok_IDO04A01 + $ok_IDO04A02 + $ok_IDO04A03 + $ok_IDO04A04 + $ok_IDO04A05 + $ok_IDO04A06 + $ok_IDO04A07 + $ok_IDO04A08 + $ok_IDO04B01 + $ok_IDO04B02 + $ok_IDO04B03 + $ok_IDO05A01 + $ok_IDO05A02 + $ok_IDO05A03 + $ok_IDO05A04 + $ok_IDO05B01 + $ok_IDO05B02 + $ok_IDO05B03 + $ok_IDO05B04 + $ok_IDO0601 + $ok_IDO0602 + $ok_IDO0603 + $ok_IDO0604;

            $no_ok_IDO04A01 = $ok->where('IDO04A01', '0')->count();
            $no_ok_IDO04A02 = $ok->where('IDO04A02', '0')->count();
            $no_ok_IDO04A03 = $ok->where('IDO04A03', '0')->count();
            $no_ok_IDO04A04 = $ok->where('IDO04A04', '0')->count();
            $no_ok_IDO04A05 = $ok->where('IDO04A05', '0')->count();
            $no_ok_IDO04A06 = $ok->where('IDO04A06', '0')->count();
            $no_ok_IDO04A07 = $ok->where('IDO04A07', '0')->count();
            $no_ok_IDO04A08 = $ok->where('IDO04A08', '0')->count();
            $no_ok_IDO04B01 = $ok->where('IDO04B01', '0')->count();
            $no_ok_IDO04B02 = $ok->where('IDO04B01', '0')->count();
            $no_ok_IDO04B03 = $ok->where('IDO04B01', '0')->count();
            $no_ok_IDO05A01 = $ok->where('IDO05A01', '0')->count();
            $no_ok_IDO05A02 = $ok->where('IDO05A02', '0')->count();
            $no_ok_IDO05A03 = $ok->where('IDO05A03', '0')->count();
            $no_ok_IDO05A04 = $ok->where('IDO05A04', '0')->count();
            $no_ok_IDO05B01 = $ok->where('IDO05B01', '0')->count();
            $no_ok_IDO05B02 = $ok->where('IDO05B02', '0')->count();
            $no_ok_IDO05B03 = $ok->where('IDO05B03', '0')->count();
            $no_ok_IDO05B04 = $ok->where('IDO05B04', '0')->count();
            $no_ok_IDO0601 = $ok->where('IDO0601', '0')->count();
            $no_ok_IDO0602 = $ok->where('IDO0602', '0')->count();
            $no_ok_IDO0603 = $ok->where('IDO0603', '0')->count();
            $no_ok_IDO0604 = $ok->where('IDO0604', '0')->count();
            $no_ok_jumlah = $no_ok_IDO04A01 + $no_ok_IDO04A02 + $no_ok_IDO04A03 + $no_ok_IDO04A04 + $no_ok_IDO04A05 + $no_ok_IDO04A06 + $no_ok_IDO04A07 + $no_ok_IDO04A08 + $no_ok_IDO04B01 + $no_ok_IDO04B02 + $no_ok_IDO04B03 + $no_ok_IDO05A01 + $no_ok_IDO05A02 + $no_ok_IDO05A03 + $no_ok_IDO05A04 + $no_ok_IDO05B01 + $no_ok_IDO05B02 + $no_ok_IDO05B03 + $no_ok_IDO05B04 + $no_ok_IDO0601 + $no_ok_IDO0602 + $no_ok_IDO0603 + $no_ok_IDO0604;

            $denominator_ok = $ok_jumlah + $no_ok_jumlah;

            $lt2_IDO04A01 = $lt2->where('IDO04A01', '1')->count();
            $lt2_IDO04A02 = $lt2->where('IDO04A02', '1')->count();
            $lt2_IDO04A03 = $lt2->where('IDO04A03', '1')->count();
            $lt2_IDO04A04 = $lt2->where('IDO04A04', '1')->count();
            $lt2_IDO04A05 = $lt2->where('IDO04A05', '1')->count();
            $lt2_IDO04A06 = $lt2->where('IDO04A06', '1')->count();
            $lt2_IDO04A07 = $lt2->where('IDO04A07', '1')->count();
            $lt2_IDO04A08 = $lt2->where('IDO04A08', '1')->count();
            $lt2_IDO04B01 = $lt2->where('IDO04B01', '1')->count();
            $lt2_IDO04B02 = $lt2->where('IDO04B01', '1')->count();
            $lt2_IDO04B03 = $lt2->where('IDO04B01', '1')->count();
            $lt2_IDO05A01 = $lt2->where('IDO05A01', '1')->count();
            $lt2_IDO05A02 = $lt2->where('IDO05A02', '1')->count();
            $lt2_IDO05A03 = $lt2->where('IDO05A03', '1')->count();
            $lt2_IDO05A04 = $lt2->where('IDO05A04', '1')->count();
            $lt2_IDO05B01 = $lt2->where('IDO05B01', '1')->count();
            $lt2_IDO05B02 = $lt2->where('IDO05B02', '1')->count();
            $lt2_IDO05B03 = $lt2->where('IDO05B03', '1')->count();
            $lt2_IDO05B04 = $lt2->where('IDO05B04', '1')->count();
            $lt2_IDO0601 = $lt2->where('IDO0601', '1')->count();
            $lt2_IDO0602 = $lt2->where('IDO0602', '1')->count();
            $lt2_IDO0603 = $lt2->where('IDO0603', '1')->count();
            $lt2_IDO0604 = $lt2->where('IDO0604', '1')->count();
            $lt2_jumlah = $lt2_IDO04A01 + $lt2_IDO04A02 + $lt2_IDO04A03 + $lt2_IDO04A04 + $lt2_IDO04A05 + $lt2_IDO04A06 + $lt2_IDO04A07 + $lt2_IDO04A08 + $lt2_IDO04B01 + $lt2_IDO04B02 + $lt2_IDO04B03 + $lt2_IDO05A01 + $lt2_IDO05A02 + $lt2_IDO05A03 + $lt2_IDO05A04 + $lt2_IDO05B01 + $lt2_IDO05B02 + $lt2_IDO05B03 + $lt2_IDO05B04 + $lt2_IDO0601 + $lt2_IDO0602 + $lt2_IDO0603 + $lt2_IDO0604;

            $no_lt2_IDO04A01 = $lt2->where('IDO04A01', '0')->count();
            $no_lt2_IDO04A02 = $lt2->where('IDO04A02', '0')->count();
            $no_lt2_IDO04A03 = $lt2->where('IDO04A03', '0')->count();
            $no_lt2_IDO04A04 = $lt2->where('IDO04A04', '0')->count();
            $no_lt2_IDO04A05 = $lt2->where('IDO04A05', '0')->count();
            $no_lt2_IDO04A06 = $lt2->where('IDO04A06', '0')->count();
            $no_lt2_IDO04A07 = $lt2->where('IDO04A07', '0')->count();
            $no_lt2_IDO04A08 = $lt2->where('IDO04A08', '0')->count();
            $no_lt2_IDO04B01 = $lt2->where('IDO04B01', '0')->count();
            $no_lt2_IDO04B02 = $lt2->where('IDO04B01', '0')->count();
            $no_lt2_IDO04B03 = $lt2->where('IDO04B01', '0')->count();
            $no_lt2_IDO05A01 = $lt2->where('IDO05A01', '0')->count();
            $no_lt2_IDO05A02 = $lt2->where('IDO05A02', '0')->count();
            $no_lt2_IDO05A03 = $lt2->where('IDO05A03', '0')->count();
            $no_lt2_IDO05A04 = $lt2->where('IDO05A04', '0')->count();
            $no_lt2_IDO05B01 = $lt2->where('IDO05B01', '0')->count();
            $no_lt2_IDO05B02 = $lt2->where('IDO05B02', '0')->count();
            $no_lt2_IDO05B03 = $lt2->where('IDO05B03', '0')->count();
            $no_lt2_IDO05B04 = $lt2->where('IDO05B04', '0')->count();
            $no_lt2_IDO0601 = $lt2->where('IDO0601', '0')->count();
            $no_lt2_IDO0602 = $lt2->where('IDO0602', '0')->count();
            $no_lt2_IDO0603 = $lt2->where('IDO0603', '0')->count();
            $no_lt2_IDO0604 = $lt2->where('IDO0604', '0')->count();
            $no_lt2_jumlah = $no_lt2_IDO04A01 + $no_lt2_IDO04A02 + $no_lt2_IDO04A03 + $no_lt2_IDO04A04 + $no_lt2_IDO04A05 + $no_lt2_IDO04A06 + $no_lt2_IDO04A07 + $no_lt2_IDO04A08 + $no_lt2_IDO04B01 + $no_lt2_IDO04B02 + $no_lt2_IDO04B03 + $no_lt2_IDO05A01 + $no_lt2_IDO05A02 + $no_lt2_IDO05A03 + $no_lt2_IDO05A04 + $no_lt2_IDO05B01 + $no_lt2_IDO05B02 + $no_lt2_IDO05B03 + $no_lt2_IDO05B04 + $no_lt2_IDO0601 + $no_lt2_IDO0602 + $no_lt2_IDO0603 + $no_lt2_IDO0604;

            $denominator_lt2 = $lt2_jumlah + $no_lt2_jumlah;

            $lt4_IDO04A01 = $lt4->where('IDO04A01', '1')->count();
            $lt4_IDO04A02 = $lt4->where('IDO04A02', '1')->count();
            $lt4_IDO04A03 = $lt4->where('IDO04A03', '1')->count();
            $lt4_IDO04A04 = $lt4->where('IDO04A04', '1')->count();
            $lt4_IDO04A05 = $lt4->where('IDO04A05', '1')->count();
            $lt4_IDO04A06 = $lt4->where('IDO04A06', '1')->count();
            $lt4_IDO04A07 = $lt4->where('IDO04A07', '1')->count();
            $lt4_IDO04A08 = $lt4->where('IDO04A08', '1')->count();
            $lt4_IDO04B01 = $lt4->where('IDO04B01', '1')->count();
            $lt4_IDO04B02 = $lt4->where('IDO04B01', '1')->count();
            $lt4_IDO04B03 = $lt4->where('IDO04B01', '1')->count();
            $lt4_IDO05A01 = $lt4->where('IDO05A01', '1')->count();
            $lt4_IDO05A02 = $lt4->where('IDO05A02', '1')->count();
            $lt4_IDO05A03 = $lt4->where('IDO05A03', '1')->count();
            $lt4_IDO05A04 = $lt4->where('IDO05A04', '1')->count();
            $lt4_IDO05B01 = $lt4->where('IDO05B01', '1')->count();
            $lt4_IDO05B02 = $lt4->where('IDO05B02', '1')->count();
            $lt4_IDO05B03 = $lt4->where('IDO05B03', '1')->count();
            $lt4_IDO05B04 = $lt4->where('IDO05B04', '1')->count();
            $lt4_IDO0601 = $lt4->where('IDO0601', '1')->count();
            $lt4_IDO0602 = $lt4->where('IDO0602', '1')->count();
            $lt4_IDO0603 = $lt4->where('IDO0603', '1')->count();
            $lt4_IDO0604 = $lt4->where('IDO0604', '1')->count();
            $lt4_jumlah = $lt4_IDO04A01 + $lt4_IDO04A02 + $lt4_IDO04A03 + $lt4_IDO04A04 + $lt4_IDO04A05 + $lt4_IDO04A06 + $lt4_IDO04A07 + $lt4_IDO04A08 + $lt4_IDO04B01 + $lt4_IDO04B02 + $lt4_IDO04B03 + $lt4_IDO05A01 + $lt4_IDO05A02 + $lt4_IDO05A03 + $lt4_IDO05A04 + $lt4_IDO05B01 + $lt4_IDO05B02 + $lt4_IDO05B03 + $lt4_IDO05B04 + $lt4_IDO0601 + $lt4_IDO0602 + $lt4_IDO0603 + $lt4_IDO0604;

            $no_lt4_IDO04A01 = $lt4->where('IDO04A01', '0')->count();
            $no_lt4_IDO04A02 = $lt4->where('IDO04A02', '0')->count();
            $no_lt4_IDO04A03 = $lt4->where('IDO04A03', '0')->count();
            $no_lt4_IDO04A04 = $lt4->where('IDO04A04', '0')->count();
            $no_lt4_IDO04A05 = $lt4->where('IDO04A05', '0')->count();
            $no_lt4_IDO04A06 = $lt4->where('IDO04A06', '0')->count();
            $no_lt4_IDO04A07 = $lt4->where('IDO04A07', '0')->count();
            $no_lt4_IDO04A08 = $lt4->where('IDO04A08', '0')->count();
            $no_lt4_IDO04B01 = $lt4->where('IDO04B01', '0')->count();
            $no_lt4_IDO04B02 = $lt4->where('IDO04B01', '0')->count();
            $no_lt4_IDO04B03 = $lt4->where('IDO04B01', '0')->count();
            $no_lt4_IDO05A01 = $lt4->where('IDO05A01', '0')->count();
            $no_lt4_IDO05A02 = $lt4->where('IDO05A02', '0')->count();
            $no_lt4_IDO05A03 = $lt4->where('IDO05A03', '0')->count();
            $no_lt4_IDO05A04 = $lt4->where('IDO05A04', '0')->count();
            $no_lt4_IDO05B01 = $lt4->where('IDO05B01', '0')->count();
            $no_lt4_IDO05B02 = $lt4->where('IDO05B02', '0')->count();
            $no_lt4_IDO05B03 = $lt4->where('IDO05B03', '0')->count();
            $no_lt4_IDO05B04 = $lt4->where('IDO05B04', '0')->count();
            $no_lt4_IDO0601 = $lt4->where('IDO0601', '0')->count();
            $no_lt4_IDO0602 = $lt4->where('IDO0602', '0')->count();
            $no_lt4_IDO0603 = $lt4->where('IDO0603', '0')->count();
            $no_lt4_IDO0604 = $lt4->where('IDO0604', '0')->count();
            $no_lt4_jumlah = $no_lt4_IDO04A01 + $no_lt4_IDO04A02 + $no_lt4_IDO04A03 + $no_lt4_IDO04A04 + $no_lt4_IDO04A05 + $no_lt4_IDO04A06 + $no_lt4_IDO04A07 + $no_lt4_IDO04A08 + $no_lt4_IDO04B01 + $no_lt4_IDO04B02 + $no_lt4_IDO04B03 + $no_lt4_IDO05A01 + $no_lt4_IDO05A02 + $no_lt4_IDO05A03 + $no_lt4_IDO05A04 + $no_lt4_IDO05B01 + $no_lt4_IDO05B02 + $no_lt4_IDO05B03 + $no_lt4_IDO05B04 + $no_lt4_IDO0601 + $no_lt4_IDO0602 + $no_lt4_IDO0603 + $no_lt4_IDO0604;

            $denominator_lt4 = $lt4_jumlah + $no_lt4_jumlah;

            $lt5_IDO04A01 = $lt5->where('IDO04A01', '1')->count();
            $lt5_IDO04A02 = $lt5->where('IDO04A02', '1')->count();
            $lt5_IDO04A03 = $lt5->where('IDO04A03', '1')->count();
            $lt5_IDO04A04 = $lt5->where('IDO04A04', '1')->count();
            $lt5_IDO04A05 = $lt5->where('IDO04A05', '1')->count();
            $lt5_IDO04A06 = $lt5->where('IDO04A06', '1')->count();
            $lt5_IDO04A07 = $lt5->where('IDO04A07', '1')->count();
            $lt5_IDO04A08 = $lt5->where('IDO04A08', '1')->count();
            $lt5_IDO04B01 = $lt5->where('IDO04B01', '1')->count();
            $lt5_IDO04B02 = $lt5->where('IDO04B01', '1')->count();
            $lt5_IDO04B03 = $lt5->where('IDO04B01', '1')->count();
            $lt5_IDO05A01 = $lt5->where('IDO05A01', '1')->count();
            $lt5_IDO05A02 = $lt5->where('IDO05A02', '1')->count();
            $lt5_IDO05A03 = $lt5->where('IDO05A03', '1')->count();
            $lt5_IDO05A04 = $lt5->where('IDO05A04', '1')->count();
            $lt5_IDO05B01 = $lt5->where('IDO05B01', '1')->count();
            $lt5_IDO05B02 = $lt5->where('IDO05B02', '1')->count();
            $lt5_IDO05B03 = $lt5->where('IDO05B03', '1')->count();
            $lt5_IDO05B04 = $lt5->where('IDO05B04', '1')->count();
            $lt5_IDO0601 = $lt5->where('IDO0601', '1')->count();
            $lt5_IDO0602 = $lt5->where('IDO0602', '1')->count();
            $lt5_IDO0603 = $lt5->where('IDO0603', '1')->count();
            $lt5_IDO0604 = $lt5->where('IDO0604', '1')->count();
            $lt5_jumlah = $lt5_IDO04A01 + $lt5_IDO04A02 + $lt5_IDO04A03 + $lt5_IDO04A04 + $lt5_IDO04A05 + $lt5_IDO04A06 + $lt5_IDO04A07 + $lt5_IDO04A08 + $lt5_IDO04B01 + $lt5_IDO04B02 + $lt5_IDO04B03 + $lt5_IDO05A01 + $lt5_IDO05A02 + $lt5_IDO05A03 + $lt5_IDO05A04 + $lt5_IDO05B01 + $lt5_IDO05B02 + $lt5_IDO05B03 + $lt5_IDO05B04 + $lt5_IDO0601 + $lt5_IDO0602 + $lt5_IDO0603 + $lt5_IDO0604;

            $no_lt5_IDO04A01 = $lt5->where('IDO04A01', '0')->count();
            $no_lt5_IDO04A02 = $lt5->where('IDO04A02', '0')->count();
            $no_lt5_IDO04A03 = $lt5->where('IDO04A03', '0')->count();
            $no_lt5_IDO04A04 = $lt5->where('IDO04A04', '0')->count();
            $no_lt5_IDO04A05 = $lt5->where('IDO04A05', '0')->count();
            $no_lt5_IDO04A06 = $lt5->where('IDO04A06', '0')->count();
            $no_lt5_IDO04A07 = $lt5->where('IDO04A07', '0')->count();
            $no_lt5_IDO04A08 = $lt5->where('IDO04A08', '0')->count();
            $no_lt5_IDO04B01 = $lt5->where('IDO04B01', '0')->count();
            $no_lt5_IDO04B02 = $lt5->where('IDO04B01', '0')->count();
            $no_lt5_IDO04B03 = $lt5->where('IDO04B01', '0')->count();
            $no_lt5_IDO05A01 = $lt5->where('IDO05A01', '0')->count();
            $no_lt5_IDO05A02 = $lt5->where('IDO05A02', '0')->count();
            $no_lt5_IDO05A03 = $lt5->where('IDO05A03', '0')->count();
            $no_lt5_IDO05A04 = $lt5->where('IDO05A04', '0')->count();
            $no_lt5_IDO05B01 = $lt5->where('IDO05B01', '0')->count();
            $no_lt5_IDO05B02 = $lt5->where('IDO05B02', '0')->count();
            $no_lt5_IDO05B03 = $lt5->where('IDO05B03', '0')->count();
            $no_lt5_IDO05B04 = $lt5->where('IDO05B04', '0')->count();
            $no_lt5_IDO0601 = $lt5->where('IDO0601', '0')->count();
            $no_lt5_IDO0602 = $lt5->where('IDO0602', '0')->count();
            $no_lt5_IDO0603 = $lt5->where('IDO0603', '0')->count();
            $no_lt5_IDO0604 = $lt5->where('IDO0604', '0')->count();
            $no_lt5_jumlah = $no_lt5_IDO04A01 + $no_lt5_IDO04A02 + $no_lt5_IDO04A03 + $no_lt5_IDO04A04 + $no_lt5_IDO04A05 + $no_lt5_IDO04A06 + $no_lt5_IDO04A07 + $no_lt5_IDO04A08 + $no_lt5_IDO04B01 + $no_lt5_IDO04B02 + $no_lt5_IDO04B03 + $no_lt5_IDO05A01 + $no_lt5_IDO05A02 + $no_lt5_IDO05A03 + $no_lt5_IDO05A04 + $no_lt5_IDO05B01 + $no_lt5_IDO05B02 + $no_lt5_IDO05B03 + $no_lt5_IDO05B04 + $no_lt5_IDO0601 + $no_lt5_IDO0602 + $no_lt5_IDO0603 + $no_lt5_IDO0604;

            $denominator_lt5 = $lt5_jumlah + $no_lt5_jumlah;

            $vk_IDO04A01 = $vk->where('IDO04A01', '1')->count();
            $vk_IDO04A02 = $vk->where('IDO04A02', '1')->count();
            $vk_IDO04A03 = $vk->where('IDO04A03', '1')->count();
            $vk_IDO04A04 = $vk->where('IDO04A04', '1')->count();
            $vk_IDO04A05 = $vk->where('IDO04A05', '1')->count();
            $vk_IDO04A06 = $vk->where('IDO04A06', '1')->count();
            $vk_IDO04A07 = $vk->where('IDO04A07', '1')->count();
            $vk_IDO04A08 = $vk->where('IDO04A08', '1')->count();
            $vk_IDO04B01 = $vk->where('IDO04B01', '1')->count();
            $vk_IDO04B02 = $vk->where('IDO04B01', '1')->count();
            $vk_IDO04B03 = $vk->where('IDO04B01', '1')->count();
            $vk_IDO05A01 = $vk->where('IDO05A01', '1')->count();
            $vk_IDO05A02 = $vk->where('IDO05A02', '1')->count();
            $vk_IDO05A03 = $vk->where('IDO05A03', '1')->count();
            $vk_IDO05A04 = $vk->where('IDO05A04', '1')->count();
            $vk_IDO05B01 = $vk->where('IDO05B01', '1')->count();
            $vk_IDO05B02 = $vk->where('IDO05B02', '1')->count();
            $vk_IDO05B03 = $vk->where('IDO05B03', '1')->count();
            $vk_IDO05B04 = $vk->where('IDO05B04', '1')->count();
            $vk_IDO0601 = $vk->where('IDO0601', '1')->count();
            $vk_IDO0602 = $vk->where('IDO0602', '1')->count();
            $vk_IDO0603 = $vk->where('IDO0603', '1')->count();
            $vk_IDO0604 = $vk->where('IDO0604', '1')->count();
            $vk_jumlah = $vk_IDO04A01 + $vk_IDO04A02 + $vk_IDO04A03 + $vk_IDO04A04 + $vk_IDO04A05 + $vk_IDO04A06 + $vk_IDO04A07 + $vk_IDO04A08 + $vk_IDO04B01 + $vk_IDO04B02 + $vk_IDO04B03 + $vk_IDO05A01 + $vk_IDO05A02 + $vk_IDO05A03 + $vk_IDO05A04 + $vk_IDO05B01 + $vk_IDO05B02 + $vk_IDO05B03 + $vk_IDO05B04 + $vk_IDO0601 + $vk_IDO0602 + $vk_IDO0603 + $vk_IDO0604;

            $no_vk_IDO04A01 = $vk->where('IDO04A01', '0')->count();
            $no_vk_IDO04A02 = $vk->where('IDO04A02', '0')->count();
            $no_vk_IDO04A03 = $vk->where('IDO04A03', '0')->count();
            $no_vk_IDO04A04 = $vk->where('IDO04A04', '0')->count();
            $no_vk_IDO04A05 = $vk->where('IDO04A05', '0')->count();
            $no_vk_IDO04A06 = $vk->where('IDO04A06', '0')->count();
            $no_vk_IDO04A07 = $vk->where('IDO04A07', '0')->count();
            $no_vk_IDO04A08 = $vk->where('IDO04A08', '0')->count();
            $no_vk_IDO04B01 = $vk->where('IDO04B01', '0')->count();
            $no_vk_IDO04B02 = $vk->where('IDO04B01', '0')->count();
            $no_vk_IDO04B03 = $vk->where('IDO04B01', '0')->count();
            $no_vk_IDO05A01 = $vk->where('IDO05A01', '0')->count();
            $no_vk_IDO05A02 = $vk->where('IDO05A02', '0')->count();
            $no_vk_IDO05A03 = $vk->where('IDO05A03', '0')->count();
            $no_vk_IDO05A04 = $vk->where('IDO05A04', '0')->count();
            $no_vk_IDO05B01 = $vk->where('IDO05B01', '0')->count();
            $no_vk_IDO05B02 = $vk->where('IDO05B02', '0')->count();
            $no_vk_IDO05B03 = $vk->where('IDO05B03', '0')->count();
            $no_vk_IDO05B04 = $vk->where('IDO05B04', '0')->count();
            $no_vk_IDO0601 = $vk->where('IDO0601', '0')->count();
            $no_vk_IDO0602 = $vk->where('IDO0602', '0')->count();
            $no_vk_IDO0603 = $vk->where('IDO0603', '0')->count();
            $no_vk_IDO0604 = $vk->where('IDO0604', '0')->count();
            $no_vk_jumlah = $no_vk_IDO04A01 + $no_vk_IDO04A02 + $no_vk_IDO04A03 + $no_vk_IDO04A04 + $no_vk_IDO04A05 + $no_vk_IDO04A06 + $no_vk_IDO04A07 + $no_vk_IDO04A08 + $no_vk_IDO04B01 + $no_vk_IDO04B02 + $no_vk_IDO04B03 + $no_vk_IDO05A01 + $no_vk_IDO05A02 + $no_vk_IDO05A03 + $no_vk_IDO05A04 + $no_vk_IDO05B01 + $no_vk_IDO05B02 + $no_vk_IDO05B03 + $no_vk_IDO05B04 + $no_vk_IDO0601 + $no_vk_IDO0602 + $no_vk_IDO0603 + $no_vk_IDO0604;

            $denominator_vk = $vk_jumlah + $no_vk_jumlah;

            return view('rekapBundleIDO.index', compact(
                'range_tgl',
                'tabel',
                'rekap',
                'analisa',
                'tindak_lanjut',

                'igd_IDO04A01',
                'igd_IDO04A02',
                'igd_IDO04A03',
                'igd_IDO04A04',
                'igd_IDO04A05',
                'igd_IDO04A06',
                'igd_IDO04A07',
                'igd_IDO04A08',
                'igd_IDO04B01',
                'igd_IDO04B02',
                'igd_IDO04B03',
                'igd_IDO05A01',
                'igd_IDO05A02',
                'igd_IDO05A03',
                'igd_IDO05A04',
                'igd_IDO05B01',
                'igd_IDO05B02',
                'igd_IDO05B03',
                'igd_IDO05B04',
                'igd_IDO0601',
                'igd_IDO0602',
                'igd_IDO0603',
                'igd_IDO0604',
                'igd_jumlah',

                'no_igd_IDO04A01',
                'no_igd_IDO04A02',
                'no_igd_IDO04A03',
                'no_igd_IDO04A04',
                'no_igd_IDO04A05',
                'no_igd_IDO04A06',
                'no_igd_IDO04A07',
                'no_igd_IDO04A08',
                'no_igd_IDO04B01',
                'no_igd_IDO04B02',
                'no_igd_IDO04B03',
                'no_igd_IDO05A01',
                'no_igd_IDO05A02',
                'no_igd_IDO05A03',
                'no_igd_IDO05A04',
                'no_igd_IDO05B01',
                'no_igd_IDO05B02',
                'no_igd_IDO05B03',
                'no_igd_IDO05B04',
                'no_igd_IDO0601',
                'no_igd_IDO0602',
                'no_igd_IDO0603',
                'no_igd_IDO0604',
                'no_igd_jumlah',

                'denominator_igd',

                'int_IDO04A01',
                'int_IDO04A02',
                'int_IDO04A03',
                'int_IDO04A04',
                'int_IDO04A05',
                'int_IDO04A06',
                'int_IDO04A07',
                'int_IDO04A08',
                'int_IDO04B01',
                'int_IDO04B02',
                'int_IDO04B03',
                'int_IDO05A01',
                'int_IDO05A02',
                'int_IDO05A03',
                'int_IDO05A04',
                'int_IDO05B01',
                'int_IDO05B02',
                'int_IDO05B03',
                'int_IDO05B04',
                'int_IDO0601',
                'int_IDO0602',
                'int_IDO0603',
                'int_IDO0604',
                'int_jumlah',

                'no_int_IDO04A01',
                'no_int_IDO04A02',
                'no_int_IDO04A03',
                'no_int_IDO04A04',
                'no_int_IDO04A05',
                'no_int_IDO04A06',
                'no_int_IDO04A07',
                'no_int_IDO04A08',
                'no_int_IDO04B01',
                'no_int_IDO04B02',
                'no_int_IDO04B03',
                'no_int_IDO05A01',
                'no_int_IDO05A02',
                'no_int_IDO05A03',
                'no_int_IDO05A04',
                'no_int_IDO05B01',
                'no_int_IDO05B02',
                'no_int_IDO05B03',
                'no_int_IDO05B04',
                'no_int_IDO0601',
                'no_int_IDO0602',
                'no_int_IDO0603',
                'no_int_IDO0604',
                'no_int_jumlah',

                'denominator_int',

                'ok_IDO04A01',
                'ok_IDO04A02',
                'ok_IDO04A03',
                'ok_IDO04A04',
                'ok_IDO04A05',
                'ok_IDO04A06',
                'ok_IDO04A07',
                'ok_IDO04A08',
                'ok_IDO04B01',
                'ok_IDO04B02',
                'ok_IDO04B03',
                'ok_IDO05A01',
                'ok_IDO05A02',
                'ok_IDO05A03',
                'ok_IDO05A04',
                'ok_IDO05B01',
                'ok_IDO05B02',
                'ok_IDO05B03',
                'ok_IDO05B04',
                'ok_IDO0601',
                'ok_IDO0602',
                'ok_IDO0603',
                'ok_IDO0604',
                'ok_jumlah',

                'no_ok_IDO04A01',
                'no_ok_IDO04A02',
                'no_ok_IDO04A03',
                'no_ok_IDO04A04',
                'no_ok_IDO04A05',
                'no_ok_IDO04A06',
                'no_ok_IDO04A07',
                'no_ok_IDO04A08',
                'no_ok_IDO04B01',
                'no_ok_IDO04B02',
                'no_ok_IDO04B03',
                'no_ok_IDO05A01',
                'no_ok_IDO05A02',
                'no_ok_IDO05A03',
                'no_ok_IDO05A04',
                'no_ok_IDO05B01',
                'no_ok_IDO05B02',
                'no_ok_IDO05B03',
                'no_ok_IDO05B04',
                'no_ok_IDO0601',
                'no_ok_IDO0602',
                'no_ok_IDO0603',
                'no_ok_IDO0604',
                'no_ok_jumlah',

                'denominator_ok',

                'lt2_IDO04A01',
                'lt2_IDO04A02',
                'lt2_IDO04A03',
                'lt2_IDO04A04',
                'lt2_IDO04A05',
                'lt2_IDO04A06',
                'lt2_IDO04A07',
                'lt2_IDO04A08',
                'lt2_IDO04B01',
                'lt2_IDO04B02',
                'lt2_IDO04B03',
                'lt2_IDO05A01',
                'lt2_IDO05A02',
                'lt2_IDO05A03',
                'lt2_IDO05A04',
                'lt2_IDO05B01',
                'lt2_IDO05B02',
                'lt2_IDO05B03',
                'lt2_IDO05B04',
                'lt2_IDO0601',
                'lt2_IDO0602',
                'lt2_IDO0603',
                'lt2_IDO0604',
                'lt2_jumlah',

                'no_lt2_IDO04A01',
                'no_lt2_IDO04A02',
                'no_lt2_IDO04A03',
                'no_lt2_IDO04A04',
                'no_lt2_IDO04A05',
                'no_lt2_IDO04A06',
                'no_lt2_IDO04A07',
                'no_lt2_IDO04A08',
                'no_lt2_IDO04B01',
                'no_lt2_IDO04B02',
                'no_lt2_IDO04B03',
                'no_lt2_IDO05A01',
                'no_lt2_IDO05A02',
                'no_lt2_IDO05A03',
                'no_lt2_IDO05A04',
                'no_lt2_IDO05B01',
                'no_lt2_IDO05B02',
                'no_lt2_IDO05B03',
                'no_lt2_IDO05B04',
                'no_lt2_IDO0601',
                'no_lt2_IDO0602',
                'no_lt2_IDO0603',
                'no_lt2_IDO0604',
                'no_lt2_jumlah',

                'denominator_lt2',

                'lt4_IDO04A01',
                'lt4_IDO04A02',
                'lt4_IDO04A03',
                'lt4_IDO04A04',
                'lt4_IDO04A05',
                'lt4_IDO04A06',
                'lt4_IDO04A07',
                'lt4_IDO04A08',
                'lt4_IDO04B01',
                'lt4_IDO04B02',
                'lt4_IDO04B03',
                'lt4_IDO05A01',
                'lt4_IDO05A02',
                'lt4_IDO05A03',
                'lt4_IDO05A04',
                'lt4_IDO05B01',
                'lt4_IDO05B02',
                'lt4_IDO05B03',
                'lt4_IDO05B04',
                'lt4_IDO0601',
                'lt4_IDO0602',
                'lt4_IDO0603',
                'lt4_IDO0604',
                'lt4_jumlah',

                'no_lt4_IDO04A01',
                'no_lt4_IDO04A02',
                'no_lt4_IDO04A03',
                'no_lt4_IDO04A04',
                'no_lt4_IDO04A05',
                'no_lt4_IDO04A06',
                'no_lt4_IDO04A07',
                'no_lt4_IDO04A08',
                'no_lt4_IDO04B01',
                'no_lt4_IDO04B02',
                'no_lt4_IDO04B03',
                'no_lt4_IDO05A01',
                'no_lt4_IDO05A02',
                'no_lt4_IDO05A03',
                'no_lt4_IDO05A04',
                'no_lt4_IDO05B01',
                'no_lt4_IDO05B02',
                'no_lt4_IDO05B03',
                'no_lt4_IDO05B04',
                'no_lt4_IDO0601',
                'no_lt4_IDO0602',
                'no_lt4_IDO0603',
                'no_lt4_IDO0604',
                'no_lt4_jumlah',
                'denominator_lt4',

                'lt5_IDO04A01',
                'lt5_IDO04A02',
                'lt5_IDO04A03',
                'lt5_IDO04A04',
                'lt5_IDO04A05',
                'lt5_IDO04A06',
                'lt5_IDO04A07',
                'lt5_IDO04A08',
                'lt5_IDO04B01',
                'lt5_IDO04B02',
                'lt5_IDO04B03',
                'lt5_IDO05A01',
                'lt5_IDO05A02',
                'lt5_IDO05A03',
                'lt5_IDO05A04',
                'lt5_IDO05B01',
                'lt5_IDO05B02',
                'lt5_IDO05B03',
                'lt5_IDO05B04',
                'lt5_IDO0601',
                'lt5_IDO0602',
                'lt5_IDO0603',
                'lt5_IDO0604',
                'lt5_jumlah',

                'no_lt5_IDO04A01',
                'no_lt5_IDO04A02',
                'no_lt5_IDO04A03',
                'no_lt5_IDO04A04',
                'no_lt5_IDO04A05',
                'no_lt5_IDO04A06',
                'no_lt5_IDO04A07',
                'no_lt5_IDO04A08',
                'no_lt5_IDO04B01',
                'no_lt5_IDO04B02',
                'no_lt5_IDO04B03',
                'no_lt5_IDO05A01',
                'no_lt5_IDO05A02',
                'no_lt5_IDO05A03',
                'no_lt5_IDO05A04',
                'no_lt5_IDO05B01',
                'no_lt5_IDO05B02',
                'no_lt5_IDO05B03',
                'no_lt5_IDO05B04',
                'no_lt5_IDO0601',
                'no_lt5_IDO0602',
                'no_lt5_IDO0603',
                'no_lt5_IDO0604',
                'no_lt5_jumlah',

                'denominator_lt5',

                'vk_IDO04A01',
                'vk_IDO04A02',
                'vk_IDO04A03',
                'vk_IDO04A04',
                'vk_IDO04A05',
                'vk_IDO04A06',
                'vk_IDO04A07',
                'vk_IDO04A08',
                'vk_IDO04B01',
                'vk_IDO04B02',
                'vk_IDO04B03',
                'vk_IDO05A01',
                'vk_IDO05A02',
                'vk_IDO05A03',
                'vk_IDO05A04',
                'vk_IDO05B01',
                'vk_IDO05B02',
                'vk_IDO05B03',
                'vk_IDO05B04',
                'vk_IDO0601',
                'vk_IDO0602',
                'vk_IDO0603',
                'vk_IDO0604',
                'vk_jumlah',

                'no_vk_IDO04A01',
                'no_vk_IDO04A02',
                'no_vk_IDO04A03',
                'no_vk_IDO04A04',
                'no_vk_IDO04A05',
                'no_vk_IDO04A06',
                'no_vk_IDO04A07',
                'no_vk_IDO04A08',
                'no_vk_IDO04B01',
                'no_vk_IDO04B02',
                'no_vk_IDO04B03',
                'no_vk_IDO05A01',
                'no_vk_IDO05A02',
                'no_vk_IDO05A03',
                'no_vk_IDO05A04',
                'no_vk_IDO05B01',
                'no_vk_IDO05B02',
                'no_vk_IDO05B03',
                'no_vk_IDO05B04',
                'no_vk_IDO0601',
                'no_vk_IDO0602',
                'no_vk_IDO0603',
                'no_vk_IDO0604',
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
            $tabel = BundleIDO::whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')->paginate(1000);
            // dd($tabel);

            $rekap = RekapBundleIdo::whereDate('dari', '=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('sampai', '=', $request->input('sampai') ?? $tgl_skg)
                ->get();

            $analisa = RekapBundleIdo::select('analisa')
                ->whereDate('dari', '=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('sampai', '=', $request->input('sampai') ?? $tgl_skg)
                ->get();

            $tindak_lanjut = RekapBundleIdo::select('tindak_lanjut')
                ->whereDate('dari', '=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('sampai', '=', $request->input('sampai') ?? $tgl_skg)
                ->get();

            $igd = BundleIDO::where('unit', 'IGD')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $int = BundleIDO::where('unit', 'Intensif')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $ok = BundleIDO::where('unit', 'OK')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt2 = BundleIDO::whereIn('unit', ['Perawatan Eksekutif lt.2', 'Perawatan Padma'])
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt4 = BundleIDO::where('unit', 'Perawatan Reguler lt.4')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt5 = BundleIDO::where('unit', 'Perawatan Reguler lt.5')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $vk = BundleIDO::where('unit', 'VK')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();

            $igd_IDO04A01 = $igd->where('IDO04A01', '1')->count();
            $igd_IDO04A02 = $igd->where('IDO04A02', '1')->count();
            $igd_IDO04A03 = $igd->where('IDO04A03', '1')->count();
            $igd_IDO04A04 = $igd->where('IDO04A04', '1')->count();
            $igd_IDO04A05 = $igd->where('IDO04A05', '1')->count();
            $igd_IDO04A06 = $igd->where('IDO04A06', '1')->count();
            $igd_IDO04A07 = $igd->where('IDO04A07', '1')->count();
            $igd_IDO04A08 = $igd->where('IDO04A08', '1')->count();
            $igd_IDO04B01 = $igd->where('IDO04B01', '1')->count();
            $igd_IDO04B02 = $igd->where('IDO04B01', '1')->count();
            $igd_IDO04B03 = $igd->where('IDO04B01', '1')->count();
            $igd_IDO05A01 = $igd->where('IDO05A01', '1')->count();
            $igd_IDO05A02 = $igd->where('IDO05A02', '1')->count();
            $igd_IDO05A03 = $igd->where('IDO05A03', '1')->count();
            $igd_IDO05A04 = $igd->where('IDO05A04', '1')->count();
            $igd_IDO05B01 = $igd->where('IDO05B01', '1')->count();
            $igd_IDO05B02 = $igd->where('IDO05B02', '1')->count();
            $igd_IDO05B03 = $igd->where('IDO05B03', '1')->count();
            $igd_IDO05B04 = $igd->where('IDO05B04', '1')->count();
            $igd_IDO0601 = $igd->where('IDO0601', '1')->count();
            $igd_IDO0602 = $igd->where('IDO0602', '1')->count();
            $igd_IDO0603 = $igd->where('IDO0603', '1')->count();
            $igd_IDO0604 = $igd->where('IDO0604', '1')->count();
            $igd_jumlah = $igd_IDO04A01 + $igd_IDO04A02 + $igd_IDO04A03 + $igd_IDO04A04 + $igd_IDO04A05 + $igd_IDO04A06 + $igd_IDO04A07 + $igd_IDO04A08 + $igd_IDO04B01 + $igd_IDO04B02 + $igd_IDO04B03 + $igd_IDO05A01 + $igd_IDO05A02 + $igd_IDO05A03 + $igd_IDO05A04 + $igd_IDO05B01 + $igd_IDO05B02 + $igd_IDO05B03 + $igd_IDO05B04 + $igd_IDO0601 + $igd_IDO0602 + $igd_IDO0603 + $igd_IDO0604;

            $no_igd_IDO04A01 = $igd->where('IDO04A01', '0')->count();
            $no_igd_IDO04A02 = $igd->where('IDO04A02', '0')->count();
            $no_igd_IDO04A03 = $igd->where('IDO04A03', '0')->count();
            $no_igd_IDO04A04 = $igd->where('IDO04A04', '0')->count();
            $no_igd_IDO04A05 = $igd->where('IDO04A05', '0')->count();
            $no_igd_IDO04A06 = $igd->where('IDO04A06', '0')->count();
            $no_igd_IDO04A07 = $igd->where('IDO04A07', '0')->count();
            $no_igd_IDO04A08 = $igd->where('IDO04A08', '0')->count();
            $no_igd_IDO04B01 = $igd->where('IDO04B01', '0')->count();
            $no_igd_IDO04B02 = $igd->where('IDO04B01', '0')->count();
            $no_igd_IDO04B03 = $igd->where('IDO04B01', '0')->count();
            $no_igd_IDO05A01 = $igd->where('IDO05A01', '0')->count();
            $no_igd_IDO05A02 = $igd->where('IDO05A02', '0')->count();
            $no_igd_IDO05A03 = $igd->where('IDO05A03', '0')->count();
            $no_igd_IDO05A04 = $igd->where('IDO05A04', '0')->count();
            $no_igd_IDO05B01 = $igd->where('IDO05B01', '0')->count();
            $no_igd_IDO05B02 = $igd->where('IDO05B02', '0')->count();
            $no_igd_IDO05B03 = $igd->where('IDO05B03', '0')->count();
            $no_igd_IDO05B04 = $igd->where('IDO05B04', '0')->count();
            $no_igd_IDO0601 = $igd->where('IDO0601', '0')->count();
            $no_igd_IDO0602 = $igd->where('IDO0602', '0')->count();
            $no_igd_IDO0603 = $igd->where('IDO0603', '0')->count();
            $no_igd_IDO0604 = $igd->where('IDO0604', '0')->count();
            $no_igd_jumlah = $no_igd_IDO04A01 + $no_igd_IDO04A02 + $no_igd_IDO04A03 + $no_igd_IDO04A04 + $no_igd_IDO04A05 + $no_igd_IDO04A06 + $no_igd_IDO04A07 + $no_igd_IDO04A08 + $no_igd_IDO04B01 + $no_igd_IDO04B02 + $no_igd_IDO04B03 + $no_igd_IDO05A01 + $no_igd_IDO05A02 + $no_igd_IDO05A03 + $no_igd_IDO05A04 + $no_igd_IDO05B01 + $no_igd_IDO05B02 + $no_igd_IDO05B03 + $no_igd_IDO05B04 + $no_igd_IDO0601 + $no_igd_IDO0602 + $no_igd_IDO0603 + $no_igd_IDO0604;

            $denominator_igd = $igd_jumlah + $no_igd_jumlah;

            $int_IDO04A01 = $int->where('IDO04A01', '1')->count();
            $int_IDO04A02 = $int->where('IDO04A02', '1')->count();
            $int_IDO04A03 = $int->where('IDO04A03', '1')->count();
            $int_IDO04A04 = $int->where('IDO04A04', '1')->count();
            $int_IDO04A05 = $int->where('IDO04A05', '1')->count();
            $int_IDO04A06 = $int->where('IDO04A06', '1')->count();
            $int_IDO04A07 = $int->where('IDO04A07', '1')->count();
            $int_IDO04A08 = $int->where('IDO04A08', '1')->count();
            $int_IDO04B01 = $int->where('IDO04B01', '1')->count();
            $int_IDO04B02 = $int->where('IDO04B01', '1')->count();
            $int_IDO04B03 = $int->where('IDO04B01', '1')->count();
            $int_IDO05A01 = $int->where('IDO05A01', '1')->count();
            $int_IDO05A02 = $int->where('IDO05A02', '1')->count();
            $int_IDO05A03 = $int->where('IDO05A03', '1')->count();
            $int_IDO05A04 = $int->where('IDO05A04', '1')->count();
            $int_IDO05B01 = $int->where('IDO05B01', '1')->count();
            $int_IDO05B02 = $int->where('IDO05B02', '1')->count();
            $int_IDO05B03 = $int->where('IDO05B03', '1')->count();
            $int_IDO05B04 = $int->where('IDO05B04', '1')->count();
            $int_IDO0601 = $int->where('IDO0601', '1')->count();
            $int_IDO0602 = $int->where('IDO0602', '1')->count();
            $int_IDO0603 = $int->where('IDO0603', '1')->count();
            $int_IDO0604 = $int->where('IDO0604', '1')->count();
            $int_jumlah = $int_IDO04A01 + $int_IDO04A02 + $int_IDO04A03 + $int_IDO04A04 + $int_IDO04A05 + $int_IDO04A06 + $int_IDO04A07 + $int_IDO04A08 + $int_IDO04B01 + $int_IDO04B02 + $int_IDO04B03 + $int_IDO05A01 + $int_IDO05A02 + $int_IDO05A03 + $int_IDO05A04 + $int_IDO05B01 + $int_IDO05B02 + $int_IDO05B03 + $int_IDO05B04 + $int_IDO0601 + $int_IDO0602 + $int_IDO0603 + $int_IDO0604;

            $no_int_IDO04A01 = $int->where('IDO04A01', '0')->count();
            $no_int_IDO04A02 = $int->where('IDO04A02', '0')->count();
            $no_int_IDO04A03 = $int->where('IDO04A03', '0')->count();
            $no_int_IDO04A04 = $int->where('IDO04A04', '0')->count();
            $no_int_IDO04A05 = $int->where('IDO04A05', '0')->count();
            $no_int_IDO04A06 = $int->where('IDO04A06', '0')->count();
            $no_int_IDO04A07 = $int->where('IDO04A07', '0')->count();
            $no_int_IDO04A08 = $int->where('IDO04A08', '0')->count();
            $no_int_IDO04B01 = $int->where('IDO04B01', '0')->count();
            $no_int_IDO04B02 = $int->where('IDO04B01', '0')->count();
            $no_int_IDO04B03 = $int->where('IDO04B01', '0')->count();
            $no_int_IDO05A01 = $int->where('IDO05A01', '0')->count();
            $no_int_IDO05A02 = $int->where('IDO05A02', '0')->count();
            $no_int_IDO05A03 = $int->where('IDO05A03', '0')->count();
            $no_int_IDO05A04 = $int->where('IDO05A04', '0')->count();
            $no_int_IDO05B01 = $int->where('IDO05B01', '0')->count();
            $no_int_IDO05B02 = $int->where('IDO05B02', '0')->count();
            $no_int_IDO05B03 = $int->where('IDO05B03', '0')->count();
            $no_int_IDO05B04 = $int->where('IDO05B04', '0')->count();
            $no_int_IDO0601 = $int->where('IDO0601', '0')->count();
            $no_int_IDO0602 = $int->where('IDO0602', '0')->count();
            $no_int_IDO0603 = $int->where('IDO0603', '0')->count();
            $no_int_IDO0604 = $int->where('IDO0604', '0')->count();
            $no_int_jumlah = $no_int_IDO04A01 + $no_int_IDO04A02 + $no_int_IDO04A03 + $no_int_IDO04A04 + $no_int_IDO04A05 + $no_int_IDO04A06 + $no_int_IDO04A07 + $no_int_IDO04A08 + $no_int_IDO04B01 + $no_int_IDO04B02 + $no_int_IDO04B03 + $no_int_IDO05A01 + $no_int_IDO05A02 + $no_int_IDO05A03 + $no_int_IDO05A04 + $no_int_IDO05B01 + $no_int_IDO05B02 + $no_int_IDO05B03 + $no_int_IDO05B04 + $no_int_IDO0601 + $no_int_IDO0602 + $no_int_IDO0603 + $no_int_IDO0604;

            $denominator_int = $int_jumlah + $no_int_jumlah;

            $ok_IDO04A01 = $ok->where('IDO04A01', '1')->count();
            $ok_IDO04A02 = $ok->where('IDO04A02', '1')->count();
            $ok_IDO04A03 = $ok->where('IDO04A03', '1')->count();
            $ok_IDO04A04 = $ok->where('IDO04A04', '1')->count();
            $ok_IDO04A05 = $ok->where('IDO04A05', '1')->count();
            $ok_IDO04A06 = $ok->where('IDO04A06', '1')->count();
            $ok_IDO04A07 = $ok->where('IDO04A07', '1')->count();
            $ok_IDO04A08 = $ok->where('IDO04A08', '1')->count();
            $ok_IDO04B01 = $ok->where('IDO04B01', '1')->count();
            $ok_IDO04B02 = $ok->where('IDO04B01', '1')->count();
            $ok_IDO04B03 = $ok->where('IDO04B01', '1')->count();
            $ok_IDO05A01 = $ok->where('IDO05A01', '1')->count();
            $ok_IDO05A02 = $ok->where('IDO05A02', '1')->count();
            $ok_IDO05A03 = $ok->where('IDO05A03', '1')->count();
            $ok_IDO05A04 = $ok->where('IDO05A04', '1')->count();
            $ok_IDO05B01 = $ok->where('IDO05B01', '1')->count();
            $ok_IDO05B02 = $ok->where('IDO05B02', '1')->count();
            $ok_IDO05B03 = $ok->where('IDO05B03', '1')->count();
            $ok_IDO05B04 = $ok->where('IDO05B04', '1')->count();
            $ok_IDO0601 = $ok->where('IDO0601', '1')->count();
            $ok_IDO0602 = $ok->where('IDO0602', '1')->count();
            $ok_IDO0603 = $ok->where('IDO0603', '1')->count();
            $ok_IDO0604 = $ok->where('IDO0604', '1')->count();
            $ok_jumlah = $ok_IDO04A01 + $ok_IDO04A02 + $ok_IDO04A03 + $ok_IDO04A04 + $ok_IDO04A05 + $ok_IDO04A06 + $ok_IDO04A07 + $ok_IDO04A08 + $ok_IDO04B01 + $ok_IDO04B02 + $ok_IDO04B03 + $ok_IDO05A01 + $ok_IDO05A02 + $ok_IDO05A03 + $ok_IDO05A04 + $ok_IDO05B01 + $ok_IDO05B02 + $ok_IDO05B03 + $ok_IDO05B04 + $ok_IDO0601 + $ok_IDO0602 + $ok_IDO0603 + $ok_IDO0604;

            $no_ok_IDO04A01 = $ok->where('IDO04A01', '0')->count();
            $no_ok_IDO04A02 = $ok->where('IDO04A02', '0')->count();
            $no_ok_IDO04A03 = $ok->where('IDO04A03', '0')->count();
            $no_ok_IDO04A04 = $ok->where('IDO04A04', '0')->count();
            $no_ok_IDO04A05 = $ok->where('IDO04A05', '0')->count();
            $no_ok_IDO04A06 = $ok->where('IDO04A06', '0')->count();
            $no_ok_IDO04A07 = $ok->where('IDO04A07', '0')->count();
            $no_ok_IDO04A08 = $ok->where('IDO04A08', '0')->count();
            $no_ok_IDO04B01 = $ok->where('IDO04B01', '0')->count();
            $no_ok_IDO04B02 = $ok->where('IDO04B01', '0')->count();
            $no_ok_IDO04B03 = $ok->where('IDO04B01', '0')->count();
            $no_ok_IDO05A01 = $ok->where('IDO05A01', '0')->count();
            $no_ok_IDO05A02 = $ok->where('IDO05A02', '0')->count();
            $no_ok_IDO05A03 = $ok->where('IDO05A03', '0')->count();
            $no_ok_IDO05A04 = $ok->where('IDO05A04', '0')->count();
            $no_ok_IDO05B01 = $ok->where('IDO05B01', '0')->count();
            $no_ok_IDO05B02 = $ok->where('IDO05B02', '0')->count();
            $no_ok_IDO05B03 = $ok->where('IDO05B03', '0')->count();
            $no_ok_IDO05B04 = $ok->where('IDO05B04', '0')->count();
            $no_ok_IDO0601 = $ok->where('IDO0601', '0')->count();
            $no_ok_IDO0602 = $ok->where('IDO0602', '0')->count();
            $no_ok_IDO0603 = $ok->where('IDO0603', '0')->count();
            $no_ok_IDO0604 = $ok->where('IDO0604', '0')->count();
            $no_ok_jumlah = $no_ok_IDO04A01 + $no_ok_IDO04A02 + $no_ok_IDO04A03 + $no_ok_IDO04A04 + $no_ok_IDO04A05 + $no_ok_IDO04A06 + $no_ok_IDO04A07 + $no_ok_IDO04A08 + $no_ok_IDO04B01 + $no_ok_IDO04B02 + $no_ok_IDO04B03 + $no_ok_IDO05A01 + $no_ok_IDO05A02 + $no_ok_IDO05A03 + $no_ok_IDO05A04 + $no_ok_IDO05B01 + $no_ok_IDO05B02 + $no_ok_IDO05B03 + $no_ok_IDO05B04 + $no_ok_IDO0601 + $no_ok_IDO0602 + $no_ok_IDO0603 + $no_ok_IDO0604;

            $denominator_ok = $ok_jumlah + $no_ok_jumlah;

            $lt2_IDO04A01 = $lt2->where('IDO04A01', '1')->count();
            $lt2_IDO04A02 = $lt2->where('IDO04A02', '1')->count();
            $lt2_IDO04A03 = $lt2->where('IDO04A03', '1')->count();
            $lt2_IDO04A04 = $lt2->where('IDO04A04', '1')->count();
            $lt2_IDO04A05 = $lt2->where('IDO04A05', '1')->count();
            $lt2_IDO04A06 = $lt2->where('IDO04A06', '1')->count();
            $lt2_IDO04A07 = $lt2->where('IDO04A07', '1')->count();
            $lt2_IDO04A08 = $lt2->where('IDO04A08', '1')->count();
            $lt2_IDO04B01 = $lt2->where('IDO04B01', '1')->count();
            $lt2_IDO04B02 = $lt2->where('IDO04B01', '1')->count();
            $lt2_IDO04B03 = $lt2->where('IDO04B01', '1')->count();
            $lt2_IDO05A01 = $lt2->where('IDO05A01', '1')->count();
            $lt2_IDO05A02 = $lt2->where('IDO05A02', '1')->count();
            $lt2_IDO05A03 = $lt2->where('IDO05A03', '1')->count();
            $lt2_IDO05A04 = $lt2->where('IDO05A04', '1')->count();
            $lt2_IDO05B01 = $lt2->where('IDO05B01', '1')->count();
            $lt2_IDO05B02 = $lt2->where('IDO05B02', '1')->count();
            $lt2_IDO05B03 = $lt2->where('IDO05B03', '1')->count();
            $lt2_IDO05B04 = $lt2->where('IDO05B04', '1')->count();
            $lt2_IDO0601 = $lt2->where('IDO0601', '1')->count();
            $lt2_IDO0602 = $lt2->where('IDO0602', '1')->count();
            $lt2_IDO0603 = $lt2->where('IDO0603', '1')->count();
            $lt2_IDO0604 = $lt2->where('IDO0604', '1')->count();
            $lt2_jumlah = $lt2_IDO04A01 + $lt2_IDO04A02 + $lt2_IDO04A03 + $lt2_IDO04A04 + $lt2_IDO04A05 + $lt2_IDO04A06 + $lt2_IDO04A07 + $lt2_IDO04A08 + $lt2_IDO04B01 + $lt2_IDO04B02 + $lt2_IDO04B03 + $lt2_IDO05A01 + $lt2_IDO05A02 + $lt2_IDO05A03 + $lt2_IDO05A04 + $lt2_IDO05B01 + $lt2_IDO05B02 + $lt2_IDO05B03 + $lt2_IDO05B04 + $lt2_IDO0601 + $lt2_IDO0602 + $lt2_IDO0603 + $lt2_IDO0604;

            $no_lt2_IDO04A01 = $lt2->where('IDO04A01', '0')->count();
            $no_lt2_IDO04A02 = $lt2->where('IDO04A02', '0')->count();
            $no_lt2_IDO04A03 = $lt2->where('IDO04A03', '0')->count();
            $no_lt2_IDO04A04 = $lt2->where('IDO04A04', '0')->count();
            $no_lt2_IDO04A05 = $lt2->where('IDO04A05', '0')->count();
            $no_lt2_IDO04A06 = $lt2->where('IDO04A06', '0')->count();
            $no_lt2_IDO04A07 = $lt2->where('IDO04A07', '0')->count();
            $no_lt2_IDO04A08 = $lt2->where('IDO04A08', '0')->count();
            $no_lt2_IDO04B01 = $lt2->where('IDO04B01', '0')->count();
            $no_lt2_IDO04B02 = $lt2->where('IDO04B01', '0')->count();
            $no_lt2_IDO04B03 = $lt2->where('IDO04B01', '0')->count();
            $no_lt2_IDO05A01 = $lt2->where('IDO05A01', '0')->count();
            $no_lt2_IDO05A02 = $lt2->where('IDO05A02', '0')->count();
            $no_lt2_IDO05A03 = $lt2->where('IDO05A03', '0')->count();
            $no_lt2_IDO05A04 = $lt2->where('IDO05A04', '0')->count();
            $no_lt2_IDO05B01 = $lt2->where('IDO05B01', '0')->count();
            $no_lt2_IDO05B02 = $lt2->where('IDO05B02', '0')->count();
            $no_lt2_IDO05B03 = $lt2->where('IDO05B03', '0')->count();
            $no_lt2_IDO05B04 = $lt2->where('IDO05B04', '0')->count();
            $no_lt2_IDO0601 = $lt2->where('IDO0601', '0')->count();
            $no_lt2_IDO0602 = $lt2->where('IDO0602', '0')->count();
            $no_lt2_IDO0603 = $lt2->where('IDO0603', '0')->count();
            $no_lt2_IDO0604 = $lt2->where('IDO0604', '0')->count();
            $no_lt2_jumlah = $no_lt2_IDO04A01 + $no_lt2_IDO04A02 + $no_lt2_IDO04A03 + $no_lt2_IDO04A04 + $no_lt2_IDO04A05 + $no_lt2_IDO04A06 + $no_lt2_IDO04A07 + $no_lt2_IDO04A08 + $no_lt2_IDO04B01 + $no_lt2_IDO04B02 + $no_lt2_IDO04B03 + $no_lt2_IDO05A01 + $no_lt2_IDO05A02 + $no_lt2_IDO05A03 + $no_lt2_IDO05A04 + $no_lt2_IDO05B01 + $no_lt2_IDO05B02 + $no_lt2_IDO05B03 + $no_lt2_IDO05B04 + $no_lt2_IDO0601 + $no_lt2_IDO0602 + $no_lt2_IDO0603 + $no_lt2_IDO0604;

            $denominator_lt2 = $lt2_jumlah + $no_lt2_jumlah;

            $lt4_IDO04A01 = $lt4->where('IDO04A01', '1')->count();
            $lt4_IDO04A02 = $lt4->where('IDO04A02', '1')->count();
            $lt4_IDO04A03 = $lt4->where('IDO04A03', '1')->count();
            $lt4_IDO04A04 = $lt4->where('IDO04A04', '1')->count();
            $lt4_IDO04A05 = $lt4->where('IDO04A05', '1')->count();
            $lt4_IDO04A06 = $lt4->where('IDO04A06', '1')->count();
            $lt4_IDO04A07 = $lt4->where('IDO04A07', '1')->count();
            $lt4_IDO04A08 = $lt4->where('IDO04A08', '1')->count();
            $lt4_IDO04B01 = $lt4->where('IDO04B01', '1')->count();
            $lt4_IDO04B02 = $lt4->where('IDO04B01', '1')->count();
            $lt4_IDO04B03 = $lt4->where('IDO04B01', '1')->count();
            $lt4_IDO05A01 = $lt4->where('IDO05A01', '1')->count();
            $lt4_IDO05A02 = $lt4->where('IDO05A02', '1')->count();
            $lt4_IDO05A03 = $lt4->where('IDO05A03', '1')->count();
            $lt4_IDO05A04 = $lt4->where('IDO05A04', '1')->count();
            $lt4_IDO05B01 = $lt4->where('IDO05B01', '1')->count();
            $lt4_IDO05B02 = $lt4->where('IDO05B02', '1')->count();
            $lt4_IDO05B03 = $lt4->where('IDO05B03', '1')->count();
            $lt4_IDO05B04 = $lt4->where('IDO05B04', '1')->count();
            $lt4_IDO0601 = $lt4->where('IDO0601', '1')->count();
            $lt4_IDO0602 = $lt4->where('IDO0602', '1')->count();
            $lt4_IDO0603 = $lt4->where('IDO0603', '1')->count();
            $lt4_IDO0604 = $lt4->where('IDO0604', '1')->count();
            $lt4_jumlah = $lt4_IDO04A01 + $lt4_IDO04A02 + $lt4_IDO04A03 + $lt4_IDO04A04 + $lt4_IDO04A05 + $lt4_IDO04A06 + $lt4_IDO04A07 + $lt4_IDO04A08 + $lt4_IDO04B01 + $lt4_IDO04B02 + $lt4_IDO04B03 + $lt4_IDO05A01 + $lt4_IDO05A02 + $lt4_IDO05A03 + $lt4_IDO05A04 + $lt4_IDO05B01 + $lt4_IDO05B02 + $lt4_IDO05B03 + $lt4_IDO05B04 + $lt4_IDO0601 + $lt4_IDO0602 + $lt4_IDO0603 + $lt4_IDO0604;

            $no_lt4_IDO04A01 = $lt4->where('IDO04A01', '0')->count();
            $no_lt4_IDO04A02 = $lt4->where('IDO04A02', '0')->count();
            $no_lt4_IDO04A03 = $lt4->where('IDO04A03', '0')->count();
            $no_lt4_IDO04A04 = $lt4->where('IDO04A04', '0')->count();
            $no_lt4_IDO04A05 = $lt4->where('IDO04A05', '0')->count();
            $no_lt4_IDO04A06 = $lt4->where('IDO04A06', '0')->count();
            $no_lt4_IDO04A07 = $lt4->where('IDO04A07', '0')->count();
            $no_lt4_IDO04A08 = $lt4->where('IDO04A08', '0')->count();
            $no_lt4_IDO04B01 = $lt4->where('IDO04B01', '0')->count();
            $no_lt4_IDO04B02 = $lt4->where('IDO04B01', '0')->count();
            $no_lt4_IDO04B03 = $lt4->where('IDO04B01', '0')->count();
            $no_lt4_IDO05A01 = $lt4->where('IDO05A01', '0')->count();
            $no_lt4_IDO05A02 = $lt4->where('IDO05A02', '0')->count();
            $no_lt4_IDO05A03 = $lt4->where('IDO05A03', '0')->count();
            $no_lt4_IDO05A04 = $lt4->where('IDO05A04', '0')->count();
            $no_lt4_IDO05B01 = $lt4->where('IDO05B01', '0')->count();
            $no_lt4_IDO05B02 = $lt4->where('IDO05B02', '0')->count();
            $no_lt4_IDO05B03 = $lt4->where('IDO05B03', '0')->count();
            $no_lt4_IDO05B04 = $lt4->where('IDO05B04', '0')->count();
            $no_lt4_IDO0601 = $lt4->where('IDO0601', '0')->count();
            $no_lt4_IDO0602 = $lt4->where('IDO0602', '0')->count();
            $no_lt4_IDO0603 = $lt4->where('IDO0603', '0')->count();
            $no_lt4_IDO0604 = $lt4->where('IDO0604', '0')->count();
            $no_lt4_jumlah = $no_lt4_IDO04A01 + $no_lt4_IDO04A02 + $no_lt4_IDO04A03 + $no_lt4_IDO04A04 + $no_lt4_IDO04A05 + $no_lt4_IDO04A06 + $no_lt4_IDO04A07 + $no_lt4_IDO04A08 + $no_lt4_IDO04B01 + $no_lt4_IDO04B02 + $no_lt4_IDO04B03 + $no_lt4_IDO05A01 + $no_lt4_IDO05A02 + $no_lt4_IDO05A03 + $no_lt4_IDO05A04 + $no_lt4_IDO05B01 + $no_lt4_IDO05B02 + $no_lt4_IDO05B03 + $no_lt4_IDO05B04 + $no_lt4_IDO0601 + $no_lt4_IDO0602 + $no_lt4_IDO0603 + $no_lt4_IDO0604;

            $denominator_lt4 = $lt4_jumlah + $no_lt4_jumlah;

            $lt5_IDO04A01 = $lt5->where('IDO04A01', '1')->count();
            $lt5_IDO04A02 = $lt5->where('IDO04A02', '1')->count();
            $lt5_IDO04A03 = $lt5->where('IDO04A03', '1')->count();
            $lt5_IDO04A04 = $lt5->where('IDO04A04', '1')->count();
            $lt5_IDO04A05 = $lt5->where('IDO04A05', '1')->count();
            $lt5_IDO04A06 = $lt5->where('IDO04A06', '1')->count();
            $lt5_IDO04A07 = $lt5->where('IDO04A07', '1')->count();
            $lt5_IDO04A08 = $lt5->where('IDO04A08', '1')->count();
            $lt5_IDO04B01 = $lt5->where('IDO04B01', '1')->count();
            $lt5_IDO04B02 = $lt5->where('IDO04B01', '1')->count();
            $lt5_IDO04B03 = $lt5->where('IDO04B01', '1')->count();
            $lt5_IDO05A01 = $lt5->where('IDO05A01', '1')->count();
            $lt5_IDO05A02 = $lt5->where('IDO05A02', '1')->count();
            $lt5_IDO05A03 = $lt5->where('IDO05A03', '1')->count();
            $lt5_IDO05A04 = $lt5->where('IDO05A04', '1')->count();
            $lt5_IDO05B01 = $lt5->where('IDO05B01', '1')->count();
            $lt5_IDO05B02 = $lt5->where('IDO05B02', '1')->count();
            $lt5_IDO05B03 = $lt5->where('IDO05B03', '1')->count();
            $lt5_IDO05B04 = $lt5->where('IDO05B04', '1')->count();
            $lt5_IDO0601 = $lt5->where('IDO0601', '1')->count();
            $lt5_IDO0602 = $lt5->where('IDO0602', '1')->count();
            $lt5_IDO0603 = $lt5->where('IDO0603', '1')->count();
            $lt5_IDO0604 = $lt5->where('IDO0604', '1')->count();
            $lt5_jumlah = $lt5_IDO04A01 + $lt5_IDO04A02 + $lt5_IDO04A03 + $lt5_IDO04A04 + $lt5_IDO04A05 + $lt5_IDO04A06 + $lt5_IDO04A07 + $lt5_IDO04A08 + $lt5_IDO04B01 + $lt5_IDO04B02 + $lt5_IDO04B03 + $lt5_IDO05A01 + $lt5_IDO05A02 + $lt5_IDO05A03 + $lt5_IDO05A04 + $lt5_IDO05B01 + $lt5_IDO05B02 + $lt5_IDO05B03 + $lt5_IDO05B04 + $lt5_IDO0601 + $lt5_IDO0602 + $lt5_IDO0603 + $lt5_IDO0604;

            $no_lt5_IDO04A01 = $lt5->where('IDO04A01', '0')->count();
            $no_lt5_IDO04A02 = $lt5->where('IDO04A02', '0')->count();
            $no_lt5_IDO04A03 = $lt5->where('IDO04A03', '0')->count();
            $no_lt5_IDO04A04 = $lt5->where('IDO04A04', '0')->count();
            $no_lt5_IDO04A05 = $lt5->where('IDO04A05', '0')->count();
            $no_lt5_IDO04A06 = $lt5->where('IDO04A06', '0')->count();
            $no_lt5_IDO04A07 = $lt5->where('IDO04A07', '0')->count();
            $no_lt5_IDO04A08 = $lt5->where('IDO04A08', '0')->count();
            $no_lt5_IDO04B01 = $lt5->where('IDO04B01', '0')->count();
            $no_lt5_IDO04B02 = $lt5->where('IDO04B01', '0')->count();
            $no_lt5_IDO04B03 = $lt5->where('IDO04B01', '0')->count();
            $no_lt5_IDO05A01 = $lt5->where('IDO05A01', '0')->count();
            $no_lt5_IDO05A02 = $lt5->where('IDO05A02', '0')->count();
            $no_lt5_IDO05A03 = $lt5->where('IDO05A03', '0')->count();
            $no_lt5_IDO05A04 = $lt5->where('IDO05A04', '0')->count();
            $no_lt5_IDO05B01 = $lt5->where('IDO05B01', '0')->count();
            $no_lt5_IDO05B02 = $lt5->where('IDO05B02', '0')->count();
            $no_lt5_IDO05B03 = $lt5->where('IDO05B03', '0')->count();
            $no_lt5_IDO05B04 = $lt5->where('IDO05B04', '0')->count();
            $no_lt5_IDO0601 = $lt5->where('IDO0601', '0')->count();
            $no_lt5_IDO0602 = $lt5->where('IDO0602', '0')->count();
            $no_lt5_IDO0603 = $lt5->where('IDO0603', '0')->count();
            $no_lt5_IDO0604 = $lt5->where('IDO0604', '0')->count();
            $no_lt5_jumlah = $no_lt5_IDO04A01 + $no_lt5_IDO04A02 + $no_lt5_IDO04A03 + $no_lt5_IDO04A04 + $no_lt5_IDO04A05 + $no_lt5_IDO04A06 + $no_lt5_IDO04A07 + $no_lt5_IDO04A08 + $no_lt5_IDO04B01 + $no_lt5_IDO04B02 + $no_lt5_IDO04B03 + $no_lt5_IDO05A01 + $no_lt5_IDO05A02 + $no_lt5_IDO05A03 + $no_lt5_IDO05A04 + $no_lt5_IDO05B01 + $no_lt5_IDO05B02 + $no_lt5_IDO05B03 + $no_lt5_IDO05B04 + $no_lt5_IDO0601 + $no_lt5_IDO0602 + $no_lt5_IDO0603 + $no_lt5_IDO0604;

            $denominator_lt5 = $lt5_jumlah + $no_lt5_jumlah;

            $vk_IDO04A01 = $vk->where('IDO04A01', '1')->count();
            $vk_IDO04A02 = $vk->where('IDO04A02', '1')->count();
            $vk_IDO04A03 = $vk->where('IDO04A03', '1')->count();
            $vk_IDO04A04 = $vk->where('IDO04A04', '1')->count();
            $vk_IDO04A05 = $vk->where('IDO04A05', '1')->count();
            $vk_IDO04A06 = $vk->where('IDO04A06', '1')->count();
            $vk_IDO04A07 = $vk->where('IDO04A07', '1')->count();
            $vk_IDO04A08 = $vk->where('IDO04A08', '1')->count();
            $vk_IDO04B01 = $vk->where('IDO04B01', '1')->count();
            $vk_IDO04B02 = $vk->where('IDO04B01', '1')->count();
            $vk_IDO04B03 = $vk->where('IDO04B01', '1')->count();
            $vk_IDO05A01 = $vk->where('IDO05A01', '1')->count();
            $vk_IDO05A02 = $vk->where('IDO05A02', '1')->count();
            $vk_IDO05A03 = $vk->where('IDO05A03', '1')->count();
            $vk_IDO05A04 = $vk->where('IDO05A04', '1')->count();
            $vk_IDO05B01 = $vk->where('IDO05B01', '1')->count();
            $vk_IDO05B02 = $vk->where('IDO05B02', '1')->count();
            $vk_IDO05B03 = $vk->where('IDO05B03', '1')->count();
            $vk_IDO05B04 = $vk->where('IDO05B04', '1')->count();
            $vk_IDO0601 = $vk->where('IDO0601', '1')->count();
            $vk_IDO0602 = $vk->where('IDO0602', '1')->count();
            $vk_IDO0603 = $vk->where('IDO0603', '1')->count();
            $vk_IDO0604 = $vk->where('IDO0604', '1')->count();
            $vk_jumlah = $vk_IDO04A01 + $vk_IDO04A02 + $vk_IDO04A03 + $vk_IDO04A04 + $vk_IDO04A05 + $vk_IDO04A06 + $vk_IDO04A07 + $vk_IDO04A08 + $vk_IDO04B01 + $vk_IDO04B02 + $vk_IDO04B03 + $vk_IDO05A01 + $vk_IDO05A02 + $vk_IDO05A03 + $vk_IDO05A04 + $vk_IDO05B01 + $vk_IDO05B02 + $vk_IDO05B03 + $vk_IDO05B04 + $vk_IDO0601 + $vk_IDO0602 + $vk_IDO0603 + $vk_IDO0604;

            $no_vk_IDO04A01 = $vk->where('IDO04A01', '0')->count();
            $no_vk_IDO04A02 = $vk->where('IDO04A02', '0')->count();
            $no_vk_IDO04A03 = $vk->where('IDO04A03', '0')->count();
            $no_vk_IDO04A04 = $vk->where('IDO04A04', '0')->count();
            $no_vk_IDO04A05 = $vk->where('IDO04A05', '0')->count();
            $no_vk_IDO04A06 = $vk->where('IDO04A06', '0')->count();
            $no_vk_IDO04A07 = $vk->where('IDO04A07', '0')->count();
            $no_vk_IDO04A08 = $vk->where('IDO04A08', '0')->count();
            $no_vk_IDO04B01 = $vk->where('IDO04B01', '0')->count();
            $no_vk_IDO04B02 = $vk->where('IDO04B01', '0')->count();
            $no_vk_IDO04B03 = $vk->where('IDO04B01', '0')->count();
            $no_vk_IDO05A01 = $vk->where('IDO05A01', '0')->count();
            $no_vk_IDO05A02 = $vk->where('IDO05A02', '0')->count();
            $no_vk_IDO05A03 = $vk->where('IDO05A03', '0')->count();
            $no_vk_IDO05A04 = $vk->where('IDO05A04', '0')->count();
            $no_vk_IDO05B01 = $vk->where('IDO05B01', '0')->count();
            $no_vk_IDO05B02 = $vk->where('IDO05B02', '0')->count();
            $no_vk_IDO05B03 = $vk->where('IDO05B03', '0')->count();
            $no_vk_IDO05B04 = $vk->where('IDO05B04', '0')->count();
            $no_vk_IDO0601 = $vk->where('IDO0601', '0')->count();
            $no_vk_IDO0602 = $vk->where('IDO0602', '0')->count();
            $no_vk_IDO0603 = $vk->where('IDO0603', '0')->count();
            $no_vk_IDO0604 = $vk->where('IDO0604', '0')->count();
            $no_vk_jumlah = $no_vk_IDO04A01 + $no_vk_IDO04A02 + $no_vk_IDO04A03 + $no_vk_IDO04A04 + $no_vk_IDO04A05 + $no_vk_IDO04A06 + $no_vk_IDO04A07 + $no_vk_IDO04A08 + $no_vk_IDO04B01 + $no_vk_IDO04B02 + $no_vk_IDO04B03 + $no_vk_IDO05A01 + $no_vk_IDO05A02 + $no_vk_IDO05A03 + $no_vk_IDO05A04 + $no_vk_IDO05B01 + $no_vk_IDO05B02 + $no_vk_IDO05B03 + $no_vk_IDO05B04 + $no_vk_IDO0601 + $no_vk_IDO0602 + $no_vk_IDO0603 + $no_vk_IDO0604;

            $denominator_vk = $vk_jumlah + $no_vk_jumlah;

            $tanggal = Carbon::parse($request->input('dari'))->isoFormat('DD MMMM YYYY') . ' - ' . Carbon::parse($request->input('sampai'))->isoFormat('DD MMMM YYYY');

            return Excel::download(new ExportBundleIDO(
                $igd_IDO04A01,
                $igd_IDO04A02,
                $igd_IDO04A03,
                $igd_IDO04A04,
                $igd_IDO04A05,
                $igd_IDO04A06,
                $igd_IDO04A07,
                $igd_IDO04A08,
                $igd_IDO04B01,
                $igd_IDO04B02,
                $igd_IDO04B03,
                $igd_IDO05A01,
                $igd_IDO05A02,
                $igd_IDO05A03,
                $igd_IDO05A04,
                $igd_IDO05B01,
                $igd_IDO05B02,
                $igd_IDO05B03,
                $igd_IDO05B04,
                $igd_IDO0601,
                $igd_IDO0602,
                $igd_IDO0603,
                $igd_IDO0604,
                $igd_jumlah,

                $no_igd_IDO04A01,
                $no_igd_IDO04A02,
                $no_igd_IDO04A03,
                $no_igd_IDO04A04,
                $no_igd_IDO04A05,
                $no_igd_IDO04A06,
                $no_igd_IDO04A07,
                $no_igd_IDO04A08,
                $no_igd_IDO04B01,
                $no_igd_IDO04B02,
                $no_igd_IDO04B03,
                $no_igd_IDO05A01,
                $no_igd_IDO05A02,
                $no_igd_IDO05A03,
                $no_igd_IDO05A04,
                $no_igd_IDO05B01,
                $no_igd_IDO05B02,
                $no_igd_IDO05B03,
                $no_igd_IDO05B04,
                $no_igd_IDO0601,
                $no_igd_IDO0602,
                $no_igd_IDO0603,
                $no_igd_IDO0604,
                $no_igd_jumlah,

                $denominator_igd,

                $int_IDO04A01,
                $int_IDO04A02,
                $int_IDO04A03,
                $int_IDO04A04,
                $int_IDO04A05,
                $int_IDO04A06,
                $int_IDO04A07,
                $int_IDO04A08,
                $int_IDO04B01,
                $int_IDO04B02,
                $int_IDO04B03,
                $int_IDO05A01,
                $int_IDO05A02,
                $int_IDO05A03,
                $int_IDO05A04,
                $int_IDO05B01,
                $int_IDO05B02,
                $int_IDO05B03,
                $int_IDO05B04,
                $int_IDO0601,
                $int_IDO0602,
                $int_IDO0603,
                $int_IDO0604,
                $int_jumlah,

                $no_int_IDO04A01,
                $no_int_IDO04A02,
                $no_int_IDO04A03,
                $no_int_IDO04A04,
                $no_int_IDO04A05,
                $no_int_IDO04A06,
                $no_int_IDO04A07,
                $no_int_IDO04A08,
                $no_int_IDO04B01,
                $no_int_IDO04B02,
                $no_int_IDO04B03,
                $no_int_IDO05A01,
                $no_int_IDO05A02,
                $no_int_IDO05A03,
                $no_int_IDO05A04,
                $no_int_IDO05B01,
                $no_int_IDO05B02,
                $no_int_IDO05B03,
                $no_int_IDO05B04,
                $no_int_IDO0601,
                $no_int_IDO0602,
                $no_int_IDO0603,
                $no_int_IDO0604,
                $no_int_jumlah,

                $denominator_int,

                $ok_IDO04A01,
                $ok_IDO04A02,
                $ok_IDO04A03,
                $ok_IDO04A04,
                $ok_IDO04A05,
                $ok_IDO04A06,
                $ok_IDO04A07,
                $ok_IDO04A08,
                $ok_IDO04B01,
                $ok_IDO04B02,
                $ok_IDO04B03,
                $ok_IDO05A01,
                $ok_IDO05A02,
                $ok_IDO05A03,
                $ok_IDO05A04,
                $ok_IDO05B01,
                $ok_IDO05B02,
                $ok_IDO05B03,
                $ok_IDO05B04,
                $ok_IDO0601,
                $ok_IDO0602,
                $ok_IDO0603,
                $ok_IDO0604,
                $ok_jumlah,

                $no_ok_IDO04A01,
                $no_ok_IDO04A02,
                $no_ok_IDO04A03,
                $no_ok_IDO04A04,
                $no_ok_IDO04A05,
                $no_ok_IDO04A06,
                $no_ok_IDO04A07,
                $no_ok_IDO04A08,
                $no_ok_IDO04B01,
                $no_ok_IDO04B02,
                $no_ok_IDO04B03,
                $no_ok_IDO05A01,
                $no_ok_IDO05A02,
                $no_ok_IDO05A03,
                $no_ok_IDO05A04,
                $no_ok_IDO05B01,
                $no_ok_IDO05B02,
                $no_ok_IDO05B03,
                $no_ok_IDO05B04,
                $no_ok_IDO0601,
                $no_ok_IDO0602,
                $no_ok_IDO0603,
                $no_ok_IDO0604,
                $no_ok_jumlah,

                $denominator_ok,

                $lt2_IDO04A01,
                $lt2_IDO04A02,
                $lt2_IDO04A03,
                $lt2_IDO04A04,
                $lt2_IDO04A05,
                $lt2_IDO04A06,
                $lt2_IDO04A07,
                $lt2_IDO04A08,
                $lt2_IDO04B01,
                $lt2_IDO04B02,
                $lt2_IDO04B03,
                $lt2_IDO05A01,
                $lt2_IDO05A02,
                $lt2_IDO05A03,
                $lt2_IDO05A04,
                $lt2_IDO05B01,
                $lt2_IDO05B02,
                $lt2_IDO05B03,
                $lt2_IDO05B04,
                $lt2_IDO0601,
                $lt2_IDO0602,
                $lt2_IDO0603,
                $lt2_IDO0604,
                $lt2_jumlah,

                $no_lt2_IDO04A01,
                $no_lt2_IDO04A02,
                $no_lt2_IDO04A03,
                $no_lt2_IDO04A04,
                $no_lt2_IDO04A05,
                $no_lt2_IDO04A06,
                $no_lt2_IDO04A07,
                $no_lt2_IDO04A08,
                $no_lt2_IDO04B01,
                $no_lt2_IDO04B02,
                $no_lt2_IDO04B03,
                $no_lt2_IDO05A01,
                $no_lt2_IDO05A02,
                $no_lt2_IDO05A03,
                $no_lt2_IDO05A04,
                $no_lt2_IDO05B01,
                $no_lt2_IDO05B02,
                $no_lt2_IDO05B03,
                $no_lt2_IDO05B04,
                $no_lt2_IDO0601,
                $no_lt2_IDO0602,
                $no_lt2_IDO0603,
                $no_lt2_IDO0604,
                $no_lt2_jumlah,

                $denominator_lt2,

                $lt4_IDO04A01,
                $lt4_IDO04A02,
                $lt4_IDO04A03,
                $lt4_IDO04A04,
                $lt4_IDO04A05,
                $lt4_IDO04A06,
                $lt4_IDO04A07,
                $lt4_IDO04A08,
                $lt4_IDO04B01,
                $lt4_IDO04B02,
                $lt4_IDO04B03,
                $lt4_IDO05A01,
                $lt4_IDO05A02,
                $lt4_IDO05A03,
                $lt4_IDO05A04,
                $lt4_IDO05B01,
                $lt4_IDO05B02,
                $lt4_IDO05B03,
                $lt4_IDO05B04,
                $lt4_IDO0601,
                $lt4_IDO0602,
                $lt4_IDO0603,
                $lt4_IDO0604,
                $lt4_jumlah,

                $no_lt4_IDO04A01,
                $no_lt4_IDO04A02,
                $no_lt4_IDO04A03,
                $no_lt4_IDO04A04,
                $no_lt4_IDO04A05,
                $no_lt4_IDO04A06,
                $no_lt4_IDO04A07,
                $no_lt4_IDO04A08,
                $no_lt4_IDO04B01,
                $no_lt4_IDO04B02,
                $no_lt4_IDO04B03,
                $no_lt4_IDO05A01,
                $no_lt4_IDO05A02,
                $no_lt4_IDO05A03,
                $no_lt4_IDO05A04,
                $no_lt4_IDO05B01,
                $no_lt4_IDO05B02,
                $no_lt4_IDO05B03,
                $no_lt4_IDO05B04,
                $no_lt4_IDO0601,
                $no_lt4_IDO0602,
                $no_lt4_IDO0603,
                $no_lt4_IDO0604,
                $no_lt4_jumlah,

                $denominator_lt4,

                $lt5_IDO04A01,
                $lt5_IDO04A02,
                $lt5_IDO04A03,
                $lt5_IDO04A04,
                $lt5_IDO04A05,
                $lt5_IDO04A06,
                $lt5_IDO04A07,
                $lt5_IDO04A08,
                $lt5_IDO04B01,
                $lt5_IDO04B02,
                $lt5_IDO04B03,
                $lt5_IDO05A01,
                $lt5_IDO05A02,
                $lt5_IDO05A03,
                $lt5_IDO05A04,
                $lt5_IDO05B01,
                $lt5_IDO05B02,
                $lt5_IDO05B03,
                $lt5_IDO05B04,
                $lt5_IDO0601,
                $lt5_IDO0602,
                $lt5_IDO0603,
                $lt5_IDO0604,
                $lt5_jumlah,

                $no_lt5_IDO04A01,
                $no_lt5_IDO04A02,
                $no_lt5_IDO04A03,
                $no_lt5_IDO04A04,
                $no_lt5_IDO04A05,
                $no_lt5_IDO04A06,
                $no_lt5_IDO04A07,
                $no_lt5_IDO04A08,
                $no_lt5_IDO04B01,
                $no_lt5_IDO04B02,
                $no_lt5_IDO04B03,
                $no_lt5_IDO05A01,
                $no_lt5_IDO05A02,
                $no_lt5_IDO05A03,
                $no_lt5_IDO05A04,
                $no_lt5_IDO05B01,
                $no_lt5_IDO05B02,
                $no_lt5_IDO05B03,
                $no_lt5_IDO05B04,
                $no_lt5_IDO0601,
                $no_lt5_IDO0602,
                $no_lt5_IDO0603,
                $no_lt5_IDO0604,
                $no_lt5_jumlah,

                $denominator_lt5,

                $vk_IDO04A01,
                $vk_IDO04A02,
                $vk_IDO04A03,
                $vk_IDO04A04,
                $vk_IDO04A05,
                $vk_IDO04A06,
                $vk_IDO04A07,
                $vk_IDO04A08,
                $vk_IDO04B01,
                $vk_IDO04B02,
                $vk_IDO04B03,
                $vk_IDO05A01,
                $vk_IDO05A02,
                $vk_IDO05A03,
                $vk_IDO05A04,
                $vk_IDO05B01,
                $vk_IDO05B02,
                $vk_IDO05B03,
                $vk_IDO05B04,
                $vk_IDO0601,
                $vk_IDO0602,
                $vk_IDO0603,
                $vk_IDO0604,
                $vk_jumlah,

                $no_vk_IDO04A01,
                $no_vk_IDO04A02,
                $no_vk_IDO04A03,
                $no_vk_IDO04A04,
                $no_vk_IDO04A05,
                $no_vk_IDO04A06,
                $no_vk_IDO04A07,
                $no_vk_IDO04A08,
                $no_vk_IDO04B01,
                $no_vk_IDO04B02,
                $no_vk_IDO04B03,
                $no_vk_IDO05A01,
                $no_vk_IDO05A02,
                $no_vk_IDO05A03,
                $no_vk_IDO05A04,
                $no_vk_IDO05B01,
                $no_vk_IDO05B02,
                $no_vk_IDO05B03,
                $no_vk_IDO05B04,
                $no_vk_IDO0601,
                $no_vk_IDO0602,
                $no_vk_IDO0603,
                $no_vk_IDO0604,
                $no_vk_jumlah,

                $denominator_vk,

                $tabel,
                $rekap,
                $tanggal
            ), 'Rekap Bundle IDO ' . $tanggal . '.xlsx');
        } else {
            return Redirect::back()->withErrors(['msg' => 'Tanggal tidak boleh Lebih kecil dari sebelumnya']);
        }
    }

    public function pdf(Request $request)
    {
        $tgl_skg = date('Y-m-d');

        if ($request->input('dari') <= $request->input('sampai')) {
            $tabel = BundleIDO::whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')->paginate(1000);
            // dd($tabel);

            $rekap = RekapBundleIdo::whereDate('dari', '=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('sampai', '=', $request->input('sampai') ?? $tgl_skg)
                ->get();

            $analisa = RekapBundleIdo::select('analisa')
                ->whereDate('dari', '=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('sampai', '=', $request->input('sampai') ?? $tgl_skg)
                ->get();

            $tindak_lanjut = RekapBundleIdo::select('tindak_lanjut')
                ->whereDate('dari', '=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('sampai', '=', $request->input('sampai') ?? $tgl_skg)
                ->get();

            $igd = BundleIDO::where('unit', 'IGD')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $int = BundleIDO::where('unit', 'Intensif')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $ok = BundleIDO::where('unit', 'OK')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt2 = BundleIDO::whereIn('unit', ['Perawatan Eksekutif lt.2', 'Perawatan Padma'])
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt4 = BundleIDO::where('unit', 'Perawatan Reguler lt.4')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $lt5 = BundleIDO::where('unit', 'Perawatan Reguler lt.5')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();
            $vk = BundleIDO::where('unit', 'VK')
                ->whereDate('tgl', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('tgl', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();

            $igd_IDO04A01 = $igd->where('IDO04A01', '1')->count();
            $igd_IDO04A02 = $igd->where('IDO04A02', '1')->count();
            $igd_IDO04A03 = $igd->where('IDO04A03', '1')->count();
            $igd_IDO04A04 = $igd->where('IDO04A04', '1')->count();
            $igd_IDO04A05 = $igd->where('IDO04A05', '1')->count();
            $igd_IDO04A06 = $igd->where('IDO04A06', '1')->count();
            $igd_IDO04A07 = $igd->where('IDO04A07', '1')->count();
            $igd_IDO04A08 = $igd->where('IDO04A08', '1')->count();
            $igd_IDO04B01 = $igd->where('IDO04B01', '1')->count();
            $igd_IDO04B02 = $igd->where('IDO04B01', '1')->count();
            $igd_IDO04B03 = $igd->where('IDO04B01', '1')->count();
            $igd_IDO05A01 = $igd->where('IDO05A01', '1')->count();
            $igd_IDO05A02 = $igd->where('IDO05A02', '1')->count();
            $igd_IDO05A03 = $igd->where('IDO05A03', '1')->count();
            $igd_IDO05A04 = $igd->where('IDO05A04', '1')->count();
            $igd_IDO05B01 = $igd->where('IDO05B01', '1')->count();
            $igd_IDO05B02 = $igd->where('IDO05B02', '1')->count();
            $igd_IDO05B03 = $igd->where('IDO05B03', '1')->count();
            $igd_IDO05B04 = $igd->where('IDO05B04', '1')->count();
            $igd_IDO0601 = $igd->where('IDO0601', '1')->count();
            $igd_IDO0602 = $igd->where('IDO0602', '1')->count();
            $igd_IDO0603 = $igd->where('IDO0603', '1')->count();
            $igd_IDO0604 = $igd->where('IDO0604', '1')->count();
            $igd_jumlah = $igd_IDO04A01 + $igd_IDO04A02 + $igd_IDO04A03 + $igd_IDO04A04 + $igd_IDO04A05 + $igd_IDO04A06 + $igd_IDO04A07 + $igd_IDO04A08 + $igd_IDO04B01 + $igd_IDO04B02 + $igd_IDO04B03 + $igd_IDO05A01 + $igd_IDO05A02 + $igd_IDO05A03 + $igd_IDO05A04 + $igd_IDO05B01 + $igd_IDO05B02 + $igd_IDO05B03 + $igd_IDO05B04 + $igd_IDO0601 + $igd_IDO0602 + $igd_IDO0603 + $igd_IDO0604;

            $no_igd_IDO04A01 = $igd->where('IDO04A01', '0')->count();
            $no_igd_IDO04A02 = $igd->where('IDO04A02', '0')->count();
            $no_igd_IDO04A03 = $igd->where('IDO04A03', '0')->count();
            $no_igd_IDO04A04 = $igd->where('IDO04A04', '0')->count();
            $no_igd_IDO04A05 = $igd->where('IDO04A05', '0')->count();
            $no_igd_IDO04A06 = $igd->where('IDO04A06', '0')->count();
            $no_igd_IDO04A07 = $igd->where('IDO04A07', '0')->count();
            $no_igd_IDO04A08 = $igd->where('IDO04A08', '0')->count();
            $no_igd_IDO04B01 = $igd->where('IDO04B01', '0')->count();
            $no_igd_IDO04B02 = $igd->where('IDO04B01', '0')->count();
            $no_igd_IDO04B03 = $igd->where('IDO04B01', '0')->count();
            $no_igd_IDO05A01 = $igd->where('IDO05A01', '0')->count();
            $no_igd_IDO05A02 = $igd->where('IDO05A02', '0')->count();
            $no_igd_IDO05A03 = $igd->where('IDO05A03', '0')->count();
            $no_igd_IDO05A04 = $igd->where('IDO05A04', '0')->count();
            $no_igd_IDO05B01 = $igd->where('IDO05B01', '0')->count();
            $no_igd_IDO05B02 = $igd->where('IDO05B02', '0')->count();
            $no_igd_IDO05B03 = $igd->where('IDO05B03', '0')->count();
            $no_igd_IDO05B04 = $igd->where('IDO05B04', '0')->count();
            $no_igd_IDO0601 = $igd->where('IDO0601', '0')->count();
            $no_igd_IDO0602 = $igd->where('IDO0602', '0')->count();
            $no_igd_IDO0603 = $igd->where('IDO0603', '0')->count();
            $no_igd_IDO0604 = $igd->where('IDO0604', '0')->count();
            $no_igd_jumlah = $no_igd_IDO04A01 + $no_igd_IDO04A02 + $no_igd_IDO04A03 + $no_igd_IDO04A04 + $no_igd_IDO04A05 + $no_igd_IDO04A06 + $no_igd_IDO04A07 + $no_igd_IDO04A08 + $no_igd_IDO04B01 + $no_igd_IDO04B02 + $no_igd_IDO04B03 + $no_igd_IDO05A01 + $no_igd_IDO05A02 + $no_igd_IDO05A03 + $no_igd_IDO05A04 + $no_igd_IDO05B01 + $no_igd_IDO05B02 + $no_igd_IDO05B03 + $no_igd_IDO05B04 + $no_igd_IDO0601 + $no_igd_IDO0602 + $no_igd_IDO0603 + $no_igd_IDO0604;

            $denominator_igd = $igd_jumlah + $no_igd_jumlah;

            $int_IDO04A01 = $int->where('IDO04A01', '1')->count();
            $int_IDO04A02 = $int->where('IDO04A02', '1')->count();
            $int_IDO04A03 = $int->where('IDO04A03', '1')->count();
            $int_IDO04A04 = $int->where('IDO04A04', '1')->count();
            $int_IDO04A05 = $int->where('IDO04A05', '1')->count();
            $int_IDO04A06 = $int->where('IDO04A06', '1')->count();
            $int_IDO04A07 = $int->where('IDO04A07', '1')->count();
            $int_IDO04A08 = $int->where('IDO04A08', '1')->count();
            $int_IDO04B01 = $int->where('IDO04B01', '1')->count();
            $int_IDO04B02 = $int->where('IDO04B01', '1')->count();
            $int_IDO04B03 = $int->where('IDO04B01', '1')->count();
            $int_IDO05A01 = $int->where('IDO05A01', '1')->count();
            $int_IDO05A02 = $int->where('IDO05A02', '1')->count();
            $int_IDO05A03 = $int->where('IDO05A03', '1')->count();
            $int_IDO05A04 = $int->where('IDO05A04', '1')->count();
            $int_IDO05B01 = $int->where('IDO05B01', '1')->count();
            $int_IDO05B02 = $int->where('IDO05B02', '1')->count();
            $int_IDO05B03 = $int->where('IDO05B03', '1')->count();
            $int_IDO05B04 = $int->where('IDO05B04', '1')->count();
            $int_IDO0601 = $int->where('IDO0601', '1')->count();
            $int_IDO0602 = $int->where('IDO0602', '1')->count();
            $int_IDO0603 = $int->where('IDO0603', '1')->count();
            $int_IDO0604 = $int->where('IDO0604', '1')->count();
            $int_jumlah = $int_IDO04A01 + $int_IDO04A02 + $int_IDO04A03 + $int_IDO04A04 + $int_IDO04A05 + $int_IDO04A06 + $int_IDO04A07 + $int_IDO04A08 + $int_IDO04B01 + $int_IDO04B02 + $int_IDO04B03 + $int_IDO05A01 + $int_IDO05A02 + $int_IDO05A03 + $int_IDO05A04 + $int_IDO05B01 + $int_IDO05B02 + $int_IDO05B03 + $int_IDO05B04 + $int_IDO0601 + $int_IDO0602 + $int_IDO0603 + $int_IDO0604;

            $no_int_IDO04A01 = $int->where('IDO04A01', '0')->count();
            $no_int_IDO04A02 = $int->where('IDO04A02', '0')->count();
            $no_int_IDO04A03 = $int->where('IDO04A03', '0')->count();
            $no_int_IDO04A04 = $int->where('IDO04A04', '0')->count();
            $no_int_IDO04A05 = $int->where('IDO04A05', '0')->count();
            $no_int_IDO04A06 = $int->where('IDO04A06', '0')->count();
            $no_int_IDO04A07 = $int->where('IDO04A07', '0')->count();
            $no_int_IDO04A08 = $int->where('IDO04A08', '0')->count();
            $no_int_IDO04B01 = $int->where('IDO04B01', '0')->count();
            $no_int_IDO04B02 = $int->where('IDO04B01', '0')->count();
            $no_int_IDO04B03 = $int->where('IDO04B01', '0')->count();
            $no_int_IDO05A01 = $int->where('IDO05A01', '0')->count();
            $no_int_IDO05A02 = $int->where('IDO05A02', '0')->count();
            $no_int_IDO05A03 = $int->where('IDO05A03', '0')->count();
            $no_int_IDO05A04 = $int->where('IDO05A04', '0')->count();
            $no_int_IDO05B01 = $int->where('IDO05B01', '0')->count();
            $no_int_IDO05B02 = $int->where('IDO05B02', '0')->count();
            $no_int_IDO05B03 = $int->where('IDO05B03', '0')->count();
            $no_int_IDO05B04 = $int->where('IDO05B04', '0')->count();
            $no_int_IDO0601 = $int->where('IDO0601', '0')->count();
            $no_int_IDO0602 = $int->where('IDO0602', '0')->count();
            $no_int_IDO0603 = $int->where('IDO0603', '0')->count();
            $no_int_IDO0604 = $int->where('IDO0604', '0')->count();
            $no_int_jumlah = $no_int_IDO04A01 + $no_int_IDO04A02 + $no_int_IDO04A03 + $no_int_IDO04A04 + $no_int_IDO04A05 + $no_int_IDO04A06 + $no_int_IDO04A07 + $no_int_IDO04A08 + $no_int_IDO04B01 + $no_int_IDO04B02 + $no_int_IDO04B03 + $no_int_IDO05A01 + $no_int_IDO05A02 + $no_int_IDO05A03 + $no_int_IDO05A04 + $no_int_IDO05B01 + $no_int_IDO05B02 + $no_int_IDO05B03 + $no_int_IDO05B04 + $no_int_IDO0601 + $no_int_IDO0602 + $no_int_IDO0603 + $no_int_IDO0604;

            $denominator_int = $int_jumlah + $no_int_jumlah;

            $ok_IDO04A01 = $ok->where('IDO04A01', '1')->count();
            $ok_IDO04A02 = $ok->where('IDO04A02', '1')->count();
            $ok_IDO04A03 = $ok->where('IDO04A03', '1')->count();
            $ok_IDO04A04 = $ok->where('IDO04A04', '1')->count();
            $ok_IDO04A05 = $ok->where('IDO04A05', '1')->count();
            $ok_IDO04A06 = $ok->where('IDO04A06', '1')->count();
            $ok_IDO04A07 = $ok->where('IDO04A07', '1')->count();
            $ok_IDO04A08 = $ok->where('IDO04A08', '1')->count();
            $ok_IDO04B01 = $ok->where('IDO04B01', '1')->count();
            $ok_IDO04B02 = $ok->where('IDO04B01', '1')->count();
            $ok_IDO04B03 = $ok->where('IDO04B01', '1')->count();
            $ok_IDO05A01 = $ok->where('IDO05A01', '1')->count();
            $ok_IDO05A02 = $ok->where('IDO05A02', '1')->count();
            $ok_IDO05A03 = $ok->where('IDO05A03', '1')->count();
            $ok_IDO05A04 = $ok->where('IDO05A04', '1')->count();
            $ok_IDO05B01 = $ok->where('IDO05B01', '1')->count();
            $ok_IDO05B02 = $ok->where('IDO05B02', '1')->count();
            $ok_IDO05B03 = $ok->where('IDO05B03', '1')->count();
            $ok_IDO05B04 = $ok->where('IDO05B04', '1')->count();
            $ok_IDO0601 = $ok->where('IDO0601', '1')->count();
            $ok_IDO0602 = $ok->where('IDO0602', '1')->count();
            $ok_IDO0603 = $ok->where('IDO0603', '1')->count();
            $ok_IDO0604 = $ok->where('IDO0604', '1')->count();
            $ok_jumlah = $ok_IDO04A01 + $ok_IDO04A02 + $ok_IDO04A03 + $ok_IDO04A04 + $ok_IDO04A05 + $ok_IDO04A06 + $ok_IDO04A07 + $ok_IDO04A08 + $ok_IDO04B01 + $ok_IDO04B02 + $ok_IDO04B03 + $ok_IDO05A01 + $ok_IDO05A02 + $ok_IDO05A03 + $ok_IDO05A04 + $ok_IDO05B01 + $ok_IDO05B02 + $ok_IDO05B03 + $ok_IDO05B04 + $ok_IDO0601 + $ok_IDO0602 + $ok_IDO0603 + $ok_IDO0604;

            $no_ok_IDO04A01 = $ok->where('IDO04A01', '0')->count();
            $no_ok_IDO04A02 = $ok->where('IDO04A02', '0')->count();
            $no_ok_IDO04A03 = $ok->where('IDO04A03', '0')->count();
            $no_ok_IDO04A04 = $ok->where('IDO04A04', '0')->count();
            $no_ok_IDO04A05 = $ok->where('IDO04A05', '0')->count();
            $no_ok_IDO04A06 = $ok->where('IDO04A06', '0')->count();
            $no_ok_IDO04A07 = $ok->where('IDO04A07', '0')->count();
            $no_ok_IDO04A08 = $ok->where('IDO04A08', '0')->count();
            $no_ok_IDO04B01 = $ok->where('IDO04B01', '0')->count();
            $no_ok_IDO04B02 = $ok->where('IDO04B01', '0')->count();
            $no_ok_IDO04B03 = $ok->where('IDO04B01', '0')->count();
            $no_ok_IDO05A01 = $ok->where('IDO05A01', '0')->count();
            $no_ok_IDO05A02 = $ok->where('IDO05A02', '0')->count();
            $no_ok_IDO05A03 = $ok->where('IDO05A03', '0')->count();
            $no_ok_IDO05A04 = $ok->where('IDO05A04', '0')->count();
            $no_ok_IDO05B01 = $ok->where('IDO05B01', '0')->count();
            $no_ok_IDO05B02 = $ok->where('IDO05B02', '0')->count();
            $no_ok_IDO05B03 = $ok->where('IDO05B03', '0')->count();
            $no_ok_IDO05B04 = $ok->where('IDO05B04', '0')->count();
            $no_ok_IDO0601 = $ok->where('IDO0601', '0')->count();
            $no_ok_IDO0602 = $ok->where('IDO0602', '0')->count();
            $no_ok_IDO0603 = $ok->where('IDO0603', '0')->count();
            $no_ok_IDO0604 = $ok->where('IDO0604', '0')->count();
            $no_ok_jumlah = $no_ok_IDO04A01 + $no_ok_IDO04A02 + $no_ok_IDO04A03 + $no_ok_IDO04A04 + $no_ok_IDO04A05 + $no_ok_IDO04A06 + $no_ok_IDO04A07 + $no_ok_IDO04A08 + $no_ok_IDO04B01 + $no_ok_IDO04B02 + $no_ok_IDO04B03 + $no_ok_IDO05A01 + $no_ok_IDO05A02 + $no_ok_IDO05A03 + $no_ok_IDO05A04 + $no_ok_IDO05B01 + $no_ok_IDO05B02 + $no_ok_IDO05B03 + $no_ok_IDO05B04 + $no_ok_IDO0601 + $no_ok_IDO0602 + $no_ok_IDO0603 + $no_ok_IDO0604;

            $denominator_ok = $ok_jumlah + $no_ok_jumlah;

            $lt2_IDO04A01 = $lt2->where('IDO04A01', '1')->count();
            $lt2_IDO04A02 = $lt2->where('IDO04A02', '1')->count();
            $lt2_IDO04A03 = $lt2->where('IDO04A03', '1')->count();
            $lt2_IDO04A04 = $lt2->where('IDO04A04', '1')->count();
            $lt2_IDO04A05 = $lt2->where('IDO04A05', '1')->count();
            $lt2_IDO04A06 = $lt2->where('IDO04A06', '1')->count();
            $lt2_IDO04A07 = $lt2->where('IDO04A07', '1')->count();
            $lt2_IDO04A08 = $lt2->where('IDO04A08', '1')->count();
            $lt2_IDO04B01 = $lt2->where('IDO04B01', '1')->count();
            $lt2_IDO04B02 = $lt2->where('IDO04B01', '1')->count();
            $lt2_IDO04B03 = $lt2->where('IDO04B01', '1')->count();
            $lt2_IDO05A01 = $lt2->where('IDO05A01', '1')->count();
            $lt2_IDO05A02 = $lt2->where('IDO05A02', '1')->count();
            $lt2_IDO05A03 = $lt2->where('IDO05A03', '1')->count();
            $lt2_IDO05A04 = $lt2->where('IDO05A04', '1')->count();
            $lt2_IDO05B01 = $lt2->where('IDO05B01', '1')->count();
            $lt2_IDO05B02 = $lt2->where('IDO05B02', '1')->count();
            $lt2_IDO05B03 = $lt2->where('IDO05B03', '1')->count();
            $lt2_IDO05B04 = $lt2->where('IDO05B04', '1')->count();
            $lt2_IDO0601 = $lt2->where('IDO0601', '1')->count();
            $lt2_IDO0602 = $lt2->where('IDO0602', '1')->count();
            $lt2_IDO0603 = $lt2->where('IDO0603', '1')->count();
            $lt2_IDO0604 = $lt2->where('IDO0604', '1')->count();
            $lt2_jumlah = $lt2_IDO04A01 + $lt2_IDO04A02 + $lt2_IDO04A03 + $lt2_IDO04A04 + $lt2_IDO04A05 + $lt2_IDO04A06 + $lt2_IDO04A07 + $lt2_IDO04A08 + $lt2_IDO04B01 + $lt2_IDO04B02 + $lt2_IDO04B03 + $lt2_IDO05A01 + $lt2_IDO05A02 + $lt2_IDO05A03 + $lt2_IDO05A04 + $lt2_IDO05B01 + $lt2_IDO05B02 + $lt2_IDO05B03 + $lt2_IDO05B04 + $lt2_IDO0601 + $lt2_IDO0602 + $lt2_IDO0603 + $lt2_IDO0604;

            $no_lt2_IDO04A01 = $lt2->where('IDO04A01', '0')->count();
            $no_lt2_IDO04A02 = $lt2->where('IDO04A02', '0')->count();
            $no_lt2_IDO04A03 = $lt2->where('IDO04A03', '0')->count();
            $no_lt2_IDO04A04 = $lt2->where('IDO04A04', '0')->count();
            $no_lt2_IDO04A05 = $lt2->where('IDO04A05', '0')->count();
            $no_lt2_IDO04A06 = $lt2->where('IDO04A06', '0')->count();
            $no_lt2_IDO04A07 = $lt2->where('IDO04A07', '0')->count();
            $no_lt2_IDO04A08 = $lt2->where('IDO04A08', '0')->count();
            $no_lt2_IDO04B01 = $lt2->where('IDO04B01', '0')->count();
            $no_lt2_IDO04B02 = $lt2->where('IDO04B01', '0')->count();
            $no_lt2_IDO04B03 = $lt2->where('IDO04B01', '0')->count();
            $no_lt2_IDO05A01 = $lt2->where('IDO05A01', '0')->count();
            $no_lt2_IDO05A02 = $lt2->where('IDO05A02', '0')->count();
            $no_lt2_IDO05A03 = $lt2->where('IDO05A03', '0')->count();
            $no_lt2_IDO05A04 = $lt2->where('IDO05A04', '0')->count();
            $no_lt2_IDO05B01 = $lt2->where('IDO05B01', '0')->count();
            $no_lt2_IDO05B02 = $lt2->where('IDO05B02', '0')->count();
            $no_lt2_IDO05B03 = $lt2->where('IDO05B03', '0')->count();
            $no_lt2_IDO05B04 = $lt2->where('IDO05B04', '0')->count();
            $no_lt2_IDO0601 = $lt2->where('IDO0601', '0')->count();
            $no_lt2_IDO0602 = $lt2->where('IDO0602', '0')->count();
            $no_lt2_IDO0603 = $lt2->where('IDO0603', '0')->count();
            $no_lt2_IDO0604 = $lt2->where('IDO0604', '0')->count();
            $no_lt2_jumlah = $no_lt2_IDO04A01 + $no_lt2_IDO04A02 + $no_lt2_IDO04A03 + $no_lt2_IDO04A04 + $no_lt2_IDO04A05 + $no_lt2_IDO04A06 + $no_lt2_IDO04A07 + $no_lt2_IDO04A08 + $no_lt2_IDO04B01 + $no_lt2_IDO04B02 + $no_lt2_IDO04B03 + $no_lt2_IDO05A01 + $no_lt2_IDO05A02 + $no_lt2_IDO05A03 + $no_lt2_IDO05A04 + $no_lt2_IDO05B01 + $no_lt2_IDO05B02 + $no_lt2_IDO05B03 + $no_lt2_IDO05B04 + $no_lt2_IDO0601 + $no_lt2_IDO0602 + $no_lt2_IDO0603 + $no_lt2_IDO0604;

            $denominator_lt2 = $lt2_jumlah + $no_lt2_jumlah;

            $lt4_IDO04A01 = $lt4->where('IDO04A01', '1')->count();
            $lt4_IDO04A02 = $lt4->where('IDO04A02', '1')->count();
            $lt4_IDO04A03 = $lt4->where('IDO04A03', '1')->count();
            $lt4_IDO04A04 = $lt4->where('IDO04A04', '1')->count();
            $lt4_IDO04A05 = $lt4->where('IDO04A05', '1')->count();
            $lt4_IDO04A06 = $lt4->where('IDO04A06', '1')->count();
            $lt4_IDO04A07 = $lt4->where('IDO04A07', '1')->count();
            $lt4_IDO04A08 = $lt4->where('IDO04A08', '1')->count();
            $lt4_IDO04B01 = $lt4->where('IDO04B01', '1')->count();
            $lt4_IDO04B02 = $lt4->where('IDO04B01', '1')->count();
            $lt4_IDO04B03 = $lt4->where('IDO04B01', '1')->count();
            $lt4_IDO05A01 = $lt4->where('IDO05A01', '1')->count();
            $lt4_IDO05A02 = $lt4->where('IDO05A02', '1')->count();
            $lt4_IDO05A03 = $lt4->where('IDO05A03', '1')->count();
            $lt4_IDO05A04 = $lt4->where('IDO05A04', '1')->count();
            $lt4_IDO05B01 = $lt4->where('IDO05B01', '1')->count();
            $lt4_IDO05B02 = $lt4->where('IDO05B02', '1')->count();
            $lt4_IDO05B03 = $lt4->where('IDO05B03', '1')->count();
            $lt4_IDO05B04 = $lt4->where('IDO05B04', '1')->count();
            $lt4_IDO0601 = $lt4->where('IDO0601', '1')->count();
            $lt4_IDO0602 = $lt4->where('IDO0602', '1')->count();
            $lt4_IDO0603 = $lt4->where('IDO0603', '1')->count();
            $lt4_IDO0604 = $lt4->where('IDO0604', '1')->count();
            $lt4_jumlah = $lt4_IDO04A01 + $lt4_IDO04A02 + $lt4_IDO04A03 + $lt4_IDO04A04 + $lt4_IDO04A05 + $lt4_IDO04A06 + $lt4_IDO04A07 + $lt4_IDO04A08 + $lt4_IDO04B01 + $lt4_IDO04B02 + $lt4_IDO04B03 + $lt4_IDO05A01 + $lt4_IDO05A02 + $lt4_IDO05A03 + $lt4_IDO05A04 + $lt4_IDO05B01 + $lt4_IDO05B02 + $lt4_IDO05B03 + $lt4_IDO05B04 + $lt4_IDO0601 + $lt4_IDO0602 + $lt4_IDO0603 + $lt4_IDO0604;

            $no_lt4_IDO04A01 = $lt4->where('IDO04A01', '0')->count();
            $no_lt4_IDO04A02 = $lt4->where('IDO04A02', '0')->count();
            $no_lt4_IDO04A03 = $lt4->where('IDO04A03', '0')->count();
            $no_lt4_IDO04A04 = $lt4->where('IDO04A04', '0')->count();
            $no_lt4_IDO04A05 = $lt4->where('IDO04A05', '0')->count();
            $no_lt4_IDO04A06 = $lt4->where('IDO04A06', '0')->count();
            $no_lt4_IDO04A07 = $lt4->where('IDO04A07', '0')->count();
            $no_lt4_IDO04A08 = $lt4->where('IDO04A08', '0')->count();
            $no_lt4_IDO04B01 = $lt4->where('IDO04B01', '0')->count();
            $no_lt4_IDO04B02 = $lt4->where('IDO04B01', '0')->count();
            $no_lt4_IDO04B03 = $lt4->where('IDO04B01', '0')->count();
            $no_lt4_IDO05A01 = $lt4->where('IDO05A01', '0')->count();
            $no_lt4_IDO05A02 = $lt4->where('IDO05A02', '0')->count();
            $no_lt4_IDO05A03 = $lt4->where('IDO05A03', '0')->count();
            $no_lt4_IDO05A04 = $lt4->where('IDO05A04', '0')->count();
            $no_lt4_IDO05B01 = $lt4->where('IDO05B01', '0')->count();
            $no_lt4_IDO05B02 = $lt4->where('IDO05B02', '0')->count();
            $no_lt4_IDO05B03 = $lt4->where('IDO05B03', '0')->count();
            $no_lt4_IDO05B04 = $lt4->where('IDO05B04', '0')->count();
            $no_lt4_IDO0601 = $lt4->where('IDO0601', '0')->count();
            $no_lt4_IDO0602 = $lt4->where('IDO0602', '0')->count();
            $no_lt4_IDO0603 = $lt4->where('IDO0603', '0')->count();
            $no_lt4_IDO0604 = $lt4->where('IDO0604', '0')->count();
            $no_lt4_jumlah = $no_lt4_IDO04A01 + $no_lt4_IDO04A02 + $no_lt4_IDO04A03 + $no_lt4_IDO04A04 + $no_lt4_IDO04A05 + $no_lt4_IDO04A06 + $no_lt4_IDO04A07 + $no_lt4_IDO04A08 + $no_lt4_IDO04B01 + $no_lt4_IDO04B02 + $no_lt4_IDO04B03 + $no_lt4_IDO05A01 + $no_lt4_IDO05A02 + $no_lt4_IDO05A03 + $no_lt4_IDO05A04 + $no_lt4_IDO05B01 + $no_lt4_IDO05B02 + $no_lt4_IDO05B03 + $no_lt4_IDO05B04 + $no_lt4_IDO0601 + $no_lt4_IDO0602 + $no_lt4_IDO0603 + $no_lt4_IDO0604;

            $denominator_lt4 = $lt4_jumlah + $no_lt4_jumlah;

            $lt5_IDO04A01 = $lt5->where('IDO04A01', '1')->count();
            $lt5_IDO04A02 = $lt5->where('IDO04A02', '1')->count();
            $lt5_IDO04A03 = $lt5->where('IDO04A03', '1')->count();
            $lt5_IDO04A04 = $lt5->where('IDO04A04', '1')->count();
            $lt5_IDO04A05 = $lt5->where('IDO04A05', '1')->count();
            $lt5_IDO04A06 = $lt5->where('IDO04A06', '1')->count();
            $lt5_IDO04A07 = $lt5->where('IDO04A07', '1')->count();
            $lt5_IDO04A08 = $lt5->where('IDO04A08', '1')->count();
            $lt5_IDO04B01 = $lt5->where('IDO04B01', '1')->count();
            $lt5_IDO04B02 = $lt5->where('IDO04B01', '1')->count();
            $lt5_IDO04B03 = $lt5->where('IDO04B01', '1')->count();
            $lt5_IDO05A01 = $lt5->where('IDO05A01', '1')->count();
            $lt5_IDO05A02 = $lt5->where('IDO05A02', '1')->count();
            $lt5_IDO05A03 = $lt5->where('IDO05A03', '1')->count();
            $lt5_IDO05A04 = $lt5->where('IDO05A04', '1')->count();
            $lt5_IDO05B01 = $lt5->where('IDO05B01', '1')->count();
            $lt5_IDO05B02 = $lt5->where('IDO05B02', '1')->count();
            $lt5_IDO05B03 = $lt5->where('IDO05B03', '1')->count();
            $lt5_IDO05B04 = $lt5->where('IDO05B04', '1')->count();
            $lt5_IDO0601 = $lt5->where('IDO0601', '1')->count();
            $lt5_IDO0602 = $lt5->where('IDO0602', '1')->count();
            $lt5_IDO0603 = $lt5->where('IDO0603', '1')->count();
            $lt5_IDO0604 = $lt5->where('IDO0604', '1')->count();
            $lt5_jumlah = $lt5_IDO04A01 + $lt5_IDO04A02 + $lt5_IDO04A03 + $lt5_IDO04A04 + $lt5_IDO04A05 + $lt5_IDO04A06 + $lt5_IDO04A07 + $lt5_IDO04A08 + $lt5_IDO04B01 + $lt5_IDO04B02 + $lt5_IDO04B03 + $lt5_IDO05A01 + $lt5_IDO05A02 + $lt5_IDO05A03 + $lt5_IDO05A04 + $lt5_IDO05B01 + $lt5_IDO05B02 + $lt5_IDO05B03 + $lt5_IDO05B04 + $lt5_IDO0601 + $lt5_IDO0602 + $lt5_IDO0603 + $lt5_IDO0604;

            $no_lt5_IDO04A01 = $lt5->where('IDO04A01', '0')->count();
            $no_lt5_IDO04A02 = $lt5->where('IDO04A02', '0')->count();
            $no_lt5_IDO04A03 = $lt5->where('IDO04A03', '0')->count();
            $no_lt5_IDO04A04 = $lt5->where('IDO04A04', '0')->count();
            $no_lt5_IDO04A05 = $lt5->where('IDO04A05', '0')->count();
            $no_lt5_IDO04A06 = $lt5->where('IDO04A06', '0')->count();
            $no_lt5_IDO04A07 = $lt5->where('IDO04A07', '0')->count();
            $no_lt5_IDO04A08 = $lt5->where('IDO04A08', '0')->count();
            $no_lt5_IDO04B01 = $lt5->where('IDO04B01', '0')->count();
            $no_lt5_IDO04B02 = $lt5->where('IDO04B01', '0')->count();
            $no_lt5_IDO04B03 = $lt5->where('IDO04B01', '0')->count();
            $no_lt5_IDO05A01 = $lt5->where('IDO05A01', '0')->count();
            $no_lt5_IDO05A02 = $lt5->where('IDO05A02', '0')->count();
            $no_lt5_IDO05A03 = $lt5->where('IDO05A03', '0')->count();
            $no_lt5_IDO05A04 = $lt5->where('IDO05A04', '0')->count();
            $no_lt5_IDO05B01 = $lt5->where('IDO05B01', '0')->count();
            $no_lt5_IDO05B02 = $lt5->where('IDO05B02', '0')->count();
            $no_lt5_IDO05B03 = $lt5->where('IDO05B03', '0')->count();
            $no_lt5_IDO05B04 = $lt5->where('IDO05B04', '0')->count();
            $no_lt5_IDO0601 = $lt5->where('IDO0601', '0')->count();
            $no_lt5_IDO0602 = $lt5->where('IDO0602', '0')->count();
            $no_lt5_IDO0603 = $lt5->where('IDO0603', '0')->count();
            $no_lt5_IDO0604 = $lt5->where('IDO0604', '0')->count();
            $no_lt5_jumlah = $no_lt5_IDO04A01 + $no_lt5_IDO04A02 + $no_lt5_IDO04A03 + $no_lt5_IDO04A04 + $no_lt5_IDO04A05 + $no_lt5_IDO04A06 + $no_lt5_IDO04A07 + $no_lt5_IDO04A08 + $no_lt5_IDO04B01 + $no_lt5_IDO04B02 + $no_lt5_IDO04B03 + $no_lt5_IDO05A01 + $no_lt5_IDO05A02 + $no_lt5_IDO05A03 + $no_lt5_IDO05A04 + $no_lt5_IDO05B01 + $no_lt5_IDO05B02 + $no_lt5_IDO05B03 + $no_lt5_IDO05B04 + $no_lt5_IDO0601 + $no_lt5_IDO0602 + $no_lt5_IDO0603 + $no_lt5_IDO0604;

            $denominator_lt5 = $lt5_jumlah + $no_lt5_jumlah;

            $vk_IDO04A01 = $vk->where('IDO04A01', '1')->count();
            $vk_IDO04A02 = $vk->where('IDO04A02', '1')->count();
            $vk_IDO04A03 = $vk->where('IDO04A03', '1')->count();
            $vk_IDO04A04 = $vk->where('IDO04A04', '1')->count();
            $vk_IDO04A05 = $vk->where('IDO04A05', '1')->count();
            $vk_IDO04A06 = $vk->where('IDO04A06', '1')->count();
            $vk_IDO04A07 = $vk->where('IDO04A07', '1')->count();
            $vk_IDO04A08 = $vk->where('IDO04A08', '1')->count();
            $vk_IDO04B01 = $vk->where('IDO04B01', '1')->count();
            $vk_IDO04B02 = $vk->where('IDO04B01', '1')->count();
            $vk_IDO04B03 = $vk->where('IDO04B01', '1')->count();
            $vk_IDO05A01 = $vk->where('IDO05A01', '1')->count();
            $vk_IDO05A02 = $vk->where('IDO05A02', '1')->count();
            $vk_IDO05A03 = $vk->where('IDO05A03', '1')->count();
            $vk_IDO05A04 = $vk->where('IDO05A04', '1')->count();
            $vk_IDO05B01 = $vk->where('IDO05B01', '1')->count();
            $vk_IDO05B02 = $vk->where('IDO05B02', '1')->count();
            $vk_IDO05B03 = $vk->where('IDO05B03', '1')->count();
            $vk_IDO05B04 = $vk->where('IDO05B04', '1')->count();
            $vk_IDO0601 = $vk->where('IDO0601', '1')->count();
            $vk_IDO0602 = $vk->where('IDO0602', '1')->count();
            $vk_IDO0603 = $vk->where('IDO0603', '1')->count();
            $vk_IDO0604 = $vk->where('IDO0604', '1')->count();
            $vk_jumlah = $vk_IDO04A01 + $vk_IDO04A02 + $vk_IDO04A03 + $vk_IDO04A04 + $vk_IDO04A05 + $vk_IDO04A06 + $vk_IDO04A07 + $vk_IDO04A08 + $vk_IDO04B01 + $vk_IDO04B02 + $vk_IDO04B03 + $vk_IDO05A01 + $vk_IDO05A02 + $vk_IDO05A03 + $vk_IDO05A04 + $vk_IDO05B01 + $vk_IDO05B02 + $vk_IDO05B03 + $vk_IDO05B04 + $vk_IDO0601 + $vk_IDO0602 + $vk_IDO0603 + $vk_IDO0604;

            $no_vk_IDO04A01 = $vk->where('IDO04A01', '0')->count();
            $no_vk_IDO04A02 = $vk->where('IDO04A02', '0')->count();
            $no_vk_IDO04A03 = $vk->where('IDO04A03', '0')->count();
            $no_vk_IDO04A04 = $vk->where('IDO04A04', '0')->count();
            $no_vk_IDO04A05 = $vk->where('IDO04A05', '0')->count();
            $no_vk_IDO04A06 = $vk->where('IDO04A06', '0')->count();
            $no_vk_IDO04A07 = $vk->where('IDO04A07', '0')->count();
            $no_vk_IDO04A08 = $vk->where('IDO04A08', '0')->count();
            $no_vk_IDO04B01 = $vk->where('IDO04B01', '0')->count();
            $no_vk_IDO04B02 = $vk->where('IDO04B01', '0')->count();
            $no_vk_IDO04B03 = $vk->where('IDO04B01', '0')->count();
            $no_vk_IDO05A01 = $vk->where('IDO05A01', '0')->count();
            $no_vk_IDO05A02 = $vk->where('IDO05A02', '0')->count();
            $no_vk_IDO05A03 = $vk->where('IDO05A03', '0')->count();
            $no_vk_IDO05A04 = $vk->where('IDO05A04', '0')->count();
            $no_vk_IDO05B01 = $vk->where('IDO05B01', '0')->count();
            $no_vk_IDO05B02 = $vk->where('IDO05B02', '0')->count();
            $no_vk_IDO05B03 = $vk->where('IDO05B03', '0')->count();
            $no_vk_IDO05B04 = $vk->where('IDO05B04', '0')->count();
            $no_vk_IDO0601 = $vk->where('IDO0601', '0')->count();
            $no_vk_IDO0602 = $vk->where('IDO0602', '0')->count();
            $no_vk_IDO0603 = $vk->where('IDO0603', '0')->count();
            $no_vk_IDO0604 = $vk->where('IDO0604', '0')->count();
            $no_vk_jumlah = $no_vk_IDO04A01 + $no_vk_IDO04A02 + $no_vk_IDO04A03 + $no_vk_IDO04A04 + $no_vk_IDO04A05 + $no_vk_IDO04A06 + $no_vk_IDO04A07 + $no_vk_IDO04A08 + $no_vk_IDO04B01 + $no_vk_IDO04B02 + $no_vk_IDO04B03 + $no_vk_IDO05A01 + $no_vk_IDO05A02 + $no_vk_IDO05A03 + $no_vk_IDO05A04 + $no_vk_IDO05B01 + $no_vk_IDO05B02 + $no_vk_IDO05B03 + $no_vk_IDO05B04 + $no_vk_IDO0601 + $no_vk_IDO0602 + $no_vk_IDO0603 + $no_vk_IDO0604;

            $denominator_vk = $vk_jumlah + $no_vk_jumlah;

            $tanggal = Carbon::parse($request->input('dari'))->isoFormat('DD MMMM YYYY') . ' - ' . Carbon::parse($request->input('sampai'))->isoFormat('DD MMMM YYYY');

            return Excel::download(new ExportBundleIDO(
                $igd_IDO04A01,
                $igd_IDO04A02,
                $igd_IDO04A03,
                $igd_IDO04A04,
                $igd_IDO04A05,
                $igd_IDO04A06,
                $igd_IDO04A07,
                $igd_IDO04A08,
                $igd_IDO04B01,
                $igd_IDO04B02,
                $igd_IDO04B03,
                $igd_IDO05A01,
                $igd_IDO05A02,
                $igd_IDO05A03,
                $igd_IDO05A04,
                $igd_IDO05B01,
                $igd_IDO05B02,
                $igd_IDO05B03,
                $igd_IDO05B04,
                $igd_IDO0601,
                $igd_IDO0602,
                $igd_IDO0603,
                $igd_IDO0604,
                $igd_jumlah,

                $no_igd_IDO04A01,
                $no_igd_IDO04A02,
                $no_igd_IDO04A03,
                $no_igd_IDO04A04,
                $no_igd_IDO04A05,
                $no_igd_IDO04A06,
                $no_igd_IDO04A07,
                $no_igd_IDO04A08,
                $no_igd_IDO04B01,
                $no_igd_IDO04B02,
                $no_igd_IDO04B03,
                $no_igd_IDO05A01,
                $no_igd_IDO05A02,
                $no_igd_IDO05A03,
                $no_igd_IDO05A04,
                $no_igd_IDO05B01,
                $no_igd_IDO05B02,
                $no_igd_IDO05B03,
                $no_igd_IDO05B04,
                $no_igd_IDO0601,
                $no_igd_IDO0602,
                $no_igd_IDO0603,
                $no_igd_IDO0604,
                $no_igd_jumlah,

                $denominator_igd,

                $int_IDO04A01,
                $int_IDO04A02,
                $int_IDO04A03,
                $int_IDO04A04,
                $int_IDO04A05,
                $int_IDO04A06,
                $int_IDO04A07,
                $int_IDO04A08,
                $int_IDO04B01,
                $int_IDO04B02,
                $int_IDO04B03,
                $int_IDO05A01,
                $int_IDO05A02,
                $int_IDO05A03,
                $int_IDO05A04,
                $int_IDO05B01,
                $int_IDO05B02,
                $int_IDO05B03,
                $int_IDO05B04,
                $int_IDO0601,
                $int_IDO0602,
                $int_IDO0603,
                $int_IDO0604,
                $int_jumlah,

                $no_int_IDO04A01,
                $no_int_IDO04A02,
                $no_int_IDO04A03,
                $no_int_IDO04A04,
                $no_int_IDO04A05,
                $no_int_IDO04A06,
                $no_int_IDO04A07,
                $no_int_IDO04A08,
                $no_int_IDO04B01,
                $no_int_IDO04B02,
                $no_int_IDO04B03,
                $no_int_IDO05A01,
                $no_int_IDO05A02,
                $no_int_IDO05A03,
                $no_int_IDO05A04,
                $no_int_IDO05B01,
                $no_int_IDO05B02,
                $no_int_IDO05B03,
                $no_int_IDO05B04,
                $no_int_IDO0601,
                $no_int_IDO0602,
                $no_int_IDO0603,
                $no_int_IDO0604,
                $no_int_jumlah,

                $denominator_int,

                $ok_IDO04A01,
                $ok_IDO04A02,
                $ok_IDO04A03,
                $ok_IDO04A04,
                $ok_IDO04A05,
                $ok_IDO04A06,
                $ok_IDO04A07,
                $ok_IDO04A08,
                $ok_IDO04B01,
                $ok_IDO04B02,
                $ok_IDO04B03,
                $ok_IDO05A01,
                $ok_IDO05A02,
                $ok_IDO05A03,
                $ok_IDO05A04,
                $ok_IDO05B01,
                $ok_IDO05B02,
                $ok_IDO05B03,
                $ok_IDO05B04,
                $ok_IDO0601,
                $ok_IDO0602,
                $ok_IDO0603,
                $ok_IDO0604,
                $ok_jumlah,

                $no_ok_IDO04A01,
                $no_ok_IDO04A02,
                $no_ok_IDO04A03,
                $no_ok_IDO04A04,
                $no_ok_IDO04A05,
                $no_ok_IDO04A06,
                $no_ok_IDO04A07,
                $no_ok_IDO04A08,
                $no_ok_IDO04B01,
                $no_ok_IDO04B02,
                $no_ok_IDO04B03,
                $no_ok_IDO05A01,
                $no_ok_IDO05A02,
                $no_ok_IDO05A03,
                $no_ok_IDO05A04,
                $no_ok_IDO05B01,
                $no_ok_IDO05B02,
                $no_ok_IDO05B03,
                $no_ok_IDO05B04,
                $no_ok_IDO0601,
                $no_ok_IDO0602,
                $no_ok_IDO0603,
                $no_ok_IDO0604,
                $no_ok_jumlah,

                $denominator_ok,

                $lt2_IDO04A01,
                $lt2_IDO04A02,
                $lt2_IDO04A03,
                $lt2_IDO04A04,
                $lt2_IDO04A05,
                $lt2_IDO04A06,
                $lt2_IDO04A07,
                $lt2_IDO04A08,
                $lt2_IDO04B01,
                $lt2_IDO04B02,
                $lt2_IDO04B03,
                $lt2_IDO05A01,
                $lt2_IDO05A02,
                $lt2_IDO05A03,
                $lt2_IDO05A04,
                $lt2_IDO05B01,
                $lt2_IDO05B02,
                $lt2_IDO05B03,
                $lt2_IDO05B04,
                $lt2_IDO0601,
                $lt2_IDO0602,
                $lt2_IDO0603,
                $lt2_IDO0604,
                $lt2_jumlah,

                $no_lt2_IDO04A01,
                $no_lt2_IDO04A02,
                $no_lt2_IDO04A03,
                $no_lt2_IDO04A04,
                $no_lt2_IDO04A05,
                $no_lt2_IDO04A06,
                $no_lt2_IDO04A07,
                $no_lt2_IDO04A08,
                $no_lt2_IDO04B01,
                $no_lt2_IDO04B02,
                $no_lt2_IDO04B03,
                $no_lt2_IDO05A01,
                $no_lt2_IDO05A02,
                $no_lt2_IDO05A03,
                $no_lt2_IDO05A04,
                $no_lt2_IDO05B01,
                $no_lt2_IDO05B02,
                $no_lt2_IDO05B03,
                $no_lt2_IDO05B04,
                $no_lt2_IDO0601,
                $no_lt2_IDO0602,
                $no_lt2_IDO0603,
                $no_lt2_IDO0604,
                $no_lt2_jumlah,

                $denominator_lt2,

                $lt4_IDO04A01,
                $lt4_IDO04A02,
                $lt4_IDO04A03,
                $lt4_IDO04A04,
                $lt4_IDO04A05,
                $lt4_IDO04A06,
                $lt4_IDO04A07,
                $lt4_IDO04A08,
                $lt4_IDO04B01,
                $lt4_IDO04B02,
                $lt4_IDO04B03,
                $lt4_IDO05A01,
                $lt4_IDO05A02,
                $lt4_IDO05A03,
                $lt4_IDO05A04,
                $lt4_IDO05B01,
                $lt4_IDO05B02,
                $lt4_IDO05B03,
                $lt4_IDO05B04,
                $lt4_IDO0601,
                $lt4_IDO0602,
                $lt4_IDO0603,
                $lt4_IDO0604,
                $lt4_jumlah,

                $no_lt4_IDO04A01,
                $no_lt4_IDO04A02,
                $no_lt4_IDO04A03,
                $no_lt4_IDO04A04,
                $no_lt4_IDO04A05,
                $no_lt4_IDO04A06,
                $no_lt4_IDO04A07,
                $no_lt4_IDO04A08,
                $no_lt4_IDO04B01,
                $no_lt4_IDO04B02,
                $no_lt4_IDO04B03,
                $no_lt4_IDO05A01,
                $no_lt4_IDO05A02,
                $no_lt4_IDO05A03,
                $no_lt4_IDO05A04,
                $no_lt4_IDO05B01,
                $no_lt4_IDO05B02,
                $no_lt4_IDO05B03,
                $no_lt4_IDO05B04,
                $no_lt4_IDO0601,
                $no_lt4_IDO0602,
                $no_lt4_IDO0603,
                $no_lt4_IDO0604,
                $no_lt4_jumlah,

                $denominator_lt4,

                $lt5_IDO04A01,
                $lt5_IDO04A02,
                $lt5_IDO04A03,
                $lt5_IDO04A04,
                $lt5_IDO04A05,
                $lt5_IDO04A06,
                $lt5_IDO04A07,
                $lt5_IDO04A08,
                $lt5_IDO04B01,
                $lt5_IDO04B02,
                $lt5_IDO04B03,
                $lt5_IDO05A01,
                $lt5_IDO05A02,
                $lt5_IDO05A03,
                $lt5_IDO05A04,
                $lt5_IDO05B01,
                $lt5_IDO05B02,
                $lt5_IDO05B03,
                $lt5_IDO05B04,
                $lt5_IDO0601,
                $lt5_IDO0602,
                $lt5_IDO0603,
                $lt5_IDO0604,
                $lt5_jumlah,

                $no_lt5_IDO04A01,
                $no_lt5_IDO04A02,
                $no_lt5_IDO04A03,
                $no_lt5_IDO04A04,
                $no_lt5_IDO04A05,
                $no_lt5_IDO04A06,
                $no_lt5_IDO04A07,
                $no_lt5_IDO04A08,
                $no_lt5_IDO04B01,
                $no_lt5_IDO04B02,
                $no_lt5_IDO04B03,
                $no_lt5_IDO05A01,
                $no_lt5_IDO05A02,
                $no_lt5_IDO05A03,
                $no_lt5_IDO05A04,
                $no_lt5_IDO05B01,
                $no_lt5_IDO05B02,
                $no_lt5_IDO05B03,
                $no_lt5_IDO05B04,
                $no_lt5_IDO0601,
                $no_lt5_IDO0602,
                $no_lt5_IDO0603,
                $no_lt5_IDO0604,
                $no_lt5_jumlah,

                $denominator_lt5,

                $vk_IDO04A01,
                $vk_IDO04A02,
                $vk_IDO04A03,
                $vk_IDO04A04,
                $vk_IDO04A05,
                $vk_IDO04A06,
                $vk_IDO04A07,
                $vk_IDO04A08,
                $vk_IDO04B01,
                $vk_IDO04B02,
                $vk_IDO04B03,
                $vk_IDO05A01,
                $vk_IDO05A02,
                $vk_IDO05A03,
                $vk_IDO05A04,
                $vk_IDO05B01,
                $vk_IDO05B02,
                $vk_IDO05B03,
                $vk_IDO05B04,
                $vk_IDO0601,
                $vk_IDO0602,
                $vk_IDO0603,
                $vk_IDO0604,
                $vk_jumlah,

                $no_vk_IDO04A01,
                $no_vk_IDO04A02,
                $no_vk_IDO04A03,
                $no_vk_IDO04A04,
                $no_vk_IDO04A05,
                $no_vk_IDO04A06,
                $no_vk_IDO04A07,
                $no_vk_IDO04A08,
                $no_vk_IDO04B01,
                $no_vk_IDO04B02,
                $no_vk_IDO04B03,
                $no_vk_IDO05A01,
                $no_vk_IDO05A02,
                $no_vk_IDO05A03,
                $no_vk_IDO05A04,
                $no_vk_IDO05B01,
                $no_vk_IDO05B02,
                $no_vk_IDO05B03,
                $no_vk_IDO05B04,
                $no_vk_IDO0601,
                $no_vk_IDO0602,
                $no_vk_IDO0603,
                $no_vk_IDO0604,
                $no_vk_jumlah,

                $denominator_vk,

                $tabel,
                $rekap,
                $tanggal
            ), 'Rekap Bundle IDO ' . $tanggal . '.pdf', \Maatwebsite\Excel\Excel::MPDF);
        } else {
            return Redirect::back()->withErrors(['msg' => 'Tanggal tidak boleh Lebih kecil dari sebelumnya']);
        }
    }
}
