<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangMasukModel extends Model
{
    protected $table = 'barang_masuk';
    protected $primaryKey = 'kode_brgmasuk';
    protected $allowedFields = ['kode_supp', 'tgl_masuk', 'jumlah'];
}
