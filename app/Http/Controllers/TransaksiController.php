<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function __construct()
    {
        $this->xendit = new XenditController;
    }
    public function index()
    {
        $transaksi = Transaksi::where('user_id',auth()->user()->id)->paginate(10);
        return view('transaksi.index',compact('transaksi'));
    }
    public function create(Request $request)
    {
        $tot = (int)$request->nominal * 1000;
        $t = Transaksi::create([
            'user_id' => auth()->user()->id,
            'nominal' => (int)$request->nominal,
            'total_transaksi' => $tot,
            ]);
        $invoice = $this->xendit->createInvoice($t->id, 'hamaku', auth()->user()->email, 'pembelian point '.$request->nominal, $tot);
        $t->update([
            'metode_bayar' =>  $invoice['id']
        ]);
        return redirect()->back();
    }
}
