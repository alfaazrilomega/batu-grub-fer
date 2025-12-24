<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TentangModel;

class TentangController extends BaseController
{
    protected $tentangModel;

    public function __construct()
    {
        $this->tentangModel = new TentangModel();
    }

    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        $data['tentangData'] = $this->tentangModel->first();
        if (!$data['tentangData']) {
            // Jika belum ada data, buat data kosong
            $data['tentangData'] = [
                'id_tentang' => '',
                'nama_perusahaan' => '',
                'deskripsi_tentang_id' => '',
                'snippet_id' => '',
                'visi_id' => '',
                'misi_id' => '',
                'link_youtube' => '',
                'slug_tentang_id' => '',
                'title_tentang_id' => '',
                'meta_desc_id' => ''
            ];
        }

        $data['validation'] = \Config\Services::validation();
        
        return view('admin/tentang/index', $data);
    }

    public function proses_edit($id_tentang = null)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        $nama_perusahaan = $this->request->getVar("nama_perusahaan");
        $deskripsi = $this->request->getVar("deskripsi_tentang_id");
        $snippet = $this->request->getVar("snippet_id");
        $visi = $this->request->getVar("visi_id");
        $misi = $this->request->getVar("misi_id");
        $link_youtube = $this->request->getVar("link_youtube");
        $title = $this->request->getVar("title_tentang_id");
        $meta_desc = $this->request->getVar("meta_desc_id");

        // Buat slug
        $slug = strtolower($nama_perusahaan);
        $slug = preg_replace('/[^a-z0-9\s]/', '', $slug);
        $slug = preg_replace('/\s+/', '-', $slug);

        $data = [
            'nama_perusahaan' => $nama_perusahaan,
            'deskripsi_tentang_id' => $deskripsi,
            'snippet_id' => $snippet,
            'visi_id' => $visi,
            'misi_id' => $misi,
            'link_youtube' => $link_youtube,
            'slug_tentang_id' => $slug,
            'title_tentang_id' => $title,
            'meta_desc_id' => $meta_desc,
        ];

        // Handle file upload untuk logo
        $file_logo = $this->request->getFile('logo');
        if ($file_logo && $file_logo->isValid()) {
            // Validasi file
            if (!$this->validate([
                'logo' => [
                    'rules' => 'is_image[logo]|mime_in[logo,image/jpg,image/jpeg,image/png]|max_size[logo,2048]',
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

            if ($id_tentang) {
                $tentangData = $this->tentangModel->find($id_tentang);
                // Hapus file lama
                if (!empty($tentangData['logo']) && file_exists('assets/img/tentang/' . $tentangData['logo'])) {
                    unlink('assets/img/tentang/' . $tentangData['logo']);
                }
            }

            // Upload file baru
            $currentDateTime = date('dmYHis');
            $newFileName = str_replace(' ', '-', "logo_{$nama_perusahaan}_{$currentDateTime}.{$file_logo->getExtension()}");
            $file_logo->move('assets/img/tentang', $newFileName);
            $data['logo'] = $newFileName;
        }

        // Handle file upload untuk favicon
        $file_favicon = $this->request->getFile('favicon');
        if ($file_favicon && $file_favicon->isValid()) {
            // Validasi file
            if (!$this->validate([
                'favicon' => [
                    'rules' => 'is_image[favicon]|mime_in[favicon,image/jpg,image/jpeg,image/png,image/x-icon,image/vnd.microsoft.icon]|max_size[favicon,1024]',
                    'errors' => [
                        'is_image' => 'File yang anda pilih bukan gambar',
                        'mime_in' => 'File yang anda pilih wajib berekstensikan jpg/jpeg/png/ico',
                        'max_size' => 'Ukuran file maksimal 1MB'
                    ]
                ]
            ])) {
                session()->setFlashdata('error', $this->validator->listErrors());
                return redirect()->back()->withInput();
            }

            if ($id_tentang) {
                $tentangData = $this->tentangModel->find($id_tentang);
                // Hapus file lama
                if (!empty($tentangData['favicon']) && file_exists('assets/img/tentang/' . $tentangData['favicon'])) {
                    unlink('assets/img/tentang/' . $tentangData['favicon']);
                }
            }

            // Upload file baru
            $currentDateTime = date('dmYHis');
            $newFileName = str_replace(' ', '-', "favicon_{$nama_perusahaan}_{$currentDateTime}.{$file_favicon->getExtension()}");
            $file_favicon->move('assets/img/tentang', $newFileName);
            $data['favicon'] = $newFileName;
        }

        // Handle file upload untuk struktur organisasi
        $file_struktur = $this->request->getFile('struktur_organisasi');
        if ($file_struktur && $file_struktur->isValid()) {
            // Validasi file
            if (!$this->validate([
                'struktur_organisasi' => [
                    'rules' => 'is_image[struktur_organisasi]|mime_in[struktur_organisasi,image/jpg,image/jpeg,image/png]|max_size[struktur_organisasi,2048]',
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

            if ($id_tentang) {
                $tentangData = $this->tentangModel->find($id_tentang);
                // Hapus file lama
                if (!empty($tentangData['struktur_organisasi']) && file_exists('assets/img/tentang/' . $tentangData['struktur_organisasi'])) {
                    unlink('assets/img/tentang/' . $tentangData['struktur_organisasi']);
                }
            }

            // Upload file baru
            $currentDateTime = date('dmYHis');
            $newFileName = str_replace(' ', '-', "struktur_{$nama_perusahaan}_{$currentDateTime}.{$file_struktur->getExtension()}");
            $file_struktur->move('assets/img/tentang', $newFileName);
            $data['struktur_organisasi'] = $newFileName;
        }

        if ($id_tentang) {
            // Update data yang sudah ada
            $this->tentangModel->update($id_tentang, $data);
        } else {
            // Insert data baru
            $this->tentangModel->insert($data);
        }

        session()->setFlashdata('success', 'Data tentang berhasil disimpan');
        return redirect()->to(base_url('admin/tentang/index'));
    }
}