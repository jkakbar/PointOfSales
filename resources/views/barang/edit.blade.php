@extends('layouts.app')

@section('title', $title)

@section('content')
@include('sweetalert::alert')
<form action="{{route('barang.update', $edit->id)}}" method="post">
    @csrf
    @method('PUT')
    <div class="form-group mb-3">
        <label for="">ID Kategori</label>
        <select name="id_category" id="" class="form-control">
            <option value="" disabled style="background-color: #63636398;" class="text-light">Pilih Kategori</option>
            @foreach ($categories as $cat)
            <option {{$cat->id == $edit->id_category ? 'selected':''}} value="{{$cat->id}}">{{$cat->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group mb-3">
        <label for="">Nama</label>
        <input value="{{$edit->nama_barang}}" type="text" class="form-control" name="nama_barang" id="" placeholder="Masukkan Nama Barang">
    </div>
    <div class="form-group mb-3">
        <label for="">satuan</label>
        <input value="{{$edit->satuan}}" type="text" class="form-control" name="satuan" id="" placeholder="Masukkan Satuan Barang">
    </div>
    <div class="form-group mb-3">
        <label for="">Kuantiti</label>
        <input value="{{$edit->qty}}" type="number" class="form-control" name="qty" id="" placeholder="Masukkan Kuantiti Barang">
    </div>
    <div class="form-group mb-3">
        <label for="">Harga</label>
        <input value="{{$edit->harga}}" type="number" class="form-control" name="harga" id="" placeholder="Masukkan Harga Barang">
    </div>
    <div class="form-group mb-3">
        <input type="submit" class="btn btn-primary" value="Simpan">
        <input type="reset" class="btn btn-danger" value="Batal">
        <a href="{{url()->previous()}}" class="btn btn-info">Kembali</a>
    </div>
</form>
@endsection
