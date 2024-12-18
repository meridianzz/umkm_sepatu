<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelBarang extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'kode_brg';
    protected $allowedFields = ['nama_brg', 'kode_kategori', 'harga_brg', 'stok', 'ukuran', 'status', 'foto_brg','deskripsi_brg'];
    protected $useAutoIncrement = true;
}
