<?php

namespace App\Http\Controllers;

use App\Models\BundleIAD;
use Illuminate\Http\Request;

class BundleIADController extends Controller
{
    public function index()
    {
        return view('bundleIAD.index');
    }

    public function getData()
    {
        $bundleIAD = BundleIAD::latest('id')->paginate(1000);

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
}
