<?php

namespace App\Http\Controllers;

use App\Models\Gejala;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class GejalaController extends Controller
{
    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'kategori_gejala_id' => ['required'],
            'hama' => ['required'],
            'nama_gejala' => ['required','string','min:5']
            ]);
        if ($validator->fails()) {
            Alert::warning('Warning', 'Failed Create!!');
            return redirect()->back()
                ->withInput();
        }
        Gejala::create([
            'kategori_gejala_id' => $request->kategori_gejala,
            'hama_id' => $request->hama,
            'nama_gejala' => $request->nama_gejala
        ]);
        toast('Success Create!', 'success');
        return redirect()->back();
    }
    public function edit(Request $request,Gejala $gejala)
    {
        $validator = Validator::make($request->all(), [
            'kategori_gejala_id' => ['required'],
            'hama' => ['required'],
            'nama_gejala' => ['required','string','min:5']
            ]);
        if ($validator->fails()) {
            Alert::warning('Warning', 'Failed Update!!');
            return redirect()->back()
                ->withInput();
        }
        $gejala->update([
            'kategori_gejala_id' => $request->kategori_gejala,
            'hama_id' => $request->hama,
            'nama_gejala' => $request->nama_gejala
        ]);
        toast('Success Edit!', 'success');
        return redirect()->back();
    }
    public function delete(Gejala $gejala)
    {
        $gejala->delete();
        toast('Success Delete!', 'success');
        return redirect()->back();
    }
}
