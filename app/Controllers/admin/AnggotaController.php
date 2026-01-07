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

        $data = [
            'title' => 'Data Anggota',
            'all_data_anggota' => $this->anggotaModel->findAll(),
            'validation' => \Config\Services::validation(),
        ];
        
        return view('admin/anggota/index', $data);
    }

    public function tambah()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        $data = [
            'title' => 'Tambah Anggota',
            'validation' => \Config\Services::validation(),
        ];
        
        return view('admin/anggota/tambah', $data);
    }

    public function proses_tambah()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        // Set validation rules
        $validationRules = [
            'nama_perusahaan_anggota' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama perusahaan wajib diisi'
                ]
            ],
            'logo_anggota' => [
                'rules' => 'uploaded[logo_anggota]|is_image[logo_anggota]|mime_in[logo_anggota,image/jpg,image/jpeg,image/png]|max_size[logo_anggota,2048]',
                'errors' => [
                    'uploaded' => 'Logo anggota wajib diupload',
                    'is_image' => 'File yang anda pilih bukan gambar',
                    'mime_in' => 'File harus berekstensi JPG, JPEG, atau PNG',
                    'max_size' => 'Ukuran file maksimal 2MB'
                ]
            ],
            'image_anggota' => [
                'rules' => 'uploaded[image_anggota]|is_image[image_anggota]|mime_in[image_anggota,image/jpg,image/jpeg,image/png]|max_size[image_anggota,2048]',
                'errors' => [
                    'uploaded' => 'Gambar anggota wajib diupload',
                    'is_image' => 'File yang anda pilih bukan gambar',
                    'mime_in' => 'File harus berekstensi JPG, JPEG, atau PNG',
                    'max_size' => 'Ukuran file maksimal 2MB'
                ]
            ],
            'title_anggota_id' => [
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

        $nama_perusahaan = $this->request->getPost("nama_perusahaan_anggota");
        $deskripsi = $this->request->getPost("deskripsi_anggota_id");
        $title = $this->request->getPost("title_anggota_id");
        $meta_desc = $this->request->getPost("meta_desc_id");

        // Buat slug
        $slug = $this->generateSlug($nama_perusahaan);

        // Handle logo upload
        $file_logo = $this->request->getFile('logo_anggota');
        $currentDateTime = date('dmYHis');
        $newLogoName = str_replace(' ', '-', "logo_{$nama_perusahaan}_{$currentDateTime}.{$file_logo->getExtension()}");
        $file_logo->move('assets/img/anggota', $newLogoName);

        // Handle image upload
        $file_image = $this->request->getFile('image_anggota');
        $newImageName = str_replace(' ', '-', "image_{$nama_perusahaan}_{$currentDateTime}.{$file_image->getExtension()}");
        $file_image->move('assets/img/anggota', $newImageName);

        // Simpan ke database
        $data = [
            'nama_perusahaan_anggota' => $nama_perusahaan,
            'deskripsi_anggota_id' => $deskripsi,
            'logo_anggota' => $newLogoName,
            'image_anggota' => $newImageName,
            'title_anggota_id' => $title,
            'meta_desc_id' => $meta_desc,
            'slug_anggota_id' => $slug,
        ];

        if ($this->anggotaModel->save($data)) {
            session()->setFlashdata('success', 'Data anggota berhasil disimpan');
            return redirect()->to(base_url('admin/anggota'));
        } else {
            session()->setFlashdata('error', 'Gagal menyimpan data anggota');
            return redirect()->back()->withInput();
        }
    }

    public function edit($id_anggota)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        $anggotaData = $this->anggotaModel->find($id_anggota);
        if (!$anggotaData) {
            session()->setFlashdata('error', 'Data anggota tidak ditemukan.');
            return redirect()->to(base_url('admin/anggota'));
        }

        $data = [
            'title' => 'Edit Anggota',
            'anggotaData' => $anggotaData,
            'validation' => \Config\Services::validation(),
        ];
        
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
            return redirect()->to(base_url('admin/anggota'));
        }

        // Set validation rules
        $validationRules = [
            'nama_perusahaan_anggota' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama perusahaan wajib diisi'
                ]
            ],
            'title_anggota_id' => [
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

        // Add logo validation only if new file is uploaded
        if ($this->request->getFile('logo_anggota')->isValid()) {
            $validationRules['logo_anggota'] = [
                'rules' => 'is_image[logo_anggota]|mime_in[logo_anggota,image/jpg,image/jpeg,image/png]|max_size[logo_anggota,2048]',
                'errors' => [
                    'is_image' => 'File yang anda pilih bukan gambar',
                    'mime_in' => 'File harus berekstensi JPG, JPEG, atau PNG',
                    'max_size' => 'Ukuran file maksimal 2MB'
                ]
            ];
        }

        // Add image validation only if new file is uploaded
        if ($this->request->getFile('image_anggota')->isValid()) {
            $validationRules['image_anggota'] = [
                'rules' => 'is_image[image_anggota]|mime_in[image_anggota,image/jpg,image/jpeg,image/png]|max_size[image_anggota,2048]',
                'errors' => [
                    'is_image' => 'File yang anda pilih bukan gambar',
                    'mime_in' => 'File harus berekstensi JPG, JPEG, atau PNG',
                    'max_size' => 'Ukuran file maksimal 2MB'
                ]
            ];
        }

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput();
        }

        $nama_perusahaan = $this->request->getPost("nama_perusahaan_anggota");
        $deskripsi = $this->request->getPost("deskripsi_anggota_id");
        $title = $this->request->getPost("title_anggota_id");
        $meta_desc = $this->request->getPost("meta_desc_id");

        // Buat slug
        $slug = $this->generateSlug($nama_perusahaan);

        $data = [
            'nama_perusahaan_anggota' => $nama_perusahaan,
            'deskripsi_anggota_id' => $deskripsi,
            'title_anggota_id' => $title,
            'meta_desc_id' => $meta_desc,
            'slug_anggota_id' => $slug,
        ];

        // Handle logo upload jika ada
        $file_logo = $this->request->getFile('logo_anggota');
        if ($file_logo && $file_logo->isValid()) {
            // Hapus file lama
            $oldLogo = $anggotaData['logo_anggota'];
            if (!empty($oldLogo) && file_exists('assets/img/anggota/' . $oldLogo)) {
                unlink('assets/img/anggota/' . $oldLogo);
            }

            // Upload file baru
            $currentDateTime = date('dmYHis');
            $newLogoName = str_replace(' ', '-', "logo_{$nama_perusahaan}_{$currentDateTime}.{$file_logo->getExtension()}");
            $file_logo->move('assets/img/anggota', $newLogoName);
            $data['logo_anggota'] = $newLogoName;
        }

        // Handle image upload jika ada
        $file_image = $this->request->getFile('image_anggota');
        if ($file_image && $file_image->isValid()) {
            // Hapus file lama
            $oldImage = $anggotaData['image_anggota'];
            if (!empty($oldImage) && file_exists('assets/img/anggota/' . $oldImage)) {
                unlink('assets/img/anggota/' . $oldImage);
            }

            // Upload file baru
            $currentDateTime = date('dmYHis');
            $newImageName = str_replace(' ', '-', "image_{$nama_perusahaan}_{$currentDateTime}.{$file_image->getExtension()}");
            $file_image->move('assets/img/anggota', $newImageName);
            $data['image_anggota'] = $newImageName;
        }

        if ($this->anggotaModel->update($id_anggota, $data)) {
            session()->setFlashdata('success', 'Data anggota berhasil diperbarui');
            return redirect()->to(base_url('admin/anggota'));   
        } else {
            session()->setFlashdata('error', 'Gagal memperbarui data anggota');
            return redirect()->back()->withInput();
        }
    }

    public function delete($id)
    {
        if (!session()->get('logged_in')) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
            }
            return redirect()->to(base_url('login'));
        }

        $anggotaData = $this->anggotaModel->find($id);
        if (!$anggotaData) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON(['success' => false, 'message' => 'Data anggota tidak ditemukan.']);
            }
            session()->setFlashdata('error', 'Data anggota tidak ditemukan.');
            return redirect()->to(base_url('admin/anggota'));
        }

        // Hapus file logo
        if (!empty($anggotaData['logo_anggota'])) {
            $logoPath = FCPATH . 'assets/img/anggota/' . $anggotaData['logo_anggota'];
            if (file_exists($logoPath)) {
                unlink($logoPath);
            }
        }

        // Hapus file image
        if (!empty($anggotaData['image_anggota'])) {
            $imagePath = FCPATH . 'assets/img/anggota/' . $anggotaData['image_anggota'];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        if ($this->anggotaModel->delete($id)) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON(['success' => true, 'message' => 'Data anggota berhasil dihapus']);
            }
            session()->setFlashdata('success', 'Data anggota berhasil dihapus');
        } else {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON(['success' => false, 'message' => 'Gagal menghapus data anggota']);
            }
            session()->setFlashdata('error', 'Gagal menghapus data anggota');
        }
        
        if ($this->request->isAJAX()) {
            return $this->response->setJSON(['success' => true, 'redirect' => base_url('admin/anggota')]);
        }
        
        return redirect()->to(base_url('admin/anggota'));
    }
}