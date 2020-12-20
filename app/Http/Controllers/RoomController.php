<?php

namespace App\Http\Controllers;

use App\Models\AhliTani;
use App\Models\Message;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class RoomController extends Controller
{
    public function index()
    {
        $ahli = User::where('role','ahli_tani')->whereHas('ahliTani',function($q) {
            return $q->where('status','buka');
        })->get();
        $room =null;
        $a = null;
        return view('konsultasi.index',compact(['a','room','ahli']));
    }
    public function konsul(User $ahli)
    {
        if(auth()->user()->point - 5 >= 0){  
            $room = DB::transaction(function () use($ahli){
                auth()->user()->update([
                    'point' => auth()->user()->point - 5,
                ]);
            $room = Room::create([
                'user_id' => auth()->user()->id,
                'ahli_tani_id' => $ahli->ahliTani->id,
                'kode'=> Str::random(3),
                'poin' => 5,
                
            ]);
            $ahli->ahliTani()->update([
                'status' => 'konsultasi',
            ]);
            $ahli->update([
                'point' => $ahli->point + 5,
            ]);
            return $room;
        });
    }else{
        Alert::warning('Warning', 'Point anda tidak mencukupi!!');
        return redirect()->back();
    }
        return redirect()->route('room.view',$room->id);
    }
    public function room()
    {
            return Room::where(auth()->user()->role == 'petani' ? 'user_id' :'ahli_tani_id',auth()->user()->role == 'petani' ? auth()->user()->id:auth()->user()->ahliTani->id)->with('ahliTani')->with('user')->get()->sortDesc();    
    }
    public function riwayat()
    {
        $room = $this->room();
      
        return view('konsultasi.riwayat',compact('room'));
    }
    public function view(Room $chat)
    {
        $room = $this->room();
       
        return view('konsultasi.message',compact(['chat','room']));
    }
    public function close(Room $id)
    {
        $id->update([
            'status' => 'selesai'
        ]);
        $id->ahliTani()->update([
            'status' => 'buka'
        ]);
        return redirect()->back();
    }
}
