<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\LowonganModel;

class LowonganController extends BaseController
{
    protected $lowonganModel;

    public function __construct()
    {
        $this->lowonganModel = new LowonganModel();
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

        $data['all_data_lowongan'] = $this->lowonganModel->findAll();
        $data['validation'] = \Config\Services::validation();
        
        return view('admin/lowongan/index', $data);
    }

    public function tambah()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        $data['all_data_lowongan'] = $this->lowonganModel->findAll();
        $data['validation'] = \Config\Services::validation();
        
        return view('admin/lowongan/tambah', $data);
    }

    public function proses_tambah()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        date_default_timezone_set('Asia/Jakarta');
        $nama_lowongan = $this->request->getVar("nama_lowongan_id");
        $deskripsi = $this->request->getVar("deskripsi_lowongan_id");
        $kualifikasi = $this->request->getVar("kualifikasi_lowongan_id");
        $tawaran = $this->request->getVar("tawaran_lowongan_id");
        $status = $this->request->getVar("status_lowongan");
        $title = $this->request->getVar("title_lowongan_id");
        $meta_desc = $this->request->getVar("meta_desc_id");

        // Buat slug
        $slug = $this->generateSlug($nama_lowongan);

        // Validasi nama lowongan
        if (!preg_match('/^[a-zA-Z0-9\s]+$/', $nama_lowongan)) {
            session()->setFlashdata('error', 'Nama lowongan hanya boleh berisi huruf dan angka.');
            return redirect()->back()->withInput();
        }

        // Handle file upload
        $file_poster = $this->request->getFile('poster_lowongan');
        $posterFileName = null;

        if ($file_poster && $file_poster->isValid()) {
            if (!$this->validate([
                'poster_lowongan' => [
                    'rules' => 'is_image[poster_lowongan]|mime_in[poster_lowongan,image/jpg,image/jpeg,image/png]|max_size[poster_lowongan,2048]',
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

            $currentDateTime = date('dmYHis');
            $posterFileName = str_replace(' ', '-', "lowongan_{$nama_lowongan}_{$currentDateTime}.{$file_poster->getExtension()}");
            $file_poster->move('assets/img/lowongan', $posterFileName);
        }

        // Simpan ke database
        $data = [
            'nama_lowongan_id' => $nama_lowongan,
            'poster_lowongan' => $posterFileName,
            'deskripsi_lowongan_id' => $deskripsi,
            'status_lowongan' => $status,
            'kualifikasi_lowongan_id' => $kualifikasi,
            'tawaran_lowongan_id' => $tawaran,
            'slug_lowongan_id' => $slug,
            'title_lowongan_id' => $title,
            'meta_desc_id' => $meta_desc,
        ];

        $this->lowonganModel->save($data);

        session()->setFlashdata('success', 'Data lowongan berhasil disimpan');
        return redirect()->to(base_url('admin/lowongan/index'));
    }

    public function edit($id_lowongan)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        $data['lowonganData'] = $this->lowonganModel->find($id_lowongan);
        if (!$data['lowonganData']) {
            session()->setFlashdata('error', 'Data lowongan tidak ditemukan.');
            return redirect()->to(base_url('admin/lowongan/index'));
        }

        $data['validation'] = \Config\Services::validation();
        
        return view('admin/lowongan/edit', $data);
    }

    public function proses_edit($id_lowongan)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        $lowonganData = $this->lowonganModel->find($id_lowongan);
        if (!$lowonganData) {
            session()->setFlashdata('error', 'Data lowongan tidak ditemukan.');
            return redirect()->to(base_url('admin/lowongan/index'));
        }

        $nama_lowongan = $this->request->getVar("nama_lowongan_id");
        $deskripsi = $this->request->getVar("deskripsi_lowongan_id");
        $kualifikasi = $this->request->getVar("kualifikasi_lowongan_id");
        $tawaran = $this->request->getVar("tawaran_lowongan_id");
        $status = $this->request->getVar("status_lowongan");
        $title = $this->request->getVar("title_lowongan_id");
        $meta_desc = $this->request->getVar("meta_desc_id");

        // Buat slug
        $slug = $this->generateSlug($nama_lowongan);

        // Validasi nama lowongan
        if (!preg_match('/^[a-zA-Z0-9\s]+$/', $nama_lowongan)) {
            session()->setFlashdata('error', 'Nama lowongan hanya boleh berisi huruf dan angka.');
            return redirect()->back()->withInput();
        }

        $data = [
            'nama_lowongan_id' => $nama_lowongan,
            'deskripsi_lowongan_id' => $deskripsi,
            'status_lowongan' => $status,
            'kualifikasi_lowongan_id' => $kualifikasi,
            'tawaran_lowongan_id' => $tawaran,
            'slug_lowongan_id' => $slug,
            'title_lowongan_id' => $title,
            'meta_desc_id' => $meta_desc,
        ];

        // Handle file upload jika ada
        $file_poster = $this->request->getFile('poster_lowongan');
        if ($file_poster && $file_poster->isValid()) {
            // Validasi file
            if (!$this->validate([
                'poster_lowongan' => [
                    'rules' => 'is_image[poster_lowongan]|mime_in[poster_lowongan,image/jpg,image/jpeg,image/png]|max_size[poster_lowongan,2048]',
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
            if (!empty($lowonganData['poster_lowongan']) && file_exists('assets/img/lowongan/' . $lowonganData['poster_lowongan'])) {
                unlink('assets/img/lowongan/' . $lowonganData['poster_lowongan']);
            }

            // Upload file baru
            $currentDateTime = date('dmYHis');
            $posterFileName = str_replace(' ', '-', "lowongan_{$nama_lowongan}_{$currentDateTime}.{$file_poster->getExtension()}");
            $file_poster->move('assets/img/lowongan', $posterFileName);
            $data['poster_lowongan'] = $posterFileName;
        }

        $this->lowonganModel->update($id_lowongan, $data);

        session()->setFlashdata('success', 'Data lowongan berhasil diperbarui');
        return redirect()->to(base_url('admin/lowongan/index'));
    }

    public function delete($id)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        $lowonganData = $this->lowonganModel->find($id);
        if (!$lowonganData) {
            session()->setFlashdata('error', 'Data lowongan tidak ditemukan.');
            return redirect()->to(base_url('admin/lowongan/index'));
        }

        // Hapus file poster
        if (!empty($lowonganData['poster_lowongan']) && file_exists('assets/img/lowongan/' . $lowonganData['poster_lowongan'])) {
            unlink('assets/img/lowongan/' . $lowonganData['poster_lowongan']);
        }

        $this->lowonganModel->delete($id);

        session()->setFlashdata('success', 'Data lowongan berhasil dihapus');
        return redirect()->to(base_url('admin/lowongan/index'));
    }
}