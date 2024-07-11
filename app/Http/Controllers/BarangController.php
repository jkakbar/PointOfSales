<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\KategoriBarang;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Data Barang';
        $barang = Barang::get();
        return view('barang.index', compact('title', 'barang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Edit Data Barang';
        $kategori = KategoriBarang::get();
        return view('barang.create', compact('title', 'kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Barang::create($request->all());
        Alert::toast('Data Berhasil ditambah', 'Success');
        return redirect()->to('barang');
    }

    /**
     * Display the specified resource.
     */
    public function show(Barang $barang, string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barang $barang, string $id)
    {
        $title = 'Edit Data Barang';
        $edit = Barang::find($id);
        return view('barang.edit', compact('title', 'edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Barang $barang, string $id)
    {
        Barang::where('id', $id)->update([
            'id_kategori' => $request->id_kategori,
            'nama_barang' => $request->nama_barang,
            'satuan' => $request->satuan,
            'qty' => $request->qty,
            'harga' => $request->harga,
        ]);
        return redirect()->to('barang');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang, string $id)
    {
        Barang::findOrFail($id)->delete();
        return redirect()->to('barang');
    }
}
