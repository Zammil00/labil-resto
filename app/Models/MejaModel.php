<?php

namespace App\Models;

use CodeIgniter\Model;

class MejaModel extends Model
{
    protected $table = 'meja';
    protected $primaryKey = 'meja_id';
    protected $allowedFields = ['nomor_meja', 'keterangan', 'status'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
}
