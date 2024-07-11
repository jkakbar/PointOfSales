@extends('layouts.app')

@section('content')
@include('sweetalert::alert')
<form action="{{route('barang.store')}}" method="post">
    @csrf
    <div class="form-group mb-3">
        <label for="">Kategori</label>
        <select name="id_kategori" id="" class="form-control">
            <option value="" disabled style="background-color: #63636398;" class="text-light">Pilih Kategori</option>
            @foreach ($kategori as $kategori)
            <option style="color: black" value="{{$kategori->id}}">{{$kategori->nama_kategori}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group mb-3">
        <label for="">Nama Barang</label>
        <input type="text" class="form-control" name="nama_barang" id="" placeholder="Masukkan Nama Barang" required>
    </div>
    <div class="form-group mb-3">
        <label for="">satuan</label>
        <input type="text" class="form-control" name="satuan" id="" placeholder="Masukkan Satuan Barang" required>
    </div>
    <div class="form-group mb-3">
        <label for="">Kuantiti</label>
        <input type="number" class="form-control" name="qty" id="" placeholder="Masukkan Kuantiti Barang" required>
    </div>
    <div class="form-group mb-3">
        <label for="">Harga</label>
        <input type="number" class="form-control" name="harga" id="" placeholder="Masukkan Harga Barang" required>
    </div>
    <div class="form-group mb-3">
        <input type="submit" class="btn btn-primary" value="Simpan">
        <input type="reset" class="btn btn-danger" value="Reset">
        <a href="{{url()->previous()}}" class="btn btn-info">Kembali</a>
    </div>
</form>
@endsection
