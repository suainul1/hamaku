<?php

namespace App\Http\Controllers;

use App\Models\KategoriGejala;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class KategoriGejalaController extends Controller
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_kategori' => ['required','string','min:3','unique:kategori_gejalas'],
        ]);
        if ($validator->fails()) {
            Alert::warning('Warning', 'Failed Create!!');
            return redirect()->back()
                ->withInput();
        }
        KategoriGejala::create([
            'kode' => Str::random(4),
            'nama_kategori' => Str::title($request->nama_kategori),
        ]);
        toast('Success Create!', 'success');
        return redirect()->back();
    }
    public function edit(Request $request,KategoriGejala $kategori)
    {
        $validator = Validator::make($request->all(), [
            'nama_kategori' => ['required','string','min:3',Rule::unique('kategori_gejalas')->ignore($kategori->id)],
        ]);
        if ($validator->fails()) {
            Alert::warning('Warning', 'Failed Update!!');
            return redirect()->back()
                ->withInput();
        }
        $kategori->update([
            'nama_kategori' => Str::title($request->nama_kategori),
        ]);
        toast('Success Update!', 'success');
        return redirect()->back();
    }
    public function delete(KategoriGejala $kategori)
    {
        $kategori->delete();
        toast('Success Delete!', 'success');
        return redirect()->back();
    }
}
