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
        $feedback = Feedback::latest('id')->paginate(10);

        // return view('feedbackPPI.index')->with('feedback', $feedback);
        return view('feedbackPPI.index', compact('feedback'));
    }

    public function save(Request $request)
    {
        $request->validate([
            'bagian' => 'required',
            'tgl_input' => 'required',
            'judul' => 'required',
            'dokumen' => 'required|mimes:pdf',
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
        // if ($request->hasFile('dokumen')) {
        //     $data->dokumen = $request->file('dokumen')->getClientOriginalName();
        //     $request->file('dokumen')->storeAs('public/dokumen', $data->dokumen);
        // }
        $data->save();

        return redirect('/feedback')->with('success', 'Dokumen berhasil diupload!');
    }

    public function update(Request $request, $id)
    {
        // $feedback = Feedback::find($id);
        // $input = $request->all();
        // $feedback->fill($input)->save();
        // ===================================================================================
        $feedback = Feedback::find($id);
        $feedback->bagian = $request->input('bagian');
        $feedback->tgl_input = $request->input('tgl_input');
        $feedback->judul = $request->input('judul');

        if ($request->file('dokumen')) {
            $lokasi_dokumen = 'dokumen/' . $feedback->dokumen;
            if (File::exists($lokasi_dokumen)) {
                File::delete($lokasi_dokumen);
            }
            $dokumen = $request->file('dokumen');
            $nama_dokumen = $dokumen->getClientOriginalName();
            $dokumen->move('dokumen/', $nama_dokumen);
            $feedback->dokumen = $nama_dokumen;
        }

        $feedback->update();
        // ==============================================================================
        // $request->validate([
        //     'bagian' => 'required',
        //     'tgl_input' => 'required',
        //     'judul' => 'required',
        //     'dokumen' => 'nullable|mimes:pdf',
        //     // 'dokumen' => 'mimes:doc,docx,pdf,csv,xls,xlsx,ppt,pptx',
        // ]);

        // $feedback->bagian = $request->bagian;
        // $feedback->tgl_input = $request->tgl_input;
        // $feedback->judul = $request->judul;

        // if ($request->hasFile('dokumen')) {
        //     $nama_dokumen = $request->file('dokumen')->getClientOriginalName();
        //     $request->file('dokumen')->storeAs('public/dokumen', $nama_dokumen);
        // }

        // $feedback->save();

        return redirect('/feedback')->with('success', 'Data berhasil diubah!');;
    }

    public function destroy($id)
    {
        $feedback = Feedback::find($id);
        $feedback->delete();

        return redirect('/feedback');
    }
}
