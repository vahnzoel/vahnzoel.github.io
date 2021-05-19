<?php

namespace App\Controllers;

use App\Models\SubModel;
use App\Models\ItemModel;

class Item extends BaseController
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
        $current_page = $request->getVar('page_item') ? $request->getVar('page_item') : 1;
        $no = 1 + (10 * ($current_page - 1));
        $keyword = $request->getVar('keyword');
        if ($keyword) {
            $item = $this->modelItem->search($keyword);
        } else {
            $item = $this->modelItem->getItem();
        }
        $data = [
            'title' => 'Daftar Item', //Judul Halaman
            'animation' => '/dist/img/vz.png', //Logo Animasi
            'logo' => '/dist/img/logo.png', //Logo Navbar
            'copyright' => 'Kecamatan Jayanti', //Copyright Footer
            'item' => $item->paginate(10),
            'pager' => $item->pager,
            'no' => $no
        ];

        echo view('item/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Form Tambah Item', //Judul Halaman
            'animation' => '/dist/img/vz.png', //Logo Animasi
            'logo' => '/dist/img/logo.png', //Logo Navbar
            'copyright' => 'Kecamatan Jayanti', //Copyright Footer
            'validasi' => \Config\Services::validation(),
            'sub' => $this->db->query("SELECT * FROM subkegiatan")->getResultArray()
        ];

        return view('item/create', $data);
    }

    public function save()
    {
        $request = \Config\Services::request();
        if (!$this->validate([
            'sub' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Item harus diisi.'
                ]
            ],
            'rek' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Item harus diisi.'
                ]
            ],
            'uraian' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Item harus diisi.'
                ]
            ],
            'anggaran' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => '{field} Item harus diisi.',
                    'numeric' => '{field} Item harus angka.'
                ]
            ],
            'sisa' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => '{field} Item harus diisi.',
                    'numeric' => '{field} Item harus angka.'
                ]
            ],
            'cair' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => '{field} Item harus diisi.',
                    'numeric' => '{field} Item harus angka.'
                ]
            ]

        ])) {

            return redirect()->to('/item/create')->withInput();
        }
        $sub = $request->getVar('sub');
        $s = $this->modelSub->where(['id_sub' => $sub])->first();
        $this->modelItem->save([
            'nama_sub' => $s['nama_sub'],
            'rek' => $request->getVar('rek'),
            'uraian' => $request->getVar('uraian'),
            'anggaran' => $request->getVar('anggaran'),
            'sisa' => $request->getVar('sisa'),
            'cair' => $request->getVar('cair'),
            'id_user' => session()->get('id'),
            'pptk' => session()->get('nama'),
            'id_sub' => $sub
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/item');
    }

    public function edit($item)
    {
        $data = [
            'title' => 'Form Ubah Data Item', //Judul Halaman
            'animation' => '/dist/img/vz.png', //Logo Animasi
            'logo' => '/dist/img/logo.png', //Logo Navbar
            'copyright' => 'Kecamatan Jayanti', //Copyright Footer
            'validasi' => \Config\Services::validation(),
            'item' => $this->modelItem->getItem($item),
            'sub' => $this->db->query("SELECT * FROM subkegiatan")->getResultArray()
        ];

        return view('item/edit', $data);
    }

    public function update($id)
    {
        $request = \Config\Services::request();
        if (!$this->validate([
            'sub' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Item harus diisi.'
                ]
            ],
            'rek' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Item harus diisi.'
                ]
            ],
            'uraian' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Item harus diisi.'
                ]
            ],
            'anggaran' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => '{field} Item harus diisi.',
                    'numeric' => '{field} Item harus angka.'
                ]
            ],
            'sisa' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => '{field} Item harus diisi.',
                    'numeric' => '{field} Item harus angka.'
                ]
            ],
            'cair' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => '{field} Item harus diisi.',
                    'numeric' => '{field} Item harus angka.'
                ]
            ]

        ])) {

            return redirect()->to('/item/edit/' . $request->getVar('id'))->withInput();
        }
        $sub = $request->getVar('sub');
        $s = $this->modelSub->where(['id_sub' => $sub])->first();
        $this->modelItem->save([
            'id_item' => $id,
            'nama_sub' => $s['nama_sub'],
            'rek' => $request->getVar('rek'),
            'uraian' => $request->getVar('uraian'),
            'anggaran' => $request->getVar('anggaran'),
            'sisa' => $request->getVar('sisa'),
            'cair' => $request->getVar('cair'),
            'id_sub' => $sub
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/item');
    }

    public function delete($id)
    {
        $this->modelItem->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/item');
    }
}
