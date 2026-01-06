<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SliderModel;

class SliderController extends BaseController
{
    protected $sliderModel;

    public function __construct()
    {
        $this->sliderModel = new SliderModel();
    }

    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        $data['all_data_slider'] = $this->sliderModel->findAll();
        $data['validation'] = \Config\Services::validation();
        
        return view('admin/slider/index', $data);
    }

    public function tambah()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        $data['all_data_slider'] = $this->sliderModel->findAll();
        $data['validation'] = \Config\Services::validation();
        
        return view('admin/slider/tambah', $data);
    }

    public function proses_tambah()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        date_default_timezone_set('Asia/Jakarta');
        $alt = $this->request->getVar("alt_foto_slider_id");
        $caption = $this->request->getVar("caption_slider_id");

        // Validasi file upload
        $file_foto = $this->request->getFile('foto_slider');
        if (!$file_foto || !$file_foto->isValid()) {
            session()->setFlashdata('error', 'Foto slider wajib diupload.');
            return redirect()->back()->withInput();
        }

        if (!$this->validate([
            'foto_slider' => [
                'rules' => 'uploaded[foto_slider]|is_image[foto_slider]|mime_in[foto_slider,image/jpg,image/jpeg,image/png]|max_size[foto_slider,2048]',
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
        $newFileName = str_replace(' ', '-', "slider_{$currentDateTime}.{$file_foto->getExtension()}");
        $file_foto->move('assets/img/slider', $newFileName);

        // Simpan ke database
        $data = [
            'foto_slider' => $newFileName,
            'alt_foto_slider_id' => $alt,
            'caption_slider_id' => $caption,
        ];

        $this->sliderModel->save($data);

        session()->setFlashdata('success', 'Data slider berhasil disimpan');
        return redirect()->to(base_url('admin/slider/index'));
    }

    public function edit($id_slider)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        $data['sliderData'] = $this->sliderModel->find($id_slider);
        if (!$data['sliderData']) {
            session()->setFlashdata('error', 'Data slider tidak ditemukan.');
            return redirect()->to(base_url('admin/slider/index'));
        }

        $data['validation'] = \Config\Services::validation();
        
        return view('admin/slider/edit', $data);
    }

    public function proses_edit($id_slider)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        // Handle PUT request
        if ($this->request->getMethod() === 'put') {
            $sliderData = $this->sliderModel->find($id_slider);
            if (!$sliderData) {
                return $this->response->setJSON(['success' => false, 'message' => 'Data slider tidak ditemukan.']);
            }

            $alt = $this->request->getPost("alt_foto_slider_id");
            $caption = $this->request->getPost("caption_slider_id");

            $data = [
                'alt_foto_slider_id' => $alt,
                'caption_slider_id' => $caption,
            ];

            // Handle file upload jika ada
            $file_foto = $this->request->getFile('foto_slider');
            if ($file_foto && $file_foto->isValid()) {
                // Validasi file
                if (!$this->validate([
                    'foto_slider' => [
                        'rules' => 'is_image[foto_slider]|mime_in[foto_slider,image/jpg,image/jpeg,image/png]|max_size[foto_slider,2048]',
                        'errors' => [
                            'is_image' => 'File yang anda pilih bukan gambar',
                            'mime_in' => 'File yang anda pilih wajib berekstensikan jpg/jpeg/png',
                            'max_size' => 'Ukuran file maksimal 2MB'
                        ]
                    ]
                ])) {
                    return $this->response->setJSON(['success' => false, 'message' => $this->validator->listErrors()]);
                }

                // Hapus file lama
                if (!empty($sliderData['foto_slider']) && file_exists('assets/img/slider/' . $sliderData['foto_slider'])) {
                    unlink('assets/img/slider/' . $sliderData['foto_slider']);
                }

                // Upload file baru
                $currentDateTime = date('dmYHis');
                $newFileName = str_replace(' ', '-', "slider_{$currentDateTime}.{$file_foto->getExtension()}");
                $file_foto->move('assets/img/slider', $newFileName);
                $data['foto_slider'] = $newFileName;
            }

            $this->sliderModel->update($id_slider, $data);

            session()->setFlashdata('success', 'Data slider berhasil diperbarui');
            return $this->response->setJSON(['success' => true, 'redirect' => base_url('admin/slider/index')]);
        }
        
        // Fallback untuk POST request
        $sliderData = $this->sliderModel->find($id_slider);
        if (!$sliderData) {
            session()->setFlashdata('error', 'Data slider tidak ditemukan.');
            return redirect()->to(base_url('admin/slider/index'));
        }

        $alt = $this->request->getVar("alt_foto_slider_id");
        $caption = $this->request->getVar("caption_slider_id");

        $data = [
            'alt_foto_slider_id' => $alt,
            'caption_slider_id' => $caption,
        ];

        // Handle file upload jika ada
        $file_foto = $this->request->getFile('foto_slider');
        if ($file_foto && $file_foto->isValid()) {
            // Validasi file
            if (!$this->validate([
                'foto_slider' => [
                    'rules' => 'is_image[foto_slider]|mime_in[foto_slider,image/jpg,image/jpeg,image/png]|max_size[foto_slider,2048]',
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
            if (!empty($sliderData['foto_slider']) && file_exists('assets/img/slider/' . $sliderData['foto_slider'])) {
                unlink('assets/img/slider/' . $sliderData['foto_slider']);
            }

            // Upload file baru
            $currentDateTime = date('dmYHis');
            $newFileName = str_replace(' ', '-', "slider_{$currentDateTime}.{$file_foto->getExtension()}");
            $file_foto->move('assets/img/slider', $newFileName);
            $data['foto_slider'] = $newFileName;
        }

        $this->sliderModel->update($id_slider, $data);

        session()->setFlashdata('success', 'Data slider berhasil diperbarui');
        return redirect()->to(base_url('admin/slider/index'));
    }

    public function delete($id)
    {
        if (!session()->get('logged_in')) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
            }
            return redirect()->to(base_url('login'));
        }

        $sliderData = $this->sliderModel->find($id);
        if (!$sliderData) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON(['success' => false, 'message' => 'Data slider tidak ditemukan.']);
            }
            session()->setFlashdata('error', 'Data slider tidak ditemukan.');
            return redirect()->to(base_url('admin/slider/index'));
        }

        // Hapus file foto
        if (!empty($sliderData['foto_slider']) && file_exists('assets/img/slider/' . $sliderData['foto_slider'])) {
            unlink('assets/img/slider/' . $sliderData['foto_slider']);
        }

        $this->sliderModel->delete($id);

        if ($this->request->isAJAX()) {
            return $this->response->setJSON(['success' => true, 'message' => 'Data slider berhasil dihapus']);
        }
        
        session()->setFlashdata('success', 'Data slider berhasil dihapus');
        return redirect()->to(base_url('admin/slider/index'));
    }
}