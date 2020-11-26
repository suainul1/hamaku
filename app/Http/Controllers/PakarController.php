<?php

namespace App\Http\Controllers;

use App\Models\Gejala;
use App\Models\Hama;
use App\Models\KategoriGejala;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PakarController extends Controller
{
    public function index(Request $request,$step = null)
    {
        $c = null;
        $judul = null;
        if($step == 'gejala'){
            $gejala = Gejala::get();
            $c = 'gejala';
            $judul = 'Daignosa Gejala';
        }elseif($step == 'hasil'){
            $hama = Gejala::findOrFail($request->gejala)->hama;
            $c = 'hama';
            $judul = 'Hasil Daignosa';
        }else{
            $kategori = KategoriGejala::get(['id','nama_kategori']);
            $c = 'kategori';
        }
        return view('pakar.index',compact([$c,'step','judul']));
    }
    public function setting()
    {
        $kategori = KategoriGejala::get();
        $hama = Hama::get();
        $gejala = Gejala::with(['kategoriGejala','hama'])->get();
        return view('pakar.setting',compact(['kategori','hama','gejala']));
    }
   
    
   
}
