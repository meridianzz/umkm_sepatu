<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelDetailPenjualan extends Model
{
    protected $table = 'detail_penjualan';
    protected $primaryKey = 'id_detail';
    protected $allowedFields = ['id_penjualan', 'kode_brg', 'jumlah', 'harga_brg', 'total_harga'];
    protected $useAutoIncrement = true;
}
