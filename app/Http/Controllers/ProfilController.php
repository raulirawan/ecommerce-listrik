<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function index()
    {
        return view('pages.profile');
    }

    public function update(Request $request)
    {
        $data = User::findOrFail(Auth::user()->id);
        $data->name = $request->name;
        $data->no_hp = $request->no_hp;
        $data->save();

        if ($data != null) {
            alert()->success('success', 'Berhasil Ubah Data Profil');
            return redirect()->route('profil.index');
        } else {
            alert()->error('error', 'Gagal Ubah Data Profil');
            return redirect()->route('profil.index');
        }
    }

    public function passwordUpdate(Request $request)
    {
        $this->validate($request, [
            'oldPassword' => 'required',
            'password' => 'required|confirmed',

        ]);

        if (!(Hash::check($request->get('oldPassword'), Auth::user()->password))) {

            alert()->error('error', 'Password Lama Anda Salah');
            return redirect()->route('profil.index');
        }

        if (strcmp($request->get('oldPassword'), $request->get('password')) == 0) {
            alert()->error('error', 'Password Lama Anda Tidak Boleh Sama Dengan Password Baru');
            return redirect()->route('profil.index');
        }

        $user = Auth::user();
        $user->password = bcrypt($request->get('password'));
        $user->save();

        alert()->success('success', 'Password Anda Berhasil di Ganti');
        return redirect()->route('profil.index');
    }
}
