<?php

namespace App\Http\Controllers;

use App\Models\Hama;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class HamaController extends Controller
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_hama' => ['required','string','min:3','unique:hamas'],
            'solusi' => ['required','string','min:5']
            
            ]);
        if ($validator->fails()) {
            Alert::warning('Warning', 'Failed Create!!');
            return redirect()->back()
                ->withInput();
        }
        Hama::create([
            'kode' => Str::random(4),
            'nama_hama' => $request->nama_hama,
            'solusi' => $request->solusi,
        ]);
        toast('Success Create!', 'success');
        return redirect()->back();
    }
    public function edit(Request $request,Hama $hama)
    {
        $validator = Validator::make($request->all(), [
            'nama_hama' => ['required','string','min:3',Rule::unique('hamas')->ignore($hama->id)],
            'solusi' => ['required','string','min:5']
            ]);
        if ($validator->fails()) {
            Alert::warning('Warning', 'Failed Update!!');
            return redirect()->back()
                ->withInput();
        }
        $hama->update([
            'nama_hama' => $request->nama_hama,
            'solusi' => $request->solusi,
        ]);
        toast('Success Edit!', 'success');
        return redirect()->back();
    }
    public function delete(Hama $hama)
    {
        $hama->delete();
        toast('Success Delete!', 'success');
        return redirect()->back();
    }
}
