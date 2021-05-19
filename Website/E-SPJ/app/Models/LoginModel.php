<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id';
    protected $returnType = "object";
    protected $allowedFields = ['nip', 'password', 'nama', 'alamat', 'foto'];
    protected $useTimestamps = true;
}
