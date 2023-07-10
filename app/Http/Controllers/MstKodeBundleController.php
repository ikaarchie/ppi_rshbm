<?php

namespace App\Http\Controllers;

use App\Models\MstKodeBundle;
use Illuminate\Http\Request;

class MstKodeBundleController extends Controller
{
    public function index()
    {
        return view('mstKodeBundle.index');
    }

    public function getData()
    {
        $mstKodeBundle = MstKodeBundle::latest('id')->paginate(1000);

        return view('mstKodeBundle.index')->with('mstKodeBundle', $mstKodeBundle);
    }

    public function save(Request $request)
    {
        $data = new MstKodeBundle();
        $data->kode = $request->input('kode');
        $data->deskripsi = $request->input('deskripsi');
        $data->fungsi = $request->input('fungsi');
        $data->jenis = $request->input('jenis');
        $data->save();

        return redirect('/mstKodeBundle')->with('success', 'Data berhasil disimpan!');
    }

    public function update(Request $request, $id)
    {
        $mstKodeBundle = MstKodeBundle::find($id);
        $input = $request->all();
        $mstKodeBundle->fill($input)->save();

        return redirect('/mstKodeBundle');
    }

    public function destroy($id)
    {
        $mstKodeBundle = MstKodeBundle::find($id);
        $mstKodeBundle->delete();

        return redirect('/mstKodeBundle');
    }
}
