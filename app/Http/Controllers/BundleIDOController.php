<?php

namespace App\Http\Controllers;

use App\Models\BundleIDO;
use Illuminate\Http\Request;

class BundleIDOController extends Controller
{
    public function index()
    {
        return view('bundleIDO.index');
    }

    public function getData()
    {
        $bundleIDO = BundleIDO::latest('id')->paginate(1000);

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
}
