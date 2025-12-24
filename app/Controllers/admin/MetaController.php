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

    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        $data['all_data_meta'] = $this->metaModel->findAll();
        $data['validation'] = \Config\Services::validation();
        
        return view('admin/meta/index', $data);
    }

    public function tambah()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        $data['all_data_meta'] = $this->metaModel->findAll();
        $data['validation'] = \Config\Services::validation();
        
        return view('admin/meta/tambah', $data);
    }

    public function proses_tambah()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        $nama_halaman = $this->request->getVar("nama_halaman_id");
        $deskripsi = $this->request->getVar("deskripsi_halaman_id");
        $title = $this->request->getVar("title_id");
        $meta_desc = $this->request->getVar("meta_desc_id");

        // Simpan ke database
        $data = [
            'nama_halaman_id' => $nama_halaman,
            'deskripsi_halaman_id' => $deskripsi,
            'title_id' => $title,
            'meta_desc_id' => $meta_desc,
        ];

        $this->metaModel->save($data);

        session()->setFlashdata('success', 'Data meta berhasil disimpan');
        return redirect()->to(base_url('admin/meta/index'));
    }

    public function edit($id_meta)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        $data['metaData'] = $this->metaModel->find($id_meta);
        if (!$data['metaData']) {
            session()->setFlashdata('error', 'Data meta tidak ditemukan.');
            return redirect()->to(base_url('admin/meta/index'));
        }

        $data['validation'] = \Config\Services::validation();
        
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
            return redirect()->to(base_url('admin/meta/index'));
        }

        $nama_halaman = $this->request->getVar("nama_halaman_id");
        $deskripsi = $this->request->getVar("deskripsi_halaman_id");
        $title = $this->request->getVar("title_id");
        $meta_desc = $this->request->getVar("meta_desc_id");

        $data = [
            'nama_halaman_id' => $nama_halaman,
            'deskripsi_halaman_id' => $deskripsi,
            'title_id' => $title,
            'meta_desc_id' => $meta_desc,
        ];

        $this->metaModel->update($id_meta, $data);

        session()->setFlashdata('success', 'Data meta berhasil diperbarui');
        return redirect()->to(base_url('admin/meta/index'));
    }

    public function delete($id)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        $metaData = $this->metaModel->find($id);
        if (!$metaData) {
            session()->setFlashdata('error', 'Data meta tidak ditemukan.');
            return redirect()->to(base_url('admin/meta/index'));
        }

        $this->metaModel->delete($id);

        session()->setFlashdata('success', 'Data meta berhasil dihapus');
        return redirect()->to(base_url('admin/meta/index'));
    }
}