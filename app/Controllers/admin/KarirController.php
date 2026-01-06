<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KarirModel;

class KarirController extends BaseController
{
    protected $karirModel;

    public function __construct()
    {
        $this->karirModel = new KarirModel();
    }

    public function generateSlug($string)
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

        $data['all_data_karir'] = $this->karirModel->findAll();
        $data['validation'] = \Config\Services::validation();
        
        return view('admin/karir/index', $data);
    }

    public function tambah()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        $data['all_data_karir'] = $this->karirModel->findAll();
        $data['validation'] = \Config\Services::validation();
        
        return view('admin/karir/tambah', $data);
    }

    public function proses_tambah()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        $judul_karir = $this->request->getVar("judul_karir_id");
        $deskripsi = $this->request->getVar("deskripsi_karir_id");
        $title = $this->request->getVar("title_karir_id");
        $meta_desc = $this->request->getVar("meta_desc_id");

        // Buat slug
        $slug = $this->generateSlug($judul_karir);

        // Validasi judul karir
        if (!preg_match('/^[a-zA-Z0-9\s]+$/', $judul_karir)) {
            session()->setFlashdata('error', 'Judul karir hanya boleh berisi huruf dan angka.');
            return redirect()->back()->withInput();
        }

        // Simpan ke database
        $data = [
            'judul_karir_id' => $judul_karir,
            'deskripsi_karir_id' => $deskripsi,
            'slug_karir_id' => $slug,
            'title_karir_id' => $title,
            'meta_desc_id' => $meta_desc,
        ];

        $this->karirModel->save($data);

        session()->setFlashdata('success', 'Data karir berhasil disimpan');
        return redirect()->to(base_url('admin/karir/index'));
    }

    public function edit($id_karir)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        $data['karirData'] = $this->karirModel->find($id_karir);
        if (!$data['karirData']) {
            session()->setFlashdata('error', 'Data karir tidak ditemukan.');
            return redirect()->to(base_url('admin/karir/index'));
        }

        $data['validation'] = \Config\Services::validation();
        
        return view('admin/karir/edit', $data);
    }

    public function proses_edit($id_karir)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        // Gunakan getPost() untuk PUT request
        if ($this->request->getMethod() === 'put') {
            $karirData = $this->karirModel->find($id_karir);
            if (!$karirData) {
                return $this->response->setJSON(['success' => false, 'message' => 'Data karir tidak ditemukan.']);
            }

            $judul_karir = $this->request->getPost("judul_karir_id");
            $deskripsi = $this->request->getPost("deskripsi_karir_id");
            $title = $this->request->getPost("title_karir_id");
            $meta_desc = $this->request->getPost("meta_desc_id");

            // Buat slug
            $slug = $this->generateSlug($judul_karir);

            // Validasi judul karir
            if (!preg_match('/^[a-zA-Z0-9\s]+$/', $judul_karir)) {
                return $this->response->setJSON(['success' => false, 'message' => 'Judul karir hanya boleh berisi huruf dan angka.']);
            }

            $data = [
                'judul_karir_id' => $judul_karir,
                'deskripsi_karir_id' => $deskripsi,
                'slug_karir_id' => $slug,
                'title_karir_id' => $title,
                'meta_desc_id' => $meta_desc,
            ];

            $this->karirModel->update($id_karir, $data);

            session()->setFlashdata('success', 'Data karir berhasil diperbarui');
            return $this->response->setJSON(['success' => true, 'redirect' => base_url('admin/karir/index')]);
        }
        
        // Fallback untuk POST request
        $karirData = $this->karirModel->find($id_karir);
        if (!$karirData) {
            session()->setFlashdata('error', 'Data karir tidak ditemukan.');
            return redirect()->to(base_url('admin/karir/index'));
        }

        $judul_karir = $this->request->getVar("judul_karir_id");
        $deskripsi = $this->request->getVar("deskripsi_karir_id");
        $title = $this->request->getVar("title_karir_id");
        $meta_desc = $this->request->getVar("meta_desc_id");

        // Buat slug
        $slug = $this->generateSlug($judul_karir);

        // Validasi judul karir
        if (!preg_match('/^[a-zA-Z0-9\s]+$/', $judul_karir)) {
            session()->setFlashdata('error', 'Judul karir hanya boleh berisi huruf dan angka.');
            return redirect()->back()->withInput();
        }

        $data = [
            'judul_karir_id' => $judul_karir,
            'deskripsi_karir_id' => $deskripsi,
            'slug_karir_id' => $slug,
            'title_karir_id' => $title,
            'meta_desc_id' => $meta_desc,
        ];

        $this->karirModel->update($id_karir, $data);

        session()->setFlashdata('success', 'Data karir berhasil diperbarui');
        return redirect()->to(base_url('admin/karir/index'));
    }

    public function delete($id)
    {
        if (!session()->get('logged_in')) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
            }
            return redirect()->to(base_url('login'));
        }

        $karirData = $this->karirModel->find($id);
        if (!$karirData) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON(['success' => false, 'message' => 'Data karir tidak ditemukan.']);
            }
            session()->setFlashdata('error', 'Data karir tidak ditemukan.');
            return redirect()->to(base_url('admin/karir/index'));
        }

        $this->karirModel->delete($id);

        if ($this->request->isAJAX()) {
            return $this->response->setJSON(['success' => true, 'message' => 'Data karir berhasil dihapus']);
        }
        
        session()->setFlashdata('success', 'Data karir berhasil dihapus');
        return redirect()->to(base_url('admin/karir/index'));
    }
}