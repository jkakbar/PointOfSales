@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">{{ $title }}</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 10%">No</th>
                            <th>level</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($level as $level)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $level->nama_level }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
