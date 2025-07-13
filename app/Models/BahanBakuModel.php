<?php

namespace App\Models;

use CodeIgniter\Model;

class BahanBakuModel extends Model
{
    protected $table = 'bahan_baku';
    protected $primaryKey = 'bahan_id';
    protected $allowedFields = ['nama_bahan', 'satuan', 'stok'];
    protected $useTimestamps = true;
}
