@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        Laporan Transaksi
                    </div>
                    <div class="card-body">
                        <h5>Transaksi: {{ $penjualan->kode_transaksi }}</h5>
                        <p>Tanggal: {{ $penjualan->tanggal_transaksi }}</p>
                        <p>User: {{ $penjualan->user->name }}</p>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($penjualan->details as $detail)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $detail->barang->nama_barang }}</td>
                                        <td>{{ $detail->jumlah }}</td>
                                        <td>{{ $detail->harga }}</td>
                                        <td>{{ $detail->jumlah * $detail->harga }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <p>Total Harga: {{ $penjualan->total_harga }}</p>
                        <p>Nominal Bayar: {{ $penjualan->nominal_bayar }}</p>
                        <p>Kembalian: {{ $penjualan->kembalian }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
