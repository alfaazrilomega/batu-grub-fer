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
        if (!$data['kontakData']) {
            // Jika belum ada data, buat data kosong
            $data['kontakData'] = [
                'id_kontak' => '',
                'judul_kontak_id' => '',
                'subjudul_kontak_id' => '',
                'deskripsi_kontak_id' => '',
                'link_wa' => '',
                'alamat_id' => '',
                'telepon' => '',
                'email' => '',
                'jam_operasional' => ''
            ];
        }

        $data['validation'] = \Config\Services::validation();
        
        return view('admin/kontak/index', $data);
    }

    public function proses_edit($id_kontak = null)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        $judul = $this->request->getVar("judul_kontak_id");
        $subjudul = $this->request->getVar("subjudul_kontak_id");
        $deskripsi = $this->request->getVar("deskripsi_kontak_id");
        $link_wa = $this->request->getVar("link_wa");
        $alamat = $this->request->getVar("alamat_id");
        $telepon = $this->request->getVar("telepon");
        $email = $this->request->getVar("email");
        $jam_operasional = $this->request->getVar("jam_operasional");

        $data = [
            'judul_kontak_id' => $judul,
            'subjudul_kontak_id' => $subjudul,
            'deskripsi_kontak_id' => $deskripsi,
            'link_wa' => $link_wa,
            'alamat_id' => $alamat,
            'telepon' => $telepon,
            'email' => $email,
            'jam_operasional' => $jam_operasional,
        ];

        if ($id_kontak) {
            // Update data yang sudah ada
            $this->kontakModel->update($id_kontak, $data);
        } else {
            // Insert data baru
            $this->kontakModel->insert($data);
        }

        session()->setFlashdata('success', 'Data kontak berhasil disimpan');
        return redirect()->to(base_url('admin/kontak/index'));
    }
}