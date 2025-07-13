<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'user_id';
    protected $allowedFields = ['nama', 'email', 'password', 'user_level', 'is_active'];
    protected $useTimestamps = true;
}
