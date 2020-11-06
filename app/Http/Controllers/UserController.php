<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('user.profile', compact('user'));
    }
    public function all()
    {
        $users = User::get();
        return view('user.all', compact('users'));
    }
    public function allUpdate(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'role' => ['required'],
            'nama' => ['required', 'string', 'max:255', 'min:2'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'alamat' => ['required', 'min:4'],
            'jenis_kelamin' => ['required'],
        ]);
        if ($validator->fails()) {
            return redirect('user/all')
                ->withErrors($validator)->with('update', true)
                ->withInput();
        }
        if ($request->role == 'ahli_tani') {
            $request->validate([
                'profesi' => ['required', 'string', 'max:255', 'min:2'],
            ]);
            $user->update([
                'name' => $request->nama,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role'  =>  $request->role,
                'alamat' => $request->alamat,
                'jenis_kelamin' => $request->jenis_kelamin
            ]);
            $user->ahliTani()->update([
                'profesi' => $request->profesi
            ]);
        } else {
            $user->update([
                'name' => $request->nama,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role'  =>  $request->role,
                'alamat' => $request->alamat,
                'jenis_kelamin' => $request->jenis_kelamin
            ]);
        }
        return redirect()->back();
    }
    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string', 'max:255', 'min:2'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'alamat' => ['required', 'min:4'],
            'jenis_kelamin' => ['required'],
            'role' => ['required'],
        ]);
        if ($validator->fails()) {
            return redirect('user/all')
                ->withErrors($validator)->with('create', true)
                ->withInput();
        }
        if ($request->role == 'ahli_tani') {
            $request->validate([
                'profesi' => ['required', 'string', 'max:255', 'min:2'],
            ]);
            $u = User::create([
                'name' => $request->nama,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role'  =>  $request->role,
                'alamat' => $request->alamat,
                'jenis_kelamin' => $request->jenis_kelamin
            ]);
            $u->ahliTani()->create([
                'profesi' => $request->profesi
            ]);
        } else {
            User::create([
                'name' => $request->nama,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role'  =>  $request->role,
                'alamat' => $request->alamat,
                'jenis_kelamin' => $request->jenis_kelamin
            ]);
        }
        return redirect()->back();
    }
    public function blokir(User $user)
    {
        if ($user->status == 'aktif') {
            $user->update([
                'status' => 'nonaktif'
            ]);
        } else {
            $user->update([
                'status' => 'aktif'
            ]);
        }
        return redirect()->back();
    }
    public function update(Request $request, User $user)
    {
        $request->validate([
            'nama' => ['required', 'string', 'max:255', 'min:2'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'image' => ['nullable', 'image', 'max:2048'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'alamat' => ['required', 'min:4'],
            'jenis_kelamin' => ['required'],
        ]);
        if ($user->role == 'ahli_tani') {
        
        $request->validate([
            'profesi' => ['string', 'max:255', 'min:2'],
        ]);
        }
        if (!is_null($request->password)) {
            if (Hash::check($request->old_password, $user->password)) {
                $user->update([
                    'password' => bcrypt($request->password),
                ]);
            } else {
                return redirect()->back()->withErrors(['old_password' => 'password lama salah']);
            }
        }
        $fileName = $user->image ?? null;
        if ($request->file('image') != null) {
            $file = $request->file('image');
            $fileName = substr(md5(microtime()), 0, 100) . '.' . $file->getClientOriginalExtension();
            $request->file('image')->storeAs('public/user/profile', $fileName);
        }
        if ($user->role != 'ahli_tani') {
            $user->update([
                'name' => $request->nama,
                'email' => $request->email,
                'password' => !is_null($request->password) ? bcrypt($request->password) : $user->password,
                'role'  =>  $user->role,
                'alamat' => $request->alamat,
                'image' => $fileName,
                'jenis_kelamin' => $request->jenis_kelamin
            ]);
        }else{
            $user->update([
                'name' => $request->nama,
                'email' => $request->email,
                'password' => !is_null($request->password) ? bcrypt($request->password) : $user->password,
                'role'  =>  $user->role,
                'alamat' => $request->alamat,
                'image' => $fileName,
                'jenis_kelamin' => $request->jenis_kelamin
            ]);
            $user->ahliTani()->update([
                'profesi' => $request->profesi,
                
            ]);
        }
        return redirect()->back();
    }
}
