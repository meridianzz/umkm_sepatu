<?php

namespace App\Models;

use CodeIgniter\Model;

class SupplierModel extends Model
{
    protected $table = 'supplier';
    protected $primaryKey = 'kode_supp';
    protected $allowedFields = ['nama_supp', 'handphone'];
    protected $useAutoIncrement = true;
}
