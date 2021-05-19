<?php

namespace App\Controllers;

use App\Models\SubModel;
use App\Models\KegModel;
use App\Models\ProgModel;

class Subkegiatan extends BaseController
{
    protected $modelSub;
    protected $modelKeg;
    protected $modelProg;

    public function __construct()
    {
        $this->modelSub = new SubModel();
        $this->modelKeg = new KegModel();
        $this->modelProg = new ProgModel();
    }

    public function index()
    {
        $request = \Config\Services::request();
        $current_page = $request->getVar('page_subkegiatan') ? $request->getVar('page_subkegiatan') : 1;
        $no = 1 + (10 * ($current_page - 1));
        $keyword = $request->getVar('keyword');
        if ($keyword) {
            $subkegiatan = $this->modelSub->search($keyword);
        } else {
            $subkegiatan = $this->modelSub->getSub();
        }
        $data = [
            'title' => 'Daftar Sub Kegiatan', //Judul Halaman
            'animation' => '/dist/img/vz.png', //Logo Animasi
            'logo' => '/dist/img/logo.png', //Logo Navbar
            'copyright' => 'Kecamatan Jayanti', //Copyright Footer
            'sub' => $subkegiatan->paginate(10),
            'pager' => $subkegiatan->pager,
            'no' => $no
        ];

        echo view('subkegiatan/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Form Tambah Sub Kegiatan', //Judul Halaman
            'animation' => '/dist/img/vz.png', //Logo Animasi
            'logo' => '/dist/img/logo.png', //Logo Navbar
            'copyright' => 'Kecamatan Jayanti', //Copyright Footer
            'validasi' => \Config\Services::validation(),
            'program' => $this->db->query("SELECT * FROM program")->getResultArray(),
            'kegiatan' => $this->db->query("SELECT * FROM kegiatan")->getResultArray()
        ];

        return view('subkegiatan/create', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'sub' => [
                'rules' => 'required|is_unique[subkegiatan.nama_sub]',
                'errors' => [
                    'required' => '{field} Sub Kegiatan harus diisi.',
                    'is_unique' => '{field} Sub Kegiatan sudah ada.'
                ]
            ],
            'keterangan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Sub Kegiatan harus diisi.',
                ]
            ]

        ])) {

            return redirect()->to('/subkegiatan/create')->withInput();
        }
        $request = \Config\Services::request();
        $slug = url_title($request->getVar('sub'), '-', true);
        $prog = $request->getVar('program');
        $keg = $request->getVar('kegiatan');
        $p = $this->modelProg->where(['id_program' => $prog])->first();
        $k = $this->modelKeg->where(['id_kegiatan' => $keg])->first();
        $this->modelSub->save([
            'nama_prog' => $p['nama_prog'],
            'nama_keg' => $k['nama_keg'],
            'nama_sub' => $request->getVar('sub'),
            'slug_sub' => $slug,
            'keterangan_sub' => $request->getVar('keterangan'),
            'id_user' => session()->get('id'),
            'pptk' => session()->get('nama'),
            'id_kegiatan' => $keg,
            'id_program' => $prog
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/subkegiatan');
    }

    public function edit($slug)
    {
        $data = [
            'title' => 'Form Ubah Data subkegiatan', //Judul Halaman
            'animation' => '/dist/img/vz.png', //Logo Animasi
            'logo' => '/dist/img/logo.png', //Logo Navbar
            'copyright' => 'Kecamatan Jayanti', //Copyright Footer
            'validasi' => \Config\Services::validation(),
            'sub' => $this->modelSub->getSub($slug),
            'program' => $this->db->query("SELECT * FROM program")->getResultArray(),
            'kegiatan' => $this->db->query("SELECT * FROM kegiatan")->getResultArray()
        ];

        return view('subkegiatan/edit', $data);
    }

    public function update($id)
    {
        $request = \Config\Services::request();
        $kegLama = $this->modelSub->getSub($request->getVar('slug'));
        if ($kegLama['nama_sub'] == $request->getVar('sub')) {
            $rule_nama = 'required';
        } else {
            $rule_nama = 'required|is_unique[subkegiatan.nama_sub]';
        }
        if (!$this->validate([
            'sub' => [
                'rules' => $rule_nama,
                'errors' => [
                    'required' => '{field} Sub Kegiatan harus diisi.',
                    'is_unique' => '{field} Sub Kegiatan sudah ada.'
                ]
            ],
            'keterangan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Sub Kegiatan harus diisi.',
                ]
            ]

        ])) {

            return redirect()->to('/subkegiatan/edit/' . $request->getVar('slug'))->withInput();
        }
        $slug = url_title($request->getVar('sub'), '-', true);
        $prog = $request->getVar('program');
        $keg = $request->getVar('kegiatan');
        $p = $this->modelProg->where(['id_program' => $prog])->first();
        $k = $this->modelKeg->where(['id_kegiatan' => $keg])->first();
        $this->modelSub->save([
            'id_sub' => $id,
            'nama_prog' => $p['nama_prog'],
            'nama_keg' => $k['nama_keg'],
            'nama_sub' => $request->getVar('sub'),
            'slug_sub' => $slug,
            'keterangan_sub' => $request->getVar('keterangan'),
            'id_program' => $prog,
            'id_kegiatan' => $keg
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/subkegiatan');
    }

    public function delete($id)
    {
        $this->modelSub->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/subkegiatan');
    }
}
