<?php

namespace App\Http\Controllers;

use App\Models\KategoriBarang;
use Illuminate\Http\Request;

class KategoriBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Data Kategori';
        $kategori = KategoriBarang::get();
        return view('kategori.index', compact('title', 'kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Data Kategori';
        return view('kategori.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        KategoriBarang::create($request->all());
        toast('Success', 'Data Berhasil ditambah');
        return redirect()->to('kategori');

    }

    /**
     * Display the specified resource.
     */
    public function show(KategoriBarang $kategoriBarang, string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KategoriBarang $kategoriBarang, string $id)
    {
        $title = 'Edit Data Kategori';
        $edit = KategoriBarang::find($id);
        return view('kategori.edit', compact('title', 'edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KategoriBarang $kategoriBarang, string $id)
    {
        KategoriBarang::where('id', $id)->update([
            'nama_kategori' => $request->nama_kategori,
        ]);
        return redirect()->to('kategori');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KategoriBarang $kategoriBarang, string $id)
    {
        KategoriBarang::findOrFail($id)->delete();
        return redirect()->to('kategori');
    }
}
