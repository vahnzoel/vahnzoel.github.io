<?php

namespace App\Models;

use CodeIgniter\Model;

class InsModel extends Model
{
    protected $table      = 'instansi';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'logo', 'nip', 'alamat', 'pengguna', 'dpa', 'tahun'];
    protected $useTimestamps = true;
}
