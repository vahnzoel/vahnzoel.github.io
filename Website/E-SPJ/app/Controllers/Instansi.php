<?php

namespace App\Controllers;

use App\Models\InsModel;

class Instansi extends BaseController
{
    protected $modelIns;

    public function __construct()
    {
        $this->modelIns = new InsModel();
    }

    public function index()
    {
        $request = \Config\Services::request();
        $data = [
            'title' => 'Ubah Data Instansi', //Judul Halaman
            'animation' => '/dist/img/vz.png', //Logo Animasi
            'logo' => '/dist/img/logo.png', //Logo Navbar
            'copyright' => 'Kecamatan Jayanti', //Copyright Footer
            'validasi' => \Config\Services::validation(),
            'instansi' => $this->db->query("SELECT * FROM instansi WHERE id = '1'")->getResultArray()
        ];

        return view('instansi', $data);
    }

    public function update()
    {
        $request = \Config\Services::request();
        if (!$this->validate([
            'nip' => [
                'rules' => 'required|min_length[18]|max_length[18]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'min_length' => '{field} Minimal 18 Karakter',
                    'max_length' => '{field} Maksimal 18 Karakter',
                    'is_unique' => 'NIP sudah digunakan sebelumnya'
                ]
            ],
            'nama' => [
                'rules' => 'required|min_length[4]|max_length[100]',
                'errors' => [
                    'required' => 'Harus diisi',
                    'min_length' => 'Minimal 4 Karakter',
                    'max_length' => 'Maksimal 100 Karakter',
                ]
            ],
            'pengguna' => [
                'rules' => 'required|min_length[4]|max_length[100]',
                'errors' => [
                    'required' => 'Harus diisi',
                    'min_length' => 'Minimal 4 Karakter',
                    'max_length' => 'Maksimal 100 Karakter',
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Harus diisi'
                ]
            ],
            'dpa' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Harus diisi'
                ]
            ],
            'tahun' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Harus diisi'
                ]
            ],
            'logo' => [
                'rules' => 'max_size[logo,1024]|is_image[logo]
                    |mime_in[logo,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar tidak boleh lebih dari 1Mb.',
                    'is_image' => 'Yang anda pilih bukan gambar.',
                    'mime_in' => 'Yang anda pilih bukan gambar.'
                ]
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        $instansi = new InsModel();
        $filelogo = $request->getFile('logo');
        $namaFile = $filelogo->getRandomName();
        $filelogo->move('dist/img/', $namaFile);
        unlink('dist/img/' . $request->getVar('fileLama'));
        $instansi->insert([
            'nip' => $request->getVar('nip'),
            'nama' => $request->getVar('nama'),
            'pengguna' => $request->getVar('pengguna'),
            'alamat' => $request->getVar('alamat'),
            'logo' => $namaFile,
            'dpa' => $request->getVar('dpa'),
            'tahun' => $request->getVar('tahun')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');
        return redirect()->back()->withInput();
    }
}
