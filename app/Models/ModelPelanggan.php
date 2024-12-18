<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPelanggan extends Model
{
    protected $table = 'pelanggan';
    protected $primaryKey = 'kode_pelanggan';
    protected $allowedFields = ['nama_pelanggan', 'handphone', 'alamat', 'username', 'password','email','otp_expired_at','otp_code','is_verified'];
    protected $useAutoIncrement = true;
}
