<?php

namespace App\Models;

use CodeIgniter\Model;

class SubModel extends Model
{
    protected $table      = 'subkegiatan';
    protected $primaryKey = 'id_sub';
    protected $allowedFields = ['pptk', 'nama_prog', 'nama_keg', 'nama_sub', 'slug_sub', 'keterangan_sub', 'id_user', 'id_program', 'id_kegiatan'];
    protected $useTimestamps = true;

    public function getSub($slug = false)
    {
        $user = session()->get('id');
        if ($slug == false) {
            if ($user == 1 || $user == 2) {
                return $this->asArray();
            } else {
                return $this->where(['id_user' => $user])->asArray();
            }
        }
        return $this->where(['slug_sub' => $slug])->first();
    }

    public function Sub($id)
    {
        return $this->where(['id_sub' => $id])->first();
    }

    public function search($keyword)
    {
        return $this->like('nama_sub', $keyword)->orLike('pptk', $keyword);
    }
}
