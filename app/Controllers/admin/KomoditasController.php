<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KomoditasModel;

class KomoditasController extends BaseController
{
    protected $komoditasModel;

    public function __construct()
    {
        $this->komoditasModel = new KomoditasModel();
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

        $data['all_data_komoditas'] = $this->komoditasModel->findAll();
        $data['validation'] = \Config\Services::validation();
        
        return view('admin/komoditas/index', $data);
    }

    public function tambah()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        $data['all_data_komoditas'] = $this->komoditasModel->findAll();
        $data['validation'] = \Config\Services::validation();
        
        return view('admin/komoditas/tambah', $data);
    }

    public function proses_tambah()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        date_default_timezone_set('Asia/Jakarta');
        $nama_komoditas = $this->request->getVar("nama_komoditas_id");
        $deskripsi = $this->request->getVar("deskripsi_komoditas_id");
        $alt = $this->request->getVar("alt_komoditas_id");
        $title = $this->request->getVar("title_id");
        $meta_desc = $this->request->getVar("meta_desc_id");

        // Buat slug
        $slug = $this->generateSlug($nama_komoditas);

        // Validasi nama komoditas
        if (!preg_match('/^[a-zA-Z0-9\s]+$/', $nama_komoditas)) {
            session()->setFlashdata('error', 'Nama komoditas hanya boleh berisi huruf dan angka.');
            return redirect()->back()->withInput();
        }

        // Validasi file upload
        $file_foto = $this->request->getFile('foto_komoditas');
        if (!$file_foto || !$file_foto->isValid()) {
            session()->setFlashdata('error', 'Foto komoditas wajib diupload.');
            return redirect()->back()->withInput();
        }

        if (!$this->validate([
            'foto_komoditas' => [
                'rules' => 'uploaded[foto_komoditas]|is_image[foto_komoditas]|mime_in[foto_komoditas,image/jpg,image/jpeg,image/png]|max_size[foto_komoditas,2048]',
                'errors' => [
                    'uploaded' => 'Pilih foto terlebih dahulu',
                    'is_image' => 'File yang anda pilih bukan gambar',
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
        $newFileName = str_replace(' ', '-', "komoditas_{$nama_komoditas}_{$currentDateTime}.{$file_foto->getExtension()}");
        $file_foto->move('assets/img/komoditas', $newFileName);

        // Simpan ke database
        $data = [
            'nama_komoditas_id' => $nama_komoditas,
            'deskripsi_komoditas_id' => $deskripsi,
            'foto_komoditas' => $newFileName,
            'alt_komoditas_id' => $alt,
            'title_id' => $title,
            'meta_desc_id' => $meta_desc,
            'slug_id' => $slug,
        ];

        $this->komoditasModel->save($data);

        session()->setFlashdata('success', 'Data komoditas berhasil disimpan');
        return redirect()->to(base_url('admin/komoditas/index'));
    }

    public function edit($id_komoditas)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        $data['komoditasData'] = $this->komoditasModel->find($id_komoditas);
        if (!$data['komoditasData']) {
            session()->setFlashdata('error', 'Data komoditas tidak ditemukan.');
            return redirect()->to(base_url('admin/komoditas/index'));
        }

        $data['validation'] = \Config\Services::validation();
        
        return view('admin/komoditas/edit', $data);
    }

    public function proses_edit($id_komoditas)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        $komoditasData = $this->komoditasModel->find($id_komoditas);
        if (!$komoditasData) {
            session()->setFlashdata('error', 'Data komoditas tidak ditemukan.');
            return redirect()->to(base_url('admin/komoditas/index'));
        }

        $nama_komoditas = $this->request->getVar("nama_komoditas_id");
        $deskripsi = $this->request->getVar("deskripsi_komoditas_id");
        $alt = $this->request->getVar("alt_komoditas_id");
        $title = $this->request->getVar("title_id");
        $meta_desc = $this->request->getVar("meta_desc_id");

        // Buat slug
        $slug = $this->generateSlug($nama_komoditas);

        // Validasi nama komoditas
        if (!preg_match('/^[a-zA-Z0-9\s]+$/', $nama_komoditas)) {
            session()->setFlashdata('error', 'Nama komoditas hanya boleh berisi huruf dan angka.');
            return redirect()->back()->withInput();
        }

        $data = [
            'nama_komoditas_id' => $nama_komoditas,
            'deskripsi_komoditas_id' => $deskripsi,
            'alt_komoditas_id' => $alt,
            'title_id' => $title,
            'meta_desc_id' => $meta_desc,
            'slug_id' => $slug,
        ];

        // Handle file upload jika ada
        $file_foto = $this->request->getFile('foto_komoditas');
        if ($file_foto && $file_foto->isValid()) {
            // Validasi file
            if (!$this->validate([
                'foto_komoditas' => [
                    'rules' => 'is_image[foto_komoditas]|mime_in[foto_komoditas,image/jpg,image/jpeg,image/png]|max_size[foto_komoditas,2048]',
                    'errors' => [
                        'is_image' => 'File yang anda pilih bukan gambar',
                        'mime_in' => 'File yang anda pilih wajib berekstensikan jpg/jpeg/png',
                        'max_size' => 'Ukuran file maksimal 2MB'
                    ]
                ]
            ])) {
                session()->setFlashdata('error', $this->validator->listErrors());
                return redirect()->back()->withInput();
            }

            // Hapus file lama
            if (!empty($komoditasData['foto_komoditas']) && file_exists('assets/img/komoditas/' . $komoditasData['foto_komoditas'])) {
                unlink('assets/img/komoditas/' . $komoditasData['foto_komoditas']);
            }

            // Upload file baru
            $currentDateTime = date('dmYHis');
            $newFileName = str_replace(' ', '-', "komoditas_{$nama_komoditas}_{$currentDateTime}.{$file_foto->getExtension()}");
            $file_foto->move('assets/img/komoditas', $newFileName);
            $data['foto_komoditas'] = $newFileName;
        }

        $this->komoditasModel->update($id_komoditas, $data);

        session()->setFlashdata('success', 'Data komoditas berhasil diperbarui');
        return redirect()->to(base_url('admin/komoditas/index'));
    }

    public function delete($id)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        $komoditasData = $this->komoditasModel->find($id);
        if (!$komoditasData) {
            session()->setFlashdata('error', 'Data komoditas tidak ditemukan.');
            return redirect()->to(base_url('admin/komoditas/index'));
        }

        // Hapus file foto
        if (!empty($komoditasData['foto_komoditas']) && file_exists('assets/img/komoditas/' . $komoditasData['foto_komoditas'])) {
            unlink('assets/img/komoditas/' . $komoditasData['foto_komoditas']);
        }

        $this->komoditasModel->delete($id);

        session()->setFlashdata('success', 'Data komoditas berhasil dihapus');
        return redirect()->to(base_url('admin/komoditas/index'));
    }
}