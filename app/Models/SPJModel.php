<?php

namespace App\Models;

use CodeIgniter\Model;

class SPJModel extends Model
{
    protected $table      = 'spj';
    protected $primaryKey = 'id_spj';
    protected $returnType = "object";
    protected $allowedFields = ['pptk', 'nama_prog', 'nama_keg', 'nama_sub', 'file', 'instansi', 'id_sub', 'id_user', 'id_program', 'id_kegiatan'];
    protected $useTimestamps = true;

    public function getSPJ()
    {
        $user = session()->get('id');
        if ($user == 1 || $user == 2) {
            return $this->asArray();
        } else {
            return $this->db->table('spj')->select('*')->where(['id_user', $user])->get();
        }
    }

    public function SPJ()
    {
        $user = session()->get('id');
        $this->db->query("SELECT * FROM spj WHERE id_user = '$user'");
        return $this;
    }

    public function search($keyword)
    {
        return $this->like('nama_sub', $keyword)->orLike('pptk', $keyword);
    }
}
