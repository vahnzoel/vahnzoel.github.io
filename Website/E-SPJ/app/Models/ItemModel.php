<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemModel extends Model
{
    protected $table      = 'item';
    protected $primaryKey = 'id_item';
    protected $allowedFields = ['pptk', 'nama_sub', 'rek', 'uraian', 'anggaran', 'sisa', 'cair', 'id_user', 'id_sub'];
    protected $useTimestamps = true;

    public function getItem($item = false)
    {
        if ($item == false) {
            $user = session()->get('id');
            if ($user == 1 || $user == 2) {
                return $this->asArray();
            } else {
                return $this->where(['id_user' => $user]);
            }
        }
        return $this->where(['id_item' => $item])->first();
    }

    public function npd($id)
    {
        return $this->db->query("SELECT * FROM item WHERE id_sub = '$id'")->getResultArray();
    }

    public function search($keyword)
    {
        return $this->like('uraian', $keyword)->orlike('pptk', $keyword);
    }

    public function sum($id)
    {
        $this->selectSum('anggaran');
        $this->selectSum('sisa');
        $this->selectSum('cair');
        $this->where(['id_sub' => $id]);
        return $this->first();
    }
}
