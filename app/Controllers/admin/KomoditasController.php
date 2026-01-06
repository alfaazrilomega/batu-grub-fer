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

        $data = [
            'title' => 'Data Komoditas',
            'all_data_komoditas' => $this->komoditasModel->findAll(),
            'validation' => \Config\Services::validation(),
        ];
        
        return view('admin/komoditas/index', $data);
    }

    public function tambah()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        $data = [
            'title' => 'Tambah Komoditas',
            'validation' => \Config\Services::validation(),
        ];
        
        return view('admin/komoditas/tambah', $data);
    }

    public function proses_tambah()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        // Set validation rules
        $validationRules = [
            'nama_komoditas_id' => [
                'rules' => 'required|regex_match[/^[a-zA-Z0-9\s]+$/]',
                'errors' => [
                    'required' => 'Nama komoditas wajib diisi',
                    'regex_match' => 'Nama komoditas hanya boleh berisi huruf dan angka'
                ]
            ],
            'foto_komoditas' => [
                'rules' => 'uploaded[foto_komoditas]|is_image[foto_komoditas]|mime_in[foto_komoditas,image/jpg,image/jpeg,image/png]|max_size[foto_komoditas,2048]',
                'errors' => [
                    'uploaded' => 'Foto komoditas wajib diupload',
                    'is_image' => 'File yang anda pilih bukan gambar',
                    'mime_in' => 'File harus berekstensi JPG, JPEG, atau PNG',
                    'max_size' => 'Ukuran file maksimal 2MB'
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

        $nama_komoditas = $this->request->getPost("nama_komoditas_id");
        $deskripsi = $this->request->getPost("deskripsi_komoditas_id");
        $alt = $this->request->getPost("alt_komoditas_id");
        $title = $this->request->getPost("title_id");
        $meta_desc = $this->request->getPost("meta_desc_id");

        // Buat slug
        $slug = $this->generateSlug($nama_komoditas);

        // Handle file upload
        $file_foto = $this->request->getFile('foto_komoditas');
        
        // Generate unique filename
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

        if ($this->komoditasModel->save($data)) {
            session()->setFlashdata('success', 'Data komoditas berhasil disimpan');
            return redirect()->to(base_url('admin/komoditas'));
        } else {
            session()->setFlashdata('error', 'Gagal menyimpan data komoditas');
            return redirect()->back()->withInput();
        }
    }

    public function edit($id_komoditas)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        $komoditasData = $this->komoditasModel->find($id_komoditas);
        if (!$komoditasData) {
            session()->setFlashdata('error', 'Data komoditas tidak ditemukan.');
            return redirect()->to(base_url('admin/komoditas'));
        }

        $data = [
            'title' => 'Edit Komoditas',
            'komoditasData' => $komoditasData,
            'validation' => \Config\Services::validation(),
        ];
        
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
            return redirect()->to(base_url('admin/komoditas'));
        }

        // Set validation rules
        $validationRules = [
            'nama_komoditas_id' => [
                'rules' => 'required|regex_match[/^[a-zA-Z0-9\s]+$/]',
                'errors' => [
                    'required' => 'Nama komoditas wajib diisi',
                    'regex_match' => 'Nama komoditas hanya boleh berisi huruf dan angka'
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

        // Add foto validation only if new file is uploaded
        if ($this->request->getFile('foto_komoditas')->isValid()) {
            $validationRules['foto_komoditas'] = [
                'rules' => 'is_image[foto_komoditas]|mime_in[foto_komoditas,image/jpg,image/jpeg,image/png]|max_size[foto_komoditas,2048]',
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

        $nama_komoditas = $this->request->getPost("nama_komoditas_id");
        $deskripsi = $this->request->getPost("deskripsi_komoditas_id");
        $alt = $this->request->getPost("alt_komoditas_id");
        $title = $this->request->getPost("title_id");
        $meta_desc = $this->request->getPost("meta_desc_id");

        // Buat slug
        $slug = $this->generateSlug($nama_komoditas);

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
            // Hapus file lama
            $oldFoto = $komoditasData['foto_komoditas'];
            if (!empty($oldFoto) && file_exists('assets/img/komoditas/' . $oldFoto)) {
                unlink('assets/img/komoditas/' . $oldFoto);
            }

            // Upload file baru
            $currentDateTime = date('dmYHis');
            $newFileName = str_replace(' ', '-', "komoditas_{$nama_komoditas}_{$currentDateTime}.{$file_foto->getExtension()}");
            $file_foto->move('assets/img/komoditas', $newFileName);
            $data['foto_komoditas'] = $newFileName;
        }

        if ($this->komoditasModel->update($id_komoditas, $data)) {
            session()->setFlashdata('success', 'Data komoditas berhasil diperbarui');
            return redirect()->to(base_url('admin/komoditas'));
        } else {
            session()->setFlashdata('error', 'Gagal memperbarui data komoditas');
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

        $komoditasData = $this->komoditasModel->find($id);
        if (!$komoditasData) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON(['success' => false, 'message' => 'Data komoditas tidak ditemukan.']);
            }
            session()->setFlashdata('error', 'Data komoditas tidak ditemukan.');
            return redirect()->to(base_url('admin/komoditas'));
        }

        // Hapus file foto
        if (!empty($komoditasData['foto_komoditas'])) {
            $fotoPath = FCPATH . 'assets/img/komoditas/' . $komoditasData['foto_komoditas'];
            if (file_exists($fotoPath)) {
                unlink($fotoPath);
            }
        }

        if ($this->komoditasModel->delete($id)) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON(['success' => true, 'message' => 'Data komoditas berhasil dihapus']);
            }
            session()->setFlashdata('success', 'Data komoditas berhasil dihapus');
        } else {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON(['success' => false, 'message' => 'Gagal menghapus data komoditas']);
            }
            session()->setFlashdata('error', 'Gagal menghapus data komoditas');
        }
        
        if ($this->request->isAJAX()) {
            return $this->response->setJSON(['success' => true, 'redirect' => base_url('admin/komoditas')]);
        }
        
        return redirect()->to(base_url('admin/komoditas'));
    }
}