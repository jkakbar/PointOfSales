@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">{{ $title }}</div>
        <div class="card-body">
            <div class="table-responsive">
                <div align="right" class="mb-3">
                    <a href="{{ route('penjualan.create')}}" class="btn btn-primary">Tambah</a>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Transaksi</th>
                            <th>Nama User</th>
                            <th>Tanggal Transaksi</th>
                            <th>Total Harga</th>
                            <th>Nominal Bayar</th>
                            <th>Kembalian</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($penjualan as $penjualan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $penjualan->kode_transaksi }}</td>
                                <td>{{ $penjualan->user->name }}</td>
                                <td>{{ $penjualan->tanggal_transaksi }}</td>
                                <td>{{ $penjualan->total_harga }}</td>
                                <td>{{ $penjualan->nominal_bayar }}</td>
                                <td>{{ $penjualan->kembalian }}</td>
                                <td>
                                    <a href="{{route('penjualan.show', $penjualan->id)}}" class="btn btn-sm btn-success">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    {{-- <form method="POST" action="{{ route('penjualan.destroy', $penjualan->id) }}"
                                        class="d-inline">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-sm btn-danger show_confirm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
