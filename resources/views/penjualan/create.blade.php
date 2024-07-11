@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 col-sm-12">
            <div class="card">
                <div class="card-header">{{ $title }}</div>
                <div class="card-body">
                    <form id="transaksiForm" action="{{ route('penjualan.store') }}" method="post">
                        @csrf
                        <div class="card p-3 mb-4">
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <div class="input-group input-group-outline mb-3 d-flex">
                                        <label class="p-2" for="kode_transaksi">Transaksi</label>
                                        <input type="text" name="kode_transaksi" value="{{ $noTransaksi }}" id="kode_transaksi" readonly class="form-control">
                                    </div>
                                    <div class="input-group input-group-outline mb-3 d-flex">
                                        <label class="p-2" for="tanggal_transaksi">Transaksi</label>
                                        <input type="datetime" name="tanggal_transaksi" value="{{now()}}" id="tanggal_transaksi" readonly class="form-control">
                                    </div>
                                </div>
                                <div class="col-12 col-md-7">
                                    <div class="input-group input-group-outline mb-3 d-flex">
                                        <label class="p-2" for="id_user">User</label>
                                        <select name="id_user" id="id_user" class="form-control">
                                            <option value="" disabled class="bg-secondary text-light" selected>Pilih User</option>
                                            @foreach ($user as $user)
                                                <option value="{{ $user->id }}">{{ $user->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-1">
                                    <a href="{{ route('user.create') }}" class="btn btn-primary">Tambah</a>
                                </div>
                            </div>
                        </div>
                        <div class="card p-3 mb-3">
                            <div align="left" class="mb-3">
                                <button type="button" class="btn btn-success" id="addBookBtn">Add</button>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="booksTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Barang</th>
                                            <th>jumlah</th>
                                            <th>Harga</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card p-3 mb-4">
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <div class="input-group input-group-outline mb-3 d-flex">
                                        <label class="p-2" for="total_harga">Total Harga</label>
                                        <input type="text" name="total_harga" value="" id="total_harga" class="form-control">
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="input-group input-group-outline mb-3 d-flex">
                                        <label class="p-2" for="nominal_bayar">Nominal yang dibayar</label>
                                        <input type="text" name="nominal_bayar" value="" id="nominal_bayar" class="form-control">
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="input-group input-group-outline mb-3 d-flex">
                                        <label class="p-2" for="kembalian">Kembalian</label>
                                        <input type="text" name="kembalian" value="" id="kembalian" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-2 p-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
 document.addEventListener('DOMContentLoaded', function () {
    let bookCount = 0;

    document.getElementById('addBookBtn').addEventListener('click', function () {
        addBookRow();
    });

    document.getElementById('transaksiForm').addEventListener('submit', function () {
        const dateInputs = document.querySelectorAll('input[name="tanggal_peminjaman[]"]');
        const now = new Date().toISOString().slice(0, 16); // Format datetime-local
        dateInputs.forEach(input => {
            if (!input.value) {
                input.value = now;
            }
        });
    });

    document.getElementById('nominal_bayar').addEventListener('input', function () {
        calculateKembalian();
    });

    function addBookRow() {
        const userSelect = document.getElementById('id_user');
        const selecteduserId = userSelect.value;

        if (!selecteduserId) {
            alert('Silakan pilih user terlebih dahulu.');
            return;
        }

        bookCount++;
        const table = document.getElementById('booksTable').getElementsByTagName('tbody')[0];
        const newRow = table.insertRow();
        newRow.innerHTML = `
            <tr>
                <td>${bookCount}</td>
                <td><select name="id_barang[]" class="form-control" onchange="updateHarga(this)">
                        <option value="" disabled class="bg-secondary text-light" selected>Pilih Barang</option>
                        @foreach ($barang as $barang)
                            <option value="{{ $barang->id }}" data-harga="{{ $barang->harga }}">{{ $barang->nama_barang }}</option>
                        @endforeach
                    </select></td>
                <td><input type="number" name="jumlah[]" class="form-control" oninput="updateTotalHarga()"></td>
                <td><input type="number" name="harga[]" class="form-control" readonly></td>
                <td>
                    <button type="button" class="btn btn-sm btn-danger" onclick="removeBookRow(this)">Remove</button>
                </td>
            </tr>
        `;
    }

    window.updateHarga = function (select) {
        const selectedOption = select.options[select.selectedIndex];
        const harga = selectedOption.getAttribute('data-harga');
        const row = select.closest('tr');
        const hargaInput = row.querySelector('input[name="harga[]"]');
        hargaInput.value = harga;
        updateTotalHarga();
    }

    window.removeBookRow = function (button) {
        const row = button.closest('tr');
        row.remove();
        updateRowNumbers();
        updateTotalHarga();
    }

    function updateRowNumbers() {
        const rows = document.querySelectorAll('#booksTable tbody tr');
        bookCount = rows.length;
        rows.forEach((row, index) => {
            row.cells[0].innerText = index + 1;
        });
    }

    function updateTotalHarga() {
        let totalHarga = 0;
        const rows = document.querySelectorAll('#booksTable tbody tr');
        rows.forEach(row => {
            const jumlah = row.querySelector('input[name="jumlah[]"]').value;
            const harga = row.querySelector('input[name="harga[]"]').value;
            totalHarga += jumlah * harga;
        });
        document.getElementById('total_harga').value = totalHarga;
        calculateKembalian();
    }

    function calculateKembalian() {
        const totalHarga = parseFloat(document.getElementById('total_harga').value) || 0;
        const nominalBayar = parseFloat(document.getElementById('nominal_bayar').value) || 0;
        const kembalian = nominalBayar - totalHarga;
        document.getElementById('kembalian').value = kembalian;
    }
});

    </script>
@endsection
