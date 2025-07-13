<?php

namespace App\Models;

use CodeIgniter\Model;

class PesananDetailModel extends Model
{
    protected $table = 'pesanan_detail';
    protected $primaryKey = 'detail_id';
    protected $allowedFields = ['pesanan_id', 'menu_id', 'qty', 'subtotal'];
}
    