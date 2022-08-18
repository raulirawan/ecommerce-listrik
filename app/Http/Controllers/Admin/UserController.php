<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transaction;
use App\TransactionDetail;
use Exception;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('roles', 'KONSUMEN')->get();
        return view('pages.admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
        ]);

        $data = new User();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->no_hp = $request->no_hp;
        $data->roles = $request->roles;
        $data->save();


        if ($data != null) {
            return redirect()->route('user.index')->with('sukses', ' Data Berhasil di Simpan!');
        } else {
            return redirect()->route('user.index')->with('error', ' Data Gagal di Simpan!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('pages.admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'email' => 'unique:users,email,' . $id,
        ]);

        $data = User::findOrFail($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->no_hp = $request->no_hp;
        $data->roles = $request->roles;
        $data->save();

        if ($data != null) {
            return redirect()->route('user.index')->with('sukses', ' Data Berhasil di Simpan!');
        } else {
            return redirect()->route('user.index')->with('error', ' Data Gagal di Simpan!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = User::findOrFail($id);



        if ($item != null) {
            try {
                $item->delete();
            } catch (Exception $e) {
                return redirect()->route('user.index')->with('error', $e->getMessage());
            }

            return redirect()->route('user.index')->with('sukses', ' Data Berhasil di Hapus!');
        } else {
            return redirect()->route('user.index')->with('error', ' Data Gagal di Hapus!');
        }
    }
}
