<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuBahanModel extends Model
{
    protected $table = 'menu_bahan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['menu_id', 'bahan_id', 'jumlah', 'satuan'];
}
