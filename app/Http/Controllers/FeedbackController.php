<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class FeedbackController extends Controller
{
    public function index()
    {
        return view('feedbackPPI.index');
    }

    public function getData()
    {
        $feedback = Feedback::latest('id')->paginate(1000);

        return view('feedbackPPI.index')->with('feedback', $feedback);
    }

    public function save(Request $request)
    {
        $this->validate($request, [
            'bagian' => 'required',
            'tgl_input' => 'required',
            'judul' => 'required',
            'dokumen' => 'mimes:pdf',
            // 'dokumen' => 'mimes:doc,docx,pdf,csv,xls,xlsx,ppt,pptx',
        ]);

        $dokumen = $request->file('dokumen');
        $nama_dokumen = $dokumen->getClientOriginalName();
        $dokumen->move('dokumen/', $nama_dokumen);

        $data = new Feedback();
        $data->bagian = $request->input('bagian');
        $data->tgl_input = $request->input('tgl_input');
        $data->judul = $request->input('judul');
        $data->dokumen = $nama_dokumen;
        $data->save();

        return redirect('/feedback')->with('success', 'Data berhasil disimpan!');
    }

    public function update(Request $request, $id)
    {
        $feedback = Feedback::find($id);
        $input = $request->all();
        $feedback->fill($input)->save();

        // $feedback = Feedback::find($id);
        // $feedback->bagian = $request->input('bagian');
        // $feedback->tgl_input = $request->input('tgl_input');
        // $feedback->judul = $request->input('judul');

        // if ($request->file('dokumen')) {
        //     $lokasi_dokumen = 'dokumen/' . $feedback->dokumen;
        //     if (File::exists($lokasi_dokumen)) {
        //         File::delete($lokasi_dokumen);
        //     }
        //     $dokumen = $request->file('dokumen');
        //     $nama_dokumen = $dokumen->getClientOriginalName();
        //     $dokumen->move('dokumen/', $nama_dokumen);
        //     $feedback->dokumen = $nama_dokumen;
        // }

        // $feedback->update();

        return redirect('/feedback');
    }

    public function destroy($id)
    {
        $feedback = Feedback::find($id);
        $feedback->delete();

        return redirect('/feedback');
    }
}
