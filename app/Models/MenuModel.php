<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model
{
    protected $table = 'menu';
    protected $primaryKey = 'menu_id';
    protected $allowedFields = ['nama_menu', 'harga', 'kategori', 'deskripsi', 'foto', 'is_available'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
}
