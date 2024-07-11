<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detail_penjualans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_penjualan')
            ->nullable()
            ->constrained('penjualans', 'id')
            ->cascadeOnUpdate()
            ->restrictOnDelete();
            $table->foreignId('id_barang')
            ->nullable()
            ->constrained('barangs', 'id')
            ->cascadeOnUpdate()
            ->restrictOnDelete();
            $table->integer('jumlah');
            $table->double('harga');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_penjualans');
    }
};
