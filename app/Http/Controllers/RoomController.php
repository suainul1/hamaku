<?php

namespace App\Http\Controllers;

use App\Models\AhliTani;
use App\Models\Message;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RoomController extends Controller
{
    public function index()
    {
        $ahli = User::where('role','ahli_tani')->whereHas('ahliTani',function($q) {
            return $q->where('status','buka');
        })->get();
        $room =null;
        $a = null;
        return view('konsultasi.message',compact(['a','room','ahli']));
    }
    public function konsul(User $ahli)
    {
        $room = DB::transaction(function () use($ahli){
            $room = Room::create([
                'kode'=> Str::random(5),
                'poin' => 5,
            ]);
            $ahli->ahliTani()->update([
                'status' => 'konsultasi',
            ]);
            return $room;
        });
        $a = $ahli;
        return view('konsultasi.message',compact(['a','room']));
    }
    public function chat(Request $request,User $to)
    {
        
    }
}
