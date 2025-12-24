<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AnggotaModel;

class AnggotaController extends BaseController
{
    protected $anggotaModel;

    public function __construct()
    {
        $this->anggotaModel = new AnggotaModel();
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

        $data['all_data_anggota'] = $this->anggotaModel->findAll();
        $data['validation'] = \Config\Services::validation();
        
        return view('admin/anggota/index', $data);
    }

    public function tambah()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        $data['all_data_anggota'] = $this->anggotaModel->findAll();
        $data['validation'] = \Config\Services::validation();
        
        return view('admin/anggota/tambah', $data);
    }

    public function proses_tambah()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        date_default_timezone_set('Asia/Jakarta');
        $nama_perusahaan = $this->request->getVar("nama_perusahaan_anggota");
        $deskripsi = $this->request->getVar("deskripsi_anggota_id");
        $title = $this->request->getVar("title_anggota_id");
        $meta_desc = $this->request->getVar("meta_desc_id");

        // Buat slug
        $slug = $this->generateSlug($nama_perusahaan);

        // Validasi nama perusahaan
        if (!preg_match('/^[a-zA-Z0-9\s]+$/', $nama_perusahaan)) {
            session()->setFlashdata('error', 'Nama perusahaan hanya boleh berisi huruf dan angka.');
            return redirect()->back()->withInput();
        }

        // Validasi file upload
        $file_logo = $this->request->getFile('logo_anggota');
        if (!$file_logo || !$file_logo->isValid()) {
            session()->setFlashdata('error', 'Logo perusahaan wajib diupload.');
            return redirect()->back()->withInput();
        }

        if (!$this->validate([
            'logo_anggota' => [
                'rules' => 'uploaded[logo_anggota]|is_image[logo_anggota]|mime_in[logo_anggota,image/jpg,image/jpeg,image/png]|max_size[logo_anggota,2048]',
                'errors' => [
                    'uploaded' => 'Pilih logo terlebih dahulu',
                    'is_image' => 'File yang anda pilih bukan gambar',
                    'mime_in' => 'File yang anda pilih wajib berekstensikan jpg/jpeg/png',
                    'max_size' => 'Ukuran file maksimal 2MB'
                ]
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        // Upload logo
        $currentDateTime = date('dmYHis');
        $newFileName = str_replace(' ', '-', "anggota_{$nama_perusahaan}_{$currentDateTime}.{$file_logo->getExtension()}");
        $file_logo->move('assets/img/anggota', $newFileName);

        // Simpan ke database
        $data = [
            'nama_perusahaan_anggota' => $nama_perusahaan,
            'deskripsi_anggota_id' => $deskripsi,
            'logo_anggota' => $newFileName,
            'title_anggota_id' => $title,
            'slug_anggota_id' => $slug,
            'meta_desc_id' => $meta_desc,
        ];

        $this->anggotaModel->save($data);

        session()->setFlashdata('success', 'Data anggota berhasil disimpan');
        return redirect()->to(base_url('admin/anggota/index'));
    }

    public function edit($id_anggota)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        $data['anggotaData'] = $this->anggotaModel->find($id_anggota);
        if (!$data['anggotaData']) {
            session()->setFlashdata('error', 'Data anggota tidak ditemukan.');
            return redirect()->to(base_url('admin/anggota/index'));
        }

        $data['validation'] = \Config\Services::validation();
        
        return view('admin/anggota/edit', $data);
    }

    public function proses_edit($id_anggota)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        $anggotaData = $this->anggotaModel->find($id_anggota);
        if (!$anggotaData) {
            session()->setFlashdata('error', 'Data anggota tidak ditemukan.');
            return redirect()->to(base_url('admin/anggota/index'));
        }

        $nama_perusahaan = $this->request->getVar("nama_perusahaan_anggota");
        $deskripsi = $this->request->getVar("deskripsi_anggota_id");
        $title = $this->request->getVar("title_anggota_id");
        $meta_desc = $this->request->getVar("meta_desc_id");

        // Buat slug
        $slug = $this->generateSlug($nama_perusahaan);

        // Validasi nama perusahaan
        if (!preg_match('/^[a-zA-Z0-9\s]+$/', $nama_perusahaan)) {
            session()->setFlashdata('error', 'Nama perusahaan hanya boleh berisi huruf dan angka.');
            return redirect()->back()->withInput();
        }

        $data = [
            'nama_perusahaan_anggota' => $nama_perusahaan,
            'deskripsi_anggota_id' => $deskripsi,
            'title_anggota_id' => $title,
            'slug_anggota_id' => $slug,
            'meta_desc_id' => $meta_desc,
        ];

        // Handle file upload jika ada
        $file_logo = $this->request->getFile('logo_anggota');
        if ($file_logo && $file_logo->isValid()) {
            // Validasi file
            if (!$this->validate([
                'logo_anggota' => [
                    'rules' => 'is_image[logo_anggota]|mime_in[logo_anggota,image/jpg,image/jpeg,image/png]|max_size[logo_anggota,2048]',
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
            if (!empty($anggotaData['logo_anggota']) && file_exists('assets/img/anggota/' . $anggotaData['logo_anggota'])) {
                unlink('assets/img/anggota/' . $anggotaData['logo_anggota']);
            }

            // Upload file baru
            $currentDateTime = date('dmYHis');
            $newFileName = str_replace(' ', '-', "anggota_{$nama_perusahaan}_{$currentDateTime}.{$file_logo->getExtension()}");
            $file_logo->move('assets/img/anggota', $newFileName);
            $data['logo_anggota'] = $newFileName;
        }

        $this->anggotaModel->update($id_anggota, $data);

        session()->setFlashdata('success', 'Data anggota berhasil diperbarui');
        return redirect()->to(base_url('admin/anggota/index'));
    }

    public function delete($id)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        $anggotaData = $this->anggotaModel->find($id);
        if (!$anggotaData) {
            session()->setFlashdata('error', 'Data anggota tidak ditemukan.');
            return redirect()->to(base_url('admin/anggota/index'));
        }

        // Hapus file logo
        if (!empty($anggotaData['logo_anggota']) && file_exists('assets/img/anggota/' . $anggotaData['logo_anggota'])) {
            unlink('assets/img/anggota/' . $anggotaData['logo_anggota']);
        }

        $this->anggotaModel->delete($id);

        session()->setFlashdata('success', 'Data anggota berhasil dihapus');
        return redirect()->to(base_url('admin/anggota/index'));
    }
}