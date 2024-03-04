<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable =[
        'nama_barang', 'stok', 'jumlah_terjual', 'tanggal_transaksi', 'jenis_barang'
    ];
}
