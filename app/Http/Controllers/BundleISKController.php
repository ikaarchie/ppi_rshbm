<?php

namespace App\Http\Controllers;

use App\Models\BundleISK;
use Illuminate\Http\Request;

class BundleISKController extends Controller
{
    public function index()
    {
        return view('bundleISK.index');
    }

    public function getData()
    {
        $bundleISK = BundleISK::latest('id')->paginate(1000);

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
}
