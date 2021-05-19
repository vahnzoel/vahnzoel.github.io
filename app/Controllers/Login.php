<?php

namespace App\Controllers;

use App\Models\LoginModel;

class Login extends BaseController
{

    public function index()
    {
        $data = [
            'logo' => '/dist/img/logo.png', //Logo Navbar
            'copyright' => 'Kecamatan Jayanti', //Copyright Footer
        ];
        echo view('login', $data);
    }

    public function process()
    {
        $request = \Config\Services::request();

        $users = new LoginModel();
        $nip = $request->getVar('nip');
        $password = $request->getVar('password');
        $dataUser = $users->where([
            'nip' => $nip,
        ])->first();
        if ($dataUser) {
            if (password_verify($password, $dataUser->password)) {
                session()->set([
                    'id' => $dataUser->id,
                    'nip' => $dataUser->nip,
                    'nama' => $dataUser->nama,
                    'alamat' => $dataUser->alamat,
                    'foto' => $dataUser->foto,
                    'logged_in' => TRUE
                ]);
                return redirect()->to(base_url('/'));
            } else {
                session()->setFlashdata('error', 'nip & Password Salah');
                return redirect()->back();
            }
        } else {
            session()->setFlashdata('error', 'nip & Password Salah');
            return redirect()->back();
        }
    }

    function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
