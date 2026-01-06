<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KontakModel;

class KontakController extends BaseController
{
    protected $kontakModel;

    public function __construct()
    {
        $this->kontakModel = new KontakModel();
    }

    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        $data['kontakData'] = $this->kontakModel->first();
        $data['title'] = 'Kontak';
        
        return view('admin/kontak/index', $data);
    }

    public function edit()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        $data['kontakData'] = $this->kontakModel->first();
        if (!$data['kontakData']) {
            // Jika belum ada data, buat data kosong
            $data['kontakData'] = [
                'id_kontak' => '',
                'judul_kontak_id' => '',
                'subjudul_kontak_id' => '',
                'deskripsi_kontak_id' => '',
                'slug_kontak_id' => '',
                'link_wa' => '',
                'alamat_id' => '',
                'telepon' => '',
                'email' => '',
                'jam_operasional' => ''
            ];
        }

        $data['validation'] = \Config\Services::validation();
        $data['title'] = 'Edit Kontak';
        
        return view('admin/kontak/edit', $data);
    }

    public function update()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        // Set validation rules
        $validationRules = [
            'judul_kontak_id' => [
                'rules' => 'required|max_length[100]',
                'errors' => [
                    'required' => 'Judul kontak wajib diisi',
                    'max_length' => 'Judul kontak maksimal 100 karakter'
                ]
            ],
            'subjudul_kontak_id' => [
                'rules' => 'max_length[200]',
                'errors' => [
                    'max_length' => 'Subjudul kontak maksimal 200 karakter'
                ]
            ],
            'deskripsi_kontak_id' => [
                'rules' => 'max_length[500]',
                'errors' => [
                    'max_length' => 'Deskripsi kontak maksimal 500 karakter'
                ]
            ],
            'link_wa' => [
                'rules' => 'valid_url',
                'errors' => [
                    'valid_url' => 'Link WhatsApp harus berupa URL yang valid'
                ]
            ],
            'alamat_id' => [
                'rules' => 'required|max_length[255]',
                'errors' => [
                    'required' => 'Alamat wajib diisi',
                    'max_length' => 'Alamat maksimal 255 karakter'
                ]
            ],
            'telepon' => [
                'rules' => 'required|max_length[20]',
                'errors' => [
                    'required' => 'Telepon wajib diisi',
                    'max_length' => 'Telepon maksimal 20 karakter'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email|max_length[100]',
                'errors' => [
                    'required' => 'Email wajib diisi',
                    'valid_email' => 'Format email tidak valid',
                    'max_length' => 'Email maksimal 100 karakter'
                ]
            ],
            'jam_operasional' => [
                'rules' => 'required|max_length[100]',
                'errors' => [
                    'required' => 'Jam operasional wajib diisi',
                    'max_length' => 'Jam operasional maksimal 100 karakter'
                ]
            ]
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput();
        }

        $id_kontak = $this->request->getPost("id_kontak");
        $judul = $this->request->getPost("judul_kontak_id");
        $subjudul = $this->request->getPost("subjudul_kontak_id");
        $deskripsi = $this->request->getPost("deskripsi_kontak_id");
        $link_wa = $this->request->getPost("link_wa");
        $alamat = $this->request->getPost("alamat_id");
        $telepon = $this->request->getPost("telepon");
        $email = $this->request->getPost("email");
        $jam_operasional = $this->request->getPost("jam_operasional");

        // Generate slug dari judul
        $slug = $this->generateSlug($judul);

        $data = [
            'judul_kontak_id' => $judul,
            'subjudul_kontak_id' => $subjudul,
            'deskripsi_kontak_id' => $deskripsi,
            'slug_kontak_id' => $slug,
            'link_wa' => $link_wa,
            'alamat_id' => $alamat,
            'telepon' => $telepon,
            'email' => $email,
            'jam_operasional' => $jam_operasional,
        ];

        if ($id_kontak) {
            // Update data yang sudah ada
            if ($this->kontakModel->update($id_kontak, $data)) {
                session()->setFlashdata('success', 'Data kontak berhasil diperbarui');
            } else {
                session()->setFlashdata('error', 'Gagal memperbarui data kontak');
            }
        } else {
            // Cek apakah sudah ada data
            $existing = $this->kontakModel->first();
            if ($existing) {
                if ($this->kontakModel->update($existing['id_kontak'], $data)) {
                    session()->setFlashdata('success', 'Data kontak berhasil diperbarui');
                } else {
                    session()->setFlashdata('error', 'Gagal memperbarui data kontak');
                }
            } else {
                if ($this->kontakModel->insert($data)) {
                    session()->setFlashdata('success', 'Data kontak berhasil disimpan');
                } else {
                    session()->setFlashdata('error', 'Gagal menyimpan data kontak');
                }
            }
        }

        return redirect()->to(base_url('admin/kontak'));
    }

    private function generateSlug($string)
    {
        $slug = strtolower($string);
        $slug = preg_replace('/[^a-z0-9\s]/', '', $slug);
        $slug = preg_replace('/\s+/', '-', $slug);
        return $slug;
    }
}