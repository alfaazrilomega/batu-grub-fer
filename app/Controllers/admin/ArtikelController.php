<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ArtikelModel;

class ArtikelController extends BaseController
{
    protected $artikelModel;

    public function __construct()
    {
        $this->artikelModel = new ArtikelModel();
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

        $data['all_data_artikel'] = $this->artikelModel->findAll();
        $data['validation'] = \Config\Services::validation();
        
        return view('admin/artikel/index', $data);
    }

    public function tambah()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        $data['all_data_artikel'] = $this->artikelModel->findAll();
        $data['validation'] = \Config\Services::validation();
        
        return view('admin/artikel/tambah', $data);
    }

    public function proses_tambah()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        date_default_timezone_set('Asia/Jakarta');
        $judul_artikel = $this->request->getVar("judul_artikel_id");
        $snippet = $this->request->getVar("snippet_id");
        $deskripsi = $this->request->getVar("deskripsi_artikel_id");
        $alt = $this->request->getVar("alt_artikel_id");
        $title = $this->request->getVar("title_artikel_id");
        $meta_desc = $this->request->getVar("meta_desc_id");

        // Buat slug
        $slug = $this->generateSlug($judul_artikel);

        // Validasi judul artikel
        if (!preg_match('/^[a-zA-Z0-9\s]+$/', $judul_artikel)) {
            session()->setFlashdata('error', 'Judul artikel hanya boleh berisi huruf dan angka.');
            return redirect()->back()->withInput();
        }

        // Validasi file upload
        $file_foto = $this->request->getFile('foto_artikel');
        if (!$file_foto || !$file_foto->isValid()) {
            session()->setFlashdata('error', 'Foto artikel wajib diupload.');
            return redirect()->back()->withInput();
        }

        if (!$this->validate([
            'foto_artikel' => [
                'rules' => 'uploaded[foto_artikel]|is_image[foto_artikel]|max_dims[foto_artikel,572,572]|mime_in[foto_artikel,image/jpg,image/jpeg,image/png]|max_size[foto_artikel,2048]',
                'errors' => [
                    'uploaded' => 'Pilih foto terlebih dahulu',
                    'is_image' => 'File yang anda pilih bukan gambar',
                    'max_dims' => 'Maksimal ukuran gambar 572x572 pixels',
                    'mime_in' => 'File yang anda pilih wajib berekstensikan jpg/jpeg/png',
                    'max_size' => 'Ukuran file maksimal 2MB'
                ]
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        // Upload foto
        $currentDateTime = date('dmYHis');
        $newFileName = str_replace(' ', '-', "artikel_{$judul_artikel}_{$currentDateTime}.{$file_foto->getExtension()}");
        $file_foto->move('assets/img/artikel', $newFileName);

        // Simpan ke database
        $data = [
            'judul_artikel_id' => $judul_artikel,
            'slug_artikel_id' => $slug,
            'snippet_id' => $snippet,
            'deskripsi_artikel_id' => $deskripsi,
            'foto_artikel' => $newFileName,
            'alt_artikel_id' => $alt,
            'title_artikel_id' => $title,
            'meta_desc_id' => $meta_desc,
        ];

        $this->artikelModel->save($data);

        session()->setFlashdata('success', 'Data artikel berhasil disimpan');
        return redirect()->to(base_url('admin/artikel/index'));
    }

    public function edit($id_artikel)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        $data['artikelData'] = $this->artikelModel->find($id_artikel);
        if (!$data['artikelData']) {
            session()->setFlashdata('error', 'Data artikel tidak ditemukan.');
            return redirect()->to(base_url('admin/artikel/index'));
        }

        $data['validation'] = \Config\Services::validation();
        
        return view('admin/artikel/edit', $data);
    }

    public function proses_edit($id_artikel)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        // Periksa method request (seharusnya PUT)
        if ($this->request->getMethod() !== 'put') {
            session()->setFlashdata('error', 'Method request tidak valid.');
            return redirect()->to(base_url('admin/artikel/index'));
        }

        $artikelData = $this->artikelModel->find($id_artikel);
        if (!$artikelData) {
            session()->setFlashdata('error', 'Data artikel tidak ditemukan.');
            return redirect()->to(base_url('admin/artikel/index'));
        }

        $judul_artikel = $this->request->getVar("judul_artikel_id");
        $snippet = $this->request->getVar("snippet_id");
        $deskripsi = $this->request->getVar("deskripsi_artikel_id");
        $alt = $this->request->getVar("alt_artikel_id");
        $title = $this->request->getVar("title_artikel_id");
        $meta_desc = $this->request->getVar("meta_desc_id");

        // Buat slug
        $slug = $this->generateSlug($judul_artikel);

        // Validasi judul artikel
        if (!preg_match('/^[a-zA-Z0-9\s]+$/', $judul_artikel)) {
            session()->setFlashdata('error', 'Judul artikel hanya boleh berisi huruf dan angka.');
            return redirect()->back()->withInput();
        }

        $data = [
            'judul_artikel_id' => $judul_artikel,
            'slug_artikel_id' => $slug,
            'snippet_id' => $snippet,
            'deskripsi_artikel_id' => $deskripsi,
            'alt_artikel_id' => $alt,
            'title_artikel_id' => $title,
            'meta_desc_id' => $meta_desc,
        ];

        // Handle file upload jika ada
        $file_foto = $this->request->getFile('foto_artikel');
        if ($file_foto && $file_foto->isValid()) {
            // Validasi file
            if (!$this->validate([
                'foto_artikel' => [
                    'rules' => 'is_image[foto_artikel]|max_dims[foto_artikel,572,572]|mime_in[foto_artikel,image/jpg,image/jpeg,image/png]|max_size[foto_artikel,2048]',
                    'errors' => [
                        'is_image' => 'File yang anda pilih bukan gambar',
                        'max_dims' => 'Maksimal ukuran gambar 572x572 pixels',
                        'mime_in' => 'File yang anda pilih wajib berekstensikan jpg/jpeg/png',
                        'max_size' => 'Ukuran file maksimal 2MB'
                    ]
                ]
            ])) {
                session()->setFlashdata('error', $this->validator->listErrors());
                return redirect()->back()->withInput();
            }

            // Hapus file lama
            if (!empty($artikelData['foto_artikel']) && file_exists('assets/img/artikel/' . $artikelData['foto_artikel'])) {
                unlink('assets/img/artikel/' . $artikelData['foto_artikel']);
            }

            // Upload file baru
            $currentDateTime = date('dmYHis');
            $newFileName = str_replace(' ', '-', "artikel_{$judul_artikel}_{$currentDateTime}.{$file_foto->getExtension()}");
            $file_foto->move('assets/img/artikel', $newFileName);
            $data['foto_artikel'] = $newFileName;
        }

        $this->artikelModel->update($id_artikel, $data);

        session()->setFlashdata('success', 'Data artikel berhasil diperbarui');
        return redirect()->to(base_url('admin/artikel/index'));
    }

    public function delete($id)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        $artikelData = $this->artikelModel->find($id);
        if (!$artikelData) {
            session()->setFlashdata('error', 'Data artikel tidak ditemukan.');
            return redirect()->to(base_url('admin/artikel/index'));
        }

        // Hapus file foto
        if (!empty($artikelData['foto_artikel']) && file_exists('assets/img/artikel/' . $artikelData['foto_artikel'])) {
            unlink('assets/img/artikel/' . $artikelData['foto_artikel']);
        }

        $this->artikelModel->delete($id);

        session()->setFlashdata('success', 'Data artikel berhasil dihapus');
        return redirect()->to(base_url('admin/artikel/index'));
    }
}