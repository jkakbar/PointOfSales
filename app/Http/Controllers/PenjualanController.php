<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\DetailPenjualan;
use App\Models\Penjualan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penjualan = Penjualan::get();
        $title = "Data Penjualan";
        return view('penjualan.index', compact('penjualan', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    { {
            // Generate Nomor Transaksi
            $currentDate = now();
            $datePart = $currentDate->format('dmy');
            $prefix = 'TR-' . $datePart;

            // Get the last transaction number
            $lastTransaction = Penjualan::where('kode_transaksi', 'like', $prefix . '%')->orderBy('kode_transaksi', 'desc')->first();

            if ($lastTransaction) {
                $lastNumber = (int)substr($lastTransaction->nomor_transaksi, -3);
                $newNumber = $lastNumber + 1;
            } else {
                $newNumber = 1;
            }

            $noTransaksi = $prefix . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

            $barang = Barang::get();
            $user = User::where('id_level', '4')->get();
            $title = 'Peminjaman Buku';

            return view('penjualan.create', compact('title', 'noTransaksi', 'barang', 'user'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $penjualan = new Penjualan();
            $penjualan->kode_transaksi = $request->kode_transaksi;
            $penjualan->tanggal_transaksi = $request->tanggal_transaksi;
            $penjualan->id_user = $request->id_user;
            $penjualan->total_harga = $request->total_harga;
            $penjualan->nominal_bayar = $request->nominal_bayar;
            $penjualan->kembalian = $request->kembalian;
            $penjualan->save();

            $id_barang = $request->id_barang;
            $jumlah = $request->jumlah;
            $harga = $request->harga;

            foreach ($id_barang as $key => $value) {
                $detail = new DetailPenjualan();
                $detail->id_penjualan = $penjualan->id;
                $detail->id_barang = $value;
                $detail->jumlah = $jumlah[$key];
                $detail->harga = $harga[$key];
                $detail->save();
            }

            DB::commit();
            return redirect()->route('penjualan.show', $penjualan->id)->with('success', 'Transaksi berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $penjualan = Penjualan::with('details.barang', 'user')->findOrFail($id);
        return view('penjualan.show', compact('penjualan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penjualan $penjualan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penjualan $penjualan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penjualan $penjualan)
    {
        //
    }
}
