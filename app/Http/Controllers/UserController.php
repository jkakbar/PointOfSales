<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\ToSweetAlert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::orderBy('id')->get();
        return view('user.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $level = Level::orderBy('id')->get();
        return view('user.create', compact('level'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        User::create([
            'id_level' => $request->id_level,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        toast('Data Berhasil Ditambah', 'success');
        return redirect()->to('user')->with('message', 'Data berhasil ditambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $level = Level::orderBy('id')->get();
        $edit = User::find($id);
        $title = "Edit Data" . $edit->name ;
        return view('user.edit', compact('edit', 'title', 'level'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $edit = User::find($id);
        if($request->password) {
            $password = Hash::make($request->password);
        } else {
            $password = $edit->password;
        }

        User::where('id', $id)->update([
            'id_level' => $request->id_level,
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password,
        ]);

        return redirect()->to('user')->with('message', 'User berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::findOrFail($id)->delete();
        return redirect()->to('user')->with('message', 'User berhasil dihapus');
    }


}
