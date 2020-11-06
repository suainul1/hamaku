<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('user.profile',compact('user'));
    }
    public function all()
    {
        return view('user.all');
    }
    public function update(Request $request, User $user)
    {
        $request->validate([
            'nama' => ['required', 'string', 'max:255','min:2'],
            'email' => ['required', 'string', 'email', 'max:255',Rule::unique('users')->ignore($user->id)],
            'image' => ['nullable','image','max:2048'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'alamat' => ['required','min:4'],
            'jenis_kelamin' => ['required'],
            ]);
        if(!is_null($request->password) ){
            if(Hash::check($request->old_password,$user->password)){
                $user->update([
                    'password' => bcrypt($request->password),
                ]);
            }else{
                return redirect()->back()->withErrors(['old_password' => 'password lama salah']);
            }
        }
        $fileName = $user->image ?? null;
        if ($request->file('image') != null) {
            $file = $request->file('image');
            $fileName = substr(md5(microtime()), 0, 100).'.'.$file->getClientOriginalExtension();
            $request->file('image')->storeAs('public/user/profile',$fileName);
        }
        if (auth()->user()->role != 'ahli_tani') {
            $user->update([
                'name' => $request->nama,
                'email' => $request->email,
                'password' => !is_null($request->password) ? bcrypt($request->password) : $user->password,
                'role'  =>  'petani',
                'alamat' => $request->alamat,
                'image' => $fileName,
                'jenis_kelamin' => $request->jenis_kelamin
                ]);
        }
        return redirect()->back();
    }
}
