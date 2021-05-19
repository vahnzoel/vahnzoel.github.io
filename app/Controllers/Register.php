<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Register extends BaseController
{

    public function index()
    {
        $data = [
            'title' => 'Daftar User', //Judul Halaman
            'animation' => '/dist/img/vz.png', //Logo Animasi
            'logo' => '/dist/img/logo.png', //Logo Navbar
            'copyright' => 'Kecamatan Jayanti', //Copyright Footer
            'validasi' => \Config\Services::validation()
        ];
        echo view('user/create', $data);
    }

    public function process()
    {
        $request = \Config\Services::request();
        if (!$this->validate([
            'nip' => [
                'rules' => 'required|min_length[18]|max_length[18]|is_unique[users.nip]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'min_length' => '{field} Minimal 18 Karakter',
                    'max_length' => '{field} Maksimal 18 Karakter',
                    'is_unique' => 'NIP sudah digunakan sebelumnya'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[4]|max_length[50]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'min_length' => '{field} Minimal 4 Karakter',
                    'max_length' => '{field} Maksimal 50 Karakter',
                ]
            ],
            'passconfirm' => [
                'rules' => 'matches[password]',
                'errors' => [
                    'matches' => 'Konfirmasi Password tidak sesuai dengan password',
                ]
            ],
            'nama' => [
                'rules' => 'required|min_length[4]|max_length[100]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'min_length' => '{field} Minimal 4 Karakter',
                    'max_length' => '{field} Maksimal 100 Karakter',
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi'
                ]
            ],
            'foto' => [
                'rules' => 'max_size[foto,1024]|is_image[foto]
                    |mime_in[foto,image/jpg,image/jpeg,image/png]',
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
        $users = new UsersModel();
        $filefoto = $request->getFile('foto');
        if ($filefoto->getError() == 4) {
            $namaFile = 'default.png';
        } else {
            $namaFile = $filefoto->getRandomName();
            $filefoto->move('uploads/foto', $namaFile);
        }
        $users->insert([
            'nip' => $request->getVar('nip'),
            'password' => password_hash($request->getVar('password'), PASSWORD_DEFAULT),
            'nama' => $request->getVar('nama'),
            'alamat' => $request->getVar('alamat'),
            'foto' => $namaFile
        ]);
        return redirect()->to('/login');
    }
}
