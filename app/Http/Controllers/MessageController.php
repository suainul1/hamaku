<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function chat(Request $request,Room $room)
    {
        $room->message()->create([
            'from_user_id' => auth()->user()->id,
            'to_user_id' => $request->touser,
            'pesan' => $request->pesan,
        ]);
        return redirect()->back();
    }
}
