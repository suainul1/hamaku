<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::get(['id','nama']);
        return view('kategori.index',compact('kategoris'));
    }
    public function create(Request $request)
    {
        $msg = [
            'required' => 'Inputan :attribute wajib diisi',
        ];
        $request->validate([
            'nama' => ['required','min:4','max:15','unique:kategoris'],
        ], $msg);
        Kategori::create([
            'nama' => Str::slug($request->nama,'-'),
        ]); 
        return redirect()->back();
    }
    public function update(Request $request,Kategori $kategori)
    {
        $msg = [
            'numeric' => 'Inputan :attribute harus berupa angka',
            'required' => 'Inputan :attribute wajib diisi',
        ];
        $request->validate([
            'nama' => ['required','min:5','max:15',Rule::unique('kategoris')->ignore($kategori->id)],
        ], $msg);
        $kategori->update([
            'nama' => Str::slug($request->nama,'-')
        ]); 
        return redirect()->back();
    }
    public function destroy(Kategori $kategori)
    {
        $kategori->delete();
        return redirect()->back();
    }
}
