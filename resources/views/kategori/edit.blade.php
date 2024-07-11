@extends('layouts.app')

@section('content')
@include('sweetalert::alert')
<form action="{{route('kategori.update', $edit->id)}}" method="post">
    @csrf
    @method('PUT')
    <div class="form-group mb-3">
        <label for="">Nama Kategori</label>
        <input value="{{$edit->nama_kategori}}" type="text" class="form-control" name="nama_kategori" id="" placeholder="Masukkan Nama Kategori">
    </div>
    <div class="form-group mb-3">
        <input type="submit" class="btn btn-primary" value="Simpan">
        <input type="reset" class="btn btn-danger" value="Batal">
        <a href="{{url()->previous()}}" class="btn btn-info">Kembali</a>
    </div>
</form>
@endsection
