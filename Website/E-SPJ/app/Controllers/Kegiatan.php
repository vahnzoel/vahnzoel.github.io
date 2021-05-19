<?php

namespace App\Controllers;

use App\Models\KegModel;
use App\Models\ProgModel;

class Kegiatan extends BaseController
{
    protected $modelKeg;
    protected $modelProg;


    public function __construct()
    {
        $this->modelKeg = new KegModel();
        $this->modelProg = new ProgModel();
    }

    public function index()
    {
        $request = \Config\Services::request();
        $current_page = $request->getVar('page_kegiatan') ? $request->getVar('page_kegiatan') : 1;
        $no = 1 + (10 * ($current_page - 1));
        $keyword = $request->getVar('keyword');
        if ($keyword) {
            $kegiatan = $this->modelKeg->search($keyword);
        } else {
            $kegiatan = $this->modelKeg->getKegiatan();
        }
        $data = [
            'title' => 'Daftar Kegiatan', //Judul Halaman
            'animation' => '/dist/img/vz.png', //Logo Animasi
            'logo' => '/dist/img/logo.png', //Logo Navbar
            'copyright' => 'Kecamatan Jayanti', //Copyright Footer
            'kegiatan' => $kegiatan->paginate(10),
            'pager' => $kegiatan->pager,
            'no' => $no
        ];

        echo view('kegiatan/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Form Tambah Kegiatan', //Judul Halaman
            'animation' => '/dist/img/vz.png', //Logo Animasi
            'logo' => '/dist/img/logo.png', //Logo Navbar
            'copyright' => 'Kecamatan Jayanti', //Copyright Footer
            'validasi' => \Config\Services::validation(),
            'program' => $this->db->query("SELECT * FROM program")->getResultArray()
        ];

        return view('kegiatan/create', $data);
    }

    public function save()
    {
        $request = \Config\Services::request();
        if (!$this->validate([
            'kegiatan' => [
                'rules' => 'required|is_unique[kegiatan.nama_keg]',
                'errors' => [
                    'required' => '{field} kegiatan harus diisi.',
                    'is_unique' => '{field} kegiatan sudah ada.'
                ]
            ],
            'keterangan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} kegiatan harus diisi.',
                ]
            ]

        ])) {

            return redirect()->to('/kegiatan/create')->withInput();
        }
        $slug = url_title($request->getVar('kegiatan'), '-', true);
        $prog = $request->getVar('program');
        $p = $this->modelProg->where(['id_program' => $prog])->first();
        $this->modelKeg->save([
            'nama_prog' => $p['nama_prog'],
            'nama_keg' => $request->getVar('kegiatan'),
            'slug_keg' => $slug,
            'keterangan_keg' => $request->getVar('keterangan'),
            'id_user' => session()->get('id'),
            'pptk' => session()->get('nama'),
            'id_program' => $prog
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/kegiatan');
    }

    public function edit($slug)
    {
        $data = [
            'title' => 'Form Ubah Data Kegiatan', //Judul Halaman
            'animation' => '/dist/img/vz.png', //Logo Animasi
            'logo' => '/dist/img/logo.png', //Logo Navbar
            'copyright' => 'Kecamatan Jayanti', //Copyright Footer
            'validasi' => \Config\Services::validation(),
            'kegiatan' => $this->modelKeg->getkegiatan($slug),
            'program' => $this->db->query("SELECT * FROM kegiatan")->getResultArray()
        ];

        return view('kegiatan/edit', $data);
    }

    public function update($id)
    {
        $request = \Config\Services::request();
        $kegLama = $this->modelKeg->getkegiatan($request->getVar('slug'));
        if ($kegLama['nama_keg'] == $request->getVar('kegiatan')) {
            $rule_nama = 'required';
        } else {
            $rule_nama = 'required|is_unique[kegiatan.nama_keg]';
        }
        if (!$this->validate([
            'kegiatan' => [
                'rules' => $rule_nama,
                'errors' => [
                    'required' => '{field} kegiatan harus diisi.',
                    'is_unique' => '{field} kegiatan sudah ada.'
                ]
            ],
            'keterangan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} kegiatan harus diisi.',
                ]
            ]

        ])) {

            return redirect()->to('/kegiatan/edit/' . $request->getVar('slug'))->withInput();
        }
        $slug = url_title($request->getVar('kegiatan'), '-', true);
        $prog = $request->getVar('program');
        $p = $this->modelProg->where(['id_program' => $prog])->first();
        $this->modelKeg->save([
            'id_kegiatan' => $id,
            'nama_prog' => $p['nama_prog'],
            'nama_keg' => $request->getVar('kegiatan'),
            'slug_keg' => $slug,
            'keterangan_keg' => $request->getVar('keterangan'),
            'id_program' => $prog
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/kegiatan');
    }

    public function delete($id)
    {
        $this->modelKeg->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/kegiatan');
    }
}
