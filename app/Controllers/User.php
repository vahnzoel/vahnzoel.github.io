<?php

namespace App\Controllers;

use App\Models\UserModel;

class User extends BaseController
{
    protected $modelUser;

    public function __construct()
    {
        $this->modelUser = new UserModel();
    }

    public function index()
    {
        $request = \Config\Services::request();
        $id = ['1', '2'];
        $current_page = $request->getVar('page_user') ? $request->getVar('page_user') : 1;
        $no = 1 + (10 * ($current_page - 1));
        $keyword = $request->getVar('keyword');
        if ($keyword) {
            $user = $this->modelUser->search($keyword);
        } else {
            $user = $this->modelUser->select('*')->whereNotIn('id', $id)->asArray();
        }
        $data = [
            'title' => 'Daftar PPTK', //Judul Halaman
            'animation' => '/dist/img/vz.png', //Logo Animasi
            'logo' => '/dist/img/logo.png', //Logo Navbar
            'copyright' => 'Kecamatan Jayanti', //Copyright Footer
            'user' => $user->paginate(10),
            'pager' => $user->pager,
            'no' => $no
        ];

        echo view('user/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Edit Profile', //Judul Halaman
            'animation' => '/dist/img/vz.png', //Logo Animasi
            'logo' => '/dist/img/logo.png', //Logo Navbar
            'copyright' => 'Kecamatan Jayanti', //Copyright Footer
            'validasi' => \Config\Services::validation()
        ];

        return view('user/create', $data);
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Ubah Data PPTK', //Judul Halaman
            'animation' => '/dist/img/vz.png', //Logo Animasi
            'logo' => '/dist/img/logo.png', //Logo Navbar
            'copyright' => 'Kecamatan Jayanti', //Copyright Footer
            'validasi' => \Config\Services::validation(),
            'user' => $this->db->query("SELECT * FROM users WHERE id = '$id'")->getResultArray()
        ];

        return view('user/edit', $data);
    }

    public function update()
    {
        $request = \Config\Services::request();
        $nipLama = session()->get('nip');
        if ($nipLama == $request->getVar('nip')) {
            $rule_nip = 'required|min_length[18]|max_length[18]';
        } else {
            $rule_nip = 'required|min_length[18]|max_length[18]|is_unique[users.nip]';
        }
        if (!$this->validate([
            'nip' => [
                'rules' => $rule_nip,
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
        $users = new UserModel();
        $filefoto = $request->getFile('foto');
        if ($filefoto->getError() == 4) {
            $namaFile = 'default.png';
        } else {
            $namaFile = $filefoto->getRandomName();
            $filefoto->move('uploads/foto', $namaFile);
            unlink('uploads/foto/' . $request->getVar('fileLama'));
        }
        $users->insert([
            'nip' => $request->getVar('nip'),
            'password' => password_hash($request->getVar('password'), PASSWORD_DEFAULT),
            'nama' => $request->getVar('nama'),
            'alamat' => $request->getVar('alamat'),
            'foto' => $namaFile
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');
        return redirect()->back()->withInput();
    }

    public function delete($id)
    {
        $this->ModelUser->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/user');
    }
}
