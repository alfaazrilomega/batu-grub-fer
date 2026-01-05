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
        $members = $this->anggotaModel->findAll();
        
        // Menggunakan deskripsi dari database, dengan fallback yang aman jika tidak ada
        $description = ($meta) ? $meta['deskripsi_halaman_id'] : "Deskripsi untuk halaman anggota belum diatur.";

        $data = [
            'members' => $members,
            'locale' => $locale,
            'page_title' => 'Anggota Kami',
            'members_description' => $description,
        ];

        return view('pages/members', $data);
    }
}
