<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;
    protected $fillable = ['id_user', 'kode_transaksi', 'tanggal_transaksi', 'total_harga', 'nominal_bayar', 'kembalian'];

    public function details()
    {
        return $this->hasMany(DetailPenjualan::class, 'id_penjualan');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
