<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKategori extends Model
{
    protected $table = 'kategori';
    protected $primaryKey = 'kode_kategori';
    protected $allowedFields = ['nama_kategori'];
    protected $useAutoIncrement = true;

}