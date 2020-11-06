<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\Artikel;
use App\Models\Kategori;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public function index()
    {
        $artikels = Artikel::with('kategoris')->simplePaginate(5);;
        return view('artikel.index',compact('artikels'));
    }
    public function show(Artikel $artikel)
    {
        return view('artikel.show',compact('artikel'));
    }
    public function create()
    {
        $kategoris = Kategori::get(['id', 'nama']);
        return view('artikel.create', compact('kategoris'));
    }
    public function store(Request $request)
    {
        $msg = [
            'required' => 'Inputan :attribute wajib diisi',
        ];
        $request->validate([
            'judul' => ['required','min:5'],
            'image' => ['required','image','max:2048'],
            'isi' => ['required','min:10'],
            'kategori'    => ['required','array','min:1'],
            'kategori.*'  => ['required'],
            'desc' => ['required','max:100'],
            
        ], $msg);

        $file = $request->file('image');
        $fileName = substr(md5(microtime()), 0, 100) . '.' . $file->getClientOriginalExtension();
        $request->file('image')->storeAs('public/artikel/thumbnail/', $fileName);

        $al = Artikel::create([
            'judul' => Str::title($request->judul),
            'user_id' => auth()->user()->id,
            'thumbnail' => $fileName,
            'desc' => $request->desc,
            'slug' => Str::slug($request->judul, '-'),
            'isi' => $request->isi
        ]);
        $al->kategoris()->sync($request->kategori);
        return redirect('artikel');
    }
    public function edit(Artikel $artikel)
    {
        $kategoris = Kategori::get(['id', 'nama']);
        return view('artikel.edit', compact('kategoris','artikel'));
    }
    public function update(Request $request,Artikel $artikel)
    {
        $msg = [
            'numeric' => 'Inputan :attribute harus berupa angka',
            'required' => 'Inputan :attribute wajib diisi',
        ];
        $request->validate([
            'judul' => ['required','min:5'],
            'image' => ['image','max:2048'],
            'isi' => ['required','min:10'],
            'kategori'    => ['required','array','min:1'],
            'kategori.*'  => ['required'],
            'desc' => ['required','max:100'],
            
        ], $msg);
        $fileName = $artikel->thumbnail;
        if ($request->file('image') != null) {
        $file = $request->file('image');
        $fileName = substr(md5(microtime()), 0, 100) . '.' . $file->getClientOriginalExtension();
        $request->file('image')->storeAs('public/artikel/thumbnail/', $fileName);
        }
        $artikel->update([
            'judul' => Str::title($request->judul),
            'user_id' => auth()->user()->id,
            'thumbnail' => $fileName,
            'desc' => $request->desc,
            'slug' => Str::slug($request->judul, '-'),
            'isi' => $request->isi
        ]);
        $artikel->kategoris()->sync($request->kategori);
        return redirect()->route('artikel.index');
    }
    public function destroy(Artikel $artikel)
    {
        $artikel->kategoris()->detach();
        $artikel->delete();
        return redirect()->back();
    }
}
