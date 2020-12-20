<?php

namespace App\Http\Controllers;

use App\Models\Gejala;
use App\Models\Hama;
use App\Models\KategoriGejala;
use App\Models\RiwayatDiagnosa;
use App\Models\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class PakarController extends Controller
{
    public function index(Request $request, $step = null)
    {
        $c = null;
        $judul = null;
        $rule = null;
        $kategori = null;
        if ($step == 'hasil') {
            $rule = Rule::get(['id','rule']);
            $kap = [];
            foreach ($rule as $r) {
                $arr = explode(",", $r->rule);
                $nilai = null;
                foreach ($request->kategori_gejala as $p) {
                    if (in_array($p, $arr)) {
                        $nilai += 1;
                    }
                }
                $kap[] = $nilai;
            }
            $mak = max($kap);
            if ($mak == null) {
                Alert::warning('Warning', 'Tidak ada kecocokan!!');
                return redirect()->back();
            }
            if($mak != 1){
                $same = [];
                foreach($kap as $i=>$r){
                    if($r == $mak){
                        $same[] = $i;
                    }
                }
            }else{
                $same=[array_search($mak,$kap)];
            }
            $hama = array_filter($rule->toArray(), function($k) use($same) {
                return in_array($k,$same);
            }, ARRAY_FILTER_USE_KEY);
            $idd = [];
            foreach ($hama as $h){
                $idd[] = $h['id'];
                
            }
            $rule = Rule::whereIn('id',$idd)->get();
            foreach ($rule as $r) {
                RiwayatDiagnosa::create([
                    'user_id' => auth()->user()->id,
                    'rule_id' => $r->id
                ]);
            }
            $judul = 'Hasil Daignosa';
        } else {
            $kategori = KategoriGejala::get(['id', 'nama_kategori']);
            $judul = 'Pilih Kategori Gejala';
        }
        return view('pakar.index', compact(['step', 'judul', 'rule', 'kategori']));
    }
    public function setting()
    {
        $kategori = KategoriGejala::get();
        $hama = Hama::get();
        $gejala = Gejala::with(['kategoriGejala', 'hama'])->get();
        $rule = Rule::with('hama')->get();
        return view('pakar.setting', compact(['rule', 'kategori', 'hama', 'gejala']));
    }
    public function riwayat()
    {
        $riwayat = RiwayatDiagnosa::where('user_id',auth()->user()->id)->with('rule')->get();
        return view('pakar.riwayat',compact('riwayat'));
    }
}
