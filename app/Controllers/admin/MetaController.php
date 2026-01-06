<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MetaModel;

class MetaController extends BaseController
{
    protected $metaModel;

    public function __construct()
    {
        $this->metaModel = new MetaModel();
    }

    private function generateSlug($string)
    {
        $slug = strtolower($string);
        $slug = preg_replace('/[^a-z0-9\s]/', '', $slug);
        $slug = preg_replace('/\s+/', '-', $slug);
        return $slug;
    }

    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        $data['all_data_meta'] = $this->metaModel->findAll();
        $data['validation'] = \Config\Services::validation();
        $data['title'] = 'Data Meta';
        
        return view('admin/meta/index', $data);
    }

    public function tambah()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        $data['validation'] = \Config\Services::validation();
        $data['title'] = 'Tambah Meta';
        
        return view('admin/meta/tambah', $data);
    }

    public function proses_tambah()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        // Set validation rules
        $validationRules = [
            'nama_halaman_id' => [
                'rules' => 'required|max_length[100]',
                'errors' => [
                    'required' => 'Nama halaman wajib diisi',
                    'max_length' => 'Nama halaman maksimal 100 karakter'
                ]
            ],
            'deskripsi_halaman_id' => [
                'rules' => 'max_length[500]',
                'errors' => [
                    'max_length' => 'Deskripsi halaman maksimal 500 karakter'
                ]
            ],
            'title_id' => [
                'rules' => 'max_length[59]',
                'errors' => [
                    'max_length' => 'Meta Title maksimal 59 karakter'
                ]
            ],
            'meta_desc_id' => [
                'rules' => 'max_length[159]',
                'errors' => [
                    'max_length' => 'Meta Description maksimal 159 karakter'
                ]
            ]
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput();
        }

        $nama_halaman = $this->request->getVar("nama_halaman_id");
        $deskripsi = $this->request->getVar("deskripsi_halaman_id");
        $title = $this->request->getVar("title_id");
        $meta_desc = $this->request->getVar("meta_desc_id");

        // Generate slug
        $slug = $this->generateSlug($nama_halaman);

        // Simpan ke database
        $data = [
            'nama_halaman_id' => $nama_halaman,
            'deskripsi_halaman_id' => $deskripsi,
            'slug_meta_id' => $slug,
            'title_id' => $title,
            'meta_desc_id' => $meta_desc,
        ];

        if ($this->metaModel->save($data)) {
            session()->setFlashdata('success', 'Data meta berhasil disimpan');
            return redirect()->to(base_url('admin/meta'));
        } else {
            session()->setFlashdata('error', 'Gagal menyimpan data meta');
            return redirect()->back()->withInput();
        }
    }

    public function edit($id_meta)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        $data['metaData'] = $this->metaModel->find($id_meta);
        if (!$data['metaData']) {
            session()->setFlashdata('error', 'Data meta tidak ditemukan.');
            return redirect()->to(base_url('admin/meta'));
        }

        $data['validation'] = \Config\Services::validation();
        $data['title'] = 'Edit Meta';
        
        return view('admin/meta/edit', $data);
    }

    public function proses_edit($id_meta)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        $metaData = $this->metaModel->find($id_meta);
        if (!$metaData) {
            session()->setFlashdata('error', 'Data meta tidak ditemukan.');
            return redirect()->to(base_url('admin/meta'));
        }

        // Set validation rules
        $validationRules = [
            'nama_halaman_id' => [
                'rules' => 'required|max_length[100]',
                'errors' => [
                    'required' => 'Nama halaman wajib diisi',
                    'max_length' => 'Nama halaman maksimal 100 karakter'
                ]
            ],
            'deskripsi_halaman_id' => [
                'rules' => 'max_length[500]',
                'errors' => [
                    'max_length' => 'Deskripsi halaman maksimal 500 karakter'
                ]
            ],
            'title_id' => [
                'rules' => 'max_length[59]',
                'errors' => [
                    'max_length' => 'Meta Title maksimal 59 karakter'
                ]
            ],
            'meta_desc_id' => [
                'rules' => 'max_length[159]',
                'errors' => [
                    'max_length' => 'Meta Description maksimal 159 karakter'
                ]
            ]
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput();
        }

        $nama_halaman = $this->request->getVar("nama_halaman_id");
        $deskripsi = $this->request->getVar("deskripsi_halaman_id");
        $title = $this->request->getVar("title_id");
        $meta_desc = $this->request->getVar("meta_desc_id");

        // Generate slug
        $slug = $this->generateSlug($nama_halaman);

        $data = [
            'nama_halaman_id' => $nama_halaman,
            'deskripsi_halaman_id' => $deskripsi,
            'slug_meta_id' => $slug,
            'title_id' => $title,
            'meta_desc_id' => $meta_desc,
        ];

        if ($this->metaModel->update($id_meta, $data)) {
            session()->setFlashdata('success', 'Data meta berhasil diperbarui');
            return redirect()->to(base_url('admin/meta'));
        } else {
            session()->setFlashdata('error', 'Gagal memperbarui data meta');
            return redirect()->back()->withInput();
        }
    }

    public function delete($id)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        $metaData = $this->metaModel->find($id);
        if (!$metaData) {
            session()->setFlashdata('error', 'Data meta tidak ditemukan.');
            return redirect()->to(base_url('admin/meta'));
        }

        if ($this->metaModel->delete($id)) {
            session()->setFlashdata('success', 'Data meta berhasil dihapus');
        } else {
            session()->setFlashdata('error', 'Gagal menghapus data meta');
        }
        
        return redirect()->to(base_url('admin/meta'));
    }
}