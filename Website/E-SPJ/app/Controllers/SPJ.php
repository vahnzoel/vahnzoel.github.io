<?php

namespace App\Controllers;

use App\Models\SubModel;
use App\Models\ProgModel;
use App\Models\KegModel;
use App\Models\SPJModel;

class SPJ extends BaseController
{
    protected $modelSub;
    protected $modelProg;
    protected $modelKeg;
    protected $modelSPJ;

    public function __construct()
    {
        $this->modelSub = new SubModel();
        $this->modelProg = new ProgModel();
        $this->modelKeg = new KegModel();
        $this->modelSPJ = new SPJModel();
    }

    public function index()
    {
        // dd($this->modelSPJ->getSPJ());
        $request = \Config\Services::request();
        $id = [session()->get('id')];
        $current_page = $request->getVar('page_spj') ? $request->getVar('page_spj') : 1;
        $no = 1 + (10 * ($current_page - 1));
        $keyword = $request->getVar('keyword');
        if ($keyword) {
            $spj = $this->modelSPJ->search($keyword);
        } else {
            if (session()->get('id') == 1 || session()->get('id') == 2) {
                $spj = $this->modelSPJ->asArray();
            } else {
                $spj = $this->modelSPJ->select('*')->whereIn('id_user', $id)->asArray();
            }
        }
        // dd($this->modelSPJ->getSPJ());
        $data = [
            'title' => 'Daftar SPJ', //Judul Halaman
            'animation' => '/dist/img/vz.png', //Logo Animasi
            'logo' => '/dist/img/logo.png', //Logo Navbar
            'copyright' => 'Kecamatan Jayanti', //Copyright Footer
            'spj' => $spj->paginate(10),
            'pager' => $spj->pager,
            'no' => $no
        ];

        echo view('spj/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Form Tambah SPJ', //Judul Halaman
            'animation' => '/dist/img/vz.png', //Logo Animasi
            'logo' => '/dist/img/logo.png', //Logo Navbar
            'copyright' => 'Kecamatan Jayanti', //Copyright Footer
            'validasi' => \Config\Services::validation(),
            'program' => $this->db->query("SELECT * FROM program")->getResultArray(),
            'kegiatan' => $this->db->query("SELECT * FROM kegiatan")->getResultArray(),
            'sub' => $this->db->query("SELECT * FROM subkegiatan")->getResultArray()
        ];

        return view('spj/create', $data);
    }

    public function save()
    {
        $request = \Config\Services::request();
        if (!$this->validate([
            'file' => [
                'rules' => 'max_size[file,10024]|uploaded[file]|ext_in[pdf]',
                'errors' => [
                    'max_size' => 'Ukuran File tidak boleh lebih dari 10Mb.',
                    'uploaded' => '{field} SPJ harus diupload.',
                    'ext_in' => '{field} SPJ harus PDF.'
                ]
            ]

        ])) {

            return redirect()->to('/spj/create')->withInput();
        }

        $request = \Config\Services::request();
        $prog = $request->getVar('program');
        $keg = $request->getVar('kegiatan');
        $sub = $request->getVar('sub');
        $p = $this->modelProg->where(['id_program' => $prog])->first();
        $k = $this->modelKeg->where(['id_kegiatan' => $keg])->first();
        $s = $this->modelSub->where(['id_sub' => $sub])->first();
        $fileSPJ = $request->getFile('file');
        $namaFile = $fileSPJ->getRandomName();
        $fileSPJ->move('uploads/spj', $namaFile);
        $this->modelSPJ->save([
            'nama_prog' => $p['nama_prog'],
            'nama_keg' => $k['nama_keg'],
            'nama_sub' => $s['nama_sub'],
            'file' => $namaFile,
            'id_user' => session()->get('id'),
            'pptk' => session()->get('nama'),
            'id_kegiatan' => $keg,
            'id_program' => $prog,
            'id_sub' => $sub
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/spj');
    }

    public function edit($id)
    {
        // dd($this->db->query("SELECT * FROM spj WHERE id_spj = '$id'")->getResultArray());
        $data = [
            'title' => 'Ubah Data SPJ', //Judul Halaman
            'animation' => '/dist/img/vz.png', //Logo Animasi
            'logo' => '/dist/img/logo.png', //Logo Navbar
            'copyright' => 'Kecamatan Jayanti', //Copyright Footer
            'validasi' => \Config\Services::validation(),
            'spj' => $this->db->query("SELECT * FROM spj WHERE id_spj = '$id'")->getResultArray(),
            'program' => $this->db->query("SELECT * FROM program")->getResultArray(),
            'kegiatan' => $this->db->query("SELECT * FROM kegiatan")->getResultArray(),
            'sub' => $this->db->query("SELECT * FROM subkegiatan")->getResultArray()
        ];

        return view('spj/edit', $data);
    }

    public function update($id)
    {
        $request = \Config\Services::request();
        if (!$this->validate([
            'file' => [
                'rules' => 'max_size[file,10024]|uploaded[file]|ext_in[pdf]',
                'errors' => [
                    'max_size' => 'Ukuran File tidak boleh lebih dari 10Mb.',
                    'uploaded' => '{field} SPJ harus diupload.',
                    'ext_in' => '{field} SPJ harus PDF.'
                ]
            ]

        ])) {

            return redirect()->to('/spj/edit/' . $request->getVar('slug'))->withInput();
        }

        $prog = $request->getVar('program');
        $keg = $request->getVar('kegiatan');
        $sub = $request->getVar('sub');
        $p = $this->modelProg->where(['id_program' => $prog])->first();
        $k = $this->modelKeg->where(['id_kegiatan' => $keg])->first();
        $s = $this->modelSub->where(['id_sub' => $sub])->first();
        $fileSPJ = $request->getFile('file');
        if ($fileSPJ->getError() == 4) {
            $namaFile = $request->getVar('fileLama');
        } else {
            $namaFile = $fileSPJ->getRandomName();
            $fileSPJ->move('uploads/spj', $namaFile);
            unlink('uploads/spj/' . $request->getVar('fileLama'));
        }
        $this->modelSub->save([
            'id_spj' => $id,
            'nama_prog' => $p['nama_prog'],
            'nama_keg' => $k['nama_keg'],
            'nama_sub' => $s['nama_sub'],
            'file' => $namaFile,
            'id_user' => session()->get('id'),
            'pptk' => session()->get('nama'),
            'id_kegiatan' => $keg,
            'id_program' => $prog,
            'id_sub' => $sub
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/spj');
    }

    public function delete($id)
    {
        $this->modelSPJ->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/spj');
    }
}
