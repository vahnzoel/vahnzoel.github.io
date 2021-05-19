<?php

namespace App\Controllers;

use App\Models\ProgModel;

class Program extends BaseController
{
    protected $modelProg;

    public function __construct()
    {
        $this->modelProg = new ProgModel();
    }

    public function index()
    {
        $request = \Config\Services::request();
        $current_page = $request->getVar('page_program') ? $request->getVar('page_program') : 1;
        $no = 1 + (10 * ($current_page - 1));
        $keyword = $request->getVar('keyword');
        if ($keyword) {
            $program = $this->modelProg->search($keyword);
        } else {
            $program = $this->modelProg;
        }
        $data = [
            'title' => 'Daftar Program', //Judul Halaman
            'animation' => '/dist/img/vz.png', //Logo Animasi
            'logo' => '/dist/img/logo.png', //Logo Navbar
            'copyright' => 'Kecamatan Jayanti', //Copyright Footer
            'program' => $program->paginate(10),
            'pager' => $program->pager,
            'no' => $no
        ];

        echo view('program/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Form Tambah Program', //Judul Halaman
            'animation' => '/dist/img/vz.png', //Logo Animasi
            'logo' => '/dist/img/logo.png', //Logo Navbar
            'copyright' => 'Kecamatan Jayanti', //Copyright Footer
            'validasi' => \Config\Services::validation()
        ];

        return view('program/create', $data);
    }

    public function save()
    {
        $request = \Config\Services::request();
        if (!$this->validate([
            'program' => [
                'rules' => 'required|is_unique[program.nama_prog]',
                'errors' => [
                    'required' => '{field} program harus diisi.',
                    'is_unique' => '{field} program sudah ada.'
                ]
            ],
            'keterangan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} program harus diisi.',
                ]
            ]

        ])) {

            return redirect()->to('/program/create')->withInput();
        }
        $slug = url_title($request->getVar('program'), '-', true);
        $this->modelProg->save([
            'nama_prog' => $request->getVar('program'),
            'slug_prog' => $slug,
            'keterangan_prog' => $request->getVar('keterangan'),
            'id_user' => session()->get('id'),
            'pptk' => session()->get('nama')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/program');
    }

    public function edit($slug)
    {
        $data = [
            'title' => 'Form Ubah Data Program', //Judul Halaman
            'animation' => '/dist/img/vz.png', //Logo Animasi
            'logo' => '/dist/img/logo.png', //Logo Navbar
            'copyright' => 'Kecamatan Jayanti', //Copyright Footer
            'validasi' => \Config\Services::validation(),
            'program' => $this->modelProg->getProgram($slug)
        ];

        return view('program/edit', $data);
    }

    public function update($id)
    {
        $request = \Config\Services::request();
        $progLama = $this->modelProg->getProgram($request->getVar('slug'));
        if ($progLama['nama_prog'] == $request->getVar('program')) {
            $rule_nama = 'required';
        } else {
            $rule_nama = 'required|is_unique[program.nama_prog]';
        }
        if (!$this->validate([
            'program' => [
                'rules' => $rule_nama,
                'errors' => [
                    'required' => '{field} program harus diisi.',
                    'is_unique' => '{field} program sudah ada.'
                ]
            ],
            'keterangan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} program harus diisi.',
                ]
            ]

        ])) {

            return redirect()->to('/program/edit/' . $request->getVar('slug'))->withInput();
        }
        $slug = url_title($request->getVar('program'), '-', true);
        $this->modelProg->save([
            'id_program' => $id,
            'nama_prog' => $request->getVar('program'),
            'slug_prog' => $slug,
            'keterangan_prog' => $request->getVar('keterangan')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/program');
    }

    public function delete($id)
    {
        $this->modelProg->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/program');
    }
}
