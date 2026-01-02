<?php

namespace App\Controllers;

use App\Models\AnggotaModel;
use App\Models\MetaModel; // Gunakan MetaModel

class MemberController extends BaseController
{
    protected $anggotaModel;
    protected $metaModel; // Tambahkan properti

    public function __construct()
    {
        $this->anggotaModel = new AnggotaModel();
        $this->metaModel = new MetaModel(); // Inisialisasi MetaModel
    }

    public function index()
    {
        $locale = service('request')->getLocale();

        // Mengambil data meta untuk halaman anggota
        $meta = $this->metaModel->where('slug_meta_id', 'halaman-anggota')->first();

        // Mengambil semua data anggota dari model
        $data['members'] = $this->anggotaModel->findAll();
        
        $data['locale'] = $locale;
        $data['page_title'] = 'Anggota Kami';
        
        // Menggunakan deskripsi dari database, dengan fallback jika tidak ada
        $data['members_description'] = $meta['deskripsi_halaman_id'] ?? "Deskripsi untuk halaman anggota belum diatur.";

        return view('pages/members', $data);
    }
}
