<?php

namespace App\Models;

use CodeIgniter\Model;

class ProgModel extends Model
{
    protected $table      = 'program';
    protected $primaryKey = 'id_program';
    protected $allowedFields = ['pptk', 'id_program', 'nama_prog', 'slug_prog', 'keterangan_prog', 'id_user'];
    protected $useTimestamps = true;

    public function getProgram($slug = false)
    {
        if ($slug == false) {
            $user = session()->get('id');
            if ($user == 1 || $user == 2) {
                return $this->asArray();
            } else {
                return $this->where(['id_user' => $user]);
            }
        }
        return $this->where(['slug_prog' => $slug])->first();
    }

    public function search($keyword)
    {
        return $this->like('nama_prog', $keyword)->orLike('pptk', $keyword);
    }
}
