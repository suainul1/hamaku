<?php

namespace App\Http\Controllers;

use App\Models\Rule;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class RuleController extends Controller
{
    public function create(Request $request)
    {
        Rule::create([
            'hama_id' => $request->hama,
            'rule' => strtoupper($request->rule),
        ]);
        toast('Success Menambahkan!', 'success');
        return redirect()->back();
    }
    public function update(Request $request, Rule $rule)
    {
        $rule->update([
            'hama_id' => $request->hama,
            'rule' => strtoupper($request->rule),
        ]);
        toast('Success Update!', 'success');
        return redirect()->back();
    }
    public function delete(Rule $id)
    {
        $id->delete();
        toast('Success Hapus!', 'success');
        return redirect()->back();
    }
}
