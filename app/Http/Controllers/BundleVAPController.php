<?php

namespace App\Http\Controllers;

use App\Models\BundleVAP;
use Illuminate\Http\Request;

class BundleVAPController extends Controller
{
    public function index()
    {
        return view('bundleVAP.index');
    }

    public function getData()
    {
        $bundleVAP = BundleVAP::latest('id')->paginate(1000);

        return view('bundleVAP.index')->with('bundleVAP', $bundleVAP);
    }

    public function save(Request $request)
    {
        $data = new BundleVAP();
        $data->mrn = $request->input('mrn');
        $data->nama_pasien = $request->input('nama_pasien');
        $data->diagnosa = $request->input('diagnosa');
        $data->unit = $request->input('unit');
        $data->tgl = $request->input('tgl');
        $data->VAP0101 = $request->input('VAP0101');
        $data->VAP0102 = $request->input('VAP0102');
        $data->VAP0103 = $request->input('VAP0103');
        $data->VAP0104 = $request->input('VAP0104');
        $data->VAP0201 = $request->input('VAP0201');
        $data->VAP0202 = $request->input('VAP0202');
        $data->VAP0203 = $request->input('VAP0203');
        $data->VAP0204 = $request->input('VAP0204');
        $data->VAP0205 = $request->input('VAP0205');
        $data->VAP0206 = $request->input('VAP0206');
        $data->VAP0207 = $request->input('VAP0207');
        $data->VAP0208 = $request->input('VAP0208');
        $data->save();

        return redirect('/bundleVap')->with('success', 'Data berhasil disimpan!');
    }

    public function update(Request $request, $id)
    {
        $bundleVAP = BundleVAP::find($id);
        $input = $request->all();
        $bundleVAP->fill($input)->save();

        return redirect('/bundleVap');
    }

    public function destroy($id)
    {
        $bundleVAP = BundleVAP::find($id);
        $bundleVAP->delete();

        return redirect('/bundleVap');
    }
}
