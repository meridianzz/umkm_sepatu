<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPenjualan extends Model
{
    protected $table = 'penjualan';
    protected $primaryKey = 'id_penjualan';
    protected $allowedFields = ['kode_pelanggan', 'total_harga','status', 'bukti_bayar','tanggal_pembelian'];
    protected $useAutoIncrement = true;
}
