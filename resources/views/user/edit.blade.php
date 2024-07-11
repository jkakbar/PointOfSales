@extends('layouts.app')

@section('title', $title)

@section('content')
@include('sweetalert::alert')
<form action="{{route('user.update', $edit->id)}}" method="post">
    @csrf
    @method('PUT')
    <div class="form-group mb-3">
        <label for="">Level</label>
        <select name="id_level" id="" class="form-control">
            <option value="" disabled style="background-color: #63636398;" class="text-light">Pilih Level</option>
            @foreach ($level as $level)
            <option {{$level->id == $edit->id_level ? 'selected':''}} value="{{$level->id}}">{{$level->nama_level}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group mb-3">
        <label for="">Nama</label>
        <input value="{{$edit->name}}" type="text" class="form-control" name="name" id="" placeholder="Masukkan Nama Anda" required>
    </div>
    <div class="form-group mb-3">
        <label for="">Email</label>
        <input value="{{$edit->email}}" type="email" class="form-control" name="email" id="" placeholder="Masukkan Email Anda" required>
    </div>
    <div class="form-group mb-3">
        <label for="">Password</label>
        <input type="password" class="form-control" name="password" id="" placeholder="Masukkan Password Anda">
    </div>
    <div class="form-group mb-3">
        <input type="submit" class="btn btn-primary" value="Simpan">
        <input type="reset" class="btn btn-danger" value="Batal">
        <a href="{{url()->previous()}}" class="btn btn-info">Kembali</a>
    </div>
</form>
@endsection
