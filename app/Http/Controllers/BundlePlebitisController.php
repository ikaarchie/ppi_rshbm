<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BundlePlebitis;

class BundlePlebitisController extends Controller
{
    public function index()
    {
        return view('bundlePlebitis.index');
    }

    public function getData()
    {
        $bundlePlebitis = BundlePlebitis::latest('id')->paginate(1000);

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
}
