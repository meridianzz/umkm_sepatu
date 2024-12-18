<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKeranjang extends Model
{
    protected $table = 'keranjang';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'kode_brg', 'jumlah', 'harga_brg', 'total_harga'];
    protected $useTimestamps = false; // Jika tabel memiliki kolom created_at dan updated_at
}
