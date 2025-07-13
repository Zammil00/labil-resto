<?php

namespace App\Models;

use CodeIgniter\Model;

class PesananModel extends Model
{
    protected $table = 'pesanan';
    protected $primaryKey = 'pesanan_id';
    protected $allowedFields = ['user_id', 'meja_id', 'meja_nomor', 'status', 'total'];
    protected $useTimestamps = true;
}
