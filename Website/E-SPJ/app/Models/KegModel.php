<?php

namespace App\Models;

use CodeIgniter\Model;

class KegModel extends Model
{
    protected $table      = 'kegiatan';
    protected $primaryKey = 'id_kegiatan';
    protected $allowedFields = ['pptk', 'nama_prog', 'nama_keg', 'slug_keg', 'keterangan_keg', 'id_user', 'id_program'];
    protected $useTimestamps = true;

    public function getKegiatan($slug = false)
    {
        if ($slug == false) {
            $user = session()->get('id');
            if ($user == 1 || $user == 2) {
                return $this->asArray();
            } else {
                return $this->where(['id_user' => $user]);
            }
        }
        return $this->where(['slug_keg' => $slug])->first();
    }

    public function search($keyword)
    {
        return $this->like('nama_keg', $keyword)->orLike('pptk', $keyword);
    }

    public function Join()
    {
        $this->select('*,program.nama_prog as prog_nama, kegiatan.nama_keg as keg_nama, kegiatan.keterangan_keg as keg_ket');
        $this->join('program', 'program.id_program = kegiatan.id_program');
        $join = $this->get();
        // $this->db->table('kegiatan');
        // $this->select('program.nama_prog, kegiatan.nama_keg, kegiatan.keterangan_keg');
        // $this->Join('program', 'program.id_program = kegiatan.id_program');
        // $join = $this->db->query("SELECT program.id_program, Program.nama_prog, kegiatan.nama_keg FROM kegiatan INNER JOIN program ON program.id_program = kegiatan.id_program")->get();
        // $join = $this->select('program.nama_prog, kegiatan.nama_keg, kegiatan.keterangan_keg')->join('program', 'program.id_program = kegiatan.id_program')->first();
        return $join->result_array();
    }
}
