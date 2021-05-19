<?php

namespace App\Controllers;

use App\Models\SubModel;
use App\Models\ItemModel;

class Npd extends BaseController
{
    protected $modelSub;
    protected $modelItem;

    public function __construct()
    {
        $this->modelSub = new SubModel();
        $this->modelItem = new ItemModel();
    }

    public function index()
    {
        $request = \Config\Services::request();
        $current_page = $request->getVar('page_npd') ? $request->getVar('page_npd') : 1;
        $no = 1 + (10 * ($current_page - 1));
        $keyword = $request->getVar('keyword');
        if ($keyword) {
            $subkegiatan = $this->modelSub->search($keyword);
        } else {
            $subkegiatan = $this->modelSub->getSub();
        }
        $data = [
            'title' => 'Cetak NPD', //Judul Halaman
            'animation' => '/dist/img/vz.png', //Logo Animasi
            'logo' => '/dist/img/logo.png', //Logo Navbar
            'copyright' => 'Kecamatan Jayanti', //Copyright Footer
            'sub' => $subkegiatan->paginate(10),
            'pager' => $subkegiatan->pager,
            'no' => $no
        ];

        echo view('npd/index', $data);
    }

    public function cetak($id)
    {
        // dd($this->db->query("SELECT * FROM users WHERE id = '$user'")->getResultArray());
        $data = [
            'title' => 'Cetak NPD', //Judul Halaman
            'nama' => session()->get('nama'),
            'instansi' => $this->db->query("SELECT * FROM instansi WHERE id = '1'")->getResultArray(),
            'nip' => session()->get('nip'),
            'sub' => $this->modelSub->Sub($id),
            'item' => $this->modelItem->npd($id),
            'sum' => $this->modelItem->sum($id),
            'no' => '1'
        ];

        return view('npd/cetak', $data);
    }
}
