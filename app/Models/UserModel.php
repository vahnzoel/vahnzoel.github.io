<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nip', 'password', 'nama', 'alamat', 'foto'];
    protected $useTimestamps = true;

    // public function getUser($user)
    // {
    //     return $this->where(['id' => $user])->getResultArray();
    // }

    public function search($keyword)
    {
        return $this->like('nama', $keyword)->orLike('nip', $keyword);
    }
}
