<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'transaksi_id';
    protected $allowedFields = ['pesanan_id', 'kasir_id', 'total_bayar', 'metode_pembayaran'];
    protected $useTimestamps = true;
}
